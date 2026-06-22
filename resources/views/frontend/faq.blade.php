<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ __('Foire Aux Questions - AIAE') }}</title>
  @include('frontend.partials.head-seo')
  @include('frontend.partials.schema-org')
  <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL.png') }}">
  <link rel="stylesheet" href="{{ asset('aiae-frontend/css/responsive.css') }}">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tailwind config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            futura: ["Futura", "sans-serif"],
            futuraCondensed: ["Futura Condensed", "sans-serif"],
          },
          colors: {
            primary: "#05482C",
            secondary: "#CC6A00",
            glass: "rgba(255,255,255,0.55)",
            glassDark: "rgba(255,255,255,0.35)",
          },
        },
      },
    };
  </script>

  <!-- ================= FONTS ================= -->
  <style>
    @font-face {
      font-family: "Futura";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdLight.otf') }}");
      font-weight: 300;
    }

    @font-face {
      font-family: "Futura";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdMedium.otf') }}");
      font-weight: 500;
    }

    @font-face {
      font-family: "Futura";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdBold.otf') }}");
      font-weight: 700;
    }

    @font-face {
      font-family: "Futura";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdHeavy.otf') }}");
      font-weight: 900;
    }

    /* Condensed */
    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensed.otf') }}");
      font-weight: 500;
    }

    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensedBold.otf') }}");
      font-weight: 700;
    }

    @media (max-width: 640px) {

      body,
      html {
        overflow-x: hidden !important;
      }

      section,
      div,
      img {
        max-width: 100% !important;
      }
    }

    .nav-scrolled {
      backdrop-filter: blur(18px);
      background: rgba(22, 32, 100, 0.2);
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInLeft {
      from {
        opacity: 0;
        transform: translateX(-40px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(40px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @keyframes scaleIn {
      from {
        opacity: 0;
        transform: scale(0.9);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }

    .animate-fade-up {
      animation: fadeInUp 0.8s ease-out forwards;
    }

    .animate-fade-left {
      animation: fadeInLeft 0.8s ease-out forwards;
    }

    .animate-fade-right {
      animation: fadeInRight 0.8s ease-out forwards;
    }

    .animate-scale {
      animation: scaleIn 0.6s ease-out forwards;
    }

    .animate-float {
      animation: float 4s ease-in-out infinite;
    }

    .delay-100 {
      animation-delay: 0.1s;
    }

    .delay-200 {
      animation-delay: 0.2s;
    }

    .delay-300 {
      animation-delay: 0.3s;
    }

    .delay-400 {
      animation-delay: 0.4s;
    }

    .delay-500 {
      animation-delay: 0.5s;
    }

    .delay-600 {
      animation-delay: 0.6s;
    }

    .delay-700 {
      animation-delay: 0.7s;
    }

    .delay-800 {
      animation-delay: 0.8s;
    }

    .opacity-0-init {
      opacity: 0;
    }

    /* Hover effects */
    .hover-lift {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .hover-scale {
      transition: transform 0.3s ease;
    }

    .hover-scale:hover {
      transform: scale(1.05);
    }

    /* Background pattern */
    .pattern-bg {
      background-image: radial-gradient(circle at 20% 80%, rgba(11, 91, 58, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(26, 31, 77, 0.05) 0%, transparent 50%);
    }

    strong {
      font-weight: 600;
      color: #1d1d1b;
    }

    /* Divider */
    .divider-green {
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #05482C, #05482C);
    }

    .divider-orange {
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, #CC6A00, #f59e0b);
    }

    /* Animation du panneau */
    #details-panel {
      animation: slideDown 0.4s ease-out;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Carte active */
    .standing-card.active {
      opacity: 1 !important;
      transform: scale(1.02);
      box-shadow: 0 10px 30px rgba(17, 29, 74, 0.2);
    }

    /* Rotation icône */
    #details-icon.rotate {
      transform: rotate(180deg);
    }

    /* Bouton actif */
    .standing-btn.active {
      background: #0E1540 !important;
      color: white !important;
      border-color: #0E1540 !important;
    }
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @include('frontend.partials.navbar')

  <!-- ================= SECTION TITRE HERO ================= -->
  <section class="bg-[#161c42] pt-40 pb-10 w-full text-center">
    <h1 class="text-white text-[45px] md:text-[65px] font-heavy tracking-wide uppercase">
      {{ __('Construction & Prix') }}
    </h1>
  </section>

  <!-- ================= SECTION FAQ ACCORDIONS ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details open class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Combien coûte la construction d\'une maison au Togo ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p class="mb-6">{{ __('Le coût de construction dépend principalement de la surface, du type de projet et du standing choisi.') }}</p>
          <ul class="list-disc pl-5 space-y-2 mb-6">
            <li><strong class="font-heavy text-[#343434]">{{ __('Standard :') }}</strong> {{ __('Fonctionnel et solide, idéal pour les budgets maîtrisés.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Confort :') }}</strong> {{ __('Matériaux de qualité supérieure, notre cœur de gamme.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Premium :') }}</strong> {{ __('Finitions haut de gamme et équipements modernes.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Prestige :') }}</strong> {{ __('Sur-mesure total avec des matériaux nobles et exceptionnels.') }}</li>
          </ul>
          <p class="text-[18px] italic text-gray-500 mb-6 font-book">{{ __('* Le prix final de la construction varie également selon les coefficients géographiques (zone), géotechniques (type de sol) et les frais d\'études.') }}</p>
          <p><strong class="font-heavy text-[#343434]">{{ __('Pour obtenir une estimation précise') }}</strong>{{ __(', nous vous invitons à utiliser notre simulateur en ligne gratuit. Il calculera automatiquement le budget de votre bâtiment (gros œuvre et finitions) ainsi que de vos équipements optionnels (solaire, forage, piscine, etc.).') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Quels sont les délais de construction ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p class="mb-4">{{ __('Les délais dépendent de la surface et du standing :') }}</p>
          <ul class="list-disc pl-5 space-y-1 mb-4">
            <li><strong class="font-heavy text-[#343434]">{{ __('Villa Standard 100-150 m² :') }}</strong> {{ __('8-12 mois.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Villa Confort/Premium 200-400 m² :') }}</strong> {{ __('12-18 mois.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Villa Prestige 400 m²+ :') }}</strong> {{ __('16-22 mois.') }}</li>
          </ul>
          <p>{{ __('Les délais sont contractuels et inscrits au contrat.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Intervenez-vous en dehors de Lomé ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Oui. Nous intervenons sur tout le territoire togolais : Grand Lomé, Maritime, Plateaux, Centrale, Kara et Savanes. Un coefficient géographique est appliqué pour refléter les coûts logistiques spécifiques à chaque zone.') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Quelle est la différence entre les standings ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p class="mb-4">{{ __('Chaque standing correspond à un niveau de finition et de confort :') }}</p>
          <ul class="space-y-3">
            <li><strong class="font-heavy text-[#343434]">{{ __('Standard :') }}</strong> {{ __('fonctionnel et solide. Carrelage local, menuiseries alu standard, peinture vinylique. Idéal pour primo-accédants.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Confort :') }}</strong> {{ __('qualité supérieure. Carrelage grès cérame, menuiseries alu renforcées, peinture acrylique, meilleure isolation. Notre cœur de gamme.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Premium :') }}</strong> {{ __('haut de gamme. Faïence importée, baies vitrées, domotique partielle, hauteur sous plafond 3m. Pour les exigeants.') }}</li>
            <li><strong class="font-heavy text-[#343434]">{{ __('Prestige :') }}</strong> {{ __('sur-mesure, matériaux nobles. Architecture personnalisée, domotique complète, finitions exceptionnelles. Chaque projet est unique.') }}</li>
          </ul>
        </div>
      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              05
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Proposez-vous des facilités de paiement ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Oui. Le paiement se fait par étapes, au fur et à mesure de l\'avancement des travaux. L\'échéancier est défini ensemble avant le démarrage. Vous ne payez que sur constat d\'avancement, validé par des preuves visuelles (photos/vidéos). Jamais d\'intégralité en avance.') }}</p>
        </div>
      </details>

      <!-- QUESTION 06 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              06
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Quelles garanties offrez-vous ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Garantie décennale (10 ans) sur la structure portante, garantie de parfait achèvement (1 an) sur l\'ensemble des travaux, assurance responsabilité civile professionnelle. Tous nos engagements sont formalisés dans le contrat.') }}</p>
        </div>
      </details>

      <!-- QUESTION 07 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              07
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Le terrain est-il inclus dans le prix ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Non. Nos prix au mètre carré concernent la construction uniquement (hors terrain). Le coût du terrain dépend de la localité et n\'est pas estimé par le simulateur. Contactez-nous pour un accompagnement dans votre recherche foncière.') }}</p>
        </div>
      </details>

      <!-- QUESTION 08 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              08
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Construisez-vous aussi des bâtiments commerciaux ou industriels ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Oui. AIAE intervient dans 4 secteurs : résidentiel (villas, immeubles), tertiaire (bureaux, commerces, hôtels), industriel (entrepôts, ateliers, usines) et agricole (fermes avicoles, exploitations intégrées). Chaque secteur dispose de ses propres grilles tarifaires.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION TITRE DIASPORA ================= -->
  <section class="bg-secondary py-6 md:py-8 w-full text-center">
    <h2 class="text-white text-[50px] md:text-[60px] font-heavy tracking-wide uppercase">
      {{ __('Diaspora') }}
    </h2>
  </section>

  <!-- ================= SECTION FAQ DIASPORA ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Puis-je lancer un projet sans être au Togo ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui, absolument. Tout le processus est conçu pour être géré à distance : études, contrat, paiements, suivi. Votre présence est souhaitable uniquement pour la réception finale, et même cette étape peut se faire par vidéoconférence.') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Comment suivre mon chantier depuis l\'étranger ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Rapports photos/vidéos hebdomadaires, visioconférences de suivi selon vos disponibilités et votre fuseau horaire. Un chef de projet dédié est votre interlocuteur unique. Alertes instantanées quand une décision est nécessaire.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Quel budget minimum pour un projet diaspora ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p class="mb-4">{{ __('Le budget dépend du standing, de la surface et de la zone géographique. À titre indicatif, pour une villa Standard de 100 m² en Grand Lomé, comptez à partir de 25 millions FCFA (environ 38 000 €) pour la construction seule, hors équipements optionnels.') }}</p>
          <p>{{ __('Ce montant inclut les coefficients géographiques et géotechniques, les frais d\'études et la marge de gestion. Il peut varier significativement selon les spécificités de votre projet. Notre simulateur en ligne vous donne une estimation personnalisée en 2 minutes.') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Les paiements sont-ils sécurisés ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui. Virements internationaux vers le compte bancaire vérifié de AIAE SARL. Reçu émis pour chaque versement. Paiement par étapes sur constat d\'avancement. Contrat signable devant notaire pour une sécurité juridique maximale.') }}</p>
        </div>
      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              05
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Puis-je combiner construction et énergie solaire ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui, c\'est l\'un de nos atouts majeurs. Notre Division Énergie (opérationnelle en 2026) intègre une installation solaire dès la conception de votre bâtiment. Un seul interlocuteur, un seul contrat, une maison autonome en énergie.') }}</p>
        </div>
      </details>

      <!-- QUESTION 06 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              06
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Avez-vous un bureau en France / Europe ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Nous n\'avons pas de bureau physique en Europe, mais des rendez-vous en personne peuvent être organisés lors de déplacements de notre équipe. La visioconférence reste notre mode principal, adaptée à votre fuseau horaire.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION TITRE SIMULATEUR EN LIGNE ================= -->
  <section class="bg-[#084c2e] py-10 w-full text-center">
    <h2 class="text-white text-[50px] md:text-[60px] font-heavy tracking-wide uppercase">
      {{ __('SIMULATEUR EN LIGNE') }}
    </h2>
  </section>

  <!-- ================= SECTION FAQ SIMULATEUR EN LIGNE ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Le résultat du simulateur est-il un devis ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Non. Le simulateur fournit une estimation budgétaire indicative sous forme de fourchette (montant minimum — montant maximum). Il ne remplace pas un devis détaillé établi après étude technique sur site. Pour obtenir un devis engageant, contactez-nous.') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Comment est calculée l\'estimation ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('L\'estimation est basée sur nos prix de référence au m² par standing, ajustés par des coefficients géographiques (logistique) et géotechniques (type de sol). Les équipements optionnels (solaire, forage, piscine, etc.) sont ajoutés avec leurs propres fourchettes de prix.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Puis-je sauvegarder ma simulation ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Oui. En créant un compte gratuit, vous pouvez sauvegarder vos simulations, les comparer entre elles et les reprendre plus tard. Vous pourrez également télécharger un PDF récapitulatif (fonctionnalité en cours de déploiement).') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details open class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Pourquoi le résultat est-il une fourchette et non un prix fixe ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Parce que le coût réel dépend de choix de matériaux, de la complexité architecturale et des conditions du marché. La fourchette vous donne un cadre budgétaire réaliste : le minimum correspond à des choix économiques, le maximum à des choix haut de gamme au sein du standing choisi.') }}</p>
        </div>
      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              05
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Le simulateur couvre-t-il les bâtiments non résidentiels ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Oui. Le simulateur propose 4 secteurs : résidentiel (villas), tertiaire (bureaux, commerces), industriel (entrepôts, ateliers) et agricole (fermes). Chaque secteur a ses propres paramètres et grilles de prix.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION TITRE ÉNERGIE & ÉQUIPEMENTS ================= -->
  <section class="bg-darkBlue py-10 w-full text-center">
    <h2 class="text-white text-[50px] md:text-[60px] font-heavy tracking-wide uppercase">
      {{ __('ÉNERGIE & ÉQUIPEMENTS') }}
    </h2>
  </section>

  <!-- ================= SECTION FAQ ÉNERGIE & ÉQUIPEMENTS ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Proposez-vous des installations solaires ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Oui. Notre Division Énergie (opérationnelle en 2026) propose des kits solaires hybrides de 3 kWc à 50 kWc pour les entreprises et les bâtiments à usage professionnel (C&I — Commercial & Industrial). Des solutions résidentielles peuvent être intégrées dans le cadre d\'un projet de construction. Chaque installation comprend panneaux, onduleur hybride, batteries LiFePO4, câblage complet et mise en service.') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Pouvez-vous installer un forage ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Oui. Nous proposons des forages de 30 à 120 mètres selon la profondeur de la nappe dans votre zone. Le forfait comprend le forage, le tubage, la pompe immergée, le tableau de commande et un château d\'eau de 2 m³. Le simulateur recommande automatiquement la profondeur adaptée à votre zone géographique.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Quels équipements optionnels proposez-vous ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Énergie (solaire, groupes électrogènes), sécurité (alarme, vidéosurveillance, contrôle d\'accès), extérieurs (clôture, portail, forage, piscine, aménagement paysager), confort (domotique, volets roulants, citerne eau de pluie). Tous les prix sont en fourchette min-max et consultables dans le simulateur.') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details open class="group border border-darkBlue rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-darkBlue text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-darkBlue">
              {{ __('Les équipements sont-ils inclus dans le prix au m² ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-darkBlue pt-6">
          <p>{{ __('Non. Le prix au m² couvre la construction du bâtiment (gros œuvre + second œuvre + finitions). Tous les équipements sont des options chiffrées séparément avec des fourchettes de prix transparentes. Vous composez votre projet à la carte.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION TITRE PROCESSUS & CONTRAT ================= -->
  <section class="bg-secondary py-6 md:py-8 w-full text-center">
    <h2 class="text-white text-[50px] md:text-[60px] font-heavy tracking-wide uppercase">
      {{ __('PROCESSUS & CONTRAT') }}
    </h2>
  </section>

  <!-- ================= SECTION FAQ PROCESSUS & CONTRAT ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Comment se déroule un projet avec AIAE ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('6 étapes : (1) Premier contact et recueil de vos besoins. (2) Étude technique et devis détaillé. (3) Signature du contrat et de l\'échéancier de paiement. (4) Construction avec suivi régulier. (5) Réception et remise des clés avec procès-verbal. (6) Suivi post-livraison (garanties).') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Puis-je voir des exemples de vos réalisations ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Par respect pour la confidentialité de nos clients, nous ne publions pas de photos de nos chantiers. Nous pouvons cependant fournir des références vérifiables sur demande lors d\'un rendez-vous.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Fournissez-vous les plans architecturaux ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui. Le devis inclut la conception architecturale (plans, coupes, façades) et les études techniques nécessaires. Vous recevez un dossier complet à la livraison : plans d\'exécution, rapports techniques, certificats de garantie.') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details open class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Le contrat peut-il être signé devant notaire ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui. Pour une sécurité juridique maximale, le contrat peut être signé devant un notaire togolais. Un mandataire peut agir en votre nom si vous n\'êtes pas au Togo.') }}</p>
        </div>
      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              05
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('Que se passe-t-il en cas de retard ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Les délais sont contractuels. En cas de retard imputable à AIAE, des pénalités sont prévues au contrat. En cas de force majeure (intempéries exceptionnelles, pénurie de matériaux), le délai est prolongé d\'une durée équivalente, documentée et communiquée.') }}</p>
        </div>
      </details>

      <!-- QUESTION 06 -->
      <details class="group border border-secondary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-secondary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              06
            </span>
            <p class="font-heavy text-3xl text-secondary">
              {{ __('AIAE est-elle assurée ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqorange.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-secondary pt-6">
          <p>{{ __('Oui. AIAE SARL dispose d\'une assurance responsabilité civile professionnelle couvrant les dommages éventuels liés à nos activités, et d\'une garantie décennale couvrant la structure portante pendant 10 ans après réception. Les attestations d\'assurance sont disponibles sur demande lors d\'un rendez-vous.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION TITRE À PROPOS D'AIAE ================= -->
  <section class="bg-[#084c2e] py-10 w-full text-center">
    <h2 class="text-white text-[50px] md:text-[60px] font-heavy tracking-wide uppercase">
      {{ __('À PROPOS D\'AIAE') }}
    </h2>
  </section>

  <!-- ================= SECTION FAQ À PROPOS D'AIAE ================= -->
  <section class="bg-[#f2f3f5] py-10 pb-20 w-full">
    <div class="max-w-[1100px] mx-auto px-6 space-y-4">

      <!-- QUESTION 01 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              01
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Comment AIAE se compare-t-elle aux grandes entreprises étrangères ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Nous offrons une expertise technique de niveau international avec un ancrage local fort. Réactivité, connaissance approfondie du terrain togolais (géologie, climat, logistique régionale), et des prix justes sans les surcoûts liés aux équipes expatriées. Notre fondateur cumule plus de 18 ans d\'expérience en génie civil, formé aux standards européens tout en maîtrisant parfaitement les réalités du terrain en Afrique de l\'Ouest.') }}</p>
        </div>
      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              02
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('AIAE est-elle une entreprise récente ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('AIAE SARL a été créée en 2025, mais l\'expertise de son fondateur remonte à 2007. Plus de 18 ans d\'expérience en conception et réalisation d\'ouvrages de génie civil, dont de nombreux projets complexes. L\'entreprise est le fruit d\'un parcours professionnel solide, pas une aventure improvisée.') }}</p>
        </div>
      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              03
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Quelles sont vos valeurs ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Cinq valeurs non négociables : (1) La qualité est primordiale — nous construisons pour des générations. (2) La parole donnée est sacrée. (3) L\'honnêteté envers le client. (4) Le respect des sous-traitants et ouvriers. (5) Le respect des délais et des coûts.') }}</p>
        </div>
      </details>

      <!-- QUESTION 04 -->
      <details open class="group border border-primary rounded-lg bg-white overflow-hidden">
        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">
          <div class="flex items-center gap-4">
            <span class="bg-primary text-white flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full text-2xl font-bold">
              04
            </span>
            <p class="font-heavy text-3xl text-primary">
              {{ __('Quelles sont les divisions de AIAE ?') }}
            </p>
          </div>
          <img src="{{ asset('aiae-frontend/Images/bfaqvert.png') }}" alt="icon" class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>
        <div class="px-16 pb-6 text-[#343434] font-book text-2xl border-t border-primary pt-6">
          <p>{{ __('Construction (opérationnelle) : résidentiel, tertiaire, industriel, agricole. Énergie (lancement 2026) : installations solaires C&I. Sécurité (lancement 2027) : coffres-forts, chambres fortes, panic rooms. Préfabrication (lancement 2027-2028) : briques en terre compressée, éléments en béton précontraint.') }}</p>
        </div>
      </details>
    </div>
  </section>

  <!-- ================= SECTION CTA FINAL ================= -->
  <section class="bg-[#e6e6e6] py-10 w-full font-FuturaStdLight">
    <div class="max-w-[1100px] mx-auto text-left md:text-center px-6">

      <h2 class="text-[#1d1d1b] text-4xl md:text-[55px] font-heavy mb-6 leading-tight">
        {!! __('Vous ne trouvez pas la réponse à<br> votre question ?') !!}
      </h2>
      <p class="text-gray-600 leading-relaxed mb-10 text-[16px] md:text-[27px] max-w-[800px] md:mx-auto">
        {!! __('Notre équipe est à votre écoute. Contactez-nous<br> directement ou demandez un devis gratuit.') !!}
      </p>

      <div class="flex flex-col md:flex-row justify-center">
        <!-- Bouton Orange -->
        <a href="{{ route('contact') }}" class="bg-secondary text-white px-10 py-5 text-center font-heavy uppercase tracking-wider">
          {{ __('Demander un devis gratuit') }}
          <span class="block text-sm font-light text-white normal-case">
            {{ __('Réponse sous 48h') }}
          </span>
        </a>

        <!-- Bouton Vert -->
        <a href="{{ route('contact') }}" class="bg-primary text-white px-10 py-5 text-center font-heavy uppercase tracking-wider">
          {{ __('Prendre rendez-vous') }}
          <span class="block text-sm font-light text-white normal-case">
            {{ __('En personne ou en visio') }}
          </span>
        </a>
      </div>

    </div>
  </section>

  <!-- ================= RÉSEAUX SOCIAUX ================= -->
  <section class="w-full">
    <!-- BARRE VERTE -->
    <div class="bg-[#0b4a2b] text-white py-6">
      <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-center gap-6">
        <!-- ICÔNES -->
        <div class="flex items-center gap-6">
          <!-- TikTok -->
          <a href="#" aria-label="TikTok">
            <img src="{{ asset('aiae-frontend/Images/TiktokLogo.svg') }}" alt="TikTok" class="h-16 w-16" />
          </a>

          <!-- Instagram -->
          <a href="#" aria-label="Instagram">
            <img src="{{ asset('aiae-frontend/Images/InstagramLogo.svg') }}" alt="Instagram" class="h-16 w-16" />
          </a>

          <!-- Facebook -->
          <a href="#" aria-label="Facebook">
            <img src="{{ asset('aiae-frontend/Images/FacebookLogo.svg') }}" alt="Facebook" class="h-16 w-16" />
          </a>

          <!-- YouTube -->
          <a href="#" aria-label="YouTube">
            <img src="{{ asset('aiae-frontend/Images/YoutubeLogo.svg') }}" alt="YouTube" class="h-16 w-16" />
          </a>
        </div>

        <!-- TEXTE DROIT -->
        <div class="flex flex-col items-center md:items-start text-center md:text-left">
          <p class="text-4xl font-bold text-gray-300">@ Afrika_AIAE</p>
          <p class="text-lg text-gray-300 font-light">
            {{ __('Suivez-nous,') }} <strong class="font-heavy text-gray-300">{{ __('Abonnez-vous') }}</strong> {{ __('&') }}
            <strong class="font-heavy text-gray-300">{{ __('Likez nos publications') }}</strong>
          </p>
        </div>
      </div>
    </div>

    <!-- BARRE CLAIRE -->
    <div class="bg-[#e6e6e6] py-6">
      <div class="max-w-7xl mx-auto px-6 flex flex-row items-center justify-center gap-4 md:gap-8 text-[#0b4a2b] text-center md:text-left">
        <!-- WhatsApp Icon -->
        <img src="{{ asset('aiae-frontend/Images/WhatsappLogo.svg') }}" alt="WhatsApp" class="h-10 w-10 md:h-12 md:w-12 shrink-0" />

        <div class="flex flex-col md:flex-row items-start md:items-center md:gap-8">
          <p class="text-2xl md:text-3xl text-left">
            +228 <span class="font-bold">90 03 54 16</span>
          </p>

          <p class="text-xs md:text-sm font-book text-left">
            <strong class="font-heavy">{{ __('Écrivez-nous') }}</strong> {{ __('pour toutes') }}<br />
            <strong class="font-heavy">{{ __('informations') }}</strong> {{ __('supplémentaires') }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= FOOTER ================= -->
  <footer class="bg-[#e6e6e6] pt-20">

    <div class="max-w-7xl mx-auto px-6">

      <div class="grid grid-cols-1 md:grid-cols-[1.6fr_1fr_1fr_1fr] gap-16">

        <!-- LOGO + DESCRIPTION -->
        <div>

          <img src="{{ asset('aiae-frontend/Images/logos/LOGO_AIAE_FINAL_-_Copie.png') }}" class="w-80 pb-5" alt="AIAE Logo">

          <p class="text-black font-light text-[18px] md:text-[27px] leading-relaxed max-w-lg whitespace-nowrap">
            <strong class="font-heavy">{{ __('AIAE : Afrika Infrastructures And') }}</strong><br>
            <strong class="font-heavy">{{ __('Equipements.') }}</strong> {!! __('De La Conception<br>À La Réalisation.') !!}
          </p>

        </div>


        <!-- DIVISIONS -->
        <div>
          <h3 class="text-[29px] font-medium mb-6 text-darkBlue">
            {{ __('Nos divisions') }}
          </h3>

          <ul class="space-y-2 text-gray-600 text-[20px] font-light">

            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Construction') }}</a></li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Énergie') }}</a></li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Sécurité') }}</a></li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Préfabrication') }}</a></li>

          </ul>
        </div>


        <!-- CONTACT -->
        <div>

          <h3 class="text-[29px] font-medium mb-6 text-darkBlue">
            {{ __('Contact') }}
          </h3>

           <ul class="space-y-2 text-gray-600 text-[20px] font-light">

            <li>{{ __('Quartier Kléme Zanguéra Rue Agoe Nyive - Lomé Togo') }}</li>
            <li>+228 90 03 54 16</li>
            <li>contact@aiae.services</li>

          </ul>

        </div>


        <!-- ACCEDER -->
        <div>

          <h3 class="text-[29px] font-medium mb-6 text-darkBlue">
            {{ __('Accéder à') }}
          </h3>

           <ul class="space-y-2 text-gray-600 text-[20px] font-light">

            <li>
              <a href="{{ route('contact') }}" class="hover:text-darkBlue transition">
                {{ __('Demander un devis') }}
              </a>
            </li>

            <li>
              <a href="javascript:void(0)" onclick="openRdvModal('physique')" class="hover:text-darkBlue transition cursor-pointer">
                {{ __('Prendre rendez-vous') }}
              </a>
            </li>

            <li>
              <a href="{{ route('faq') }}" class="hover:text-darkBlue transition">
                {{ __('FAQ') }}
              </a>
            </li>

            <li>
              <a href="{{ route('mentions-legales') }}" class="hover:text-darkBlue transition">
                {{ __('Mentions légales') }}
              </a>
            </li>

          </ul>

        </div>

      </div>

    </div>


    <!-- COPYRIGHT -->
    <div class="bg-darkBlue text-white text-center mt-20 py-3 text-lg font-medium">

      {{ __('Copyright — ©') }} {{ date('Y') }} {{ __('AIAE SARL. Tous Droits Réservés.') }}

    </div>

  </footer>


  <!-- ================= JS ================= -->
  <script>

    // Intersection Observer for animations
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = '1';

          // Counter animation
          if (entry.target.querySelector('[data-count]')) {
            const counter = entry.target.querySelector('[data-count]');
            const target = parseInt(counter.dataset.count);
            animateCounter(counter, target);
          }
        }
      });
    }, observerOptions);

    document.querySelectorAll('[data-animate]').forEach(el => {
      observer.observe(el);
    });

    // Counter animation function
    function animateCounter(element, target) {
      let current = 0;
      const increment = target / 50;
      const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
          element.textContent = target + '+';
          clearInterval(timer);
        } else {
          element.textContent = Math.floor(current);
        }
      }, 30);
    }

    // Parallax effect for hero
    window.addEventListener('scroll', () => {
      const hero = document.querySelector('section:first-of-type');
      if (hero) {
        const scrolled = window.scrollY;
        hero.style.backgroundPositionY = scrolled * 0.5 + 'px';
      }
    });
    // plus de details 
    const btn = document.getElementById("toggleDetails");
    const panel = document.getElementById("details-panel");
    const icon = document.getElementById("details-icon");

    if (btn && panel && icon) {
      btn.addEventListener("click", () => {
        panel.classList.toggle("hidden");
        icon.classList.toggle("rotate");
      });
    }

    // plus de details pour les étapes
    const btnSteps = document.getElementById("toggleStepsDetails");
    const panelSteps = document.getElementById("steps-panel");
    const iconSteps = document.getElementById("steps-icon");

    if (btnSteps && panelSteps && iconSteps) {
      btnSteps.addEventListener("click", () => {
        panelSteps.classList.toggle("hidden");
        iconSteps.classList.toggle("rotate-180");
      });
    }
  </script>
  @include('frontend.partials.rdv-modal')
  @include('frontend.partials.cookie-consent')
  @include('frontend.partials.whatsapp-button')
</body>

</html>
