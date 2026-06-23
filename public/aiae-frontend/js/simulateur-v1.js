/* AIAE — simulateur-v1 (compiled, do not edit) */
(function () {
  function boot() {
    if (!window.React || !window.ReactDOM) {
      console.error('[AIAE] React non chargé — vérifiez les scripts vendor.');
      return;
    }
    try {
const {
  useState,
  useMemo
} = React;
const t = key => window.AIAE_SIM_TRANSLATIONS ? window.AIAE_SIM_TRANSLATIONS[key] || key : key;
const InputNum = ({
  value,
  onChange,
  min = 0,
  max = 999,
  step = 1,
  unit = '',
  label = ''
}) => {
  const isDecimal = step % 1 !== 0 || min % 1 !== 0;
  return React.createElement("div", {
    className: "flex flex-col"
  }, label && React.createElement("label", {
    className: "text-xs text-gray-500 mb-1"
  }, label), React.createElement("div", {
    className: "input-num"
  }, React.createElement("button", {
    onClick: () => {
      const current = parseFloat(value) || 0;
      const next = Math.max(min, current - step);
      onChange(isDecimal ? Math.round(next * 100) / 100 : Math.round(next));
    }
  }, "\u2212"), React.createElement("div", {
    className: "flex-1 flex items-center justify-center min-w-[70px]"
  }, React.createElement("input", {
    type: "number",
    value: value,
    min: min,
    max: max,
    step: isDecimal ? "any" : "1",
    onChange: e => {
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
    },
    onBlur: () => {
      let val = parseFloat(value);
      if (isNaN(val)) val = min;
      const rounded = isDecimal ? Math.round(val * 100) / 100 : Math.round(val);
      onChange(Math.min(max, Math.max(min, rounded)));
    },
    className: "w-full text-center font-semibold font-mono bg-transparent border-none outline-none focus:outline-none focus:ring-0 p-0 text-gray-800",
    style: {
      fontFamily: 'JetBrains Mono, monospace'
    }
  }), unit && React.createElement("span", {
    className: "text-xs text-gray-500 mr-2"
  }, unit)), React.createElement("button", {
    onClick: () => {
      const current = parseFloat(value) || 0;
      const next = Math.min(max, current + step);
      onChange(isDecimal ? Math.round(next * 100) / 100 : Math.round(next));
    }
  }, "+")));
};
const App = () => {
  const VERSION = '8.1';
  const Icon = ({
    name,
    size = 20,
    className = "",
    ...props
  }) => {
    const iconRef = React.useRef(null);
    React.useEffect(() => {
      if (window.lucide && iconRef.current) {
        const kebabName = name.replace(/([a-z0-9])([A-Z])/g, '$1-$2').toLowerCase();
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
    return React.createElement("span", {
      ref: iconRef,
      className: "inline-flex items-center justify-center lucide-icon-wrapper",
      style: {
        minWidth: size,
        minHeight: size,
        lineHeight: 0
      }
    });
  };
  const libConfig = window.SIMULATEUR_CONFIG || {};
  const ZONES = libConfig.ZONES || {
    zone1: {
      name: 'Zone 1 - Grand Lomé',
      localites: 'Lomé, Baguida, Agoè',
      coef: 1.00,
      forage: 25,
      foncier: 75000
    },
    zone2: {
      name: 'Zone 2 - Maritime',
      localites: 'Tsévié, Tabligbo, Aného',
      coef: 1.08,
      forage: 35,
      foncier: 25000
    },
    zone3: {
      name: 'Zone 3 - Plateaux',
      localites: 'Atakpamé, Kpalimé, Badou',
      coef: 1.14,
      forage: 50,
      foncier: 12000
    },
    zone4: {
      name: 'Zone 4 - Centrale',
      localites: 'Sokodé, Tchamba, Blitta',
      coef: 1.19,
      forage: 60,
      foncier: 6000
    },
    zone5: {
      name: 'Zone 5 - Kara & Savanes',
      localites: 'Kara, Dapaong, Mango',
      coef: 1.25,
      forage: 75,
      foncier: 4000
    }
  };
  const SOLS = libConfig.SOLS || {
    inconnu: {
      name: t('Non déterminé'),
      coef: 1.15,
      portance: '?',
      fondation: t('À définir après étude'),
      prixFond: 55000,
      risque: 'moyen'
    },
    ferralitique: {
      name: t('Ferralitique (Terre de barre)'),
      coef: 1.00,
      portance: '1.5-2.5 bars',
      fondation: t('Semelles filantes'),
      prixFond: 32000,
      risque: 'faible'
    },
    ferrugineux: {
      name: t('Ferrugineux tropical'),
      coef: 1.10,
      portance: '1.0-2.0 bars',
      fondation: t('Semelles renforcées'),
      prixFond: 38000,
      risque: 'faible'
    },
    laterite: {
      name: t('Latérite / Cuirasse'),
      coef: 1.03,
      portance: '3.0-5.0 bars',
      fondation: t('Semelles réduites'),
      prixFond: 28000,
      risque: 'faible'
    },
    argileux: {
      name: t('Argileux') + ' ⚠️',
      coef: 1.30,
      portance: '0.5-1.5 bars',
      fondation: t('Radier ou pieux'),
      prixFond: 75000,
      risque: 'élevé'
    },
    sableux: {
      name: t('Sableux'),
      coef: 1.18,
      portance: '1.0-2.0 bars',
      fondation: t('Semelles + compactage'),
      prixFond: 48000,
      risque: 'moyen'
    },
    hydromorphe: {
      name: t('Hydromorphe') + ' ⚠️⚠️',
      coef: 1.55,
      portance: '0.3-1.0 bars',
      fondation: t('Pieux profonds'),
      prixFond: 120000,
      risque: 'très élevé'
    },
    rocheux: {
      name: t('Rocheux'),
      coef: 0.98,
      portance: '>5 bars',
      fondation: t('Ancrages roche'),
      prixFond: 25000,
      risque: 'faible'
    }
  };
  const STANDINGS = libConfig.STANDINGS || {
    standard: {
      name: t('Standard'),
      desc: t('Économique et fonctionnel'),
      icon: 'Home'
    },
    confort: {
      name: t('Confort'),
      desc: t('Qualité-prix optimal'),
      icon: 'Armchair'
    },
    premium: {
      name: t('Premium'),
      desc: t('Excellence et personnalisation'),
      icon: 'Gem'
    },
    prestige: {
      name: t('Prestige'),
      desc: t('Luxe sans compromis'),
      icon: 'Crown'
    }
  };
  const STANDINGS_PRIX = {};
  const STANDINGS_HSP = {};
  const STANDINGS_EMPRISE = {};
  Object.entries(STANDINGS).forEach(([k, v]) => {
    STANDINGS_PRIX[k] = v.prix || 500000;
    STANDINGS_HSP[k] = v.hsp || 2.80;
    STANDINGS_EMPRISE[k] = v.emprise || 0.35;
  });
  const TYPES = libConfig.TYPES || {
    residentiel: [{
      id: 'villa',
      name: t('Villa individuelle'),
      max: 3,
      icon: 'Home'
    }, {
      id: 'immeuble',
      name: t('Immeuble résidentiel'),
      max: 10,
      icon: 'Building2'
    }, {
      id: 'residence',
      name: t('Résidence de standing'),
      max: 12,
      maj: 1.15,
      icon: 'Building'
    }],
    tertiaire: [{
      id: 'bureaux',
      name: t('Bureaux'),
      max: 20,
      prix: 520000,
      icon: 'Briefcase'
    }, {
      id: 'commerce',
      name: t('Commerce'),
      max: 4,
      prix: 450000,
      icon: 'Store'
    }, {
      id: 'hotel',
      name: t('Hôtel'),
      max: 20,
      prix: 625000,
      icon: 'Hotel'
    }, {
      id: 'clinique',
      name: t('Clinique'),
      max: 6,
      prix: 720000,
      icon: 'Hospital'
    }],
    industriel: [{
      id: 'entrepot',
      name: t('Entrepôt'),
      max: 2,
      prix: 220000,
      icon: 'Box'
    }, {
      id: 'usine',
      name: t('Usine'),
      max: 3,
      prix: 350000,
      icon: 'Factory'
    }, {
      id: 'atelier',
      name: t('Atelier'),
      max: 2,
      prix: 280000,
      icon: 'Wrench'
    }, {
      id: 'frigo',
      name: t('Chambre froide'),
      max: 2,
      prix: 480000,
      icon: 'Snowflake'
    }],
    agricole: [{
      id: 'hangar',
      name: t('Hangar'),
      max: 1,
      prix: 120000,
      icon: 'Warehouse'
    }, {
      id: 'elevage_bovins',
      name: t('Élevage bovins'),
      max: 1,
      prix: 85000,
      ratio: 8,
      icon: 'Beef'
    }, {
      id: 'elevage_volailles',
      name: t('Volailles'),
      max: 1,
      prix: 45000,
      ratio: 0.1,
      icon: 'Bird'
    }, {
      id: 'serres',
      name: t('Serres'),
      max: 1,
      prix: 65000,
      icon: 'Sprout'
    }, {
      id: 'stockage',
      name: t('Silos'),
      max: 1,
      prix: 150000,
      icon: 'Wheat'
    }]
  };
  const HOTELS = [{
    id: '1s',
    name: '★',
    surfCh: 16
  }, {
    id: '2s',
    name: '★★',
    surfCh: 18
  }, {
    id: '3s',
    name: '★★★',
    surfCh: 22
  }, {
    id: '4s',
    name: '★★★★',
    surfCh: 28
  }, {
    id: '5s',
    name: '★★★★★',
    surfCh: 35
  }, {
    id: 'palace',
    name: 'Palace',
    surfCh: 50
  }];
  const HOTELS_PRIX = {
    '1s': 430000,
    '2s': 500000,
    '3s': 625000,
    '4s': 800000,
    '5s': 1175000,
    'palace': 2000000
  };
  const SOLAIRES = libConfig.SOLAIRES || [];
  const GROUPES = libConfig.GROUPES || [];
  const SECURITE_OPTS = libConfig.SECURITE || [];
  const EXTERIEUR_OPTS = libConfig.EXTERIEUR || [];
  const DOMOTIQUE_OPTS = libConfig.DOMOTIQUE || [];
  const qs = window.QUICK_START || {};
  const initSecteur = qs.secteur || window.INITIAL_SECTEUR || '';
  const fromHomePage = !!qs.standing;
  const [mode, setMode] = useState(qs.mode || 'express');
  const [etape, setEtape] = useState(initSecteur ? fromHomePage ? 2 : 1 : 1);
  const [secteur, setSecteur] = useState(initSecteur);
  const [typeBat, setTypeBat] = useState('');
  const [standing, setStanding] = useState(qs.standing || 'confort');
  const [catHotel, setCatHotel] = useState('3s');
  const [forme, setForme] = useState('rect');
  const initialSurf = qs.surface || 600;
  const [dimA, setDimA] = useState(Math.round(Math.sqrt(initialSurf)));
  const [dimB, setDimB] = useState(Math.round(Math.sqrt(initialSurf)));
  const [surfManuelle, setSurfManuelle] = useState(initialSurf);
  const [terrainDispo, setTerrainDispo] = useState('oui');
  const [zone, setZone] = useState('zone1');
  const [sol, setSol] = useState('');
  const [niveaux, setNiveaux] = useState(1);
  const [ssSol, setSsSol] = useState(0);
  const [hspRdc, setHspRdc] = useState(3.0);
  const [hspEtage, setHspEtage] = useState(2.8);
  const [nbChambres, setNbChambres] = useState(qs.nb_beds ? parseInt(qs.nb_beds) : 3);
  const [espacesHotel, setEspacesHotel] = useState(qs.espaces_communs === "1" ? ['accueil'] : []);
  const SPECIFIQUES = libConfig.SPECIFIQUE || [];
  const hasOpt = key => qs.options && qs.options.includes(key);
  const [hauteurLibre, setHauteurLibre] = useState(8);
  const [pontRoulant, setPontRoulant] = useState(hasOpt('pont_roulant_5t') || hasOpt('pont_roulant_10t'));
  const [pontCap, setPontCap] = useState(hasOpt('pont_roulant_10t') ? 10 : 5);
  const [groupeFroid, setGroupeFroid] = useState('');
  const [effectif, setEffectif] = useState(100);
  const initIrrigation = hasOpt('irrigation_goutte_a_goutte') ? 'goutte' : hasOpt('irrigation_aspersion') ? 'aspersion' : '';
  const [irrigation, setIrrigation] = useState(initIrrigation);
  const [surfExploit, setSurfExploit] = useState(5);
  const [nbAsc, setNbAsc] = useState(0);
  const [nbQuais, setNbQuais] = useState(hasOpt('quai_chargement') ? 2 : 0);
  const [solaire, setSolaire] = useState(hasOpt('solaire') ? SOLAIRES[0]?.id || '' : '');
  const [groupe, setGroupe] = useState('');
  const [alarme, setAlarme] = useState('');
  const [nbZones, setNbZones] = useState(6);
  const [video, setVideo] = useState('');
  const [acces, setAcces] = useState('');
  const [nbPortes, setNbPortes] = useState(2);
  const [cloture, setCloture] = useState(hasOpt('cloture'));
  const [clotureH, setClotureH] = useState(2);
  const [portail, setPortail] = useState('');
  const [piscine, setPiscine] = useState(hasOpt('piscine') ? 'piscine_8x4' : '');
  const [forage, setForage] = useState(hasOpt('forage'));
  const [forageProf, setForageProf] = useState(30);
  const [parkType, setParkType] = useState('');
  const [parkPlaces, setParkPlaces] = useState(0);
  const [isSaving, setIsSaving] = useState(false);
  const surface = useMemo(() => {
    if (forme === 'carre') return dimA * dimA;
    if (forme === 'rect') return dimA * dimB;
    return surfManuelle;
  }, [forme, dimA, dimB, surfManuelle]);
  const perimetre = useMemo(() => {
    if (forme === 'carre') return 4 * dimA;
    if (forme === 'rect') return 2 * (dimA + dimB);
    return Math.sqrt(surfManuelle) * 4 * 1.1;
  }, [forme, dimA, dimB, surfManuelle]);
  const typeData = TYPES[secteur]?.find(t => t.id === typeBat);
  const zoneData = ZONES[zone];
  const solData = SOLS[sol];
  const coefTotal = (zoneData?.coef || 1) * (solData?.coef || 1.15);
  const emprise = useMemo(() => {
    if (secteur === 'residentiel') return STANDINGS_EMPRISE[standing] || 0.35;
    if (secteur === 'industriel') return 0.65;
    if (secteur === 'agricole') return 0.50;
    return 0.40;
  }, [secteur, standing]);
  const surfaceBatie = useMemo(() => {
    if (secteur === 'agricole' && typeBat?.startsWith('elevage_')) {
      return Math.round(effectif * (typeData?.ratio || 5) * 1.3);
    }
    const empriseAuSol = surface * emprise;
    return Math.round(empriseAuSol * niveaux + ssSol * empriseAuSol * 0.85);
  }, [surface, emprise, niveaux, ssSol, secteur, typeBat, effectif, typeData]);
  const hauteurTotale = useMemo(() => {
    const h = hspRdc + 0.30 + (niveaux > 1 ? (niveaux - 1) * (hspEtage + 0.25) : 0);
    return Math.round(h * 10) / 10 + (secteur === 'industriel' ? 1.5 : 2.5);
  }, [hspRdc, hspEtage, niveaux, secteur]);
  const prixM2 = useMemo(() => {
    if (secteur === 'residentiel') return (STANDINGS_PRIX[standing] || 500000) * (typeData?.maj || 1);
    if (secteur === 'industriel') {
      let base = typeData?.prix || 250000;
      if (hauteurLibre > 10) base *= 1.12;
      if (pontRoulant) base *= 1.15;
      if (typeBat === 'chambre_froide') base *= 1.25;
      return Math.round(base);
    }
    return typeData?.prix || 450000;
  }, [secteur, typeBat, standing, typeData, catHotel, hauteurLibre, pontRoulant]);
  const categorie = useMemo(() => {
    let cat = 'A1';
    let geoOblig = false;
    const motifs = [];
    if (niveaux > 4 || hauteurTotale > 15) {
      cat = 'B2';
      geoOblig = true;
      motifs.push('>R+4');
    } else if (niveaux > 2 || hauteurTotale > 8) {
      cat = 'A2';
      geoOblig = true;
      motifs.push('R+3 ou >8m');
    }
    if (['commerce', 'clinique'].includes(typeBat) || typeBat?.startsWith('hotel_')) {
      geoOblig = true;
      motifs.push('ERP');
    }
    if (sol === 'argileux' || sol === 'hydromorphe') {
      geoOblig = true;
      motifs.push('Sol risque');
    }
    if (ssSol > 0) {
      geoOblig = true;
      motifs.push('Sous-sol');
    }
    return {
      cat,
      geoOblig,
      motifs,
      mission: geoOblig ? cat === 'B2' ? 'G2 PRO' : 'G2 AVP' : 'G1'
    };
  }, [niveaux, hauteurTotale, typeBat, sol, ssSol]);
  const duree = useMemo(() => {
    let d = 6;
    if (secteur === 'residentiel') d = typeBat === 'villa' ? 8 : 14 + (niveaux - 2) * 1.5;else if (secteur === 'tertiaire') d = typeBat?.startsWith('hotel_') ? 18 + (niveaux - 3) * 2 : 12 + (niveaux - 2) * 1.5;else if (secteur === 'industriel') d = surfaceBatie > 3000 ? 14 : surfaceBatie > 1500 ? 10 : 7;else if (secteur === 'agricole') d = 5;
    if (ssSol > 0) d += ssSol * 2.5;
    if (sol === 'argileux' || sol === 'hydromorphe') d += 2;
    return Math.round(Math.max(4, d));
  }, [secteur, typeBat, niveaux, ssSol, surfaceBatie, sol]);
  const besoins = useMemo(() => {
    const details = [];
    let pEcl = surfaceBatie * (secteur === 'industriel' ? 0.008 : secteur === 'agricole' ? 0.005 : 0.012);
    details.push({
      label: t('Éclairage'),
      icon: 'Lightbulb',
      kw: Math.round(pEcl * 10) / 10,
      prio: 1
    });
    details.push({
      label: t('Prises'),
      icon: 'Plug',
      kw: Math.round(surfaceBatie * 0.015 * 10) / 10,
      prio: 2
    });
    let surfClim = surfaceBatie * (secteur === 'industriel' ? 0.15 : secteur === 'agricole' ? 0.10 : 0.70);
    if (surfClim > 0) details.push({
      label: t('Climatisation'),
      icon: 'Snowflake',
      kw: Math.round(surfClim * 0.10 * 10) / 10,
      prio: 5
    });
    if (typeBat?.startsWith('hotel_')) {
      details.push({
        label: t('Eau chaude'),
        icon: 'ShowerHead',
        kw: Math.round(nbChambres * 0.3 * 10) / 10,
        prio: 4
      });
      if (espacesHotel.includes('restaurant')) details.push({
        label: t('Cuisine pro'),
        icon: 'CookingPot',
        kw: 15,
        prio: 6
      });
      if (espacesHotel.includes('spa')) details.push({
        label: t('Spa'),
        icon: 'Flower2',
        kw: 12,
        prio: 7
      });
    }
    if (secteur === 'residentiel') details.push({
      label: t('Électroménager'),
      icon: 'CookingPot',
      kw: Math.round(surfaceBatie * 0.008 * 10) / 10,
      prio: 6
    });
    if (nbAsc > 0) details.push({
      label: t('Ascenseurs'),
      icon: 'ArrowUpSquare',
      kw: Math.round(nbAsc * 12 * 0.15 * 10) / 10,
      prio: 9
    });
    if (pontRoulant) details.push({
      label: t('Pont roulant'),
      icon: 'Construction',
      kw: Math.round((pontCap <= 5 ? 15 : pontCap <= 10 ? 25 : 40) * 0.2 * 10) / 10,
      prio: 10
    });
    if (typeBat === 'chambre_froide' || groupeFroid) details.push({
      label: t('Groupe froid'),
      icon: 'Snowflake',
      kw: Math.round(surfaceBatie * (groupeFroid === 'negatif' ? 0.15 : 0.08) * 0.7 * 10) / 10,
      prio: 3
    });
    if (alarme) details.push({
      label: t('Alarme'),
      icon: 'Bell',
      kw: 0.5,
      prio: 11
    });
    if (video) details.push({
      label: t('Vidéo'),
      icon: 'Video',
      kw: video === '16+' ? 1.5 : 0.8,
      prio: 3
    });
    if (piscine) details.push({
      label: t('Piscine'),
      icon: 'Waves',
      kw: piscine === '12x5' ? 5 : 3.5,
      prio: 8
    });
    if (forage) details.push({
      label: t('Pompe forage'),
      icon: 'Droplets',
      kw: secteur === 'agricole' ? 5 : 2,
      prio: 7
    });
    if (irrigation === 'goutte') details.push({
      label: t('Irrigation'),
      icon: 'Sprout',
      kw: surfExploit * 0.8,
      prio: 7
    });
    details.sort((a, b) => a.prio - b.prio);
    const total = Math.ceil(details.reduce((s, d) => s + d.kw, 0));
    return {
      details,
      total
    };
  }, [surfaceBatie, secteur, typeBat, nbChambres, espacesHotel, nbAsc, pontRoulant, pontCap, groupeFroid, alarme, video, piscine, forage, irrigation, surfExploit]);
  const propositionsSolaires = useMemo(() => {
    const props = [];
    const besoinTotal = besoins.total;
    if (besoinTotal <= 0 || SOLAIRES.length === 0) return props;
    const list = SOLAIRES.map(kit => {
      const couv = kit.kw / besoinTotal * 100;
      return {
        ...kit,
        couv
      };
    });
    const strict = list.filter(item => item.couv >= 40 && item.couv <= 150);
    let selected = [];
    if (strict.length >= 3) {
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
      const sortedByDist = [...list].sort((a, b) => Math.abs(a.couv - 100) - Math.abs(b.couv - 100));
      selected = sortedByDist.slice(0, 3).sort((a, b) => a.kw - b.kw);
    }
    selected.forEach(kit => {
      let kwRestant = kit.kw;
      const couverts = [];
      const nonCouverts = [];
      besoins.details.forEach(eq => {
        if (kwRestant >= eq.kw) {
          couverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim());
          kwRestant -= eq.kw;
        } else if (kwRestant > 0) {
          const pct = Math.round(kwRestant / eq.kw * 100);
          if (pct >= 30) couverts.push(`${eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim()} (${pct}%)`);else nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim());
          kwRestant = 0;
        } else {
          nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim());
        }
      });
      props.push({
        ...kit,
        couv: Math.round(kit.couv),
        couverts,
        nonCouverts,
        optimal: kit.couv >= 90 && kit.couv <= 120
      });
    });
    return props;
  }, [besoins]);
  const propositionsGroupes = useMemo(() => {
    const props = [];
    const besoinTotal = besoins.total * 0.8;
    if (besoinTotal <= 0 || GROUPES.length === 0) return props;
    const list = GROUPES.map(grp => {
      const puissanceUtile = grp.kva * 0.8;
      const couv = puissanceUtile / besoinTotal * 100;
      return {
        ...grp,
        puissanceUtile,
        couv
      };
    });
    const strict = list.filter(item => item.couv >= 40 && item.couv <= 150);
    let selected = [];
    if (strict.length >= 3) {
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
    selected.forEach(grp => {
      let kwRestant = grp.puissanceUtile;
      const couverts = [];
      const nonCouverts = [];
      besoins.details.forEach(eq => {
        if (kwRestant >= eq.kw) {
          couverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim());
          kwRestant -= eq.kw;
        } else {
          nonCouverts.push(eq.label.replace(/[^\w\sÀ-ÿ]/g, '').trim());
        }
      });
      props.push({
        ...grp,
        couv: Math.round(grp.couv),
        couverts,
        nonCouverts,
        optimal: grp.couv >= 90 && grp.couv <= 120
      });
    });
    return props;
  }, [besoins]);
  const estimation = useMemo(() => {
    if (!surfaceBatie || !sol) return null;
    const postes = [];
    let total = 0;
    const add = (code, nom, detail, montant) => {
      postes.push({
        code,
        nom,
        detail,
        montant
      });
      total += montant;
    };
    let foncier = 0;
    if (terrainDispo !== 'oui') {
      foncier = surface * zoneData.foncier;
      postes.push({
        code: '0',
        nom: t('Acquisition foncière'),
        detail: `${Math.round(surface)} m²`,
        montant: foncier
      });
    }
    add('1', t('Études et honoraires'), t('Architecture, structure, géotechnique'), surfaceBatie * prixM2 * coefTotal * 0.08);
    let fond = surface * emprise * (solData?.prixFond || 45000);
    if (secteur === 'industriel') fond *= 1.3;
    if (ssSol > 0) fond += ssSol * surface * emprise * 85000;
    add('2', t('Terrassements et fondations'), t(solData?.fondation || 'À définir'), fond);
    add('3', t('Gros œuvre'), t('Structure, maçonnerie, planchers'), surfaceBatie * prixM2 * coefTotal * 0.38);
    add('4', t('Second œuvre'), t('Menuiseries, cloisons, plâtrerie'), surfaceBatie * prixM2 * coefTotal * 0.25);
    add('5', t('Lots techniques'), t('Électricité, plomberie, CVC'), surfaceBatie * prixM2 * coefTotal * 0.18);
    add('6', t('Finitions'), t('Revêtements, peinture, sanitaires'), surfaceBatie * prixM2 * coefTotal * 0.11);
    let equip = 0;
    if (nbAsc > 0) equip += nbAsc * (niveaux <= 5 ? 28000000 : 35000000);
    if (nbQuais > 0 && secteur === 'industriel') {
      const optQuai = SPECIFIQUES.find(o => o.id === 'quai_chargement');
      equip += nbQuais * (optQuai ? optQuai.prix : 3500000);
    }
    if (pontRoulant) {
      const pRoulantId = pontCap <= 5 ? 'pont_roulant_5t' : 'pont_roulant_10t';
      const optPont = SPECIFIQUES.find(o => o.id === pRoulantId);
      equip += optPont ? optPont.prix : pontCap <= 5 ? 15000000 : 25000000;
    }
    if (groupeFroid) equip += surfaceBatie * (groupeFroid === 'negatif' ? 95000 : 55000);
    if (irrigation) {
      const irrId = irrigation === 'goutte' ? 'irrigation_goutte_a_goutte' : 'irrigation_aspersion';
      const optIrr = EXTERIEUR_OPTS.find(o => o.id === irrId);
      equip += surfExploit * (optIrr ? optIrr.prix : irrigation === 'goutte' ? 1500000 : 2500000);
    }
    if (equip > 0) add('7', t('Équipements spécifiques'), t('Ascenseurs, quais, pont, froid'), equip);
    const kitSol = SOLAIRES.find(k => k.id === solaire);
    const grpKva = GROUPES.find(g => g.id === groupe);
    const energie = (kitSol?.prix || 0) + (grpKva?.prix || 0);
    if (energie > 0) add('8', t('Énergie'), `${kitSol ? kitSol.kw + ' kWc' : ''}${grpKva ? ' + ' + grpKva.kva + ' kVA' : ''}`.trim(), energie);
    let secu = 0;
    const optAlarme = SECURITE_OPTS.find(o => o.id === alarme);
    const optVideo = SECURITE_OPTS.find(o => o.id === video);
    const optAcces = SECURITE_OPTS.find(o => o.id === acces);
    if (optAlarme) secu += optAlarme.prix + nbZones * 125000;
    if (optVideo) secu += optVideo.prix;
    if (optAcces) secu += optAcces.prix + nbPortes * 320000;
    if (secu > 0) add('9', t('Sécurité'), t('Alarme, vidéo, contrôle accès'), secu);
    let vrd = surface * 8500;
    const optPortail = EXTERIEUR_OPTS.find(o => o.id === portail);
    const optPiscine = EXTERIEUR_OPTS.find(o => o.id === piscine);
    const optForage = EXTERIEUR_OPTS.find(o => o.id.includes('forage'));
    if (cloture) vrd += perimetre * (clotureH <= 2 ? 88000 : 135000);
    if (optPortail) vrd += optPortail.prix;
    if (optPiscine) vrd += optPiscine.prix;
    if (forage) vrd += forageProf * 95000 + 1200000;
    if (parkPlaces > 0) vrd += parkPlaces * (parkType === 'souterrain' ? 3800000 : parkType === 'couvert' ? 1350000 : 420000);
    add('10', t('VRD et aménagements'), t('Clôture, portail, piscine, parking'), vrd);
    add('11', t('Provisions aléas'), t('5% recommandé'), total * 0.05);
    return {
      postes,
      foncier,
      total,
      min: Math.round((foncier + total) * 0.90),
      max: Math.round((foncier + total) * 1.15),
      prixM2Hors: Math.round(total / surfaceBatie)
    };
  }, [surfaceBatie, surface, emprise, prixM2, coefTotal, solData, zoneData, terrainDispo, sol, secteur, ssSol, niveaux, nbAsc, nbQuais, pontRoulant, pontCap, groupeFroid, irrigation, surfExploit, solaire, groupe, alarme, nbZones, video, acces, nbPortes, cloture, clotureH, perimetre, portail, piscine, forage, forageProf, parkPlaces, parkType]);
  const fmt = n => new Intl.NumberFormat('fr-FR').format(Math.round(n || 0));
  const fmtM = n => n >= 1e9 ? (n / 1e9).toFixed(2) + ' Mrd' : n >= 1e6 ? (n / 1e6).toFixed(1) + ' M' : fmt(n);
  const reset = () => {
    setSecteur('');
    setTypeBat('');
    setStanding('confort');
    setCatHotel('3s');
    setForme('rect');
    setDimA(30);
    setDimB(20);
    setTerrainDispo('oui');
    setZone('zone1');
    setSol('');
    setNiveaux(1);
    setSsSol(0);
    setNbChambres(30);
    setEspacesHotel([]);
    setHauteurLibre(8);
    setPontRoulant(false);
    setGroupeFroid('');
    setEffectif(100);
    setIrrigation('');
    setNbAsc(0);
    setSolaire('');
    setGroupe('');
    setAlarme('');
    setVideo('');
    setAcces('');
    setCloture(false);
    setPortail('');
    setPiscine('');
    setForage(false);
    setParkPlaces(0);
    setEtape(1);
  };
  const handleSaveSimulation = async () => {
    setIsSaving(true);
    const basePostes = ['1', '2', '3', '4', '5', '6'];
    const base_amount = estimation.postes.filter(p => basePostes.includes(p.code)).reduce((s, p) => s + p.montant, 0);
    const options_amount = estimation.postes.filter(p => !basePostes.includes(p.code) && p.code !== '0' && p.code !== '11').reduce((s, p) => s + p.montant, 0);
    const data = {
      secteur,
      typeBat,
      standing,
      zone,
      sol,
      niveaux,
      ssSol,
      dimensions: {
        surface,
        surfaceBatie,
        hauteurTotale
      },
      besoins: besoins.total,
      solaire,
      groupe,
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
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
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
  const Header = () => {
    const stepList = mode === 'express' ? [1, 2, 3] : [1, 2, 3, 4, 5];
    const maxSteps = mode === 'express' ? 3 : 5;
    const displayEtape = mode === 'express' ? (etape === 1 ? 1 : etape === 3 ? 2 : 3) : etape;
    return React.createElement("header", {
      className: "bg-white border-b sticky top-0 z-50 no-print"
    }, React.createElement("div", {
      className: "max-w-5xl mx-auto px-4 py-3 flex items-center justify-between"
    }, React.createElement("button", {
      onClick: reset,
      className: "flex items-center gap-3"
    }, React.createElement("img", {
      src: window.LOGO_URL,
      className: "w-12 h-12 object-contain",
      alt: "AIAE Logo"
    })), React.createElement("div", {
      className: "flex items-center gap-4"
    }, React.createElement("button", {
      onClick: reset,
      className: "text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1.5 font-medium transition-colors"
    }, React.createElement("svg", {
      className: "w-4 h-4",
      fill: "none",
      viewBox: "0 0 24 24",
      stroke: "currentColor"
    }, React.createElement("path", {
      strokeLinecap: "round",
      strokeLinejoin: "round",
      strokeWidth: 2,
      d: "M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
    })), React.createElement("span", null, t("Nouveau"))), secteur && React.createElement(React.Fragment, null, React.createElement("div", {
      className: "w-px h-4 bg-gray-200"
    }), React.createElement("div", {
      className: "hidden sm:flex items-center gap-1"
    }, stepList.map(n => React.createElement("div", {
      key: n,
      className: "flex items-center"
    }, React.createElement("div", {
      className: `w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium ${n < displayEtape ? 'bg-[#05482C] text-white' : n === displayEtape ? 'bg-[#0E1540] text-white' : 'bg-gray-200 text-gray-500'}`
    }, n < displayEtape ? '✓' : n), n < maxSteps && React.createElement("div", {
      className: `w-6 h-0.5 ${n < displayEtape ? 'bg-[#05482C]' : 'bg-gray-200'}`
    }))))))));
  };
  const Nav = ({
    canContinue = true
  }) => {
    const nextStep = () => {
      if (mode === 'express') {
        if (etape === 1) { setEtape(3); return; }
        if (etape === 3) { setEtape(5); return; }
      }
      if (etape < 5) setEtape(etape + 1);
      else handleSaveSimulation();
    };
    const prevStep = () => {
      if (etape > 1) {
        if (mode === 'express') {
          if (etape === 5) { setEtape(3); return; }
          if (etape === 3) { setEtape(1); return; }
        }
        setEtape(etape - 1);
      } else {
        window.location.href = window.BACK_ROUTE;
      }
    };
    return React.createElement("div", {
      className: "flex justify-between items-center mt-8 pt-6 border-t no-print"
    }, React.createElement("button", {
      onClick: prevStep,
      className: "flex items-center gap-2 px-5 py-2.5 text-gray-600 hover:text-gray-800 rounded-lg"
    }, "\u2190 ", t('Retour')), React.createElement("button", {
      onClick: nextStep,
      disabled: !canContinue || isSaving,
      className: "btn-primary flex items-center gap-2"
    }, isSaving ? React.createElement("span", {
      className: "flex items-center gap-1"
    }, React.createElement("svg", {
      className: "animate-spin h-4 w-4 text-white",
      viewBox: "0 0 24 24"
    }, React.createElement("circle", {
      className: "opacity-25",
      cx: "12",
      cy: "12",
      r: "10",
      stroke: "currentColor",
      strokeWidth: "4",
      fill: "none"
    }), React.createElement("path", {
      className: "opacity-75",
      fill: "currentColor",
      d: "M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
    })), t('Chargement...')) : React.createElement(React.Fragment, null, etape === 5 ? t('Demander un devis') : t('Continuer'), " \u2192")));
  };
  return React.createElement("div", {
    className: "min-h-screen bg-gray-50"
  }, React.createElement(Header, null), React.createElement("main", {
    className: "max-w-5xl mx-auto px-4 py-6"
  }, !secteur ? React.createElement("div", null, React.createElement("div", {
    className: "bg-white/10 backdrop-blur rounded-2xl p-4 mb-6",
    style: { background: '#f0f4ff' }
  }, React.createElement("div", {
    className: "flex items-center justify-center gap-4"
  }, React.createElement("span", {
    className: "text-gray-500 text-sm font-medium"
  }, t('Mode :')), React.createElement("button", {
    onClick: () => setMode('express'),
    className: `px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ${mode === 'express' ? 'bg-[#0E1540] text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100'}`
  }, React.createElement("span", {
    className: "flex items-center gap-2"
  }, React.createElement("svg", {
    className: "w-4 h-4",
    fill: "none",
    viewBox: "0 0 24 24",
    stroke: "currentColor"
  }, React.createElement("path", {
    strokeLinecap: "round",
    strokeLinejoin: "round",
    strokeWidth: 2,
    d: "M13 10V3L4 14h7v7l9-11h-7z"
  })), t('Express'), React.createElement("span", {
    className: "text-[10px] opacity-60"
  }, "3 ", t('étapes')))), React.createElement("button", {
    onClick: () => setMode('expert'),
    className: `px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ${mode === 'expert' ? 'bg-[#0E1540] text-white shadow-lg' : 'bg-white text-gray-700 hover:bg-gray-100'}`
  }, React.createElement("span", {
    className: "flex items-center gap-2"
  }, React.createElement("svg", {
    className: "w-4 h-4",
    fill: "none",
    viewBox: "0 0 24 24",
    stroke: "currentColor"
  }, React.createElement("path", {
    strokeLinecap: "round",
    strokeLinejoin: "round",
    strokeWidth: 2,
    d: "M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"
  })), t('Expert'), React.createElement("span", {
    className: "text-[10px] opacity-60"
  }, "5 ", t('étapes'))))), React.createElement("p", {
    className: "text-gray-400 text-xs text-center mt-3"
  }, mode === 'express' ? t('Parcours rapide : secteur, surface, estimation directe') : t('Parcours complet : terrain, sol, équipements, énergie'))), React.createElement("div", {
    className: "text-center mb-6"
  }, React.createElement("h1", {
    className: "text-2xl font-bold text-gray-800"
  }, t('Sélectionnez votre secteur')), React.createElement("p", {
    className: "text-gray-500 text-sm mt-1"
  }, t('Choisissez le domaine de votre projet'))), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-4 gap-4"
  }, [{
    id: 'residentiel',
    icon: 'Home',
    name: t('Résidentiel'),
    desc: t('Villas, immeubles')
  }, {
    id: 'tertiaire',
    icon: 'Building2',
    name: t('Tertiaire'),
    desc: t('Bureaux, hôtels')
  }, {
    id: 'industriel',
    icon: 'Factory',
    name: t('Industriel'),
    desc: t('Usines, entrepôts')
  }, {
    id: 'agricole',
    icon: 'Sprout',
    name: t('Agricole'),
    desc: t('Élevage, stockage')
  }].map(s => React.createElement("button", {
    key: s.id,
    onClick: () => setSecteur(s.id),
    className: "bg-white rounded-xl p-5 text-left hover:shadow-lg hover:scale-[1.02] transition-all group border border-gray-100"
  }, React.createElement("div", {
    className: "mb-3 p-3 bg-gray-50 rounded-lg w-fit group-hover:bg-[#0E1540] group-hover:text-white transition-colors"
  }, React.createElement(Icon, {
    name: s.icon,
    size: 32
  })), React.createElement("div", {
    className: "font-semibold text-gray-800"
  }, s.name), React.createElement("div", {
    className: "text-xs text-gray-500 mt-1"
  }, s.desc))))) : React.createElement(React.Fragment, null, React.createElement("div", {
    className: "flex items-center justify-end gap-2 mb-4"
  }, React.createElement("span", {
    className: "text-xs text-gray-400"
  }, t('Mode :')), React.createElement("button", {
    onClick: () => setMode('express'),
    className: `text-xs px-2 py-1 rounded font-medium ${mode === 'express' ? 'bg-[#0E1540] text-white' : 'bg-gray-100 text-gray-600'}`
  }, t('Express'), " 3", t('étapes')), React.createElement("button", {
    onClick: () => setMode('expert'),
    className: `text-xs px-2 py-1 rounded font-medium ${mode === 'expert' ? 'bg-[#0E1540] text-white' : 'bg-gray-100 text-gray-600'}`
  }, t('Expert'), " 5", t('étapes'))), etape === 1 && React.createElement("div", null, React.createElement("div", {
    className: "mb-6"
  }, React.createElement("h2", {
    className: "text-xl font-bold text-gray-800"
  }, t('Type de projet')), React.createElement("p", {
    className: "text-gray-500 text-sm"
  }, t('Secteur:'), " ", secteur)), React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Type de bâtiment')), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-3 gap-3"
  }, TYPES[secteur]?.map(t_bat => React.createElement("button", {
    key: t_bat.id,
    onClick: () => setTypeBat(t_bat.id),
    className: `option-btn ${typeBat === t_bat.id ? 'selected' : ''}`
  }, React.createElement("div", {
    className: `mb-3 p-2 rounded-lg w-fit ${typeBat === t_bat.id ? 'bg-white/20' : 'bg-gray-50'}`
  }, React.createElement(Icon, {
    name: t_bat.icon,
    size: 24
  })), React.createElement("div", {
    className: "font-medium text-gray-800"
  }, t(t_bat.name)))))), secteur === 'residentiel' && typeBat && React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Niveau de standing')), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-4 gap-3"
  }, Object.entries(STANDINGS).map(([id, d]) => React.createElement("button", {
    key: id,
    onClick: () => setStanding(id),
    className: `option-btn ${standing === id ? 'selected' : ''}`
  }, React.createElement("div", {
    className: `mb-3 p-2 rounded-lg w-fit ${standing === id ? 'bg-white/20' : 'bg-gray-50'}`
  }, React.createElement(Icon, {
    name: d.icon,
    size: 24
  })), React.createElement("div", {
    className: "font-semibold text-gray-800"
  }, t(d.name)), React.createElement("div", {
    className: "text-xs text-gray-500 mt-1"
  }, t(d.desc)))))), typeBat?.startsWith('hotel_') && React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Classification hôtelière')), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-3 gap-3"
  }, HOTELS.map(h => React.createElement("button", {
    key: h.id,
    onClick: () => setCatHotel(h.id),
    className: `option-btn ${catHotel === h.id ? 'selected' : ''}`
  }, React.createElement("div", {
    className: "font-semibold text-lg"
  }, h.name), React.createElement("div", {
    className: "text-xs text-gray-500 mt-2"
  }, "~", h.surfCh, " m\xB2 / ", t('Chambres')))))), React.createElement(Nav, {
    canContinue: !!typeBat
  })), mode === 'expert' && etape === 2 && React.createElement("div", null, React.createElement("div", {
    className: "mb-6"
  }, React.createElement("h2", {
    className: "text-xl font-bold text-gray-800"
  }, t('Caractéristiques du terrain'))), React.createElement("div", {
    className: "grid md:grid-cols-2 gap-6"
  }, React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Forme et dimensions')), React.createElement("div", {
    className: "grid grid-cols-3 gap-2 mb-4"
  }, ['carre', 'rect', 'irregulier'].map(f => React.createElement("button", {
    key: f,
    onClick: () => setForme(f),
    className: `py-2 px-3 rounded text-sm font-medium ${forme === f ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, f === 'carre' ? t('Carré') : f === 'rect' ? t('Rectangle') : t('Irrégulier')))), forme !== 'irregulier' ? React.createElement("div", {
    className: "grid grid-cols-2 gap-4"
  }, React.createElement(InputNum, {
    value: dimA,
    onChange: setDimA,
    min: 10,
    max: 200,
    unit: "m",
    label: forme === 'carre' ? t('Côté') : t('Longueur')
  }), forme !== 'carre' && React.createElement(InputNum, {
    value: dimB,
    onChange: setDimB,
    min: 10,
    max: 200,
    unit: "m",
    label: t('Largeur')
  })) : React.createElement(InputNum, {
    value: surfManuelle,
    onChange: setSurfManuelle,
    min: 100,
    max: 50000,
    step: 50,
    unit: "m\xB2",
    label: t('Surface')
  }), React.createElement("div", {
    className: "mt-4 p-4 bg-blue-50 rounded-lg grid grid-cols-2 gap-4"
  }, React.createElement("div", null, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Surface')), React.createElement("div", {
    className: "text-xl font-bold mono",
    style: {
      color: 'var(--bleu)'
    }
  }, fmt(surface), " m\xB2")), React.createElement("div", null, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Périmètre')), React.createElement("div", {
    className: "text-xl font-bold mono",
    style: {
      color: 'var(--bleu)'
    }
  }, fmt(perimetre), " ml")))), React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Disponibilité')), React.createElement("div", {
    className: "grid grid-cols-3 gap-2 mb-4"
  }, [{
    id: 'oui',
    n: t('Disponible')
  }, {
    id: 'option',
    n: t('En option')
  }, {
    id: 'non',
    n: t('À acquérir')
  }].map(tObj => React.createElement("button", {
    key: tObj.id,
    onClick: () => setTerrainDispo(tObj.id),
    className: `option-btn text-center py-3 ${terrainDispo === tObj.id ? 'selected' : ''}`
  }, React.createElement("div", {
    className: "text-sm"
  }, tObj.n)))), terrainDispo !== 'oui' && React.createElement("div", {
    className: "info-box text-sm"
  }, React.createElement("strong", null, t('Note:')), " ", t("Coût d'acquisition estimé selon la zone.")))), React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Zone géographique')), React.createElement("div", {
    className: "grid grid-cols-1 md:grid-cols-3 gap-3"
  }, Object.entries(ZONES).map(([id, z]) => React.createElement("button", {
    key: id,
    onClick: () => setZone(id),
    className: `option-btn ${zone === id ? 'selected' : ''}`
  }, React.createElement("div", {
    className: "font-medium"
  }, t(z.name)), React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t(z.localites)))))), React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Type de sol')), React.createElement("div", {
    className: "grid grid-cols-1 md:grid-cols-2 gap-3"
  }, Object.entries(SOLS).map(([id, s]) => React.createElement("button", {
    key: id,
    onClick: () => setSol(id),
    className: `option-btn ${sol === id ? 'selected' : ''} ${s.risque === 'élevé' || s.risque === 'très élevé' ? 'border-orange-300' : ''}`
  }, React.createElement("div", {
    className: "flex justify-between items-start"
  }, React.createElement("div", null, React.createElement("div", {
    className: "font-medium"
  }, t(s.name)), React.createElement("div", {
    className: "text-xs text-gray-500 mt-1"
  }, t('Portance:'), " ", t(s.portance)), React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t(s.fondation))))))), sol && (sol === 'argileux' || sol === 'hydromorphe') && React.createElement("div", {
    className: "alert-box mt-4"
  }, React.createElement("strong", null, "\u26A0\uFE0F ", t('Sol à risque')), React.createElement("p", {
    className: "text-sm mt-1"
  }, t('Étude géotechnique G2 obligatoire.')))), React.createElement(Nav, {
    canContinue: !!sol
  })), etape === 3 && React.createElement("div", null, React.createElement("div", {
    className: "mb-6"
  }, React.createElement("h2", {
    className: "text-xl font-bold text-gray-800"
  }, t('Configuration du bâtiment'))), React.createElement("div", {
    className: "grid md:grid-cols-2 gap-6"
  }, React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Niveaux')), React.createElement("div", {
    className: "grid grid-cols-2 gap-4"
  }, React.createElement(InputNum, {
    value: niveaux,
    onChange: setNiveaux,
    min: 1,
    max: typeData?.max || 10,
    label: t('Niveaux hors sol')
  }), React.createElement(InputNum, {
    value: ssSol,
    onChange: setSsSol,
    min: 0,
    max: 3,
    label: t('Sous-sols')
  })), React.createElement("div", {
    className: "grid grid-cols-2 gap-4 mt-4"
  }, React.createElement(InputNum, {
    value: hspRdc,
    onChange: setHspRdc,
    min: 2.4,
    max: 6,
    step: 0.1,
    unit: "m",
    label: t('HSP RDC')
  }), React.createElement(InputNum, {
    value: hspEtage,
    onChange: setHspEtage,
    min: 2.4,
    max: 4,
    step: 0.1,
    unit: "m",
    label: t('HSP Étages')
  }))), React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Synthèse technique')), React.createElement("div", {
    className: "space-y-3"
  }, React.createElement("div", {
    className: "flex justify-between"
  }, React.createElement("span", {
    className: "text-gray-500"
  }, t('Emprise au sol')), React.createElement("span", {
    className: "mono font-semibold"
  }, fmt(surface * emprise), " m\xB2 (", Math.round(emprise * 100), "%)")), React.createElement("div", {
    className: "flex justify-between"
  }, React.createElement("span", {
    className: "text-gray-500"
  }, t('Surface plancher')), React.createElement("span", {
    className: "mono font-semibold"
  }, fmt(surfaceBatie), " m\xB2")), React.createElement("div", {
    className: "flex justify-between"
  }, React.createElement("span", {
    className: "text-gray-500"
  }, t('Hauteur totale')), React.createElement("span", {
    className: "mono font-semibold"
  }, Number(hauteurTotale || 0).toFixed(1), " m"))), React.createElement("div", {
    className: "mt-4 p-3 bg-gray-50 rounded-lg"
  }, React.createElement("div", {
    className: "flex items-center gap-2"
  }, React.createElement("span", {
    className: `badge ${categorie.cat === 'A1' ? 'badge-green' : categorie.cat === 'A2' ? 'badge-blue' : 'badge-orange'}`
  }, "Cat. ", categorie.cat), React.createElement("span", {
    className: `badge ${categorie.geoOblig ? 'badge-orange' : 'badge-gray'}`
  }, t('Géotech.'), " ", categorie.mission)), categorie.motifs.length > 0 && React.createElement("div", {
    className: "text-xs text-gray-500 mt-2"
  }, categorie.motifs.join(' • '))))), typeBat?.startsWith('hotel_') && React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Configuration hôtel')), React.createElement("div", {
    className: "grid grid-cols-2 gap-4 mb-4"
  }, React.createElement(InputNum, {
    value: nbChambres,
    onChange: setNbChambres,
    min: 5,
    max: 500,
    label: t('Chambres')
  }), React.createElement(InputNum, {
    value: nbAsc,
    onChange: setNbAsc,
    min: 0,
    max: 10,
    label: t('Ascenseurs')
  })), React.createElement("div", {
    className: "flex flex-wrap gap-2"
  }, ['restaurant', 'bar', 'spa', 'piscine', 'salle_conf', 'parking'].map(e => React.createElement("button", {
    key: e,
    onClick: () => setEspacesHotel(espacesHotel.includes(e) ? espacesHotel.filter(x => x !== e) : [...espacesHotel, e]),
    className: `px-3 py-1.5 rounded-full text-sm ${espacesHotel.includes(e) ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, e === 'salle_conf' ? 'Salle conf' : t(e.charAt(0).toUpperCase() + e.slice(1)))))), secteur === 'industriel' && React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Configuration industrielle')), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-3 gap-4"
  }, React.createElement(InputNum, {
    value: hauteurLibre,
    onChange: setHauteurLibre,
    min: 4,
    max: 20,
    unit: "m",
    label: t('Hauteur libre')
  }), React.createElement(InputNum, {
    value: nbQuais,
    onChange: setNbQuais,
    min: 0,
    max: 20,
    label: t('Quais')
  })), React.createElement("div", {
    className: "flex items-center gap-4 mt-4"
  }, React.createElement("label", {
    className: "flex items-center gap-2 cursor-pointer"
  }, React.createElement("input", {
    type: "checkbox",
    checked: pontRoulant,
    onChange: e => setPontRoulant(e.target.checked),
    className: "w-4 h-4"
  }), React.createElement("span", null, t('Pont roulant'))), pontRoulant && React.createElement(InputNum, {
    value: pontCap,
    onChange: setPontCap,
    min: 1,
    max: 50,
    unit: "T",
    label: t('Capacité')
  })), (typeBat === 'chambre_froide' || typeBat === 'entrepot') && React.createElement("div", {
    className: "mt-4"
  }, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Groupe froid')), React.createElement("div", {
    className: "flex gap-2 mt-2"
  }, [{
    id: '',
    n: t('Non')
  }, {
    id: 'positif',
    n: t('Positif')
  }, {
    id: 'negatif',
    n: t('Négatif')
  }].map(g => React.createElement("button", {
    key: g.id,
    onClick: () => setGroupeFroid(g.id),
    className: `px-3 py-1.5 rounded text-sm ${groupeFroid === g.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, g.n))))), secteur === 'agricole' && typeBat?.startsWith('elevage_') && React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Élevage')), React.createElement(InputNum, {
    value: effectif,
    onChange: setEffectif,
    min: 10,
    max: 10000,
    step: 10,
    label: typeBat === 'elevage_volailles' ? t('Sujets') : t('Têtes')
  }), React.createElement("div", {
    className: "mt-3 text-sm text-gray-500"
  }, t('Surface'), " : ", fmt(surfaceBatie), " m\xB2")), React.createElement(Nav, null)), mode === 'expert' && etape === 4 && React.createElement("div", null, React.createElement("div", {
    className: "mb-6"
  }, React.createElement("h2", {
    className: "text-xl font-bold text-gray-800"
  }, t('Équipements et options')), React.createElement("p", {
    className: "text-gray-500 text-sm"
  }, t('Sécurité et aménagements extérieurs'))), React.createElement("div", {
    className: "grid md:grid-cols-2 gap-6"
  }, React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Sécurité')), React.createElement("div", {
    className: "space-y-4"
  }, React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Alarme')), React.createElement("div", {
    className: "flex flex-wrap gap-2 mt-2"
  }, React.createElement("button", {
    onClick: () => setAlarme(''),
    className: `px-2 py-1 rounded text-xs ${!alarme ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t('Non')), SECURITE_OPTS.filter(o => o.id.includes('alarme')).map(a => React.createElement("button", {
    key: a.id,
    onClick: () => setAlarme(a.id),
    className: `px-2 py-1 rounded text-xs ${alarme === a.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t(a.name || '').replace(t('Alarme'), '').replace('Alarm', '').replace('Alarme', '').trim()))), alarme && React.createElement(InputNum, {
    value: nbZones,
    onChange: setNbZones,
    min: 2,
    max: 24,
    label: t('Zones')
  })), React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Vidéosurveillance')), React.createElement("div", {
    className: "flex flex-wrap gap-2 mt-2"
  }, React.createElement("button", {
    onClick: () => setVideo(''),
    className: `px-2 py-1 rounded text-xs ${!video ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t('Non')), SECURITE_OPTS.filter(o => o.id.includes('video')).map(v => React.createElement("button", {
    key: v.id,
    onClick: () => setVideo(v.id),
    className: `px-2 py-1 rounded text-xs ${video === v.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t(v.name || '').replace(t('Vidéosurveillance'), '').replace('Video Surveillance', '').replace('Vidéosurveillance', '').trim())))), React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Contrôle accès')), React.createElement("div", {
    className: "flex gap-2 mt-2"
  }, [{
    id: '',
    n: t('Non')
  }, {
    id: 'badge',
    n: t('Badge')
  }, {
    id: 'bio',
    n: t('Biométrique')
  }].map(c => React.createElement("button", {
    key: c.id,
    onClick: () => setAcces(c.id),
    className: `px-3 py-1.5 rounded text-sm ${acces === c.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, c.n))), acces && React.createElement(InputNum, {
    value: nbPortes,
    onChange: setNbPortes,
    min: 1,
    max: 20,
    label: t('Portes')
  })))), secteur !== 'agricole' && React.createElement("div", {
    className: "card p-5"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, " ", t('Ascenseurs')), React.createElement(InputNum, {
    value: nbAsc,
    onChange: setNbAsc,
    min: 0,
    max: 10,
    label: t('Nombre')
  }), nbAsc > 0 && React.createElement("p", {
    className: "text-xs text-gray-500 mt-2"
  }, t('Obligatoire si ERP et R+1')))), React.createElement("div", {
    className: "card p-5 mt-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4"
  }, t('Extérieurs')), React.createElement("div", {
    className: "grid md:grid-cols-3 gap-4"
  }, React.createElement("div", null, React.createElement("label", {
    className: "flex items-center gap-2 cursor-pointer"
  }, React.createElement("input", {
    type: "checkbox",
    checked: cloture,
    onChange: e => setCloture(e.target.checked),
    className: "w-4 h-4"
  }), React.createElement("span", null, t('Clôture'), " (", fmt(perimetre), " ml)")), cloture && React.createElement("div", {
    className: "mt-2 flex gap-2"
  }, [1.5, 2, 2.5, 3].map(h => React.createElement("button", {
    key: h,
    onClick: () => setClotureH(h),
    className: `px-3 py-1 rounded text-sm ${clotureH === h ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, h, "m")))), React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Portail')), React.createElement("div", {
    className: "flex flex-wrap gap-2 mt-2"
  }, React.createElement("button", {
    onClick: () => setPortail(''),
    className: `px-2 py-1 rounded text-xs ${!portail ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t('Non')), EXTERIEUR_OPTS.filter(o => o.id.includes('portail')).map(p => React.createElement("button", {
    key: p.id,
    onClick: () => setPortail(p.id),
    className: `px-2 py-1 rounded text-xs ${portail === p.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t(p.name || '').replace(t('Portail'), '').replace('Gate', '').replace('Portail', '').trim())))), React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Piscine')), React.createElement("div", {
    className: "flex flex-wrap gap-2 mt-2"
  }, React.createElement("button", {
    onClick: () => setPiscine(''),
    className: `px-2 py-1 rounded text-xs ${!piscine ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t('Non')), EXTERIEUR_OPTS.filter(o => o.id.includes('piscine')).map(p => React.createElement("button", {
    key: p.id,
    onClick: () => setPiscine(p.id),
    className: `px-2 py-1 rounded text-xs ${piscine === p.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, t(p.name || '').replace(t('Piscine'), '').replace('Pool', '').replace('Piscine', '').trim()))))), React.createElement("div", {
    className: "grid md:grid-cols-2 gap-4 mt-4"
  }, React.createElement("div", null, React.createElement("label", {
    className: "flex items-center gap-2 cursor-pointer"
  }, React.createElement("input", {
    type: "checkbox",
    checked: forage,
    onChange: e => setForage(e.target.checked),
    className: "w-4 h-4"
  }), React.createElement("span", null, t('Forage'), " (~", zoneData.forage, "m)")), forage && React.createElement(InputNum, {
    value: forageProf,
    onChange: setForageProf,
    min: 15,
    max: 150,
    unit: "m",
    label: t('Profondeur')
  })), React.createElement("div", null, React.createElement("label", {
    className: "text-sm text-gray-600"
  }, t('Parking')), React.createElement("div", {
    className: "flex gap-2 mt-2"
  }, [{
    id: '',
    n: t('Non')
  }, {
    id: 'ext',
    n: t('Ext.')
  }, {
    id: 'couvert',
    n: t('Couvert')
  }, {
    id: 'souterrain',
    n: t('Sous.')
  }].map(p => React.createElement("button", {
    key: p.id,
    onClick: () => setParkType(p.id),
    className: `px-2 py-1 rounded text-xs ${parkType === p.id ? 'bg-[#0E1540] text-white' : 'bg-gray-100'}`
  }, p.n))), parkType && React.createElement(InputNum, {
    value: parkPlaces,
    onChange: setParkPlaces,
    min: 0,
    max: 200,
    label: t('Places')
  })))), React.createElement(Nav, null)), etape === 5 && estimation && React.createElement("div", null, React.createElement("div", {
    className: "flex justify-between items-center mb-6 no-print"
  }, React.createElement("div", null, React.createElement("h2", {
    className: "text-xl font-bold text-gray-800"
  }, t('Récapitulatif et estimation')), React.createElement("p", {
    className: "text-gray-500 text-sm"
  }, t('Besoins énergétiques - Propositions - Estimation'))), React.createElement("button", {
    onClick: () => window.print(),
    className: "flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
  }, React.createElement(Icon, {
    name: "Printer",
    size: 18
  }), t('Imprimer'))), React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4 flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "ClipboardList",
    className: "text-[#0E1540]"
  }), t('Synthèse du projet')), React.createElement("div", {
    className: "grid md:grid-cols-4 gap-4"
  }, React.createElement("div", {
    className: "p-3 bg-gray-50 rounded-lg"
  }, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Type')), React.createElement("div", {
    className: "font-semibold"
  }, t(typeData?.name || typeBat)), React.createElement("div", {
    className: "text-xs text-gray-500"
  }, secteur === 'residentiel' ? t(STANDINGS[standing]?.name) : '')), React.createElement("div", {
    className: "p-3 bg-gray-50 rounded-lg"
  }, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Terrain')), React.createElement("div", {
    className: "font-semibold mono"
  }, fmt(surface), " m\xB2"), React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t(zoneData.name))), React.createElement("div", {
    className: "p-3 bg-gray-50 rounded-lg"
  }, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Surface plancher')), React.createElement("div", {
    className: "font-semibold mono"
  }, fmt(surfaceBatie), " m\xB2"), React.createElement("div", {
    className: "text-xs text-gray-500"
  }, niveaux === 1 ? t('Plain-pied') : `R+${niveaux - 1}`, ssSol > 0 ? ` + ${ssSol} ss` : '')), React.createElement("div", {
    className: "p-3 bg-gray-50 rounded-lg"
  }, React.createElement("div", {
    className: "text-xs text-gray-500"
  }, t('Durée estimée')), React.createElement("div", {
    className: "font-semibold"
  }, duree, " ", t('mois'))))), React.createElement("div", {
    className: "card p-5 mb-6",
    style: {
      background: 'linear-gradient(135deg, var(--orange) 0%, #ea580c 100%)'
    }
  }, React.createElement("h3", {
    className: "font-bold text-white mb-4 flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "Zap"
  }), t('Besoins énergétiques calculés')), React.createElement("div", {
    className: "text-4xl font-bold text-white mb-4 mono"
  }, besoins.total, " kW"), React.createElement("div", {
    className: "grid grid-cols-2 md:grid-cols-4 gap-2"
  }, besoins.details.map((d, i) => React.createElement("div", {
    key: i,
    className: "bg-white/20 rounded px-3 py-2 flex items-center justify-between text-white"
  }, React.createElement("div", {
    className: "flex items-center gap-2"
  }, React.createElement(Icon, {
    name: d.icon,
    size: 14
  }), React.createElement("span", {
    className: "text-sm"
  }, d.label)), React.createElement("span", {
    className: "mono font-semibold"
  }, Number(d.kw || 0).toFixed(1)))))), React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4 flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "Sun",
    className: "text-amber-500"
  }), t('Installation solaire (40-150% couverture)')), React.createElement("div", {
    className: "space-y-3"
  }, React.createElement("button", {
    onClick: () => setSolaire(''),
    className: `w-full p-3 rounded-lg border-2 text-left transition-all flex items-center gap-3 ${!solaire ? 'border-[#0E1540] bg-blue-50' : 'border-gray-200'}`
  }, React.createElement(Icon, {
    name: "XCircle",
    className: !solaire ? 'text-[#0E1540]' : 'text-gray-400'
  }), React.createElement("span", {
    className: "font-medium"
  }, t("Pas d'installation solaire"))), propositionsSolaires.map(kit => React.createElement("button", {
    key: kit.id,
    onClick: () => setSolaire(kit.id),
    className: `w-full p-4 rounded-lg border-2 text-left transition-all ${solaire === kit.id ? 'border-[#0E1540] bg-blue-50' : 'border-gray-200 hover:border-gray-300'} ${kit.optimal ? 'optimal-ring' : ''}`
  }, React.createElement("div", {
    className: "flex justify-between items-start"
  }, React.createElement("div", {
    className: "flex-1"
  }, React.createElement("div", {
    className: "font-bold text-lg"
  }, kit.kw, " kWc", React.createElement("span", {
    className: `ml-2 text-sm px-2 py-0.5 rounded ${kit.couv >= 100 ? 'bg-green-100 text-green-700' : kit.couv >= 70 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600'}`
  }, kit.couv, "%"), kit.optimal && React.createElement("span", {
    className: "text-green-600 text-sm ml-2 flex items-center gap-1 inline-flex"
  }, React.createElement(Icon, {
    name: "CheckCircle2",
    size: 14
  }), " ", t('Optimal'))), React.createElement("div", {
    className: "text-sm text-green-700 mt-2"
  }, React.createElement("strong", null, t('Couvre:')), " ", kit.couverts.slice(0, 5).join(' • '), kit.couverts.length > 5 ? '...' : ''), kit.nonCouverts.length > 0 && React.createElement("div", {
    className: "text-xs text-red-500 mt-1"
  }, React.createElement("strong", null, t('Non couvert:')), " ", kit.nonCouverts.slice(0, 3).join(' • '))), React.createElement("div", {
    className: "font-bold text-lg",
    style: {
      color: 'var(--bleu)'
    }
  }, fmtM(kit.prix), " F")))))), React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4 flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "Plug",
    className: "text-blue-600"
  }), t('Groupe électrogène (40-150% couverture)')), React.createElement("div", {
    className: "space-y-3"
  }, React.createElement("button", {
    onClick: () => setGroupe(''),
    className: `w-full p-3 rounded-lg border-2 text-left transition-all flex items-center gap-3 ${!groupe ? 'border-[#0E1540] bg-blue-50' : 'border-gray-200'}`
  }, React.createElement(Icon, {
    name: "XCircle",
    className: !groupe ? 'text-[#0E1540]' : 'text-gray-400'
  }), React.createElement("span", {
    className: "font-medium"
  }, t('Pas de groupe électrogène'))), propositionsGroupes.map(grp => React.createElement("button", {
    key: grp.id,
    onClick: () => setGroupe(grp.id),
    className: `w-full p-4 rounded-lg border-2 text-left transition-all ${groupe === grp.id ? 'border-[#0E1540] bg-blue-50' : 'border-gray-200 hover:border-gray-300'} ${grp.optimal ? 'optimal-ring' : ''}`
  }, React.createElement("div", {
    className: "flex justify-between items-start"
  }, React.createElement("div", {
    className: "flex-1"
  }, React.createElement("div", {
    className: "font-bold text-lg"
  }, grp.kva, " kVA", React.createElement("span", {
    className: `ml-2 text-sm px-2 py-0.5 rounded ${grp.couv >= 100 ? 'bg-green-100 text-green-700' : grp.couv >= 70 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600'}`
  }, grp.couv, "%"), grp.optimal && React.createElement("span", {
    className: "text-green-600 text-sm ml-2 flex items-center gap-1 inline-flex"
  }, React.createElement(Icon, {
    name: "CheckCircle2",
    size: 14
  }), " ", t('Optimal'))), React.createElement("div", {
    className: "text-sm text-green-700 mt-2"
  }, React.createElement("strong", null, t('Couvre:')), " ", grp.couverts.slice(0, 5).join(' • '), grp.couverts.length > 5 ? '...' : ''), grp.nonCouverts.length > 0 && React.createElement("div", {
    className: "text-xs text-red-500 mt-1"
  }, React.createElement("strong", null, t('Non couvert:')), " ", grp.nonCouverts.slice(0, 3).join(' • '))), React.createElement("div", {
    className: "font-bold text-lg",
    style: {
      color: 'var(--bleu)'
    }
  }, fmtM(grp.prix), " F")))))), React.createElement("div", {
    className: "card p-5 mb-6"
  }, React.createElement("h3", {
    className: "font-semibold text-gray-700 mb-4 flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "CircleDollarSign",
    className: "text-[#05482C]"
  }), t('Estimation budgétaire')), React.createElement("div", {
    className: "overflow-x-auto"
  }, React.createElement("table", {
    className: "w-full text-sm"
  }, React.createElement("thead", null, React.createElement("tr", {
    className: "border-b"
  }, React.createElement("th", {
    className: "text-left py-2 px-2"
  }, t('Code')), React.createElement("th", {
    className: "text-left py-2"
  }, t('Poste')), React.createElement("th", {
    className: "text-left py-2"
  }, t('Détail')), React.createElement("th", {
    className: "text-right py-2 px-2"
  }, t('Montant')))), React.createElement("tbody", null, estimation.postes.map((p, i) => React.createElement("tr", {
    key: i,
    className: "border-b border-gray-100"
  }, React.createElement("td", {
    className: "py-2 px-2 text-gray-400 mono"
  }, p.code), React.createElement("td", {
    className: "py-2 font-medium"
  }, p.nom), React.createElement("td", {
    className: "py-2 text-gray-500 text-xs"
  }, p.detail), React.createElement("td", {
    className: "py-2 px-2 text-right mono font-semibold"
  }, fmtM(p.montant)))))))), React.createElement("div", {
    className: "card p-6",
    style: {
      background: 'linear-gradient(135deg, var(--bleu) 0%, #1e3a8a 100%)'
    }
  }, React.createElement("div", {
    className: "text-center"
  }, React.createElement("div", {
    className: "text-white/70 text-sm mb-2"
  }, t('Estimation totale projet')), React.createElement("div", {
    className: "text-4xl md:text-5xl font-bold text-white mono mb-4"
  }, fmtM(estimation.foncier + estimation.total), " FCFA"), React.createElement("div", {
    className: "flex justify-center gap-8 text-white/80 text-sm"
  }, React.createElement("div", null, React.createElement("div", {
    className: "text-xs"
  }, t('Fourchette basse (-10%)')), React.createElement("div", {
    className: "font-semibold mono"
  }, fmtM(estimation.min), " F")), React.createElement("div", null, React.createElement("div", {
    className: "text-xs"
  }, t('Fourchette haute (+15%)')), React.createElement("div", {
    className: "font-semibold mono"
  }, fmtM(estimation.max), " F"))), React.createElement("div", {
    className: "mt-4 text-white/60 text-xs"
  }, t('Durée estimée:'), " ", duree, " ", t('mois'), " \u2022 ", t('Catégorie:'), " ", categorie.cat, " \u2022 ", t('Géotechnique:'), " ", categorie.mission))), React.createElement("div", {
    className: "warn-box mt-6 flex gap-3"
  }, React.createElement(Icon, {
    name: "AlertTriangle",
    className: "text-amber-600 shrink-0",
    size: 24
  }), React.createElement("div", null, React.createElement("strong", {
    className: "block mb-1"
  }, t('Avertissement')), React.createElement("p", {
    className: "text-sm"
  }, t("Cette estimation est indicative et basée sur les paramètres saisis. Une étude détaillée sera réalisée pour l'établissement du devis définitif. Les prix peuvent varier selon la conjoncture du marché.")))), React.createElement(Nav, null)))), React.createElement("footer", {
    className: "text-center py-6 text-gray-400 text-xs no-print"
  }, "\xA9 2025 AIAE SARL \u2022 Afrika Infrastructure, Automation & Energy \u2022 Quartier Kl\xE9me Zangu\xE9ra, Lom\xE9, Togo", React.createElement("br", null), t('Simulateur v'), VERSION, " \u2022 ", t('Référentiel Décembre 2025')));
};
ReactDOM.createRoot(document.getElementById('root')).render(React.createElement(App, null));
    } catch (err) {
      console.error('[AIAE] Erreur au démarrage de simulateur-v1:', err);
      var root = document.getElementById('root');
      if (root) {
        root.innerHTML = '<div style="padding:2rem;text-align:center;font-family:sans-serif;color:#0E1540"><h2>Chargement impossible</h2><p>Veuillez rafraîchir la page. Si le problème persiste, contactez le support.</p></div>';
      }
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
  } else {
    boot();
  }
})();
