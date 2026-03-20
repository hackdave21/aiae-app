<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Simulateur AIAE v5 - Estimation Construction</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole AIAE FINAL.png') }}">
<style>
body{font-family:'Inter',sans-serif;background:#f8fafc;margin:0}
*{box-sizing:border-box}
.mono{font-family:'JetBrains Mono',monospace}
:root{--bleu:#162064;--vert:#05482C;--orange:#FF8400}
.card{background:white;border:1px solid #e2e8f0;border-radius:12px}
.btn-primary{background:var(--orange);color:white;padding:12px 24px;border-radius:8px;font-weight:600;cursor:pointer;border:none;display:inline-flex;align-items:center;gap:8px;text-decoration:none;transition:filter .2s}
.btn-primary:hover{filter:brightness(1.1)}
.btn-primary:disabled{background:#e5e7eb;color:#9ca3af;cursor:not-allowed;filter:none}
.btn-sec{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 24px;border-radius:8px;font-weight:600;border:2px solid var(--bleu);color:var(--bleu);cursor:pointer;background:white;text-decoration:none;transition:all .2s}
.btn-sec:hover{background:var(--bleu);color:white}
.opt-btn{padding:14px;border:2px solid #e2e8f0;border-radius:10px;text-align:left;cursor:pointer;background:white;transition:all .2s;width:100%;display:block}
.opt-btn:hover{border-color:#cbd5e1;box-shadow:0 4px 12px rgba(0,0,0,.08)}
.opt-btn.sel{border-color:#3b82f6;background:#eff6ff}
.badge{display:inline-flex;align-items:center;padding:3px 8px;border-radius:6px;font-size:11px;font-weight:600}
.badge-blue{background:#dbeafe;color:#1e40af}
.badge-green{background:#dcfce7;color:#166534}
.badge-orange{background:#ffedd5;color:#c2410c}
.badge-gray{background:#f3f4f6;color:#374151}
.warn-box{background:#fef3c7;border-left:4px solid #f59e0b;padding:12px 16px;border-radius:0 8px 8px 0}
.alert-box{background:#fee2e2;border-left:4px solid #ef4444;padding:12px 16px;border-radius:0 8px 8px 0}
.info-box{background:#eff6ff;border-left:4px solid #3b82f6;padding:12px 16px;border-radius:0 8px 8px 0}
.success-box{background:#ecfdf5;border-left:4px solid #10b981;padding:12px 16px;border-radius:0 8px 8px 0}
.num-ctrl{display:flex;align-items:center;border:1px solid #e2e8f0;border-radius:8px;overflow:hidden;background:white}
.num-ctrl button{width:38px;height:38px;border:none;background:#f8fafc;cursor:pointer;font-size:18px;flex-shrink:0}
.num-ctrl button:hover{background:#e2e8f0}
.num-ctrl .nv{flex:1;text-align:center;font-weight:600;font-family:'JetBrains Mono',monospace;padding:4px}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.65);z-index:1000;display:flex;align-items:center;justify-content:center;padding:16px}
.step-dot{width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;flex-shrink:0}
.chip{display:inline-flex;align-items:center;padding:6px 12px;border-radius:999px;font-size:12px;font-weight:600;cursor:pointer;border:none;transition:all .15s}
.tag-row{display:flex;flex-wrap:wrap;gap:8px}
header{background:white;border-bottom:1px solid #e2e8f0;position:sticky;top:0;z-index:100}
.opt-ring{box-shadow:0 0 0 3px rgba(34,197,94,.4)}
@media print{.no-print{display:none!important}body{background:white}}
</style>
</head>
<body>
<div id="app"></div>

<script>
// ---- BLADE CONTEXT ----
const CSRF=document.querySelector('meta[name="csrf-token"]').content;
const IS_AUTH={{ auth()->check() ? 'true' : 'false' }};
const SAVE_URL='{{ route("simulator.save") }}';
const LOGIN_URL='{{ route("login") }}';
const REGISTER_URL='{{ route("register") }}';
const PROFILE_URL='{{ route("profile") }}';

// ---- ZONES ----
const ZONES={
  zone1:{name:'Zone 1 – Grand Lomé',loc:'Lomé, Baguida, Agoè, Adidogomé',coef:1.00,forage:25,foncier:75000},
  zone2:{name:'Zone 2 – Maritime',loc:'Tsévié, Tabligbo, Aného',coef:1.08,forage:35,foncier:25000},
  zone3:{name:'Zone 3 – Plateaux',loc:'Atakpamé, Kpalimé, Badou',coef:1.14,forage:50,foncier:12000},
  zone4:{name:'Zone 4 – Centrale',loc:'Sokodé, Tchamba, Blitta',coef:1.19,forage:60,foncier:6000},
  zone5:{name:'Zone 5 – Kara & Savanes',loc:'Kara, Dapaong, Mango',coef:1.25,forage:75,foncier:4000}
};
// ---- SOLS ----
const SOLS={
  inconnu:{name:'Non déterminé',coef:1.15,portance:'?',fond:'À définir après étude',prixFond:55000,risque:'moyen'},
  ferralitique:{name:'Ferralitique (Terre de barre)',coef:1.00,portance:'1.5–2.5 bars',fond:'Semelles filantes',prixFond:32000,risque:'faible'},
  ferrugineux:{name:'Ferrugineux tropical',coef:1.10,portance:'1.0–2.0 bars',fond:'Semelles renforcées',prixFond:38000,risque:'faible'},
  laterite:{name:'Latérite / Cuirasse',coef:1.03,portance:'3.0–5.0 bars',fond:'Semelles réduites',prixFond:28000,risque:'faible'},
  argileux:{name:'Argileux ⚠️',coef:1.30,portance:'0.5–1.5 bars',fond:'Radier ou pieux',prixFond:75000,risque:'élevé'},
  sableux:{name:'Sableux',coef:1.18,portance:'1.0–2.0 bars',fond:'Semelles + compactage',prixFond:48000,risque:'moyen'},
  hydromorphe:{name:'Hydromorphe ⚠️⚠️',coef:1.55,portance:'0.3–1.0 bars',fond:'Pieux profonds',prixFond:120000,risque:'très élevé'},
  rocheux:{name:'Rocheux',coef:0.98,portance:'>5 bars',fond:'Ancrages roche',prixFond:25000,risque:'faible'}
};
// ---- STANDINGS (V5 prices) ----
const STANDINGS={
  standard:{name:'Standard',desc:'Économique et fonctionnel',icon:'🏠',pMin:180000,pMax:250000,emprise:.50,marge:.17,hon:.06},
  confort:{name:'Confort',desc:'Qualité-prix optimal',icon:'🏡',pMin:280000,pMax:380000,emprise:.35,marge:.20,hon:.05},
  premium:{name:'Premium',desc:'Excellence et personnalisation',icon:'🏘️',pMin:420000,pMax:550000,emprise:.30,marge:.23,hon:.04},
  prestige:{name:'Prestige',desc:'Luxe sans compromis',icon:'🏰',pMin:600000,pMax:900000,emprise:.25,marge:.27,hon:.03}
};
// ---- TYPES ----
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
    {id:'elevage_volailles',name:'Volailles',max:1,prix:45000,ratio:.1,icon:'🐔'},
    {id:'serres',name:'Serres',max:1,prix:65000,icon:'🌱'},
    {id:'stockage',name:'Silos',max:1,prix:150000,icon:'🌾'}
  ]
};
// ---- HOTELS ----
const HOTELS=[
  {id:'1s',name:'★',surfCh:16},{id:'2s',name:'★★',surfCh:18},{id:'3s',name:'★★★',surfCh:22},
  {id:'4s',name:'★★★★',surfCh:28},{id:'5s',name:'★★★★★',surfCh:35},{id:'palace',name:'Palace',surfCh:50}
];
const HOTELS_PRIX={'1s':430000,'2s':500000,'3s':625000,'4s':800000,'5s':1175000,'palace':2000000};
// ---- ENERGY ----
const SOLAIRES=[
  {id:'3',kw:3,min:3500000,max:5000000},{id:'5',kw:5,min:5500000,max:8000000},{id:'10',kw:10,min:11000000,max:15000000},
  {id:'15',kw:15,min:16000000,max:21000000},{id:'20',kw:20,min:21000000,max:27000000},{id:'30',kw:30,min:30000000,max:40000000},
  {id:'50',kw:50,min:48000000,max:63000000}
];
const GROUPES=[
  {id:'15',kva:15,min:2800000,max:3800000},{id:'30',kva:30,min:5000000,max:6500000},{id:'60',kva:60,min:9000000,max:12000000},
  {id:'100',kva:100,min:15000000,max:19000000},{id:'200',kva:200,min:27000000,max:33000000},{id:'500',kva:500,min:60000000,max:78000000}
];
// ---- V5 NEW OPTIONS ----
const DOMOTIQUE=[
  {id:'domo_basique',name:'Éclairage connecté',min:400000,max:700000},
  {id:'domo_partielle',name:'Domotique partielle',min:1200000,max:2000000},
  {id:'domo_complete',name:'Maison intelligente',min:3000000,max:5500000}
];
const PAYSAGER=[
  {id:'pay_basique',name:'Gazon + arbres (~200m²)',min:1500000,max:3000000},
  {id:'pay_soigne',name:'Jardin soigné (~300m²)',min:3000000,max:5500000},
  {id:'pay_prestige',name:'Design paysager (~500m²)',min:6000000,max:12000000}
];
const VOLETS=[
  {id:'vol_manuel',name:'PVC manuel',mM2:35000,xM2:50000},
  {id:'vol_motorise',name:'Alu motorisé',mM2:55000,xM2:80000},
  {id:'vol_centralise',name:'Alu centralisé',mM2:70000,xM2:100000},
  {id:'vol_connecte',name:'Alu connecté',mM2:85000,xM2:120000}
];
const CITERNES=[
  {id:'cit_5',name:'Citerne 5 000L',min:800000,max:1200000},
  {id:'cit_10',name:'Citerne 10 000L',min:1400000,max:2000000},
  {id:'cit_20',name:'Citerne 20 000L',min:2500000,max:3500000}
];
const PISCINES=[
  {id:'6x3',name:'Piscine béton 6×3m',min:6000000,max:9000000},
  {id:'8x4',name:'Piscine béton 8×4m',min:9500000,max:13000000},
  {id:'10x5',name:'Piscine béton 10×5m',min:14000000,max:19000000},
  {id:'12x5',name:'Piscine débordement 12×5m',min:22000000,max:30000000},
  {id:'plage',name:'Piscine plage 8×4m',min:16000000,max:22000000}
];
const CLOTURES=[
  {id:'prefab',name:'Préfabriqué H=2m',minM:50000,maxM:70000},
  {id:'agglos',name:'Agglos crépi H=2m',minM:65000,maxM:90000},
  {id:'mixte',name:'Mixte agglos+grille H=2m',minM:75000,maxM:100000},
  {id:'hg',name:'Haut de gamme H=2m',minM:110000,maxM:150000}
];
const PORTAILS=[
  {id:'portillon',name:'Portillon piéton 1m',min:130000,max:200000},
  {id:'simple',name:'Portail simple 3m',min:350000,max:500000},
  {id:'double',name:'Portail double 5m',min:600000,max:800000},
  {id:'motorise',name:'Coulissant motorisé 5m',min:1200000,max:1600000}
];
const ALARMES=[
  {id:'basique',name:'Alarme basique (4 détect.)',min:350000,max:500000},
  {id:'avancee',name:'Alarme avancée (GSM)',min:600000,max:850000},
  {id:'complete',name:'Alarme complète connectée',min:900000,max:1400000}
];
const VIDEO=[
  {id:'4cam',name:'Vidéosurveillance 4 cam HD',min:500000,max:850000},
  {id:'8cam',name:'Vidéosurveillance 8 cam HD',min:1000000,max:1500000},
  {id:'16cam',name:'Vidéosurveillance 16 cam HD',min:2000000,max:2800000}
];
const ACCES=[
  {id:'simple',name:'Contrôle accès simple',min:450000,max:650000},
  {id:'complet',name:'Contrôle accès complet',min:1800000,max:2500000}
];
const FORAGES=[
  {id:'30',prof:30,name:'30m (Lomé littoral)',min:2500000,max:3500000},
  {id:'60',prof:60,name:'60m (Plateaux sud)',min:4000000,max:5800000},
  {id:'90',prof:90,name:'90m (Centrale)',min:5500000,max:8000000},
  {id:'120',prof:120,name:'120m (Kara/Savanes)',min:7500000,max:11000000}
];
</script>
<script>
// ---- STATE ----
let S={
  simulation_id:null,
  etape:1,secteur:'{{ $secteur }}',typeBat:'',standing:'confort',catHotel:'3s',
  forme:'rect',dimA:30,dimB:20,surfManuelle:600,terrainDispo:'oui',
  zone:'zone1',sol:'',niveaux:1,ssSol:0,hspRdc:3.0,hspEtage:2.8,
  nbChambres:30,espacesHotel:[],hauteurLibre:8,pontRoulant:false,pontCap:5,
  groupeFroid:'',effectif:100,irrigation:'',surfExploit:5,
  nbAsc:0,nbQuais:2,solaire:'',groupe:'',
  alarme:'',nbZones:6,video:'',acces:'',nbPortes:2,
  cloture:'',portail:'',piscine:'',forage:'',forageProf:30,
  parkType:'',parkPlaces:0,
  domotique:'',paysager:'',volet:'',nbVoletM2:30,citerne:'',
  showAuthModal:false
};
// ---- HELPERS ----
const fmt=n=>new Intl.NumberFormat('fr-FR').format(Math.round(n||0));
const fmtM=n=>n>=1e9?(n/1e9).toFixed(2)+' Mrd':n>=1e6?(n/1e6).toFixed(1)+' M':fmt(n);
const td=()=>TYPES[S.secteur]?.find(t=>t.id===S.typeBat);
const zd=()=>ZONES[S.zone]||ZONES.zone1;
const sd=()=>SOLS[S.sol];
const st=()=>STANDINGS[S.standing]||STANDINGS.confort;
// ---- COMPUTED VALUES ----
function cSurf(){
  return S.forme==='carre'?S.dimA*S.dimA:S.forme==='rect'?S.dimA*S.dimB:S.surfManuelle;
}
function cPer(){
  return S.forme==='carre'?4*S.dimA:S.forme==='rect'?2*(S.dimA+S.dimB):Math.sqrt(S.surfManuelle)*4*1.1;
}
function cEmp(){
  if(S.secteur==='residentiel') return st().emprise||.35;
  return S.secteur==='industriel'?.65:S.secteur==='agricole'?.50:.40;
}
function cSB(){
  const t=td(),s=cSurf(),e=cEmp();
  if(S.secteur==='agricole'&&S.typeBat?.startsWith('elevage_')) return Math.round(S.effectif*(t?.ratio||5)*1.3);
  const es=s*e;
  return Math.round(es*S.niveaux+S.ssSol*es*.85);
}
function cHaut(){
  const h=S.hspRdc+.30+(S.niveaux>1?(S.niveaux-1)*(S.hspEtage+.25):0);
  return Math.round((h+(S.secteur==='industriel'?1.5:2.5))*10)/10;
}
function cPrixM2(){
  const t=td(), s=st();
  if(S.secteur==='residentiel') return ((s.pMin+s.pMax)/2)*(t?.maj||1);
  if(S.typeBat==='hotel') return HOTELS_PRIX[S.catHotel]||625000;
  if(S.secteur==='industriel'){
    let b=t?.prix||250000;
    if(S.hauteurLibre>10)b*=1.12;
    if(S.pontRoulant)b*=1.15;
    if(S.typeBat==='frigo')b*=1.25;
    return Math.round(b);
  }
  return t?.prix||450000;
}
function cCat(){
  const ht=cHaut(); let cat='A1',g=false,m=[];
  if(S.niveaux>4||ht>15){cat='B2';g=true;m.push('>R+4');}
  else if(S.niveaux>2||ht>8){cat='A2';g=true;m.push('R+3 ou >8m');}
  if(['hotel','commerce','clinique'].includes(S.typeBat)){g=true;m.push('ERP');}
  if(S.sol==='argileux'||S.sol==='hydromorphe'){g=true;m.push('Sol risque');}
  if(S.ssSol>0){g=true;m.push('Sous-sol');}
  return{cat,geoOblig:g,motifs:m,mission:g?(cat==='B2'?'G2 PRO':'G2 AVP'):'G1'};
}
// ---- ENERGY NEEDS ----
function cBesoins(){
  const sb=cSB(); const det=[];
  det.push({label:'💡 Éclairage',kw:Math.round(sb*(S.secteur==='industriel'?.008:S.secteur==='agricole'?.005:.012)*10)/10,prio:1});
  det.push({label:'🔌 Prises',kw:Math.round(sb*.015*10)/10,prio:2});
  const sc=sb*(S.secteur==='industriel'?.15:S.secteur==='agricole'?.10:.70);
  if(sc>0)det.push({label:'❄️ Climatisation',kw:Math.round(sc*.10*10)/10,prio:5});
  if(S.typeBat==='hotel'){
    det.push({label:'🚿 Eau chaude',kw:Math.round(S.nbChambres*.3*10)/10,prio:4});
    if(S.espacesHotel.includes('restaurant'))det.push({label:'🍳 Cuisine pro',kw:15,prio:6});
    if(S.espacesHotel.includes('spa'))det.push({label:'💆 Spa',kw:12,prio:7});
  }
  if(S.secteur==='residentiel')det.push({label:'🍳 Électroménager',kw:Math.round(sb*.008*10)/10,prio:6});
  if(S.nbAsc>0)det.push({label:'🛗 Ascenseurs',kw:Math.round(S.nbAsc*12*.15*10)/10,prio:9});
  if(S.pontRoulant)det.push({label:'🏗️ Pont roulant',kw:Math.round((S.pontCap<=5?15:S.pontCap<=10?25:40)*.2*10)/10,prio:10});
  if(S.alarme)det.push({label:'🚨 Alarme',kw:.5,prio:11});
  if(S.video)det.push({label:'📹 Vidéo',kw:S.video==='16+'?1.5:.8,prio:3});
  if(S.piscine)det.push({label:'🏊 Piscine',kw:S.piscine==='12x5'?5:3.5,prio:8});
  if(S.forage)det.push({label:'💧 Pompe forage',kw:S.secteur==='agricole'?5:2,prio:7});
  det.sort((a,b)=>a.prio-b.prio);
  return{details:det,total:Math.ceil(det.reduce((s,d)=>s+d.kw,0))};
}
// ---- SOLAR PROPOSITIONS ----
function cSolaires(){
  const{details,total}=cBesoins(); if(!total)return[];
  return SOLAIRES.map(k=>{
    const couv=Math.round((k.kw/total)*100);
    if(couv<40||couv>150)return null;
    let r=k.kw;const cov=[],nc=[];
    details.forEach(d=>{if(r>=d.kw){cov.push(d.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());r-=d.kw;}else nc.push(d.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());});
    return{...k,couv,couverts:cov,nonCouverts:nc,optimal:couv>=95&&couv<=115};
  }).filter(Boolean);
}
// ---- GENERATOR PROPOSITIONS ----
function cGroupes(){
  const{details,total}=cBesoins(); const bt=total*.8; if(!bt)return[];
  return GROUPES.map(g=>{
    const pu=g.kva*.8,couv=Math.round((pu/bt)*100);
    if(couv<40||couv>150)return null;
    let r=pu;const cov=[],nc=[];
    details.forEach(d=>{if(r>=d.kw){cov.push(d.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());r-=d.kw;}else nc.push(d.label.replace(/[^\w\sÀ-ÿ]/g,'').trim());});
    return{...g,couv,couverts:cov,nonCouverts:nc,optimal:couv>=95&&couv<=115};
  }).filter(Boolean);
}
// ---- 12-POST ESTIMATION (V5) ----
function cEstimation(){
  const surf=cSurf(),sb=cSB(),pos=[],z=zd(),s=sd(),e=cEmp(),p=st();
  if(!sb||!S.sol)return null;
  const coef=(z.coef||1)*((s?.coef)||1.15);
  let fMin=0,fMax=0;
  if(S.terrainDispo!=='oui'){fMin=fMax=surf*z.foncier;pos.push({code:'0',nom:'Acquisition foncière',detail:`${Math.round(surf)} m²`,min:fMin,max:fMax});}
  // P2 fondations
  const fb=surf*e*(s?.prixFond||45000);
  let p2m=fb,p2x=fb*1.1;
  if(S.secteur==='industriel'){p2m*=1.3;p2x*=1.3;}
  if(S.ssSol>0){p2m+=S.ssSol*surf*e*70000;p2x+=S.ssSol*surf*e*100000;}
  pos.push({code:'2',nom:'Fondations',detail:s?.fond||'À définir',min:p2m,max:p2x});
  // P3-P8 construction
  const cMin=sb*p.pMin*coef, cMax=sb*p.pMax*coef;
  pos.push({code:'3',nom:'Structure gros œuvre',detail:'Structure, maçonnerie, planchers',min:cMin*.42,max:cMax*.42});
  pos.push({code:'4',nom:'Charpente/Couverture',detail:'Toiture, zingueries',min:cMin*.12,max:cMax*.12});
  pos.push({code:'5',nom:'Menuiseries',detail:'Portes, fenêtres, vitrages',min:cMin*.10,max:cMax*.10});
  pos.push({code:'6',nom:'Revêtements/Finitions',detail:'Carrelages, peintures',min:cMin*.14,max:cMax*.14});
  pos.push({code:'7',nom:'Électricité',detail:'Installation électrique complète',min:cMin*.09,max:cMax*.09});
  pos.push({code:'8',nom:'Plomberie/Sanitaires',detail:'Plomberie, appareils sanitaires',min:cMin*.08,max:cMax*.08});
  // P9 extérieurs
  const per=cPer();
  let e9m=surf*7000,e9x=surf*9000;
  
  const cl=CLOTURES.find(c=>c.id===S.cloture); if(cl){e9m+=per*cl.minM;e9x+=per*cl.maxM;}
  const pt=PORTAILS.find(p=>p.id===S.portail); if(pt){e9m+=pt.min;e9x+=pt.max;}
  const ps=PISCINES.find(p=>p.id===S.piscine); if(ps){e9m+=ps.min;e9x+=ps.max;}
  const fr=FORAGES.find(f=>f.id===String(S.forage)); if(fr){e9m+=fr.min;e9x+=fr.max;}
  
  if(S.parkPlaces>0){const u=S.parkType==='souterrain'?3200000:S.parkType==='couvert'?1100000:350000;const v=S.parkType==='souterrain'?4400000:S.parkType==='couvert'?1600000:500000;e9m+=S.parkPlaces*u;e9x+=S.parkPlaces*v;}
  const py=PAYSAGER.find(x=>x.id===S.paysager);if(py){e9m+=py.min;e9x+=py.max;}
  pos.push({code:'9',nom:'Aménagements extérieurs',detail:'Clôture, portail, piscine, parking, forage',min:e9m,max:e9x});
  // P10 équipements techniques
  let q10m=0,q10x=0;
  if(S.nbAsc>0){const u=S.niveaux<=5?24000000:30000000;q10m+=S.nbAsc*u;q10x+=S.nbAsc*(u*1.3);}
  if(S.nbQuais>0&&S.secteur==='industriel'){q10m+=S.nbQuais*7000000;q10x+=S.nbQuais*10000000;}
  if(S.pontRoulant){const u=S.pontCap<=5?24000000:S.pontCap<=10?40000000:65000000;q10m+=u;q10x+=u*1.3;}
  if(S.groupeFroid){q10m+=sb*(S.groupeFroid==='negatif'?80000:47000);q10x+=sb*(S.groupeFroid==='negatif'?110000:63000);}
  
  const alm=ALARMES.find(a=>a.id===S.alarme); if(alm){q10m+=alm.min;q10x+=alm.max;}
  const vid=VIDEO.find(v=>v.id===S.video); if(vid){q10m+=vid.min;q10x+=vid.max;}
  const acc=ACCES.find(a=>a.id===S.acces); if(acc){q10m+=acc.min;q10x+=acc.max;}
  const ks=SOLAIRES.find(k=>k.id===S.solaire);const gr=GROUPES.find(g=>g.id===S.groupe);
  if(ks){q10m+=ks.min;q10x+=ks.max;}if(gr){q10m+=gr.min;q10x+=gr.max;}
  const dm=DOMOTIQUE.find(d=>d.id===S.domotique);if(dm){q10m+=dm.min;q10x+=dm.max;}
  const vl=VOLETS.find(v=>v.id===S.volet);if(vl&&S.nbVoletM2>0){q10m+=S.nbVoletM2*vl.mM2;q10x+=S.nbVoletM2*vl.xM2;}
  const ct=CITERNES.find(c=>c.id===S.citerne);if(ct){q10m+=ct.min;q10x+=ct.max;}
  if(q10m>0)pos.push({code:'10',nom:'Équipements techniques',detail:'Énergie, sécurité, domotique',min:q10m,max:q10x});
  // Sous-total
  const stm=pos.filter(x=>x.code!=='0').reduce((a,x)=>a+x.min,0);
  const stx=pos.filter(x=>x.code!=='0').reduce((a,x)=>a+x.max,0);
  // P11 honoraires
  const h11m=500000+stm*p.hon, h11x=500000+stx*p.hon;
  pos.push({code:'11',nom:'Honoraires/Études',detail:`Forfait 500K + ${Math.round(p.hon*100)}% sous-total`,min:h11m,max:h11x});
  // P12 assurances
  pos.push({code:'12',nom:'Assurances/Divers',detail:'2% du sous-total',min:(stm+h11m)*.02,max:(stx+h11x)*.02});
  const totMin=pos.reduce((a,x)=>a+x.min,0);
  const totMax=pos.reduce((a,x)=>a+x.max,0);
  const mg=p.marge||.20;
  let dur=6;
  if(S.secteur==='residentiel')dur=S.typeBat==='villa'?8:14+(S.niveaux-2)*1.5;
  else if(S.secteur==='tertiaire')dur=S.typeBat==='hotel'?18+(S.niveaux-3)*2:12+(S.niveaux-2)*1.5;
  else if(S.secteur==='industriel')dur=sb>3000?14:sb>1500?10:7;
  else if(S.secteur==='agricole')dur=5;
  if(S.ssSol>0)dur+=S.ssSol*2.5;
  if(S.sol==='argileux'||S.sol==='hydromorphe')dur+=2;
  dur=Math.round(Math.max(4,dur));
  return{postes:pos,totMin,totMax,clientMin:Math.round(totMin*(1+mg)),clientMax:Math.round(totMax*(1+mg)),marge:mg,duree:dur,fMin,fMax};
}
// ---- AUTO-SAVE ----
function autoSave(){
  const est=cEstimation(); if(!est)return;
  const payload={
    secteur:S.secteur,typeBat:S.typeBat,standing:S.standing,zone:S.zone,sol:S.sol,
    dimensions:{surface:cSurf(),niveaux:S.niveaux,ssSol:S.ssSol},
    options:{alarme:S.alarme,video:S.video,acces:S.acces,solaire:S.solaire,
      groupe:S.groupe,piscine:S.piscine,forage:S.forage,cloture:S.cloture,
      portail:S.portail,domotique:S.domotique,paysager:S.paysager,
      volet:S.volet,citerne:S.citerne,parkPlaces:S.parkPlaces},
    total:(est.clientMin+est.clientMax)/2,
    base_amount:(est.totMin+est.totMax)/2,
    options_amount:0,
    details:est.postes.map(p=>({nom:p.nom,detail:p.detail,min:p.min,max:p.max}))
  };
  localStorage.setItem('aiae_sim_draft',JSON.stringify({...payload,etape:S.etape,ts:Date.now()}));
  if(IS_AUTH){
    const body = {...payload};
    if(S.simulation_id) body.simulation_id = S.simulation_id;
    
    fetch(SAVE_URL,{
      method:'POST',
      headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
      body:JSON.stringify(body)
    })
    .then(r=>r.json())
    .then(res=>{
      if(res.simulation_id && S.simulation_id !== res.simulation_id){
        S.simulation_id = res.simulation_id;
        localStorage.setItem('aiae_sim_draft',JSON.stringify({...S,ts:Date.now()}));
      }
    })
    .catch(()=>{});
  }
}
// ---- RESTORE DRAFT ----
(function(){
  try{
    const d=JSON.parse(localStorage.getItem('aiae_sim_draft'));
    if(d&&Date.now()-d.ts<86400000){
      const keys=['secteur','typeBat','standing','zone','sol','niveaux','ssSol','alarme','video','acces','solaire','groupe','piscine','forage','cloture','portail','domotique','paysager','volet','citerne','parkPlaces'];
      keys.forEach(k=>{if(d[k]!==undefined)S[k]=d[k];});
      if(d.dimensions){S.niveaux=d.dimensions.niveaux||1;S.ssSol=d.dimensions.ssSol||0;}
      if(d.options)Object.assign(S,d.options);
    }
  }catch(e){}
})();
</script>
<script>
// ---- RENDERING ENGINE ----
function r(id,html){const el=document.getElementById(id);if(el)el.innerHTML=html;}

function render(){
  let h=`<div class="min-h-screen flex flex-col">`;
  h+=renderHeader();
  h+=`<main class="flex-1 max-w-5xl mx-auto w-full px-4 py-6">`;
  
  if(S.etape===1) h+=renderStep1();
  else if(S.etape===2) h+=renderStep2();
  else if(S.etape===3) h+=renderStep3();
  else if(S.etape===4) h+=renderStep4();
  else if(S.etape===5) h+=renderStep5();
  
  h+=`</main>`;
  h+=renderFooter();
  h+='</div>';
  if(S.showAuthModal) h+=renderAuthModal();
  
  document.getElementById('app').innerHTML=h;
  attachEvents();
}

function renderHeader(){
  return `
  <header class="no-print">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
      <div class="flex items-center gap-3 cursor-pointer" onclick="setS({etape:1})">
        <img src="{{ asset('aiae-frontend/Images/logos/Symbole AIAE FINAL Clr.png') }}" class="w-10 h-10 object-contain" alt="AIAE">
        <div class="hidden sm:block">
          <div class="font-bold text-sm" style="color:var(--bleu)">SIMULATEUR AIAE</div>
        </div>
      </div>
      <div class="flex items-center gap-6">
        <div class="hidden md:flex gap-1">
          ${[1,2,3,4,5].map(n=>`
            <div class="flex items-center">
              <div class="step-dot ${n<S.etape?'bg-green-500 text-white':n===S.etape?'bg-blue-600 text-white':'bg-gray-200 text-gray-400'}">
                ${n<S.etape?'✓':n}
              </div>
              ${n<5?`<div class="w-6 h-0.5 ${n<S.etape?'bg-green-500':'bg-gray-200'}"></div>`:''}
            </div>
          `).join('')}
        </div>
        <button onclick="window.location.reload()" class="text-xs font-bold text-gray-400 hover:text-red-500 uppercase tracking-wider flex items-center gap-1 transition-colors">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
          Effacer
        </button>
      </div>
    </div>
  </header>`;
}

function renderFooter(){
  return `<footer class="text-center py-6 text-gray-400 text-[10px] no-print uppercase tracking-widest leading-relaxed">
    © 2026 AIAE SARL • Afrika Infrastructure, Automation & Energy • Lomé, Togo<br>
    Spécifications techniques v5.1 • Février 2026
  </footer>`;
}

function renderNav(canContinue=true){
  return `
  <div class="flex justify-between items-center mt-12 pt-6 border-t no-print">
    <button onclick="prevStep()" class="font-bold text-gray-400 hover:text-gray-600 uppercase tracking-widest text-xs flex items-center gap-2">
      ← Précédent
    </button>
    <button id="btn-next" onclick="nextStep()" ${!canContinue?'disabled':''} class="btn-primary">
      ${S.etape===5?'Terminer':'Suivant'} →
    </button>
  </div>`;
}

// ---- STEP 1: TYPE ----
function renderStep1(){
  const types=TYPES[S.secteur]||[];
  let h=`<div class="animate-fade-in">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800">1. Type de projet</h2>
      <p class="text-gray-500 text-sm">Sélectionnez le secteur et le type de bâtiment</p>
    </div>
    <div class="card p-6 mb-8 shadow-sm ${S.secteur?'hidden':''}">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Secteur d'activité</h3>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
        ${Object.keys(TYPES).map(k=>`
          <button onclick="setS({secteur:'${k}',typeBat:''})" class="opt-btn ${S.secteur===k?'sel':''}">
            <div class="text-2xl mb-2">${k==='residentiel'?'🏠':k==='tertiaire'?'🏢':k==='industriel'?'🏭':'🌾'}</div>
            <div class="font-bold text-gray-800">${k.charAt(0).toUpperCase()+k.slice(1)}</div>
          </button>
        `).join('')}
      </div>
      ${S.secteur?`<div class="mt-2 text-[10px] text-blue-600 font-bold uppercase">Secteur selectionné : ${S.secteur}</div>`:''}
    </div>`;

  if(S.secteur){
    h+=`<div class="card p-6 mb-8 shadow-sm border-t-4 border-blue-600">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Modèle de construction</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        ${types.map(t=>`
          <button onclick="setS({typeBat:'${t.id}'})" class="opt-btn ${S.typeBat===t.id?'sel':''}">
             <div class="flex justify-between items-start">
               <div>
                  <div class="text-2xl mb-2">${t.icon}</div>
                  <div class="font-bold text-gray-800">${t.name}</div>
                  <div class="text-[10px] text-gray-400 mt-1 uppercase">Max R+${t.max-1}</div>
               </div>
               ${S.typeBat===t.id?'<div class="w-5 h-5 bg-blue-600 rounded-full flex items-center justify-center text-white text-[10px]">✓</div>':''}
             </div>
          </button>
        `).join('')}
      </div>
    </div>`;
  }

  if(S.secteur==='residentiel' && S.typeBat){
    h+=`<div class="card p-6 mb-8 shadow-sm">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Niveau de finition (Standing)</h3>
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        ${Object.entries(STANDINGS).map(([k,v])=>`
          <button onclick="setS({standing:'${k}'})" class="opt-btn ${S.standing===k?'sel':''}">
            <div class="text-xl mb-1">${v.icon}</div>
            <div class="font-bold text-sm text-gray-800">${v.name}</div>
            <div class="text-[10px] text-gray-500 leading-tight">${v.desc}</div>
          </button>
        `).join('')}
      </div>
    </div>`;
  }

  if(S.typeBat==='hotel'){
    h+=`<div class="card p-6 mb-8 shadow-sm">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Classification Hôtelière</h3>
      <div class="grid grid-cols-3 lg:grid-cols-6 gap-3">
        ${HOTELS.map(v=>`
          <button onclick="setS({catHotel:'${v.id}'})" class="opt-btn ${S.catHotel===v.id?'sel':''} text-center">
            <div class="font-bold text-blue-800">${v.name}</div>
            <div class="text-[10px] text-gray-400 mt-1">${v.surfCh}m²</div>
          </button>
        `).join('')}
      </div>
    </div>`;
  }

  h+=renderNav(!!S.typeBat);
  h+=`</div>`;
  return h;
}

// ---- STEP 2: TERRAIN ----
function renderStep2(){
  const s=cSurf(), p=cPer(), z=zd();
  return `
  <div class="animate-fade-in">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800">2. Le Terrain</h2>
      <p class="text-gray-500 text-sm">Dimensions, zone géographique et nature du sol</p>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-8 mb-8">
      <div class="card p-6">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Forme & Dimensions</h3>
        <div class="tag-row mb-6">
          ${['rect','carre','irregulier'].map(f=>`
            <button onclick="setS({forme:'${f}'})" class="chip ${S.forme===f?'bg-blue-600 text-white':'bg-gray-100 text-gray-500'}">
              ${f==='rect'?'Rectangle':f==='carre'?'Carré':'Libre'}
            </button>
          `).join('')}
        </div>
        
        <div class="grid grid-cols-2 gap-4 mb-6">
          ${S.forme!=='irregulier'?`
            <div>
              <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">${S.forme==='carre'?'Côté':'Longueur'} (m)</label>
              <div class="num-ctrl">
                <button onclick="setS({dimA:Math.max(5,S.dimA-1)})">-</button>
                <div class="nv">${S.dimA}</div>
                <button onclick="setS({dimA:S.dimA+1})">+</button>
              </div>
            </div>
            ${S.forme==='rect'?`
            <div>
              <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Largeur (m)</label>
              <div class="num-ctrl">
                <button onclick="setS({dimB:Math.max(5,S.dimB-1)})">-</button>
                <div class="nv">${S.dimB}</div>
                <button onclick="setS({dimB:S.dimB+1})">+</button>
              </div>
            </div>`:''}
          `:`
            <div class="col-span-2">
              <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Surface Totale (m²)</label>
              <div class="num-ctrl">
                <button onclick="setS({surfManuelle:Math.max(50,S.surfManuelle-50)})">-</button>
                <div class="nv">${S.surfManuelle}</div>
                <button onclick="setS({surfManuelle:S.surfManuelle+50})">+</button>
              </div>
            </div>
          `}
        </div>

        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
          <div><div class="text-[10px] text-gray-400 uppercase font-bold">Surface</div><div class="text-lg font-bold mono text-blue-900">${fmt(s)} m²</div></div>
          <div class="w-px bg-gray-200"></div>
          <div><div class="text-[10px] text-gray-400 uppercase font-bold">Périmètre</div><div class="text-lg font-bold mono text-blue-900">${fmt(p)} ml</div></div>
        </div>
      </div>

      <div class="card p-6">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Zone & Disponibilité</h3>
        <div class="grid grid-cols-2 gap-3 mb-6">
          ${['oui','non'].map(v=>`
            <button onclick="setS({terrainDispo:'${v}'})" class="opt-btn ${S.terrainDispo===v?'sel':''} py-3 text-center">
              <div class="font-bold text-sm">${v==='oui'?'Déjà acquis':'À acquérir'}</div>
            </button>
          `).join('')}
        </div>
        
        <label class="text-[10px] uppercase font-bold text-gray-400 block mb-2">Localisation au Togo</label>
        <div class="space-y-2 max-h-[160px] overflow-y-auto pr-2 custom-scroll">
          ${Object.entries(ZONES).map(([k,v])=>`
            <button onclick="setS({zone:'${k}'})" class="w-full flex items-center justify-between p-3 border rounded-xl hover:bg-gray-50 transition-colors ${S.zone===k?'border-blue-500 bg-blue-50 ring-1 ring-blue-500':''}">
              <div class="text-left">
                <div class="text-xs font-bold">${v.name}</div>
                <div class="text-[9px] text-gray-400">${v.loc}</div>
              </div>
              <div class="badge badge-blue">×${v.coef.toFixed(2)}</div>
            </button>
          `).join('')}
        </div>
      </div>
    </div>

    <div class="card p-6 mb-6">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Nature Géotechnique du Sol</h3>
      <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-3">
        ${Object.entries(SOLS).map(([k,v])=>`
           <button onclick="setS({sol:'${k}'})" class="opt-btn ${S.sol===k?'sel':''} ${v.risque==='élevé'||v.risque==='très élevé'?'border-red-200 bg-red-50':''}">
              <div class="font-bold text-xs truncate">${v.name}</div>
              <div class="text-[9px] text-gray-500 mt-1">${v.portance} • ${v.risque}</div>
              <div class="flex justify-between items-center mt-2">
                <span class="badge ${v.risque==='faible'?'badge-green':v.risque==='moyen'?'badge-blue':'badge-orange'}">×${v.coef.toFixed(2)}</span>
              </div>
           </button>
        `).join('')}
      </div>
      ${S.sol==='argileux'||S.sol==='hydromorphe'?`<div class="alert-box mt-4 text-[11px]">⚠️ <strong>Étude G2 obligatoire</strong> : Nature instable ou inondable.</div>`:''}
    </div>

    ${renderNav(!!S.sol)}
  </div>`;
}

// ---- STEP 3: CONFIG ----
function renderStep3(){
  const sb=cSB(), ht=cHaut(), cat=cCat();
  return `
  <div class="animate-fade-in">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800">3. Configuration du Bâtiment</h2>
      <p class="text-gray-500 text-sm">Définition des niveaux, hauteurs et spécificités</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-8">
      <div class="card p-6">
        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Niveaux & Volume</h3>
        <div class="grid grid-cols-2 gap-4 mb-6">
          <div>
            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Niveaux Hors-Sol</label>
            <div class="num-ctrl">
              <button onclick="setS({niveaux:Math.max(1,S.niveaux-1)})">-</button>
              <div class="nv">R+${S.niveaux-1}</div>
              <button onclick="setS({niveaux:Math.min(td()?.max||20,S.niveaux+1)})">+</button>
            </div>
          </div>
          <div>
            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Nombre de Sous-Sols</label>
            <div class="num-ctrl">
              <button onclick="setS({ssSol:Math.max(0,S.ssSol-1)})">-</button>
              <div class="nv">${S.ssSol}</div>
              <button onclick="setS({ssSol:Math.min(3,S.ssSol+1)})">+</button>
            </div>
          </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">HSP Rez-de-Chaussée (m)</label>
            <div class="num-ctrl">
              <button onclick="setS({hspRdc:Math.max(2.4,S.hspRdc-0.1)})">-</button>
              <div class="nv">${S.hspRdc.toFixed(1)}</div>
              <button onclick="setS({hspRdc:S.hspRdc+0.1})">+</button>
            </div>
          </div>
          <div>
            <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">HSP Étages (m)</label>
            <div class="num-ctrl">
              <button onclick="setS({hspEtage:Math.max(2.4,S.hspEtage-0.1)})">-</button>
              <div class="nv">${S.hspEtage.toFixed(1)}</div>
              <button onclick="setS({hspEtage:S.hspEtage+0.1})">+</button>
            </div>
          </div>
        </div>
      </div>

      <div class="card p-6 bg-blue-900 text-white relative overflow-hidden">
        <svg class="absolute -right-8 -bottom-8 w-40 h-40 opacity-10" fill="currentColor" viewBox="0 0 24 24"><path d="M19 13H5v-2h14v2z"/></svg>
        <h3 class="text-xs font-bold text-blue-300 uppercase tracking-widest mb-4">Métriques de l'Ouvrage</h3>
        <div class="space-y-4">
          <div class="flex justify-between items-end border-b border-blue-800 pb-2">
            <span class="text-blue-300 text-xs">Surface plancher totale</span>
            <span class="text-2xl font-bold mono">${fmt(sb)} <span class="text-xs">m²</span></span>
          </div>
          <div class="flex justify-between items-end border-b border-blue-800 pb-2">
            <span class="text-blue-300 text-xs">Hauteur totale estimée</span>
            <span class="text-2xl font-bold mono">${ht.toFixed(1)} <span class="text-xs">m</span></span>
          </div>
          <div class="pt-2">
            <div class="flex flex-wrap gap-2">
              <span class="badge ${cat.cat==='A1'?'bg-green-500':'bg-orange-600'} text-white">Cat. ${cat.cat}</span>
              <span class="badge bg-blue-700 text-white">${cat.mission}</span>
            </div>
             ${cat.motifs.length?`<div class="text-[9px] text-blue-200 mt-2 italic capitalize">${cat.motifs.join(' • ')}</div>`:''}
          </div>
        </div>
      </div>
    </div>

    ${S.secteur==='industriel'?`
    <div class="card p-6 mb-8 border-l-4 border-orange-500">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 italic">Spécificités Industrielles</h3>
      <div class="grid md:grid-cols-3 gap-6">
        <div>
          <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Hauteur Libre Utile (m)</label>
          <div class="num-ctrl">
            <button onclick="setS({hauteurLibre:Math.max(4,S.hauteurLibre-1)})">-</button>
            <div class="nv">${S.hauteurLibre}m</div>
            <button onclick="setS({hauteurLibre:S.hauteurLibre+1})">+</button>
          </div>
        </div>
        <div>
          <label class="text-[10px] uppercase font-bold text-gray-400 block mb-1">Nombre de Quais</label>
          <div class="num-ctrl">
            <button onclick="setS({nbQuais:Math.max(0,S.nbQuais-1)})">-</button>
            <div class="nv">${S.nbQuais}</div>
            <button onclick="setS({nbQuais:S.nbQuais+1})">+</button>
          </div>
        </div>
        <div class="flex items-center gap-3">
          <input type="checkbox" id="chk-pont" ${S.pontRoulant?'checked':''} onchange="setS({pontRoulant:this.checked})">
          <label for="chk-pont" class="text-sm font-bold text-gray-700">Pont Roulant</label>
          ${S.pontRoulant?`<div class="num-ctrl scale-90">
             <button onclick="setS({pontCap:Math.max(1,S.pontCap-1)})">-</button>
             <div class="nv">${S.pontCap}T</div>
             <button onclick="setS({pontCap:S.pontCap+1})">+</button>
          </div>`:''}
        </div>
      </div>
    </div>`:''}

    ${renderNav()}
  </div>`;
}

// ---- STEP 4: OPTIONS ----
function renderStep4(){
  return `
  <div class="animate-fade-in">
    <div class="mb-8">
      <h2 class="text-2xl font-bold text-gray-800">4. Équipements & Clé en Main</h2>
      <p class="text-gray-500 text-sm">Sécurité, énergie et options de confort moderne</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-8">
       <!-- Securité -->
       <div class="card p-6">
         <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            Sécurité Électronique
         </h3>
         <div class="space-y-4">
           <div>
             <label class="text-[10px] font-bold text-gray-500 uppercase block mb-2">Alarme Anti-Intrusion</label>
             <div class="tag-row">
               ${['','basique','avancee','connectee','pro'].map(v=>`
                 <button onclick="setS({alarme:'${v}',nbZones:6})" class="chip ${S.alarme===v?'bg-blue-600 text-white':'bg-gray-100 text-gray-500'}">
                   ${v===''?'Aucun':v.charAt(0).toUpperCase()+v.slice(1)}
                 </button>
               `).join('')}
             </div>
             ${S.alarme?`
               <div class="mt-3 flex items-center gap-3">
                  <span class="text-xs text-gray-400 italic">Zones :</span>
                  <div class="num-ctrl scale-75 origin-left">
                    <button onclick="setS({nbZones:Math.max(2,S.nbZones-2)})">-</button>
                    <div class="nv">${S.nbZones}</div>
                    <button onclick="setS({nbZones:S.nbZones+2})">+</button>
                  </div>
               </div>`:''}
           </div>
           
           <div>
             <label class="text-[10px] font-bold text-gray-500 uppercase block mb-2">Vidéosurveillance (IP 4K)</label>
             <div class="tag-row">
               ${['','4-8','16+'].map(v=>`
                 <button onclick="setS({video:'${v}'})" class="chip ${S.video===v?'bg-blue-600 text-white':'bg-gray-100 text-gray-500'}">${v===''?'Aucun':v+' Caméras'}</button>
               `).join('')}
             </div>
           </div>
         </div>
       </div>

       <!-- Nouvelles options V5 -->
       <div class="card p-6 bg-gray-50 border-dashed border-2">
         <h3 class="text-xs font-bold text-orange-600 uppercase tracking-widest mb-4 flex items-center gap-2">
            ✨ Nouveautés V5.0
         </h3>
         <div class="space-y-6">
           <div>
             <label class="text-[10px] font-bold text-gray-400 uppercase block mb-2">Domotique Intelligent</label>
             <div class="grid grid-cols-1 gap-2">
                <button onclick="setS({domotique:''})" class="w-full text-left p-2 border rounded-lg text-xs ${S.domotique===''?'bg-white border-blue-500 font-bold':'bg-gray-50'}">Non inclus</button>
                ${DOMOTIQUE.map(o=>`
                  <button onclick="setS({domotique:'${o.id}'})" class="w-full text-left p-2 border rounded-lg text-xs ${S.domotique===o.id?'bg-white border-blue-500 font-bold':'bg-white/50 hover:bg-white'} transition-all flex justify-between">
                    <span>${o.name}</span>
                    <span class="text-gray-400 font-medium">${fmtM(o.min)} — ${fmtM(o.max)}</span>
                  </button>
                `).join('')}
             </div>
           </div>
           
           <div class="flex items-center gap-4">
              <input type="checkbox" id="chk-forage" ${S.forage?'checked':''} onchange="setS({forage:this.checked})">
              <label for="chk-forage" class="text-sm font-bold text-gray-700">Forage & Automatisme</label>
              ${S.forage?`<div class="num-ctrl scale-75 origin-left"><button onclick="setS({forageProf:Math.max(20,S.forageProf-5)})">-</button><div class="nv">${S.forageProf}m</div><button onclick="setS({forageProf:S.forageProf+5})">+</button></div>`:''}
           </div>
         </div>
       </div>
    </div>

    <div class="card p-6 mb-8">
      <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Aménagements de Standing</h3>
      <div class="grid md:grid-cols-2 gap-8">
         <div class="space-y-4">
            <div>
               <label class="text-[10px] font-bold text-gray-500 uppercase block mb-2">Aménagement Paysager</label>
               <div class="grid grid-cols-1 gap-2">
                  <button onclick="setS({paysager:''})" class="chip-plain text-[11px] p-2 border rounded-lg text-left ${S.paysager===''?'bg-blue-50 border-blue-300 font-bold':'bg-white'}">Inclus dans VRD standard</button>
                  ${PAYSAGER.map(o=>`
                    <button onclick="setS({paysager:'${o.id}'})" class="p-2 border rounded-lg text-left text-[11px] ${S.paysager===o.id?'bg-blue-50 border-blue-300 font-bold':'bg-white hover:bg-gray-50'}">
                        ${o.name} (+${fmtM(o.min)})
                    </button>
                  `).join('')}
               </div>
            </div>
         </div>
         <div class="space-y-4">
             <div>
                <label class="text-[10px] font-bold text-gray-500 uppercase block mb-2">Volets Roulants</label>
                <div class="grid grid-cols-2 gap-2">
                   ${VOLETS.map(o=>`
                     <button onclick="setS({volet:S.volet===o.id?'':o.id})" class="p-2 border rounded-lg text-left text-[11px] ${S.volet===o.id?'bg-blue-50 border-blue-300 font-bold':'bg-white'}">
                        ${o.name}
                     </button>
                   `).join('')}
                </div>
                ${S.volet?`<div class="mt-2 flex items-center justify-between"><span class="text-[10px] text-gray-400">Total m² :</span> <div class="num-ctrl scale-75"><button onclick="setS({nbVoletM2:Math.max(2,S.nbVoletM2-2)})">-</button><div class="nv">${S.nbVoletM2}m²</div><button onclick="setS({nbVoletM2:S.nbVoletM2+2})">+</button></div></div>`:''}
             </div>
         </div>
      </div>
    </div>

    ${renderNav()}
  </div>`;
}
</script>
<script>
// ---- STEP 5: RESULTS ----
function renderStep5(){
  const est=cEstimation(); if(!est)return '';
  const bes=cBesoins(), sol=cSolaires(), grp=cGroupes(), t=td();
  
  return `
  <div class="animate-fade-in pb-12">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
      <div>
        <h2 class="text-3xl font-bold text-gray-800">5. Synthèse & Estimation</h2>
        <p class="text-gray-500 text-sm">Récapitulatif technique et proposition commerciale</p>
      </div>
      <button onclick="window.print()" class="btn-sec text-sm py-2">🖨️ Imprimer la fiche</button>
    </div>

    <!-- Summary -->
    <div class="card p-6 mb-8 bg-[#162064] text-white">
       <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
          <div><div class="text-[10px] text-blue-300 uppercase font-bold mb-1">Type de construction</div><div class="font-bold">${t?.name||S.typeBat}</div><div class="text-[10px] text-blue-200">Standing ${st().name}</div></div>
          <div><div class="text-[10px] text-blue-300 uppercase font-bold mb-1">Terrain</div><div class="font-bold mono">${fmt(cSurf())} m²</div><div class="text-[10px] text-blue-200">${zd().name}</div></div>
          <div><div class="text-[10px] text-blue-300 uppercase font-bold mb-1">Surface Plancher</div><div class="font-bold mono">${fmt(cSB())} m²</div><div class="text-[10px] text-blue-200">R+${S.niveaux-1} (${cHaut()}m)</div></div>
          <div><div class="text-[10px] text-blue-300 uppercase font-bold mb-1">Durée Chantier</div><div class="font-bold text-orange-400">${est.duree} mois</div><div class="text-[10px] text-blue-200">Estimation moyenne</div></div>
       </div>
    </div>

    <!-- Energy Section -->
    <div class="grid lg:grid-cols-2 gap-8 mb-8">
       <!-- Needs -->
       <div class="card p-6 border-t-8 border-orange-500">
         <h3 class="font-bold text-gray-800 mb-6 flex justify-between">
           <span>⚡ Besoins Énergétiques</span>
           <span class="mono text-orange-600">${bes.total} kW</span>
         </h3>
         <div class="grid grid-cols-2 gap-2">
            ${bes.details.map(d=>`<div class="bg-gray-50 p-2 rounded flex justify-between text-[11px]"><span class="text-gray-500">${d.label}</span><span class="font-bold">${d.kw.toFixed(1)}</span></div>`).join('')}
         </div>
       </div>

       <!-- Options Energy -->
       <div class="space-y-4">
          <div class="card p-5">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Solution Solaire (40-150%)</h3>
            <select onchange="setS({solaire:this.value})" class="w-full p-3 bg-gray-50 border rounded-xl text-sm font-bold focus:ring-2 ring-blue-500 outline-none">
               <option value="">🚫 Aucune installation</option>
               ${sol.map(k=>`<option value="${k.id}" ${S.solaire===k.id?'selected':''}>${k.kw} kWc • ${k.couv}% de couverture • ${fmtM(k.prix)} F</option>`).join('')}
            </select>
          </div>
          <div class="card p-5">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Secours Groupe Électrogène</h3>
            <select onchange="setS({groupe:this.value})" class="w-full p-3 bg-gray-50 border rounded-xl text-sm font-bold focus:ring-2 ring-orange-500 outline-none">
               <option value="">🚫 Pas de groupe</option>
               ${grp.map(g=>`<option value="${g.id}" ${S.groupe===g.id?'selected':''}>${g.kva} kVA • ${g.couv}% de couverture • ${fmtM(g.prix)} F</option>`).join('')}
            </select>
          </div>
       </div>
    </div>

    <!-- Financial Table -->
    <div class="card overflow-hidden mb-8">
       <table class="w-full text-left">
          <thead class="bg-gray-50 border-b">
             <tr>
                <th class="p-4 text-[10px] uppercase font-bold text-gray-400">Poste Budgétaire</th>
                <th class="p-4 text-[10px] uppercase font-bold text-gray-400">Description</th>
                <th class="p-4 text-[10px] uppercase font-bold text-gray-400 text-right">Fourchette Estimative (FCFA)</th>
             </tr>
          </thead>
          <tbody class="divide-y text-sm">
             ${est.postes.map(p=>`
               <tr class="${p.code==='0'?'bg-blue-50/30':''}">
                  <td class="p-4 font-bold text-gray-700">${p.nom}</td>
                  <td class="p-4 text-xs text-gray-500 italic">${p.detail}</td>
                  <td class="p-4 text-right mono font-semibold">
                    <span class="text-gray-400">${fmtM(p.min)}</span>
                    <span class="mx-2 text-gray-300">—</span>
                    <span class="text-blue-900">${fmtM(p.max)}</span>
                  </td>
               </tr>
             `).join('')}
          </tbody>
          <tfoot class="bg-blue-900 text-white font-bold">
             <tr>
                <td class="p-4" colspan="2">TOTAL HTVA + FRAIS GÉNÉRAUX</td>
                <td class="p-4 text-right mono text-xl">${fmtM(est.totMin)} — ${fmtM(est.totMax)} F</td>
             </tr>
          </tfoot>
       </table>
    </div>

    <!-- Final Price -->
    <div class="card p-8 bg-gradient-to-br from-blue-950 to-blue-800 text-white text-center shadow-2xl border-none">
       <div class="text-blue-200 text-sm uppercase tracking-widest font-bold mb-4">Estimation Totale Projet Client TTC</div>
       <div class="text-5xl md:text-6xl font-black mono text-orange-400 mb-6 drop-shadow-lg">
          ${fmtM(est.clientMin)} <span class="text-xl mx-2 text-white/30">—</span> ${fmtM(est.clientMax)} <span class="text-xl">F</span>
       </div>
       <div class="grid grid-cols-1 md:grid-cols-3 gap-4 max-w-3xl mx-auto pt-6 border-t border-white/10">
          <div class="bg-white/5 rounded-xl p-3"><div class="text-[9px] uppercase opacity-60">Marge AIAE</div><div class="font-bold text-blue-200">${Math.round(est.marge*100)}% incluse</div></div>
          <div class="bg-white/5 rounded-xl p-3"><div class="text-[9px] uppercase opacity-60">Estimation au m²</div><div class="font-bold text-blue-200">${fmt(Math.round(((est.clientMin+est.clientMax)/2)/cSB()))} F/m²</div></div>
          <div class="bg-white/5 rounded-xl p-3"><div class="text-[9px] uppercase opacity-60">Catégorie Projet</div><div class="font-bold text-blue-200">${cCat().cat} • ${cCat().mission}</div></div>
       </div>
    </div>

    <div class="warn-box mt-8 text-[11px]">
      <strong>⚠️ AVERTISSEMENT :</strong> Cette simulation est purement indicative. Elle ne peut être utilisée comme document contractuel. AIAE SARL décline toute responsabilité en cas de variation des coûts réels lors de l'exécution du projet. Un devis définitif nécessite une étude technique approfondie par nos ingénieurs.
    </div>

    ${renderNav()}
  </div>`;
}

// ---- AUTH MODAL ----
function renderAuthModal(){
  return `
  <div class="modal-overlay animate-fade-in no-print">
    <div class="card max-w-md w-full p-8 shadow-2xl relative">
      <button onclick="setS({showAuthModal:false})" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✕</button>
      <div class="text-center mb-6">
        <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800">Sauvegardez votre projet</h3>
        <p class="text-gray-500 text-sm mt-2">Créez un compte gratuitement pour conserver vos simulations, télécharger le PDF détaillé et demander un devis ferme.</p>
      </div>
      
      <div class="space-y-3">
        <a href="${REGISTER_URL}" class="btn-primary w-full justify-center py-4 rounded-xl text-center">Créer mon compte Gratuitement</a>
        <a href="${LOGIN_URL}" class="btn-sec w-full justify-center py-4 rounded-xl text-center">Me connecter</a>
      </div>
      
      <div class="mt-6 pt-6 border-t text-center text-xs text-gray-400 italic">
        AFRIKA INFRASTRUCTURE, AUTOMATION & ENERGY
      </div>
    </div>
  </div>`;
}
</script>
<script>
// ---- STATE CONTROL ----
function applyMapping(){
  const s=S.standing;
  const updates={};
  if(s==='standard'){
    updates.solaire='3'; updates.cloture='agglos'; updates.portail='simple'; updates.citerne='cit_5';
    updates.alarme=''; updates.video=''; updates.piscine=''; updates.domotique=''; updates.volet='';
  } else if(s==='confort'){
    updates.solaire='5'; updates.cloture='agglos'; updates.portail='double'; updates.alarme='basique'; updates.video='4cam';
  } else if(s==='premium'){
    updates.solaire='10'; updates.cloture='mixte'; updates.portail='motorise'; updates.alarme='avancee'; updates.piscine='8x4'; updates.citerne='cit_10'; updates.volet='vol_motorise';
  } else if(s==='prestige'){
    updates.solaire='15'; updates.cloture='hg'; updates.portail='motorise'; updates.alarme='complete'; updates.video='8cam'; updates.piscine='10x5'; updates.citerne='cit_20'; updates.volet='vol_connecte'; updates.domotique='domo_complete';
  }
  Object.assign(S,updates);
}

function setS(obj){
  const sChanged = obj.standing && obj.standing !== S.standing;
  const sectChanged = obj.secteur && obj.secteur !== S.secteur;
  
  Object.assign(S,obj);
  
  if(sChanged || sectChanged) applyMapping();
  
  autoSave();
  render();
}

function nextStep(){
  if(S.etape===4 && !IS_AUTH){
    setS({showAuthModal:true});
    return;
  }
  if(S.etape<5) setS({etape:S.etape+1});
  else {
    // Final step action
    if(IS_AUTH) window.location.href=PROFILE_URL;
    else setS({showAuthModal:true});
  }
}

function prevStep(){
  if(S.etape>1) setS({etape:S.etape-1});
  else window.location.href='/';
}

function attachEvents(){
  // Event listeners for window/custom components if needed
  window.scrollTo({top:0,behavior:'smooth'});
}

// ---- START ----
document.addEventListener('DOMContentLoaded',()=>{
  render();
});
</script>

</body>
</html>
