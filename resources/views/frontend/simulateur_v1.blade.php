<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Simulateur AIAE - Estimation Construction') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
   <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL.png') }}">
  <style>
    @font-face { font-family: "Futura"; src: url("/aiae-frontend/fonts/FuturaStdLight.otf"); font-weight: 300; }
    @font-face { font-family: "Futura"; src: url("/aiae-frontend/fonts/FuturaStdMedium.otf"); font-weight: 500; }
    @font-face { font-family: "Futura"; src: url("/aiae-frontend/fonts/FuturaStdBold.otf"); font-weight: 700; }
    @font-face { font-family: "Futura"; src: url("/aiae-frontend/fonts/FuturaStdHeavy.otf"); font-weight: 800; }
    :root{--bleu:#0E1540;--vert:#05482C;--orange:#CC6A00}
    body{margin:0;font-family:'Futura',sans-serif;background:#f8fafc}
    *{box-sizing:border-box}
    .mono{font-family:'JetBrains Mono',monospace}
    @media print{.no-print{display:none!important}body{background:white}}
    .card{background:white;border:1px solid #e2e8f0;border-radius:12px}
    .btn-primary{background:var(--orange);color:white;padding:12px 24px;border-radius:8px;font-weight:600;cursor:pointer;border:none}
    .btn-primary:hover{filter:brightness(1.1)}
    .btn-primary:disabled{background:#e5e7eb;color:#9ca3af;cursor:not-allowed}
    .input-num{display:flex;align-items:center;background:white;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden}
    .input-num button{width:40px;height:40px;border:none;background:#f8fafc;cursor:pointer;font-size:18px}
    .input-num button:hover{background:#e2e8f0}
    .input-num .value{flex:1;text-align:center;font-weight:600;font-family:'JetBrains Mono',monospace;min-width:60px}
    .input-num input::-webkit-outer-spin-button,
    .input-num input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .input-num input[type=number] {
      -moz-appearance: textfield;
    }
    .option-btn{padding:16px;border:2px solid #e2e8f0;border-radius:10px;text-align:left;cursor:pointer;transition:all 0.2s;background:white}
    .option-btn:hover{border-color:#cbd5e1;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1)}
    .option-btn.selected{border-color:var(--bleu);background:#f0f7ff}
    .warn-box{background:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:0 8px 8px 0}
    .alert-box{background:#fee2e2;border-left:4px solid #ef4444;padding:12px 16px;border-radius:0 8px 8px 0}
    .info-box{background:#f0f7ff;border-left:4px solid var(--bleu);padding:12px 16px;border-radius:0 8px 8px 0}
    .success-box{background:#f0fdf4;border-left:4px solid var(--vert);padding:12px 16px;border-radius:0 8px 8px 0}
    .badge{display:inline-flex;align-items:center;padding:4px 10px;border-radius:6px;font-size:12px;font-weight:600}
    .badge-blue{background:#e0e7ff;color:var(--bleu)}
    .badge-green{background:#dcfce7;color:var(--vert)}
    .badge-orange{background:#ffedd5;color:var(--orange)}
    .badge-red{background:#fee2e2;color:#b91c1c}
    .badge-gray{background:#f3f4f6;color:#374151}
    .optimal-ring{box-shadow:0 0 0 3px rgba(34,197,94,0.4)}
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>
<body>
@php
$simTranslations =[
    'Simulateur AIAE - Estimation Construction' => __('Simulateur AIAE - Estimation Construction'),
    'Simulateur d\'Estimation' => __('Simulateur d\'Estimation'),
    'Sélectionnez votre secteur' => __('Sélectionnez votre secteur'),
    'Résidentiel' => __('Résidentiel'),
    'Villas, immeubles' => __('Villas, immeubles'),
    'Tertiaire' => __('Tertiaire'),
    'Bureaux, hôtels' => __('Bureaux, hôtels'),
    'Industriel' => __('Industriel'),
    'Usines, entrepôts' => __('Usines, entrepôts'),
    'Agricole' => __('Agricole'),
    'Élevage, stockage' => __('Élevage, stockage'),
    'Simulateur v' => __('Simulateur v'),
    'Nouveau' => __('Nouveau'),
    'Retour' => __('Retour'),
    'Continuer' => __('Continuer'),
    'Demander un devis' => __('Demander un devis'),
    'Chargement...' => __('Chargement...'),
    'Type de projet' => __('Type de projet'),
    'Secteur:' => __('Secteur:'),
    'Type de bâtiment' => __('Type de bâtiment'),
    'Niveau de standing' => __('Niveau de standing'),
    'Classification hôtelière' => __('Classification hôtelière'),
    'Caractéristiques du terrain' => __('Caractéristiques du terrain'),
    'Forme et dimensions' => __('Forme et dimensions'),
    'Carré' => __('Carré'),
    'Rectangle' => __('Rectangle'),
    'Irrégulier' => __('Irrégulier'),
    'Côté' => __('Côté'),
    'Longueur' => __('Longueur'),
    'Largeur' => __('Largeur'),
    'Surface' => __('Surface'),
    'Périmètre' => __('Périmètre'),
    'Disponibilité' => __('Disponibilité'),
    'Disponible' => __('Disponible'),
    'En option' => __('En option'),
    'À acquérir' => __('À acquérir'),
    'Note:' => __('Note:'),
    'Coût d\'acquisition estimé selon la zone.' => __('Coût d\'acquisition estimé selon la zone.'),
    'Zone géographique' => __('Zone géographique'),
    'Type de sol' => __('Type de sol'),
    'Portance:' => __('Portance:'),
    'Sol à risque' => __('Sol à risque'),
    'Étude géotechnique G2 obligatoire.' => __('Étude géotechnique G2 obligatoire.'),
    'Coefficient total:' => __('Coefficient total:'),
    'Configuration du bâtiment' => __('Configuration du bâtiment'),
    'Niveaux' => __('Niveaux'),
    'Niveaux hors sol' => __('Niveaux hors sol'),
    'Sous-sols' => __('Sous-sols'),
    'HSP RDC' => __('HSP RDC'),
    'HSP Étages' => __('HSP Étages'),
    'Synthèse technique' => __('Synthèse technique'),
    'Emprise au sol' => __('Emprise au sol'),
    'Surface plancher' => __('Surface plancher'),
    'Hauteur totale' => __('Hauteur totale'),
    'Géotech.' => __('Géotech.'),
    'Configuration hôtel' => __('Configuration hôtel'),
    'Chambres' => __('Chambres'),
    'Ascenseurs' => __('Ascenseurs'),
    'Configuration industrielle' => __('Configuration industrielle'),
    'Hauteur libre' => __('Hauteur libre'),
    'Quais' => __('Quais'),
    'Pont roulant' => __('Pont roulant'),
    'Capacité' => __('Capacité'),
    'Groupe froid' => __('Groupe froid'),
    'Non' => __('Non'),
    'Positif' => __('Positif'),
    'Négatif' => __('Négatif'),
    'Élevage' => __('Élevage'),
    'Sujets' => __('Sujets'),
    'Têtes' => __('Têtes'),
    'Équipements et options' => __('Équipements et options'),
    'Sécurité et aménagements extérieurs' => __('Sécurité et aménagements extérieurs'),
    'Sécurité' => __('Sécurité'),
    'Alarme' => __('Alarme'),
    'Zones' => __('Zones'),
    'Vidéosurveillance' => __('Vidéosurveillance'),
    'Contrôle accès' => __('Contrôle accès'),
    'Badge' => __('Badge'),
    'Biométrique' => __('Biométrique'),
    'Portes' => __('Portes'),
    'Nombre' => __('Nombre'),
    'Obligatoire si ERP et R+1' => __('Obligatoire si ERP et R+1'),
    'Extérieurs' => __('Extérieurs'),
    'Clôture' => __('Clôture'),
    'Portail' => __('Portail'),
    'Piscine' => __('Piscine'),
    'Forage' => __('Forage'),
    'Profondeur' => __('Profondeur'),
    'Parking' => __('Parking'),
    'Ext.' => __('Ext.'),
    'Couvert' => __('Couvert'),
    'Sous.' => __('Sous.'),
    'Places' => __('Places'),
    'Récapitulatif et estimation' => __('Récapitulatif et estimation'),
    'Besoins énergétiques - Propositions - Estimation' => __('Besoins énergétiques - Propositions - Estimation'),
    'Imprimer' => __('Imprimer'),
    'Synthèse du projet' => __('Synthèse du projet'),
    'Type' => __('Type'),
    'Terrain' => __('Terrain'),
    'Durée estimée' => __('Durée estimée'),
    'mois' => __('mois'),
    'Plain-pied' => __('Plain-pied'),
    'Besoins énergétiques calculés' => __('Besoins énergétiques calculés'),
    'Éclairage' => __('Éclairage'),
    'Prises' => __('Prises'),
    'Climatisation' => __('Climatisation'),
    'Eau chaude' => __('Eau chaude'),
    'Cuisine pro' => __('Cuisine pro'),
    'Spa' => __('Spa'),
    'Électroménager' => __('Électroménager'),
    'Pompe forage' => __('Pompe forage'),
    'Irrigation' => __('Irrigation'),
    'Vidéo' => __('Vidéo'),
    'Installation solaire (40-150% couverture)' => __('Installation solaire (40-150% couverture)'),
    'Pas d\'installation solaire' => __('Pas d\'installation solaire'),
    'Optimal' => __('Optimal'),
    'Couvre:' => __('Couvre:'),
    'Non couvert:' => __('Non couvert:'),
    'Groupe électrogène (40-150% couverture)' => __('Groupe électrogène (40-150% couverture)'),
    'Pas de groupe électrogène' => __('Pas de groupe électrogène'),
    'Estimation budgétaire' => __('Estimation budgétaire'),
    'Code' => __('Code'),
    'Poste' => __('Poste'),
    'Détail' => __('Détail'),
    'Montant' => __('Montant'),
    'Estimation totale projet' => __('Estimation totale projet'),
    'Fourchette basse (-10%)' => __('Fourchette basse (-10%)'),
    'Fourchette haute (+15%)' => __('Fourchette haute (+15%)'),
    'Durée estimée:' => __('Durée estimée:'),
    'Catégorie:' => __('Catégorie:'),
    'Géotechnique:' => __('Géotechnique:'),
    'Avertissement' => __('Avertissement'),
    'Cette estimation est indicative et basée sur les paramètres saisis. Une étude détaillée sera réalisée pour l\'établissement du devis définitif. Les prix peuvent varier selon la conjoncture du marché.' => __('Cette estimation est indicative et basée sur les paramètres saisis. Une étude détaillée sera réalisée pour l\'établissement du devis définitif. Les prix peuvent varier selon la conjoncture du marché.'),
    'Succès !' => __('Succès !'),
    'Votre simulation a été enregistrée avec succès.' => __('Votre simulation a été enregistrée avec succès.'),
    'Erreur' => __('Erreur'),
    'Une erreur est survenue lors de l\'enregistrement.' => __('Une erreur est survenue lors de l\'enregistrement.'),
    'Acquisition foncière' => __('Acquisition foncière'),
    'Études et honoraires' => __('Études et honoraires'),
    'Architecture, structure, géotechnique' => __('Architecture, structure, géotechnique'),
    'Terrassements et fondations' => __('Terrassements et fondations'),
    'À définir' => __('À définir'),
    'Gros œuvre' => __('Gros œuvre'),
    'Structure, maçonnerie, planchers' => __('Structure, maçonnerie, planchers'),
    'Second œuvre' => __('Second œuvre'),
    'Menuiseries, cloisons, plâtrerie' => __('Menuiseries, cloisons, plâtrerie'),
    'Lots techniques' => __('Lots techniques'),
    'Électricité, plomberie, CVC' => __('Électricité, plomberie, CVC'),
    'Finitions' => __('Finitions'),
    'Revêtements, peinture, sanitaires' => __('Revêtements, peinture, sanitaires'),
    'Équipements spécifiques' => __('Équipements spécifiques'),
    'Ascenseurs, quais, pont, froid' => __('Ascenseurs, quais, pont, froid'),
    'Énergie' => __('Énergie'),
    'Alarme, vidéo, contrôle accès' => __('Alarme, vidéo, contrôle accès'),
    'VRD et aménagements' => __('VRD et aménagements'),
    'Clôture, portail, piscine, parking' => __('Clôture, portail, piscine, parking'),
    'Provisions aléas' => __('Provisions aléas'),
    '5% recommandé' => __('5% recommandé'),
    'Référentiel Décembre 2025' => __('Référentiel Décembre 2025'),
    'Économique et fonctionnel' => __('Économique et fonctionnel'),
    'Qualité-prix optimal' => __('Qualité-prix optimal'),
    'Excellence et personnalisation' => __('Excellence et personnalisation'),
    'Luxe sans compromis' => __('Luxe sans compromis'),
    'Standard' => __('Standard'),
    'Confort' => __('Confort'),
    'Premium' => __('Premium'),
    'Prestige' => __('Prestige'),
    'Villa individuelle' => __('Villa individuelle'),
    'Immeuble résidentiel' => __('Immeuble résidentiel'),
    'Résidence de standing' => __('Résidence de standing'),
    'Bureaux' => __('Bureaux'),
    'Commerce' => __('Commerce'),
    'Hôtel' => __('Hôtel'),
    'Clinique' => __('Clinique'),
    'Entrepôt' => __('Entrepôt'),
    'Usine' => __('Usine'),
    'Atelier' => __('Atelier'),
    'Chambre froide' => __('Chambre froide'),
    'Hangar' => __('Hangar'),
    'Élevage bovins' => __('Élevage bovins'),
    'Volailles' => __('Volailles'),
    'Serres' => __('Serres'),
    'Silos' => __('Silos'),
    'Non déterminé' => __('Non déterminé'),
    'Ferralitique (Terre de barre)' => __('Ferralitique (Terre de barre)'),
    'Ferrugineux tropical' => __('Ferrugineux tropical'),
    'Latérite / Cuirasse' => __('Latérite / Cuirasse'),
    'Argileux' => __('Argileux'),
    'Sableux' => __('Sableux'),
    'Hydromorphe' => __('Hydromorphe'),
    'Rocheux' => __('Rocheux'),
    'À définir après étude' => __('À définir après étude'),
    'Semelles filantes' => __('Semelles filantes'),
    'Semelles renforcées' => __('Semelles renforcées'),
    'Semelles réduites' => __('Semelles réduites'),
    'Radier ou pieux' => __('Radier ou pieux'),
    'Semelles + compactage' => __('Semelles + compactage'),
    'Pieux profonds' => __('Pieux profonds'),
    'Ancrages roche' => __('Ancrages roche'),
    // Reference Data from Database
    'Duplex / Triplex' => __('Duplex / Triplex'),
    'Hangar / Bâtiment agricole' => __('Hangar / Bâtiment agricole'),
    'Qualité Standard' => __('Qualité Standard'),
    'Qualité Confort' => __('Qualité Confort'),
    'Qualité Premium' => __('Qualité Premium'),
    'Qualité Prestige' => __('Qualité Prestige'),
    'Grand Lomé (Lomé, Baguida, Agoè, Adidogomé)' => __('Grand Lomé (Lomé, Baguida, Agoè, Adidogomé)'),
    'Principales villes de la zone' => __('Principales villes de la zone'),
    'Région Maritime (Tsévié, Aného, Vogan, Kpémé)' => __('Région Maritime (Tsévié, Aného, Vogan, Kpémé)'),
    'Région des Plateaux (Atakpamé, Kpalimé, Badou)' => __('Région des Plateaux (Atakpamé, Kpalimé, Badou)'),
    'Région Centrale (Sokodé, Tchamba, Blitta)' => __('Région Centrale (Sokodé, Tchamba, Blitta)'),
    'Région Kara et Savanes (Kara, Dapaong, Mango)' => __('Région Kara et Savanes (Kara, Dapaong, Mango)'),
    'Alarme basique (4 détecteurs)' => __('Alarme basique (4 détecteurs)'),
    'Alarme avancée (6 détect. + GSM)' => __('Alarme avancée (6 détect. + GSM)'),
    'Alarme complète connectée' => __('Alarme complète connectée'),
    '4 caméras HD' => __('4 caméras HD'),
    '8 caméras HD' => __('8 caméras HD'),
    '16 caméras HD' => __('16 caméras HD'),
    'Portail métallique simple 3m' => __('Portail métallique simple 3m'),
    'Portail métallique double 5m' => __('Portail métallique double 5m'),
    'Portail coulissant motorisé 5m' => __('Portail coulissant motorisé 5m'),
    'Piscine béton carrelée 6x3m' => __('Piscine béton carrelée 6x3m'),
    'Piscine béton carrelée 8x4m' => __('Piscine béton carrelée 8x4m'),
    'Piscine béton carrelée 10x5m' => __('Piscine béton carrelée 10x5m'),
    'Piscine à débordement 12x5m' => __('Piscine à débordement 12x5m'),
    'Piscine plage immergée 8x4m' => __('Piscine plage immergée 8x4m'),
];
@endphp
<div id="root"></div>
<script>
    window.INITIAL_SECTEUR = "{{ $secteur ?? '' }}";
    window.SAVE_ROUTE = "{{ route('simulator.save') }}";
    window.BACK_ROUTE = "{{ route('simulator.index') }}";
    window.SIMULATEUR_CONFIG = @json($config);
    window.QUICK_START = @json($quickStart ?? null);
    window.AIAE_SIM_TRANSLATIONS = @json($simTranslations);
    window.LOGO_URL = "{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL_Clr.png') }}";
</script>
<script type="text/babel">
@verbatim
const {useState,useMemo}=React;
const t = (key) => window.AIAE_SIM_TRANSLATIONS ? (window.AIAE_SIM_TRANSLATIONS[key] || key) : key;

const InputNum=({value,onChange,min=0,max=999,step=1,unit='',label=''})=>(
  <div className="flex flex-col">
    {label&&<label className="text-xs text-gray-500 mb-1">{label}</label>}
    <div className="input-num">
      <button onClick={()=>{
        const current = parseFloat(value) || 0;
        const next = Math.max(min, current - step);
        onChange(Math.round(next * 100) / 100);
      }}>−</button>
      <div className="flex-1 flex items-center justify-center min-w-[70px]">
        <input 
          type="number"
          value={value}
          min={min}
          max={max}
          step="any"
          onChange={(e) => {
            const val = e.target.value;
            onChange(val === '' ? '' : parseFloat(val));
          }}
          onBlur={() => {
            let val = parseFloat(value);
            if (isNaN(val)) val = min;
            const rounded = Math.round(val * 100) / 100;
            onChange(Math.min(max, Math.max(min, rounded)));
          }}
          className="w-full text-center font-semibold font-mono bg-transparent border-none outline-none focus:outline-none focus:ring-0 p-0 text-gray-800"
          style={{ fontFamily: 'JetBrains Mono, monospace' }}
        />
        {unit&&<span className="text-xs text-gray-500 mr-2">{unit}</span>}
      </div>
      <button onClick={()=>{
        const current = parseFloat(value) || 0;
        const next = Math.min(max, current + step);
        onChange(Math.round(next * 100) / 100);
      }}>+</button>
    </div>
  </div>
);

const App=()=>{
  const VERSION='8.1';
  
  // COMPOSANT ICONES LUCIDE (Approche ultra-robuste via createIcons)
  const Icon = ({name, size=20, className="", ...props}) => {
    const iconRef = React.useRef(null);
    
    React.useEffect(() => {
      if (window.lucide && iconRef.current) {
        const kebabName = name.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
        // On injecte un tag <i> que lucide va remplacer
        iconRef.current.innerHTML = `<i data-lucide="${kebabName}"></i>`;
        try {
          window.lucide.createIcons({
            attrs: {
              width: size,
              height: size,
              'stroke-width': 1.5,
              class: className,
              stroke: 'currentColor'
            },
            nameAttr: 'data-lucide'
          });
        } catch (e) {
          console.error("Lucide error:", e);
        }
      }
    }, [name, size, className]);

    return <span ref={iconRef} className="inline-flex items-center justify-center lucide-icon-wrapper" style={{minWidth:size, minHeight:size, lineHeight:0}}></span>;
  };
  
  // DONNÉES RÉFÉRENCE - PRIORITÉ AUX DONNÉES BASE DE DONNÉES
  const libConfig = window.SIMULATEUR_CONFIG || {};

  const ZONES = libConfig.ZONES || {
    zone1:{name:'Zone 1 - Grand Lomé',localites:'Lomé, Baguida, Agoè',coef:1.00,forage:25,foncier:75000},
    zone2:{name:'Zone 2 - Maritime',localites:'Tsévié, Tabligbo, Aného',coef:1.08,forage:35,foncier:25000},
    zone3:{name:'Zone 3 - Plateaux',localites:'Atakpamé, Kpalimé, Badou',coef:1.14,forage:50,foncier:12000},
    zone4:{name:'Zone 4 - Centrale',localites:'Sokodé, Tchamba, Blitta',coef:1.19,forage:60,foncier:6000},
    zone5:{name:'Zone 5 - Kara & Savanes',localites:'Kara, Dapaong, Mango',coef:1.25,forage:75,foncier:4000}
  };

  const SOLS = libConfig.SOLS || {
    inconnu:{name:t('Non déterminé'),coef:1.15,portance:'?',fondation:t('À définir après étude'),prixFond:55000,risque:'moyen'},
    ferralitique:{name:t('Ferralitique (Terre de barre)'),coef:1.00,portance:'1.5-2.5 bars',fondation:t('Semelles filantes'),prixFond:32000,risque:'faible'},
    ferrugineux:{name:t('Ferrugineux tropical'),coef:1.10,portance:'1.0-2.0 bars',fondation:t('Semelles renforcées'),prixFond:38000,risque:'faible'},
    laterite:{name:t('Latérite / Cuirasse'),coef:1.03,portance:'3.0-5.0 bars',fondation:t('Semelles réduites'),prixFond:28000,risque:'faible'},
    argileux:{name:t('Argileux')+' ⚠️',coef:1.30,portance:'0.5-1.5 bars',fondation:t('Radier ou pieux'),prixFond:75000,risque:'élevé'},
    sableux:{name:t('Sableux'),coef:1.18,portance:'1.0-2.0 bars',fondation:t('Semelles + compactage'),prixFond:48000,risque:'moyen'},
    hydromorphe:{name:t('Hydromorphe')+' ⚠️⚠️',coef:1.55,portance:'0.3-1.0 bars',fondation:t('Pieux profonds'),prixFond:120000,risque:'très élevé'},
    rocheux:{name:t('Rocheux'),coef:0.98,portance:'>5 bars',fondation:t('Ancrages roche'),prixFond:25000,risque:'faible'}
  };

  // STANDINGS ET PRIX SYNCHRONISÉS
  const STANDINGS = libConfig.STANDINGS || {
    standard:{name:t('Standard'),desc:t('Économique et fonctionnel'),icon:'Home'},
    confort:{name:t('Confort'),desc:t('Qualité-prix optimal'),icon:'Armchair'},
    premium:{name:t('Premium'),desc:t('Excellence et personnalisation'),icon:'Gem'},
    prestige:{name:t('Prestige'),desc:t('Luxe sans compromis'),icon:'Crown'}
  };
  const STANDINGS_PRIX = {};
  const STANDINGS_HSP = {};
  const STANDINGS_EMPRISE = {};
  Object.entries(STANDINGS).forEach(([k,v]) => {
    STANDINGS_PRIX[k] = v.prix || 500000;
    STANDINGS_HSP[k] = v.hsp || 2.80;
    STANDINGS_EMPRISE[k] = v.emprise || 0.35;
  });

  const TYPES = libConfig.TYPES || {
    residentiel:[
      {id:'villa',name:t('Villa individuelle'),max:3,icon:'Home'},
      {id:'immeuble',name:t('Immeuble résidentiel'),max:10,icon:'Building2'},
      {id:'residence',name:t('Résidence de standing'),max:12,maj:1.15,icon:'Building'}
    ],
    tertiaire:[
      {id:'bureaux',name:t('Bureaux'),max:20,prix:520000,icon:'Briefcase'},
      {id:'commerce',name:t('Commerce'),max:4,prix:450000,icon:'Store'},
      {id:'hotel',name:t('Hôtel'),max:20,prix:625000,icon:'Hotel'},
      {id:'clinique',name:t('Clinique'),max:6,prix:720000,icon:'Hospital'}
    ],
    industriel:[
      {id:'entrepot',name:t('Entrepôt'),max:2,prix:220000,icon:'Box'},
      {id:'usine',name:t('Usine'),max:3,prix:350000,icon:'Factory'},
      {id:'atelier',name:t('Atelier'),max:2,prix:280000,icon:'Wrench'},
      {id:'frigo',name:t('Chambre froide'),max:2,prix:480000,icon:'Snowflake'}
    ],
    agricole:[
      {id:'hangar',name:t('Hangar'),max:1,prix:120000,icon:'Warehouse'},
      {id:'elevage_bovins',name:t('Élevage bovins'),max:1,prix:85000,ratio:8,icon:'Beef'},
      {id:'elevage_volailles',name:t('Volailles'),max:1,prix:45000,ratio:0.1,icon:'Bird'},
      {id:'serres',name:t('Serres'),max:1,prix:65000,icon:'Sprout'},
      {id:'stockage',name:t('Silos'),max:1,prix:150000,icon:'Wheat'}
    ]
  };

  // HÔTELS - SANS PRIX AFFICHÉS
  const HOTELS=[
    {id:'1s',name:'★',surfCh:16},{id:'2s',name:'★★',surfCh:18},{id:'3s',name:'★★★',surfCh:22},
    {id:'4s',name:'★★★★',surfCh:28},{id:'5s',name:'★★★★★',surfCh:35},{id:'palace',name:'Palace',surfCh:50}
  ];
  const HOTELS_PRIX={'1s':430000,'2s':500000,'3s':625000,'4s':800000,'5s':1175000,'palace':2000000};

  const SOLAIRES = libConfig.SOLAIRES ||[];
  const GROUPES = libConfig.GROUPES || [];
  const SECURITE_OPTS = libConfig.SECURITE ||[];
  const EXTERIEUR_OPTS = libConfig.EXTERIEUR ||[];
  const DOMOTIQUE_OPTS = libConfig.DOMOTIQUE ||[];

  // ÉTAT
  const qs = window.QUICK_START || {};
  const initSecteur = qs.secteur || window.INITIAL_SECTEUR || '';
  const fromHomePage = !!qs.standing;
  
  const [page,setPage]=useState(initSecteur ? 'sim' : 'accueil');
  const[etape,setEtape]=useState(initSecteur ? (fromHomePage ? 2 : 1) : 1);
  const [secteur,setSecteur]=useState(initSecteur);
  const[typeBat,setTypeBat]=useState('');
  const [standing,setStanding]=useState(qs.standing || 'confort');
  const [catHotel,setCatHotel]=useState('3s');
  const[forme,setForme]=useState('rect');
  
  const initialSurf = qs.surface || 600;
  const [dimA,setDimA]=useState(Math.sqrt(initialSurf));
  const[dimB,setDimB]=useState(Math.sqrt(initialSurf));
  const[surfManuelle,setSurfManuelle]=useState(initialSurf);
  
  const [terrainDispo,setTerrainDispo]=useState('oui');
  const [zone,setZone]=useState('zone1');
  const[sol,setSol]=useState('');
  const [niveaux,setNiveaux]=useState(1);
  const [ssSol,setSsSol]=useState(0);
  const[hspRdc,setHspRdc]=useState(3.0);
  const[hspEtage,setHspEtage]=useState(2.8);
  const [nbChambres,setNbChambres]=useState(qs.nb_beds ? parseInt(qs.nb_beds) : 3);
  const[espacesHotel,setEspacesHotel]=useState(qs.espaces_communs === "1" ? ['accueil'] : []);
  const SPECIFIQUES = libConfig.SPECIFIQUE || [];

  // Options mapping Logic
  const hasOpt = (key) => qs.options && qs.options.includes(key);

  const [hauteurLibre,setHauteurLibre]=useState(8);
  const [pontRoulant,setPontRoulant]=useState(hasOpt('pont_roulant_5t') || hasOpt('pont_roulant_10t'));
  const [pontCap,setPontCap]=useState(hasOpt('pont_roulant_10t') ? 10 : 5);
  const [groupeFroid,setGroupeFroid]=useState('');
  const [effectif,setEffectif]=useState(100);
  const initIrrigation = hasOpt('irrigation_goutte_a_goutte') ? 'goutte' : (hasOpt('irrigation_aspersion') ? 'aspersion' : '');
  const [irrigation,setIrrigation]=useState(initIrrigation);
  const [surfExploit,setSurfExploit]=useState(5);
  const[nbAsc,setNbAsc]=useState(0);
  const [nbQuais,setNbQuais]=useState(hasOpt('quai_chargement') ? 2 : 0);

  const [solaire,setSolaire]=useState(hasOpt('solaire') ? (SOLAIRES[0]?.id || '') : '');
  const [groupe,setGroupe]=useState('');
  const [alarme,setAlarme]=useState('');
  const [nbZones,setNbZones]=useState(6);
  const [video,setVideo]=useState('');
  const [acces,setAcces]=useState('');
  const [nbPortes,setNbPortes]=useState(2);
  const[cloture,setCloture]=useState(hasOpt('cloture'));
  const[clotureH,setClotureH]=useState(2);
  const [portail,setPortail]=useState('');
  const [piscine,setPiscine]=useState(hasOpt('piscine') ? 'piscine_8x4' : '');
  const [forage,setForage]=useState(hasOpt('forage'));
  const [forageProf,setForageProf]=useState(30);
  const [parkType,setParkType]=useState('');
  const [parkPlaces,setParkPlaces]=useState(0);
  const [isSaving,setIsSaving]=useState(false);

  // CALCULS
  const surface=useMemo(()=>{
    if(forme==='carre')return dimA*dimA;
    if(forme==='rect')return dimA*dimB;
    return surfManuelle;
  },[forme,dimA,dimB,surfManuelle]);

  const perimetre=useMemo(()=>{
    if(forme==='carre')return 4*dimA;
    if(forme==='rect')return 2*(dimA+dimB);
    return Math.sqrt(surfManuelle)*4*1.1;
  },[forme,dimA,dimB,surfManuelle]);

  const typeData=TYPES[secteur]?.find(t=>t.id===typeBat);
  const zoneData=ZONES[zone];
  const solData=SOLS[sol];
  const coefTotal=(zoneData?.coef||1)*(solData?.coef||1.15);

  const emprise=useMemo(()=>{
    if(secteur==='residentiel')return STANDINGS_EMPRISE[standing]||0.35;
    if(secteur==='industriel')return 0.65;
    if(secteur==='agricole')return 0.50;
    return 0.40;
  },[secteur,standing]);

  const surfaceBatie=useMemo(()=>{
    if(secteur==='agricole'&&typeBat?.startsWith('elevage_')){
      return Math.round(effectif*(typeData?.ratio||5)*1.3);
    }
    const empriseAuSol=surface*emprise;
    return Math.round(empriseAuSol*niveaux+ssSol*empriseAuSol*0.85);
  },[surface,emprise,niveaux,ssSol,secteur,typeBat,effectif,typeData]);

  const hauteurTotale=useMemo(()=>{
    const h=hspRdc+0.30+(niveaux>1?(niveaux-1)*(hspEtage+0.25):0);
    return Math.round(h*10)/10+(secteur==='industriel'?1.5:2.5);
  },[hspRdc,hspEtage,niveaux,secteur]);

  const prixM2=useMemo(()=>{
    if(secteur==='residentiel')return(STANDINGS_PRIX[standing]||500000)*(typeData?.maj||1);
    if(secteur==='industriel'){
      let base=typeData?.prix||250000;
      if(hauteurLibre>10)base*=1.12;
      if(pontRoulant)base*=1.15;
      if(typeBat==='chambre_froide')base*=1.25;
      return Math.round(base);
    }
    return typeData?.prix||450000;
  },[secteur,typeBat,standing,typeData,catHotel,hauteurLibre,pontRoulant]);

  // Catégorie
  const categorie=useMemo(()=>{
    let cat='A1';
    let geoOblig=false;
    const motifs=[];
    if(niveaux>4||hauteurTotale>15){cat='B2';geoOblig=true;motifs.push('>R+4');}
    else if(niveaux>2||hauteurTotale>8){cat='A2';geoOblig=true;motifs.push('R+3 ou >8m');}
    if(['commerce','clinique'].includes(typeBat) || typeBat?.startsWith('hotel_')){geoOblig=true;motifs.push('ERP');}
    if(sol==='argileux'||sol==='hydromorphe'){geoOblig=true;motifs.push('Sol risque');}
    if(ssSol>0){geoOblig=true;motifs.push('Sous-sol');}
    return{cat,geoOblig,motifs,mission:geoOblig?(cat==='B2'?'G2 PRO':'G2 AVP'):'G1'};
  },[niveaux,hauteurTotale,typeBat,sol,ssSol]);

  // Durée
  const duree=useMemo(()=>{
    let d=6;
    if(secteur==='residentiel')d=typeBat==='villa'?8:14+(niveaux-2)*1.5;
    else if(secteur==='tertiaire')d=typeBat?.startsWith('hotel_')?18+(niveaux-3)*2:12+(niveaux-2)*1.5;
    else if(secteur==='industriel')d=surfaceBatie>3000?14:surfaceBatie>1500?10:7;
    else if(secteur==='agricole')d=5;
    if(ssSol>0)d+=ssSol*2.5;
    if(sol==='argileux'||sol==='hydromorphe')d+=2;
    return Math.round(Math.max(4,d));
  },[secteur,typeBat,niveaux,ssSol,surfaceBatie,sol]);

  // BESOINS ÉNERGÉTIQUES - CALCULÉS À L'ÉTAPE 5
  const besoins=useMemo(()=>{
    const details=[];
    // Éclairage
    let pEcl=surfaceBatie*(secteur==='industriel'?0.008:secteur==='agricole'?0.005:0.012);
    details.push({label:t('Éclairage'),icon:'Lightbulb',kw:Math.round(pEcl*10)/10,prio:1});
    // Prises
    details.push({label:t('Prises'),icon:'Plug',kw:Math.round(surfaceBatie*0.015*10)/10,prio:2});
    // Clim
    let surfClim=surfaceBatie*(secteur==='industriel'?0.15:secteur==='agricole'?0.10:0.70);
    if(surfClim>0)details.push({label:t('Climatisation'),icon:'Snowflake',kw:Math.round(surfClim*0.10*10)/10,prio:5});
    // Hôtel
    if(typeBat?.startsWith('hotel_')){
      details.push({label:t('Eau chaude'),icon:'ShowerHead',kw:Math.round(nbChambres*0.3*10)/10,prio:4});
      if(espacesHotel.includes('restaurant'))details.push({label:t('Cuisine pro'),icon:'CookingPot',kw:15,prio:6});
      if(espacesHotel.includes('spa'))details.push({label:t('Spa'),icon:'Flower2',kw:12,prio:7});
    }
    if(secteur==='residentiel')details.push({label:t('Électroménager'),icon:'CookingPot',kw:Math.round(surfaceBatie*0.008*10)/10,prio:6});
    // Équipements
    if(nbAsc>0)details.push({label:t('Ascenseurs'),icon:'ArrowUpSquare',kw:Math.round(nbAsc*12*0.15*10)/10,prio:9});
    if(pontRoulant)details.push({label:t('Pont roulant'),icon:'Construction',kw:Math.round((pontCap<=5?15:pontCap<=10?25:40)*0.2*10)/10,prio:10});
    if(typeBat==='chambre_froide'||groupeFroid)details.push({label:t('Groupe froid'),icon:'Snowflake',kw:Math.round(surfaceBatie*(groupeFroid==='negatif'?0.15:0.08)*0.7*10)/10,prio:3});
    // Sécurité
    if(alarme)details.push({label:t('Alarme'),icon:'Bell',kw:0.5,prio:11});
    if(video)details.push({label:t('Vidéo'),icon:'Video',kw:video==='16+'?1.5:0.8,prio:3});
    // Extérieurs
    if(piscine)details.push({label:t('Piscine'),icon:'Waves',kw:piscine==='12x5'?5:3.5,prio:8});
    if(forage)details.push({label:t('Pompe forage'),icon:'Droplets',kw:secteur==='agricole'?5:2,prio:7});
    if(irrigation==='goutte')details.push({label:t('Irrigation'),icon:'Sprout',kw:surfExploit*0.8,prio:7});
    
    details.sort((a,b)=>a.prio-b.prio);
    const total=Math.ceil(details.reduce((s,d)=>s+d.kw,0));
    return{details,total};
  },[surfaceBatie,secteur,typeBat,nbChambres,espacesHotel,nbAsc,pontRoulant,pontCap,groupeFroid,alarme,video,piscine,forage,irrigation,surfExploit]);

  // PROPOSITIONS SOLAIRES 40-150%
  const propositionsSolaires=useMemo(()=>{
    const props=[];
    const besoinTotal=besoins.total;
    if(besoinTotal<=0)return props;
    
    SOLAIRES.forEach(kit=>{
      const couv=(kit.kw/besoinTotal)*100;
      if(couv>=40&&couv<=150){
        let kwRestant=kit.kw;
        const couverts=[];
        const nonCouverts=[];
        
        besoins.details.forEach(eq=>{
          if(kwRestant>=eq.kw){
            couverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());
            kwRestant-=eq.kw;
          }else if(kwRestant>0){
            const pct=Math.round((kwRestant/eq.kw)*100);
            if(pct>=30)couverts.push(`${eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim()} (${pct}%)`);
            else nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());
            kwRestant=0;
          }else{
            nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());
          }
        });
        
        props.push({...kit,couv:Math.round(couv),couverts,nonCouverts,optimal:couv>=95&&couv<=115});
      }
    });
    return props;
  },[besoins]);

  // PROPOSITIONS GROUPES 40-150%
  const propositionsGroupes=useMemo(()=>{
    const props=[];
    const besoinTotal=besoins.total*0.8;
    if(besoinTotal<=0)return props;
    
    GROUPES.forEach(grp=>{
      const puissanceUtile=grp.kva*0.8;
      const couv=(puissanceUtile/besoinTotal)*100;
      if(couv>=40&&couv<=150){
        let kwRestant=puissanceUtile;
        const couverts=[];
        const nonCouverts=[];
        
        besoins.details.forEach(eq=>{
          if(kwRestant>=eq.kw){
            couverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());
            kwRestant-=eq.kw;
          }else{
            nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());
          }
        });
        
        props.push({...grp,couv:Math.round(couv),couverts,nonCouverts,optimal:couv>=95&&couv<=115});
      }
    });
    return props;
  },[besoins]);

  // ESTIMATION
  const estimation=useMemo(()=>{
    if(!surfaceBatie||!sol)return null;
    const postes=[];
    let total=0;
    const add=(code,nom,detail,montant)=>{postes.push({code,nom,detail,montant});total+=montant;};

    // Foncier
    let foncier=0;
    if(terrainDispo!=='oui'){
      foncier=surface*zoneData.foncier;
      postes.push({code:'0',nom:t('Acquisition foncière'),detail:`${Math.round(surface)} m²`,montant:foncier});
    }
    // Études 8%
    add('1',t('Études et honoraires'),t('Architecture, structure, géotechnique'),surfaceBatie*prixM2*coefTotal*0.08);
    // Fondations
    let fond=surface*emprise*(solData?.prixFond||45000);
    if(secteur==='industriel')fond*=1.3;
    if(ssSol>0)fond+=ssSol*surface*emprise*85000;
    add('2',t('Terrassements et fondations'),t(solData?.fondation||'À définir'),fond);
    // Gros œuvre 38%
    add('3',t('Gros œuvre'),t('Structure, maçonnerie, planchers'),surfaceBatie*prixM2*coefTotal*0.38);
    // Second œuvre 25%
    add('4',t('Second œuvre'),t('Menuiseries, cloisons, plâtrerie'),surfaceBatie*prixM2*coefTotal*0.25);
    // Lots techniques 18%
    add('5',t('Lots techniques'),t('Électricité, plomberie, CVC'),surfaceBatie*prixM2*coefTotal*0.18);
    // Finitions 11%
    add('6',t('Finitions'),t('Revêtements, peinture, sanitaires'),surfaceBatie*prixM2*coefTotal*0.11);
    // Équipements
    let equip=0;
    if(nbAsc>0)equip+=nbAsc*(niveaux<=5?28000000:35000000);
    
    if(nbQuais>0&&secteur==='industriel') {
      const optQuai = SPECIFIQUES.find(o => o.id === 'quai_chargement');
      equip += nbQuais * (optQuai ? optQuai.prix : 3500000);
    }
    
    if(pontRoulant) {
      const pRoulantId = pontCap <= 5 ? 'pont_roulant_5t' : 'pont_roulant_10t';
      const optPont = SPECIFIQUES.find(o => o.id === pRoulantId);
      equip += optPont ? optPont.prix : (pontCap<=5?15000000:25000000);
    }
    
    if(groupeFroid)equip+=surfaceBatie*(groupeFroid==='negatif'?95000:55000);
    
    if(irrigation) {
      const irrId = irrigation === 'goutte' ? 'irrigation_goutte_a_goutte' : 'irrigation_aspersion';
      const optIrr = EXTERIEUR_OPTS.find(o => o.id === irrId);
      equip += surfExploit * (optIrr ? optIrr.prix : (irrigation === 'goutte' ? 1500000 : 2500000));
    }

    if(equip>0)add('7',t('Équipements spécifiques'),t('Ascenseurs, quais, pont, froid'),equip);
    // Énergie
    const kitSol = SOLAIRES.find(k => k.id === solaire);
    const grpKva = GROUPES.find(g => g.id === groupe);
    const energie = (kitSol?.prix || 0) + (grpKva?.prix || 0);
    if (energie > 0) add('8', t('Énergie'), `${kitSol ? kitSol.kw + ' kWc' : ''}${grpKva ? ' + ' + grpKva.kva + ' kVA' : ''}`.trim(), energie);

    // Sécurité
    let secu = 0;
    const optAlarme = SECURITE_OPTS.find(o => o.id === alarme);
    const optVideo = SECURITE_OPTS.find(o => o.id === video);
    const optAcces = SECURITE_OPTS.find(o => o.id === acces);
    
    if (optAlarme) secu += optAlarme.prix + (nbZones * 125000); // Zone sup toujours fixe ou à dynamiser plus tard
    if (optVideo) secu += optVideo.prix;
    if (optAcces) secu += optAcces.prix + (nbPortes * 320000);
    
    if (secu > 0) add('9', t('Sécurité'), t('Alarme, vidéo, contrôle accès'), secu);

    // VRD
    let vrd = surface * 8500;
    const optPortail = EXTERIEUR_OPTS.find(o => o.id === portail);
    const optPiscine = EXTERIEUR_OPTS.find(o => o.id === piscine);
    const optForage = EXTERIEUR_OPTS.find(o => o.id.includes('forage')); // On prend le premier forage trouvé ou on affine

    if (cloture) vrd += perimetre * (clotureH <= 2 ? 88000 : 135000);
    if (optPortail) vrd += optPortail.prix;
    if (optPiscine) vrd += optPiscine.prix;
    if (forage) vrd += (forageProf * 95000) + 1200000;
    if (parkPlaces > 0) vrd += parkPlaces * (parkType === 'souterrain' ? 3800000 : parkType === 'couvert' ? 1350000 : 420000);
    
    add('10', t('VRD et aménagements'), t('Clôture, portail, piscine, parking'), vrd);

    // Aléas 5%
    add('11', t('Provisions aléas'), t('5% recommandé'), total * 0.05);

    return{
      postes,foncier,total,
      min:Math.round((foncier+total)*0.90),
      max:Math.round((foncier+total)*1.15),
      prixM2Hors:Math.round(total/surfaceBatie)
    };
  },[surfaceBatie,surface,emprise,prixM2,coefTotal,solData,zoneData,terrainDispo,sol,secteur,ssSol,niveaux,
     nbAsc,nbQuais,pontRoulant,pontCap,groupeFroid,irrigation,surfExploit,solaire,groupe,
     alarme,nbZones,video,acces,nbPortes,cloture,clotureH,perimetre,portail,piscine,forage,forageProf,parkPlaces,parkType]);

  // UTILITAIRES
  const fmt=n=>new Intl.NumberFormat('fr-FR').format(Math.round(n||0));
  const fmtM=n=>n>=1e9?(n/1e9).toFixed(2)+' Mrd':n>=1e6?(n/1e6).toFixed(1)+' M':fmt(n);

  const reset=()=>{
    setSecteur('');setTypeBat('');setStanding('confort');setCatHotel('3s');
    setForme('rect');setDimA(30);setDimB(20);setTerrainDispo('oui');
    setZone('zone1');setSol('');setNiveaux(1);setSsSol(0);
    setNbChambres(30);setEspacesHotel([]);setHauteurLibre(8);setPontRoulant(false);setGroupeFroid('');
    setEffectif(100);setIrrigation('');setNbAsc(0);setSolaire('');setGroupe('');
    setAlarme('');setVideo('');setAcces('');
    setCloture(false);setPortail('');setPiscine('');setForage(false);setParkPlaces(0);
    setEtape(1);setPage('accueil');
  };

  const handleSaveSimulation = async () => {
    setIsSaving(true);
    
    const basePostes =['1', '2', '3', '4', '5', '6'];
    const base_amount = estimation.postes.filter(p => basePostes.includes(p.code)).reduce((s, p) => s + p.montant, 0);
    const options_amount = estimation.postes.filter(p => !basePostes.includes(p.code) && p.code !== '0' && p.code !== '11').reduce((s, p) => s + p.montant, 0);

    const data = {
        secteur, typeBat, standing, zone, sol, niveaux, ssSol,
        dimensions: { surface, surfaceBatie, hauteurTotale },
        besoins: besoins.total, 
        solaire, groupe,
        options: {
            solaire,
            groupe,
            alarme,
            video,
            acces,
            piscine,
            forage: forage ? 'oui' : '',
            cloture: cloture ? 'oui' : ''
        },
        total: estimation.total, 
        base_amount, 
        options_amount,
        postes: estimation.postes
    };

    try {
        const response = await axios.post(window.SAVE_ROUTE, data, {
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        
        if (response.data.status === 'success' || response.data.status === 'guest') {
            await Swal.fire({
                title: t('Succès !'),
                text: t('Votre simulation a été enregistrée avec succès.'),
                icon: 'success',
                confirmButtonColor: 'var(--orange)',
                confirmButtonText: t('Continuer')
            });
            window.location.href = response.data.redirect;
        }
    } catch (error) {
        console.error("Erreur sauvegarde:", error);
        Swal.fire({
            title: t('Erreur'),
            text: t("Une erreur est survenue lors de l'enregistrement."),
            icon: 'error'
        });
    } finally {
        setIsSaving(false);
    }
  };

  const Header=()=>(
    <header className="bg-white border-b sticky top-0 z-50 no-print">
      <div className="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <button onClick={() => window.location.href = '/'} className="flex items-center gap-3">
          <img src={window.LOGO_URL} className="w-12 h-12 object-contain" alt="AIAE Logo" />
        </button>
        <div className="flex items-center gap-4">
          <button onClick={() => window.location.href = '/'} className="text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1.5 font-medium transition-colors">
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
            <span>{t("Accueil")}</span>
          </button>
          <div className="w-px h-4 bg-gray-200" />
          <div className="hidden sm:flex items-center gap-1">
            {[1,2,3,4,5].map(n=>(
              <div key={n} className="flex items-center">
                <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium ${n<etape?'bg-[#05482C] text-white':n===etape?'bg-[#0E1540] text-white':'bg-gray-200 text-gray-500'}`}>
                  {n<etape?'✓':n}
                </div>
                {n<5&&<div className={`w-6 h-0.5 ${n<etape?'bg-[#05482C]':'bg-gray-200'}`}/>}
              </div>
            ))}
          </div>
          <button onClick={reset} className="text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1">
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth={2} d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            <span className="hidden sm:inline">{t('Nouveau')}</span>
          </button>
        </div>
      </div>
    </header>
  );

  const Nav=({canContinue=true})=>(
    <div className="flex justify-between items-center mt-8 pt-6 border-t no-print">
      <button 
        onClick={() => etape > 1 ? setEtape(etape - 1) : (window.location.href = window.BACK_ROUTE)} 
        className="flex items-center gap-2 px-5 py-2.5 text-gray-600 hover:text-gray-800 rounded-lg"
      >
        ← {t('Retour')}
      </button>
      <button 
        onClick={() => etape < 5 ? setEtape(etape + 1) : handleSaveSimulation()} 
        disabled={!canContinue || isSaving} 
        className="btn-primary flex items-center gap-2"
      >
        {isSaving ? (
          <span className="flex items-center gap-1">
            <svg className="animate-spin h-4 w-4 text-white" viewBox="0 0 24 24">
              <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" fill="none"></circle>
              <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {t('Chargement...')}
          </span>
        ) : (
          <>{etape === 5 ? t('Demander un devis') : t('Continuer')} →</>
        )}
      </button>
    </div>
  );

  // PAGE ACCUEIL
  if(page==='accueil'){
    return(
      <div className="min-h-screen" style={{background:'var(--bleu)'}}>
        <div className="max-w-4xl mx-auto px-4 py-6">
          <div className="flex justify-end mb-6">
            <button onClick={() => window.location.href = '/'} className="flex items-center gap-2 px-4 py-2 bg-white/10 hover:bg-white/20 text-white rounded-lg transition-all text-sm font-medium">
              <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
              {t("Retour à l'accueil")}
            </button>
          </div>
          <div className="text-center mb-12">
            <button onClick={() => window.location.href = '/'} className="inline-block hover:scale-105 transition-transform">
              <img src={window.LOGO_URL} className="w-20 h-20 object-contain mb-6 mx-auto" alt="AIAE Logo" />
            </button>
            <h1 className="text-3xl md:text-4xl font-bold text-white mb-3">{t("Simulateur d'Estimation")}</h1>
            <p className="text-blue-200 text-lg">AFRIKA INFRASTRUCTURE, AUTOMATION & ENERGY</p>
          </div>
          <div className="bg-white/10 backdrop-blur rounded-2xl p-6 mb-8">
            <h2 className="text-white font-semibold mb-4">{t('Sélectionnez votre secteur')}</h2>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
              {[
                {id:'residentiel',icon:'Home',name:t('Résidentiel'),desc:t('Villas, immeubles')},
                {id:'tertiaire',icon:'Building2',name:t('Tertiaire'),desc:t('Bureaux, hôtels')},
                {id:'industriel',icon:'Factory',name:t('Industriel'),desc:t('Usines, entrepôts')},
                {id:'agricole',icon:'Sprout',name:t('Agricole'),desc:t('Élevage, stockage')}
              ].map(s=>(
                <button key={s.id} onClick={()=>{setSecteur(s.id);setPage('sim');}}
                  className="bg-white rounded-xl p-5 text-left hover:shadow-lg hover:scale-[1.02] transition-all group">
                  <div className="mb-3 p-3 bg-gray-50 rounded-lg w-fit group-hover:bg-[#0E1540] group-hover:text-white transition-colors">
                    <Icon name={s.icon} size={32} />
                  </div>
                  <div className="font-semibold text-gray-800">{s.name}</div>
                  <div className="text-xs text-gray-500 mt-1">{s.desc}</div>
                </button>
              ))}
            </div>
          </div>
          <div className="text-center mt-12 text-blue-300 text-xs">© 2025 AIAE SARL • Quartier Kléme Zanguéra, Lomé, Togo</div>
        </div>
      </div>
    );
  }

  // SIMULATEUR
  return(
    <div className="min-h-screen bg-gray-50">
      <Header/>
      <main className="max-w-5xl mx-auto px-4 py-6">
        
        {/* ÉTAPE 1: TYPE - SANS PRIX */}
        {etape===1&&(
          <div>
            <div className="mb-6">
              <h2 className="text-xl font-bold text-gray-800">{t('Type de projet')}</h2>
              <p className="text-gray-500 text-sm">{t('Secteur:')} {secteur}</p>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Type de bâtiment')}</h3>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                {TYPES[secteur]?.map(t_bat=>(
                  <button key={t_bat.id} onClick={()=>setTypeBat(t_bat.id)} className={`option-btn ${typeBat===t_bat.id?'selected':''}`}>
                    <div className={`mb-3 p-2 rounded-lg w-fit ${typeBat===t_bat.id?'bg-white/20':'bg-gray-50'}`}>
                      <Icon name={t_bat.icon} size={24} />
                    </div>
                    <div className="font-medium text-gray-800">{t(t_bat.name)}</div>
                  </button>
                ))}
              </div>
            </div>
            {secteur==='residentiel'&&typeBat&&(
              <div className="card p-5 mb-6">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Niveau de standing')}</h3>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                  {Object.entries(STANDINGS).map(([id,d])=>(
                    <button key={id} onClick={()=>setStanding(id)} className={`option-btn ${standing===id?'selected':''}`}>
                      <div className={`mb-3 p-2 rounded-lg w-fit ${standing===id?'bg-white/20':'bg-gray-50'}`}>
                        <Icon name={d.icon} size={24} />
                      </div>
                      <div className="font-semibold text-gray-800">{t(d.name)}</div>
                      <div className="text-xs text-gray-500 mt-1">{t(d.desc)}</div>
                    </button>
                  ))}
                </div>
              </div>
            )}
            {typeBat?.startsWith('hotel_')&&(
              <div className="card p-5 mb-6">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Classification hôtelière')}</h3>
                <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                  {HOTELS.map(h=>(
                    <button key={h.id} onClick={()=>setCatHotel(h.id)} className={`option-btn ${catHotel===h.id?'selected':''}`}>
                      <div className="font-semibold text-lg">{h.name}</div>
                      <div className="text-xs text-gray-500 mt-2">~{h.surfCh} m² / {t('Chambres')}</div>
                    </button>
                  ))}
                </div>
              </div>
            )}
            <Nav canContinue={!!typeBat}/>
          </div>
        )}

        {/* ÉTAPE 2: TERRAIN */}
        {etape===2&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">{t('Caractéristiques du terrain')}</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Forme et dimensions')}</h3>
                <div className="grid grid-cols-3 gap-2 mb-4">
                  {['carre','rect','irregulier'].map(f=>(
                    <button key={f} onClick={()=>setForme(f)} className={`py-2 px-3 rounded text-sm font-medium ${forme===f?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                      {f==='carre'?t('Carré'):f==='rect'?t('Rectangle'):t('Irrégulier')}
                    </button>
                  ))}
                </div>
                {forme!=='irregulier'?(
                  <div className="grid grid-cols-2 gap-4">
                    <InputNum value={dimA} onChange={setDimA} min={10} max={200} unit="m" label={forme==='carre'?t('Côté'):t('Longueur')}/>
                    {forme!=='carre'&&<InputNum value={dimB} onChange={setDimB} min={10} max={200} unit="m" label={t('Largeur')}/>}
                  </div>
                ):(
                  <InputNum value={surfManuelle} onChange={setSurfManuelle} min={100} max={50000} step={50} unit="m²" label={t('Surface')}/>
                )}
                <div className="mt-4 p-4 bg-blue-50 rounded-lg grid grid-cols-2 gap-4">
                  <div><div className="text-xs text-gray-500">{t('Surface')}</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(surface)} m²</div></div>
                  <div><div className="text-xs text-gray-500">{t('Périmètre')}</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(perimetre)} ml</div></div>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Disponibilité')}</h3>
                <div className="grid grid-cols-3 gap-2 mb-4">
                  {[{id:'oui',n:t('Disponible')},{id:'option',n:t('En option')},{id:'non',n:t('À acquérir')}].map(tObj=>(
                    <button key={tObj.id} onClick={()=>setTerrainDispo(tObj.id)} className={`option-btn text-center py-3 ${terrainDispo===tObj.id?'selected':''}`}>
                      <div className="text-sm">{tObj.n}</div>
                    </button>
                  ))}
                </div>
                {terrainDispo!=='oui'&&<div className="info-box text-sm"><strong>{t('Note:')}</strong> {t("Coût d'acquisition estimé selon la zone.")}</div>}
              </div>
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Zone géographique')}</h3>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
                {Object.entries(ZONES).map(([id,z])=>(
                  <button key={id} onClick={()=>setZone(id)} className={`option-btn ${zone===id?'selected':''}`}>
                    <div className="font-medium">{t(z.name)}</div>
                    <div className="text-xs text-gray-500">{t(z.localites)}</div>
                  </button>
                ))}
              </div>
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Type de sol')}</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
                {Object.entries(SOLS).map(([id,s])=>(
                  <button key={id} onClick={()=>setSol(id)} className={`option-btn ${sol===id?'selected':''} ${s.risque==='élevé'||s.risque==='très élevé'?'border-orange-300':''}`}>
                    <div className="flex justify-between items-start">
                      <div>
                        <div className="font-medium">{t(s.name)}</div>
                        <div className="text-xs text-gray-500 mt-1">{t('Portance:')} {t(s.portance)}</div>
                        <div className="text-xs text-gray-500">{t(s.fondation)}</div>
                      </div>
                    </div>
                  </button>
                ))}
              </div>
              {sol&&(sol==='argileux'||sol==='hydromorphe')&&<div className="alert-box mt-4"><strong>⚠️ {t('Sol à risque')}</strong><p className="text-sm mt-1">{t('Étude géotechnique G2 obligatoire.')}</p></div>}
            </div>
            <Nav canContinue={!!sol}/>
          </div>
        )}

        {/* ÉTAPE 3: BÂTIMENT */}
        {etape===3&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">{t('Configuration du bâtiment')}</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Niveaux')}</h3>
                <div className="grid grid-cols-2 gap-4">
                  <InputNum value={niveaux} onChange={setNiveaux} min={1} max={typeData?.max||10} label={t('Niveaux hors sol')}/>
                  <InputNum value={ssSol} onChange={setSsSol} min={0} max={3} label={t('Sous-sols')}/>
                </div>
                <div className="grid grid-cols-2 gap-4 mt-4">
                  <InputNum value={hspRdc} onChange={setHspRdc} min={2.4} max={6} step={0.1} unit="m" label={t('HSP RDC')}/>
                  <InputNum value={hspEtage} onChange={setHspEtage} min={2.4} max={4} step={0.1} unit="m" label={t('HSP Étages')}/>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Synthèse technique')}</h3>
                <div className="space-y-3">
                  <div className="flex justify-between"><span className="text-gray-500">{t('Emprise au sol')}</span><span className="mono font-semibold">{fmt(surface*emprise)} m² ({Math.round(emprise*100)}%)</span></div>
                  <div className="flex justify-between"><span className="text-gray-500">{t('Surface plancher')}</span><span className="mono font-semibold">{fmt(surfaceBatie)} m²</span></div>
                  <div className="flex justify-between"><span className="text-gray-500">{t('Hauteur totale')}</span><span className="mono font-semibold">{Number(hauteurTotale || 0).toFixed(1)} m</span></div>
                </div>
                <div className="mt-4 p-3 bg-gray-50 rounded-lg">
                  <div className="flex items-center gap-2">
                    <span className={`badge ${categorie.cat==='A1'?'badge-green':categorie.cat==='A2'?'badge-blue':'badge-orange'}`}>Cat. {categorie.cat}</span>
                    <span className={`badge ${categorie.geoOblig?'badge-orange':'badge-gray'}`}>{t('Géotech.')} {categorie.mission}</span>
                  </div>
                  {categorie.motifs.length>0&&<div className="text-xs text-gray-500 mt-2">{categorie.motifs.join(' • ')}</div>}
                </div>
              </div>
            </div>
            {typeBat?.startsWith('hotel_')&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Configuration hôtel')}</h3>
                <div className="grid grid-cols-2 gap-4 mb-4">
                  <InputNum value={nbChambres} onChange={setNbChambres} min={5} max={500} label={t('Chambres')}/>
                  <InputNum value={nbAsc} onChange={setNbAsc} min={0} max={10} label={t('Ascenseurs')}/>
                </div>
                <div className="flex flex-wrap gap-2">
                  {['restaurant','bar','spa','piscine','salle_conf','parking'].map(e=>(
                    <button key={e} onClick={()=>setEspacesHotel(espacesHotel.includes(e)?espacesHotel.filter(x=>x!==e):[...espacesHotel,e])}
                      className={`px-3 py-1.5 rounded-full text-sm ${espacesHotel.includes(e)?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                      {e === 'salle_conf' ? 'Salle conf' : t(e.charAt(0).toUpperCase() + e.slice(1))}
                    </button>
                  ))}
                </div>
              </div>
            )}
            {secteur==='industriel'&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Configuration industrielle')}</h3>
                <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                  <InputNum value={hauteurLibre} onChange={setHauteurLibre} min={4} max={20} unit="m" label={t('Hauteur libre')}/>
                  <InputNum value={nbQuais} onChange={setNbQuais} min={0} max={20} label={t('Quais')}/>
                </div>
                <div className="flex items-center gap-4 mt-4">
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={pontRoulant} onChange={e=>setPontRoulant(e.target.checked)} className="w-4 h-4"/>
                    <span>{t('Pont roulant')}</span>
                  </label>
                  {pontRoulant&&<InputNum value={pontCap} onChange={setPontCap} min={1} max={50} unit="T" label={t('Capacité')}/>}
                </div>
                {(typeBat==='chambre_froide'||typeBat==='entrepot')&&(
                  <div className="mt-4">
                    <label className="text-sm text-gray-600">{t('Groupe froid')}</label>
                    <div className="flex gap-2 mt-2">
                      {[{id:'',n:t('Non')},{id:'positif',n:t('Positif')},{id:'negatif',n:t('Négatif')}].map(g=>(
                        <button key={g.id} onClick={()=>setGroupeFroid(g.id)} className={`px-3 py-1.5 rounded text-sm ${groupeFroid===g.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{g.n}</button>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            )}
            {secteur==='agricole'&&typeBat?.startsWith('elevage_')&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Élevage')}</h3>
                <InputNum value={effectif} onChange={setEffectif} min={10} max={10000} step={10} label={typeBat==='elevage_volailles'?t('Sujets'):t('Têtes')}/>
                <div className="mt-3 text-sm text-gray-500">{t('Surface')} : {fmt(surfaceBatie)} m²</div>
              </div>
            )}
            <Nav/>
          </div>
        )}

        {/* ÉTAPE 4: ÉQUIPEMENTS */}
        {etape===4&&(
          <div>
            <div className="mb-6">
              <h2 className="text-xl font-bold text-gray-800">{t('Équipements et options')}</h2>
              <p className="text-gray-500 text-sm">{t('Sécurité et aménagements extérieurs')}</p>
            </div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Sécurité')}</h3>
                <div className="space-y-4">
                  <div>
                    <label className="text-sm text-gray-600">{t('Alarme')}</label>
                    <div className="flex flex-wrap gap-2 mt-2">
                      <button onClick={()=>setAlarme('')} className={`px-2 py-1 rounded text-xs ${!alarme?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                      {SECURITE_OPTS.filter(o=>o.id.includes('alarme')).map(a=>(
                        <button key={a.id} onClick={()=>setAlarme(a.id)} className={`px-2 py-1 rounded text-xs ${alarme===a.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t(a.name||'').replace(t('Alarme'),'').replace('Alarm','').replace('Alarme','').trim()}</button>
                      ))}
                    </div>
                    {alarme&&<InputNum value={nbZones} onChange={setNbZones} min={2} max={24} label={t('Zones')}/>}
                  </div>
                  <div>
                    <label className="text-sm text-gray-600">{t('Vidéosurveillance')}</label>
                    <div className="flex flex-wrap gap-2 mt-2">
                      <button onClick={()=>setVideo('')} className={`px-2 py-1 rounded text-xs ${!video?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                      {SECURITE_OPTS.filter(o=>o.id.includes('video')).map(v=>(
                        <button key={v.id} onClick={()=>setVideo(v.id)} className={`px-2 py-1 rounded text-xs ${video===v.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t(v.name||'').replace(t('Vidéosurveillance'),'').replace('Video Surveillance','').replace('Vidéosurveillance','').trim()}</button>
                      ))}
                    </div>
                  </div>
                  <div>
                    <label className="text-sm text-gray-600">{t('Contrôle accès')}</label>
                    <div className="flex gap-2 mt-2">
                      {[{id:'',n:t('Non')},{id:'badge',n:t('Badge')},{id:'bio',n:t('Biométrique')}].map(c=>(
                        <button key={c.id} onClick={()=>setAcces(c.id)} className={`px-3 py-1.5 rounded text-sm ${acces===c.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{c.n}</button>
                      ))}
                    </div>
                    {acces&&<InputNum value={nbPortes} onChange={setNbPortes} min={1} max={20} label={t('Portes')}/>}
                  </div>
                </div>
              </div>
              {secteur!=='agricole'&&(
                <div className="card p-5">
                  <h3 className="font-semibold text-gray-700 mb-4"> {t('Ascenseurs')}</h3>
                  <InputNum value={nbAsc} onChange={setNbAsc} min={0} max={10} label={t('Nombre')}/>
                  {nbAsc>0&&<p className="text-xs text-gray-500 mt-2">{t('Obligatoire si ERP et R+1')}</p>}
                </div>
              )}
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Extérieurs')}</h3>
              <div className="grid md:grid-cols-3 gap-4">
                <div>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={cloture} onChange={e=>setCloture(e.target.checked)} className="w-4 h-4"/>
                    <span>{t('Clôture')} ({fmt(perimetre)} ml)</span>
                  </label>
                  {cloture&&<div className="mt-2 flex gap-2">{[1.5,2,2.5,3].map(h=>(<button key={h} onClick={()=>setClotureH(h)} className={`px-3 py-1 rounded text-sm ${clotureH===h?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{h}m</button>))}</div>}
                </div>
                <div>
                  <label className="text-sm text-gray-600">{t('Portail')}</label>
                  <div className="flex flex-wrap gap-2 mt-2">
                    <button onClick={()=>setPortail('')} className={`px-2 py-1 rounded text-xs ${!portail?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                    {EXTERIEUR_OPTS.filter(o=>o.id.includes('portail')).map(p=>(
                      <button key={p.id} onClick={()=>setPortail(p.id)} className={`px-2 py-1 rounded text-xs ${portail===p.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t(p.name||'').replace(t('Portail'),'').replace('Gate','').replace('Portail','').trim()}</button>
                    ))}
                  </div>
                </div>
                <div>
                  <label className="text-sm text-gray-600">{t('Piscine')}</label>
                  <div className="flex flex-wrap gap-2 mt-2">
                    <button onClick={()=>setPiscine('')} className={`px-2 py-1 rounded text-xs ${!piscine?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                    {EXTERIEUR_OPTS.filter(o=>o.id.includes('piscine')).map(p=>(
                      <button key={p.id} onClick={()=>setPiscine(p.id)} className={`px-2 py-1 rounded text-xs ${piscine===p.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t(p.name||'').replace(t('Piscine'),'').replace('Pool','').replace('Piscine','').trim()}</button>
                    ))}
                  </div>
                </div>
              </div>
              <div className="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={forage} onChange={e=>setForage(e.target.checked)} className="w-4 h-4"/>
                    <span>{t('Forage')} (~{zoneData.forage}m)</span>
                  </label>
                  {forage&&<InputNum value={forageProf} onChange={setForageProf} min={15} max={150} unit="m" label={t('Profondeur')}/>}
                </div>
                <div>
                  <label className="text-sm text-gray-600">{t('Parking')}</label>
                  <div className="flex gap-2 mt-2">
                    {[{id:'',n:t('Non')},{id:'ext',n:t('Ext.')},{id:'couvert',n:t('Couvert')},{id:'souterrain',n:t('Sous.')}].map(p=>(<button key={p.id} onClick={()=>setParkType(p.id)} className={`px-2 py-1 rounded text-xs ${parkType===p.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{p.n}</button>))}
                  </div>
                  {parkType&&<InputNum value={parkPlaces} onChange={setParkPlaces} min={0} max={200} label={t('Places')}/>}
                </div>
              </div>
            </div>
            <Nav/>
          </div>
        )}

        {/* ÉTAPE 5: RÉCAP + ÉNERGIE + ESTIMATION */}
        {etape===5&&estimation&&(
          <div>
            <div className="flex justify-between items-center mb-6 no-print">
              <div>
                <h2 className="text-xl font-bold text-gray-800">{t('Récapitulatif et estimation')}</h2>
                <p className="text-gray-500 text-sm">{t('Besoins énergétiques - Propositions - Estimation')}</p>
              </div>
              <button onClick={()=>window.print()} className="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                <Icon name="Printer" size={18} />
                {t('Imprimer')}
              </button>
            </div>

            {/* Synthèse */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <Icon name="ClipboardList" className="text-[#0E1540]" />
                {t('Synthèse du projet')}
              </h3>
              <div className="grid md:grid-cols-4 gap-4">
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Type')}</div><div className="font-semibold">{t(typeData?.name||typeBat)}</div><div className="text-xs text-gray-500">{secteur==='residentiel'?t(STANDINGS[standing]?.name):''}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Terrain')}</div><div className="font-semibold mono">{fmt(surface)} m²</div><div className="text-xs text-gray-500">{t(zoneData.name)}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Surface plancher')}</div><div className="font-semibold mono">{fmt(surfaceBatie)} m²</div><div className="text-xs text-gray-500">{niveaux===1?t('Plain-pied'):`R+${niveaux-1}`}{ssSol>0?` + ${ssSol} ss`:''}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Durée estimée')}</div><div className="font-semibold">{duree} {t('mois')}</div></div>
              </div>
            </div>

            {/* BESOINS ÉNERGÉTIQUES */}
            <div className="card p-5 mb-6" style={{background:'linear-gradient(135deg, var(--orange) 0%, #ea580c 100%)'}}>
              <h3 className="font-bold text-white mb-4 flex items-center gap-2">
                <Icon name="Zap" />
                {t('Besoins énergétiques calculés')}
              </h3>
              <div className="text-4xl font-bold text-white mb-4 mono">{besoins.total} kW</div>
              <div className="grid grid-cols-2 md:grid-cols-4 gap-2">
                {besoins.details.map((d,i)=>(
                  <div key={i} className="bg-white/20 rounded px-3 py-2 flex items-center justify-between text-white">
                    <div className="flex items-center gap-2">
                      <Icon name={d.icon} size={14} />
                      <span className="text-sm">{d.label}</span>
                    </div>
                    <span className="mono font-semibold">{Number(d.kw || 0).toFixed(1)}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* PROPOSITIONS SOLAIRES */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <Icon name="Sun" className="text-amber-500" />
                {t('Installation solaire (40-150% couverture)')}
              </h3>
              <div className="space-y-3">
                <button onClick={()=>setSolaire('')} className={`w-full p-3 rounded-lg border-2 text-left transition-all flex items-center gap-3 ${!solaire?'border-[#0E1540] bg-blue-50':'border-gray-200'}`}>
                  <Icon name="XCircle" className={!solaire?'text-[#0E1540]':'text-gray-400'} />
                  <span className="font-medium">{t("Pas d'installation solaire")}</span>
                </button>
                {propositionsSolaires.map(kit=>(
                  <button key={kit.id} onClick={()=>setSolaire(kit.id)} className={`w-full p-4 rounded-lg border-2 text-left transition-all ${solaire===kit.id?'border-[#0E1540] bg-blue-50':'border-gray-200 hover:border-gray-300'} ${kit.optimal?'optimal-ring':''}`}>
                    <div className="flex justify-between items-start">
                      <div className="flex-1">
                        <div className="font-bold text-lg">
                          {kit.kw} kWc
                          <span className={`ml-2 text-sm px-2 py-0.5 rounded ${kit.couv>=100?'bg-green-100 text-green-700':kit.couv>=70?'bg-amber-100 text-amber-700':'bg-red-100 text-red-600'}`}>{kit.couv}%</span>
                          {kit.optimal&&<span className="text-green-600 text-sm ml-2 flex items-center gap-1 inline-flex"><Icon name="CheckCircle2" size={14} /> {t('Optimal')}</span>}
                        </div>
                        <div className="text-sm text-green-700 mt-2"><strong>{t('Couvre:')}</strong> {kit.couverts.slice(0,5).join(' • ')}{kit.couverts.length>5?'...':''}</div>
                        {kit.nonCouverts.length>0&&<div className="text-xs text-red-500 mt-1"><strong>{t('Non couvert:')}</strong> {kit.nonCouverts.slice(0,3).join(' • ')}</div>}
                      </div>
                      <div className="font-bold text-lg" style={{color:'var(--bleu)'}}>{fmtM(kit.prix)} F</div>
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* PROPOSITIONS GROUPES */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <Icon name="Plug" className="text-blue-600" />
                {t('Groupe électrogène (40-150% couverture)')}
              </h3>
              <div className="space-y-3">
                <button onClick={()=>setGroupe('')} className={`w-full p-3 rounded-lg border-2 text-left transition-all flex items-center gap-3 ${!groupe?'border-[#0E1540] bg-blue-50':'border-gray-200'}`}>
                  <Icon name="XCircle" className={!groupe?'text-[#0E1540]':'text-gray-400'} />
                  <span className="font-medium">{t('Pas de groupe électrogène')}</span>
                </button>
                {propositionsGroupes.map(grp=>(
                  <button key={grp.id} onClick={()=>setGroupe(grp.id)} className={`w-full p-4 rounded-lg border-2 text-left transition-all ${groupe===grp.id?'border-[#0E1540] bg-blue-50':'border-gray-200 hover:border-gray-300'} ${grp.optimal?'optimal-ring':''}`}>
                    <div className="flex justify-between items-start">
                      <div className="flex-1">
                        <div className="font-bold text-lg">
                          {grp.kva} kVA
                          <span className={`ml-2 text-sm px-2 py-0.5 rounded ${grp.couv>=100?'bg-green-100 text-green-700':grp.couv>=70?'bg-amber-100 text-amber-700':'bg-red-100 text-red-600'}`}>{grp.couv}%</span>
                          {grp.optimal&&<span className="text-green-600 text-sm ml-2 flex items-center gap-1 inline-flex"><Icon name="CheckCircle2" size={14} /> {t('Optimal')}</span>}
                        </div>
                        <div className="text-sm text-green-700 mt-2"><strong>{t('Couvre:')}</strong> {grp.couverts.slice(0,5).join(' • ')}{grp.couverts.length>5?'...':''}</div>
                        {grp.nonCouverts.length>0&&<div className="text-xs text-red-500 mt-1"><strong>{t('Non couvert:')}</strong> {grp.nonCouverts.slice(0,3).join(' • ')}</div>}
                      </div>
                      <div className="font-bold text-lg" style={{color:'var(--bleu)'}}>{fmtM(grp.prix)} F</div>
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* ESTIMATION FINANCIÈRE */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <Icon name="CircleDollarSign" className="text-[#05482C]" />
                {t('Estimation budgétaire')}
              </h3>
              <div className="overflow-x-auto">
                <table className="w-full text-sm">
                  <thead><tr className="border-b"><th className="text-left py-2 px-2">{t('Code')}</th><th className="text-left py-2">{t('Poste')}</th><th className="text-left py-2">{t('Détail')}</th><th className="text-right py-2 px-2">{t('Montant')}</th></tr></thead>
                  <tbody>
                    {estimation.postes.map((p,i)=>(<tr key={i} className="border-b border-gray-100"><td className="py-2 px-2 text-gray-400 mono">{p.code}</td><td className="py-2 font-medium">{p.nom}</td><td className="py-2 text-gray-500 text-xs">{p.detail}</td><td className="py-2 px-2 text-right mono font-semibold">{fmtM(p.montant)}</td></tr>))}
                  </tbody>
                </table>
              </div>
            </div>

            {/* TOTAL */}
            <div className="card p-6" style={{background:'linear-gradient(135deg, var(--bleu) 0%, #1e3a8a 100%)'}}>
              <div className="text-center">
                <div className="text-white/70 text-sm mb-2">{t('Estimation totale projet')}</div>
                <div className="text-4xl md:text-5xl font-bold text-white mono mb-4">{fmtM(estimation.foncier+estimation.total)} FCFA</div>
                <div className="flex justify-center gap-8 text-white/80 text-sm">
                  <div><div className="text-xs">{t('Fourchette basse (-10%)')}</div><div className="font-semibold mono">{fmtM(estimation.min)} F</div></div>
                  <div><div className="text-xs">{t('Fourchette haute (+15%)')}</div><div className="font-semibold mono">{fmtM(estimation.max)} F</div></div>
                </div>
                <div className="mt-4 text-white/60 text-xs">{t('Durée estimée:')} {duree} {t('mois')} • {t('Catégorie:')} {categorie.cat} • {t('Géotechnique:')} {categorie.mission}</div>
              </div>
            </div>

            <div className="warn-box mt-6 flex gap-3">
              <Icon name="AlertTriangle" className="text-amber-600 shrink-0" size={24} />
              <div>
                <strong className="block mb-1">{t('Avertissement')}</strong>
                <p className="text-sm">{t("Cette estimation est indicative et basée sur les paramètres saisis. Une étude détaillée sera réalisée pour l'établissement du devis définitif. Les prix peuvent varier selon la conjoncture du marché.")}</p>
              </div>
            </div>

            <Nav/>
          </div>
        )}

      </main>
      <footer className="text-center py-6 text-gray-400 text-xs no-print">
        © 2025 AIAE SARL • Afrika Infrastructure, Automation & Energy • Quartier Kléme Zanguéra, Lomé, Togo<br/>
        {t('Simulateur v')}{VERSION} • {t('Référentiel Décembre 2025')}
      </footer>
    </div>
  );
};

ReactDOM.createRoot(document.getElementById('root')).render(<App/>);
@endverbatim
</script>
</body>
</html>