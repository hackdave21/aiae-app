<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nos divisions - AIAE</title>
  @include('frontend.partials.head-seo')
  @include('frontend.partials.schema-org')
  <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL.png') }}">
  <link rel="stylesheet" href="{{ asset('aiae-frontend/css/responsive.css') }}">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

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
            darkBlue: "#0E1540",
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

    /* Ultra Gras helper */
    .font-ultra {
      font-weight: 900 !important;
      -webkit-text-stroke: 0.8px currentColor;
      text-stroke: 0.8px currentColor;
      paint-order: stroke fill;
    }
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @include('frontend.partials.navbar')

    <!-- ================= HERO DIVISION ================= -->
<section class="pt-20 md:pt-24 pb-5 bg-[#e6e6e6]">

  <div class="max-w-[99%] mx-auto px-2">

    <div class="relative rounded-[25px] overflow-hidden shadow-3xl">

      <!-- IMAGE -->
      <img src="{{ asset('aiae-frontend/Images/division.png') }}"
           class="w-full h-auto min-h-[320px] sm:min-h-[360px] md:h-[320px] lg:h-[360px] object-cover">

      <!-- OVERLAY -->
      <div class="absolute inset-0 bg-black/70"></div>

      <!-- CONTENU PRINCIPAL -->
      <div class="absolute inset-0 flex flex-col justify-center p-4 sm:p-6 md:p-8 lg:p-12 text-white">

        <!-- TITRE -->
        <h1 class="leading-tight mb-2">
          <span class="block text-[22px] sm:text-[32px] md:text-[55px] lg:text-[75px] font-light tracking-tight">
            {{ __('DIVISION') }}
          </span>
          <span class="block text-[28px] sm:text-[40px] md:text-[65px] lg:text-[90px] font-bold tracking-tighter leading-none">
            {{ __('CONSTRUCTION') }}
          </span>
        </h1>

        <!-- TEXTE + BADGE CÔTE À CÔTE -->
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-3 md:gap-6">

          <!-- TEXTE -->
          <div class="text-[11px] sm:text-[13px] md:text-[14px] lg:text-[16px] leading-[1.5]">
            <p class="mb-1.5">
              {!! __('Concevoir et réaliser des infrastructures durables, c’est la raison d’être d’AIAE. <strong class="text-white font-heavy">Nous prenons en charge l\'intégralité de vos projets de construction, de la première esquisse à la remise des clés.</strong>') !!}
            </p>
            <p class="mt-1.5">
              {!! __('<strong class="text-white font-heavy">Forte de plus de 18 ans d\'expérience en génie civil,</strong> AIAE dispose de compétences rares au Togo pour traiter aussi bien des <strong class="text-white font-heavy">villas résidentielles</strong> que des <strong class="text-white font-heavy">ouvrages d\'art complexes.</strong>') !!}
            </p>
          </div>

          <!-- BADGE -->
          <div class="md:shrink-0 bg-primary/80 text-white px-4 py-3 rounded-[12px] text-[11px] sm:text-[13px] md:text-[14px] lg:text-[16px] leading-[1.4] text-center md:text-left max-w-full md:max-w-[220px] lg:max-w-[260px]">
            {!! __('Fondée en 2025, <strong class="text-white font-heavy">ancrée dans 18 ans d\'expertise.</strong>') !!}
          </div>

        </div>

      </div>

    </div>

  </div>

</section>

  <!-- ================= CE QUE NOUS CONSTRUISONS ================= -->
  <section class="bg-[#e6e6e6] py-5">

    <div class="max-w-[900px] mx-auto px-6 text-center">

      <!-- TITRE -->
     <h2 class="leading-[0.9] uppercase">

  <span class="block text-[28px] sm:text-[40px] md:text-[75px] lg:text-[90px] font-bold text-[#121a44]">
    {!! __('CE QUE NOUS') !!}
  </span>

  <span class="block text-[28px] sm:text-[40px] md:text-[75px] lg:text-[90px] font-bold text-primary">
    {!! __('CONSTRUISONS') !!}
  </span>

</h2>

      <!-- TEXTE -->
      <p class="mt-6 text-[15px] sm:text-[18px] md:text-[20px] text-black uppercase tracking-[1px] leading-[1.7]">
        {!! __('<strong class="font-heavy text-black">CATÉGORIES :</strong> RÉSIDENTIEL, TERTIAIRE, INDUSTRIEL,<br> AGRICOLE, RÉHABILITATION ET EXTENSION') !!}
      </p>

    </div>

  </section>

  <!-- ================= DETAILS CONSTRUCTION ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[1000px] mx-auto px-6 space-y-16">

      <!-- 01 -->
      <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6 md:gap-10 items-center">
          <div class="relative">
            <img src="{{ asset('aiae-frontend/Images/secteur1.png') }}" class="w-full h-auto rounded-[15px] object-cover">
          </div>
          <div class="text-left">
            <h3 class="text-primary font-bold text-[35px] sm:text-[40px] md:text-[50px] uppercase tracking-tight mb-4 md:mb-6 leading-tight md:leading-none">
               {{ __('RÉSIDENTIEL') }}
            </h3>
            <p class="text-[#4a4a4a] text-[18px] sm:text-[20px] md:text-[24px] leading-relaxed">
              {!! __('Villas individuelles, immeubles<br>d’habitation, duplex, résidences<br>gardées. <strong class="text-[#333] font-heavy">Du standing Standard au<br>Prestige, nous adaptons chaque projet<br>à votre budget et vos exigences.</strong>') !!}
            </p>
          </div>
        </div>
        <div class="flex justify-start">
          <ul class="list-disc pl-6 text-[#4a4a4a] text-[18px] md:text-[24px] space-y-2 marker:text-gray-500 marker:text-[20px] text-left">
            <li>{!! __('<strong class="text-[#333]  font-heavy">Villas de 80 à 600 m²</strong> : tous standings (Standard, Confort, Premium, Prestige et plus)') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Immeubles d’habitation</strong> : R+2 à R+5 (Confort à Premium)') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Duplex</strong> : 150 à 400 m² (Confort à Prestige)') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Résidences gardées</strong> : ensembles sécurisés (Confort à Prestige)') !!}</li>
          </ul>
        </div>
      </div>

      <hr class="border-gray-300">

      <!-- 02 -->
      <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6 md:gap-10 items-center">
          <div class="relative">
            <img src="{{ asset('aiae-frontend/Images/secteur2.png') }}" class="w-full h-auto rounded-[15px] object-cover">
          </div>
          <div class="text-left">
            <h3 class="text-secondary font-bold text-[35px] sm:text-[40px] md:text-[50px] uppercase tracking-tight mb-4 md:mb-6 leading-tight md:leading-none">
              {{ __('TERTIAIRE') }}
            </h3>
            <p class="text-[#4a4a4a] text-[18px] sm:text-[20px] md:text-[24px] leading-relaxed">
              {!! __('Bureaux, commerces, hôtels, cliniques<br>et établissements recevant du public.<br><strong class="text-[#333] font-heavy">Conception fonctionnelle optimisée<br>pour votre activité.</strong>') !!}
            </p>
          </div>
        </div>
        <div class="flex justify-start">
          <ul class="list-disc pl-6 text-[#4a4a4a] text-[18px] md:text-[24px] space-y-2 marker:text-gray-500 marker:text-[20px] text-left">
            <li>{!! __('<strong class="text-[#333] font-heavy">Bureaux et espaces de travail</strong> : PME, sièges sociaux') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Locaux commerciaux</strong> : boutiques, showrooms, centres commerciaux') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Hôtellerie</strong> : hôtels 2★ à 5★, résidences meublées') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Santé</strong> : cliniques, cabinets médicaux, pharmacies') !!}</li>
          </ul>
        </div>
      </div>

      <hr class="border-gray-300">

      <!-- 03 -->
      <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6 md:gap-10 items-center">
          <div class="relative">
            <img src="{{ asset('aiae-frontend/Images/secteur3.png') }}" class="w-full h-auto rounded-[15px] object-cover">
          </div>
          <div class="text-left">
            <h3 class="text-primary font-bold text-[35px] sm:text-[40px] md:text-[50px] uppercase tracking-tight mb-4 md:mb-6 leading-tight md:leading-none">
              {{ __('INDUSTRIEL') }}
            </h3>
            <p class="text-[#4a4a4a] text-[18px] sm:text-[20px] md:text-[24px] leading-relaxed">
              {!! __('Entrepôts, usines, ateliers de<br>production. <strong class="text-[#333] font-heavy">Structures<br>optimisées pour la logistique<br>et la production.</strong>') !!}
            </p>
          </div>
        </div>
        <div class="flex justify-start">
          <ul class="list-disc pl-6 text-[#4a4a4a] text-[18px] md:text-[24px] space-y-2 marker:text-gray-500 marker:text-[20px] text-left">
            <li>{!! __('<strong class="text-[#333] font-heavy">Entrepôts</strong> : de 200 à 5 000 m²') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Usines et ateliers</strong> : structures métalliques ou béton') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Plateformes logistiques</strong> : quais de chargement, zones de stockage') !!}</li>
          </ul>
        </div>
      </div>

      <hr class="border-gray-300">

      <!-- 04 -->
      <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6 md:gap-10 items-center">
          <div class="relative">
            <img src="{{ asset('aiae-frontend/Images/secteur4.png') }}" class="w-full h-auto rounded-[15px] object-contain">
          </div>
          <div class="text-left">
            <h3 class="text-secondary font-bold text-[35px] sm:text-[40px] md:text-[50px] uppercase tracking-tight mb-4 md:mb-6 leading-tight md:leading-none">
              {{ __('AGRICOLE') }}
            </h3>
            <p class="text-[#4a4a4a] text-[18px] sm:text-[20px] md:text-[24px] leading-relaxed">
              {!! __('Infrastructures agricoles et d\'élevage<br>adaptées aux conditions tropicales. AIAE<br>conçoit des bâtiments fonctionnels,<br>durables et conformes aux normes<br>sanitaires en vigueur. <strong class="text-[#333] font-heavy">Solutions intégrées<br>avec notre Division Énergie pour des<br>exploitations autonomes.</strong>') !!}
            </p>
          </div>
        </div>
        <div class="flex flex-col items-start">
          <ul class="list-disc pl-6 text-[#4a4a4a] text-[18px] md:text-[24px] space-y-2 marker:text-gray-500 marker:text-[20px] text-left">
            <li>{!! __('<strong class="text-[#333] font-heavy">Élevage avicole</strong> : Poulaillers ventilés (pondeuses, chair), couvoir, unités d\'aliments de bétail') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Élevage porcin</strong> : Porcheries avec système de gestion des effluents, maternité, engraissement') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Élevage bovin</strong> : Parcs d\'embouche, étables laitières, aires d\'abattage, couloirs de contention, abreuvoirs bétonnés') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Pisciculture</strong> : Bassins en béton armé, étangs aménagés, raceways, écloseries, systèmes de recirculation (RAS)') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Apiculture</strong> : Mielleries, ateliers d\'extraction et de conditionnement, locaux de stockage aux normes') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Stockage agricole</strong> : Silos, magasins ventilés, chambres froides, aires de séchage') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Serres et pépinières</strong> : Tunnels, multi-chapelles, systèmes d\'irrigation intégrés') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Transformation</strong> : Huileries, décortiqueries, unités de séchage, abattoirs aux normes') !!}</li>
          </ul>
          <p class="text-[#333] font-light italic text-[16px] sm:text-[18px] md:text-[24px] leading-relaxed md:ml-6 mt-6 md:mt-4 max-w-[800px] whitespace-normal text-left">
            {!! __('Tous nos ouvrages peuvent être couplés à des installations énergétiques (Groupes électrogènes, champs photovoltaïque, biogaz) pour des exploitations autonomes en énergie, particulièrement en zones rurales non raccordées.') !!}
          </p>
        </div>
      </div>

      <hr class="border-gray-300">

      <!-- 05 -->
      <div class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6 md:gap-10 items-center">
          <div class="relative">
            <img src="{{ asset('aiae-frontend/Images/secteur5.png') }}" class="w-full h-auto rounded-[15px] object-cover">
          </div>
          <div class="text-left">
            <h3 class="text-primary font-bold text-[35px] sm:text-[40px] md:text-[50px] uppercase tracking-tight mb-4 md:mb-6 leading-tight md:leading-none">
              {{ __('RÉHABILITATION ET EXTENSION') }}
            </h3>
            <p class="text-[#4a4a4a] text-[18px] sm:text-[20px] md:text-[24px] leading-relaxed">
              {!! __('Vous disposez d’un bâtiment existant<br>à remettre en état ou à agrandir ?<br><strong class="text-[#333] font-heavy">Nous réalisons des diagnostics structurels<br>et proposons des solutions adaptées.</strong>') !!}
            </p>
          </div>
        </div>
        <div class="flex justify-start">
          <ul class="list-disc pl-6 text-[#4a4a4a] text-[18px] md:text-[24px] space-y-2 marker:text-gray-500 marker:text-[20px] text-left">
            <li>{!! __('<strong class="text-[#333] font-heavy">Diagnostic</strong> structurel et étude de faisabilité') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Renforcement de structures</strong> (poteaux, poutres, fondations)') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Extension</strong> horizontale ou verticale') !!}</li>
            <li>{!! __('<strong class="text-[#333] font-heavy">Rénovation complète</strong> intérieure et extérieure') !!}</li>
          </ul>
        </div>
      </div>

    </div>

  </section>

  <!-- ================= 04 NIVEAUX DE QUALITÉ ================= -->
  <section class="bg-[#111d4a] py-10">

    <div class="max-w-[1100px] mx-auto px-6 text-left md:text-center">

      <!-- HEADER : 04 + TITRE -->
      <div class="flex items-center justify-start md:justify-center gap-4 md:gap-8 mb-6 md:mb-10">
        <span class="text-[80px] md:text-[140px] font-heavy leading-none text-secondary shrink-0">04</span>
        <h2 class="text-white font-heavy text-[32px] sm:text-[45px] md:text-[65px] leading-[1.05] text-left">
            {!! __('Niveaux De Qualité<br>Pour Votre Projet') !!}
        </h2>
      </div>

      <!-- PARAGRAPHE -->
      <p class="text-white text-[16px] sm:text-[20px] md:text-[28px] leading-relaxed text-left md:text-center">
      {!! __('<span class="font-light">AIAE propose quatre niveaux de standing pour la construction résidentielle.</span><br>Chaque niveau définit des caractéristiques techniques minimales garanties<br>: matériaux, dimensions, équipements, finitions.') !!}
      </p>

    </div>

  </section>

  <!-- ================= STANDINGS ================= -->
  <section class="bg-[#f3f3f3] py-12">
    <div class="max-w-[1100px] mx-auto px-6">

      <!-- TABS CONTAINER -->
      <div
        class="w-full max-w-5xl mx-auto grid grid-cols-2 lg:flex gap-[2px] bg-white rounded-xl overflow-hidden shadow-md">

        <!-- Plus de détails -->
        <button id="toggleDetails"
          class="col-span-2 lg:flex-none flex items-center justify-center gap-3 px-6 py-4 bg-secondary text-white transition-colors hover:bg-secondary/90">

          <img src="{{ asset('aiae-frontend/Images/plus.png') }}" alt="" id="details-icon" class="w-8 h-8 transition-transform duration-300">

          <span class="text-[14px] md:text-[16px] font-heavy tracking-wide">{{ __('Plus de détails') }}</span>
        </button>

        <!-- Tabs style standardized -->
        <button
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[13px] md:text-[16px] hover:bg-[#16205a] transition-colors">
          {{ __('STANDARD') }}
        </button>
        <button
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[13px] md:text-[16px] hover:bg-[#16205a] transition-colors">
          {{ __('CONFORT') }}
        </button>
        <button
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[13px] md:text-[16px] hover:bg-[#16205a] transition-colors">
          {{ __('PREMIUM') }}
        </button>
        <button
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[13px] md:text-[16px] hover:bg-[#16205a] transition-colors">
          {{ __('PRESTIGE') }}
        </button>

      </div>

      <!-- PANNEAU DÉTAILS (caché par défaut) -->
      <div id="details-panel" class="hidden mt-8">

        <!-- En-tête panneau -->
        <div class="bg-[#111d4a] rounded-t-[20px] px-8 py-6">
          <h3 class="text-white text-[28px] font-bold">{{ __('Détail par standing') }}</h3>
        </div>

        <!-- Contenu panneau -->
        <div class="bg-[#111d4a] rounded-b-[20px] px-6 pb-8 pt-4">

          <!-- Grille des cartes -->
          <div class="grid md:grid-cols-2 gap-6">

            <!-- CARTE STANDARD -->
            <div id="card-standard"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">STANDARD</span> : <span>Conception<br>économique et fonctionnelle</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 flex-1">
                <p class="mb-4 leading-relaxed text-[16px]">
                  {!! __('Le standing Standard offre un logement <strong class="font-heavy">fonctionnel et durable à prix optimisé</strong>. Idéal pour un premier investissement immobilier ou un projet locatif.') !!}
                </p>
                <div class="space-y-3 text-[15px]">
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Structure et gros œuvre</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Fondations : semelles isolées sous poteaux ou filantes sous murs porteurs, conformes aux Eurocodes et NF DTU, en béton armé (C20/25, acier HA FeE500), profondeur 0,80-1,00 m selon étude de sol') !!}</li>
                      <li>{!! __('Murs porteurs RDC : agglos creux de 15 cm avec chaînages horizontaux et verticaux (pour R+1, prévoir agglos 20 cm)') !!}</li>
                      <li>{!! __('Cloisons intérieures : agglos creux de 10 cm') !!}</li>
                      <li>{!! __('Planchers : hourdis 16+4 cm (portées ≤ 4 m) ou 20+5 cm (portées > 4 m)') !!}</li>
                      <li>{!! __('Hauteur sous plafond : 2,60 m') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Toiture</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Charpente bois traité (anti-termites)') !!}</li>
                      <li>{!! __('Couverture tôles bac aluminium 7/10ème') !!}</li>
                      <li>{!! __('Gouttières PVC avec descentes') !!}</li>
                      <li>{!! __('Sous-face en lambris PVC') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Menuiseries</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Extérieures : aluminium anodisé standard, vitrage simple clair') !!}</li>
                      <li>{!! __('Intérieures : portes isoplane sur huisserie métallique') !!}</li>
                      <li>{!! __('Grilles de défense en fer forgé (fenêtres RDC)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Revêtements et finitions</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Sols : carrelage grès cérame 40×40 cm (séjour, cuisine), grès émaillé (SDB)') !!}</li>
                      <li>{!! __('Murs intérieurs : enduit ciment lissé, peinture acrylique 2 couches') !!}</li>
                      <li>{!! __('Murs extérieurs : enduit ciment taloché, peinture façade') !!}</li>
                      <li>{!! __('Plafonds : lambris PVC') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Électricité</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Installation encastrée conforme NF C 15-100') !!}</li>
                      <li>{!! __('Tableau de répartition 1 rangée avec disjoncteur différentiel 30 mA') !!}</li>
                      <li>{!! __('Prises et interrupteurs gamme économique') !!}</li>
                      <li>{!! __('Pré-câblage climatisation chambres') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Plomberie et sanitaires</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Alimentation : tubes PPR (polypropylène)') !!}</li>
                      <li>{!! __('Évacuation : PVC série assainissement') !!}</li>
                      <li>{!! __('Sanitaires porcelaine vitrifiée gamme économique, robinetterie chrome') !!}</li>
                      <li>{!! __('Production eau chaude : non incluse (option)') !!}</li>
                      <li>{!! __('Assainissement : fosse septique 3 000 L + puisard (ou raccordement réseau si disponible)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Conception bioclimatique</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Ventilation traversante favorisée par le plan architectural') !!}</li>
                      <li>{!! __('Débords de toiture ≥ 60 cm (protection solaire des façades)') !!}</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- CARTE CONFORT -->
            <div id="card-confort"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">CONFORT</span> : <span>Équilibre<br>qualité-prix optimal</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 flex-1">
                <p class="mb-4 leading-relaxed text-[16px]">
                  {!! __('Le standing Confort constitue le <strong class="font-heavy">meilleur rapport qualité-prix</strong>. Finitions soignées, espaces généreux, équipements complets. Notre cœur de gamme.') !!}
                </p>
                <div class="space-y-3 text-[15px]">
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Structure et gros œuvre</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Fondations : semelles filantes renforcées conformes aux Eurocodes et NF DTU, en béton armé (C25/30, acier HA FeE500) avec longrines de liaison') !!}</li>
                      <li>{!! __('Murs porteurs : agglos de 20 cm avec chaînages horizontaux à chaque niveau de plancher et verticaux aux angles') !!}</li>
                      <li>{!! __('Cloisons intérieures : agglos de 10 ou 15 cm selon fonction') !!}</li>
                      <li>{!! __('Planchers : hourdis 20+5 cm (standard), dalles pleines pour porte-à-faux') !!}</li>
                      <li>{!! __('Hauteur sous plafond : 2,80 m') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Toiture</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Charpente bois traité ou charpente métallique légère') !!}</li>
                      <li>{!! __('Couverture tôles bac aluminium thermo-laquées (coloris au choix)') !!}</li>
                      <li>{!! __('Gouttières aluminium laqué avec descentes') !!}</li>
                      <li>{!! __('Isolation thermique sous toiture par lame d\'air ventilée entre couverture et faux-plafond BA13') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Menuiseries</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Extérieures : aluminium laqué (coloris au choix), double vitrage (isolation acoustique) dans les zones exposées au bruit (façade sur rue, proximité voie principale)') !!}</li>
                      <li>{!! __('Intérieures : portes pleines MDF stratifié, quincaillerie qualité') !!}</li>
                      <li>{!! __('Baies coulissantes aluminium pour les ouvertures principales') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Revêtements et finitions</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Sols : carrelage grès cérame rectifié 60×60 cm (séjour, cuisine), faïence murale SDB hauteur 2 m') !!}</li>
                      <li>{!! __('Murs intérieurs : enduit gratté, peinture acrylique lessivable') !!}</li>
                      <li>{!! __('Murs extérieurs : enduit décoratif (gratté ou taloché fin), peinture siloxane haute durabilité') !!}</li>
                      <li>{!! __('Plafonds : faux-plafond BA13 sur ossature métallique (séjour, chambres), lambris PVC (SDB)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Électricité</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Installation complète conforme NF C 15-100') !!}</li>
                      <li>{!! __('Tableau de répartition 2 rangées avec protection différentielle 30 mA par circuit') !!}</li>
                      <li>{!! __('Prises RJ45 (réseau informatique) dans le séjour et le bureau') !!}</li>
                      <li>{!! __('Pré-câblage domotique (gaines supplémentaires pour évolution future)') !!}</li>
                      <li>{!! __('Éclairage : spots encastrés séjour, appliques chambres') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Plomberie et sanitaires</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Alimentation : tubes multicouche (plus durable que PPR)') !!}</li>
                      <li>{!! __('Évacuation : PVC série assainissement, siphons de sol SDB') !!}</li>
                      <li>{!! __('Sanitaires design (cuvette suspendue, vasque à poser), robinetterie qualité') !!}</li>
                      <li>{!! __('Production eau chaude : chauffe-eau solaire thermosiphon ou électrique') !!}</li>
                      <li>{!! __('Assainissement : fosse septique 4 000 L améliorée + champ d\'épandage') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Climatisation</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Split mural dans toutes les pièces principales (chambres + séjour)') !!}</li>
                      <li>{!! __('Option multi-split ou gainable possible') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Cuisine</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Plan de travail granit ou quartz reconstitué') !!}</li>
                      <li>{!! __('Meubles bas et hauts MDF stratifié') !!}</li>
                      <li>{!! __('Évier inox double bac, mitigeur') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Conception bioclimatique</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Ventilation traversante systématique') !!}</li>
                      <li>{!! __('Débords de toiture ≥ 80 cm') !!}</li>
                      <li>{!! __('Isolation sous toiture par lame d\'air ventilée (≥ 20 cm) + faux-plafond BA13') !!}</li>
                      <li>{!! __('Brasseurs d\'air au plafond dans les espaces de vie (complément à la climatisation)') !!}</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- CARTE PREMIUM -->
            <div id="card-premium"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">PREMIUM</span> : <span>Excellence et<br>personnalisation</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 flex-1">
                <p class="mb-4 leading-relaxed text-[16px]">
                  {!! __('Le standing Premium offre des prestations <strong class="font-heavy">haut de gamme avec personnalisation poussée</strong>. Piscine incluse, garage 2 véhicules, bureau et salle multimédia.') !!}
                </p>
                <div class="space-y-3 text-[15px]">
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Structure et gros œuvre</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Fondations : semelles filantes ou radier partiel conformes aux Eurocodes et NF DTU, en béton armé (C25/30 à C30/37, acier HA FeE500) selon étude géotechnique G2 AVP recommandée') !!}</li>
                      <li>{!! __('Murs porteurs : agglos de 20 cm ou béton banché selon projet, avec poteaux BA 25×25 cm et chaînages horizontaux à chaque niveau de plancher') !!}</li>
                      <li>{!! __('Isolation thermique des murs : doublage intérieur polystyrène + placo (chambres climatisées)') !!}</li>
                      <li>{!! __('Planchers : hourdis 20+5 ou dalles pleines BA (portées > 5 m, porte-à-faux terrasses)') !!}</li>
                      <li>{!! __('Hauteur sous plafond : 3,00 m') !!}</li>
                      <li>{!! __('Possibilité R+2 (étude structure obligatoire)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Toiture</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Charpente métallique (portées longues) ou bois exotique traité') !!}</li>
                      <li>{!! __('Couverture tuiles béton ou tôles bac aluminium thermo-laquées avec isolation sous toiture (polystyrène expansé 40 mm)') !!}</li>
                      <li>{!! __('Gouttières aluminium laqué') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Menuiseries</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Extérieures : profilés aluminium haut de gamme, double vitrage intégral (performance acoustique et réduction UV)') !!}</li>
                      <li>{!! __('Baies vitrées coulissantes grand format (ouverture sur terrasse/piscine)') !!}</li>
                      <li>{!! __('Volets roulants aluminium motorisés') !!}</li>
                      <li>{!! __('Intérieures : portes bois massif (iroko ou similaire), quincaillerie design') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Revêtements et finitions</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Sols : carrelage rectifié haut de gamme 80×80 cm (séjour), parquet massif ou contrecollé (chambres)') !!}</li>
                      <li>{!! __('Murs : enduit décoratif avec effets (stucco, tadelakt), peinture premium') !!}</li>
                      <li>{!! __('Plafonds : faux-plafond BA13 avec spots LED encastrés et éclairage architectural (corniches lumineuses)') !!}</li>
                      <li>{!! __('Façades : enduit fin avec modénatures architecturales') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Électricité</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Installation complète conforme NF C 15-100, conception selon plan d\'éclairage architectural') !!}</li>
                      <li>{!! __('Tableau de répartition 3 rangées, parafoudre, protection différentielle sélective') !!}</li>
                      <li>{!! __('Domotique partielle : éclairage, volets roulants, climatisation (pilotage centralisé ou par application)') !!}</li>
                      <li>{!! __('Prises RJ45 dans toutes les pièces, réseau Ethernet catégorie 6') !!}</li>
                      <li>{!! __('Éclairage architectural : spots, bandeaux LED, appliques design') !!}</li>
                      <li>{!! __('Pré-câblage alarme et vidéosurveillance') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Plomberie et sanitaires</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Alimentation : tubes multicouche, nourrice de distribution') !!}</li>
                      <li>{!! __('Suite parentale : baignoire îlot + douche italienne, double vasque, robinetterie design') !!}</li>
                      <li>{!! __('SDB secondaires : douche italienne, vasque design') !!}</li>
                      <li>{!! __('Production eau chaude : chauffe-eau thermodynamique ou solaire') !!}</li>
                      <li>{!! __('WC suspendus avec bâti-support dans toutes les SDB') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Piscine</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Bassin béton armé carrelé 8×4 m minimum') !!}</li>
                      <li>{!! __('Local technique (filtration, pompe, traitement)') !!}</li>
                      <li>{!! __('Pool house 20-25 m² (bar, vestiaire, douche extérieure)') !!}</li>
                      <li>{!! __('Plage minérale ou bois composite') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Climatisation</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Système gainable ou multi-split inverter haute performance') !!}</li>
                      <li>{!! __('Régulation par zone') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Conception bioclimatique</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Étude d\'orientation solaire à la conception') !!}</li>
                      <li>{!! __('Isolation toiture + murs climatisés') !!}</li>
                      <li>{!! __('Pergolas et brise-soleil architecturaux') !!}</li>
                      <li>{!! __('Ventilation mécanique complémentaire (VMC) dans les SDB intérieures') !!}</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

            <!-- CARTE PRESTIGE -->
            <div id="card-prestige"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">PRESTIGE</span> : <span>Luxe et<br>exclusivité sans compromis</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 flex-1">
                <p class="mb-4 leading-relaxed text-[16px]">
                  {!! __('Le standing Prestige représente l\'<strong class="font-heavy">excellence absolue</strong>. Villa d\'architecte avec des matériaux d\'exception, domotique complète et équipements de luxe. Chaque projet est unique.') !!}
                </p>
                <div class="space-y-3 text-[15px]">
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Structure et gros œuvre</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Fondations : radier général ou fondations profondes conformes aux Eurocodes et NF DTU, en béton armé (C30/37, acier HA FeE500) selon étude géotechnique G2 PRO obligatoire') !!}</li>
                      <li>{!! __('Structure : poteaux-poutres BA surdimensionnés, murs agglos 20 cm + doublage isolation') !!}</li>
                      <li>{!! __('Béton architectonique pour éléments de façade apparents') !!}</li>
                      <li>{!! __('Planchers : dalles pleines BA (portées libres, flexibilité architecturale) ou hourdis 25+5') !!}</li>
                      <li>{!! __('Hauteur sous plafond : 3,20 à 3,50 m') !!}</li>
                      <li>{!! __('Possibilité R+2 avec ascenseur') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Toiture</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Charpente métallique ou bois lamellé-collé pour portées exceptionnelles') !!}</li>
                      <li>{!! __('Couverture tuiles terre cuite ou ardoise selon style architectural') !!}</li>
                      <li>{!! __('Isolation haute performance (laine minérale 100 mm ou mousse polyuréthane projetée selon disponibilité locale)') !!}</li>
                      <li>{!! __('Toiture-terrasse végétalisée possible') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Menuiseries</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Extérieures : menuiseries sur mesure importées, double ou triple vitrage selon exposition (performance acoustique supérieure, filtration UV > 95 %)') !!}</li>
                      <li>{!! __('Portes d\'entrée monumentales sur mesure (bois massif, acier, ou mixte)') !!}</li>
                      <li>{!! __('Volets roulants intégrés motorisés et connectés') !!}</li>
                      <li>{!! __('Intérieures : portes sur mesure bois massif exotique, pivotantes ou coulissantes grand format') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Revêtements et finitions</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Sols : marbre, travertin ou parquet massif importé') !!}</li>
                      <li>{!! __('Murs : finitions artisanales (tadelakt, béton ciré, pierre de parement), peinture prestige') !!}</li>
                      <li>{!! __('Plafonds : faux-plafonds design multi-niveaux avec éclairage architectural intégré') !!}</li>
                      <li>{!! __('Escalier monumental (si R+1/R+2) en béton habillé pierre ou bois') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Électricité et domotique</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Conception par bureau d\'études spécialisé') !!}</li>
                      <li>{!! __('Domotique complète (système centralisé sur protocole standard ouvert) : éclairage, volets, climatisation, sécurité, audio multi-room') !!}</li>
                      <li>{!! __('Groupe électrogène intégré avec commutation automatique') !!}</li>
                      <li>{!! __('Onduleur et protection parafoudre renforcée') !!}</li>
                      <li>{!! __('Éclairage architectural complet (intérieur + extérieur + piscine)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Plomberie et sanitaires</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Marques design/luxe (Grohe, Hansgrohe, Duravit ou équivalent)') !!}</li>
                      <li>{!! __('Suite parentale : SDB type spa (baignoire balnéo, douche pluie XXL, hammam possible)') !!}</li>
                      <li>{!! __('Robinetterie thermostatique encastrée') !!}</li>
                      <li>{!! __('Système de traitement d\'eau (adoucisseur, filtration)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Piscine</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Bassin béton armé 12×5 m à débordement (ou forme libre selon architecture)') !!}</li>
                      <li>{!! __('Chauffage piscine (pompe à chaleur)') !!}</li>
                      <li>{!! __('Éclairage subaquatique LED couleur') !!}</li>
                      <li>{!! __('Pool house aménagé (bar, cuisine d\'été, vestiaires)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Sécurité (Division Sécurité AIAE — optionnel)</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Vidéosurveillance 16 caméras HD avec enregistrement NVR') !!}</li>
                      <li>{!! __('Alarme périmétrique volumétrique connectée') !!}</li>
                      <li>{!! __('Contrôle d\'accès biométrique (entrée principale + garage)') !!}</li>
                      <li>{!! __('Safe room optionnelle (sur devis — Division Sécurité)') !!}</li>
                    </ul>
                  </div>
                  <div>
                    <p class="font-heavy text-darkBlue text-[16px]">Conception bioclimatique</p>
                    <ul class="list-disc pl-5 mt-1 space-y-1 text-gray-700">
                      <li>{!! __('Étude bioclimatique complète à la conception (orientation, vents dominants, masques solaires)') !!}</li>
                      <li>{!! __('Isolation haute performance (toiture, murs, vitrages)') !!}</li>
                      <li>{!! __('Récupération eaux de pluie (citerne 20 m³) pour arrosage et WC') !!}</li>
                      <li>{!! __('Option installation solaire photovoltaïque intégrée (Division Énergie)') !!}</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>

      <!-- RÉSUMÉ MOBILE (visible par défaut sur mobile) -->
      <div class="md:hidden mt-6 space-y-4">
        <div class="bg-white rounded-[12px] border border-gray-200 p-5 shadow-sm">
          <h4 class="text-darkBlue text-[18px] font-bold">{{ __('STANDARD') }}</h4>
          <p class="text-gray-600 text-[13px] mt-2">{{ __('Le standing Standard offre un logement fonctionnel et durable à prix optimisé.') }}</p>
        </div>
        <div class="bg-white rounded-[12px] border border-gray-200 p-5 shadow-sm">
          <h4 class="text-darkBlue text-[18px] font-bold">{{ __('CONFORT') }}</h4>
          <p class="text-gray-600 text-[13px] mt-2">{{ __('Le standing Confort constitue le meilleur rapport qualité-prix. Finitions soignées et équipements complets.') }}</p>
        </div>
        <div class="bg-white rounded-[12px] border border-gray-200 p-5 shadow-sm">
          <h4 class="text-darkBlue text-[18px] font-bold">{{ __('PREMIUM') }}</h4>
          <p class="text-gray-600 text-[13px] mt-2">{{ __('Le standing Premium offre des prestations haut de gamme avec personnalisation poussée.') }}</p>
        </div>
        <div class="bg-white rounded-[12px] border border-gray-200 p-5 shadow-sm">
          <h4 class="text-darkBlue text-[18px] font-bold">{{ __('PRESTIGE') }}</h4>
          <p class="text-gray-600 text-[13px] mt-2">{{ __('Le standing Prestige représente l\'excellence absolue. Villa d\'architecte avec des matériaux d\'exception.') }}</p>
        </div>
      </div>

    </div>
  </section>

  <!-- ================= DES COMPÉTENCES RARES ================= -->
  <section class="bg-primary py-10 text-left md:text-center text-white">
    <div class="max-w-[1000px] mx-auto px-6">
      <h2 class="text-[35px] md:text-[50px] font-heavy mb-6">{{ __('Des Compétences Rares Au Togo') }}</h2>
      <p class="text-[20px] md:text-[22px] leading-relaxed max-w-[850px] mx-auto">
        {!! __("Au-delà du bâtiment, <strong class=\"text-white font-heavy\">AIAE dispose d'une expertise de haut niveau en ouvrages d'art<br> et structures complexes</strong>. Cette compétence différenciante s'appuie sur plus de 15 ans<br> d'expérience en calcul des structures et béton précontraint. <strong class=\"text-white font-heavy\">Conception selon Eurocodes et NF DTU.</strong>") !!}
      </p>
    </div>
  </section>

  <!-- ================= EXPERTISE GRID ================= -->
  <section class="bg-[#f2f3f5] py-20">
    <div class="max-w-[1000px] mx-auto px-6 lg:px-20">
      <div class="grid md:grid-cols-2 gap-x-20 gap-y-14">

        <!-- ITEM 1 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            01</div>
          <div>
            <h3 class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide"> {!! __('PONTS ET<br> PASSERELLES') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"> {!! __('en béton armé ou<br> précontraint') !!}</p>
          </div>
        </div>

        <!-- ITEM 2 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            02</div>
          <div>
            <h3 class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide"> {!! __('MURS DE<br> SOUTÈNEMENT') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"> {!! __('parois moulées,<br> gabions, terre armée') !!}</p>
          </div>
        </div>

        <!-- ITEM 3 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            03</div>
          <div>
            <h3 class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide"> {!! __('BÉTON<br> PRÉCONTRAINT') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"> {!! __('portiques grandes portées,<br> structures spéciales') !!}</p>
          </div>
        </div>

        <!-- ITEM 4 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            04</div>
          <div>
            <h3 class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide"> {!! __('OUVRAGES<br> HYDRAULIQUES') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"> {!! __('châteaux d\'eau,<br> réservoirs, stations') !!}</p>
          </div>
        </div>

        <!-- ITEM 5 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            05</div>
          <div>
            <h3 class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide"> {!! __('STRUCTURES<br> SPÉCIALES') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"> {!! __('tribunes, halls<br> industriels, coupoles') !!}</p>
          </div>
        </div>

        <!-- ITEM 6 (Text Box) -->
        <div class="flex items-center pt-2">
          <div class="text-primary text-[18px] xl:text-[25px] italic leading-snug whitespace-nowrap">
              {!! __("Cette expertise permet également de<br> répondre aux <strong class=\"font-heavy text-primary\">appels d'offres publics<br> pour les infrastructures de transport<br> et les équipements collectifs.</strong>") !!}
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ================= 06 ÉTAPES HERO ================= -->
  <section class="bg-darkBlue py-5 text-left md:text-center text-white">
    <div class="max-w-[1000px] mx-auto px-6">
      <h2 class="text-[50px] md:text-[60px] font-heavy mb-6">{!! __('Votre Projet En <span class="text-secondary text-[50px] md:text-[60px]">06</span> Étapes') !!}</h2>
      <p class="text-[22px] md:text-[27px] leading-relaxed max-w-[850px] mx-auto font-light">
        {!! __('De la première prise de contact à la remise des clés, <strong class="text-white">chaque étape est<br> définie, planifiée et suivie</strong>. Vous savez toujours où en est votre projet.') !!}
      </p>
    </div>
  </section>

  <!-- ================= ÉTAPES DETAILS ================= -->
  <section class="bg-[#f2f3f5] py-16">
    <div class="max-w-[1100px] mx-auto px-6">

      <!-- TABS CONTAINER ÉTAPES -->
      <div
        class="w-full max-w-5xl mx-auto grid grid-cols-2 lg:flex gap-[2px] bg-white rounded-xl overflow-hidden shadow-md">

        <!-- Plus de détails -->
        <button id="toggleStepsDetails"
          class="col-span-2 lg:flex-none flex items-center justify-center gap-3 px-6 py-4 bg-secondary text-white transition-colors hover:bg-secondary/90">
          <img src="{{ asset('aiae-frontend/Images/plus.png') }}" alt="" id="steps-icon" class="w-8 h-8 transition-transform duration-300">
          <span class="text-[14px] md:text-[16px] font-heavy tracking-wide">{{ __('Plus de détails') }}</span>
        </button>

        <!-- Headers style standardized -->
        <div
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[15px] md:text-[25px] flex items-center justify-center uppercase tracking-wide">
          {{ __('ÉTAPES') }}
        </div>
        <div
          class="flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[15px] md:text-[25px] flex items-center justify-center uppercase tracking-wide">
          {{ __('DURÉE') }}
        </div>
        <div
          class="col-span-2 lg:flex-1 py-4 bg-[#0f1740] text-white font-heavy text-[15px] md:text-[25px] flex items-center justify-center uppercase tracking-wide border-t lg:border-t-0 border-white/10">
          {{ __('DESCRIPTION') }}
        </div>
      </div>

      <!-- PANNEAU DÉTAILS ÉTAPES -->
      <div id="steps-panel" class="hidden mt-8">

        <!-- En-tête panneau -->
        <div class="bg-[#111d4a] rounded-t-[20px] px-8 py-6">
          <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-heavy mb-8 text-white">{{ __('Détail du parcours client') }}</h2>
        </div>

        <!-- Contenu panneau -->
        <div class="bg-[#111d4a] rounded-b-[20px] px-6 pb-8 pt-4">
          <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('01. Études préliminaires') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 2-4 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Visite terrain, analyse des besoins, faisabilité technique, esquisse architecturale, estimation budgétaire préliminaire.') }}
              </p>
            </div>

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('02. Études techniques') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 3-6 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Plans architecturaux définitifs, calculs de structure, devis détaillé basé sur le BPU, planning contractuel, obtention du permis de construire.') }}
              </p>
            </div>

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('03. Préparation chantier') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 1-2 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Installation de chantier, approvisionnement matériaux, mobilisation des équipes, implantation de l’ouvrage.') }}
              </p>
            </div>

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('04. Gros œuvre') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 8-16 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Fondations, structure (poteaux, poutres, dalles), maçonnerie, charpente et couverture. Rapports d’avancement réguliers.') }}
              </p>
            </div>

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('05. Second œuvre') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 6-12 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Électricité, plomberie, menuiseries, enduits, revêtements de sol, peinture, équipements sanitaires.') }}
              </p>
            </div>

            <div class="bg-white rounded-[15px] p-6 shadow-lg">
              <h4 class="text-darkBlue text-[30px] font-bold mb-2">{{ __('06. Finitions & Réception') }}</h4>
              <p class="text-secondary text-[15px] font-bold mb-3 uppercase tracking-wide">{{ __('Durée : 2-4 sem.') }}</p>
              <p class="text-gray-700 text-[18px] leading-relaxed">
                {{ __('Aménagements extérieurs, réserves, procès-verbal de réception, remise des clés, documentation technique.') }}
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= NORMES ET RÉFÉRENTIELS (I3) ================= -->
  <section class="bg-[#f3f3f3] py-16">
    <div class="max-w-[1000px] mx-auto px-6">
      <div class="bg-white rounded-[20px] p-10 md:p-14 shadow-lg">
        <h2 class="text-darkBlue text-[35px] md:text-[45px] font-heavy mb-8 text-center">{{ __('Normes Et Référentiels') }}</h2>
        <div class="grid md:grid-cols-2 gap-8 text-gray-700 text-[16px] md:text-[18px] leading-relaxed">
          <div class="space-y-4">
            <h3 class="text-primary font-bold text-xl mb-2">{{ __('Eurocodes Structurels') }}</h3>
            <p>{{ __('Tous nos calculs de structures sont conformes aux Eurocodes EN 1990 à EN 1999 (Eurocodes 0 à 9), garantissant la sécurité et la durabilité des ouvrages selon les standards européens.') }}</p>
            <ul class="list-disc list-inside space-y-1 text-gray-600">
              <li><strong>EN 1990</strong> — {{ __('Bases de calcul des structures') }}</li>
              <li><strong>EN 1991</strong> — {{ __('Actions sur les structures') }}</li>
              <li><strong>EN 1992</strong> — {{ __('Calcul des structures en béton') }}</li>
              <li><strong>EN 1993</strong> — {{ __('Calcul des structures en acier') }}</li>
              <li><strong>EN 1997</strong> — {{ __('Calcul géotechnique') }}</li>
              <li><strong>EN 1998</strong> — {{ __('Calcul parasismique') }}</li>
            </ul>
          </div>
          <div class="space-y-4">
            <h3 class="text-primary font-bold text-xl mb-2">{{ __('NF DTU — Normes Françaises') }}</h3>
            <p>{{ __('Nos chantiers suivent les NF DTU (Documents Techniques Unifiés) en vigueur : DTU 13.11 (fondations), DTU 20.1 (maçonnerie), DTU 21 (planchers), DTU 23.1 (murs), DTU 40.41 (couverture), DTU 60.1 (plomberie), DTU 70.1 (installations électriques).') }}</p>
            <h3 class="text-primary font-bold text-xl mb-2 mt-6">{{ __('Fascicules 61 à 74 — CCTG') }}</h3>
            <p>{{ __('Nos études de voirie et réseaux divers (VRD) suivent les prescriptions des Fascicules 61 à 74 du Cahier des Clauses Techniques Générales (CCTG), applicables aux marchés publics et privés en Afrique.') }}</p>
            <ul class="list-disc list-inside space-y-1 text-gray-600">
              <li><strong>Fasc. 61</strong> — {{ __('Terrassements généraux') }}</li>
              <li><strong>Fasc. 62</strong> — {{ __('Chaussées et voiries') }}</li>
              <li><strong>Fasc. 64</strong> — {{ __('Assainissement et drainage') }}</li>
              <li><strong>Fasc. 65</strong> — {{ __('Alimentation en eau potable') }}</li>
              <li><strong>Fasc. 69</strong> — {{ __('Ouvrages d\'assainissement') }}</li>
              <li><strong>Fasc. 74</strong> — {{ __('Installations électriques') }}</li>
            </ul>
          </div>
        </div>
        <p class="mt-8 text-center text-gray-500 text-sm">
          {{ __('Nos ingénieurs appliquent systématiquement ces référentiels pour garantir la conformité et la qualité de chaque projet.') }}
        </p>
      </div>
    </div>
  </section>

  <!-- ================= ENGAGEMENTS HERO ================= -->
  <section class="bg-primary py-8 text-center text-white">
    <div class="max-w-[1000px] mx-auto px-6">
      <h2 class="text-[50px] md:text-[60px] font-heavy">{{ __('Nos Engagements Construction') }}</h2>
    </div>
  </section>

  <!-- ================= ENGAGEMENTS GRID ================= -->
  <section class="bg-[#f2f3f5] py-10">
    <div class="max-w-[1000px] mx-auto px-6 lg:px-20">
      <div class="grid md:grid-cols-2 gap-x-20 gap-y-14">
        <!-- ITEM 1 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            01</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {!! __('DEVIS GRATUIT<br> DÉTAILLÉ') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed">{{ __('Basé sur notre Bordereau des Prix Unitaires (BPU).') }}
              <strong class="text-gray-800 font-heavy">{{ __('Chaque ligne de votre devis est justifiée.') }}</strong>
            </p>
          </div>
        </div>
        <!-- ITEM 2 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            02</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {!! __('PLANNING<br> CONTRACTUEL') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed">{{ __('Les délais sont inscrits au contrat.') }} <strong
                class="text-gray-800 font-heavy">{{ __('Pénalités en cas de retard de notre fait.') }}</strong></p>
          </div>
        </div>
        <!-- ITEM 3 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            03</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {!! __('GARANTIE<br> DÉCENNALE') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed">{{ __('Solidité de l\'ouvrage') }} <strong
                class="text-gray-800 font-heavy">{{ __('garantie 10 ans') }}</strong>{{ __(', conformément à la loi.') }}</p>
          </div>
        </div>
        <!-- ITEM 4 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            04</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {{ __('SUIVI RÉGULIER') }}
            </h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"><strong class="text-gray-800 font-heavy">{{ __('Rapports hebdomadaires') }}</strong>{{ __(' avec photos/vidéos. ') }}<strong
                class="text-gray-800 font-heavy">{{ __('Visioconférences') }}</strong>{{ __(' pour les clients à distance.') }}</p>
          </div>
        </div>
        <!-- ITEM 5 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            05</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {!! __('TRANSPARENCE<br> TOTALE') !!}</h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"><strong class="text-gray-800 font-heavy">{{ __('Aucun coût caché.') }}</strong>{{ __(' Facturation par étapes selon l\'avancement.') }}</p>
          </div>
        </div>
        <!-- ITEM 6 -->
        <div class="flex gap-6">
          <div
            class="bg-primary text-white flex-shrink-0 w-16 h-16 rounded-full flex items-center justify-center font-bold text-[30px]">
            06</div>
          <div>
            <h3
              class="text-primary text-[24px] md:text-[27px] font-bold uppercase mb-2 leading-tight tracking-wide">
              {{ __('CONFIDENTIALITÉ') }}
            </h3>
            <p class="text-gray-600 text-[18px] xl:text-[24px] leading-relaxed"><strong
                class="text-gray-800 font-heavy">{{ __('Secret professionnel contractualisé') }}</strong>{{ __(' sur tous nos projets.') }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= EXEMPLES CHIFFRÉS ================= -->
  <section class="bg-white py-16">
    <div class="max-w-[1000px] mx-auto px-6">
      <h2 class="text-[32px] md:text-[40px] font-heavy text-darkBlue text-center mb-12">{{ __('Exemples de projets réalisés') }}</h2>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-gray-50 rounded-[20px] p-8 border border-gray-200">
          <div class="text-primary font-bold text-sm uppercase tracking-wider mb-2">{{ __('Standard') }}</div>
          <h3 class="text-[22px] font-heavy text-darkBlue mb-3">{{ __('Villa 100 m² — Lomé') }}</h3>
          <p class="text-gray-600 text-[16px] mb-4">{{ __('Construction plain-pied, 2 chambres, séjour, cuisine équipée, finitions standards.') }}</p>
          <div class="text-[28px] font-bold text-primary">33-45 M FCFA</div>
          <div class="text-gray-400 text-sm">≈ 50 000 – 68 000 €</div>
        </div>
        <div class="bg-gray-50 rounded-[20px] p-8 border border-gray-200">
          <div class="text-secondary font-bold text-sm uppercase tracking-wider mb-2">{{ __('Confort') }}</div>
          <h3 class="text-[22px] font-heavy text-darkBlue mb-3">{{ __('Villa 150 m² — Lomé') }}</h3>
          <p class="text-gray-600 text-[16px] mb-4">{{ __('R+1, 3 chambres, climatisation, cuisine aménagée, carrelage grand format, chauffe-eau solaire.') }}</p>
          <div class="text-[28px] font-bold text-secondary">55-75 M FCFA</div>
          <div class="text-gray-400 text-sm">≈ 84 000 – 114 000 €</div>
        </div>
        <div class="bg-gray-50 rounded-[20px] p-8 border border-gray-200">
          <div class="text-[#b8860b] font-bold text-sm uppercase tracking-wider mb-2">{{ __('Premium') }}</div>
          <h3 class="text-[22px] font-heavy text-darkBlue mb-3">{{ __('Villa 200 m² — Golfe') }}</h3>
          <p class="text-gray-600 text-[16px] mb-4">{{ __('R+1, 4 chambres, piscine, garage, domotique, climatisation centralisée, prestations haut de gamme.') }}</p>
          <div class="text-[28px] font-bold text-[#b8860b]">95-130 M FCFA</div>
          <div class="text-gray-400 text-sm">≈ 145 000 – 198 000 €</div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SIMULATEUR CTA ================= -->
  <section class="bg-[#f2f3f5] py-16">
    <div class="max-w-[1000px] mx-auto px-6">
      <div class="bg-primary rounded-[20px] p-10 md:p-14 text-left md:text-center shadow-lg">
        <h3
          class="text-white text-[25px] md:text-[30px] font-heavy mb-8 flex flex-row items-center md:justify-center justify-start gap-4">
          <img src="{{ asset('aiae-frontend/Images/etage.png') }}" alt="" class="h-8 md:h-12 object-contain shrink-0">
          <span>{{ __('Estimez Le Coût De Votre Projet En 2 Minutes') }}</span>
        </h3>
        <p class="text-white border-none md:mx-auto text-[18px] md:text-[20px] font-medium max-w-[800px] mb-8">
          {!! __('Notre simulateur en ligne vous donne une estimation instantanée selon votre type de<br> projet, votre standing et votre localisation.') !!}
        </p>
        <div class="flex md:justify-center justify-start mt-8">
          <a href="{{ route('simulator.v1') }}" class="inline-block text-center w-full max-w-[550px] bg-secondary text-white font-heavy text-[23px] md:text-[27px] py-5 rounded-[20px]
         shadow-lg hover:bg-[#b05d04] transition-colors tracking-wider">
            {{ __('Accéder au simulateur') }}
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION CTA ================= -->
  <section class="bg-[#e5e5e5] py-10">
    <div class="max-w-[900px] mx-auto text-left md:text-center px-6">
      <h2 class="text-black text-4xl md:text-[65px] lg:text-[70px] font-heavy mb-8">
        {{ __('Prêt À Construire ?') }}
      </h2>

      <p class="text-[16px] md:text-[24px] text-black leading-relaxed mb-10 font-light">
        {!! __('Vous avez un projet ? Parlons-en. Premier échange<br> gratuit et sans engagement.') !!}
      </p>
      <div class="flex flex-col md:flex-row justify-center">
         <a href="{{ route('contact') }}" class="bg-secondary text-white px-10 py-5 text-center font-heavy">
          {{ __('DEMANDER UN DEVIS GRATUIT') }}
           <span class="block text-sm font-light text-white">
            {{ __('Réponse sous 48h') }}
          </span>
        </a>
        <a onclick="openRdvModal('physique')"  class="bg-primary text-white px-10 py-5 text-center font-heavy">
          {{ __('PRENDRE RENDEZ-VOUS') }}
          <span class="block text-sm font-light text-white">
            {{ __('En personne ou en visio') }}
          </span>
        </a>
      </div>
    </div>
  </section>

{{--
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
--}}

  <!-- ================= FOOTER ================= -->
  <footer class="bg-[#e6e6e6] pt-20">

    <div class="max-w-7xl mx-auto px-6">

      <div class="grid grid-cols-1 md:grid-cols-[1.6fr_1fr_1fr_1fr] gap-16">

        <!-- LOGO + DESCRIPTION -->
        <div>

          <img src="{{ asset('aiae-frontend/Images/logos/LOGO_AIAE_FINAL_-_Copie.png') }}" class="w-80 pb-5" alt="AIAE Logo">

          <p class="text-black font-light text-[18px] md:text-[27px] leading-relaxed max-w-lg whitespace-nowrap">
            <strong class="font-heavy">AIAE : Afrika Infrastructures And</strong><br>
            <strong class="font-heavy">Equipements.</strong> {!! __('De La Conception<br>À La Réalisation.') !!}
          </p>

        </div>


        <!-- DIVISIONS -->
        <div>
          <h3 class="text-[29px] font-medium mb-6 text-darkBlue">
            {{ __('Nos divisions') }}
          </h3>

          <ul class="space-y-2 text-gray-600 text-[20px] font-light">

            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Construction') }}</a></li>
            <li><a href="#" onclick="alert('{{ __('Cette section sera bientôt disponible.') }}'); return false;" class="hover:text-darkBlue transition">{{ __('Énergie') }}</a></li>
            <li><a href="#" onclick="alert('{{ __('Cette section sera bientôt disponible.') }}'); return false;" class="hover:text-darkBlue transition">{{ __('Sécurité') }}</a></li>
            <li><a href="#" onclick="alert('{{ __('Cette section sera bientôt disponible.') }}'); return false;" class="hover:text-darkBlue transition">{{ __('Préfabrication') }}</a></li>

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
