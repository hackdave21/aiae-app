<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>À propos - AIAE</title>
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
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @include('frontend.partials.navbar')

<!-- ================= HERO ================= -->
<section class="pt-20 md:pt-28 pb-5 bg-[#f7f7f7] px-4 md:px-12">
  <div class="max-w-[1450px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-14 items-center">

    <!-- TEXTE -->
    <div class="flex flex-col justify-center order-2 lg:order-1 px-2 md:px-6 min-w-0 lg:pr-8">
      <div class="mt-4">

        <!-- TITRE -->
        <h2 class="text-darkBlue font-bold text-[16px] min-[400px]:text-[18px] sm:text-[20px] md:text-[22px] lg:text-[24px] xl:text-[26px] leading-tight mb-8">
          {{ __('QUI SOMMES-NOUS ?') }}
        </h2>

        <!-- PARAGRAPHE 1 -->
        <p class="text-[#555] text-[16px] xl:text-[18px] leading-[1.6] mb-4 text-justify">
          {!! __('AIAE SARL (Afrika Infrastructures And Equipements) est une entreprise togolaise spécialisée dans la conception et la réalisation d\'infrastructures de qualité. Basée à Lomé, notre société intervient sur l\'ensemble du territoire national avec une ambition claire : devenir le partenaire de référence pour les projets d\'infrastructure stratégique en Afrique de l\'Ouest.') !!}
        </p>

        <!-- PARAGRAPHE 2 -->
        <p class="text-[#555] text-[16px] xl:text-[18px] leading-[1.6] mb-4 text-justify">
          {!! __('Notre direction technique est assurée par un Docteur Ingénieur en génie civil, spécialisé dans les structures complexes et les technologies du béton précontraint, avec plus de 18 ans d\'expérience terrain. Cette expertise de haut niveau garantit une maîtrise complète de la chaîne conception-réalisation, la capacité à traiter des projets techniquement exigeants et un dialogue de haut niveau avec vos services d\'ingénierie, dans le strict respect des normes internationales.') !!}
        </p>

      </div>
    </div>

    <!-- IMAGE -->
    <div class="w-full order-1 lg:order-2 px-2 md:px-0">
      <div class="w-full aspect-[4/3] rounded-[18px] overflow-hidden">
        <img
          src="{{ asset('aiae-frontend/Images/about.png') }}"
          class="w-full h-full object-cover"
          alt="Équipe AIAE"
        />
      </div>
    </div>

  </div>
</section>

  <!-- ================= EXPERTISE ================= -->
  <section class="bg-[#e5e5e5] pt-5 pb-10">
    <div class="max-w-[1300px] mx-auto px-6">

      <div class="bg-[#0b4a2b] rounded-[20px] p-8 md:p-12">

        <!-- TITRE -->
        <h2 class="text-white text-center font-bold text-[12px] sm:text-[20px] md:text-[30px] leading-[1.05] mb-10">
          {{ __('UNE EXPERTISE NÉE D’UN CONSTAT') }}
        </h2>

        <div class="grid md:grid-cols-2 gap-6">

          <!-- CARD 1 -->
          <div class="bg-[#0f5a34] rounded-[16px] p-6 text-white hover-lift 
            flex flex-col items-center text-center">
            <div class="mb-4">
              <img src="{{ asset('aiae-frontend/Images/col1.png') }}" class="w-14 h-14" />
            </div>
            <h3 class="font-black text-[24px] uppercase mb-2">
              {{ __('+18 ANS D’EXPERTISE') }}
            </h3>
            <p class="text-[18px] font-light leading-[1.6] opacity-90">
              {!! __('Notre savoir-faire en <strong class="text-white">génie civil</strong> est ancré dans <strong class="text-white">plus de 15 ans de practice terrain</strong> : conception, dimensionnement, réalisation et supervision d’ouvrages complexes.') !!}
            </p>
          </div>

          <!-- CARD 2 (CERCLE À CRÉER) -->
          <div class="bg-[#0f5a34] rounded-[16px] p-6 text-white hover-lift 
            flex flex-col items-center text-center">
            <div class="mb-4 flex justify-center">
              <div class="w-14 h-14 rounded-full border-2 border-[#00ff9c] flex items-center justify-center">
                <img src="{{ asset('aiae-frontend/Images/col4.png') }}" class="w-7 h-7" />
              </div>
            </div>
            <h3 class="font-black text-[24px] uppercase mb-2">
              {{ __('UN MODÈLE INTÉGRÉ UNIQUE') }}
            </h3>
            <p class="text-[18px] font-light leading-[1.6] opacity-90">
              {!! __('Construction, énergie, sécurité, préfabrication <strong class="text-white">quatre divisions complémentaires sous une seule enseigne,</strong> sans équivalent en Afrique de l’Ouest.') !!}
            </p>
          </div>

          <!-- CARD 3 -->
          <div class="bg-[#0f5a34] rounded-[16px] p-6 text-white hover-lift 
            flex flex-col items-center text-center">
            <div class="mb-4">
              <img src="{{ asset('aiae-frontend/Images/col3.png') }}" class="w-14 h-14" />
            </div>
            <h3 class="font-black text-[24px] uppercase mb-2">
              {{ __('RIGUEUR TECHNIQUE') }}
            </h3>
            <p class="text-[18px] font-light leading-[1.6] opacity-90">
              {!! __('Bordereaux des Prix Unitaires <strong class="text-white">(BPU), 4 niveaux de standing normalisés, devis détaillés</strong> ligne par ligne. <strong class="text-white">Chaque franc est justifié.</strong>') !!}
            </p>
          </div>

          <!-- CARD 4 -->
          <div class="bg-[#0f5a34] rounded-[16px] p-6 text-white hover-lift 
            flex flex-col items-center text-center">
            <div class="mb-4">
              <img src="{{ asset('aiae-frontend/Images/col2.png') }}" class="w-14 h-14" />
            </div>
            <h3 class="font-black text-[24px] uppercase mb-2">
              {{ __('ENGAGEMENT CONTRACTUEL') }}
            </h3>
            <p class="text-[18px] font-light leading-[1.6] opacity-90">
              {!! __('Délais, coûts et qualité inscrits au contrat. <strong class="text-white">Pénalités de retard.</strong> Garantie décennale. <strong class="text-white">Contrat signable devant notaire.</strong>') !!}
            </p>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- ================= NOTRE MISSION ================= -->
  <section class="bg-[#121a44] py-10">
    <div class="max-w-[950px] mx-auto px-6 text-center text-white">

      <!-- TITRE -->
      <h2 class="text-[30px] md:text-[40px] font-black tracking-[1px] uppercase mb-6">
        {{ __('NOTRE MISSION') }}
      </h2>

      <!-- TEXTE -->
      <p class="text-[14px] md:text-[20px] lg:text-[30px] leading-[1.6] font-light opacity-95 max-w-3xl mx-auto">
        {!! __('« Offrir à chaque client particulier, entreprise ou institution un partenaire unique<br> capable de concevoir, construire, équiper en énergie et sécuriser ses infrastructures,<br> avec des engagements tenus et une transparence totale. »') !!}
      </p>

    </div>
  </section>

  <!-- ================= CE QUI NOUS ANIME ================= -->
  <section class="bg-[#f7f7f7] py-24 relative overflow-hidden">

    <!-- OVALE DERRIÈRE -->
    <div class="absolute -top-32 -left-40 w-[600px] h-[400px] bg-[#e6e6e6] rounded-[50%]"></div>

    <div class="max-w-[1200px] mx-auto px-6 relative z-10">

      <div class="grid md:grid-cols-2 gap-20">

        <!-- COLONNE GAUCHE -->
        <div class="flex flex-col gap-10">

          <!-- TITRE -->
          <h2 class="text-[40px] md:text-[46px] font-bold text-[#0b4a2b] leading-[1.2]">
            {!! __('Ce qui nous anime :') !!}
          </h2>

          <!-- 02 -->
          <div class="flex gap-4 pt-10">
            <div
              class="w-14 h-14 shrink-0 bg-[#0b4a2b] text-white rounded-full flex items-center justify-center text-xl font-bold">
              02</div>
            <div>
              <h3 class="font-bold text-[#0b4a2b] text-[24px]">{{ __('Respecter') }}</h3>
              <p class="text-gray-600 text-[18px] sm:text-[20px] md:text-2xl">
                {!! __('<strong class="text-gray-700 font-heavy">Délais, budgets, qualité</strong> inscrits au contrat.') !!}
              </p>
            </div>
          </div>

          <!-- 04 -->
          <div class="flex gap-4">
            <div
              class="w-14 h-14 shrink-0 bg-[#0b4a2b] text-white rounded-full flex items-center justify-center text-xl font-bold">
              04</div>
            <div>
              <h3 class="font-bold text-[#0b4a2b] text-[24px]">{{ __('Innover') }}</h3>
              <p class="text-gray-600 text-[18px] sm:text-[20px] md:text-2xl">
                {!! __('Énergie solaire, sécurité haute performance, <strong class="text-gray-700 font-heavy">préfabrication écologique.</strong>') !!}
              </p>
            </div>
          </div>

        </div>

        <!-- COLONNE DROITE -->
        <div class="flex flex-col gap-10">

          <!-- 01 -->
          <div class="flex gap-4">
            <div
              class="w-14 h-14 shrink-0 bg-[#0b4a2b] text-white rounded-full flex items-center justify-center text-xl font-bold">
              01</div>
            <div>
              <h3 class="font-bold text-[#0b4a2b] text-[24px]">{{ __('Simplifier') }}</h3>
              <p class="text-gray-600 text-[18px] sm:text-[20px] md:text-2xl">
                {!! __('<strong class="text-gray-700 font-heavy">Un seul interlocuteur</strong> au lieu de cinq ou six.') !!}
              </p>
            </div>
          </div>

          <!-- 03 -->
          <div class="flex gap-4">
            <div
              class="w-14 h-14 shrink-0 bg-[#0b4a2b] text-white rounded-full flex items-center justify-center text-xl font-bold">
              03</div>
            <div>
              <h3 class="font-bold text-[#0b4a2b] text-[24px]">{{ __('Démocratiser') }}</h3>
              <p class="text-gray-600 text-[18px] sm:text-[20px] md:text-2xl">
                {!! __('Du Standard au Prestige, <strong class="text-gray-700 font-heavy">chaque client mérite un travail bien fait.</strong>') !!}
              </p>
            </div>
          </div>

          <!-- 05 -->
          <div class="flex gap-4">
            <div
              class="w-14 h-14 shrink-0 bg-[#0b4a2b] text-white rounded-full flex items-center justify-center text-xl font-bold">
              05</div>
            <div>
              <h3 class="font-bold text-[#0b4a2b] text-[24px]">{{ __('Durer') }}</h3>
              <p class="text-gray-600 text-[18px] sm:text-[20px] md:text-2xl">
                {!! __('Solidité, durabilité, <strong class="text-gray-700 font-heavy">garantie décennale.</strong>') !!}
              </p>
            </div>
          </div>

        </div>

      </div>

    </div>
  </section>

  <!-- ================= NOS DIVISIONS ================= -->
  <section class="relative pt-4 md:pt-24 pb-20 md:pb-36 bg-[#f3f3f3] overflow-hidden">

    <!-- forme "demi-cercle" décoratif parfait -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2
              w-[200vw] sm:w-[150vw] md:w-[900px] aspect-square
              bg-[#e6e6e6] rounded-full">
    </div>

    <!-- image décorative gauche -->
    <img src="{{ asset('aiae-frontend/Images/Gauche.png') }}"
      class="absolute left-0 top-1/2 -translate-y-1/2 w-[30vw] md:w-[40vw] lg:w-[470px]">

    <!-- image décorative droite -->
    <img src="{{ asset('aiae-frontend/Images/Droit.png') }}"
      class="absolute right-0 top-1/2 -translate-y-1/2 w-[30vw] md:w-[40vw] lg:w-[450px]">

    <div class="relative z-10 max-w-[900px] mx-auto text-center px-6">

      <!-- TITRE -->
      <h2 class="text-darkBlue font-bold text-[40px] sm:text-[60px] md:text-[90px] leading-[1.05]">
        {!! __('NOS <span class="text-primary">04</span><br> DIVISIONS') !!}
      </h2>

      <!-- TEXTE -->
      <p
        class="mt-4 sm:mt-6 font-normal text-[10px] min-[400px]:text-xs sm:text-sm md:text-base text-black max-w-[520px] mx-auto leading-relaxed">

        {!! __('AIAE STRUCTURE SON DÉVELOPPEMENT AUTOUR DE<br> <span class="font-heavy">QUATRE DIVISIONS COMPLÉMENTAIRES</span>, ENSEMBLE,<br> ELLES FORMENT UN <span class="font-heavy">ÉCOSYSTÈME INÉDIT SUR LE</span><br> <span class="font-heavy">MARCHÉ OUEST-AFRICAIN.</span>') !!}

      </p>

    </div>

  </section>

  <!-- ================= SECTION DIVISIONS ================= -->
  <section class="py-10 bg-[#f3f3f3]">

    <div class="max-w-[1100px] mx-auto px-6">

      <!-- Ligne 1 -->
      <div class="grid md:grid-cols-[0.8fr_1.2fr] gap-6 md:gap-12 md:items-stretch">

        <img src="{{ asset('aiae-frontend/Images/Constr.png') }}"
          class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center">

        <!-- Texte -->
        <div class="flex flex-col justify-center h-full gap-5 py-4">
          <div>
            <h3 class="text-[#05482C] font-bold text-[25px] md:text-[50px] uppercase tracking-tight mb-2 leading-none">
              {{ __('CONSTRUCTION') }}
            </h3>
            <p class="text-gray-700 leading-relaxed text-[18px] md:text-[26px]">
              {!! __('<strong class="font-heavy text-gray-800 text-[20px] md:text-[26px] block mb-2">Coeur de metier.</strong> <strong class="font-heavy text-gray-800">Conception et réalisation :</strong> résidentiel, tertiaire, industriel, agricole, ouvrages d’art.') !!}
            </p>
          </div>
          <div>
            <span
              class="inline-block bg-[#05482C] text-white px-5 py-1 md:px-6 md:py-1 border-[2px] border-[#00a651] rounded-full text-[14px] md:text-[16px] font-book mt-2 shadow-sm">
              {{ __('Opérationnelle') }}
            </span>
          </div>
        </div>
      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-8 md:my-16"></div>

      <!-- Ligne 2 -->
      <div class="grid md:grid-cols-[1.2fr_0.8fr] gap-6 md:gap-12 md:items-stretch">

        <!-- Texte énergie -->
        <div class="text-right flex flex-col justify-center h-full gap-5 order-2 md:order-1 py-2">
          <div>
            <h3 class="text-[#CC6A00] font-bold text-[25px] md:text-[50px] uppercase tracking-tight mb-2 leading-none">
              {{ __('ÉNERGIE') }}
            </h3>
            <p class="text-gray-700 leading-relaxed text-[18px] md:text-[26px]">
              {!! __('Solutions <strong class="font-heavy text-gray-800">d’autonomie<br> énergétique</strong> pour vos installations.<br> Solaire C&I, systèmes hybrides, sites<br> isolés.') !!}
            </p>
          </div>
          <div>
            <p class="text-gray-600 text-[22px] md:text-[26px] mt-2">
              {!! __('Lancement <span class="font-black text-gray-800">2026</span>') !!}
            </p>
          </div>
        </div>

        <img src="{{ asset('aiae-frontend/Images/solair.png') }}"
          class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center order-first md:order-last">

      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-8 md:my-16"></div>

      <!-- Ligne 3 -->
      <div class="grid md:grid-cols-[0.8fr_1.2fr] gap-6 md:gap-12 md:items-stretch">

        <img src="{{ asset('aiae-frontend/Images/coffre.png') }}"
          class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center">

        <!-- Texte sécurité -->
        <div class="flex flex-col justify-center h-full gap-5 py-4">
          <div>
            <h3 class="text-[#05482C] font-bold text-[25px] md:text-[50px] uppercase tracking-tight mb-6 leading-none">
              {{ __('SÉCURITÉ') }}
            </h3>
            <p class="text-gray-700 leading-relaxed text-[18px] md:text-[26px]">
              {!! __('<strong class="font-heavy text-gray-800">Protection haute performance</strong> pour<br> vos biens et vos personnes. Chambres fortes<br> EN 1143-1, safe rooms, armureries, contrôle<br> d’accès.') !!}
            </p>
          </div>
          <div>
            <p class="text-[#05482C] text-[22px] md:text-[26px] mt-2">
              {{ __('Prochainement') }}
            </p>
          </div>
        </div>

      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-8 md:my-16"></div>

      <!-- Ligne 4 -->
   <div class="grid md:grid-cols-[1.2fr_0.8fr] gap-6 md:gap-12 md:items-stretch">

  <!-- Texte prefabrication -->
  <div class="text-right flex flex-col justify-center h-full gap-5 order-2 md:order-1 py-4">
    <div>
      <h3 class="text-[#CC6A00] font-bold text-[25px] md:text-[50px] uppercase tracking-tight mb-6 leading-none">
        {{ __('PRÉFABRICATION') }}
      </h3>
      <p class="text-gray-700 leading-relaxed text-[18px] md:text-[26px]">
        {!! __('<strong class="font-heavy text-gray-800 text-[20px] md:text-[26px] block mb-2">Production industrielle</strong> d’éléments de<br> construction. BTC, béton précontraint,<br> poutrelles. -15 à -25% sur les coûts.') !!}
      </p>
    </div>
    <div>
      <p class="text-[#CC6A00] text-[22px] md:text-[26px] mt-2">
        {{ __('Prochainement') }}
      </p>
    </div>
  </div>

  <!-- Image -->
  <img src="{{ asset('aiae-frontend/Images/fabrik.png') }}"
    class="rounded-[20px] w-full h-auto object-contain object-center order-first md:order-last self-center">

</div>

    </div>

  </section>

  <!-- ================= ÉQUIPE ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[1200px] mx-auto px-6">

      <!-- BLOC BLEU -->
      <div class="bg-[#111a4a] rounded-[30px] md:rounded-[55px] p-6 sm:p-10 md:p-14 relative overflow-hidden">
        <!-- CONTENU -->
        <div class="relative z-10">

          <!-- TITRE -->
          <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-[54px] font-heavy mb-8 text-white">
            {{ __('Les personnes derrière AIAE') }}
          </h2>

          <div class="grid md:grid-cols-2 gap-6 md:gap-10">

            <!-- CARD 1 : Technique -->
            <div class="rounded-3xl overflow-hidden flex flex-col shadow-md h-full min-h-[200px] md:min-h-[300px]">
              <div class="bg-[#2f376f] text-white p-4 lg:p-5 text-[20px] lg:text-[24px] font-bold">
                {!! __('Direction Technique<br>et Stratégique') !!}
              </div>
              <div class="bg-white p-5 text-[18px] text-gray-700 flex-1 leading-[1.6]">
                {!! __('<strong class="text-gray-700 font-heavy">Spécialiste en génie civil avec plus de 18 ans d’expérience</strong> en conception et dimensionnement de <strong class="text-gray-700 font-heavy">structures complexes</strong>. <strong class="text-gray-700 font-heavy">Enseignant-chercheur</strong> dans plusieurs disciplines du génie civil (ouvrages d’art, structures de chaussées, modélisation aux éléments finis). <strong class="text-gray-700 font-heavy">Formation complémentaire en administration des entreprises.</strong> Fondateur d’AIAE.') !!}
              </div>
            </div>

            <!-- CARD 3 : Générale (Top Right) -->
            <div class="rounded-3xl overflow-hidden flex flex-col shadow-md h-full min-h-[200px] md:min-h-[300px]">
              <div class="bg-[#2f376f] text-white p-4 lg:p-5 text-[20px] lg:text-[24px] font-bold">
                {!! __('Direction Générale<br><span class="hidden md:inline">&nbsp;</span>') !!}
              </div>
              <div class="bg-white p-4 lg:p-5 text-[16px] xl:text-[18px] text-gray-700 flex-1">
                {!! __('En charge de la gestion opérationnelle quotidienne, de la<br> coordination des projets et des relations clients. <strong class="text-gray-700 font-heavy">Expérience en<br> gestion de projets BTP et coordination multi-lots.</strong>') !!}
              </div>
            </div>

            <!-- CARD 2 : Administrative (Bottom Left) -->
            <div class="rounded-3xl overflow-hidden flex flex-col shadow-md h-full min-h-[200px] md:min-h-[300px]">
              <div class="bg-[#2f376f] text-white p-4 lg:p-5 text-[20px] lg:text-[24px] font-bold">
                {!! __('Direction Administrative<br>et Juridique') !!}
              </div>
              <div class="bg-white p-5 text-[18px] text-gray-700 flex-1 ">
                {!! __('<strong class="font-heavy text-gray-700">Représentante légale</strong> de l’entreprise. En charge de la conformité réglementaire, des contrats et de la gestion administrative.') !!}
              </div>
            </div>

            <!-- TEXTE (Bottom Right) -->
            <div
              class="text-white text-[18px] md:text-[24px] leading-[1.8] self-center flex-1 max-w-[420px] md:pl-4 text-center md:text-left mt-6 md:mt-0">
              {!! __('Notre équipe s’appuie<br> également sur <strong class="text-white font-heavy">un réseau de<br> partenaires techniques qualifiés</strong><br> (architectes, géotechniciens,<br> topographes, bureaux de<br> contrôle) <strong class="text-white font-heavy">mobilisés selon les<br> besoins de chaque projet.</strong>') !!}
            </div>

          </div>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION VALEURS ================= -->
 <section class="relative w-full bg-secondary overflow-hidden pt-10 pb-14">

  <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px]">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center text-center lg:text-left">

      <!-- GAUCHE : TEXTE -->
      <div class="text-white lg:ml-20 max-w-xl text-left">

        <h2 class="text-[40px] sm:text-5xl md:text-6xl lg:text-[80px] font-heavy leading-tight mb-4 lg:mb-8">
          {{ __('Nos Valeurs') }}
        </h2>

        <p class="text-[14px] min-[400px]:text-[16px] sm:text-[18px] md:text-xl leading-relaxed opacity-95 font-light">
          {!! __('Ces valeurs constituent l’ADN d’AIAE. Elles<br> ne sont pas négociables, quelles que soient<br> les circonstances.') !!}
        </p>

      </div>

      <!-- DROITE : BLOC VALEURS -->
      <div class="relative lg:mr-20 flex justify-center lg:justify-end pb-6">
        <div class="relative w-[350px] sm:w-[420px] max-w-full">

          <!-- CARTE -->
          <div class="bg-[#C17520] rounded-2xl px-10 py-10 flex flex-col gap-5"
            style="box-shadow: 6px 12px 30px rgba(0,0,0,0.5);">

            <div class="flex items-center gap-3 text-white font-heavy text-[15px] sm:text-[16px]">
              <span class="w-2 h-2 bg-white rounded-full shrink-0"></span>
              <span>{!! __('La Qualité Est Primordiale') !!}</span>
            </div>

            <div class="flex items-center gap-3 text-white font-heavy text-[15px] sm:text-[16px]">
              <span class="w-2 h-2 bg-white rounded-full shrink-0"></span>
              <span>{!! __('La Parole Donnée Est Sacrée') !!}</span>
            </div>

            <div class="flex items-center gap-3 text-white font-heavy text-[15px] sm:text-[16px]">
              <span class="w-2 h-2 bg-white rounded-full shrink-0"></span>
              <span>{!! __('Honnêteté Envers Les Clients') !!}</span>
            </div>

            <div class="flex items-center gap-3 text-white font-heavy text-[15px] sm:text-[16px]">
              <span class="w-2 h-2 bg-white rounded-full shrink-0"></span>
              <span>{!! __('Respect Des Équipes') !!}</span>
            </div>

            <div class="flex items-center gap-3 text-white font-heavy text-[15px] sm:text-[16px]">
              <span class="w-2 h-2 bg-white rounded-full shrink-0"></span>
              <span>{!! __('Respect Des Délais Et Des Coûts') !!}</span>
            </div>

          </div>

        </div>
      </div>

    </div>

  </div>

</section>


  <div class="relative">
    <!-- SHAPE -->
    <img src="{{ asset('aiae-frontend/Images/chap.png') }}"
      class="absolute right-0 bottom-[-20px] lg:bottom-[-40px] w-[100px] sm:w-[150px] lg:w-[320px] z-30 pointer-events-none">
    <!-- ================= SECTION VALEURS DETAILS ================= -->
    <section class="bg-[#f3f3f3] py-20 relative z-10 overflow-hidden lg:overflow-visible">

      <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px]">

        <div class="grid md:grid-cols-2 gap-x-20 gap-y-14">

          <!-- 01 -->
          <div class="flex gap-6">

            <div
              class="flex items-center justify-center w-16 h-16 rounded-full bg-secondary font-heavy text-white font-bold text-[30px] shrink-0">
              01
            </div>

            <div>
              <h3 class="text-secondary font-bold text-[27px] mb-2">
                {!! __('LA QUALITÉ EST<br> PRIMORDIALE') !!}
              </h3>

              <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed">
                {!! __('Nous ne construisons pas pour aujourd’hui, <strong class="font-heavy">nous construisons pour des générations.</strong>') !!}
              </p>
            </div>

          </div>


          <!-- 02 -->
          <div class="flex gap-6">

            <div
              class="flex items-center justify-center w-16 h-16 rounded-full bg-secondary font-heavy text-white font-bold text-[30px] shrink-0">
              02
            </div>

            <div>
              <h3 class="text-secondary font-bold text-[27px] mb-2">
                {!! __('LA PAROLE DONNÉE EST<br> SACRÉE') !!}
              </h3>

              <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed">
                {!! __('<strong class="font-heavy">Un engagement pris est un engagement tenu.</strong> Sans exception.') !!}
              </p>
            </div>

          </div>


          <!-- 03 -->
          <div class="flex gap-6">

            <div
              class="flex items-center justify-center w-16 h-16 rounded-full bg-secondary font-heavy text-white font-bold text-[30px] shrink-0">
              03
            </div>

            <div>
              <h3 class="text-secondary font-bold text-[27px] mb-2">
                {!! __('HONNÊTETÉ ENVERS<br> LES CLIENTS') !!}
              </h3>

              <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed">
                {!! __('<strong class="font-heavy">Un client bien informé</strong> est un client satisfait.') !!}
              </p>
            </div>

          </div>


          <!-- 04 -->
          <div class="flex gap-6">

            <div
              class="flex items-center justify-center w-16 h-16 rounded-full bg-secondary font-heavy text-white font-bold text-[30px] shrink-0">
              04
            </div>

            <div>
              <h3 class="text-secondary font-bold text-[27px] mb-2">
                {{ __('RESPECT DES ÉQUIPES') }}
              </h3>

              <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed">
                {!! __('La qualité dépend du <strong class="font-heavy">respect accordé à ceux qui réalisent.</strong>') !!}
              </p>
            </div>

          </div>


          <!-- 05 -->
          <div class="flex gap-6">

            <div
              class="flex items-center justify-center w-16 h-16 rounded-full bg-secondary font-heavy text-white font-bold text-[30px] shrink-0">
              05
            </div>

            <div>
              <h3 class="text-secondary font-bold text-[27px] mb-2">
                {!! __('RESPECT DES DÉLAIS<br> ET DES COÛTS') !!}
              </h3>

              <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed">
                {!! __('<strong class="font-heavy">Un projet en retard ou hors budget est un échec</strong>, même s’il est techniquement parfait.') !!}
              </p>
            </div>

          </div>

        </div>

      </div>

    </section>
  </div>

  <!-- ================= SECTION CTA ================= -->
  <section class="bg-[#e5e5e5] py-10 relative z-20">
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
        <a onclick="openRdvModal('physique')" class="bg-primary text-white px-10 py-5 text-center font-heavy">
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
            {{ __('Suivez nous,') }} <strong class="font-heavy text-gray-300">{{ __('Abonnez vous') }}</strong>
            {{ __('&') }}
            <strong class="font-heavy text-gray-300">{{ __('Likez nos post') }}</strong>
          </p>
        </div>
      </div>
    </div>

    <!-- BARRE CLAIRE -->
    <div class="bg-[#e6e6e6] py-6">
      <div
        class="max-w-7xl mx-auto px-6 flex flex-row items-center justify-center gap-4 md:gap-8 text-[#0b4a2b] text-center md:text-left">
        <!-- WhatsApp Icon -->
        <img src="{{ asset('aiae-frontend/Images/WhatsappLogo.svg') }}" alt=""
          class="h-10 w-10 md:h-12 md:w-12 shrink-0" />

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

          <img src="{{ asset('aiae-frontend/Images/logos/LOGO AIAE FINAL - Copie.png') }}" class="w-80 pb-5"
            alt="AIAE Logo">

          <p class="text-black font-light text-[18px] md:text-[27px] leading-relaxed max-w-lg">
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

            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Construction') }}</a>
            </li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Énergie') }}</a></li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Sécurité') }}</a></li>
            <li><a href="{{ route('divisions') }}" class="hover:text-darkBlue transition">{{ __('Préfabrication') }}</a>
            </li>

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
              <a href="javascript:void(0)" onclick="openRdvModal('physique')"
                class="hover:text-darkBlue transition cursor-pointer">
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
  </script>
  @include('frontend.partials.rdv-modal')
</body>

</html>