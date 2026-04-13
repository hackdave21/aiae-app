<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class FrontendAuthController extends Controller
{
    /**
     * Show the frontend login form.
     */
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    /**
     * Handle a frontend login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return $this->handlePostAuthRedirection();
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Show the frontend registration form.
     */
    public function showRegisterForm()
    {
        return view('frontend.auth.register');
    }

    /**
     * Handle a frontend registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'user', // Ensure default role is user
            'is_active' => true,
        ]);

        Auth::login($user); // Optional, but requested by flow if they need to login later, let's follow USER: "redirigé vers la page de connexion"
        Auth::logout(); // Logout immediately if auto-logged by create/intended logic, though Laravel doesn't auto-login unless told.
        
        // Save pending simulation to this user before redirecting to login
        if (session()->has('pending_simulation')) {
            $this->saveSimulationForUser($user, session('pending_simulation'));
            session()->forget('pending_simulation');
        }

        return redirect()->route('login')->with('success', 'Votre compte a été créé avec succès. Veuillez vous connecter.');
    }

    /**
     * Handle redirection and save pending simulation if any.
     */
    protected function handlePostAuthRedirection()
    {
        if (session()->has('pending_simulation')) {
            $this->saveSimulationForUser(auth()->user(), session('pending_simulation'));
            session()->forget('pending_simulation');
            return redirect()->route('profile')->with('message', 'Votre simulation a été sauvegardée.');
        }

        return redirect()->route('profile');
    }

    /**
     * Helper to save a simulation for a specific user.
     */
    protected function saveSimulationForUser($user, $data)
    {
        $simulation = new \App\Models\Simulation();
        $simulation->reference_id = 'SIM-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
        $simulation->user_id = $user->id;
        $simulation->sector_type_id = 1;
        $simulation->input_quantity = $data['dimensions']['surface'] ?? 0;
        $simulation->total_amount_ttc = $data['total'] ?? 0;
        $simulation->total_amount_ht = ($data['total'] ?? 0) / 1.18;
        $simulation->base_amount = $data['base_amount'] ?? 0;
        $simulation->options_amount = $data['options_amount'] ?? 0;
        $simulation->status = 'saved';
        $simulation->configuration_data = $data;
        $simulation->save();
    }

    /**
     * Log the user out of the frontend application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
