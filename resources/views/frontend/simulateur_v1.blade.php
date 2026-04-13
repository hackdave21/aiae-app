<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulateur AIAE - Estimation Construction</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/react@18/umd/react.production.min.js"></script>
  <script src="https://unpkg.com/react-dom@18/umd/react-dom.production.min.js"></script>
  <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    :root{--bleu:#0E1540;--vert:#05482C;--orange:#CC6A00}
    body{margin:0;font-family:'Inter',system-ui,sans-serif;background:#f8fafc}
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
    .option-btn{padding:16px;border:2px solid #e2e8f0;border-radius:10px;text-align:left;cursor:pointer;transition:all 0.2s;background:white}
    .option-btn:hover{border-color:#cbd5e1;box-shadow:0 4px 6px -1px rgba(0,0,0,0.1)}
    .option-btn.selected{border-color:#3b82f6;background:#eff6ff}
    .warn-box{background:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:0 8px 8px 0}
    .alert-box{background:#fee2e2;border-left:4px solid #ef4444;padding:12px 16px;border-radius:0 8px 8px 0}
    .info-box{background:#eff6ff;border-left:4px solid #3b82f6;padding:12px 16px;border-radius:0 8px 8px 0}
    .success-box{background:#ecfdf5;border-left:4px solid #10b981;padding:12px 16px;border-radius:0 8px 8px 0}
    .badge{display:inline-flex;align-items:center;padding:4px 10px;border-radius:6px;font-size:12px;font-weight:600}
    .badge-blue{background:#dbeafe;color:#1e40af}
    .badge-green{background:#dcfce7;color:#166534}
    .badge-orange{background:#ffedd5;color:#c2410c}
    .badge-red{background:#fee2e2;color:#b91c1c}
    .badge-gray{background:#f3f4f6;color:#374151}
    .optimal-ring{box-shadow:0 0 0 3px rgba(34,197,94,0.4)}
  </style>
  <script src="js/tailwind-config.js"></script>
</head>
<body>
<div id="root"></div>
<script>
    window.INITIAL_SECTEUR = "{{ $secteur ?? '' }}";
    window.SAVE_ROUTE = "{{ route('simulator.save') }}";
</script>
<script type="text/babel">
@verbatim
const {useState,useMemo}=React;

const App=()=>{
  const VERSION='8.1';
  
  // DONNÉES RÉFÉRENCE - PRIX INTERNES NON AFFICHÉS
  const ZONES={
    zone1:{name:'Zone 1 - Grand Lomé',localites:'Lomé, Baguida, Agoè',coef:1.00,forage:25,foncier:75000},
    zone2:{name:'Zone 2 - Maritime',localites:'Tsévié, Tabligbo, Aného',coef:1.08,forage:35,foncier:25000},
    zone3:{name:'Zone 3 - Plateaux',localites:'Atakpamé, Kpalimé, Badou',coef:1.14,forage:50,foncier:12000},
    zone4:{name:'Zone 4 - Centrale',localites:'Sokodé, Tchamba, Blitta',coef:1.19,forage:60,foncier:6000},
    zone5:{name:'Zone 5 - Kara & Savanes',localites:'Kara, Dapaong, Mango',coef:1.25,forage:75,foncier:4000}
  };

  const SOLS={
    inconnu:{name:'Non déterminé',coef:1.15,portance:'?',fondation:'À définir après étude',prixFond:55000,risque:'moyen'},
    ferralitique:{name:'Ferralitique (Terre de barre)',coef:1.00,portance:'1.5-2.5 bars',fondation:'Semelles filantes',prixFond:32000,risque:'faible'},
    ferrugineux:{name:'Ferrugineux tropical',coef:1.10,portance:'1.0-2.0 bars',fondation:'Semelles renforcées',prixFond:38000,risque:'faible'},
    laterite:{name:'Latérite / Cuirasse',coef:1.03,portance:'3.0-5.0 bars',fondation:'Semelles réduites',prixFond:28000,risque:'faible'},
    argileux:{name:'Argileux ⚠️',coef:1.30,portance:'0.5-1.5 bars',fondation:'Radier ou pieux',prixFond:75000,risque:'élevé'},
    sableux:{name:'Sableux',coef:1.18,portance:'1.0-2.0 bars',fondation:'Semelles + compactage',prixFond:48000,risque:'moyen'},
    hydromorphe:{name:'Hydromorphe ⚠️⚠️',coef:1.55,portance:'0.3-1.0 bars',fondation:'Pieux profonds',prixFond:120000,risque:'très élevé'},
    rocheux:{name:'Rocheux',coef:0.98,portance:'>5 bars',fondation:'Ancrages roche',prixFond:25000,risque:'faible'}
  };

  // STANDINGS - SANS PRIX AFFICHÉS
  const STANDINGS={
    standard:{name:'Standard',desc:'Économique et fonctionnel',icon:'🏠'},
    confort:{name:'Confort',desc:'Qualité-prix optimal',icon:'🏡'},
    premium:{name:'Premium',desc:'Excellence et personnalisation',icon:'🏘️'},
    prestige:{name:'Prestige',desc:'Luxe sans compromis',icon:'🏰'}
  };
  const STANDINGS_PRIX={standard:375000,confort:500000,premium:690000,prestige:1025000};
  const STANDINGS_HSP={standard:2.60,confort:2.80,premium:3.00,prestige:3.20};
  const STANDINGS_EMPRISE={standard:0.40,confort:0.35,premium:0.30,prestige:0.25};

  const TYPES={
    residentiel:[
      {id:'villa',name:'Villa individuelle',max:3,icon:'🏠'},
      {id:'immeuble',name:'Immeuble résidentiel',max:10,icon:'🏢'},
      {id:'residence',name:'Résidence de standing',max:12,maj:1.15,icon:'🏛️'}
    ],
    tertiaire:[
      {id:'bureaux',name:'Bureaux',max:20,prix:520000,icon:'🏢'},
      {id:'commerce',name:'Commerce',max:4,prix:450000,icon:'🏪'},
      {id:'hotel',name:'Hôtel',max:20,prix:625000,icon:'🏨'},
      {id:'clinique',name:'Clinique',max:6,prix:720000,icon:'🏥'}
    ],
    industriel:[
      {id:'entrepot',name:'Entrepôt',max:2,prix:220000,icon:'📦'},
      {id:'usine',name:'Usine',max:3,prix:350000,icon:'🏭'},
      {id:'atelier',name:'Atelier',max:2,prix:280000,icon:'🔧'},
      {id:'frigo',name:'Chambre froide',max:2,prix:480000,icon:'❄️'}
    ],
    agricole:[
      {id:'hangar',name:'Hangar',max:1,prix:120000,icon:'🚜'},
      {id:'elevage_bovins',name:'Élevage bovins',max:1,prix:85000,ratio:8,icon:'🐄'},
      {id:'elevage_volailles',name:'Volailles',max:1,prix:45000,ratio:0.1,icon:'🐔'},
      {id:'serres',name:'Serres',max:1,prix:65000,icon:'🌱'},
      {id:'stockage',name:'Silos',max:1,prix:150000,icon:'🌾'}
    ]
  };

  // HÔTELS - SANS PRIX AFFICHÉS
  const HOTELS=[
    {id:'1s',name:'★',surfCh:16},{id:'2s',name:'★★',surfCh:18},{id:'3s',name:'★★★',surfCh:22},
    {id:'4s',name:'★★★★',surfCh:28},{id:'5s',name:'★★★★★',surfCh:35},{id:'palace',name:'Palace',surfCh:50}
  ];
  const HOTELS_PRIX={'1s':430000,'2s':500000,'3s':625000,'4s':800000,'5s':1175000,'palace':2000000};

  const SOLAIRES=[
    {id:'3',kw:3,prix:4500000},{id:'5',kw:5,prix:7500000},{id:'10',kw:10,prix:14000000},
    {id:'15',kw:15,prix:20000000},{id:'20',kw:20,prix:26000000},{id:'30',kw:30,prix:38000000},
    {id:'50',kw:50,prix:58000000},{id:'100',kw:100,prix:105000000}
  ];

  const GROUPES=[
    {id:'15',kva:15,prix:4500000},{id:'20',kva:20,prix:5500000},{id:'40',kva:40,prix:9000000},
    {id:'60',kva:60,prix:14000000},{id:'100',kva:100,prix:22000000},{id:'150',kva:150,prix:32000000}
  ];

  // ÉTAT
  const [page,setPage]=useState(window.INITIAL_SECTEUR ? 'sim' : 'accueil');
  const [etape,setEtape]=useState(1);
  const [secteur,setSecteur]=useState(window.INITIAL_SECTEUR || '');
  const [typeBat,setTypeBat]=useState('');
  const [standing,setStanding]=useState('confort');
  const [catHotel,setCatHotel]=useState('3s');
  const [forme,setForme]=useState('rect');
  const [dimA,setDimA]=useState(30);
  const [dimB,setDimB]=useState(20);
  const [surfManuelle,setSurfManuelle]=useState(600);
  const [terrainDispo,setTerrainDispo]=useState('oui');
  const [zone,setZone]=useState('zone1');
  const [sol,setSol]=useState('');
  const [niveaux,setNiveaux]=useState(1);
  const [ssSol,setSsSol]=useState(0);
  const [hspRdc,setHspRdc]=useState(3.0);
  const [hspEtage,setHspEtage]=useState(2.8);
  const [nbChambres,setNbChambres]=useState(30);
  const [espacesHotel,setEspacesHotel]=useState([]);
  const [hauteurLibre,setHauteurLibre]=useState(8);
  const [pontRoulant,setPontRoulant]=useState(false);
  const [pontCap,setPontCap]=useState(5);
  const [groupeFroid,setGroupeFroid]=useState('');
  const [effectif,setEffectif]=useState(100);
  const [irrigation,setIrrigation]=useState('');
  const [surfExploit,setSurfExploit]=useState(5);
  const [nbAsc,setNbAsc]=useState(0);
  const [nbQuais,setNbQuais]=useState(2);
  const [solaire,setSolaire]=useState('');
  const [groupe,setGroupe]=useState('');
  const [alarme,setAlarme]=useState('');
  const [nbZones,setNbZones]=useState(6);
  const [video,setVideo]=useState('');
  const [acces,setAcces]=useState('');
  const [nbPortes,setNbPortes]=useState(2);
  const [cloture,setCloture]=useState(false);
  const [clotureH,setClotureH]=useState(2);
  const [portail,setPortail]=useState('');
  const [piscine,setPiscine]=useState('');
  const [forage,setForage]=useState(false);
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
    if(typeBat==='hotel')return HOTELS_PRIX[catHotel]||625000;
    if(secteur==='industriel'){
      let base=typeData?.prix||250000;
      if(hauteurLibre>10)base*=1.12;
      if(pontRoulant)base*=1.15;
      if(typeBat==='frigo')base*=1.25;
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
    if(['hotel','commerce','clinique'].includes(typeBat)){geoOblig=true;motifs.push('ERP');}
    if(sol==='argileux'||sol==='hydromorphe'){geoOblig=true;motifs.push('Sol risque');}
    if(ssSol>0){geoOblig=true;motifs.push('Sous-sol');}
    return{cat,geoOblig,motifs,mission:geoOblig?(cat==='B2'?'G2 PRO':'G2 AVP'):'G1'};
  },[niveaux,hauteurTotale,typeBat,sol,ssSol]);

  // Durée
  const duree=useMemo(()=>{
    let d=6;
    if(secteur==='residentiel')d=typeBat==='villa'?8:14+(niveaux-2)*1.5;
    else if(secteur==='tertiaire')d=typeBat==='hotel'?18+(niveaux-3)*2:12+(niveaux-2)*1.5;
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
    details.push({label:'💡 Éclairage',kw:Math.round(pEcl*10)/10,prio:1});
    // Prises
    details.push({label:'🔌 Prises',kw:Math.round(surfaceBatie*0.015*10)/10,prio:2});
    // Clim
    let surfClim=surfaceBatie*(secteur==='industriel'?0.15:secteur==='agricole'?0.10:0.70);
    if(surfClim>0)details.push({label:'❄️ Climatisation',kw:Math.round(surfClim*0.10*10)/10,prio:5});
    // Hôtel
    if(typeBat==='hotel'){
      details.push({label:'🚿 Eau chaude',kw:Math.round(nbChambres*0.3*10)/10,prio:4});
      if(espacesHotel.includes('restaurant'))details.push({label:'🍳 Cuisine pro',kw:15,prio:6});
      if(espacesHotel.includes('spa'))details.push({label:'💆 Spa',kw:12,prio:7});
    }
    if(secteur==='residentiel')details.push({label:'🍳 Électroménager',kw:Math.round(surfaceBatie*0.008*10)/10,prio:6});
    // Équipements
    if(nbAsc>0)details.push({label:'🛗 Ascenseurs',kw:Math.round(nbAsc*12*0.15*10)/10,prio:9});
    if(pontRoulant)details.push({label:'🏗️ Pont roulant',kw:Math.round((pontCap<=5?15:pontCap<=10?25:40)*0.2*10)/10,prio:10});
    if(typeBat==='frigo'||groupeFroid)details.push({label:'🧊 Groupe froid',kw:Math.round(surfaceBatie*(groupeFroid==='negatif'?0.15:0.08)*0.7*10)/10,prio:3});
    // Sécurité
    if(alarme)details.push({label:'🚨 Alarme',kw:0.5,prio:11});
    if(video)details.push({label:'📹 Vidéo',kw:video==='16+'?1.5:0.8,prio:3});
    // Extérieurs
    if(piscine)details.push({label:'🏊 Piscine',kw:piscine==='12x5'?5:3.5,prio:8});
    if(forage)details.push({label:'💧 Pompe forage',kw:secteur==='agricole'?5:2,prio:7});
    if(irrigation==='goutte')details.push({label:'🌱 Irrigation',kw:surfExploit*0.8,prio:7});
    
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
      postes.push({code:'0',nom:'Acquisition foncière',detail:`${Math.round(surface)} m²`,montant:foncier});
    }
    // Études 8%
    add('1','Études et honoraires','Architecture, structure, géotechnique',surfaceBatie*prixM2*coefTotal*0.08);
    // Fondations
    let fond=surface*emprise*(solData?.prixFond||45000);
    if(secteur==='industriel')fond*=1.3;
    if(ssSol>0)fond+=ssSol*surface*emprise*85000;
    add('2','Terrassements et fondations',solData?.fondation||'À définir',fond);
    // Gros œuvre 38%
    add('3','Gros œuvre','Structure, maçonnerie, planchers',surfaceBatie*prixM2*coefTotal*0.38);
    // Second œuvre 25%
    add('4','Second œuvre','Menuiseries, cloisons, plâtrerie',surfaceBatie*prixM2*coefTotal*0.25);
    // Lots techniques 18%
    add('5','Lots techniques','Électricité, plomberie, CVC',surfaceBatie*prixM2*coefTotal*0.18);
    // Finitions 11%
    add('6','Finitions','Revêtements, peinture, sanitaires',surfaceBatie*prixM2*coefTotal*0.11);
    // Équipements
    let equip=0;
    if(nbAsc>0)equip+=nbAsc*(niveaux<=5?28000000:35000000);
    if(nbQuais>0&&secteur==='industriel')equip+=nbQuais*8500000;
    if(pontRoulant)equip+=pontCap<=5?28000000:pontCap<=10?48000000:78000000;
    if(groupeFroid)equip+=surfaceBatie*(groupeFroid==='negatif'?95000:55000);
    if(irrigation==='goutte')equip+=surfExploit*1800000;
    if(equip>0)add('7','Équipements spécifiques','Ascenseurs, quais, pont, froid',equip);
    // Énergie
    const kitSol=SOLAIRES.find(k=>k.id===solaire);
    const grp=GROUPES.find(g=>g.id===groupe);
    const energie=(kitSol?.prix||0)+(grp?.prix||0);
    if(energie>0)add('8','Énergie',`${kitSol?kitSol.kw+' kWc':''}${grp?' + '+grp.kva+' kVA':''}`.trim(),energie);
    // Sécurité
    let secu=0;
    if(alarme==='basique')secu+=850000+nbZones*125000;
    if(alarme==='connectee')secu+=1600000+nbZones*185000;
    if(alarme==='pro')secu+=3800000+nbZones*295000;
    if(video==='4-8')secu+=2200000;
    if(video==='16+')secu+=8500000;
    if(acces==='badge')secu+=950000+nbPortes*320000;
    if(acces==='bio')secu+=1800000+nbPortes*720000;
    if(secu>0)add('9','Sécurité','Alarme, vidéo, contrôle accès',secu);
    // VRD
    let vrd=surface*8500;
    if(cloture)vrd+=perimetre*(clotureH<=2?88000:135000);
    if(portail==='manuel')vrd+=550000;
    if(portail==='motorise')vrd+=1650000;
    if(piscine==='8x4')vrd+=14500000;
    if(piscine==='12x5')vrd+=26000000;
    if(forage)vrd+=forageProf*95000+1200000;
    if(parkPlaces>0)vrd+=parkPlaces*(parkType==='souterrain'?3800000:parkType==='couvert'?1350000:420000);
    add('10','VRD et aménagements','Clôture, portail, piscine, parking',vrd);
    // Aléas 5%
    add('11','Provisions aléas','5% recommandé',total*0.05);

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
    
    const basePostes = ['1', '2', '3', '4', '5', '6'];
    const base_amount = estimation.postes.filter(p => basePostes.includes(p.code)).reduce((s, p) => s + p.montant, 0);
    const options_amount = estimation.postes.filter(p => !basePostes.includes(p.code) && p.code !== '0' && p.code !== '11').reduce((s, p) => s + p.montant, 0);

    const data = {
        secteur, typeBat, standing, zone, sol, niveaux, ssSol,
        dimensions: { surface, surfaceBatie, hauteurTotale },
        besoins: besoins.total, solaire, groupe,
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
                title: 'Succès !',
                text: 'Votre simulation a été enregistrée avec succès.',
                icon: 'success',
                confirmButtonColor: 'var(--orange)',
                confirmButtonText: 'Continuer'
            });
            window.location.href = response.data.redirect;
        }
    } catch (error) {
        console.error("Erreur sauvegarde:", error);
        Swal.fire({
            title: 'Erreur',
            text: "Une erreur est survenue lors de l'enregistrement.",
            icon: 'error'
        });
    } finally {
        setIsSaving(false);
    }
  };

  // COMPOSANTS UI
  const InputNum=({value,onChange,min=0,max=999,step=1,unit='',label=''})=>(
    <div className="flex flex-col">
      {label&&<label className="text-xs text-gray-500 mb-1">{label}</label>}
      <div className="input-num">
        <button onClick={()=>onChange(Math.max(min,value-step))}>−</button>
        <div className="value">{typeof value==='number'&&value%1!==0?value.toFixed(1):value}{unit&&<span className="text-xs text-gray-500 ml-1">{unit}</span>}</div>
        <button onClick={()=>onChange(Math.min(max,value+step))}>+</button>
      </div>
    </div>
  );

  const Header=()=>(
    <header className="bg-white border-b sticky top-0 z-50 no-print">
      <div className="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <button onClick={()=>setPage('accueil')} className="flex items-center gap-3">
          <div className="w-10 h-10 rounded-lg flex items-center justify-center" style={{background:'var(--vert)'}}>
            <svg viewBox="0 0 40 40" className="w-6 h-6" fill="white"><rect x="8" y="16" width="5" height="18"/><rect x="17" y="10" width="5" height="24"/><rect x="26" y="13" width="5" height="21"/></svg>
          </div>
          <div>
            <div className="font-bold text-sm" style={{color:'var(--bleu)'}}>AIAE SARL</div>
            <div className="text-xs text-gray-500">Simulateur v{VERSION}</div>
          </div>
        </button>
        <div className="flex items-center gap-4">
          <div className="hidden sm:flex items-center gap-1">
            {[1,2,3,4,5].map(n=>(
              <div key={n} className="flex items-center">
                <div className={`w-8 h-8 rounded-full flex items-center justify-center text-sm font-medium ${n<etape?'bg-green-500 text-white':n===etape?'bg-blue-600 text-white':'bg-gray-200 text-gray-500'}`}>
                  {n<etape?'✓':n}
                </div>
                {n<5&&<div className={`w-6 h-0.5 ${n<etape?'bg-green-500':'bg-gray-200'}`}/>}
              </div>
            ))}
          </div>
          <button onClick={reset} className="text-sm text-gray-600 hover:text-gray-800 flex items-center gap-1">
            <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeWidth={2} d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
            <span className="hidden sm:inline">Nouveau</span>
          </button>
        </div>
      </div>
    </header>
  );

  const Nav=({canContinue=true})=>(
    <div className="flex justify-between items-center mt-8 pt-6 border-t no-print">
      <button onClick={()=>etape>1?setEtape(etape-1):setPage('accueil')} className="flex items-center gap-2 px-5 py-2.5 text-gray-600 hover:text-gray-800 rounded-lg">
        ← Retour
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
            Chargement...
          </span>
        ) : (
          <>{etape === 5 ? 'Demander un devis' : 'Continuer'} →</>
        )}
      </button>
    </div>
  );

  // PAGE ACCUEIL
  if(page==='accueil'){
    return(
      <div className="min-h-screen" style={{background:'var(--bleu)'}}>
        <div className="max-w-4xl mx-auto px-4 py-12">
          <div className="text-center mb-12">
            <div className="inline-flex items-center justify-center w-20 h-20 rounded-2xl mb-6" style={{background:'var(--vert)'}}>
              <svg viewBox="0 0 40 40" className="w-12 h-12" fill="white"><rect x="8" y="16" width="5" height="18"/><rect x="17" y="10" width="5" height="24"/><rect x="26" y="13" width="5" height="21"/></svg>
            </div>
            <h1 className="text-3xl md:text-4xl font-bold text-white mb-3">Simulateur d'Estimation</h1>
            <p className="text-blue-200 text-lg">AFRIKA INFRASTRUCTURE, AUTOMATION & ENERGY</p>
            <p className="text-blue-300 text-sm mt-2">Version {VERSION} • Décembre 2025</p>
          </div>
          <div className="bg-white/10 backdrop-blur rounded-2xl p-6 mb-8">
            <h2 className="text-white font-semibold mb-4">Sélectionnez votre secteur</h2>
            <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
              {[
                {id:'residentiel',icon:'🏠',name:'Résidentiel',desc:'Villas, immeubles'},
                {id:'tertiaire',icon:'🏢',name:'Tertiaire',desc:'Bureaux, hôtels'},
                {id:'industriel',icon:'🏭',name:'Industriel',desc:'Usines, entrepôts'},
                {id:'agricole',icon:'🌾',name:'Agricole',desc:'Élevage, stockage'}
              ].map(s=>(
                <button key={s.id} onClick={()=>{setSecteur(s.id);setPage('sim');}}
                  className="bg-white rounded-xl p-5 text-left hover:shadow-lg hover:scale-[1.02] transition-all">
                  <div className="text-3xl mb-3">{s.icon}</div>
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
              <h2 className="text-xl font-bold text-gray-800">Type de projet</h2>
              <p className="text-gray-500 text-sm">Secteur: {secteur}</p>
            </div>
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">Type de bâtiment</h3>
              <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                {TYPES[secteur]?.map(t=>(
                  <button key={t.id} onClick={()=>setTypeBat(t.id)} className={`option-btn ${typeBat===t.id?'selected':''}`}>
                    <div className="text-2xl mb-2">{t.icon}</div>
                    <div className="font-medium text-gray-800">{t.name}</div>
                    <div className="text-xs text-gray-500 mt-1">Max R+{t.max-1}</div>
                  </button>
                ))}
              </div>
            </div>
            {secteur==='residentiel'&&typeBat&&(
              <div className="card p-5 mb-6">
                <h3 className="font-semibold text-gray-700 mb-4">Niveau de standing</h3>
                <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                  {Object.entries(STANDINGS).map(([id,d])=>(
                    <button key={id} onClick={()=>setStanding(id)} className={`option-btn ${standing===id?'selected':''}`}>
                      <div className="text-2xl mb-2">{d.icon}</div>
                      <div className="font-semibold text-gray-800">{d.name}</div>
                      <div className="text-xs text-gray-500 mt-1">{d.desc}</div>
                    </button>
                  ))}
                </div>
              </div>
            )}
            {typeBat==='hotel'&&(
              <div className="card p-5 mb-6">
                <h3 className="font-semibold text-gray-700 mb-4">Classification hôtelière</h3>
                <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                  {HOTELS.map(h=>(
                    <button key={h.id} onClick={()=>setCatHotel(h.id)} className={`option-btn ${catHotel===h.id?'selected':''}`}>
                      <div className="font-semibold text-lg">{h.name}</div>
                      <div className="text-xs text-gray-500 mt-2">~{h.surfCh} m²/chambre</div>
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
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">Caractéristiques du terrain</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">Forme et dimensions</h3>
                <div className="grid grid-cols-3 gap-2 mb-4">
                  {['carre','rect','irregulier'].map(f=>(
                    <button key={f} onClick={()=>setForme(f)} className={`py-2 px-3 rounded text-sm font-medium ${forme===f?'bg-blue-600 text-white':'bg-gray-100'}`}>
                      {f==='carre'?'Carré':f==='rect'?'Rectangle':'Irrégulier'}
                    </button>
                  ))}
                </div>
                {forme!=='irregulier'?(
                  <div className="grid grid-cols-2 gap-4">
                    <InputNum value={dimA} onChange={setDimA} min={10} max={200} unit="m" label={forme==='carre'?'Côté':'Longueur'}/>
                    {forme!=='carre'&&<InputNum value={dimB} onChange={setDimB} min={10} max={200} unit="m" label="Largeur"/>}
                  </div>
                ):(
                  <InputNum value={surfManuelle} onChange={setSurfManuelle} min={100} max={50000} step={50} unit="m²" label="Surface"/>
                )}
                <div className="mt-4 p-4 bg-blue-50 rounded-lg grid grid-cols-2 gap-4">
                  <div><div className="text-xs text-gray-500">Surface</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(surface)} m²</div></div>
                  <div><div className="text-xs text-gray-500">Périmètre</div><div className="text-xl font-bold mono" style={{color:'var(--bleu)'}}>{fmt(perimetre)} ml</div></div>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">Disponibilité</h3>
                <div className="grid grid-cols-3 gap-2 mb-4">
                  {[{id:'oui',n:'Disponible'},{id:'option',n:'En option'},{id:'non',n:'À acquérir'}].map(t=>(
                    <button key={t.id} onClick={()=>setTerrainDispo(t.id)} className={`option-btn text-center py-3 ${terrainDispo===t.id?'selected':''}`}>
                      <div className="text-sm">{t.n}</div>
                    </button>
                  ))}
                </div>
                {terrainDispo!=='oui'&&<div className="info-box text-sm"><strong>Note:</strong> Coût d'acquisition estimé selon la zone.</div>}
              </div>
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">Zone géographique</h3>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-3">
                {Object.entries(ZONES).map(([id,z])=>(
                  <button key={id} onClick={()=>setZone(id)} className={`option-btn ${zone===id?'selected':''}`}>
                    <div className="font-medium">{z.name}</div>
                    <div className="text-xs text-gray-500">{z.localites}</div>
                    <span className="badge badge-blue mt-2">×{z.coef.toFixed(2)}</span>
                  </button>
                ))}
              </div>
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">Type de sol</h3>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-3">
                {Object.entries(SOLS).map(([id,s])=>(
                  <button key={id} onClick={()=>setSol(id)} className={`option-btn ${sol===id?'selected':''} ${s.risque==='élevé'||s.risque==='très élevé'?'border-orange-300':''}`}>
                    <div className="flex justify-between items-start">
                      <div>
                        <div className="font-medium">{s.name}</div>
                        <div className="text-xs text-gray-500 mt-1">Portance: {s.portance}</div>
                        <div className="text-xs text-gray-500">{s.fondation}</div>
                      </div>
                      <span className={`badge ${s.risque==='faible'?'badge-green':s.risque==='moyen'?'badge-blue':'badge-orange'}`}>×{s.coef.toFixed(2)}</span>
                    </div>
                  </button>
                ))}
              </div>
              {sol&&(sol==='argileux'||sol==='hydromorphe')&&<div className="alert-box mt-4"><strong>⚠️ Sol à risque</strong><p className="text-sm mt-1">Étude géotechnique G2 obligatoire.</p></div>}
              {sol&&solData&&<div className="mt-4 p-4 bg-gray-50 rounded-lg"><div className="text-sm"><strong>Coefficient total:</strong> <span className="mono font-bold" style={{color:'var(--bleu)'}}>×{coefTotal.toFixed(3)}</span></div></div>}
            </div>
            <Nav canContinue={!!sol}/>
          </div>
        )}

        {/* ÉTAPE 3: BÂTIMENT */}
        {etape===3&&(
          <div>
            <div className="mb-6"><h2 className="text-xl font-bold text-gray-800">Configuration du bâtiment</h2></div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">Niveaux</h3>
                <div className="grid grid-cols-2 gap-4">
                  <InputNum value={niveaux} onChange={setNiveaux} min={1} max={typeData?.max||10} label="Niveaux hors sol"/>
                  <InputNum value={ssSol} onChange={setSsSol} min={0} max={3} label="Sous-sols"/>
                </div>
                <div className="grid grid-cols-2 gap-4 mt-4">
                  <InputNum value={hspRdc} onChange={setHspRdc} min={2.4} max={6} step={0.1} unit="m" label="HSP RDC"/>
                  <InputNum value={hspEtage} onChange={setHspEtage} min={2.4} max={4} step={0.1} unit="m" label="HSP Étages"/>
                </div>
              </div>
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">Synthèse technique</h3>
                <div className="space-y-3">
                  <div className="flex justify-between"><span className="text-gray-500">Emprise au sol</span><span className="mono font-semibold">{fmt(surface*emprise)} m² ({Math.round(emprise*100)}%)</span></div>
                  <div className="flex justify-between"><span className="text-gray-500">Surface plancher</span><span className="mono font-semibold">{fmt(surfaceBatie)} m²</span></div>
                  <div className="flex justify-between"><span className="text-gray-500">Hauteur totale</span><span className="mono font-semibold">{hauteurTotale.toFixed(1)} m</span></div>
                </div>
                <div className="mt-4 p-3 bg-gray-50 rounded-lg">
                  <div className="flex items-center gap-2">
                    <span className={`badge ${categorie.cat==='A1'?'badge-green':categorie.cat==='A2'?'badge-blue':'badge-orange'}`}>Cat. {categorie.cat}</span>
                    <span className={`badge ${categorie.geoOblig?'badge-orange':'badge-gray'}`}>Géotech. {categorie.mission}</span>
                  </div>
                  {categorie.motifs.length>0&&<div className="text-xs text-gray-500 mt-2">{categorie.motifs.join(' • ')}</div>}
                </div>
              </div>
            </div>
            {typeBat==='hotel'&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">Configuration hôtel</h3>
                <div className="grid grid-cols-2 gap-4 mb-4">
                  <InputNum value={nbChambres} onChange={setNbChambres} min={5} max={500} label="Chambres"/>
                  <InputNum value={nbAsc} onChange={setNbAsc} min={0} max={10} label="Ascenseurs"/>
                </div>
                <div className="flex flex-wrap gap-2">
                  {['restaurant','bar','spa','piscine','salle_conf','parking'].map(e=>(
                    <button key={e} onClick={()=>setEspacesHotel(espacesHotel.includes(e)?espacesHotel.filter(x=>x!==e):[...espacesHotel,e])}
                      className={`px-3 py-1.5 rounded-full text-sm ${espacesHotel.includes(e)?'bg-blue-600 text-white':'bg-gray-100'}`}>
                      {e.replace('_',' ')}
                    </button>
                  ))}
                </div>
              </div>
            )}
            {secteur==='industriel'&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">Configuration industrielle</h3>
                <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                  <InputNum value={hauteurLibre} onChange={setHauteurLibre} min={4} max={20} unit="m" label="Hauteur libre"/>
                  <InputNum value={nbQuais} onChange={setNbQuais} min={0} max={20} label="Quais"/>
                </div>
                <div className="flex items-center gap-4 mt-4">
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={pontRoulant} onChange={e=>setPontRoulant(e.target.checked)} className="w-4 h-4"/>
                    <span>Pont roulant</span>
                  </label>
                  {pontRoulant&&<InputNum value={pontCap} onChange={setPontCap} min={1} max={50} unit="T" label="Capacité"/>}
                </div>
                {(typeBat==='frigo'||typeBat==='entrepot')&&(
                  <div className="mt-4">
                    <label className="text-sm text-gray-600">Groupe froid</label>
                    <div className="flex gap-2 mt-2">
                      {[{id:'',n:'Non'},{id:'positif',n:'Positif'},{id:'negatif',n:'Négatif'}].map(g=>(
                        <button key={g.id} onClick={()=>setGroupeFroid(g.id)} className={`px-3 py-1.5 rounded text-sm ${groupeFroid===g.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{g.n}</button>
                      ))}
                    </div>
                  </div>
                )}
              </div>
            )}
            {secteur==='agricole'&&typeBat?.startsWith('elevage_')&&(
              <div className="card p-5 mt-6">
                <h3 className="font-semibold text-gray-700 mb-4">Élevage</h3>
                <InputNum value={effectif} onChange={setEffectif} min={10} max={10000} step={10} label={typeBat==='elevage_volailles'?'Sujets':'Têtes'}/>
                <div className="mt-3 text-sm text-gray-500">Surface: {fmt(surfaceBatie)} m²</div>
              </div>
            )}
            <Nav/>
          </div>
        )}

        {/* ÉTAPE 4: ÉQUIPEMENTS */}
        {etape===4&&(
          <div>
            <div className="mb-6">
              <h2 className="text-xl font-bold text-gray-800">Équipements et options</h2>
              <p className="text-gray-500 text-sm">Sécurité et aménagements extérieurs</p>
            </div>
            <div className="grid md:grid-cols-2 gap-6">
              <div className="card p-5">
                <h3 className="font-semibold text-gray-700 mb-4">🔒 Sécurité</h3>
                <div className="space-y-4">
                  <div>
                    <label className="text-sm text-gray-600">Alarme</label>
                    <div className="flex flex-wrap gap-2 mt-2">
                      {[{id:'',n:'Non'},{id:'basique',n:'Basique'},{id:'connectee',n:'Connectée'},{id:'pro',n:'Pro'}].map(a=>(
                        <button key={a.id} onClick={()=>setAlarme(a.id)} className={`px-3 py-1.5 rounded text-sm ${alarme===a.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{a.n}</button>
                      ))}
                    </div>
                    {alarme&&<InputNum value={nbZones} onChange={setNbZones} min={2} max={24} label="Zones"/>}
                  </div>
                  <div>
                    <label className="text-sm text-gray-600">Vidéosurveillance</label>
                    <div className="flex gap-2 mt-2">
                      {[{id:'',n:'Non'},{id:'4-8',n:'4-8 cam'},{id:'16+',n:'16+ cam'}].map(v=>(
                        <button key={v.id} onClick={()=>setVideo(v.id)} className={`px-3 py-1.5 rounded text-sm ${video===v.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{v.n}</button>
                      ))}
                    </div>
                  </div>
                  <div>
                    <label className="text-sm text-gray-600">Contrôle accès</label>
                    <div className="flex gap-2 mt-2">
                      {[{id:'',n:'Non'},{id:'badge',n:'Badge'},{id:'bio',n:'Biométrique'}].map(c=>(
                        <button key={c.id} onClick={()=>setAcces(c.id)} className={`px-3 py-1.5 rounded text-sm ${acces===c.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{c.n}</button>
                      ))}
                    </div>
                    {acces&&<InputNum value={nbPortes} onChange={setNbPortes} min={1} max={20} label="Portes"/>}
                  </div>
                </div>
              </div>
              {secteur!=='agricole'&&(
                <div className="card p-5">
                  <h3 className="font-semibold text-gray-700 mb-4">🛗 Ascenseurs</h3>
                  <InputNum value={nbAsc} onChange={setNbAsc} min={0} max={10} label="Nombre"/>
                  {nbAsc>0&&<p className="text-xs text-gray-500 mt-2">Obligatoire si ERP et R+1</p>}
                </div>
              )}
            </div>
            <div className="card p-5 mt-6">
              <h3 className="font-semibold text-gray-700 mb-4">🏡 Extérieurs</h3>
              <div className="grid md:grid-cols-3 gap-4">
                <div>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={cloture} onChange={e=>setCloture(e.target.checked)} className="w-4 h-4"/>
                    <span>Clôture ({fmt(perimetre)} ml)</span>
                  </label>
                  {cloture&&<div className="mt-2 flex gap-2">{[1.5,2,2.5,3].map(h=>(<button key={h} onClick={()=>setClotureH(h)} className={`px-3 py-1 rounded text-sm ${clotureH===h?'bg-blue-600 text-white':'bg-gray-100'}`}>{h}m</button>))}</div>}
                </div>
                <div>
                  <label className="text-sm text-gray-600">Portail</label>
                  <div className="flex gap-2 mt-2">
                    {[{id:'',n:'Non'},{id:'manuel',n:'Manuel'},{id:'motorise',n:'Motorisé'}].map(p=>(<button key={p.id} onClick={()=>setPortail(p.id)} className={`px-3 py-1.5 rounded text-sm ${portail===p.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{p.n}</button>))}
                  </div>
                </div>
                <div>
                  <label className="text-sm text-gray-600">Piscine</label>
                  <div className="flex gap-2 mt-2">
                    {[{id:'',n:'Non'},{id:'8x4',n:'8×4m'},{id:'12x5',n:'12×5m'}].map(p=>(<button key={p.id} onClick={()=>setPiscine(p.id)} className={`px-3 py-1.5 rounded text-sm ${piscine===p.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{p.n}</button>))}
                  </div>
                </div>
              </div>
              <div className="grid md:grid-cols-2 gap-4 mt-4">
                <div>
                  <label className="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" checked={forage} onChange={e=>setForage(e.target.checked)} className="w-4 h-4"/>
                    <span>Forage (~{zoneData.forage}m)</span>
                  </label>
                  {forage&&<InputNum value={forageProf} onChange={setForageProf} min={15} max={150} unit="m" label="Profondeur"/>}
                </div>
                <div>
                  <label className="text-sm text-gray-600">Parking</label>
                  <div className="flex gap-2 mt-2">
                    {[{id:'',n:'Non'},{id:'ext',n:'Ext.'},{id:'couvert',n:'Couvert'},{id:'souterrain',n:'Sous.'}].map(p=>(<button key={p.id} onClick={()=>setParkType(p.id)} className={`px-2 py-1 rounded text-xs ${parkType===p.id?'bg-blue-600 text-white':'bg-gray-100'}`}>{p.n}</button>))}
                  </div>
                  {parkType&&<InputNum value={parkPlaces} onChange={setParkPlaces} min={0} max={200} label="Places"/>}
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
                <h2 className="text-xl font-bold text-gray-800">Récapitulatif et estimation</h2>
                <p className="text-gray-500 text-sm">Besoins énergétiques • Propositions • Estimation</p>
              </div>
              <button onClick={()=>window.print()} className="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">🖨️ Imprimer</button>
            </div>

            {/* Synthèse */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">📋 Synthèse du projet</h3>
              <div className="grid md:grid-cols-4 gap-4">
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">Type</div><div className="font-semibold">{typeData?.name||typeBat}</div><div className="text-xs text-gray-500">{secteur==='residentiel'?STANDINGS[standing]?.name:''}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">Terrain</div><div className="font-semibold mono">{fmt(surface)} m²</div><div className="text-xs text-gray-500">{zoneData.name}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">Surface plancher</div><div className="font-semibold mono">{fmt(surfaceBatie)} m²</div><div className="text-xs text-gray-500">{niveaux===1?'Plain-pied':`R+${niveaux-1}`}{ssSol>0?` + ${ssSol} ss`:''}</div></div>
                <div className="p-3 bg-gray-50 rounded-lg"><div className="text-xs text-gray-500">Durée estimée</div><div className="font-semibold">{duree} mois</div></div>
              </div>
            </div>

            {/* BESOINS ÉNERGÉTIQUES */}
            <div className="card p-5 mb-6" style={{background:'linear-gradient(135deg, #f59e0b 0%, #ea580c 100%)'}}>
              <h3 className="font-bold text-white mb-4">⚡ Besoins énergétiques calculés</h3>
              <div className="text-4xl font-bold text-white mb-4 mono">{besoins.total} kW</div>
              <div className="grid grid-cols-2 md:grid-cols-4 gap-2">
                {besoins.details.map((d,i)=>(<div key={i} className="bg-white/20 rounded px-3 py-2 flex justify-between text-white"><span className="text-sm">{d.label}</span><span className="mono font-semibold">{d.kw.toFixed(1)}</span></div>))}
              </div>
            </div>

            {/* PROPOSITIONS SOLAIRES */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">☀️ Installation solaire (40-150% couverture)</h3>
              <div className="space-y-3">
                <button onClick={()=>setSolaire('')} className={`w-full p-3 rounded-lg border-2 text-left ${!solaire?'border-gray-600 bg-gray-100':'border-gray-200'}`}>
                  <span className="font-medium">❌ Pas d'installation solaire</span>
                </button>
                {propositionsSolaires.map(kit=>(
                  <button key={kit.id} onClick={()=>setSolaire(kit.id)} className={`w-full p-4 rounded-lg border-2 text-left transition-all ${solaire===kit.id?'border-yellow-500 bg-yellow-50':'border-gray-200 hover:border-gray-300'} ${kit.optimal?'optimal-ring':''}`}>
                    <div className="flex justify-between items-start">
                      <div className="flex-1">
                        <div className="font-bold text-lg">
                          {kit.kw} kWc
                          <span className={`ml-2 text-sm px-2 py-0.5 rounded ${kit.couv>=100?'bg-green-100 text-green-700':kit.couv>=70?'bg-amber-100 text-amber-700':'bg-red-100 text-red-600'}`}>{kit.couv}%</span>
                          {kit.optimal&&<span className="text-green-600 text-sm ml-2">✓ Optimal</span>}
                        </div>
                        <div className="text-sm text-green-700 mt-2"><strong>Couvre:</strong> {kit.couverts.slice(0,5).join(' • ')}{kit.couverts.length>5?'...':''}</div>
                        {kit.nonCouverts.length>0&&<div className="text-xs text-red-500 mt-1"><strong>Non couvert:</strong> {kit.nonCouverts.slice(0,3).join(' • ')}</div>}
                      </div>
                      <div className="font-bold text-lg" style={{color:'var(--bleu)'}}>{fmtM(kit.prix)} F</div>
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* PROPOSITIONS GROUPES */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">🔌 Groupe électrogène (40-150% couverture)</h3>
              <div className="space-y-3">
                <button onClick={()=>setGroupe('')} className={`w-full p-3 rounded-lg border-2 text-left ${!groupe?'border-gray-600 bg-gray-100':'border-gray-200'}`}>
                  <span className="font-medium">❌ Pas de groupe électrogène</span>
                </button>
                {propositionsGroupes.map(grp=>(
                  <button key={grp.id} onClick={()=>setGroupe(grp.id)} className={`w-full p-4 rounded-lg border-2 text-left transition-all ${groupe===grp.id?'border-orange-500 bg-orange-50':'border-gray-200 hover:border-gray-300'} ${grp.optimal?'optimal-ring':''}`}>
                    <div className="flex justify-between items-start">
                      <div className="flex-1">
                        <div className="font-bold text-lg">
                          {grp.kva} kVA
                          <span className={`ml-2 text-sm px-2 py-0.5 rounded ${grp.couv>=100?'bg-green-100 text-green-700':grp.couv>=70?'bg-amber-100 text-amber-700':'bg-red-100 text-red-600'}`}>{grp.couv}%</span>
                          {grp.optimal&&<span className="text-green-600 text-sm ml-2">✓ Optimal</span>}
                        </div>
                        <div className="text-sm text-green-700 mt-2"><strong>Couvre:</strong> {grp.couverts.slice(0,5).join(' • ')}{grp.couverts.length>5?'...':''}</div>
                        {grp.nonCouverts.length>0&&<div className="text-xs text-red-500 mt-1"><strong>Non couvert:</strong> {grp.nonCouverts.slice(0,3).join(' • ')}</div>}
                      </div>
                      <div className="font-bold text-lg" style={{color:'var(--bleu)'}}>{fmtM(grp.prix)} F</div>
                    </div>
                  </button>
                ))}
              </div>
            </div>

            {/* ESTIMATION FINANCIÈRE */}
            <div className="card p-5 mb-6">
              <h3 className="font-semibold text-gray-700 mb-4">💰 Estimation budgétaire</h3>
              <div className="overflow-x-auto">
                <table className="w-full text-sm">
                  <thead><tr className="border-b"><th className="text-left py-2 px-2">Code</th><th className="text-left py-2">Poste</th><th className="text-left py-2">Détail</th><th className="text-right py-2 px-2">Montant</th></tr></thead>
                  <tbody>
                    {estimation.postes.map((p,i)=>(<tr key={i} className="border-b border-gray-100"><td className="py-2 px-2 text-gray-400 mono">{p.code}</td><td className="py-2 font-medium">{p.nom}</td><td className="py-2 text-gray-500 text-xs">{p.detail}</td><td className="py-2 px-2 text-right mono font-semibold">{fmtM(p.montant)}</td></tr>))}
                  </tbody>
                </table>
              </div>
            </div>

            {/* TOTAL */}
            <div className="card p-6" style={{background:'linear-gradient(135deg, var(--bleu) 0%, #1e3a8a 100%)'}}>
              <div className="text-center">
                <div className="text-white/70 text-sm mb-2">Estimation totale projet</div>
                <div className="text-4xl md:text-5xl font-bold text-white mono mb-4">{fmtM(estimation.foncier+estimation.total)} FCFA</div>
                <div className="flex justify-center gap-8 text-white/80 text-sm">
                  <div><div className="text-xs">Fourchette basse (-10%)</div><div className="font-semibold mono">{fmtM(estimation.min)} F</div></div>
                  <div><div className="text-xs">Fourchette haute (+15%)</div><div className="font-semibold mono">{fmtM(estimation.max)} F</div></div>
                </div>
                <div className="mt-4 text-white/60 text-xs">Durée estimée: {duree} mois • Catégorie: {categorie.cat} • Géotechnique: {categorie.mission}</div>
              </div>
            </div>

            <div className="warn-box mt-6">
              <strong>⚠️ Avertissement</strong>
              <p className="text-sm mt-1">Cette estimation est indicative et basée sur les paramètres saisis. Une étude détaillée sera réalisée pour l'établissement du devis définitif. Les prix peuvent varier selon la conjoncture du marché.</p>
            </div>

            <Nav/>
          </div>
        )}

      </main>
      <footer className="text-center py-6 text-gray-400 text-xs no-print">
        © 2025 AIAE SARL • Afrika Infrastructure, Automation & Energy • Quartier Kléme Zanguéra, Lomé, Togo<br/>
        Simulateur v{VERSION} • Référentiel Décembre 2025
      </footer>
    </div>
  );
};

ReactDOM.createRoot(document.getElementById('root')).render(<App/>);
@endverbatim
</script>
</body>
</html>

