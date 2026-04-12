<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulateur Solaire Autonome - AIAE Energy</title>
  <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole AIAE FINAL.png') }}">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">

  <style>
    :root {
      --bleu: #0E1540;
      --vert: #05482C;
      --orange: #CC6A00;
      --bg-page: #f0f4f8;
    }
    body { font-family: 'Inter', sans-serif; background-color: var(--bg-page); color: #1e293b; }
    .mono { font-family: 'JetBrains Mono', monospace; }
    
    .card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .btn-primary { background: var(--orange); color: white; transition: 0.2s; }
    .btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .input-field { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: 0.2s; }
    .input-field:focus { border-color: var(--orange); }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s ease-out; }

    /* Custom Navbar from index.html / header.js style */
    header { background: white; border-bottom: 1px solid #e2e8f0; }
  </style>
</head>
<body>

<div class="min-h-screen py-8 px-4 md:px-8 max-w-6xl mx-auto">
    
    <!-- EN-TÊTE -->
    <header class="flex items-center gap-4 mb-10 bg-transparent border-0 p-0">
      <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white text-2xl" style="background: var(--vert)">⚡</div>
      <div>
        <h1 class="text-2xl font-bold" style="color: var(--bleu)">Simulateur Solaire AIAE</h1>
        <p class="text-gray-500 text-sm">Dimensionnement autonome & Estimation financière</p>
      </div>
      <div class="ml-auto">
          <a href="{{ route('home') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600">← Retour</a>
      </div>
    </header>

    <div class="grid lg:grid-cols-12 gap-8">
      
      <!-- COLONNE GAUCHE : SAISIE (7/12) -->
      <div class="lg:col-span-7 space-y-6">
        
        <!-- SÉLECTEUR DE MODE -->
        <div class="card p-2 flex">
          <button id="btn-mode-facture" class="flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all">
            🧾 D'après ma facture
          </button>
          <button id="btn-mode-equipements" class="flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all">
            ❄️ D'après mes appareils
          </button>
        </div>

        <!-- CONTENU MODE FACTURE -->
        <div id="mode-facture-content" class="card p-6">
          <h2 class="text-lg font-bold mb-4">Montant mensuel électricité</h2>
          <label class="block text-sm text-gray-500 mb-2">Combien payez-vous en moyenne par mois (CEET/CIE) ?</label>
          <div class="flex items-center gap-4">
            <input 
              id="input-bill-range"
              type="range" 
              min="5000" max="500000" step="5000" 
              value="50000"
              class="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[var(--orange)]"
            />
            <div class="w-40">
              <div class="relative">
                <input 
                  id="input-bill-number"
                  type="number" 
                  value="50000"
                  class="input-field text-right font-bold mono text-lg pr-12"
                />
                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">FCFA</span>
              </div>
            </div>
          </div>
          <div class="mt-4 p-4 bg-orange-50 rounded-lg border border-orange-100 text-sm text-orange-800">
            <p>💡 <strong>Note :</strong> Ce mode estime vos besoins globaux. Pour une précision technique (surtout pour les batteries), le mode "Appareils" est recommandé.</p>
          </div>
        </div>

        <!-- CONTENU MODE ÉQUIPEMENTS -->
        <div id="mode-equipements-content" class="card p-6 hidden">
          <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold">Inventaire des appareils</h2>
            <div id="total-conso-label" class="text-xs bg-gray-100 px-2 py-1 rounded">Total estimé : 0.00 kWh/j</div>
          </div>

          <!-- Liste active -->
          <div id="list-inventaire" class="space-y-3 mb-6"></div>

          <!-- Ajout rapide -->
          <div>
            <label class="text-sm font-semibold text-gray-700 block mb-2">Ajouter un équipement :</label>
            <div id="add-fast-container" class="flex flex-wrap gap-2"></div>
          </div>
        </div>
      </div>

      <!-- COLONNE DROITE : RÉSULTATS (5/12) -->
      <div class="lg:col-span-5">
        <div class="sticky top-6 space-y-4">
          
          <!-- CARTE RÉSULTAT TECHNIQUE -->
          <div class="card p-6" style="background: linear-gradient(145deg, #1e293b 0%, #0f172a 100%); color: white">
            <h3 class="text-orange-400 text-sm font-bold uppercase tracking-wider mb-6">Configuration Recommandée</h3>
            
            <div class="space-y-6">
              <!-- Solaire -->
              <div class="flex items-center justify-between border-b border-gray-700 pb-4">
                <div class="flex items-center gap-3">
                  <div class="text-2xl">☀️</div>
                  <div>
                    <div class="text-sm text-gray-400">Champ Solaire</div>
                    <div id="res-panneaux" class="font-bold text-lg">0.0 kWc</div>
                  </div>
                </div>
                <div id="res-nb-panneaux" class="text-right text-xs text-gray-500">~0 panneaux<br/>de 500Wc</div>
              </div>

              <!-- Onduleur -->
              <div class="flex items-center justify-between border-b border-gray-700 pb-4">
                <div class="flex items-center gap-3">
                  <div class="text-2xl">⚡</div>
                  <div>
                    <div class="text-sm text-gray-400">Onduleur Hybride</div>
                    <div id="res-onduleur" class="font-bold text-lg">0 kVA</div>
                  </div>
                </div>
                <div class="text-xs bg-blue-900 text-blue-200 px-2 py-1 rounded">Monophasé</div>
              </div>

              <!-- Batteries -->
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                  <div class="text-2xl">🔋</div>
                  <div>
                    <div class="text-sm text-gray-400">Stockage Lithium</div>
                    <div id="res-batterie" class="font-bold text-lg">0.0 kWh</div>
                  </div>
                </div>
                <div class="text-right text-xs text-gray-500">Autonomie<br/>Nuit + Secours</div>
              </div>
            </div>
          </div>

          <!-- CARTE ESTIMATION FINANCIÈRE -->
          <div class="card p-6 border-t-4 border-[var(--orange)]">
            <h3 class="font-bold text-gray-800 mb-2">Estimation Budget Clé en Main</h3>
            <p class="text-xs text-gray-500 mb-4">Inclut : Matériel, Pose, Protection et Mise en service.</p>
            
            <div class="text-center py-4 bg-gray-50 rounded-lg mb-4">
              <div id="res-prix-moyen" class="text-3xl font-bold mono" style="color:var(--bleu)">0 F</div>
              <div id="res-prix-range" class="text-xs text-gray-400 mt-1">Fourchette : 0 - 0 FCFA</div>
            </div>

            <div class="space-y-2">
              <button class="btn-primary w-full py-3 rounded-lg font-semibold shadow-lg shadow-orange-200">
                Demander un devis formel
              </button>
              <button onclick="window.print()" class="w-full py-3 text-sm text-gray-500 hover:text-gray-800 underline">
                Télécharger la fiche PDF
              </button>
            </div>
          </div>

          <!-- NOTE DE BAS DE PAGE -->
          <div class="text-xs text-gray-400 text-center leading-relaxed">
            *Cette simulation est indicative et non contractuelle. Les prix peuvent varier selon la complexité de l'installation et la marque du matériel (Victron, Huawei, etc.).
          </div>

        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('aiae-frontend/js/simulateur_energy_vanilla.js') }}"></script>
  <script>
    @php
        $mappedEquipements = $equipements->map(function($e) {
            return [
                'id' => $e->id,
                'label' => $e->designation,
                'puis' => $e->puissance_watts,
                'h' => $e->usage_heures_jour ?? 8
            ];
        });
    @endphp
    
    // Injection des données depuis Laravel
    const AIAE_ENERGY_CONFIG = {
        equipements: @json($mappedEquipements)
    };

    window.addEventListener('DOMContentLoaded', () => {
        if (typeof AIAEEnergySimulator !== 'undefined') {
            const simulator = new AIAEEnergySimulator(AIAE_ENERGY_CONFIG);
            // On peut exposer le simulateur si besoin
            window.AIAE_ENERGY_APP = simulator;
        }
    });
  </script>
  @include('frontend.partials.rdv-modal')
</body>
</html>
