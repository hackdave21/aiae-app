/* AIAE — energie-calculator (compiled, do not edit) */
(function () {
  function boot() {
    if (!window.React || !window.ReactDOM) {
      console.error('[AIAE] React non chargé — vérifiez les scripts vendor.');
      return;
    }
    try {
const {
  useState,
  useEffect,
  useMemo,
  useRef
} = React;
const t = key => window.AIAE_TRANSLATIONS ? window.AIAE_TRANSLATIONS[key] || key : key;
const Icon = ({
  name,
  size = 20,
  className = "",
  ...props
}) => {
  const iconRef = useRef(null);
  useEffect(() => {
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
    className: "inline-flex items-center justify-center",
    style: {
      minWidth: size,
      minHeight: size,
      lineHeight: 0
    }
  });
};
const config = window.AIAE_ENERGY_CONFIG || {
  equipements: [],
  zones: []
};
const REFERENTIEL = {
  prixKwhReseau: 140,
  ensoleillement: config.zones?.[0]?.hsp_heures || 4.8,
  perteSysteme: 0.25,
  ratioBatterie: 1.5,
  prixInstallationWc: 1200,
  icons: {
    'clim': 'Snowflake',
    'frigo': 'Thermometer',
    'congel': 'IceCream',
    'tv': 'Tv',
    'eclairage': 'Lightbulb',
    'ventilo': 'Wind',
    'ordi': 'Laptop',
    'pompe': 'Droplets',
    'chauffe_eau': 'Thermometer',
    'moteur': 'Zap',
    'defaut': 'Zap'
  },
  equipements: config.equipements.map(e => ({
    id: e.code || e.id,
    label: e.designation,
    puis: e.puissance_watts,
    h: e.usage_heures_jour || 8,
    icon: e.code ? e.code.split('_')[0].toLowerCase() : 'Zap'
  }))
};
if (REFERENTIEL.equipements.length === 0) {
  REFERENTIEL.equipements = [{
    id: 'clim1',
    label: t('Climatiseur 1 CV'),
    puis: 900,
    h: 8,
    icon: 'clim'
  }, {
    id: 'frigo',
    label: t('Réfrigérateur A+'),
    puis: 150,
    h: 12,
    icon: 'frigo'
  }, {
    id: 'tv',
    label: t('Télévision LED'),
    puis: 100,
    h: 5,
    icon: 'tv'
  }, {
    id: 'eclairage',
    label: t('Éclairage LED'),
    puis: 100,
    h: 6,
    icon: 'eclairage'
  }];
}
const fmt = n => new Intl.NumberFormat('fr-FR').format(Math.round(n));
const fmtM = n => n >= 1000000 ? (n / 1000000).toFixed(2) + ' M' : fmt(n);
const App = () => {
  const [mode, setMode] = useState('facture');
  const [factureMensuelle, setFactureMensuelle] = useState(50000);
  const [monInventaire, setMonInventaire] = useState([{
    ...REFERENTIEL.equipements[0],
    qty: 1
  }, {
    ...REFERENTIEL.equipements[3],
    qty: 1
  }, {
    ...REFERENTIEL.equipements[6],
    qty: 1
  }]);
  const resultats = useMemo(() => {
    let consoJournaliereWh = 0;
    let puissanceCreteW = 0;
    if (mode === 'facture') {
      const kwhMois = factureMensuelle / REFERENTIEL.prixKwhReseau;
      consoJournaliereWh = kwhMois * 1000 / 30;
      puissanceCreteW = consoJournaliereWh / 4;
    } else {
      monInventaire.forEach(item => {
        consoJournaliereWh += item.puis * item.qty * item.h;
        puissanceCreteW += item.puis * item.qty * 0.7;
      });
    }
    const besoinPanneauxWc = consoJournaliereWh / (REFERENTIEL.ensoleillement * (1 - REFERENTIEL.perteSysteme));
    const besoinBatterieWh = consoJournaliereWh * 0.5 * REFERENTIEL.ratioBatterie;
    let coutEstime = besoinPanneauxWc * REFERENTIEL.prixInstallationWc;
    coutEstime += 500000;
    coutEstime += besoinBatterieWh * 250;
    return {
      consoKwhJ: consoJournaliereWh / 1000,
      puissanceOnduleur: Math.ceil(puissanceCreteW * 1.2 / 1000),
      panneauxKwc: (besoinPanneauxWc / 1000).toFixed(1),
      batteriesKwh: (besoinBatterieWh / 1000).toFixed(1),
      coutMin: Math.round(coutEstime * 0.9),
      coutMax: Math.round(coutEstime * 1.15)
    };
  }, [mode, factureMensuelle, monInventaire]);
  const ajouterEquipement = id => {
    const ref = REFERENTIEL.equipements.find(e => e.id === id);
    const existe = monInventaire.find(e => e.id === id);
    if (existe) {
      setMonInventaire(monInventaire.map(e => e.id === id ? {
        ...e,
        qty: e.qty + 1
      } : e));
    } else {
      setMonInventaire([...monInventaire, {
        ...ref,
        qty: 1
      }]);
    }
  };
  const retirerEquipement = id => {
    setMonInventaire(monInventaire.filter(e => e.id !== id));
  };
  const changerQte = (id, delta) => {
    setMonInventaire(monInventaire.map(e => {
      if (e.id === id) return {
        ...e,
        qty: Math.max(1, e.qty + delta)
      };
      return e;
    }));
  };
  const changerHeures = (id, val) => {
    setMonInventaire(monInventaire.map(e => {
      if (e.id === id) return {
        ...e,
        h: Math.min(24, Math.max(0, parseFloat(val)))
      };
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
  return React.createElement("div", {
    className: "min-h-screen py-8 px-4 md:px-8 max-w-6xl mx-auto"
  }, React.createElement("header", {
    className: "flex items-center justify-between mb-10 no-print"
  }, React.createElement("div", {
    className: "flex items-center gap-4"
  }, React.createElement("img", {
    src: window.AIAE_LOGO_URL,
    className: "w-12 h-12 object-contain",
    alt: "AIAE Logo"
  }), React.createElement("div", null, React.createElement("h1", {
    className: "text-2xl font-bold",
    style: {
      color: 'var(--bleu)'
    }
  }, t('Simulateur Solaire AIAE')), React.createElement("p", {
    className: "text-gray-500 text-sm"
  }, t('Dimensionnement autonome & Estimation financière')))), React.createElement("a", {
    href: window.SIMULATOR_URL,
    className: "px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 transition-colors flex items-center gap-2"
  }, React.createElement(Icon, {
    name: "ArrowLeft",
    size: 16
  }), " ", t('Retour'))), React.createElement("div", {
    className: "grid lg:grid-cols-12 gap-8"
  }, React.createElement("div", {
    className: "lg:col-span-7 space-y-6"
  }, React.createElement("div", {
    className: "card p-2 flex"
  }, React.createElement("button", {
    onClick: () => setMode('facture'),
    className: `flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all flex items-center justify-center gap-2 ${mode === 'facture' ? 'bg-white text-[var(--orange)] shadow-sm' : 'text-gray-500 hover:bg-white/50'}`,
    style: mode === 'facture' ? {
      border: '1px solid #fed7aa'
    } : {}
  }, React.createElement(Icon, {
    name: "Receipt",
    size: 18
  }), " ", t("D'après ma facture")), React.createElement("button", {
    onClick: () => setMode('equipements'),
    className: `flex-1 py-3 px-4 rounded-xl text-sm font-semibold transition-all flex items-center justify-center gap-2 ${mode === 'equipements' ? 'bg-white text-[var(--orange)] shadow-sm' : 'text-gray-500 hover:bg-white/50'}`,
    style: mode === 'equipements' ? {
      border: '1px solid #fed7aa'
    } : {}
  }, React.createElement(Icon, {
    name: "Settings",
    size: 18
  }), " ", t("D'après mes appareils"))), mode === 'facture' && React.createElement("div", {
    className: "card p-6 animate-fade-in"
  }, React.createElement("h2", {
    className: "text-lg font-bold mb-4"
  }, t('Montant mensuel électricité')), React.createElement("label", {
    className: "block text-sm text-gray-500 mb-2"
  }, t('Combien payez-vous en moyenne par mois (CEET/CIE) ?')), React.createElement("div", {
    className: "flex items-center gap-4"
  }, React.createElement("input", {
    type: "range",
    min: "5000",
    max: "500000",
    step: "5000",
    value: factureMensuelle,
    onChange: e => setFactureMensuelle(Number(e.target.value)),
    className: "flex-1 h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-[var(--orange)]"
  }), React.createElement("div", {
    className: "w-40"
  }, React.createElement("div", {
    className: "relative"
  }, React.createElement("input", {
    type: "number",
    value: factureMensuelle,
    onChange: e => setFactureMensuelle(Number(e.target.value)),
    className: "input-field text-right font-bold mono text-lg pr-12"
  }), React.createElement("span", {
    className: "absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"
  }, "FCFA")))), React.createElement("div", {
    className: "mt-4 p-4 bg-orange-50 rounded-lg border border-orange-100 text-sm text-orange-800"
  }, React.createElement("p", null, " ", React.createElement("strong", null, t('Note :')), " ", t('Ce mode estime vos besoins globaux. Pour une précision technique, le mode Appareils est recommandé.')))), mode === 'equipements' && React.createElement("div", {
    className: "card p-6 animate-fade-in"
  }, React.createElement("div", {
    className: "flex justify-between items-center mb-4"
  }, React.createElement("h2", {
    className: "text-lg font-bold"
  }, t('Inventaire des appareils')), React.createElement("div", {
    className: "text-xs bg-gray-100 px-2 py-1 rounded"
  }, t('Total estimé :'), " ", fmt(resultats.consoKwhJ), " kWh/j")), React.createElement("div", {
    className: "space-y-3 mb-6"
  }, monInventaire.map((item, index) => React.createElement("div", {
    key: index,
    className: "flex items-center gap-3 p-3 border rounded-lg bg-white hover:border-[var(--vert)] transition-colors shadow-sm"
  }, React.createElement("div", {
    className: "w-10 h-10 rounded-lg bg-gray-50 flex items-center justify-center text-[var(--vert)]"
  }, React.createElement(Icon, {
    name: REFERENTIEL.icons[item.icon] || 'Zap',
    size: 20
  })), React.createElement("div", {
    className: "flex-1"
  }, React.createElement("div", {
    className: "font-semibold text-sm text-[var(--bleu)]"
  }, t(item.label) || item.label), React.createElement("div", {
    className: "text-xs text-gray-400"
  }, item.puis, " W")), React.createElement("div", {
    className: "flex flex-col items-center px-2 border-l border-r border-gray-100"
  }, React.createElement("label", {
    className: "text-[10px] text-gray-500 uppercase font-bold tracking-tight"
  }, t('Utilisation')), React.createElement("div", {
    className: "flex items-center gap-1"
  }, React.createElement("input", {
    type: "number",
    min: "0",
    max: "24",
    step: "0.5",
    value: item.h,
    onChange: e => changerHeures(item.id, e.target.value),
    className: "w-10 text-center font-bold text-sm bg-transparent outline-none"
  }), React.createElement("span", {
    className: "text-[10px] text-gray-400"
  }, t('h/j')))), React.createElement("div", {
    className: "flex items-center gap-1 bg-gray-50 rounded-lg p-1"
  }, React.createElement("button", {
    onClick: () => changerQte(item.id, -1),
    className: "w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm hover:text-red-500 transition-colors"
  }, React.createElement(Icon, {
    name: "Minus",
    size: 12
  })), React.createElement("span", {
    className: "w-6 text-center text-sm font-bold text-[var(--bleu)]"
  }, item.qty), React.createElement("button", {
    onClick: () => changerQte(item.id, 1),
    className: "w-7 h-7 flex items-center justify-center bg-white rounded shadow-sm hover:text-[var(--vert)] transition-colors"
  }, React.createElement(Icon, {
    name: "Plus",
    size: 12
  }))), React.createElement("button", {
    onClick: () => retirerEquipement(item.id),
    className: "text-gray-300 hover:text-red-500 transition-colors ml-1"
  }, React.createElement(Icon, {
    name: "Trash2",
    size: 16
  })))), monInventaire.length === 0 && React.createElement("div", {
    className: "text-center py-8 text-gray-400 border-2 border-dashed rounded-lg"
  }, t('Aucun équipement ajouté'))), React.createElement("div", null, React.createElement("label", {
    className: "text-sm font-semibold text-gray-700 block mb-2"
  }, t('Ajouter un équipement :')), React.createElement("div", {
    className: "flex flex-wrap gap-2"
  }, REFERENTIEL.equipements.filter(e => !monInventaire.find(m => m.id === e.id)).map(e => React.createElement("button", {
    key: e.id,
    onClick: () => ajouterEquipement(e.id),
    className: "px-3 py-1.5 text-xs bg-white hover:bg-[var(--vert)] hover:text-white rounded-lg border border-gray-200 transition-all flex items-center gap-2 shadow-sm"
  }, React.createElement(Icon, {
    name: REFERENTIEL.icons[e.icon] || 'Plus',
    size: 12
  }), " ", t(e.label) || e.label)))))), React.createElement("div", {
    className: "lg:col-span-5"
  }, React.createElement("div", {
    className: "sticky top-6 space-y-4"
  }, React.createElement("div", {
    className: "card p-6",
    style: {
      background: 'var(--bleu)',
      color: 'white'
    }
  }, React.createElement("h3", {
    className: "text-orange-400 text-sm font-bold uppercase tracking-wider mb-6"
  }, t('Configuration Recommandée')), React.createElement("div", {
    className: "space-y-6"
  }, React.createElement("div", {
    className: "flex items-center justify-between border-b border-white/10 pb-4"
  }, React.createElement("div", {
    className: "flex items-center gap-3"
  }, React.createElement("div", {
    className: "w-10 h-10 rounded-full bg-orange-400/20 flex items-center justify-center text-orange-400"
  }, React.createElement(Icon, {
    name: "Sun",
    size: 20
  })), React.createElement("div", null, React.createElement("div", {
    className: "text-xs text-gray-400 uppercase font-bold tracking-wider"
  }, t('Champ Solaire')), React.createElement("div", {
    className: "font-bold text-lg"
  }, resultats.panneauxKwc, " kWc"))), React.createElement("div", {
    className: "text-right text-xs text-gray-500"
  }, t('~'), Math.ceil(resultats.panneauxKwc * 2), " ", t('panneaux'), React.createElement("br", null), t('de 500Wc'))), React.createElement("div", {
    className: "flex items-center justify-between border-b border-white/10 pb-4"
  }, React.createElement("div", {
    className: "flex items-center gap-4"
  }, React.createElement("div", {
    className: "w-10 h-10 rounded-full bg-blue-400/20 flex items-center justify-center text-blue-400"
  }, React.createElement(Icon, {
    name: "Cpu",
    size: 20
  })), React.createElement("div", null, React.createElement("div", {
    className: "text-xs text-gray-400 uppercase font-bold tracking-wider"
  }, t('Onduleur Hybride')), React.createElement("div", {
    className: "font-bold text-lg"
  }, resultats.puissanceOnduleur, " kVA"))), React.createElement("div", {
    className: "text-[10px] bg-blue-500/20 text-blue-300 px-2 py-1 rounded-full border border-blue-500/30 uppercase font-bold"
  }, t('Monophasé'))), React.createElement("div", {
    className: "flex items-center justify-between"
  }, React.createElement("div", {
    className: "flex items-center gap-4"
  }, React.createElement("div", {
    className: "w-10 h-10 rounded-full bg-green-400/20 flex items-center justify-center text-green-400"
  }, React.createElement(Icon, {
    name: "BatteryCharging",
    size: 20
  })), React.createElement("div", null, React.createElement("div", {
    className: "text-xs text-gray-400 uppercase font-bold tracking-wider"
  }, t('Stockage Lithium')), React.createElement("div", {
    className: "font-bold text-lg"
  }, resultats.batteriesKwh, " kWh"))), React.createElement("div", {
    className: "text-right text-xs text-gray-500"
  }, t('Autonomie'), React.createElement("br", null), React.createElement("span", {
    className: "text-green-400"
  }, t('Nuit + Secours')))))), React.createElement("div", {
    className: "card p-6 border-t-4 border-[var(--orange)]"
  }, React.createElement("h3", {
    className: "font-bold text-gray-800 mb-2"
  }, t('Estimation Budget Clé en Main')), React.createElement("p", {
    className: "text-xs text-gray-500 mb-4"
  }, t('Inclut : Matériel, Pose, Protection et Mise en service.')), React.createElement("div", {
    className: "text-center py-4 bg-gray-50 rounded-lg mb-4"
  }, React.createElement("div", {
    className: "text-3xl font-bold mono",
    style: {
      color: 'var(--bleu)'
    }
  }, fmtM((resultats.coutMin + resultats.coutMax) / 2), " F"), React.createElement("div", {
    className: "text-xs text-gray-400 mt-1"
  }, t('Fourchette :'), " ", fmtM(resultats.coutMin), " - ", fmtM(resultats.coutMax), " FCFA")), React.createElement("div", {
    className: "space-y-2"
  }, React.createElement("button", {
    onClick: handleQuoteRequest,
    className: "btn-primary w-full py-3 rounded-xl font-bold uppercase tracking-wide shadow-lg shadow-orange-200 flex items-center justify-center gap-2"
  }, t('Demander un devis formel')), React.createElement("button", {
    onClick: () => window.print(),
    className: "w-full py-3 text-sm text-gray-500 hover:text-[var(--bleu)] transition-colors flex items-center justify-center gap-2"
  }, React.createElement(Icon, {
    name: "Download",
    size: 14
  }), " ", t('Télécharger la fiche PDF')))), React.createElement("div", {
    className: "text-xs text-gray-400 text-center leading-relaxed"
  }, t('Cette simulation est indicative et non contractuelle.'))))));
};
ReactDOM.createRoot(document.getElementById('root')).render(React.createElement(App, null));
    } catch (err) {
      console.error('[AIAE] Erreur au démarrage de energie-calculator:', err);
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
