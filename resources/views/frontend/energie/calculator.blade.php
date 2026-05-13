<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Calculateur Energie - AIAE') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
   <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL_Clr.png') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    /* Charte Graphique AIAE simplifiée */
    :root {
      --bleu: #0E1540;
      --vert: #05482C;
      --orange: #CC6A00;
      --bg-page: #f0f4f8;
    }
    body { font-family: 'Inter', sans-serif; background-color: var(--bg-page); color: #1e293b; }
    .mono { font-family: 'JetBrains Mono', monospace; }
    
    /* Composants UI personnalisés */
    .card { background: white; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; overflow: hidden; }
    .btn-primary { background: var(--orange); color: white; transition: 0.2s; }
    .btn-primary:hover { filter: brightness(1.1); transform: translateY(-1px); }
    .tab-active { border-bottom: 3px solid var(--orange); color: var(--bleu); font-weight: 600; }
    .tab-inactive { color: #64748b; }
    .input-field { width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: 0.2s; }
    .input-field:focus { border-color: var(--orange); ring: 2px solid #ffedc2; }
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>
<body>

<div id="root"></div>

<?php
$calcTranslations = [
    'Calculateur Energie - AIAE' => __('Calculateur Energie - AIAE'),
    'Climatiseur 1 CV' => __('Climatiseur 1 CV'),
    'Réfrigérateur A+' => __('Réfrigérateur A+'),
    'Télévision LED' => __('Télévision LED'),
    'Éclairage LED' => __('Éclairage LED'),
    'Demande de devis formel' => __('Demande de devis formel'),
    'Laissez-nous vos coordonnées pour recevoir votre devis détaillé basé sur cette configuration solaire.' => __('Laissez-nous vos coordonnées pour recevoir votre devis détaillé basé sur cette configuration solaire.'),
    'Nom Complet *' => __('Nom Complet *'),
    'Email *' => __('Email *'),
    'Téléphone *' => __('Téléphone *'),
    'Ville du projet (ex: Lomé)' => __('Ville du projet (ex: Lomé)'),
    'Envoyer ma demande' => __('Envoyer ma demande'),
    'Annuler' => __('Annuler'),
    'Veuillez remplir les champs obligatoires' => __('Veuillez remplir les champs obligatoires'),
    'DEMANDE DE DEVIS - SYSTÈME SOLAIRE AIAE' => __('DEMANDE DE DEVIS - SYSTÈME SOLAIRE AIAE'),
    'Configuration :' => __('Configuration :'),
    'Mode :' => __('Mode :'),
    'Consommation estimée :' => __('Consommation estimée :'),
    'Panneaux recommandés :' => __('Panneaux recommandés :'),
    'Batteries recommandées :' => __('Batteries recommandées :'),
    'Puissance Onduleur :' => __('Puissance Onduleur :'),
    'Inventaire :' => __('Inventaire :'),
    'Génération en cours...' => __('Génération en cours...'),
    'Demande envoyée !' => __('Demande envoyée !'),
    'Oups...' => __('Oups...'),
    "Erreur lors de l'envoi" => __("Erreur lors de l'envoi"),
    'Simulateur Solaire AIAE' => __('Simulateur Solaire AIAE'),
    'Dimensionnement autonome & Estimation financière' => __('Dimensionnement autonome & Estimation financière'),
    'Retour' => __('Retour'),
    "D'après ma facture" => __("D'après ma facture"),
    "D'après mes appareils" => __("D'après mes appareils"),
    'Montant mensuel électricité' => __('Montant mensuel électricité'),
    'Combien payez-vous en moyenne par mois (CEET/CIE) ?' => __('Combien payez-vous en moyenne par mois (CEET/CIE) ?'),
    'Note :' => __('Note :'),
    'Ce mode estime vos besoins globaux. Pour une précision technique, le mode Appareils est recommandé.' => __('Ce mode estime vos besoins globaux. Pour une précision technique, le mode Appareils est recommandé.'),
    'Inventaire des appareils' => __('Inventaire des appareils'),
    'Total estimé :' => __('Total estimé :'),
    'Utilisation' => __('Utilisation'),
    'h/j' => __('h/j'),
    'Aucun équipement ajouté' => __('Aucun équipement ajouté'),
    'Ajouter un équipement :' => __('Ajouter un équipement :'),
    'Configuration Recommandée' => __('Configuration Recommandée'),
    'Champ Solaire' => __('Champ Solaire'),
    '~' => __('~'),
    'panneaux' => __('panneaux'),
    'de 500Wc' => __('de 500Wc'),
    'Onduleur Hybride' => __('Onduleur Hybride'),
    'Monophasé' => __('Monophasé'),
    'Stockage Lithium' => __('Stockage Lithium'),
    'Autonomie' => __('Autonomie'),
    'Nuit + Secours' => __('Nuit + Secours'),
    'Estimation Budget Clé en Main' => __('Estimation Budget Clé en Main'),
    'Inclut : Matériel, Pose, Protection et Mise en service.' => __('Inclut : Matériel, Pose, Protection et Mise en service.'),
    'Fourchette :' => __('Fourchette :'),
    'Demander un devis formel' => __('Demander un devis formel'),
    'Télécharger la fiche PDF' => __('Télécharger la fiche PDF'),
    'Cette simulation est indicative et non contractuelle.' => __('Cette simulation est indicative et non contractuelle.'),
    // Labels équipements (DB)
    'Ventilateur plafond' => __('Ventilateur plafond'),
    'Téléviseur LED' => __('Téléviseur LED'),
    'Congélateur' => __('Congélateur'),
    'Climatiseur split 1 CV' => __('Climatiseur split 1 CV'),
    'Climatiseur split 2 CV' => __('Climatiseur split 2 CV'),
    'Chauffe-eau électrique' => __('Chauffe-eau électrique'),
    'Machine à laver' => __('Machine à laver'),
    'Fer à repasser' => __('Fer à repasser'),
    'Pompe à eau' => __('Pompe à eau'),
    'Ordinateur + écran' => __('Ordinateur + écran'),
    'Routeur WiFi' => __('Routeur WiFi'),
    'Poste de travail bureau' => __('Poste de travail bureau'),
    'Éclairage LED (pièce)' => __('Éclairage LED (pièce)'),
    'Éclairage bureau (10 m²)' => __('Éclairage bureau (10 m²)'),
    'Climatisation bureau (20 m²)' => __('Climatisation bureau (20 m²)'),
    'Serveur / baie informatique' => __('Serveur / baie informatique'),
    "Pompe d'irrigation (m³/h)" => __("Pompe d'irrigation (m³/h)"),
    'Ventilation volailles (100 m²)' => __('Ventilation volailles (100 m²)'),
    'Climatiseur 1,5 CV' => __('Climatiseur 1,5 CV'),
    'Réfrigérateur' => __('Réfrigérateur'),
    'Climatiseur split 1,5 CV' => __('Climatiseur split 1,5 CV'),
];
?>
<script>
    window.AIAE_ENERGY_CONFIG = {
        equipements: @json($equipements),
        zones: @json($zones)
    };
    window.SIMULATOR_URL = "{{ route('simulator.index') }}";
    window.CONTACT_URL = "{{ route('contact') }}";
    window.AIAE_LOGO_URL = "{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL_Clr.png') }}";

    window.AIAE_TRANSLATIONS = @json($calcTranslations);
    window.AIAE_USER = {
        name: "{{ auth()->check() ? auth()->user()->name : '' }}",
        email: "{{ auth()->check() ? auth()->user()->email : '' }}"
    };
</script>
<script type="text/babel">
@verbatim
  const { useState, useEffect, useMemo, useRef } = React;
  
  const t = (key) => window.AIAE_TRANSLATIONS ? (window.AIAE_TRANSLATIONS[key] || key) : key;

  // COMPOSANT ICONES LUCIDE
  const Icon = ({name, size=20, className="", ...props}) => {
    const iconRef = useRef(null);
    useEffect(() => {
      if (window.lucide && iconRef.current) {
        const kebabName = name.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
        iconRef.current.innerHTML = `<i data-lucide="${kebabName}"></i>`;
        try {
          window.lucide.createIcons({
            attrs: { width: size, height: size, 'stroke-width': 1.5, class: className, stroke: 'currentColor' },
            nameAttr: 'data-lucide'
          });
        } catch (e) { console.error("Lucide error:", e); }
      }
    }, [name, size, className]);
    return <span ref={iconRef} className="inline-flex items-center justify-center" style={{minWidth:size, minHeight:size, lineHeight:0}}></span>;
  };

  // --- DONNÉES DE RÉFÉRENCE ---
  const config = window.AIAE_ENERGY_CONFIG || { equipements: [], zones: [] };
  
  const REFERENTIEL = {
    prixKwhReseau: 140,
    ensoleillement: config.zones?.[0]?.hsp_heures || 4.8, 
    perteSysteme: 0.25,
    ratioBatterie: 1.5,
    prixInstallationWc: 1200,
    
    // Mapping des icônes par code d'équipement (Noms Lucide officiels)
    icons: {
        'clim': 'Snowflake', 'frigo': 'Thermometer', 'congel': 'IceCream', 'tv': 'Tv',
        'eclairage': 'Lightbulb', 'ventilo': 'Wind', 'ordi': 'Laptop', 'pompe': 'Droplets',
        'chauffe_eau': 'Thermometer', 'moteur': 'Zap', 'defaut': 'Zap'
    },

    equipements: config.equipements.map(e => ({
      id: e.code || e.id,
      label: e.designation,
      puis: e.puissance_watts,
      h: e.usage_heures_jour || 8,
      icon: e.code ? e.code.split('_')[0].toLowerCase() : 'Zap'
    }))
  };

  // Fallback si la base est vide
  if (REFERENTIEL.equipements.length === 0) {
    REFERENTIEL.equipements = [
      { id: 'clim1', label: t('Climatiseur 1 CV'), puis: 900, h: 8, icon: 'clim' },
      { id: 'frigo', label: t('Réfrigérateur A+'), puis: 150, h: 12, icon: 'frigo' },
      { id: 'tv', label: t('Télévision LED'), puis: 100, h: 5, icon: 'tv' },
      { id: 'eclairage', label: t('Éclairage LED'), puis: 100, h: 6, icon: 'eclairage' }
    ];
  }

  // --- UTILITAIRES DE FORMATAGE ---
  const fmt = (n) => new Intl.NumberFormat('fr-FR').format(Math.round(n));
  const fmtM = (n) => n >= 1000000 ? (n/1000000).toFixed(2) + ' M' : fmt(n);

  const App = () => {
    // État principal
    const [mode, setMode] = useState('facture'); // 'facture' ou 'equipements'
    const [factureMensuelle, setFactureMensuelle] = useState(50000);
    const [monInventaire, setMonInventaire] = useState([
      { ...REFERENTIEL.equipements[0], qty: 1 }, // Défaut: 1 Clim
      { ...REFERENTIEL.equipements[3], qty: 1 }, // Défaut: 1 Frigo
      { ...REFERENTIEL.equipements[6], qty: 1 }, // Défaut: Lumières
    ]);

    // --- MOTEUR DE CALCUL ---
    const resultats = useMemo(() => {
      let consoJournaliereWh = 0;
      let puissanceCreteW = 0; // Puissance instantanée max nécessaire

      if (mode === 'facture') {
        // Méthode 1: Rétro-ingénierie depuis la facture
        const kwhMois = factureMensuelle / REFERENTIEL.prixKwhReseau;
        consoJournaliereWh = (kwhMois * 1000) / 30;
        // Estimation de la pointe (empirique : on estime que 20% des appareils tournent en même temps au max, ou ratio fixe)
        puissanceCreteW = consoJournaliereWh / 4; // Ratio approximatif pour dimensionner l'onduleur
      } else {
        // Méthode 2: Somme des équipements
        monInventaire.forEach(item => {
          consoJournaliereWh += item.puis * item.qty * item.h;
          // On considère un facteur de simultanéité de 70% pour la pointe
          puissanceCreteW += item.puis * item.qty * 0.7;
        });
      }

      // Dimensionnement Solaire (Panneaux)
      // Formule : Besoin / (Ensoleillement * (1 - Pertes))
      const besoinPanneauxWc = consoJournaliereWh / (REFERENTIEL.ensoleillement * (1 - REFERENTIEL.perteSysteme));
      
      // Dimensionnement Batteries (Stockage)
      // On vise à couvrir 50% de la conso la nuit + réserve de sécurité
      const besoinBatterieWh = (consoJournaliereWh * 0.5) * REFERENTIEL.ratioBatterie;

      // Estimation Prix
      // Prix dégressif selon la taille
      let coutEstime = besoinPanneauxWc * REFERENTIEL.prixInstallationWc;
      // Ajout part fixe (tableau, câblage de base)
      coutEstime += 500000;
      // Ajout coût batterie (lithium estimé à 250F/Wh)
      coutEstime += besoinBatterieWh * 250;

      return {
        consoKwhJ: consoJournaliereWh / 1000,
        puissanceOnduleur: Math.ceil((puissanceCreteW * 1.2) / 1000), // +20% marge sécu
        panneauxKwc: (besoinPanneauxWc / 1000).toFixed(1),
        batteriesKwh: (besoinBatterieWh / 1000).toFixed(1),
        coutMin: Math.round(coutEstime * 0.9),
        coutMax: Math.round(coutEstime * 1.15)
      };
    }, [mode, factureMensuelle, monInventaire]);

    // --- GESTIONNAIRES D'ÉVÉNEMENTS ---
    const ajouterEquipement = (id) => {
      const ref = REFERENTIEL.equipements.find(e => e.id === id);
      const existe = monInventaire.find(e => e.id === id);
      if (existe) {
        setMonInventaire(monInventaire.map(e => e.id === id ? { ...e, qty: e.qty + 1 } : e));
      } else {
        setMonInventaire([...monInventaire, { ...ref, qty: 1 }]);
      }
    };

    const retirerEquipement = (id) => {
      setMonInventaire(monInventaire.filter(e => e.id !== id));
    };

    const changerQte = (id, delta) => {
      setMonInventaire(monInventaire.map(e => {
        if (e.id === id) return { ...e, qty: Math.max(1, e.qty + delta) };
        return e;
      }));
    };

    const changerHeures = (id, val) => {
      setMonInventaire(monInventaire.map(e => {
        if (e.id === id) return { ...e, h: Math.min(24, Math.max(0, parseFloat(val))) };
        return e;
      }));
    };

    const fetchCsrfToken = () => {
      const token = document.querySelector('meta[name="csrf-token"]');
      return token ? token.getAttribute('content') : '';
    };

    const handleQuoteRequest = () => {
      window.location.href = window.CONTACT_URL;
    };

    return (
      <div className="min-h-screen py-8 px-4 md:px-8 max-w-6xl mx-auto">
        
        {/* EN-TÊTE */}
        <header className="flex items-center justify-between mb-10 no-print">
          <div className="flex items-center gap-4">
            <img src={window.AIAE_LOGO_URL} className="w-12 h-12 object-contain" alt="AIAE Logo" />
            <div>
              <h1 className="text-2xl font-bold" style={{color: 'var(--bleu)'}}>{t('Simulateur Solaire AIAE')}</h1>
              <p className="text-gray-500 text-sm">{t('Dimensionnement autonome & Estimation financière')}</p>
            </div>
          </div>
          <a href={window.SIMULATOR_URL} className="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors flex items-center gap-2">
            <Icon name="ArrowLeft" size={16} /> {t('Retour')}
          </a>
        </header>

        <div className="grid lg:grid-cols-12 gap-8">
          
          {/* COLONNE GAUCHE : SAISIE (7/12) */}
          <div className="lg:col-span-7 space-y-6">
            
            {/* SÉLECTEUR DE MODE */}
            <div className="card p-2 flex">
              <button 
                onClick={() => setMode('facture')}
                className={`flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all flex items-center justify-center gap-2 ${mode === 'facture' ? 'bg-white text-[var(--orange)] shadow-sm' : 'text-gray-500 hover:bg-white/50'}`}
                style={mode === 'facture' ? {border: '1px solid #fed7aa'} : {}}
              >
                <Icon name="Receipt" size={18} /> {t("D'après ma facture")}
              </button>
              <button 
                onClick={() => setMode('equipements')}
                className={`flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all flex items-center justify-center gap-2 ${mode === 'equipements' ? 'bg-white text-[var(--orange)] shadow-sm' : 'text-gray-500 hover:bg-white/50'}`}
                style={mode === 'equipements' ? {border: '1px solid #fed7aa'} : {}}
              >
                <Icon name="Settings" size={18} /> {t("D'après mes appareils")}
              </button>
            </div>

            {/* CONTENU MODE FACTURE */}
            {mode === 'facture' && (
              <div className="card p-6 animate-fade-in">
                <h2 className="text-lg font-bold mb-4">{t('Montant mensuel électricité')}</h2>
                <label className="block text-sm text-gray-500 mb-2">{t('Combien payez-vous en moyenne par mois (CEET/CIE) ?')}</label>
                <div className="flex items-center gap-4">
                  <input 
                    type="range" 
                    min="5000" max="500000" step="5000" 
                    value={factureMensuelle} 
                    onChange={(e) => setFactureMensuelle(Number(e.target.value))}
                    className="flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[var(--orange)]"
                  />
                  <div className="w-40">
                    <div className="relative">
                      <input 
                        type="number" 
                        value={factureMensuelle} 
                        onChange={(e) => setFactureMensuelle(Number(e.target.value))}
                        className="input-field text-right font-bold mono text-lg pr-12"
                      />
                      <span className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">FCFA</span>
                    </div>
                  </div>
                </div>
                <div className="mt-4 p-4 bg-orange-50 rounded-lg border border-orange-100 text-sm text-orange-800">
                  <p> <strong>{t('Note :')}</strong> {t('Ce mode estime vos besoins globaux. Pour une précision technique, le mode Appareils est recommandé.')}</p>
                </div>
              </div>
            )}

            {/* CONTENU MODE ÉQUIPEMENTS */}
            {mode === 'equipements' && (
              <div className="card p-6 animate-fade-in">
                <div className="flex justify-between items-center mb-4">
                  <h2 className="text-lg font-bold">{t('Inventaire des appareils')}</h2>
                  <div className="text-xs bg-gray-100 px-2 py-1 rounded">{t('Total estimé :')} {fmt(resultats.consoKwhJ)} kWh/j</div>
                </div>

                {/* Liste active */}
                <div className="space-y-3 mb-6">
                  {monInventaire.map((item, index) => (
                    <div key={index} className="flex items-center gap-3 p-3 border rounded-lg bg-white hover:border-[var(--vert)] transition-colors shadow-sm">
                      <div className="w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center text-[var(--vert)]">
                        <Icon name={REFERENTIEL.icons[item.icon] || 'Zap'} size={20} />
                      </div>
                      <div className="flex-1">
                        <div className="font-semibold text-sm text-[var(--bleu)]">{t(item.label) || item.label}</div>
                        <div className="text-xs text-gray-400">{item.puis} W</div>
                      </div>
                      
                      {/* Contrôle Heures */}
                      <div className="flex flex-col items-center px-2 border-l border-r border-gray-100">
                        <label className="text-[10px] text-gray-500 uppercase font-bold tracking-tight">{t('Utilisation')}</label>
                        <div className="flex items-center gap-1">
                            <input 
                              type="number" min="0" max="24" step="0.5"
                              value={item.h} 
                              onChange={(e) => changerHeures(item.id, e.target.value)}
                              className="w-10 text-center font-bold text-sm bg-transparent outline-none"
                            />
                            <span className="text-[10px] text-gray-400">{t('h/j')}</span>
                        </div>
                      </div>

                      {/* Contrôle Quantité */}
                      <div className="flex items-center gap-1 bg-gray-50 rounded-lg p-1">
                        <button onClick={() => changerQte(item.id, -1)} className="w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm hover:text-red-500 transition-colors">
                          <Icon name="Minus" size={12} />
                        </button>
                        <span className="w-6 text-center text-sm font-bold text-[var(--bleu)]">{item.qty}</span>
                        <button onClick={() => changerQte(item.id, 1)} className="w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm hover:text-[var(--vert)] transition-colors">
                          <Icon name="Plus" size={12} />
                        </button>
                      </div>

                      <button onClick={() => retirerEquipement(item.id)} className="text-gray-300 hover:text-red-500 transition-colors ml-1">
                        <Icon name="Trash2" size={16} />
                      </button>
                    </div>
                  ))}
                  {monInventaire.length === 0 && <div className="text-center py-8 text-gray-400 border-2 border-dashed rounded-lg">{t('Aucun équipement ajouté')}</div>}
                </div>

                {/* Ajout rapide */}
                <div>
                  <label className="text-sm font-semibold text-gray-700 block mb-2">{t('Ajouter un équipement :')}</label>
                  <div className="flex flex-wrap gap-2">
                    {REFERENTIEL.equipements.filter(e => !monInventaire.find(m => m.id === e.id)).map(e => (
                      <button 
                        key={e.id}
                        onClick={() => ajouterEquipement(e.id)}
                        className="px-3 py-1.5 text-xs bg-white hover:bg-[var(--vert)] hover:text-white rounded-lg border border-gray-200 transition-all flex items-center gap-2 shadow-sm"
                      >
                        <Icon name={REFERENTIEL.icons[e.icon] || 'Plus'} size={12} /> {t(e.label) || e.label}
                      </button>
                    ))}
                  </div>
                </div>
              </div>
            )}
          </div>

          {/* COLONNE DROITE : RÉSULTATS (5/12) */}
          <div className="lg:col-span-5">
            <div className="sticky top-6 space-y-4">
              
              {/* CARTE RÉSULTAT TECHNIQUE */}
              <div className="card p-6" style={{background: 'var(--bleu)', color: 'white'}}>
                <h3 className="text-orange-400 text-sm font-bold uppercase tracking-wider mb-6">{t('Configuration Recommandée')}</h3>
                
                <div className="space-y-6">
                  {/* Solaire */}
                  <div className="flex items-center justify-between border-b border-white/10 pb-4">
                    <div className="flex items-center gap-3">
                      <div className="w-10 h-10 rounded-full bg-orange-400/20 flex items-center justify-center text-orange-400">
                        <Icon name="Sun" size={20} />
                      </div>
                      <div>
                        <div className="text-xs text-gray-400 uppercase font-bold tracking-wider">{t('Champ Solaire')}</div>
                        <div className="font-bold text-lg">{resultats.panneauxKwc} kWc</div>
                      </div>
                    </div>
                    <div className="text-right text-xs text-gray-500">{t('~')}{Math.ceil(resultats.panneauxKwc * 2)} {t('panneaux')}<br/>{t('de 500Wc')}</div>
                  </div>

                  {/* Onduleur */}
                  <div className="flex items-center justify-between border-b border-white/10 pb-4">
                    <div className="flex items-center gap-4">
                      <div className="w-10 h-10 rounded-full bg-blue-400/20 flex items-center justify-center text-blue-400">
                        <Icon name="Cpu" size={20} />
                      </div>
                      <div>
                        <div className="text-xs text-gray-400 uppercase font-bold tracking-wider">{t('Onduleur Hybride')}</div>
                        <div className="font-bold text-lg">{resultats.puissanceOnduleur} kVA</div>
                      </div>
                    </div>
                    <div className="text-[10px] bg-blue-500/20 text-blue-300 px-2 py-1 rounded-full border border-blue-500/30 uppercase font-bold">{t('Monophasé')}</div>
                  </div>

                  {/* Batteries */}
                  <div className="flex items-center justify-between">
                    <div className="flex items-center gap-4">
                      <div className="w-10 h-10 rounded-full bg-green-400/20 flex items-center justify-center text-green-400">
                        <Icon name="BatteryCharging" size={20} />
                      </div>
                      <div>
                        <div className="text-xs text-gray-400 uppercase font-bold tracking-wider">{t('Stockage Lithium')}</div>
                        <div className="font-bold text-lg">{resultats.batteriesKwh} kWh</div>
                      </div>
                    </div>
                    <div className="text-right text-xs text-gray-500">{t('Autonomie')}<br/><span className="text-green-400">{t('Nuit + Secours')}</span></div>
                  </div>
                </div>
              </div>

              {/* CARTE ESTIMATION FINANCIÈRE */}
              <div className="card p-6 border-t-4 border-[var(--orange)]">
                <h3 className="font-bold text-gray-800 mb-2">{t('Estimation Budget Clé en Main')}</h3>
                <p className="text-xs text-gray-500 mb-4">{t('Inclut : Matériel, Pose, Protection et Mise en service.')}</p>
                
                <div className="text-center py-4 bg-gray-50 rounded-lg mb-4">
                  <div className="text-3xl font-bold mono" style={{color:'var(--bleu)'}}>{fmtM((resultats.coutMin + resultats.coutMax)/2)} F</div>
                  <div className="text-xs text-gray-400 mt-1">{t('Fourchette :')} {fmtM(resultats.coutMin)} - {fmtM(resultats.coutMax)} FCFA</div>
                </div>

                <div className="space-y-2">
                  <button onClick={handleQuoteRequest} className="btn-primary w-full py-3 rounded-xl font-bold uppercase tracking-wide shadow-lg shadow-orange-200 flex items-center justify-center gap-2">
                    {t('Demander un devis formel')}
                  </button>
                  <button onClick={() => window.print()} className="w-full py-3 text-sm text-gray-500 hover:text-[var(--bleu)] transition-colors flex items-center justify-center gap-2">
                    <Icon name="Download" size={14} /> {t('Télécharger la fiche PDF')}
                  </button>
                </div>
              </div>

              {/* NOTE DE BAS DE PAGE */}
              <div className="text-xs text-gray-400 text-center leading-relaxed">
                {t('Cette simulation est indicative et non contractuelle.')}
              </div>

            </div>
          </div>
        </div>
      </div>
    );
  };

  ReactDOM.createRoot(document.getElementById('root')).render(<App />);
@endverbatim
</script>

</body>
</html>
