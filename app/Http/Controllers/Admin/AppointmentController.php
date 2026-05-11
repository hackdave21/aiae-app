<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $appointments = Appointment::with(['lead', 'user'])
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->date, function ($query, $date) {
                $query->whereDate('start_at', $date);
            })
            ->latest()
            ->paginate($request->per_page ?? 15);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $appointments,
            ]);
        }

        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $leads = Lead::all();
        $users = User::all();
        return view('admin.appointments.create_edit', compact('leads', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'user_id' => 'required|exists:users,id',
            'start_at' => 'required|date',
            'duration' => 'required|integer|min:15',
            'type' => 'required|string',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $validated['end_at'] = Carbon::parse($validated['start_at'])->addMinutes((int) $validated['duration']);
        
        $appointment = Appointment::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment created successfully',
                'data' => $appointment,
            ], 201);
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Rendez-vous créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['lead', 'user']);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $appointment,
            ]);
        }

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $leads = Lead::all();
        $users = User::all();
        return view('admin.appointments.create_edit', compact('appointment', 'leads', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'user_id' => 'required|exists:users,id',
            'start_at' => 'required|date',
            'duration' => 'required|integer|min:15',
            'type' => 'required|string',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $validated['end_at'] = Carbon::parse($validated['start_at'])->addMinutes((int) $validated['duration']);
        
        $appointment->update($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment updated successfully',
                'data' => $appointment,
            ]);
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Rendez-vous mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Appointment deleted successfully',
            ]);
        }

        return redirect()->route('admin.appointments.index')->with('success', 'Rendez-vous supprimé avec succès.');
    }
}
