<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Nos Disions - AIAE</title>
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
              <div class="p-6 text-gray-800 text-[18px] flex-1">
                <p class="mb-5 leading-relaxed">
                  {!! __('Le standing Standard offre un logement <strong class="font-heavy">fonctionnel et durable à prix optimisé</strong>. Idéal pour un premier investissement immobilier ou un projet locatif.') !!}
                </p>
                <ul class="space-y-2 list-disc pl-5">
                  <li>{!! __('<strong class="font-heavy">Matériaux</strong> : Parpaings 15 cm, dalles 16+4, enduit lissé, peinture économique') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Menuiseries</strong> : Aluminium anodisé standard, simple vitrage') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sols</strong> : Carrelage 40x40 cm standard') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sanitaires</strong> : Gamme économique, robinetterie chrome') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Électricité</strong> : Installation standard, tableau 1 rangée') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Cuisine</strong> : Plan de travail carrelé, meubles basiques') !!}</li>
                </ul>
              </div>
            </div>

            <!-- CARTE CONFORT -->
            <div id="card-confort"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">CONFORT</span> : <span>Équilibre<br>qualité-prix optimal</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 text-[18px] flex-1">
                <p class="mb-5 leading-relaxed">
                  {!! __('Le standing Confort constitue le <strong class="font-heavy">meilleur rapport qualité-prix</strong>.<br>Finitions soignées, espaces généreux, équipements complets.') !!}
                </p>
                <ul class="space-y-2 list-disc pl-5">
                  <li>{!! __('<strong class="font-heavy">Matériaux</strong> : Parpaings 20 cm, dalles 20+5, enduit gratté, peinture qualité') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Menuiseries</strong> : Aluminium laqué, double vitrage zones exposées') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sols</strong> : Carrelage grès cérame 60x60') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sanitaires</strong> : Gamme design, robinetterie qualité, eau chaude') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Électricité</strong> : Tableau 2 rangées, prises RJ45, pré-câblage domotique') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Cuisine</strong> : Plan granit/quartz, meubles MDF stratifié') !!}</li>
                </ul>
              </div>
            </div>

            <!-- CARTE PREMIUM -->
            <div id="card-premium"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">PREMIUM</span> : <span>Excellence et<br>personnalisation</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 text-[18px] flex-1">
                <p class="mb-5 leading-relaxed">
                  {!! __('Le standing Premium offre des prestations <strong class="font-heavy">haut de gamme avec personnalisation poussée</strong>. Piscine incluse, garage 2 véhicules, bureau et salle multimédia.') !!}
                </p>
                <ul class="space-y-2 list-disc pl-5">
                  <li>{!! __('<strong class="font-heavy">Matériaux</strong> : Béton banché ou agglos 20 cm, isolation thermique, enduit décoratif') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Menuiseries</strong> : Aluminium à rupture thermique, double vitrage intégral') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sols</strong> : Carrelage rectifié haut de gamme, parquet chambres') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sanitaires</strong> : Baignoire + douche suite, double vasque, robinetterie design') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Électricité</strong> : Domotique partielle, éclairage architectural, parafoudre') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Piscine</strong> : 8x4 m minimum, local technique, pool house 20-25 m²') !!}</li>
                </ul>
              </div>
            </div>

            <!-- CARTE PRESTIGE -->
            <div id="card-prestige"
              class="standing-card bg-white rounded-[20px] overflow-hidden opacity-100 flex flex-col shadow-lg border border-gray-100">
              <div class="bg-darkBlue px-6 py-5 text-white">
                <h4 class="text-[30px] leading-snug">{!! __('<span class="font-heavy">PRESTIGE</span> : <span>Luxe et<br>exclusivité sans compromis</span>') !!}</h4>
              </div>
              <div class="p-6 text-gray-800 text-[18px] flex-1">
                <p class="mb-5 leading-relaxed">
                  {!! __('Le standing Prestige représente l\'<strong class="font-heavy">excellence absolue</strong>. Villa d\'architecte avec des matériaux d\'exception, domotique complète et équipements de luxe.') !!}
                </p>
                <ul class="space-y-2 list-disc pl-5">
                  <li>{!! __('<strong class="font-heavy">Matériaux</strong> : Béton architectonique, pierre naturelle, isolation haute performance') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Menuiseries</strong> : Sur mesure importées, triple vitrage, motorisées') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sols</strong> : Marbre, travertin ou parquet massif importé') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sanitaires</strong> : Marques designer, robinetterie prestige, spa privatif') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Électricité</strong> : Domotique complète (KNX/Loxone), groupe électrogène intégré') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Piscine</strong> : 12x5 m à débordement, chauffée, pool house bar') !!}</li>
                  <li>{!! __('<strong class="font-heavy">Sécurité</strong> : Vidéosurveillance 16 caméras, alarme périmétrique, safe room optionnelle (Division Sécurité).') !!}</li>
                </ul>
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
        {!! __("Au-delà du bâtiment, <strong class=\"text-white font-heavy\">AIAE dispose d'une expertise de haut niveau en ouvrages d'art<br> et structures complexes</strong>. Cette compétence différenciante s'appuie sur plus de 15 ans<br> d'expérience en calcul des structures et béton précontraint.") !!}
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
         <a href="#" class="bg-secondary text-white px-10 py-5 text-center font-heavy">
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
            <img src="{{ asset('aiae-frontend/Images/InstagramLogo.svg') }}" alt="TikTok" class="h-16 w-16" />
          </a>

          <!-- Facebook -->
          <a href="#" aria-label="Facebook">
            <img src="{{ asset('aiae-frontend/Images/FacebookLogo.svg') }}" alt="TikTok" class="h-16 w-16" />
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
            {{ __('Suivez nous,') }} <strong class="font-heavy text-gray-300">{{ __('Abonnez vous') }}</strong> {{ __('&') }}
            <strong class="font-heavy text-gray-300">{{ __('Likez nos post') }}</strong>
          </p>
        </div>
      </div>
    </div>

    <!-- BARRE CLAIRE -->
    <div class="bg-[#e6e6e6] py-6">
      <div class="max-w-7xl mx-auto px-6 flex flex-row items-center justify-center gap-4 md:gap-8 text-[#0b4a2b] text-center md:text-left">
        <!-- WhatsApp Icon -->
        <img src="{{ asset('aiae-frontend/Images/WhatsappLogo.svg') }}" alt="" class="h-10 w-10 md:h-12 md:w-12 shrink-0" />

        <div class="flex flex-col md:flex-row items-start md:items-center md:gap-8">
          <p class="text-2xl md:text-3xl text-left">
            +228 <span class="font-bold">90 03 54 16</span>
          </p>

          <p class="text-xs md:text-sm font-book text-left">
            <strong class="font-heavy">{{ __('Écrivez nous') }}</strong> {{ __('pour toutes') }}<br />
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
            <strong class="font-heavy">AIAE : Afrika Infrastructures And</strong><br>
            <strong class="font-heavy">Equipements.</strong> {!! __('De La Conception<br>À La Réalisation.') !!}
          </p>

        </div>


        <!-- DIVISIONS -->
        <div>
          <h3 class="text-[29px] font-medium mb-6 text-darkBlue">
            {{ __('Division construction') }}
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

      {{ __('Copyright — © 2025-2026 AIAE SARL. Tous Droits Réservés.') }}

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
</body>

</html>
