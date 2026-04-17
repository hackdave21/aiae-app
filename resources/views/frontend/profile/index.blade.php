@extends('layouts.frontend')

@section('title', __('Mon Espace - AIAE'))

@section('styles')
<style>
    .profile-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    .status-badge {
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 99px;
    }
    .nav-link-active {
        color: #162064;
        font-weight: 700;
        border-bottom: 2px solid #162064;
    }
    #navBar {
        background-color: #162064 !important;
        backdrop-filter: none !important;
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
    function toggleEdit() {
        const display = document.getElementById('profile-display');
        const form = document.getElementById('profile-edit-form');
        const btn = document.getElementById('btn-edit-profile');
        
        if (display.classList.contains('hidden')) {
            display.classList.remove('hidden');
            form.classList.add('hidden');
            btn.innerHTML = `<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg> Modifier`;
        } else {
            display.classList.add('hidden');
            form.classList.remove('hidden');
            btn.innerHTML = `Action en cours...`;
            btn.onclick = null; // Disable button while in edit mode to avoid confusion, though it's not strictly necessary with "Annuler"
        }
    }
</script>
@endsection

@section('content')
<div class="min-h-screen pt-40 pb-20 px-4 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full md:w-1/3 lg:w-1/4">
                <div class="bg-white rounded-3xl p-8 profile-card shadow-xl sticky top-40">
                    <div class="text-center mb-8">
                        <div class="w-24 h-24 bg-[#162064]/10 rounded-full flex items-center justify-center mx-auto mb-4 text-[#162064] text-3xl font-bold font-FuturaStdMedium">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <h2 class="text-xl font-bold text-[#162064]">{{ $user->name }}</h2>
                    </div>

                    <nav class="space-y-2">
                        <a href="{{ route('profile') }}" class="flex items-center gap-3 p-3 rounded-xl bg-gray-50 text-[#162064] font-bold transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            {{ __('Mon Profil') }}
                        </a>
                        <a href="{{ route('simulator.index') }}" class="flex items-center gap-3 p-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#162064] transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                            {{ __('Nouvelle Simulation') }}
                        </a>
                        <hr class="my-4 border-gray-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition-all font-medium">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                {{ __('Déconnexion') }}
                            </button>
                        </form>
                    </nav>
                </div>
            </div>
            <!-- Main Content -->
            <div class="flex-1 space-y-8">
                <!-- Info Section -->
                <div class="bg-white rounded-3xl p-6 md:p-8 profile-card shadow-xl overflow-hidden relative">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl md:text-2xl font-bold text-[#162064] font-FuturaStdMedium">{{ __('Mes Informations') }}</h3>
                        <button onclick="toggleEdit()" id="btn-edit-profile" class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-[#162064] hover:text-[#ff8400] transition-colors flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            {{ __('Modifier') }}
                        </button>
                    </div>

                    <div id="profile-display" class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:gap-8">
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Nom complet') }}</span>
                            <div class="text-gray-800 font-medium break-words">{{ $user->name }}</div>
                        </div>
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Email') }}</span>
                            <div class="text-gray-800 font-medium break-all">{{ $user->email }}</div>
                        </div>
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Téléphone') }}</span>
                            <div class="text-gray-800 font-medium">{{ $user->phone ?? __('Non renseigné') }}</div>
                        </div>
                    </div>

                    <form id="profile-edit-form" action="{{ route('profile.update') }}" method="POST" class="hidden animate-fade-in">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6">
                            <div>
                                <label class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Nom complet') }}</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#162064]">
                            </div>
                            <div>
                                <label class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Email') }}</label>
                                <input type="email" name="email" value="{{ $user->email }}" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#162064]">
                            </div>
                            <div>
                                <label class="text-gray-400 text-[10px] uppercase font-bold tracking-widest block mb-1">{{ __('Téléphone') }}</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-[#162064]">
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end gap-3">
                            <button type="button" onclick="toggleEdit()" class="px-4 py-2 text-[10px] font-bold uppercase text-gray-400 hover:text-gray-600 transition-colors">{{ __('Annuler') }}</button>
                            <button type="submit" class="bg-[#162064] text-white px-6 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest hover:bg-[#ff8400] transition-all">{{ __('Enregistrer') }}</button>
                        </div>
                    </form>
                </div>

                <!-- History Section -->
                <div class="bg-white rounded-3xl p-6 md:p-8 profile-card shadow-xl">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="text-xl md:text-2xl font-bold text-[#162064] font-FuturaStdMedium">{{ __('Historique des simulations') }}</h3>
                        <span class="bg-[#162064]/10 text-[#162064] px-4 py-1 rounded-full text-[10px] font-bold tracking-wider">{{ count($simulations) }} {{ __('Simulation(s)') }}</span>
                    </div>

                    @if(count($simulations) > 0)
                        <!-- Desktop Table -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-left border-b border-gray-100">
                                        <th class="pb-4 font-bold text-gray-400 text-[10px] uppercase tracking-widest">{{ __('Date') }}</th>
                                        <th class="pb-4 font-bold text-gray-400 text-[10px] uppercase tracking-widest">{{ __('Type') }}</th>
                                        <th class="pb-4 font-bold text-gray-400 text-[10px] uppercase tracking-widest">{{ __('Estimation') }}</th>
                                        <th class="pb-4 font-bold text-gray-400 text-[10px] uppercase tracking-widest text-right">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($simulations as $sim)
                                        @php 
                                            $config = $sim->configuration_data;
                                            $typeLabels = [
                                                'villa' => 'Villa', 'immeuble' => 'Immeuble', 'residence' => 'Résidence',
                                                'bureaux' => 'Bureaux', 'commerce' => 'Commerce', 'hotel' => 'Hôtel', 'clinique' => 'Clinique',
                                                'entrepot' => 'Entrepôt', 'usine' => 'Usine', 'hangar' => 'Hangar', 'elevage_bovins' => 'Élevage', 'elevage_volailles' => 'Volailles'
                                            ];
                                        @endphp
                                        <tr>
                                            <td class="py-5 text-gray-600 text-sm italic">{{ $sim->created_at->format('d/m/Y') }}</td>
                                            <td class="py-5">
                                                <div class="font-bold text-[#162064]">{{ __($typeLabels[$config['typeBat'] ?? ''] ?? ($config['typeBat'] ?? 'N/A')) }}</div>
                                                <div class="text-[10px] text-gray-400 font-medium">
                                                    {{ number_format($sim->input_quantity, 0) }} m² - 
                                                    {{ __(ucfirst($config['secteur'] ?? 'N/A')) }}
                                                </div>
                                            </td>
                                            <td class="py-5">
                                                <div class="font-bold text-[#162064] mono text-sm">{{ number_format($sim->total_amount_ttc, 0, ',', ' ') }} F</div>
                                            </td>
                                            <td class="py-5 text-right">
                                                <a href="{{ route('profile.simulations.show', $sim->id) }}" class="text-[#162064] hover:text-[#ff8400] transition-colors inline-flex items-center gap-1 font-bold text-[10px] uppercase p-2 border border-[#162064]/20 rounded-lg hover:border-[#ff8400]">
                                                    {{ __('Détails') }}
                                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile List -->
                        <div class="block md:hidden space-y-4">
                            @foreach($simulations as $sim)
                                @php 
                                    $config = $sim->configuration_data;
                                @endphp
                                <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <div class="text-[10px] text-gray-400 italic mb-1">{{ $sim->created_at->format('d/m/Y') }}</div>
                                            <div class="font-bold text-[#162064] text-lg">{{ __($typeLabels[$config['typeBat'] ?? ''] ?? ($config['typeBat'] ?? 'N/A')) }}</div>
                                            <div class="text-[10px] text-gray-500">{{ number_format($sim->input_quantity, 0) }} m² - {{ __($config['secteur'] ?? 'N/A') }}</div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-[#ff8400] mono">{{ number_format($sim->total_amount_ttc, 0, ',', ' ') }} F</div>
                                            <span class="text-[8px] font-black uppercase text-gray-400 tracking-tighter">{{ __('Estimation') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('profile.simulations.show', $sim->id) }}" class="w-full flex items-center justify-center gap-2 bg-white border border-[#162064]/20 text-[#162064] py-3 rounded-xl font-bold text-[10px] uppercase shadow-sm">
                                        {{ __('Voir les détails') }}
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-2xl">
                            <p class="text-gray-500 italic mb-4">{{ __("Vous n'avez pas encore effectué de simulation enregistrée.") }}</p>
                            <a href="{{ route('simulator.index') }}" class="inline-flex items-center gap-2 bg-[#162064] text-white px-6 py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-[#ff8400] transition-all">
                                {{ __('Commencer une estimation') }}
                            </a>
                        </div>
                    @endif
                </div>
                
                <!-- Security Note -->
                <div class="p-6 rounded-2xl border-2 border-dashed border-[#162064]/20 bg-[#162064]/5 text-center">
                    <p class="text-[10px] text-gray-500">
                        {{ __("Besoin d'aide pour interpréter vos estimations ? Contactez notre équipe technique via le formulaire de") }} 
                        <a href="{{ route('contact') }}" class="text-[#162064] font-bold underline">{{ __('contact') }}</a>.
                    </p>
                </div>
            </div>
         </div>
        </div>
    </div>
</div>
@endsection
