<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ __('Simulateur AIAE (Afrika Infrastructures And Equipements) - Estimation Construction') }}</title>
  @include('frontend.partials.head-seo')
  @include('frontend.partials.schema-org')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script src="https://unpkg.com/@babel/standalone@7.26.4/babel.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
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
    'Simulateur AIAE (Afrika Infrastructures And Equipements) - Estimation Construction' => __('Simulateur AIAE (Afrika Infrastructures And Equipements) - Estimation Construction'),
    'Simulateur d\'Estimation' => __('Simulateur d\'Estimation'),
    'Sélectionnez votre secteur' => __('Sélectionnez votre secteur'),
    'Accueil' => __('Accueil'),
    'Configurez votre projet' => __('Configurez votre projet'),
    'Type, standing et dimensions en un clin d\'œil' => __('Type, standing et dimensions en un clin d\'œil'),
    'En savoir plus' => __('En savoir plus'),
    'Surface et localisation' => __('Surface et localisation'),
    'Retour à l\'accueil' => __('Retour à l\'accueil'),
    'Prix/m²' => __('Prix/m²'),
    'Votre choix' => __('Votre choix'),
    'Recommandé' => __('Recommandé'),
    'étapes' => __('étapes'),
    'Express' => __('Express'),
    'Expert' => __('Expert'),
    'Mode :' => __('Mode :'),
    'Restaurant' => __('Restaurant'),
    'Bar' => __('Bar'),
    'Salle de conférence' => __('Salle de conférence'),
    'Parcours rapide : secteur, surface, estimation directe' => __('Parcours rapide : secteur, surface, estimation directe'),
    'Parcours complet : terrain, sol, équipements, options' => __('Parcours complet : terrain, sol, équipements, options'),
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
    'Étude géotechnique G2 AVP fortement recommandée.' => __('Étude géotechnique G2 AVP fortement recommandée.'),
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
    'estimatif' => __('estimatif'),
    'estimatif, non contractuel' => __('estimatif, non contractuel'),
    '⚠ Délai estimatif hors impact saison des pluies (juin-sept.). Prévoir +20-30% si le gros œuvre couvre cette période.' => __('⚠ Délai estimatif hors impact saison des pluies (juin-sept.). Prévoir +20-30% si le gros œuvre couvre cette période.'),
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
    'Matériaux standards, agglos pleins, chaînages verticaux conformes DTU' => __('Matériaux standards, agglos pleins, chaînages verticaux conformes DTU'),
    'Matériaux de qualité, poteaux/chaînages renforcés, isolation thermique naturelle' => __('Matériaux de qualité, poteaux/chaînages renforcés, isolation thermique naturelle'),
    'Matériaux haut de gamme, structure optimisée, performances thermiques supérieures' => __('Matériaux haut de gamme, structure optimisée, performances thermiques supérieures'),
    'Matériaux nobles, structure personnalisée, prestations exclusives sur mesure' => __('Matériaux nobles, structure personnalisée, prestations exclusives sur mesure'),
    'Les standings déterminent la qualité des matériaux, finitions et équipements inclus.' => __('Les standings déterminent la qualité des matériaux, finitions et équipements inclus.'),
    'La zone influence le coût foncier et le coefficient géographique.' => __('La zone influence le coût foncier et le coefficient géographique.'),
    'Le type de sol détermine le coefficient géotechnique et le type de fondations.' => __('Le type de sol détermine le coefficient géotechnique et le type de fondations.'),
    'Le nombre de niveaux influence la catégorie du bâtiment et les études géotechniques requises.' => __('Le nombre de niveaux influence la catégorie du bâtiment et les études géotechniques requises.'),
    'Emprise inférieure au minimum recommandé' => __('Emprise inférieure au minimum recommandé'),
    'Emprise supérieure au maximum autorisé' => __('Emprise supérieure au maximum autorisé'),
    'Estimation temps réel' => __('Estimation temps réel'),
    'HSP Sous-sol' => __('HSP Sous-sol'),
    'Min' => __('Min'),
    'Max' => __('Max'),
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
<div id="root"><div style="display:flex;align-items:center;justify-content:center;min-height:100vh;color:#64748b;font-family:sans-serif;font-size:18px">{{ __('Chargement du simulateur...') }}</div></div>
<script>
    window.INITIAL_SECTEUR = "{{ $secteur ?? '' }}";
    window.SAVE_ROUTE = "{{ route('simulator.save') }}";
    window.BACK_ROUTE = "{{ route('simulator.index') }}";
    window.HOME_ROUTE = "{{ route('home') }}";
    window.SIMULATEUR_CONFIG = @json($config);
    window.QUICK_START = @json($quickStart ?? null);
    window.AIAE_SIM_TRANSLATIONS = @json($simTranslations);
    window.LOGO_URL = "{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL_Clr.png') }}";
</script>
<script type="text/babel">
@verbatim
const {useState,useMemo,useEffect}=React;
const t = (key) => window.AIAE_SIM_TRANSLATIONS ? (window.AIAE_SIM_TRANSLATIONS[key] || key) : key;

const InputNum=({value,onChange,min=0,max=999,step=1,unit='',label=''})=>{
  const isDecimal = step % 1 !== 0 || min % 1 !== 0;

  return (
    <div className="flex flex-col">
      {label&&<label className="text-xs text-gray-500 mb-1">{label}</label>}
      <div className="input-num">
        <button onClick={()=>{
          const current = parseFloat(value) || 0;
          const next = Math.max(min, current - step);
          onChange(isDecimal ? Math.round(next * 10) / 10 : Math.round(next));
        }}>−</button>
        <div className="flex-1 flex items-center justify-center min-w-[70px]">
          <input 
            type="number"
            value={value}
            min={min}
            max={max}
            step={isDecimal ? "any" : "1"}
            onChange={(e) => {
              const val = e.target.value;
              if (val === '') {
                onChange('');
              } else {
                if (!isDecimal) {
                  const parsed = parseInt(val, 10);
                  if (!isNaN(parsed)) onChange(parsed);
                } else {
                  const parsed = parseFloat(val);
                  if (!isNaN(parsed)) onChange(parsed);
                }
              }
            }}
            onBlur={() => {
              let val = parseFloat(value);
              if (isNaN(val)) val = min;
              const rounded = isDecimal ? Math.round(val * 10) / 10 : Math.round(val);
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
          onChange(isDecimal ? Math.round(next * 10) / 10 : Math.round(next));
        }}>+</button>
      </div>
    </div>
  );
};

const InfoIcon=({text,id=''})=>{
  const [show,setShow]=React.useState(false);
  const ref=React.useRef(null);
  React.useEffect(()=>{
    const h=()=>setShow(false);
    document.addEventListener('click',h);
    return ()=>document.removeEventListener('click',h);
  },[]);
  return <span className="relative inline-flex items-center ml-1" ref={ref}>
    <span className="cursor-help inline-flex items-center justify-center w-4 h-4 rounded-full bg-gray-200 text-gray-500 text-xs font-bold hover:bg-[#0E1540] hover:text-white transition-colors"
      onClick={(e)=>{e.stopPropagation();setShow(!show);}}
      onMouseEnter={()=>setShow(true)}
      onMouseLeave={()=>setShow(false)}
    >?</span>
    {show&&<div className="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded-lg shadow-lg whitespace-nowrap z-50 pointer-events-none" style={{maxWidth:'280px',whiteSpace:'normal'}}>{text}</div>}
  </span>;
};

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

  const ZONES = Object.keys(libConfig.ZONES||{}).length ? libConfig.ZONES : {
    zone1:{name:'Zone 1 - Grand Lomé',localites:'Lomé, Baguida, Agoè',coef:1.00,forage:25,foncier:75000},
    zone2:{name:'Zone 2 - Maritime',localites:'Tsévié, Tabligbo, Aného',coef:1.08,forage:35,foncier:25000},
    zone3:{name:'Zone 3 - Plateaux',localites:'Atakpamé, Kpalimé, Badou',coef:1.14,forage:50,foncier:12000},
    zone4:{name:'Zone 4 - Centrale',localites:'Sokodé, Tchamba, Blitta',coef:1.19,forage:60,foncier:6000},
    zone5:{name:'Zone 5 - Kara & Savanes',localites:'Kara, Dapaong, Mango',coef:1.25,forage:75,foncier:4000}
  };

  const SOLS = Object.keys(libConfig.SOLS||{}).length ? libConfig.SOLS : {
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
  const STANDINGS = Object.keys(libConfig.STANDINGS||{}).length ? libConfig.STANDINGS : {
    standard:{name:t('Standard'),desc:t('Fonctionnel et durable — Idéal premier investissement'),icon:'Home',prix:180000,prix_max:250000,terrain_min:200},
    confort:{name:t('Confort'),desc:t('Qualité supérieure — Notre cœur de gamme'),icon:'Armchair',prix:280000,prix_max:380000,terrain_min:400},
    premium:{name:t('Premium'),desc:t('Haut de gamme — Piscine incluse, personnalisation poussée'),icon:'Gem',prix:420000,prix_max:550000,terrain_min:500},
    prestige:{name:t('Prestige'),desc:t('Luxe sur mesure — Matériaux d\'exception, domotique complète'),icon:'Crown',prix:600000,prix_max:900000,terrain_min:800}
  };
  const STANDINGS_PRIX = {};
  const STANDINGS_PRIX_MAX = {};
  const STANDINGS_HSP = {};
  const STANDINGS_EMPRISE = {};
  const STANDINGS_EMPRISE_REC = {};
  const STANDINGS_EMPRISE_MIN = {};
  const STANDINGS_MARGE = {};
  const STANDINGS_HSP_RDC = {};
  const STANDINGS_HSP_ETAGE = {};
  const STANDINGS_HSP_SOL = {};
  Object.entries(STANDINGS).forEach(([k,v]) => {
    STANDINGS_PRIX[k] = v.prix || 500000;
    STANDINGS_PRIX_MAX[k] = v.prix_max || v.prix || 500000;
    STANDINGS_HSP[k] = v.hsp || 2.80;
    STANDINGS_EMPRISE[k] = v.emprise || 0.35;
    STANDINGS_EMPRISE_REC[k] = v.emprise_recommandee || 0.35;
    STANDINGS_EMPRISE_MIN[k] = v.emprise_min || 0.25;
    STANDINGS_MARGE[k] = v.marge || 0.20;
    STANDINGS_HSP_RDC[k] = v.hsp_rdc || 3.0;
    STANDINGS_HSP_ETAGE[k] = v.hsp_etage || 2.8;
    STANDINGS_HSP_SOL[k] = v.hsp_soussol || 2.5;
  });
  const EUR_RATE = 655.957;
  const STANDINGS_N2 = {
    standard:{
      title: t('STANDARD — 180 000 à 250 000 FCFA/m² (≈ 275 à 380 €/m²)'),
      desc: t('Un logement fonctionnel, solide et durable à prix maîtrisé. Idéal pour un premier investissement, un projet locatif ou une résidence principale économique.'),
      includes: [
        t('Structure béton armé conforme aux Eurocodes et NF DTU (fondations, murs porteurs, planchers béton)'),
        t('Menuiseries aluminium, vitrage simple'),
        t('Sols carrelés, plafonds en lambris PVC'),
        t('Installation électrique complète aux normes, prête pour l\'ajout futur de climatisation'),
        t('Enduit et peinture intérieure et extérieure'),
        t('Hauteur sous plafond : 2,60 m')
      ],
      options: t('climatisation, clôture, piscine, groupe électrogène, installation solaire'),
      footer: t('Plain-pied ou R+1 · Terrain minimum : 200 m²')
    },
    confort:{
      title: t('CONFORT — 280 000 à 380 000 FCFA/m² (≈ 425 à 580 €/m²)'),
      desc: t('Notre cœur de gamme. Des finitions soignées, des espaces généreux et des équipements complets pour un quotidien agréable. Le meilleur rapport qualité-prix.'),
      includes: [
        t('Structure renforcée conforme aux Eurocodes et NF DTU (murs porteurs de 20 cm, planchers béton armé)'),
        t('Menuiseries aluminium laqué coloris au choix, double vitrage (isolation acoustique) dans les zones exposées au bruit'),
        t('Carrelage grand format 60×60 cm, faux-plafonds en plâtre, peinture lessivable'),
        t('Climatisation dans toutes les pièces principales'),
        t('Cuisine aménagée (plan de travail granit, meubles, évier double bac)'),
        t('Isolation sous toiture, chauffe-eau solaire'),
        t('Hauteur sous plafond : 2,80 m')
      ],
      options: t('piscine, domotique, clôture, groupe électrogène, installation solaire'),
      footer: t('Plain-pied ou R+1 · Terrain minimum : 400 m²')
    },
    premium:{
      title: t('PREMIUM — 420 000 à 550 000 FCFA/m² (≈ 640 à 840 €/m²)'),
      desc: t('Des prestations haut de gamme avec une personnalisation poussée. Piscine et garage inclus, volets roulants motorisés et maison partiellement connectée.'),
      includes: [
        t('Structure haute performance conforme aux Eurocodes et NF DTU, étude de sol recommandée'),
        t('Menuiseries aluminium haut de gamme, double vitrage intégral (isolation acoustique + protection UV)'),
        t('Parquet dans les chambres, carrelage haut de gamme 80×80 cm dans les séjours'),
        t('Piscine carrelée 8×4 m avec pool house'),
        t('Volets roulants motorisés, pilotage centralisé de l\'éclairage et de la climatisation'),
        t('Climatisation performante, éclairage architectural'),
        t('Suite parentale avec douche italienne et baignoire'),
        t('Hauteur sous plafond : 3,00 m')
      ],
      options: t('—'),
      footer: t('Jusqu\'à R+2 · Terrain minimum : 500 m²')
    },
    prestige:{
      title: t('PRESTIGE — 600 000 à 900 000 FCFA/m² (≈ 915 à 1 370 €/m²)'),
      desc: t('L\'excellence sans compromis. Villa d\'architecte avec matériaux d\'exception, maison entièrement connectée et équipements de luxe. Chaque projet Prestige est unique.'),
      includes: [
        t('Structure sur mesure conforme aux Eurocodes et NF DTU pour grandes portées et volumes exceptionnels, étude de sol obligatoire'),
        t('Menuiseries importées sur mesure, double ou triple vitrage'),
        t('Sols en marbre, travertin ou parquet massif importé'),
        t('Piscine à débordement 12×5 m avec éclairage subaquatique et pool house aménagé'),
        t('Maison entièrement connectée : éclairage, volets, climatisation, sécurité, son multi-pièces'),
        t('Salle de bain type spa (baignoire balnéo, douche pluie XXL)'),
        t('Groupe électrogène intégré avec basculement automatique'),
        t('Récupération eaux de pluie, option solaire photovoltaïque'),
        t('Hauteur sous plafond : 3,20 à 3,50 m')
      ],
      options: t('—'),
      footer: t('Jusqu\'à R+2 avec ascenseur · Terrain minimum : 800 m²')
    }
  };

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
      {id:'hangar_agricole',name:t('Hangar agricole'),max:1,prix:120000,icon:'Warehouse'},
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
  const SECONDE_OEUVRE_OPTS = libConfig.SECONDE_OEUVRE || [];

  // ÉTAT
  const qs = window.QUICK_START || {};
  const initSecteur = qs.secteur || window.INITIAL_SECTEUR || '';
  const fromHomePage = !!qs.standing;
  
  const [page,setPage]=useState(initSecteur ? 'sim' : 'accueil');
  const[mode,setMode]=useState(qs.mode || 'express');
  const totalSteps=mode==='express'?3:6;
  const[etape,setEtape]=useState(initSecteur ? (fromHomePage ? 2 : 1) : 1);
  const [secteur,setSecteur]=useState(initSecteur);
  const[typeBat,setTypeBat]=useState('');
  const [standing,setStanding]=useState(qs.standing || 'standard');
  const [showN2,setShowN2]=useState(null);
  const [catHotel,setCatHotel]=useState('3s');
  const[forme,setForme]=useState('rect');
  
  const initialStanding = qs.standing || 'standard';
  const defaultSurf = STANDINGS[initialStanding]?.terrain_min || 600;
  const initialSurf = qs.surface || defaultSurf;
  const [dimA,setDimA]=useState(Math.round(Math.sqrt(initialSurf)));
  const[dimB,setDimB]=useState(Math.round(Math.sqrt(initialSurf)));
  const[surfManuelle,setSurfManuelle]=useState(initialSurf);
  
  const [terrainDispo,setTerrainDispo]=useState('oui');
  const [zone,setZone]=useState(Object.keys(ZONES)[0]||'zone1');
  const[sol,setSol]=useState('');
  const [niveaux,setNiveaux]=useState(1);
  const [ssSol,setSsSol]=useState(0);
  const[hspRdc,setHspRdc]=useState(STANDINGS_HSP_RDC[standing]||3.0);
  const[hspEtage,setHspEtage]=useState(STANDINGS_HSP_ETAGE[standing]||2.8);
  const[hspSoussol,setHspSoussol]=useState(STANDINGS_HSP_SOL[standing]||2.5);
  const [nbChambres,setNbChambres]=useState(qs.nb_beds ? parseInt(qs.nb_beds) : 3);
  const[espacesHotel,setEspacesHotel]=useState(qs.espaces_communs === "1" ? ['accueil'] : []);
  const SPECIFIQUES = libConfig.SPECIFIQUE || [];
  const SIMULATOR_PARAMS = libConfig.PARAMS || {sous_sol_prix:85000, vrd_base_prix:8500, forage_prix_m:95000, forage_fixe:1200000, cloture_prix_bas:88000, cloture_prix_haut:135000};

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

  // V5 nouvelles catégories
  const [domotique,setDomotique]=useState('');
  const [volet,setVolet]=useState('');
  const [citerne,setCiterne]=useState('');
  const [paysager,setPaysager]=useState('');

  const [honoraires,setHonoraires]=useState(0);
  const [assurance,setAssurance]=useState(false);
  const [prestations,setPrestations]=useState([]);

  const [isSaving,setIsSaving]=useState(false);
  const [currency,setCurrency]=useState('FCFA');

  // Helper badge pour mapping standings
  const getBadge=(opt)=>{
    if(!opt?.mapping || !standing)return null;
    const role=opt.mapping[standing];
    if(!role)return null;
    if(role==='preselect')return {label:t('Pré-sél.'),cls:'bg-blue-100 text-blue-700 border-blue-300'};
    if(role==='recom')return {label:t('Recommandé'),cls:'bg-green-100 text-green-700 border-green-300'};
    if(role==='opt')return {label:t('Optionnel'),cls:'bg-gray-100 text-gray-500 border-gray-200'};
    return null;
  };

  // Helper GammeSlider — sélecteur gamme Éco/Standard/Premium
  const GAMME_LABELS={eco:t('Éco'),standard:t('Standard'),premium:t('Premium')};
  const GAMME_CLASSES={eco:'from-green-400 to-green-500',standard:'from-blue-400 to-blue-500',premium:'from-amber-400 to-orange-500'};
  const GammeSlider=({opts,value,onChange,label,desc})=>{
    const sorted=[...opts].sort((a,b)=>(a.prix||0)-(b.prix||0));
    const levels=['eco','standard','premium'];
    const currentIdx=value?sorted.findIndex(o=>o.id===value):-1;
    const currentLevel=currentIdx>=0&&currentIdx<levels.length?levels[currentIdx]:null;
    return(
      <div className="card p-5 mt-6">
        <h3 className="font-semibold text-gray-700 mb-4">{label}</h3>
        {desc&&<p className="text-xs text-gray-500 mb-3">{desc}</p>}
        <div className="flex items-center gap-2 mb-3">
          <button onClick={()=>onChange('')} className={`px-3 py-1.5 rounded-lg text-sm font-medium ${!value?'bg-gray-200 text-gray-700 ring-2 ring-gray-400':'bg-gray-100 text-gray-500'}`}>{t('Non')}</button>
          <div className="flex-1 relative h-10 bg-gray-100 rounded-lg overflow-hidden flex">
            {sorted.slice(0,3).map((opt,i)=>{
              const level=levels[i];
              const selected=value===opt.id;
              return(<button key={opt.id} onClick={()=>onChange(opt.id)} className={`flex-1 relative flex items-center justify-center text-sm font-medium transition-all ${selected?`bg-gradient-to-r ${GAMME_CLASSES[level]} text-white shadow-md scale-[1.02] z-10`:'hover:bg-gray-200 text-gray-600'}`}>
                <span>{GAMME_LABELS[level]}</span>
                {selected&&<span className="ml-1.5 text-xs opacity-80">{fmtM(opt.prix)}</span>}
              </button>);
            })}
          </div>
        </div>
        {value&&(()=>{
          const opt=sorted.find(o=>o.id===value);
          if(!opt)return null;
          const badge=getBadge(opt);
          const prixRange=opt.prix_max?`${fmtM(opt.prix)} - ${fmtM(opt.prix_max)} FCFA`:fmtM(opt.prix)+' FCFA';
          return(<div className="flex items-center justify-between text-xs text-gray-500 bg-gray-50 rounded-lg px-3 py-2">
            <span className="font-medium">{t(opt.name||'')}</span>
            <span className="flex items-center gap-2">
              <span className="mono">{prixRange}</span>
              {badge&&<span className={`px-1.5 py-0.5 rounded text-[9px] font-medium border ${badge.cls}`}>{badge.label}</span>}
            </span>
          </div>);
        })()}
      </div>
    );
  };

  // Auto-sélection des options pré-sélectionnées selon standing
  useEffect(()=>{
    const autoSelect=(opts,setter)=>{
      if(!opts||opts.length===0)return;
      const preselect=opts.find(o=>o.mapping&&o.mapping[standing]==='preselect');
      if(preselect)setter(preselect.id);
    };
    autoSelect(SECURITE_OPTS.filter(o=>o.id.includes('alarme')),setAlarme);
    autoSelect(SECURITE_OPTS.filter(o=>o.id.includes('video')),setVideo);
    autoSelect(EXTERIEUR_OPTS.filter(o=>o.id.includes('portail')),setPortail);
    autoSelect(EXTERIEUR_OPTS.filter(o=>o.id.includes('piscine')),setPiscine);
    autoSelect(EXTERIEUR_OPTS.filter(o=>o.id.includes('citerne')),setCiterne);
    autoSelect(EXTERIEUR_OPTS.filter(o=>o.id.includes('paysager')),setPaysager);
    autoSelect(DOMOTIQUE_OPTS,setDomotique);
    autoSelect(SECONDE_OEUVRE_OPTS.filter(o=>o.id.includes('volet')),setVolet);
  },[standing]);

  // Pré-remplissage HSP selon standing
  React.useEffect(() => {
    setHspRdc(STANDINGS_HSP_RDC[standing]||3.0);
    setHspEtage(STANDINGS_HSP_ETAGE[standing]||2.8);
    setHspSoussol(STANDINGS_HSP_SOL[standing]||2.5);
  }, [standing]);

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
  const zoneData=ZONES[zone]||{};
  const solEffectifGlobal=sol||(mode==='express'?'ferralitique':'');
  const solData=SOLS[solEffectifGlobal];
  const coefTotal=(zoneData?.coef||1)*(solData?.coef||1.15);

  // Emprise : plage recommandée 25-65% selon standing/secteur + alertes
  const empriseRec=useMemo(()=>{
    if(secteur==='residentiel')return STANDINGS_EMPRISE_REC[standing]||0.35;
    if(secteur==='industriel')return 0.45;
    if(secteur==='agricole')return 0.35;
    return 0.35;
  },[secteur,standing]);

  const empriseMin=useMemo(()=>{
    if(secteur==='residentiel')return STANDINGS_EMPRISE_MIN[standing]||0.25;
    if(secteur==='industriel')return 0.35;
    if(secteur==='agricole')return 0.25;
    return 0.25;
  },[secteur,standing]);

  const empriseMax=useMemo(()=>{
    if(secteur==='residentiel')return STANDINGS_EMPRISE[standing]||0.45;
    if(secteur==='industriel')return 0.65;
    if(secteur==='agricole')return 0.50;
    return 0.45;
  },[secteur,standing]);

  const [emprise, setEmprise]=useState(empriseRec);
  React.useEffect(() => { setEmprise(empriseRec); }, [empriseRec]);

  const alerteEmprise=useMemo(()=>{
    const rec = STANDINGS_EMPRISE_REC[standing] || 0.35;
    const min = 0.25;
    const max = 0.65;
    if(emprise<min) return {type:'alert',msg:t("L'emprise est très faible pour ce type de projet. Vérifiez le PLU.")};
    if(emprise>max) return {type:'alert',msg:t("L'emprise dépasse la limite usuelle. Consultez les règles d'urbanisme.")};
    if(emprise<rec-0.05) return {type:'warn',msg:t("Emprise inférieure à la recommandation pour ce standing. Optimisation possible.")};
    if(emprise>rec+0.05) return {type:'info',msg:t("Emprise supérieure à la recommandation. Vérifiez les espaces libres requis.")};
    if(Math.abs(emprise-rec)<0.03) return {type:'success',msg:t("Emprise idéale pour votre standing.")};
    return null;
  },[emprise,standing]);

  const surfaceBatie=useMemo(()=>{
    if(secteur==='agricole'&&typeBat?.startsWith('elevage_')){
      return Math.round(effectif*(typeData?.ratio||5)*1.3);
    }
    const empriseAuSol=surface*emprise;
    return Math.round(empriseAuSol*niveaux+ssSol*empriseAuSol*0.85);
  },[surface,emprise,niveaux,ssSol,secteur,typeBat,effectif,typeData]);

  const hauteurTotale=useMemo(()=>{
    const h=hspRdc+0.30+(niveaux>1?(niveaux-1)*(hspEtage+0.25):0)+(ssSol>0?ssSol*(hspSoussol+0.25):0);
    return Math.round(h*10)/10+(secteur==='industriel'?1.5:2.5);
  },[hspRdc,hspEtage,hspSoussol,niveaux,ssSol,secteur]);

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

  // Catégorie - Matrice géotechnique V5.1 (7 cas)
  const categorie=useMemo(()=>{
    let cat='A1';
    let geoOblig=false;
    let mission='G1';
    const motifs=[];
    // Catégorie bâtiment
    if(niveaux>4||hauteurTotale>15){cat='B2';motifs.push('>R+4');}
    else if(niveaux>2||hauteurTotale>8){cat='A2';motifs.push('R+3 ou >8m');}
    if(['commerce','clinique'].includes(typeBat) || typeBat?.startsWith('hotel_')){motifs.push('ERP');}
    if(ssSol>0){motifs.push('Sous-sol');}

    // Matrice géotechnique (sol × niveaux) - 7 cas
    const bonsSols = ['ferralitique','ferrugineux','laterite','rocheux'];
    const solsMoyens = ['sableux','inconnu'];
    const solsRisque = ['argileux','hydromorphe'];

    if(sol){
      if(bonsSols.includes(sol)){
        if(niveaux<=2){mission='G1';}
        else if(niveaux<=4){mission='G2 AVP';geoOblig=true;motifs.push('G2 AVP');}
        else{mission='G2 PRO';geoOblig=true;motifs.push('G2 PRO');}
      } else if(solsMoyens.includes(sol)){
        if(niveaux<=1){mission='G1';}
        else{mission='G2 AVP';geoOblig=true;motifs.push('G2 AVP');}
      } else if(solsRisque.includes(sol)){
        mission='G2 AVP';geoOblig=true;motifs.push('G2 AVP');
        if(niveaux>=2||sol==='hydromorphe'){mission='G2 PRO';motifs.push('G2 PRO');}
      }
      if(ssSol>0 && !geoOblig){geoOblig=true;mission='G2 AVP';motifs.push('G2 AVP (ss-sol)');}
      else if(ssSol>1){mission='G2 PRO';motifs.push('G2 PRO');}
    }

    // Cas 7 : ERP + R+2 systématiquement G2 AVP
    if((['commerce','clinique'].includes(typeBat) || typeBat?.startsWith('hotel_')) && niveaux>=2){
      if(mission==='G1'){mission='G2 AVP';geoOblig=true;motifs.push('G2 AVP ERP');}
    }

    return{cat,geoOblig,motifs,mission};
  },[niveaux,hauteurTotale,typeBat,sol,ssSol]);

  // Durée (fourchette min-max) — alignée sur la grille FAQ
  const duree=useMemo(()=>{
    let d=6, dMin=0, dMax=0;
    if(secteur==='residentiel'&&typeBat==='villa'){
      // Fourchettes définies par la FAQ (par standing)
      if(standing==='prestige'){dMin=16;dMax=22;}
      else if(standing==='premium'||standing==='confort'){dMin=12;dMax=18;}
      else{dMin=8;dMax=12;}// standard par défaut
      // Ajustements terrain/soil
      const adjSol=(sol==='argileux'||sol==='hydromorphe')?2:0;
      const adjSsSol=ssSol>0?Math.round(ssSol*2.5):0;
      dMin+=adjSol+adjSsSol; dMax+=adjSol+adjSsSol;
      return{min:dMin,max:dMax};
    }
    if(secteur==='residentiel')d=14+(niveaux-2)*1.5;
    else if(secteur==='tertiaire')d=typeBat?.startsWith('hotel_')?18+(niveaux-3)*2:12+(niveaux-2)*1.5;
    else if(secteur==='industriel')d=surfaceBatie>3000?14:surfaceBatie>1500?10:7;
    else if(secteur==='agricole')d=5;
    if(ssSol>0)d+=ssSol*2.5;
    if(sol==='argileux'||sol==='hydromorphe')d+=2;
    const base=Math.max(4,d);
    const min=Math.max(4,Math.round(base*0.85));
    const max=Math.round(base*1.15);
    return{min,max};
  },[secteur,typeBat,niveaux,ssSol,surfaceBatie,sol,standing]);

  // FACTEURS D'ÉMISSION CO₂ (kgCO₂/kW installé/an — base 8h/j, 300j/an)
  const CO2_FACTORS = {
    eclairage: 0.35, // LED basse consommation
    prises: 0.25,
    climatisation: 0.65, // Clim split standard
    eau_chaude: 0.55,
    cuisine: 0.40,
    spa: 0.30,
    electromenager: 0.25,
    ascenseurs: 0.45,
    pont: 0.50,
    froid: 0.70, // Groupe froid haute conso
    alarme: 0.05,
    video: 0.12,
    piscine: 0.35,
    forage: 0.40,
    irrigation: 0.30,
    reseau: 0.60, // Facteur réseau CEET (moyen)
    solaire: 0.05, // Solaire (très faible)
    groupe: 0.85, // Groupe électrogène (élevé)
  };

  const getCo2Factor = (kw, factorKey) => {
    const f = CO2_FACTORS[factorKey] || 0.30;
    return Math.round(kw * f * 10) / 10;
  };

  // BESOINS ÉNERGÉTIQUES - CALCULÉS À L'ÉTAPE 5
  const besoins=useMemo(()=>{
    const details=[];
    let totalCo2 = 0;
    // Éclairage
    let pEcl=surfaceBatie*(secteur==='industriel'?0.008:secteur==='agricole'?0.005:0.012);
    let kwEcl=Math.round(pEcl*10)/10;
    details.push({label:t('Éclairage'),icon:'Lightbulb',kw:kwEcl,prio:1,co2:getCo2Factor(kwEcl,'eclairage')});
    // Prises
    let kwPr=Math.round(surfaceBatie*0.015*10)/10;
    details.push({label:t('Prises'),icon:'Plug',kw:kwPr,prio:2,co2:getCo2Factor(kwPr,'prises')});
    // Clim
    let surfClim=surfaceBatie*(secteur==='industriel'?0.15:secteur==='agricole'?0.10:0.70);
    if(surfClim>0){
      let kwClim=Math.round(surfClim*0.10*10)/10;
      details.push({label:t('Climatisation'),icon:'Snowflake',kw:kwClim,prio:5,co2:getCo2Factor(kwClim,'climatisation')});
    }
    // Hôtel
    if(typeBat?.startsWith('hotel_')){
      let kwEc=Math.round(nbChambres*0.3*10)/10;
      details.push({label:t('Eau chaude'),icon:'ShowerHead',kw:kwEc,prio:4,co2:getCo2Factor(kwEc,'eau_chaude')});
      if(espacesHotel.includes('restaurant'))details.push({label:t('Cuisine pro'),icon:'CookingPot',kw:15,prio:6,co2:getCo2Factor(15,'cuisine')});
      if(espacesHotel.includes('spa'))details.push({label:t('Spa'),icon:'Flower2',kw:12,prio:7,co2:getCo2Factor(12,'spa')});
    }
    if(secteur==='residentiel'){
      let kwEm=Math.round(surfaceBatie*0.008*10)/10;
      details.push({label:t('Électroménager'),icon:'CookingPot',kw:kwEm,prio:6,co2:getCo2Factor(kwEm,'electromenager')});
    }
    // Équipements
    if(nbAsc>0){
      let kwAsc=Math.round(nbAsc*12*0.15*10)/10;
      details.push({label:t('Ascenseurs'),icon:'ArrowUpSquare',kw:kwAsc,prio:9,co2:getCo2Factor(kwAsc,'ascenseurs')});
    }
    if(pontRoulant){
      let kwPont=Math.round((pontCap<=5?15:pontCap<=10?25:40)*0.2*10)/10;
      details.push({label:t('Pont roulant'),icon:'Construction',kw:kwPont,prio:10,co2:getCo2Factor(kwPont,'pont')});
    }
    if(typeBat==='chambre_froide'||groupeFroid){
      let kwFr=Math.round(surfaceBatie*(groupeFroid==='negatif'?0.15:0.08)*0.7*10)/10;
      details.push({label:t('Groupe froid'),icon:'Snowflake',kw:kwFr,prio:3,co2:getCo2Factor(kwFr,'froid')});
    }
    // Sécurité
    if(alarme)details.push({label:t('Alarme'),icon:'Bell',kw:0.5,prio:11,co2:getCo2Factor(0.5,'alarme')});
    if(video){
      let kwVid=video==='16+'?1.5:0.8;
      details.push({label:t('Vidéo'),icon:'Video',kw:kwVid,prio:3,co2:getCo2Factor(kwVid,'video')});
    }
    // Extérieurs
    if(piscine){
      let kWp=piscine==='12x5'?5:3.5;
      details.push({label:t('Piscine'),icon:'Waves',kw:kWp,prio:8,co2:getCo2Factor(kWp,'piscine')});
    }
    if(forage){
      let kwFo=secteur==='agricole'?5:2;
      details.push({label:t('Pompe forage'),icon:'Droplets',kw:kwFo,prio:7,co2:getCo2Factor(kwFo,'forage')});
    }
    if(irrigation==='goutte'){
      let kwIr=surfExploit*0.8;
      details.push({label:t('Irrigation'),icon:'Sprout',kw:kwIr,prio:7,co2:getCo2Factor(kwIr,'irrigation')});
    }
    
    details.sort((a,b)=>a.prio-b.prio);
    const total=Math.ceil(details.reduce((s,d)=>s+d.kw,0));
    const totalCo2Val=Math.round(details.reduce((s,d)=>s+(d.co2||0),0)*10)/10;
    return{details,total,totalCo2:totalCo2Val};
  },[surfaceBatie,secteur,typeBat,nbChambres,espacesHotel,nbAsc,pontRoulant,pontCap,groupeFroid,alarme,video,piscine,forage,irrigation,surfExploit]);

  // PROPOSITIONS SOLAIRES 40-150%
  const propositionsSolaires=useMemo(()=>{
    const props=[];
    const besoinTotal=besoins.total;
    if(besoinTotal<=0 || SOLAIRES.length === 0)return props;
    
    // 1. Calculate coverage for all kits
    const list = SOLAIRES.map(kit => {
      const couv = (kit.kw / besoinTotal) * 100;
      return { ...kit, couv };
    });

    // 2. Filter strictly between 40% and 150%
    const strict = list.filter(item => item.couv >= 40 && item.couv <= 150);

    let selected = [];
    if (strict.length >= 3) {
      // Pick first, middle, last from the strict range
      const first = strict[0];
      const last = strict[strict.length - 1];
      let bestMid = strict[0];
      let minDiff = Infinity;
      strict.forEach(item => {
        if (item.id !== first.id && item.id !== last.id) {
          const diff = Math.abs(item.couv - 100);
          if (diff < minDiff) {
            minDiff = diff;
            bestMid = item;
          }
        }
      });
      selected = Array.from(new Set([first, bestMid, last])).sort((a, b) => a.kw - b.kw);
    } else {
      // Less than 3, sort all by absolute distance to 100% and take 3 closest
      const sortedByDist = [...list].sort((a, b) => Math.abs(a.couv - 100) - Math.abs(b.couv - 100));
      selected = sortedByDist.slice(0, 3).sort((a, b) => a.kw - b.kw);
    }

    selected.forEach(kit => {
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
      
      props.push({...kit,couv:Math.round(kit.couv),couverts,nonCouverts,optimal:kit.couv>=90&&kit.couv<=120});
    });
    
    return props;
  },[besoins]);

  // PROPOSITIONS GROUPES 40-150%
  const propositionsGroupes=useMemo(()=>{
    const props=[];
    const besoinTotal=besoins.total*0.8;
    if(besoinTotal<=0 || GROUPES.length === 0)return props;
    
    // 1. Calculate coverage for all generators
    const list = GROUPES.map(grp => {
      const puissanceUtile = grp.kva * 0.8;
      const couv = (puissanceUtile / besoinTotal) * 100;
      return { ...grp, puissanceUtile, couv };
    });

    // 2. Filter strictly between 40% and 150%
    const strict = list.filter(item => item.couv >= 40 && item.couv <= 150);

    let selected = [];
    if (strict.length >= 3) {
      // Pick first, middle, last
      const first = strict[0];
      const last = strict[strict.length - 1];
      let bestMid = strict[0];
      let minDiff = Infinity;
      strict.forEach(item => {
        if (item.id !== first.id && item.id !== last.id) {
          const diff = Math.abs(item.couv - 100);
          if (diff < minDiff) {
            minDiff = diff;
            bestMid = item;
          }
        }
      });
      selected = Array.from(new Set([first, bestMid, last])).sort((a, b) => a.kva - b.kva);
    } else {
      const sortedByDist = [...list].sort((a, b) => Math.abs(a.couv - 100) - Math.abs(b.couv - 100));
      selected = sortedByDist.slice(0, 3).sort((a, b) => a.kva - b.kva);
    }

    selected.forEach(grp=>{
      let kwRestant=grp.puissanceUtile;
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
      
      props.push({...grp,couv:Math.round(grp.couv),couverts,nonCouverts,optimal:grp.couv>=90&&grp.couv<=120});
    });
    return props;
  },[besoins]);

  // ESTIMATION V5 — Min/Max natif par poste + marges graduées
  const estimation=useMemo(()=>{
    if(!surfaceBatie)return null;
    const solEffectif = sol || (mode==='express'?'ferralitique':'');
    if(!solEffectif)return null;
    const postes=[];
    let total=0, totalMin=0, totalMax=0;
    const marge = STANDINGS_MARGE[standing] || 0.20;
    const add=(code,nom,detail,montant,montantMin,montantMax)=>{
      const min = montantMin ?? Math.round(montant * (1 - marge));
      const max = montantMax ?? Math.round(montant * (1 + marge));
      postes.push({code,nom,detail,montant,montantMin:min,montantMax:max});
      total+=montant; totalMin+=min; totalMax+=max;
    };

    // Foncier
    let foncier=0, foncierMin=0, foncierMax=0;
    if(terrainDispo!=='oui'){
      foncier=surface*(zoneData?.foncier||0);
      foncierMin=Math.round(foncier*0.90);
      foncierMax=Math.round(foncier*1.10);
      postes.push({code:'0',nom:t('Acquisition foncière'),detail:`${Math.round(surface)} m²`,montant:foncier,montantMin:foncierMin,montantMax:foncierMax});
    }
    // Études 8%
    const baseEtudes = surfaceBatie*prixM2*coefTotal*0.08;
    add('1',t('Études et honoraires'),t('Architecture, structure, géotechnique'),baseEtudes);
    // Fondations
    let fond=surface*emprise*(solData?.prixFond||45000);
    if(secteur==='industriel')fond*=1.3;
    if(ssSol>0)fond+=ssSol*surface*emprise*SIMULATOR_PARAMS.sous_sol_prix;
    add('2',t('Terrassements et fondations'),t(solData?.fondation||'À définir'),fond);
    
    // Gros œuvre 38% — avec marge du standing
    const baseGo = surfaceBatie*prixM2*coefTotal*0.38;
    add('3',t('Gros œuvre'),t('Structure, maçonnerie, planchers'),baseGo, Math.round(baseGo*(1-marge)), Math.round(baseGo*(1+marge)));
    // Second œuvre 25%
    const baseSo = surfaceBatie*prixM2*coefTotal*0.25;
    add('4',t('Second œuvre'),t('Menuiseries, cloisons, plâtrerie'),baseSo, Math.round(baseSo*(1-marge)), Math.round(baseSo*(1+marge)));
    // Lots techniques 18%
    const baseLt = surfaceBatie*prixM2*coefTotal*0.18;
    add('5',t('Lots techniques'),t('Électricité, plomberie, CVC'),baseLt, Math.round(baseLt*(1-marge)), Math.round(baseLt*(1+marge)));
    // Finitions 11%
    const baseFn = surfaceBatie*prixM2*coefTotal*0.11;
    add('6',t('Finitions'),t('Revêtements, peinture, sanitaires'),baseFn, Math.round(baseFn*(1-marge)), Math.round(baseFn*(1+marge)));
    
    // Équipements spécifiques (poste 7) — fourchette symétrique
    let equip=0, equipMin=0, equipMax=0;
    if(nbAsc>0){
      const ascId = niveaux<=5 ? 'ascenseur_5n' : 'ascenseur_10n';
      const optAsc = SPECIFIQUES.find(o => o.id === ascId);
      const ascPrix = optAsc ? optAsc.prix : 28000000;
      equip+=nbAsc*ascPrix; equipMin+=nbAsc*Math.round(ascPrix*(1-marge)); equipMax+=nbAsc*Math.round(ascPrix*(1+marge));
    }
    if(nbQuais>0&&secteur==='industriel') {
      const optQuai = SPECIFIQUES.find(o => o.id === 'quai_chargement');
      const qPrix = optQuai ? optQuai.prix : 3500000;
      equip += nbQuais * qPrix;
      equipMin += nbQuais * Math.round(qPrix*(1-marge));
      equipMax += nbQuais * Math.round(qPrix*(1+marge));
    }
    if(pontRoulant) {
      const pRoulantId = pontCap <= 5 ? 'pont_roulant_5t' : 'pont_roulant_10t';
      const optPont = SPECIFIQUES.find(o => o.id === pRoulantId);
      const pPrix = optPont ? optPont.prix : (pontCap<=5?15000000:25000000);
      equip += pPrix;
      equipMin += Math.round(pPrix*(1-marge));
      equipMax += Math.round(pPrix*(1+marge));
    }
    if(groupeFroid){
      const fPrix = surfaceBatie*(groupeFroid==='negatif'?95000:55000);
      equip+=fPrix; equipMin+=Math.round(fPrix*(1-marge)); equipMax+=Math.round(fPrix*(1+marge));
    }
    if(irrigation) {
      const irrId = irrigation === 'goutte' ? 'irrigation_goutte_a_goutte' : 'irrigation_aspersion';
      const optIrr = EXTERIEUR_OPTS.find(o => o.id === irrId);
      const iPrix = surfExploit * (optIrr ? optIrr.prix : (irrigation === 'goutte' ? 1500000 : 2500000));
      equip += iPrix; equipMin += Math.round(iPrix*(1-marge)); equipMax += Math.round(iPrix*(1+marge));
    }
    if(equip>0)add('7',t('Équipements spécifiques'),t('Ascenseurs, quais, pont, froid'),equip,equipMin,equipMax);

    // Énergie (poste 8) — fourchette symétrique
    const kitSol = SOLAIRES.find(k => k.id === solaire);
    const grpKva = GROUPES.find(g => g.id === groupe);
    const enerPrix = (kitSol?.prix || 0) + (grpKva?.prix || 0);
    if (enerPrix > 0) add('8', t('Énergie'), `${kitSol ? kitSol.kw + ' kWc' : ''}${grpKva ? ' + ' + grpKva.kva + ' kVA' : ''}`.trim(), enerPrix);

    // Sécurité (poste 9) — fourchette symétrique
    let secu = 0, secuMin = 0, secuMax = 0;
    const optAlarme = SECURITE_OPTS.find(o => o.id === alarme);
    const optVideo = SECURITE_OPTS.find(o => o.id === video);
    const optAcces = SECURITE_OPTS.find(o => o.id === acces);
    if (optAlarme){ 
      const aPrix = optAlarme.prix + (nbZones * 125000);
      secu += aPrix;
      secuMin += Math.round(aPrix*(1-marge));
      secuMax += Math.round(aPrix*(1+marge));
    }
    if (optVideo){ 
      secu += optVideo.prix;
      secuMin += Math.round(optVideo.prix*(1-marge));
      secuMax += Math.round(optVideo.prix*(1+marge));
    }
    if (optAcces){ 
      const cPrix = optAcces.prix + (nbPortes * 320000);
      secu += cPrix;
      secuMin += Math.round(cPrix*(1-marge));
      secuMax += Math.round(cPrix*(1+marge));
    }
    if (secu > 0) add('9', t('Sécurité'), t('Alarme, vidéo, contrôle accès'), secu, secuMin, secuMax);

    // VRD (poste 10) — fourchette symétrique
    let vrd = surface * SIMULATOR_PARAMS.vrd_base_prix, vrdMin = Math.round(surface * SIMULATOR_PARAMS.vrd_base_prix*(1-marge)), vrdMax = Math.round(surface * SIMULATOR_PARAMS.vrd_base_prix*(1+marge));
    const optPortail = EXTERIEUR_OPTS.find(o => o.id === portail);
    const optPiscine = EXTERIEUR_OPTS.find(o => o.id === piscine);
    const optCiterne = EXTERIEUR_OPTS.find(o => o.id === citerne);
    const optPaysager = EXTERIEUR_OPTS.find(o => o.id === paysager);
    if (cloture){ 
      const clotPrix = perimetre * (clotureH <= 2 ? SIMULATOR_PARAMS.cloture_prix_bas : SIMULATOR_PARAMS.cloture_prix_haut);
      vrd += clotPrix; vrdMin += Math.round(clotPrix*(1-marge)); vrdMax += Math.round(clotPrix*(1+marge));
    }
    if (optPortail){ 
      vrd += optPortail.prix;
      vrdMin += Math.round(optPortail.prix*(1-marge));
      vrdMax += Math.round(optPortail.prix*(1+marge));
    }
    if (optPiscine){ 
      vrd += optPiscine.prix;
      vrdMin += Math.round(optPiscine.prix*(1-marge));
      vrdMax += Math.round(optPiscine.prix*(1+marge));
    }
    if (optCiterne){ 
      vrd += optCiterne.prix;
      vrdMin += Math.round(optCiterne.prix*(1-marge));
      vrdMax += Math.round(optCiterne.prix*(1+marge));
    }
    if (optPaysager){ 
      vrd += optPaysager.prix;
      vrdMin += Math.round(optPaysager.prix*(1-marge));
      vrdMax += Math.round(optPaysager.prix*(1+marge));
    }
    if (forage){
      const forageId = forageProf <= 30 ? 'forage_30m' : forageProf <= 60 ? 'forage_60m' : 'forage_60m';
      const optForage = EXTERIEUR_OPTS.find(o => o.id === forageId);
      const fPrix = optForage ? optForage.prix : (forageProf * SIMULATOR_PARAMS.forage_prix_m) + SIMULATOR_PARAMS.forage_fixe;
      vrd += fPrix; vrdMin += Math.round(fPrix*(1-marge)); vrdMax += Math.round(fPrix*(1+marge));
    }
    if (parkPlaces > 0){
      const pkId = parkType === 'souterrain' ? 'parking_souterrain' : parkType === 'couvert' ? 'parking_couvert' : 'parking_ext';
      const optPk = EXTERIEUR_OPTS.find(o => o.id === pkId);
      const pkPrix = parkPlaces * (optPk ? optPk.prix : 420000);
      vrd += pkPrix; vrdMin += Math.round(pkPrix*(1-marge)); vrdMax += Math.round(pkPrix*(1+marge));
    }
    // Domotique (intégré au poste 10)
    const optDomotique = DOMOTIQUE_OPTS.find(o => o.id === domotique);
    if (optDomotique){
      vrd += optDomotique.prix;
      vrdMin += Math.round(optDomotique.prix*(1-marge));
      vrdMax += Math.round(optDomotique.prix*(1+marge));
    }
    // Volets roulants (intégré au poste 10)
    const optVolet = SECONDE_OEUVRE_OPTS.find(o => o.id === volet);
    if (optVolet){
      vrd += optVolet.prix;
      vrdMin += Math.round(optVolet.prix*(1-marge));
      vrdMax += Math.round(optVolet.prix*(1+marge));
    }
    add('10', t('VRD et aménagements'), t('Clôture, portail, piscine, parking'), vrd, vrdMin, vrdMax);

    // Aléas 5% (min/max basés sur min/max totaux avant aléas)
    const avantAleas = total; const avantAleasMin = totalMin; const avantAleasMax = totalMax;
    add('11', t('Provisions aléas'), t('5% recommandé'), avantAleas*0.05, Math.round(avantAleasMin*0.05), Math.round(avantAleasMax*0.05));

    const estData = {
      postes,foncier,
      total:Math.round(total),
      totalMin:Math.round(foncierMin+totalMin),
      totalMax:Math.round(foncierMax+totalMax),
      min:Math.round((foncier+total)*0.90),
      max:Math.round((foncier+total)*(1+marge)),
      prixM2Hors:Math.round(total/surfaceBatie),
      marge,
      secteur, typeBat, standing, zone, sol, niveaux, ssSol,
      dimensions:{surface,surfaceBatie,hauteurTotale},
      besoins:besoins.total,
      duree, categorie:categorie.cat
    };
    window.SIM_DATA = estData;
    return estData;
  },[surfaceBatie,surface,emprise,prixM2,coefTotal,solData,zoneData,terrainDispo,sol,secteur,ssSol,niveaux,
     nbAsc,nbQuais,pontRoulant,pontCap,groupeFroid,irrigation,surfExploit,solaire,groupe,
     alarme,nbZones,video,acces,nbPortes,cloture,clotureH,perimetre,portail,piscine,forage,forageProf,
     parkPlaces,parkType,standing,domotique,volet,citerne,paysager]);

  // UTILITAIRES
  const fmt=n=>new Intl.NumberFormat('fr-FR').format(Math.round(n||0));
  const fmtM=n=>n>=1e9?(n/1e9).toFixed(2)+' Mrd':n>=1e6?(n/1e6).toFixed(1)+' M':fmt(n);
  const CURRENCY_RATES={FCFA:1,EUR:655.957,USD:600};
  const fmtC=(n,cur)=>{
    if(cur==='EUR'||cur==='USD')return fmt(n/CURRENCY_RATES[cur])+' '+cur;
    return fmt(n)+' FCFA';
  };
  const conv=(n,cur)=>{if(cur==='EUR'||cur==='USD')return Math.round(n/CURRENCY_RATES[cur]);return n;};

  const reset=()=>{
    setSecteur('');setTypeBat('');setStanding('standard');setCatHotel('3s');
    setForme('rect');setDimA(30);setDimB(20);setTerrainDispo('oui');
    setZone(Object.keys(ZONES)[0]||'zone1');setSol('');setNiveaux(1);setSsSol(0);
    setHspSoussol(STANDINGS_HSP_SOL['standard']||2.5);
    setNbChambres(30);setEspacesHotel([]);setHauteurLibre(8);setPontRoulant(false);setGroupeFroid('');
    setEffectif(100);setIrrigation('');setNbAsc(0);setSolaire('');setGroupe('');
    setAlarme('');setVideo('');setAcces('');
    setCloture(false);setPortail('');setPiscine('');setForage(false);setParkPlaces(0);
    setDomotique('');setVolet('');setCiterne('');setPaysager('');
    setHonoraires(0);setAssurance(false);setPrestations([]);
    setEtape(1);window.location.href = window.BACK_ROUTE;
  };

  const handleSaveSimulation = async () => {
    setIsSaving(true);
    
    const basePostes =['1', '2', '3', '4', '5', '6'];
    const base_amount = estimation.postes.filter(p => basePostes.includes(p.code)).reduce((s, p) => s + p.montant, 0);
    const options_amount = estimation.postes.filter(p => !basePostes.includes(p.code) && p.code !== '0' && p.code !== '11').reduce((s, p) => s + p.montant, 0);

    const data = {
        secteur, typeBat, standing, zone, sol, niveaux, ssSol,
        hspRdc, hspEtage, hspSoussol, emprise,
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
        honoraires,
        assurance,
        prestations,
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

  const Header=()=>{
    const displayEtape = etape;
    return (
    <header className="bg-white border-b sticky top-0 z-50 no-print">
      <div className="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <button onClick={() => window.location.href = window.BACK_ROUTE} className="flex items-center gap-3">
          <img src={window.LOGO_URL} className="w-12 h-12 object-contain" alt="AIAE Logo" />
        </button>
        <div className="flex items-center gap-4">
          <div className="hidden sm:flex items-center gap-1">
            {Array.from({length:totalSteps},(_,i)=>i+1).map(n=>(
              <div key={n} className="flex items-center">
                <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium ${n<displayEtape?'bg-[#05482C] text-white':n===displayEtape?'bg-[#0E1540] text-white':'bg-gray-200 text-gray-500'}`}>
                  {n<displayEtape?'✓':n}
                </div>
                {n<totalSteps&&<div className={`w-6 h-0.5 ${n<displayEtape?'bg-[#05482C]':'bg-gray-200'}`}/>}
              </div>
            ))}
          </div>
          {standing&&secteur==='residentiel'&&(
            <button onClick={()=>setEtape(1)} className="hidden sm:flex items-center gap-1.5 px-3 py-1 bg-amber-50 border border-amber-200 rounded-lg text-xs text-amber-700 hover:bg-amber-100 transition-colors cursor-pointer" title={t('Modifier le standing')}>
              <Icon name={STANDINGS[standing]?.icon||'Home'} size={14}/>
              <span className="font-medium">{t(STANDINGS[standing]?.name||standing)}</span>
              <svg className="w-3 h-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </button>
          )}
          <button onClick={() => window.location.href = window.BACK_ROUTE} className="text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1">
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth={2} d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            <span className="hidden sm:inline">{t('Nouveau')}</span>
          </button>
          <button onClick={() => window.location.href = window.HOME_ROUTE} className="flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm text-gray-600 hover:text-gray-800">
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span className="hidden sm:inline">{t('Accueil')}</span>
          </button>
        </div>
      </div>
    </header>
  );
  };

  const Nav=({canContinue=true, validationMsg=''})=>{
    const nextStep = () => {
      if (mode === 'express') {
        if (etape < 3) { setEtape(etape + 1); return; }
        handleSaveSimulation(); return;
      } else {
        if (etape < 6) setEtape(etape + 1);
        else handleSaveSimulation();
      }
    };
    const prevStep = () => {
      if (etape > 1) {
        setEtape(etape - 1);
      } else {
        window.location.href = window.BACK_ROUTE;
      }
    };
    return (
    <div className="mt-8 pt-6 border-t no-print">
      {!canContinue&&validationMsg&&(
        <div className="mb-3 flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-lg text-sm text-amber-700">
          <svg className="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4.5c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
          <span>{validationMsg}</span>
        </div>
      )}
      <div className="flex justify-between items-center">
        <button 
          onClick={prevStep}
          className="flex items-center gap-2 px-5 py-2.5 text-gray-600 hover:text-gray-800 rounded-lg"
        >
          ← {t('Retour')}
        </button>
        <button 
          onClick={nextStep}
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
            <>{etape === (mode === 'express' ? 3 : 6) ? t('Demander un devis') : t('Continuer')} →</>
          )}
        </button>
      </div>
    </div>
  );
  };

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
            <p className="text-blue-200 text-lg">AFRIKA INFRASTRUCTURES AND EQUIPEMENTS (AIAE)</p>
          </div>
          {/* Sélecteur de mode Express/Expert */}
          <div className="bg-white/10 backdrop-blur rounded-2xl p-4 mb-6">
            <div className="flex items-center justify-center gap-4">
              <span className="text-white/70 text-sm font-medium">{t('Mode :')}</span>
              <button onClick={()=>setMode('express')} className={`px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ${mode==='express'?'bg-white text-[#0E1540] shadow-lg':'bg-white/20 text-white hover:bg-white/30'}`}>
                <span className="flex items-center gap-2">
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                  {t('Express')}
                  <span className="text-[10px] opacity-60">3 {t('étapes')}</span>
                </span>
              </button>
              <button onClick={()=>setMode('expert')} className={`px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ${mode==='expert'?'bg-white text-[#0E1540] shadow-lg':'bg-white/20 text-white hover:bg-white/30'}`}>
                <span className="flex items-center gap-2">
                  <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                  {t('Expert')}
                  <span className="text-[10px] opacity-60">6 {t('étapes')}</span>
                </span>
              </button>
            </div>
            <p className="text-blue-200 text-xs text-center mt-3">
              {mode==='express'?t('Parcours rapide : secteur, surface, estimation directe'):t('Parcours complet : terrain, sol, équipements, options')}
            </p>
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
          <div className="text-center mt-12 text-blue-300 text-xs">© 2025 AIAE (Afrika Infrastructures And Equipements) • Quartier Kléme Zanguéra, Lomé, Togo</div>
        </div>
      </div>
    );
  }

  // SIMULATEUR
  return(
    <div className="min-h-screen bg-gray-50">
      <Header/>
      {/* Encart estimation temps réel */}
      {etape>=3&&estimation&&<div className="fixed right-4 top-24 z-40 no-print w-64 card p-4 shadow-xl hidden lg:block" style={{maxHeight:'calc(100vh - 120px)',overflowY:'auto'}}>
        <div className="text-xs text-gray-500 mb-1">{t('Estimation temps réel')}</div>
        <div className="flex gap-1 mb-1">
          {['FCFA','EUR','USD'].map(c=>(
            <button key={c} onClick={()=>setCurrency(c)}
              className={`px-1.5 py-0.5 rounded text-[10px] font-semibold transition ${currency===c?'bg-blue-100 text-blue-700':'text-gray-400 hover:text-gray-600'}`}>{c}</button>
          ))}
        </div>
        <div className="text-2xl font-bold mono" style={{color:'var(--bleu)'}}>{fmtC(estimation.foncier+estimation.total,currency)}</div>
        <div className="flex justify-between text-xs text-gray-500 mt-1">
          <span>{t('Min')} {fmtC(estimation.totalMin,currency)}</span>
          <span>{t('Max')} {fmtC(estimation.totalMax,currency)}</span>
        </div>
        <div className="mt-2 pt-2 border-t border-gray-100 text-xs text-gray-500">
          <div className="flex justify-between"><span>{t('Surface')}</span><span className="mono">{fmt(surfaceBatie)} m²</span></div>
          <div className="flex justify-between"><span>{t('Niveaux')}</span><span>R+{Math.max(0,niveaux-1)}{ssSol>0?'+'+ssSol+'ss':''}</span></div>
          <div className="flex justify-between"><span>{t('Prix/m²')}</span><span className="mono">{fmtM(estimation.prixM2Hors)}</span></div>
          {sol&&<div className="flex justify-between"><span>Coef</span><span className="mono">×{coefTotal.toFixed(2)}</span></div>}
        </div>
      </div>}
      <main className="max-w-5xl mx-auto px-4 py-6">
        
        {/* ÉTAPE 1: TYPE - SANS PRIX */}
        {etape===1&&(
          <div>
            {/* En Express, combiner type + standing + niveaux */}
            {mode==='express'&&<div className="mb-4">
              <h2 className="text-xl font-bold text-gray-800">{t('Configurez votre projet')}</h2>
              <p className="text-gray-500 text-sm">{t('Type, standing et dimensions en un clin d\'œil')}</p>
            </div>}
            <div className="mb-6">
              <h2 className="text-xl font-bold text-gray-800">{t('Type de projet')}</h2>
              <p className="text-gray-500 text-sm">{t('Secteur:')} {{'residentiel':t('Résidentiel'),'tertiaire':t('Tertiaire'),'industriel':t('Industriel'),'agricole':t('Agricole')}[secteur]||secteur}</p>
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
                <h3 className="font-semibold text-gray-700 mb-4">{t('Niveau de standing')}<InfoIcon text={t('Les standings déterminent la qualité des matériaux, finitions et équipements inclus.')}/></h3>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                  {Object.entries(STANDINGS).map(([id,d])=>(
                    <div key={id} className={`relative option-btn ${standing===id?'selected':''}`}>
                      <button onClick={()=>setStanding(id)} className="w-full text-left">
                        <div className={`mb-3 p-2 rounded-lg w-fit ${standing===id?'bg-white/20':'bg-gray-50'}`}>
                          <Icon name={d.icon} size={24} />
                        </div>
                        <div className="font-semibold text-gray-800">{t(d.name)}</div>
                        <div className="text-xs text-gray-500 mt-1 leading-relaxed">
                          {t(d.desc)}
                        </div>
                        <div className="text-xs text-gray-400 mt-1 mono">
                          {fmt(STANDINGS_PRIX[id]||d.prix)} à {fmt(STANDINGS_PRIX_MAX[id]||d.prix_max)} FCFA/m²
                          <span className="text-gray-300"> (≈ {Math.round((STANDINGS_PRIX[id]||d.prix)/EUR_RATE)} à {Math.round((STANDINGS_PRIX_MAX[id]||d.prix_max)/EUR_RATE)} €/m²)</span>
                        </div>
                      </button>
                      <button onClick={(e)=>{e.stopPropagation();setShowN2(id);}} className="text-xs text-[#CC6A00] hover:text-[#0E1540] transition-colors mt-2 px-1 underline underline-offset-2">
                        {t('En savoir plus')}
                      </button>
                    </div>
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
            <Nav canContinue={!!typeBat} validationMsg={!typeBat?t('Veuillez sélectionner un type de bâtiment pour continuer.'):''}/>
          </div>
        )}

        {/* ÉTAPE 2: TERRAIN (Expert) */}
        {mode!=='express'&&etape===2&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">{t('Caractéristiques du terrain')}</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Forme et dimensions')}<InfoIcon text={t('La forme du terrain influence le coût des fondations et la faisabilité du projet. Pour les formes irrégulières, entrez la surface directement.')}/></h3>
                <div className="grid grid-cols-3 gap-2 mb-4">
                  {['carre','rect','irregulier'].map(f=>(
                    <button key={f} onClick={()=>setForme(f)} className={`py-2 px-3 rounded text-sm font-medium ${forme===f?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                      {f==='carre'?t('Carré'):f==='rect'?t('Rectangle'):t('Irrégulier')}
                    </button>
                  ))}
                </div>
                {forme!=='irregulier'?(
                  <div className="grid grid-cols-2 gap-4">
                    <InputNum value={dimA} onChange={setDimA} min={10} max={200} step={0.5} unit="m" label={forme==='carre'?t('Côté'):t('Longueur')}/>
                    {forme!=='carre'&&<InputNum value={dimB} onChange={setDimB} min={10} max={200} step={0.5} unit="m" label={t('Largeur')}/>}
                  </div>
                ):(
                  <InputNum value={surfManuelle} onChange={setSurfManuelle} min={100} max={50000} step={0.5} unit="m²" label={t('Surface')}/>
                )}
                <div className="mt-4 p-4 bg-blue-50 rounded-lg grid grid-cols-2 gap-4">
                  <div><div className="text-xs text-gray-500">{t('Surface')}</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(surface)} m²</div></div>
                  <div><div className="text-xs text-gray-500">{t('Périmètre')}</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(perimetre)} ml</div></div>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Disponibilité')}<InfoIcon text={t("La disponibilité du terrain impacte le délai et le budget. 'Disponible' = construction immédiate. 'En option' = terrain réservé. 'À acquérir' = coût d'acquisition inclus.")}/></h3>
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
              <h3 className="font-semibold text-gray-700 mb-4">{t('Zone géographique')}<InfoIcon text={t('La zone influence le coût foncier et le coefficient géographique.')}/></h3>
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
              <h3 className="font-semibold text-gray-700 mb-4">{t('Type de sol')}<InfoIcon text={t('Le type de sol détermine le coefficient géotechnique et le type de fondations.')}/></h3>
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
              {sol&&(sol==='argileux'||sol==='hydromorphe')&&<div className="alert-box mt-4"><strong>⚠️ {t('Sol à risque')}</strong><p className="text-sm mt-1">{t('Étude géotechnique G2 AVP fortement recommandée.')}</p></div>}
            </div>
            <Nav canContinue={!!sol} validationMsg={!sol?t('Veuillez sélectionner un type de sol pour continuer.'):''}/>
        </div>
      )}

        {/* ÉTAPE 3: BÂTIMENT */}
        {etape===3&&mode!=='express'&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">{t('Configuration du bâtiment')}</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Niveaux')}<InfoIcon text={t('Le nombre de niveaux influence la catégorie du bâtiment et les études géotechniques requises.')}/></h3>
                <div className="grid grid-cols-2 gap-4">
                  <InputNum value={niveaux} onChange={setNiveaux} min={1} max={typeData?.max||10} label={t('Niveaux hors sol')}/>
                  <InputNum value={ssSol} onChange={setSsSol} min={0} max={3} label={t('Sous-sols')}/>
                </div>
                <div className="grid grid-cols-2 gap-4 mt-4">
                  <InputNum value={hspRdc} onChange={setHspRdc} min={STANDINGS_HSP_RDC[standing]?2.4:2.4} max={STANDINGS_HSP_RDC[standing]?3.6:6} step={0.1} unit="m" label={t('HSP RDC')}/>
                  <InputNum value={hspEtage} onChange={setHspEtage} min={STANDINGS_HSP_ETAGE[standing]?2.2:2.4} max={STANDINGS_HSP_ETAGE[standing]?3.2:4} step={0.1} unit="m" label={t('HSP Étages')}/>
                  {ssSol>0&&<InputNum value={hspSoussol} onChange={setHspSoussol} min={2.0} max={3.0} step={0.1} unit="m" label={t('HSP Sous-sol')}/>}
                </div>
                <div className="mt-3 text-xs text-gray-400 flex gap-4">
                  <span className="px-2 py-1 bg-blue-50 rounded">{t('Recommandé')}: RDC {STANDINGS_HSP_RDC[standing]||'3.0'}m · Étage {STANDINGS_HSP_ETAGE[standing]||'2.8'}m · Sous-sol {STANDINGS_HSP_SOL[standing]||'2.5'}m</span>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">{t('Synthèse technique')}<InfoIcon text={t("L'emprise au sol est le rapport entre la surface bâtie et la surface du terrain. Une emprise de 25-40% est classique pour une villa individuelle.")}/></h3>
                <div className="space-y-3">
                  <div className="flex justify-between items-center">
                    <span className="text-gray-500">{t('Emprise au sol')}</span>
                    <div className="flex items-center gap-3">
                      <span className="text-xs text-gray-400">25%</span>
                      <div className="relative">
                        <input type="range" min={25} max={65} value={Math.round(emprise*100)} onChange={e=>setEmprise(e.target.value/100)} className="w-28 h-1.5 accent-[#0E1540]" />
                        <div className="absolute -top-1 left-0 right-0 pointer-events-none flex justify-center">
                          <div className="w-0.5 h-3 bg-green-500" style={{marginLeft:`${((STANDINGS_EMPRISE_REC[standing]||0.35)*100-25)/40*100}%`}}></div>
                        </div>
                      </div>
                      <span className="text-xs text-gray-400">65%</span>
                      <span className="mono font-semibold w-12 text-right">{Math.round(emprise*100)}%</span>
                    </div>
                  </div>
                  <div className="flex justify-between text-[10px] text-gray-400 -mt-1">
                    <span>{t('Recommandé')}: {Math.round((STANDINGS_EMPRISE_REC[standing]||0.35)*100)}%</span>
                    <span>{t('Votre choix')}</span>
                  </div>
                  {alerteEmprise&&<div className={`${alerteEmprise.type==='alert'?'alert-box':alerteEmprise.type==='warn'?'warn-box':alerteEmprise.type==='success'?'success-box':'info-box'} text-xs py-1 px-2`}>{alerteEmprise.msg}</div>}
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
                      {e === 'salle_conf' ? t('Salle de conférence') : t(e.charAt(0).toUpperCase() + e.slice(1))}
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

        {/* ÉTAPE 2: SURFACE ET LOCALISATION (Express) */}
        {mode==='express'&&etape===2&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">{t('Surface et localisation')}</h2></div>
            <div className="card p-6 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Surface du terrain')}<InfoIcon text={t("Surface totale du terrain en m². La surface de plancher (bâtie) sera calculée selon l'emprise au sol.")}/></h3>
              <div className="flex items-center gap-4">
                <InputNum value={surfManuelle} onChange={(v)=>{setSurfManuelle(v);setForme('irregulier');}} min={20} max={50000} step={0.5} unit="m²"/>
              </div>
              <div className="mt-4 flex items-center gap-4 p-4 bg-blue-50 rounded-lg">
                <span className="text-sm text-gray-600">{t('Niveaux:')}</span>
                <div className="flex gap-2">
                  {[1,2,3,4,5,6].map(n=>(
                    <button key={n} onClick={()=>setNiveaux(n)} className={`px-3 py-1.5 rounded text-sm ${niveaux===n?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{n}</button>
                  ))}
                </div>
              </div>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Zone géographique')}<InfoIcon text={t('La zone influence le coût foncier et le coefficient géographique.')}/></h3>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
                {Object.entries(ZONES).map(([id,z])=>(
                  <button key={id} onClick={()=>setZone(id)} className={`option-btn ${zone===id?'selected':''}`}>
                    <div className="font-medium">{t(z.name)}</div>
                    <div className="text-xs text-gray-500">{t(z.localites)}</div>
                  </button>
                ))}
              </div>
            </div>
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
                        {SECURITE_OPTS.filter(o=>o.id.includes('alarme')).map(a=>{
                          const badge=getBadge(a);
                          return (<button key={a.id} onClick={()=>setAlarme(a.id)} className={`px-2 py-1 rounded text-xs relative ${alarme===a.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                            {t(a.name||'').replace(t('Alarme'),'').replace('Alarm','').replace('Alarme','').trim()}
                            {badge&&<span className={`ml-1 px-1 py-0.5 rounded text-[9px] font-medium border ${badge.cls}`}>{badge.label}</span>}
                          </button>);
                        })}
                    </div>
                    {alarme&&<InputNum value={nbZones} onChange={setNbZones} min={2} max={24} label={t('Zones')}/>}
                  </div>
                  <div>
                    <label className="text-sm text-gray-600">{t('Vidéosurveillance')}</label>
                    <div className="flex flex-wrap gap-2 mt-2">
                      <button onClick={()=>setVideo('')} className={`px-2 py-1 rounded text-xs ${!video?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                      {SECURITE_OPTS.filter(o=>o.id.includes('video')).map(v=>{
                        const badge=getBadge(v);
                        return (<button key={v.id} onClick={()=>setVideo(v.id)} className={`px-2 py-1 rounded text-xs relative ${video===v.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                          {t(v.name||'').replace(t('Vidéosurveillance'),'').replace('Video Surveillance','').replace('Vidéosurveillance','').trim()}
                          {badge&&<span className={`ml-1 px-1 py-0.5 rounded text-[9px] font-medium border ${badge.cls}`}>{badge.label}</span>}
                        </button>);
                      })}
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
                    {EXTERIEUR_OPTS.filter(o=>o.id.includes('portail')).map(p=>{
                      const badge=getBadge(p);
                      return (<button key={p.id} onClick={()=>setPortail(p.id)} className={`px-2 py-1 rounded text-xs relative ${portail===p.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                        {t(p.name||'').replace(t('Portail'),'').replace('Gate','').replace('Portail','').trim()}
                        {badge&&<span className={`ml-1 px-1 py-0.5 rounded text-[9px] font-medium border ${badge.cls}`}>{badge.label}</span>}
                      </button>);
                    })}
                  </div>
                </div>
                <div>
                  <label className="text-sm text-gray-600">{t('Piscine')}</label>
                  <div className="flex flex-wrap gap-2 mt-2">
                    <button onClick={()=>setPiscine('')} className={`px-2 py-1 rounded text-xs ${!piscine?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Non')}</button>
                    {EXTERIEUR_OPTS.filter(o=>o.id.includes('piscine')).map(p=>{
                      const badge=getBadge(p);
                      return (<button key={p.id} onClick={()=>setPiscine(p.id)} className={`px-2 py-1 rounded text-xs relative ${piscine===p.id?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                        {t(p.name||'').replace(t('Piscine'),'').replace('Pool','').replace('Piscine','').trim()}
                        {badge&&<span className={`ml-1 px-1 py-0.5 rounded text-[9px] font-medium border ${badge.cls}`}>{badge.label}</span>}
                      </button>);
                    })}
                  </div>
                </div>
              </div>
              <div className="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={forage} onChange={e=>setForage(e.target.checked)} className="w-4 h-4"/>
                    <span>{t('Forage')} (~{zoneData?.forage||'?'}m)</span>
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

            {/* DOMOTIQUE */}
            {DOMOTIQUE_OPTS.length>=2&&<GammeSlider opts={DOMOTIQUE_OPTS} value={domotique} onChange={setDomotique} label={t('Domotique')} desc={t('Éclairage, stores, chauffage connectés')}/>}

            {/* SECOND ŒUVRE — Volets roulants */}
            {SECONDE_OEUVRE_OPTS.filter(o=>o.id.includes('volet')).length>=2&&<GammeSlider opts={SECONDE_OEUVRE_OPTS.filter(o=>o.id.includes('volet'))} value={volet} onChange={setVolet} label={t('Volets roulants')} desc={t('PVC manuel, alu motorisé ou connecté')}/>}

            {/* CITERNE EAU DE PLUIE */}
            {EXTERIEUR_OPTS.filter(o=>o.id.includes('citerne')).length>=2&&<GammeSlider opts={EXTERIEUR_OPTS.filter(o=>o.id.includes('citerne'))} value={citerne} onChange={setCiterne} label={t('Citerne eau de pluie')} desc={t('Récupération et stockage des eaux pluviales')}/>}

            {/* AMÉNAGEMENT PAYSAGER */}
            {EXTERIEUR_OPTS.filter(o=>o.id.includes('paysager')).length>=2&&<GammeSlider opts={EXTERIEUR_OPTS.filter(o=>o.id.includes('paysager'))} value={paysager} onChange={setPaysager} label={t('Aménagement paysager')} desc={t('Espaces verts et aménagements extérieurs')}/>}

            <Nav/>
          </div>
        )}

        {/* ÉTAPE 5: OPTIONS COMPLÉMENTAIRES */}
        {mode==='expert'&&etape===5&&(
          <div>
            <div className="mb-6">
              <h2 className="text-xl font-bold text-gray-800">{t('Options complémentaires')}</h2>
              <p className="text-gray-500 text-sm">{t('Honoraires, assurances et prestations')}</p>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t("Honoraires de maîtrise d'œuvre")}</h3>
              <div className="flex gap-3 flex-wrap">
                {[
                  {v:0, label: t('Standard 8%')},
                  {v:1, label: t('Suivi renforcé 12%')},
                  {v:2, label: t('Mission complète 15%')}
                ].map(opt=>(
                  <button key={opt.v} onClick={()=>setHonoraires(opt.v)} className={`px-4 py-2 rounded text-sm ${honoraires===opt.v?'bg-[#0E1540] text-white':'bg-gray-100'}`}>
                    {opt.label}
                  </button>
                ))}
              </div>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Assurance')}</h3>
              <div className="flex gap-3 flex-wrap">
                <button onClick={()=>setAssurance(false)} className={`px-4 py-2 rounded text-sm ${!assurance?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Sans')}</button>
                <button onClick={()=>setAssurance(true)} className={`px-4 py-2 rounded text-sm ${assurance?'bg-[#0E1540] text-white':'bg-gray-100'}`}>{t('Assurance dommage-ouvrage')}</button>
              </div>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">{t('Prestations complémentaires')}</h3>
              <div className="space-y-2">
                {[['etude_geotechnique', t('Étude géotechnique G2')],['etude_thermique', t('Étude thermique RT')],['etude_acoustique', t('Étude acoustique')],['topographie', t('Relevé topographique')]].map(([id,label])=>(
                  <label key={id} className="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" checked={prestations.includes(id)} onChange={()=>setPrestations(prev=>prev.includes(id)?prev.filter(p=>p!==id):[...prev,id])} className="w-4 h-4"/>
                    <span className="text-sm">{label}</span>
                  </label>
                ))}
              </div>
            </div>
            <Nav canContinue={true}/>
          </div>
        )}

        {/* ÉTAPE 6: RÉCAP + ÉNERGIE + ESTIMATION (Expert) / ÉTAPE 3 (Express) */}
        {((mode==='express'&&etape===3)||(mode==='expert'&&etape===6))&&estimation&&(
          <div>
            <div className="flex justify-between items-center mb-6 no-print">
              <div>
                <h2 className="text-xl font-bold text-gray-800">{t('Récapitulatif et estimation')}</h2>
                <p className="text-gray-500 text-sm">{t('Besoins énergétiques - Propositions - Estimation')}</p>
              </div>
              <div className="flex gap-2">
                <button onClick={()=>{
                  const w = window.open('', '_blank');
                  if(w){
                    w.document.write(`<html><head><title>${t('Génération PDF...')}</title></head><body>${t('Chargement...')}</body></html>`);
                    fetch(window.SAVE_ROUTE.replace('/save','/pdf'), {
                      method:'POST',
                      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Accept':'text/html'},
                      body:JSON.stringify(window.SIM_DATA||{})
                    }).then(r=>r.text()).then(html=>{w.document.write(html);w.document.close();}).catch(()=>w.close());
                  }
                }} className="flex items-center gap-2 px-4 py-2 bg-[#05482C] text-white rounded-lg hover:brightness-110">
                  <Icon name="FileText" size={18} />
                  PDF
                </button>
                <button onClick={()=>window.print()} className="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">
                  <Icon name="Printer" size={18} />
                  {t('Imprimer')}
                </button>
              </div>
            </div>

            {/* Synthèse */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4 flex items-center gap-2">
                <Icon name="ClipboardList" className="text-[#0E1540]" />
                {t('Synthèse du projet')}
              </h3>
              <div className="grid md:grid-cols-4 gap-4">
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Type')}</div><div className="font-semibold">{t(typeData?.name||typeBat)}</div><div className="text-xs text-gray-500">{standing?t(STANDINGS[standing]?.name):''}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Terrain')}</div><div className="font-semibold mono">{fmt(surface)} m²</div><div className="text-xs text-gray-500">{t(zoneData?.name||'')}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Surface plancher')}</div><div className="font-semibold mono">{fmt(surfaceBatie)} m²</div><div className="text-xs text-gray-500">{niveaux===1?t('Plain-pied'):`R+${niveaux-1}`}{ssSol>0?` + ${ssSol} ss`:''} <span className="text-gray-400">·</span> <span className="mono">{fmt(Math.round(emprise*100))}% emprise</span></div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">{t('Durée estimée')}</div><div className="font-semibold">{duree.min}-{duree.max} {t('mois')} <span className="text-[10px] text-gray-400 font-normal">({t('estimatif')})</span></div></div>
              </div>
              {secteur!=='agricole'&&(
                <div className="mt-3 px-3 py-2 bg-blue-50 rounded-lg text-xs text-blue-600 flex items-center gap-2">
                  <Icon name="Info" size={14}/>
                  <span>{t('Surface plancher')} = {t('Terrain')} × {t('emprise')} → <span className="mono font-semibold">{fmt(surface)} m² × {fmt(Math.round(emprise*100))}% = {fmt(surfaceBatie)} m²</span></span>
                </div>
              )}
            </div>

            {/* BESOINS ÉNERGÉTIQUES */}
            <div className="card p-5 mb-6" style={{background:'linear-gradient(135deg, var(--orange) 0%, #ea580c 100%)'}}>
              <h3 className="font-bold text-white mb-4 flex items-center gap-2">
                <Icon name="Zap" />
                {t('Besoins énergétiques calculés')}
              </h3>
              <div className="flex flex-wrap items-end gap-6 mb-4">
                <div>
                  <div className="text-4xl font-bold text-white mono">{besoins.total} kW</div>
                  <div className="text-white/60 text-xs">{t('Puissance totale installée')}</div>
                </div>
                <div>
                  <div className="text-2xl font-bold text-white mono">~{besoins.totalCo2} tCO₂e</div>
                  <div className="text-white/60 text-xs">{t('Émissions annuelles estimées')}</div>
                </div>
              </div>
              <div className="grid grid-cols-2 md:grid-cols-4 gap-2">
                {besoins.details.map((d,i)=>(
                  <div key={i} className="bg-white/20 rounded px-3 py-2 text-white">
                    <div className="flex items-center justify-between mb-1">
                      <div className="flex items-center gap-2">
                        <Icon name={d.icon} size={14} />
                        <span className="text-sm">{d.label}</span>
                      </div>
                      <span className="mono font-semibold">{Number(d.kw || 0).toFixed(1)}</span>
                    </div>
                    {d.co2>0&&<div className="text-xs text-white/70 text-right mono">{d.co2} tCO₂e</div>}
                  </div>
                ))}
              </div>
              <div className="mt-4 flex items-center gap-4">
                <div className="h-2 flex-1 rounded-full bg-white/30 overflow-hidden flex">
                  <div className="h-full bg-green-400" style={{width:besoins.totalCo2<10?'100%':besoins.totalCo2<30?'60%':'30%'}}></div>
                  <div className="h-full bg-amber-400" style={{width:besoins.totalCo2<10?'0%':besoins.totalCo2<30?'40%':'40%'}}></div>
                  <div className="h-full bg-red-400" style={{width:besoins.totalCo2<10?'0%':besoins.totalCo2<30?'0%':'30%'}}></div>
                </div>
                <span className="text-white/70 text-xs whitespace-nowrap">
                  {besoins.totalCo2<10?t('Faible'):besoins.totalCo2<30?t('Modéré'):t('Élevé')}
                </span>
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
                  <thead><tr className="border-b"><th className="text-left py-2 px-2">{t('Code')}</th><th className="text-left py-2">{t('Poste')}</th><th className="text-left py-2">{t('Détail')}</th><th className="text-right py-2 px-2">{t('Min')}</th><th className="text-right py-2 px-2">{t('Max')}</th><th className="text-right py-2 px-2">{t('Montant')}</th></tr></thead>
                  <tbody>
                    {estimation.postes.map((p,i)=>(<tr key={i} className="border-b border-gray-100"><td className="py-2 px-2 text-gray-400 mono">{p.code}</td><td className="py-2 font-medium">{p.nom}</td><td className="py-2 text-gray-500 text-xs">{p.detail}</td><td className="py-2 px-2 text-right mono text-green-600">{fmtM(p.montantMin)}</td><td className="py-2 px-2 text-right mono text-orange-600">{fmtM(p.montantMax)}</td><td className="py-2 px-2 text-right mono font-semibold">{fmtM(p.montant)}</td></tr>))}
                  </tbody>
                </table>
              </div>
            </div>

            {/* TOTAL */}
            <div className="card p-6" style={{background:'linear-gradient(135deg, var(--bleu) 0%, #1e3a8a 100%)'}}>
              <div className="text-center">
                <div className="text-white/70 text-sm mb-2">{t('Estimation totale projet')}</div>
                <div className="flex items-center justify-center gap-4 mb-2">
                  {['FCFA','EUR','USD'].map(c=>(
                    <button key={c} onClick={()=>setCurrency(c)}
                      className={`px-3 py-1 rounded text-xs font-semibold transition ${currency===c?'bg-white/20 text-white':'bg-white/5 text-white/50 hover:bg-white/10'}`}>{c}</button>
                  ))}
                </div>
                <div className="text-4xl md:text-5xl font-bold text-white mono mb-4">{fmtC(estimation.foncier+estimation.total,currency)}</div>
                <div className="flex justify-center gap-8 text-white/80 text-sm">
                  <div><div className="text-xs">{t('Estimation basse')}</div><div className="font-semibold mono">{fmtC(estimation.totalMin,currency)}</div></div>
                  <div><div className="text-xs">{t('Estimation haute')}</div><div className="font-semibold mono">{fmtC(estimation.totalMax,currency)}</div></div>
                </div>
                <div className="mt-4 text-white/60 text-xs">{t('Durée estimée:')} {duree.min}-{duree.max} {t('mois')} <span className="text-white/40">({t('estimatif, non contractuel')})</span> • {t('Catégorie:')} {categorie.cat} • {t('Géotechnique:')} {categorie.mission}</div>
                <div className="mt-2 text-amber-300/70 text-[10px]">{t('⚠ Délai estimatif hors impact saison des pluies (juin-sept.). Prévoir +20-30% si le gros œuvre couvre cette période.')}</div>
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
        © 2025 AIAE (Afrika Infrastructures And Equipements) • contact@aiae.services • Quartier Kléme Zanguéra, Lomé, Togo<br/>
        {t('Simulateur v')}{VERSION} • {t('Référentiel Décembre 2025')}
      </footer>

      {/* MODALE NIVEAU 2 — En savoir plus */}
      {showN2&&STANDINGS_N2[showN2]&&(
        <div className="fixed inset-0 z-[100] flex items-center justify-center p-4" style={{background:'rgba(0,0,0,0.6)'}} onClick={()=>setShowN2(null)}>
          <div className="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto" onClick={e=>e.stopPropagation()}>
            <div className="sticky top-0 bg-white rounded-t-2xl flex items-center justify-between p-5 border-b border-gray-100">
              <div className="flex items-center gap-3">
                <Icon name={STANDINGS[showN2]?.icon||'Home'} size={24} className="text-[#0E1540]" />
                <h3 className="text-lg font-bold text-gray-800">{STANDINGS[showN2]?.name}</h3>
              </div>
              <button onClick={()=>setShowN2(null)} className="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                <svg className="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12"/></svg>
              </button>
            </div>
            <div className="p-5">
              <p className="text-sm text-gray-500 mb-1">{STANDINGS_N2[showN2].title}</p>
              <p className="text-gray-700 leading-relaxed mb-4">{STANDINGS_N2[showN2].desc}</p>
              <div className="bg-gray-50 rounded-xl p-4 mb-4">
                <p className="font-semibold text-gray-800 text-sm mb-2">{t('Ce que vous obtenez :')}</p>
                <ul className="space-y-2">
                  {STANDINGS_N2[showN2].includes.map((item,i)=>(
                    <li key={i} className="text-sm text-gray-700 flex gap-2">
                      <span className="text-[#0E1540] shrink-0 mt-0.5">-</span>
                      <span>{item}</span>
                    </li>
                  ))}
                </ul>
              </div>
              {STANDINGS_N2[showN2].options!==t('—')&&(
                <p className="text-sm text-gray-500 mb-2"><span className="font-medium">{t('En option :')}</span> {STANDINGS_N2[showN2].options}</p>
              )}
              <p className="text-sm text-gray-400 italic">{STANDINGS_N2[showN2].footer}</p>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

ReactDOM.createRoot(document.getElementById('root')).render(<App/>);
@endverbatim
</script>
<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('frontend.partials.cookie-consent')
  @include('frontend.partials.whatsapp-button')
</body>
</html>