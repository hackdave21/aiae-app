@extends('layouts.frontend')

@section('title', __('Détails Simulation - AIAE'))

@section('styles')
<style>
    .details-card {
        background: white;
        border-radius: 2xl;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .mono { font-family: 'JetBrains Mono', monospace; }
    .status-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 99px;
    }
    #navBar { background-color: #162064 !important; }
    
    @media print {
        body { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; background-color: white !important; }
        header, footer, nav, #navBar, .no-print { display: none !important; }
        .min-h-screen { padding-top: 0 !important; padding-bottom: 0 !important; min-height: auto !important; }
        .bg-gray-50 { background-color: transparent !important; }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen pt-40 pb-20 px-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button & Title -->
        <div class="flex items-center justify-between mb-8 print:hidden">
            <a href="{{ route('profile') }}" class="flex items-center gap-2 text-gray-500 hover:text-[#162064] transition-colors font-bold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                {{ __("Retour à l'historique") }}
            </a>
            <div class="flex items-center gap-3">
                <span class="status-badge bg-blue-100 text-blue-700">{{ __('Réf:') }} {{ $simulation->reference_id }}</span>
                <button onclick="window.print()" class="p-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 00-2 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                </button>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Header Summary -->
            <div class="bg-[#162064] text-white rounded-3xl p-6 md:p-8 shadow-xl">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="w-full md:w-auto">
                        <h1 class="text-2xl md:text-3xl font-bold mb-2">{{ __($typeLabels[$config['typeBat']] ?? $config['typeBat']) }}</h1>
                        <p class="text-white/70 text-[10px] md:text-sm">{{ __('Réalisée le') }} {{ $simulation->created_at->format('d/m/Y') }} {{ __('à') }} {{ $simulation->created_at->format('H:i') }}</p>
                        <div class="mt-4 flex flex-wrap gap-1.5">
                            <span class="px-2 py-1 bg-white/10 rounded-lg text-[9px] md:text-xs tracking-wider">{{ __($secteurLabels[$config['secteur']] ?? $config['secteur']) }}</span>
                            <span class="px-2 py-1 bg-white/10 rounded-lg text-[9px] md:text-xs tracking-wider">{{ __(ucfirst($config['standing'] ?? 'Standard')) }}</span>
                            <span class="px-2 py-1 bg-white/10 rounded-lg text-[9px] md:text-xs tracking-wider">{{ __($zoneLabels[$config['zone']] ?? $config['zone']) }}</span>
                        </div>
                    </div>
                    <div class="w-full md:w-auto text-left md:text-right border-t border-white/10 pt-4 md:border-0 md:pt-0">
                        <div class="text-white/60 mb-1 text-[10px] uppercase tracking-widest">{{ __('Estimation Totale TTC') }}</div>
                        <div class="text-3xl md:text-4xl font-bold mono text-[#ff8400]">
                            {{ number_format($simulation->total_amount_ttc, 0, ',', ' ') }} F
                        </div>
                        <div class="text-[8px] md:text-[10px] text-white/40 mt-1 uppercase tracking-widest">{{ __('Valeur indicative moyenne') }}</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Info Column -->
                <div class="order-2 md:order-1 md:col-span-1 space-y-6">
                    <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100">
                        <h3 class="font-bold text-[#162064] mb-4 text-[10px] uppercase tracking-wider">{{ __('Configuration') }}</h3>
                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between items-center"><span class="text-gray-500">{{ __('Surface') }}</span><span class="font-bold mono">{{ number_format($simulation->input_quantity, 0) }} m²</span></div>
                            <div class="flex justify-between items-center"><span class="text-gray-500">{{ __('Niveaux') }}</span><span class="font-bold">R+{{ ($config['dimensions']['niveaux'] ?? 1) - 1 }}</span></div>
                            <div class="flex justify-between items-center"><span class="text-gray-500">{{ __('Sous-sol') }}</span><span class="font-bold">{{ $config['dimensions']['ssSol'] ?? 0 }}</span></div>
                            <div class="flex justify-between items-center gap-4"><span class="text-gray-500 shrink-0">{{ __('Zone') }}</span><span class="font-bold text-[10px] text-right">{{ $zoneLabels[$config['zone'] ?? ''] ?? __('N/A') }}</span></div>
                            <div class="flex justify-between items-center gap-4"><span class="text-gray-500 shrink-0">{{ __('Sol') }}</span><span class="font-bold text-blue-600 text-[10px] text-right">{{ $solLabels[$config['sol'] ?? ''] ?? __('N/A') }}</span></div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-5 md:p-6 shadow-sm border border-gray-100">
                        <h3 class="font-bold text-[#162064] mb-4 text-[10px] uppercase tracking-wider">{{ __('Options & Énergie') }}</h3>
                        <div class="space-y-4">
                           @if($config['options']['solaire'] ?? false)
                              <div class="p-3 bg-blue-50 rounded-xl border border-blue-100">
                                 <div class="text-[8px] font-bold text-blue-600 uppercase mb-1 tracking-tighter">{{ __('Système Solaire') }}</div>
                                 <div class="text-xs font-bold text-[#162064]">{{ $config['options']['solaire'] }} kWc</div>
                              </div>
                           @endif
                           @if($config['options']['groupe'] ?? false)
                              <div class="p-3 bg-orange-50 rounded-xl border border-orange-100">
                                 <div class="text-[8px] font-bold text-orange-600 uppercase mb-1 tracking-tighter">{{ __('Groupe Électrogène') }}</div>
                                 <div class="text-xs font-bold text-[#162064]">{{ $config['options']['groupe'] }} kVA</div>
                              </div>
                           @endif
                           <div class="flex flex-wrap gap-1.5 pt-1">
                                @foreach($config['options'] ?? [] as $key => $val)
                                    @if($val && $val !== 'non' && !in_array($key, ['solaire', 'groupe']))
                                        <span class="px-2 py-0.5 bg-gray-50 text-gray-500 rounded text-[8px] font-bold uppercase border border-gray-100">
                                            {{ __(str_replace('_', ' ', $key)) }}
                                        </span>
                                    @endif
                                @endforeach
                           </div>
                        </div>
                    </div>
                </div>

                <!-- Posts Column -->
                <div class="order-1 md:order-2 md:col-span-2">
                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 h-full">
                        <h3 class="text-lg md:text-xl font-bold text-[#162064] mb-6">{{ __('Détail du budget (V5.1)') }}</h3>
                        <div class="space-y-4">
                            @if(isset($config['details']) && count($config['details']) > 0)
                                @foreach($config['details'] as $poste)
                                    <div class="flex justify-between items-center border-b border-gray-50 pb-3 gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-[11px] md:text-sm font-bold text-gray-800 break-words">{{ $poste['nom'] }}</div>
                                            <div class="text-[9px] text-gray-400 italic">{{ $poste['detail'] ?? '' }}</div>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <div class="text-[9px] mono font-bold text-gray-300">{{ number_format($poste['min'], 0, ',', ' ') }} F</div>
                                            <div class="text-xs md:text-sm mono font-black text-[#162064]">{{ number_format($poste['max'], 0, ',', ' ') }} F</div>
                                        </div>
                                    </div>
                                @endforeach
                            @elseif(isset($config['postes']) && count($config['postes']) > 0)
                                @foreach($config['postes'] as $poste)
                                    <div class="flex justify-between items-center border-b border-gray-50 pb-3 gap-4">
                                        <div class="flex-1 min-w-0">
                                            <div class="text-[11px] md:text-sm font-bold text-gray-800 break-words">{{ $poste['nom'] }}</div>
                                            <div class="text-[9px] text-gray-400 italic">{{ $poste['detail'] ?? '' }}</div>
                                        </div>
                                        <div class="text-right shrink-0">
                                            <div class="text-xs md:text-sm mono font-black text-[#162064]">{{ number_format($poste['montant'], 0, ',', ' ') }} F</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-10 text-gray-400 italic text-xs">{{ __('Détails non disponibles pour cette version.') }}</div>
                            @endif
                        </div>

                        <div class="mt-8 md:mt-10 p-5 bg-[#162064] rounded-2xl text-white shadow-lg">
                           <div class="flex justify-between items-end">
                              <div>
                                 <div class="text-[8px] md:text-[10px] text-blue-200 uppercase font-bold mb-1 tracking-widest">{{ __('Base Estimative') }}</div>
                                 <div class="text-xl md:text-2xl font-bold mono">{{ number_format($simulation->base_amount, 0, ',', ' ') }} F</div>
                              </div>
                              <div class="text-right">
                                 <div class="text-[8px] md:text-[10px] text-blue-200 uppercase font-bold mb-1 tracking-widest">{{ __('Certification') }}</div>
                                 <div class="font-bold text-[10px] md:text-xs">{{ __('AIAE VALIDE') }}</div>
                              </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
