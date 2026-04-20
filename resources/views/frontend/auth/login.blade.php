@extends('layouts.frontend', ['hideHeaderFooter' => true])

@section('title', __('Connexion - AIAE'))

@section('styles')
<style>
    .auth-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 25px 50px -12px rgba(22, 32, 100, 0.25);
    }
    .btn-auth {
        background: #162064;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-auth:hover {
        background: #ff8400;
        transform: translateY(-2px);
    }
    #navBar {
        background-color: #162064 !important;
        backdrop-filter: none !important;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 bg-auth-pattern">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 sm:p-12 auth-card my-10">
        <div class="text-center mb-10">
            <img src="{{ asset('aiae-frontend/Images/logos/LOGO AIAE FINAL.png') }}" alt="AIAE Logo" class="h-16 mx-auto mb-6">
            <h1 class="text-3xl font-bold text-[#162064] mb-2 font-FuturaStdMedium">{{ __('Heureux de vous revoir') }}</h1>
            <p class="text-gray-500">{{ __('Connectez-vous pour accéder à vos simulations') }}</p>
            
            @if(session('success'))
                <div class="mt-6 p-4 bg-green-50 text-green-700 rounded-xl text-sm font-medium border border-green-100">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('message'))
                <div class="mt-6 p-4 bg-blue-50 text-blue-700 rounded-xl text-sm font-medium border border-blue-100">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">{{ __('Adresse Email') }}</label>
                <input type="email" name="email" id="email" 
                    value="{{ old('email') }}"
                    class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#162064] focus:ring-2 focus:ring-[#162064]/20 outline-none transition-all"
                    placeholder="{{ __('votre@email.com') }}" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

                <div class="relative">
                    <input type="password" name="password" id="password" 
                        class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#162064] focus:ring-2 focus:ring-[#162064]/20 outline-none transition-all pr-12"
                        placeholder="••••••••" required>
                    <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#162064] transition-colors">
                        <svg id="eye-password" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                <div id="password-feedback" class="mt-2 text-xs sm:text-sm font-medium transition-all duration-200 hidden"></div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-[#162064] border-gray-300 rounded focus:ring-[#162064]">
                <label for="remember" class="ml-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</label>
            </div>

            <button type="submit" class="w-full py-4 rounded-xl btn-auth font-bold uppercase tracking-wider">
                {{ __('Se Connecter') }}
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-sm">
                {{ __("Vous n'avez pas encore de compte ?") }} 
                <a href="{{ route('register') }}" class="font-bold text-[#162064] hover:text-[#ff8400] transition-colors">{{ __('Inscrivez-vous') }}</a>
            </p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = document.getElementById('eye-' + id);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.274 0 2.483.257 3.591.716m-4.832 1.638L9.15 9.15M15 12a3 3 0 11-6 0 3 3 0 016 0zm6.364 0c-1.274 4.057-5.064 7-9.542 7-1.047 0-2.051-.162-3-.463m-4.243-4.243L4.875 14.875M19.071 4.929l-14.142 14.142" />';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        }
    }

    // Password Validation Logic
    const passwordInput = document.getElementById('password');
    const feedback = document.getElementById('password-feedback');

    if (passwordInput && feedback) {
        passwordInput.addEventListener('input', function() {
            const value = this.value;
            if (value === '') {
                feedback.classList.add('hidden');
                return;
            }
            
            feedback.classList.remove('hidden');

            const rules = [
                { label: "{{ __('8 caractères') }}", regex: /.{8,}/ },
                { label: "{{ __('une majuscule') }}", regex: /[A-Z]/ },
                { label: "{{ __('un chiffre') }}", regex: /[0-9]/ },
                { label: "{{ __('une minuscule') }}", regex: /[a-z]/ }
            ];

            const missing = rules.filter(r => !r.regex.test(value)).map(r => r.label);

            if (missing.length === 0) {
                feedback.innerHTML = '<span class="flex items-center gap-1 text-green-600">✓ {{ __("Mot de passe valide") }}</span>';
            } else {
                feedback.innerHTML = '<span class="text-red-500">{{ __("Il manque :") }} ' + missing.join(', ') + '</span>';
            }
        });
    }
</script>
@endsection
