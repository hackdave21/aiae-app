@extends('layouts.frontend')

@section('title', 'Simulateur Énergie Autonome - AIAE')

@section('styles')
<style>
    :root {
        --aiae-blue: #162064;
        --aiae-green: #05482C;
        --aiae-orange: #FF8400;
    }
    [v-cloak] { display: none; }
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
    }
    .input-aiae:focus {
        border-color: var(--aiae-orange);
        box-shadow: 0 0 0 2px rgba(255, 132, 0, 0.2);
    }
    .tab-btn-active {
        background: var(--aiae-blue);
        color: white;
    }
    .fade-enter-active, .fade-leave-active { transition: opacity 0.3s; }
    .fade-enter-from, .fade-leave-to { opacity: 0; }
    
    #navBar { background-color: var(--aiae-blue) !important; }
    
    @media print {
        body { background-color: white; }
        #navBar, footer, .no-print { display: none !important; }
        #energy-app { padding-top: 0 !important; }
    }
</style>
@endsection

@section('content')
<div id="energy-app" class="min-h-screen pt-32 pb-20 px-4 bg-gray-50" v-cloak>
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-black text-[#162064] mb-4">Calculateur d'Énergie Solaire</h1>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Estimez vos besoins énergétiques et dimensionnez votre système solaire, hybride ou biogaz en quelques clics.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Sidebar / Controls (Left) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Main Tabs -->
                <div class="flex p-1 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <button @click="mainTab = 'solar'" :class="mainTab === 'solar' ? 'tab-btn-active' : 'text-gray-500'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m12.728 0l-.707-.707M6.343 6.343l-.707-.707M12 5a7 7 0 100 14 7 7 0 000-14z" /></svg>
                        Solaire & Hybride
                    </button>
                    <button @click="mainTab = 'biogaz'" :class="mainTab === 'biogaz' ? 'tab-btn-active' : 'text-gray-500'" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                        Biogaz (Agricole)
                    </button>
                </div>

                <!-- Solar Configuration -->
                <transition name="fade">
                    <div v-if="mainTab === 'solar'" class="space-y-6">
                        <!-- Sub-tabs: Mode Facture vs Mode Appareils -->
                        <div class="glass-card rounded-3xl p-6">
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-lg font-bold text-[#162064]">Ma consommation</h3>
                                <div class="flex gap-2 p-1 bg-gray-50 rounded-lg">
                                    <button @click="inputMode = 'bill'" :class="inputMode === 'bill' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-400'" class="px-3 py-1.5 rounded-md text-xs font-bold transition-all">Facture</button>
                                    <button @click="inputMode = 'items'" :class="inputMode === 'items' ? 'bg-white shadow-sm text-blue-600' : 'text-gray-400'" class="px-3 py-1.5 rounded-md text-xs font-bold transition-all">Appareils</button>
                                </div>
                            </div>

                            <!-- Mode Bill -->
                            <div v-if="inputMode === 'bill'" class="space-y-4">
                                <label class="block text-sm text-gray-500">Montant mensuel moyen (FCFA)</label>
                                <div class="flex items-center gap-4">
                                    <input type="range" v-model="form.monthlyBill" min="5000" max="1000000" step="5000" class="flex-1 accent-[#FF8400]">
                                    <input type="number" v-model="form.monthlyBill" class="w-32 py-2 px-3 border border-gray-200 rounded-xl text-right font-bold focus:outline-none input-aiae">
                                </div>
                                <div class="p-4 bg-blue-50 rounded-2xl text-xs text-blue-700 leading-relaxed border border-blue-100 italic">
                                    Note : L'estimation par facture est basée sur un tarif moyen de 115 FCFA / kWh. Pour plus de précision technique, utilisez le mode "Appareils".
                                </div>
                            </div>

                            <!-- Mode Items -->
                            <div v-if="inputMode === 'items'" class="space-y-4">
                                <!-- Search/Add -->
                                <div class="relative">
                                    <select v-model="selectedItem" @change="addItem" class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae appearance-none">
                                        <option value="">+ Ajouter un équipement...</option>
                                        <option v-for="eq in equipements" :key="eq.code" :value="eq.code">[[ eq.designation ]] ([[ eq.puissance_watts ]]W)</option>
                                    </select>
                                </div>

                                <!-- Items List -->
                                <div class="space-y-2 max-h-80 overflow-y-auto pr-2">
                                    <div v-for="(item, idx) in form.items" :key="idx" class="flex items-center gap-3 p-3 bg-white border border-gray-100 rounded-2xl hover:border-orange-200 transition-colors">
                                        <div class="flex-1">
                                            <div class="text-sm font-bold text-gray-800">[[ getEquipmentName(item.code) ]]</div>
                                            <div class="text-[10px] text-gray-400 italic">[[ getEquipmentPower(item.code) ]]W - [[ item.heures ]]h/jour</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button @click="item.qty > 1 ? item.qty-- : removeItem(idx)" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" /></svg>
                                            </button>
                                            <span class="w-6 text-center font-bold text-sm">[[ item.qty ]]</span>
                                            <button @click="item.qty++" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center hover:bg-green-50 hover:text-green-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div v-if="form.items.length === 0" class="text-center py-8 text-gray-400 italic text-sm border-2 border-dashed rounded-3xl">
                                        Aucun appareil ajouté pour le moment.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Settings -->
                        <div class="glass-card rounded-3xl p-6">
                            <h3 class="text-lg font-bold text-[#162064] mb-6">Paramètres Techniques</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Localisation (Zone)</label>
                                    <select v-model="form.zone" class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                                        <option v-for="z in zones" :key="z.zone_code" :value="z.zone_code">[[ z.zone_nom ]]</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Mode de fonctionnement</label>
                                    <select v-model="form.mode" class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                                        <option value="solaire">☀️ Solaire Autonome</option>
                                        <option value="hybride">⚡ Hybride (Solaire + Réseau)</option>
                                        <option value="groupe">🔥 Groupe Électrogène Uniquement</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>

                <!-- Biogaz Configuration -->
                <transition name="fade">
                    <div v-if="mainTab === 'biogaz'" class="space-y-6">
                        <div class="glass-card rounded-3xl p-6">
                            <h3 class="text-lg font-bold text-[#162064] mb-6">Mon Cheptel (Têtes)</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div v-for="animal in cheptels" :key="animal.code" class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                                    <div>
                                        <div class="text-sm font-bold text-gray-700">[[ animal.type_animal ]]</div>
                                        <div class="text-[10px] text-gray-400 uppercase">[[ animal.unite ]]</div>
                                    </div>
                                    <div class="w-24">
                                        <input type="number" v-model="form.cheptel[animal.code]" min="0" class="w-full py-2 px-3 bg-white border border-gray-100 rounded-xl text-right font-bold focus:outline-none input-aiae">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="glass-card rounded-3xl p-6">
                            <h3 class="text-lg font-bold text-[#162064] mb-6">Conditions de collecte</h3>
                            <select v-model="form.collecte" class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                                <option v-for="c in collectes" :key="c.code" :value="c.code">[[ c.systeme ]]</option>
                            </select>
                            <p class="mt-4 text-xs text-gray-400 italic">
                                * Le taux de collecte influence directement le volume de biogaz produit. En stabulation permanente (Intensif), la récupération est maximale.
                            </p>
                        </div>
                    </div>
                </transition>
            </div>

            <!-- Results (Right) -->
            <div class="lg:col-span-5">
                <div class="sticky top-32 space-y-6">
                    <!-- Recommendation Card -->
                    <div class="bg-[#162064] text-white rounded-[40px] p-8 shadow-2xl overflow-hidden relative">
                        <!-- Decorative circle -->
                        <div class="absolute -right-12 -top-12 w-40 h-40 bg-white/5 rounded-full"></div>
                        
                        <h3 class="text-orange-400 text-xs font-bold uppercase tracking-widest mb-8">Proposition AIAE Energy</h3>
                        
                        <div v-if="loading" class="py-12 flex flex-col items-center justify-center gap-4">
                            <div class="w-12 h-12 border-4 border-white/20 border-t-orange-400 rounded-full animate-spin"></div>
                            <span class="text-sm text-white/60">Analyse en cours...</span>
                        </div>

                        <div v-else-if="results" class="space-y-8 animate-fade-in">
                            <!-- Show Results Based on Tab -->
                            <div v-if="mainTab === 'solar'" class="space-y-6">
                                <!-- Panels -->
                                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl">☀️</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Puissance Solaire</div>
                                            <div class="text-2xl font-bold">[[ results.recommandations?.solaire?.panneaux_kwc || 0 ]] <span class="text-sm">kWc</span></div>
                                        </div>
                                    </div>
                                    <div class="text-right text-[10px] text-white/40">~[[ Math.ceil((results.recommandations?.solaire?.panneaux_kwc || 0) * 2) ]] panneaux<br>de 500Wc</div>
                                </div>

                                <!-- Inverter -->
                                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl">⚡</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Onduleur Hybride</div>
                                            <div class="text-2xl font-bold">[[ results.recommandations?.solaire?.onduleur_kva || results.recommandations?.groupe?.puissance_kva || 0 ]] <span class="text-sm">kVA</span></div>
                                        </div>
                                    </div>
                                    <div class="bg-[#FF8400] text-xs font-bold px-3 py-1 rounded-full text-white">Monophasé</div>
                                </div>

                                <!-- Batteries -->
                                <div v-if="results.recommandations?.solaire?.batteries_kwh" class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-xl">🔋</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Stockage Lithium</div>
                                            <div class="text-2xl font-bold">[[ results.recommandations?.solaire?.batteries_kwh ]] <span class="text-sm">kWh</span></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-[10px] text-green-400 font-bold uppercase">Protection DoD</div>
                                        <div class="text-lg font-bold">80%</div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="mainTab === 'biogaz'" class="space-y-6">
                                <!-- Digesteur -->
                                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-green-900/40 rounded-2xl flex items-center justify-center text-xl">🏗️</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Volume Digesteur</div>
                                            <div class="text-2xl font-bold">[[ results.technique?.volume_digesteur_m3 || 0 ]] <span class="text-sm">m³</span></div>
                                        </div>
                                    </div>
                                    <div class="text-right text-[10px] text-white/40 italic">Type [[ results.technique?.digesteur_recommande?.type_digesteur || 'Dôme fixe' ]]</div>
                                </div>

                                <!-- Gaz -->
                                <div class="flex items-center justify-between border-b border-white/10 pb-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-green-900/40 rounded-2xl flex items-center justify-center text-xl">💨</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Biogaz Produit</div>
                                            <div class="text-2xl font-bold">[[ results.technique?.biogaz_m3_jour || 0 ]] <span class="text-sm">m³/j</span></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Potentiel Elec -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-green-900/40 rounded-2xl flex items-center justify-center text-xl">💡</div>
                                        <div>
                                            <div class="text-xs text-white/50 uppercase font-bold">Électricité Potentielle</div>
                                            <div class="text-2xl font-bold">[[ results.technique?.potentiel_elec_journalier_kwh || 0 ]] <span class="text-sm">kWh/j</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Budget -->
                            <div class="pt-6 border-t border-white/10">
                                <div class="text-[10px] text-white/40 uppercase font-bold mb-2">Estimation Budget (Indicateur)</div>
                                <div class="text-4xl font-black text-[#FF8400] mb-2">
                                    [[ formatMoney((mainTab === 'solar' ? (results.recommandations?.solaire?.prix_min || 0) + (results.recommandations?.groupe?.prix_min || 0) : results.financier?.investissement_min || 0)) ]] F
                                </div>
                                <div class="flex items-center gap-2 text-[10px] text-white/60 italic">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                    Cette valeur inclut la fourniture, la pose et les protections standards.
                                </div>
                            </div>
                        </div>

                        <div v-else class="py-12 text-center text-white/40 italic text-sm">
                            Veuillez renseigner vos données pour voir l'estimation technique.
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="p-8 bg-white rounded-[40px] shadow-sm border border-gray-100 space-y-4 no-print">
                        <button @click="showQuoteModal = true" class="w-full bg-[#162064] text-white py-4 rounded-3xl font-bold uppercase tracking-widest hover:bg-[#FF8400] transition-all shadow-lg shadow-blue-900/10">
                            Demander un devis formel
                        </button>
                        <button @click="printPdf" class="w-full bg-gray-50 text-gray-400 py-3 rounded-2xl text-xs font-bold uppercase tracking-widest hover:text-[#162064] transition-all">
                            Télécharger la fiche PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Quote Modal -->
        <transition name="fade">
            <div v-if="showQuoteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm no-print">
                <div class="bg-white rounded-[32px] p-8 max-w-md w-full shadow-2xl relative">
                    <button @click="showQuoteModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-800 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    
                    <h3 class="text-2xl font-black text-[#162064] mb-2">Devis Personnalisé</h3>
                    <p class="text-sm text-gray-500 mb-6">Recevez une proposition détaillée basée sur votre estimation technique.</p>
                    
                    <div v-if="quoteSuccess" class="p-4 bg-green-50 text-green-700 rounded-2xl mb-6 text-sm font-bold border border-green-200">
                        ✅ Votre demande a été enregistrée avec succès. Notre équipe vous contactera très prochainement.
                    </div>
                    
                    <form v-else @submit.prevent="submitQuote" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Nom Complet</label>
                            <input type="text" v-model="quoteForm.nom" required class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Téléphone</label>
                            <input type="tel" v-model="quoteForm.telephone" required class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Email</label>
                            <input type="email" v-model="quoteForm.email" required class="w-full py-3 px-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm focus:outline-none input-aiae">
                        </div>
                        
                        <button type="submit" :disabled="submitting" class="w-full mt-2 bg-[#FF8400] text-white py-4 rounded-2xl font-bold uppercase tracking-widest hover:bg-[#e67700] transition-all flex items-center justify-center disabled:opacity-50">
                            <span v-if="submitting">Envoi en cours...</span>
                            <span v-else>Confirmer ma demande</span>
                        </button>
                    </form>
                </div>
            </div>
        </transition>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const { createApp, ref, watch, onMounted } = Vue;

    createApp({
        delimiters: ['[[', ']]'],
        setup() {
            const mainTab = ref('solar');
            const inputMode = ref('bill');
            const loading = ref(false);
            const selectedItem = ref('');
            
            const showQuoteModal = ref(false);
            const submitting = ref(false);
            const quoteSuccess = ref(false);
            const quoteForm = ref({ nom: '', email: '', telephone: '' });
            
            const equipements = @json($equipements);
            const zones = @json($zones);
            const cheptels = @json($cheptels);
            const collectes = @json($collectes);

            const form = ref({
                monthlyBill: 50000,
                items: [],
                zone: 'grand_lome',
                mode: 'solaire',
                cheptel: {},
                collecte: 'semi_intensif'
            });

            // Init cheptel with zeros
            cheptels.forEach(c => {
                form.value.cheptel[c.code] = 0;
            });

            const results = ref(null);

            const getEquipmentName = (code) => {
                const eq = equipements.find(e => e.code === code);
                return eq ? eq.designation : code;
            };

            const getEquipmentPower = (code) => {
                const eq = equipements.find(e => e.code === code);
                return eq ? eq.puissance_watts : 0;
            };

            const addItem = () => {
                if (!selectedItem.value) return;
                const existing = form.value.items.find(i => i.code === selectedItem.value);
                if (existing) {
                    existing.qty++;
                } else {
                    form.value.items.push({ code: selectedItem.value, qty: 1, heures: 8 });
                }
                selectedItem.value = '';
            };

            const removeItem = (idx) => {
                form.value.items.splice(idx, 1);
            };

            const calculate = async () => {
                loading.value = true;
                try {
                    let endpoint = '/api/site/energy/calculate';
                    let payload = {};

                    if (mainTab.value === 'solar') {
                        let finalInventaire = [];
                        if (inputMode.value === 'bill') {
                            // Convert bill to a virtual "general consumption" item
                            // Facture -> kWh -> Watts equiv
                            const kwhMois = form.value.monthlyBill / 115;
                            const whJour = (kwhMois * 1000) / 30;
                            // Dummy item for calculation
                            finalInventaire = [{ code: 'led_res', qty: 1, heures: whJour / 15 }]; 
                        } else {
                            finalInventaire = form.value.items;
                        }

                        payload = {
                            inventaire: finalInventaire,
                            zone: form.value.zone,
                            mode: form.value.mode
                        };
                    } else {
                        endpoint = '/api/site/energy/calculate-biogaz';
                        const cheptelArray = Object.entries(form.value.cheptel).map(([code, nombre]) => ({ code, nombre }));
                        payload = {
                            cheptel: cheptelArray,
                            collecte: form.value.collecte
                        };
                    }

                    const res = await axios.post(endpoint, payload);
                    results.value = res.data.data;
                } catch (err) {
                    console.error("Erreur de calcul", err);
                } finally {
                    loading.value = false;
                }
            };

            const formatMoney = (val) => {
                return new Intl.NumberFormat('fr-FR').format(Math.round(val));
            };

            const printPdf = () => {
                window.print();
            };

            const submitQuote = async () => {
                if(!quoteForm.value.email || !quoteForm.value.telephone) return;
                submitting.value = true;
                
                try {
                    const payload = {
                        nom: quoteForm.value.nom,
                        email: quoteForm.value.email,
                        telephone: quoteForm.value.telephone,
                        resultats: results.value,
                        details_techniques: form.value
                    };
                    
                    await axios.post('/api/site/energy/save', payload);
                    quoteSuccess.value = true;
                    setTimeout(() => { 
                        showQuoteModal.value = false; 
                        quoteSuccess.value = false; 
                        quoteForm.value = {nom: '', email: '', telephone: ''}; 
                    }, 4000);
                } catch(err) {
                    alert("Une erreur est survenue lors de l'envoi de votre demande.");
                    console.error("Erreur de sauvegarde devis", err);
                } finally {
                    submitting.value = false;
                }
            };

            // Watch for changes to trigger calculation
            watch([mainTab, () => form.value], () => {
                calculate();
            }, { deep: true });

            onMounted(() => {
                // Initial calculation
                calculate();
            });

            return {
                mainTab, inputMode, form, results, loading, selectedItem,
                equipements, zones, cheptels, collectes,
                showQuoteModal, submitting, quoteSuccess, quoteForm,
                getEquipmentName, getEquipmentPower, addItem, removeItem, formatMoney, printPdf, submitQuote
            }
        }
    }).mount('#energy-app');
</script>
@endsection
