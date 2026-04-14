<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AIAE</title>
  <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole AIAE FINAL.png') }}">
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
          },
          fontWeight: {
            light: "300",
            book: "400",
            normal: "400",
            medium: "500",
            bold: "700",
            heavy: "800",
            extrabold: "800",
            black: "900",
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
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdBook.otf') }}");
      font-weight: 400;
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
      font-weight: 800;
    }

    @font-face {
      font-family: "Futura";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdExtraBold.otf') }}");
      font-weight: 900;
    }

    /* Condensed Family */
    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensedLight.otf') }}");
      font-weight: 300;
    }

    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensed.otf') }}");
      font-weight: 400;
    }

    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensedBold.otf') }}");
      font-weight: 700;
    }

    @font-face {
      font-family: "Futura Condensed";
      src: url("{{ asset('aiae-frontend/fonts/FuturaStdCondensedExtraBd.otf') }}");
      font-weight: 800;
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

  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @include('frontend.partials.navbar')

  <!-- ================= HERO ================= -->
  <section class="relative px-1 sm:px-1 pt-1">
    <div class="relative max-w-[1600px] mx-auto rounded-[15px] overflow-hidden shadow-2xl">
      <img id="heroImage" src="{{ asset('aiae-frontend/Images/home.png') }}" class="w-full h-[75vh] md:h-[90vh] object-cover" />

      <!-- overlay -->
      <div class="absolute inset-0 bg-black/40"></div>

      <!-- contenu -->
      <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 px-6 sm:px-10 md:px-16 max-w-7xl text-white drop-shadow-xl font-futura">
        <!-- TITRE -->
        <h1 class="text-[22px] sm:text-3xl md:text-4xl lg:text-[44px] font-heavy mb-3 sm:mb-6 leading-tight lg:leading-[1.1]">
          {{ __('De La Conception À La Réalisation') }}
        </h1>

        <!-- TEXTE -->
        <p class="text-sm sm:text-base md:text-lg lg:text-xl font-light leading-relaxed mb-4 sm:mb-8 max-w-xl">
          <span class="whitespace-normal sm:whitespace-nowrap font-medium">{{ __('Construction, énergie solaire, sécurité haute performance et préfabrication industrielle :') }}</span><br class="hidden sm:block" />
          {!! __('AIAE réunit toutes les compétences pour <span class="font-medium">mener votre projet de A à Z.</span>') !!}
          <br class="hidden sm:block" /><br class="hidden sm:block" />
          <span class="font-medium">
            {{ __('Un interlocuteur unique, des engagements tenus.') }}
          </span>
        </p>

        <!-- BOUTONS -->
        <div class="flex flex-col lg:flex-row items-center justify-between gap-3 sm:gap-4 lg:gap-0 w-full mt-6 sm:mt-10 lg:mt-16">
          <!-- BOUTON GAUCHE -->
          <div onclick="openRdvModal('physique')" class="flex items-center bg-primary rounded-full shadow-lg p-1 w-full lg:w-fit cursor-pointer hover:opacity-90 transition">
            <span class="px-4 py-1.5 sm:px-6 sm:py-2 text-white whitespace-normal sm:whitespace-nowrap flex-1 text-center lg:text-left font-light text-xs sm:text-base">
              {{ __('Prendre rendez-vous maintenant') }}
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-6 w-6 sm:h-7 sm:w-7" />
          </div>

          <!-- BOUTON MILIEU -->
          <div class="flex items-center bg-secondary rounded-full shadow-lg p-1 w-full lg:w-fit">
            <span class="px-4 py-1.5 sm:px-6 sm:py-2 text-white whitespace-normal sm:whitespace-nowrap flex-1 text-center lg:text-left font-light text-xs sm:text-base">
              {{ __('Demander un devis gratuit') }}
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-6 w-6 sm:h-7 sm:w-7" />
          </div>

          <!-- TEXTE DROITE -->
          <div class="flex items-start text-white w-full lg:w-fit lg:justify-end drop-shadow-xl mt-4 lg:mt-0">
            <img src="{{ asset('aiae-frontend/Images/Arrow4Expertises.svg') }}" class="h-8 w-8 sm:h-9 sm:w-9 mt-[4px] sm:mt-[6px] mr-3 shrink-0" />
            <p class="text-base sm:text-lg md:text-xl font-medium leading-[1.1] md:leading-[1.2]">
              {!! __('Un partenaire. Quatre<br />expertises. Zéro compromis.') !!}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= PANNEAU SIMULATEUR ================= -->
  <section class="relative -mt-20 md:-mt-20 z-10 px-2 sm:px-4">
    <div
      class="w-full max-w-[95%] sm:max-w-[640px] md:max-w-[820px] lg:max-w-[1000px] xl:max-w-[1240px] 2xl:max-w-[1360px] mx-auto bg-glass backdrop-blur-xl rounded-2xl shadow-xl p-4 sm:p-5">
      <!-- Onglets -->
      <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-2 mb-4" id="categoryButtons">
        <div class="flex flex-wrap gap-2">
          <button data-img="{{ asset('aiae-frontend/Images/home.png') }}" data-secteur="residentiel" class="tabBtn px-3 py-2 rounded-lg bg-white text-xs sm:text-sm shadow">
            {{ __('Résidentiel') }}
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/home.png') }}" data-secteur="tertiaire" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            {{ __('Tertiaire') }}
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/home.png') }}" data-secteur="industriel" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            {{ __('Industriel') }}
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/home.png') }}" data-secteur="agricole" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            {{ __('Agricole') }}
          </button>
        </div>

        <button onclick="window.location.href='{{ route('energie.calculator') }}'" class="w-full sm:w-auto sm:ml-auto px-4 py-2 bg-secondary text-white rounded-lg text-xs sm:text-sm">
          {{ __('Calculateur Énergies') }}
        </button>
      </div>

      <!-- Formulaire -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3">
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <img src="{{ asset('aiae-frontend/Images/PencilSimpleLine.png') }}" class="absolute left-3 top-1/2 -translate-y-1/2 w-[16px] opacity-70" />
          <input id="surfaceDispo" class="w-full h-10 pl-9 pr-3 rounded-lg text-xs sm:text-sm" placeholder="{{ __('Surface Disponible (m²)') }}" />
        </div>

        <!-- Surface Bâtie -->
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <img src="{{ asset('aiae-frontend/Images/PencilSimpleLine.png') }}" class="absolute left-3 top-1/2 -translate-y-1/2 w-[16px] opacity-70" />
          <input id="surfaceBatie" class="w-full h-10 pl-9 pr-3 rounded-lg text-xs sm:text-sm"
            placeholder="{{ __('Surface Bâtie Souhaitée (m²)') }}" />
        </div>

        <!-- CONFIGURATION -->
        <div class="relative col-span-1 sm:col-span-2 md:col-span-2">
          <button id="openConfig"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            {{ __('Configuration') }}
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="configPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-2 z-20">
            <label class="flex justify-between items-center text-xs sm:text-sm">
              {{ __('Espaces Communs') }} <input type="checkbox" id="checkEspaces" />
            </label>

            <div class="flex justify-between items-center text-xs sm:text-sm">
              {{ __('Salles De Bain') }}
              <div class="flex items-center gap-2">
                <button class="minusBath bg-gray-200 rounded-full w-6 h-6">
                  -
                </button>
                <span id="bathCount">1</span>
                <button class="plusBath bg-gray-200 rounded-full w-6 h-6">
                  +
                </button>
              </div>
            </div>

            <div class="flex justify-between items-center text-xs sm:text-sm">
              {{ __('Chambres') }}
              <div class="flex items-center gap-2">
                <button class="minusBed bg-gray-200 rounded-full w-6 h-6">
                  -
                </button>
                <span id="bedCount">1</span>
                <button class="plusBed bg-gray-200 rounded-full w-6 h-6">
                  +
                </button>
              </div>
            </div>

            <button class="w-full bg-primary text-white rounded-lg py-2 text-xs sm:text-sm">
              {{ __('Valider') }}
            </button>
          </div>
        </div>

        <!-- STANDING -->
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <button id="openStand"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            {{ __('Standing') }}
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="standPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-1 z-20">
            <button data-value="prestige" class="standOption block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              {{ __('Prestige') }}
            </button>
            <button data-value="premium" class="standOption block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              {{ __('Premium') }}
            </button>
            <button data-value="confort" class="standOption block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1 bg-gray-100">
              {{ __('Confort') }}
            </button>
            <button data-value="standard" class="standOption block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              {{ __('Standard') }}
            </button>
          </div>
        </div>

        <!-- OPTIONS -->
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <button id="openOptions"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            {{ __('Options') }}
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="optionsPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-2 z-20">
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Forage') }} <input type="checkbox" id="checkForage" /></label>
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Clôture') }} <input type="checkbox" id="checkCloture" /></label>
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Aménagement Paysager') }} <input
                type="checkbox" id="checkPaysage" /></label>
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Domotique') }} <input type="checkbox" id="checkDomotique" /></label>
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Solaire') }} <input type="checkbox" id="checkSolaire" /></label>
            <label class="flex justify-between text-xs sm:text-sm">{{ __('Piscine') }} <input type="checkbox" id="checkPiscine" /></label>

            <button class="w-full bg-primary text-white rounded-lg py-2 text-xs sm:text-sm">
              {{ __('Valider') }}
            </button>
          </div>
        </div>

        <!-- BOUTON FINAL -->
        <button
          onclick="startSimulation()"
          class="col-span-1 sm:col-span-2 md:col-span-2 w-full h-10 px-4 flex items-center justify-center bg-primary text-white rounded-lg text-xs sm:text-sm hover:bg-opacity-90">
          {{ __('Poursuivre La Simulation') }}
        </button>

      </div>
    </div>
  </section>

  <!-- ================= SECTION QUI SOMMES NOUS ================= -->
  <section class="relative pt-20 pb-12">

    <!-- fond bleu -->
    <div class="absolute bottom-0 left-0 w-full h-[480px] bg-darkBlue"></div>

    <div class="relative max-w-[1200px] mx-auto px-6">

      <!-- CARTE GRISE -->
      <div class="bg-[#f2f2f2] rounded-xl shadow-[0_30px_70px_rgba(0,0,0,0.35)] p-12 relative z-10">

        <div class="grid md:grid-cols-2 gap-10 items-start">

          <!-- TEXTE -->
          <div>
            <h2 class="text-darkBlue font-extrabold text-2xl md:text-[32px] tracking-tight mb-6">
              QUI SOMMES-NOUS ?
            </h2>

            <p class="text-[24px] text-darkBlue leading-relaxed mb-6 font-light">
              AIAE (<span class="font-medium text-darkBlue">Afrika Infrastructures And Equipements</span>) est<br> une entreprise togolaise 
              <span class="font-medium text-darkBlue">fondée par des<br> experts avec plus de 18 ans d'expérience en<br> génie civil</span>, 
              avec une ambition claire :<br> <span class="font-medium text-darkBlue">transformer le secteur de la construction en<br> Afrique de l'Ouest</span>.
            </p>

            <p class="text-[18px] text-darkBlue leading-relaxed mb-6 font-book">
              Face à un marché où le client doit coordonner lui-même architecte, bureau d'études, constructeur et installateurs,<br> 
              <span class="font-medium text-primary">AIAE propose un modèle intégré : de la conception<br> jusqu'à la remise des clés, en passant par l'autonomie<br> énergétique et la sécurisation des installations</span>
            </p>

            <button class="bg-primary text-white px-6 py-2.5 rounded-lg flex items-center gap-3 hover:bg-opacity-90 transition-all font-book">
              En savoir plus sur nous
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>

            <p class="mt-8 text-darkBlue font-light text-[17px]">
              Cliquez <a href="{{ route('simulator.v1') }}" class="font-heavy underline text-darkBlue hover:opacity-80 transition-opacity">Simulation</a> & simulez votre projet en 2 minutes !
            </p>
          </div>

          <!-- IMAGES -->
          <div class="space-y-4 flex flex-col items-center md:items-end w-full">
            
            <!-- EXPERTISE -->
            <div class="relative w-full max-w-[460px] rounded-lg overflow-hidden flex items-center justify-center">
              <img src="{{ asset('aiae-frontend/Images/fExpertise.png') }}" class="w-full h-auto object-contain" alt="Expertise" />
              <div class="absolute inset-0 flex flex-col justify-center pl-[13%] pr-[30%] text-white">
                <h4 class="font-extrabold text-[4vw] min-[400px]:text-[18px] sm:text-[20px] md:text-[22px] mb-[2px] leading-none drop-shadow-sm">{{ __('EXPERTISE :') }}</h4>
                <p class="font-book text-gray-200 text-[3vw] min-[400px]:text-[14px] sm:text-[15px] md:text-[18px] leading-[1.2] drop-shadow-sm">
                  {!! __('+15 ans d\'expertise<br>en génie civil') !!}
                </p>
              </div>
            </div>

            <!-- SIÈGE -->
            <div class="relative w-full max-w-[460px] rounded-lg overflow-hidden flex items-center justify-center">
              <img src="{{ asset('aiae-frontend/Images/fSiège.png') }}" class="w-full h-auto object-contain" alt="Siège" />
              <div class="absolute inset-0 flex flex-col justify-center pl-[13%] pr-[30%] text-white">
                <h4 class="font-extrabold text-[4vw] min-[400px]:text-[18px] sm:text-[20px] md:text-[22px] mb-[2px] leading-none drop-shadow-sm">{{ __('SIÈGE :') }}</h4>
                <p class="font-book text-gray-200 text-[3vw] min-[400px]:text-[14px] sm:text-[15px] md:text-[18px] leading-[1.2] drop-shadow-sm">
                  {!! __('Lomé, Togo,<br>Interventions sur<br>tout le territoire') !!}
                </p>
              </div>
            </div>

            <!-- MODÈLE -->
            <div class="relative w-full max-w-[460px] rounded-lg overflow-hidden flex items-center justify-center">
              <img src="{{ asset('aiae-frontend/Images/fAmbition.png') }}" class="w-full h-auto object-contain" alt="Modèle" />
              <div class="absolute inset-0 flex flex-col justify-center pl-[13%] pr-[30%] text-white">
                <h4 class="font-extrabold text-[4vw] min-[400px]:text-[18px] sm:text-[20px] md:text-[22px] mb-[2px] leading-none drop-shadow-sm">{{ __('MODÈLE :') }}</h4>
                <p class="font-book text-gray-200 text-[3vw] min-[400px]:text-[14px] sm:text-[15px] md:text-[17px] leading-[1.2] drop-shadow-sm">
                  {!! __('4 divisions intégrées,<br>sans équivalent en<br>Afrique de l\'Ouest') !!}
                </p>
              </div>
            </div>

          </div>

        </div>

      </div>

      <!-- STATS (EN DEHORS DE LA CARTE) -->
      <div class="relative z-20 mt-5">
        <div class="grid grid-cols-2 md:grid-cols-4 text-center text-white gap-6">

          <div>
            <p class="text-5xl font-heavy">+18</p>
            <p class="text-2xl mt-1 leading-tight">Années<br> d'expertise</p>
          </div>

          <div>
            <p class="text-5xl font-heavy">04</p>
            <p class="text-2xl mt-1 leading-tight">Divisions<br> complémentaires</p>
          </div>

          <div>
            <p class="text-5xl font-heavy">05</p>
            <p class="text-2xl mt-1 leading-tight">Zones<br> d’intervention</p>
          </div>

          <div>
            <p class="text-5xl font-heavy">04</p>
            <p class="text-2xl mt-1 leading-tight">Niveaux<br> de standing</p>
          </div>

        </div>
      </div>

    </div>
  </section>

  <!-- ================= SECTION CIBLES ================= -->
  <section class="relative pt-16 bg-[#f2f2f2] overflow-hidden">
    <!-- forme décorative -->
    <div class="absolute -top-32 -left-32 w-[720px] h-[720px] bg-gray-200 rounded-full opacity-70"></div>

    <div class="relative max-w-[1200px] mx-auto px-6">
      <!-- Titre -->
      <h2 class="text-darkBlue font-extrabold text-2xl md:text-3xl mb-8">
        À QUI S'ADRESSE AIAE ?
      </h2>

      <!-- GRID -->
      <div class="grid grid-cols-1 sm:grid-cols-2 rounded-2xl overflow-hidden shadow-2xl">
        
        <!-- PARTICULIERS -->
        <div class="relative group h-64 sm:h-[350px] md:h-[450px] overflow-hidden">
          <img src="{{ asset('aiae-frontend/Images/nParticuliers.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Particuliers & Familles" />
          <div class="absolute inset-x-0 bottom-0 p-4 sm:p-6 md:p-8 flex items-end justify-between z-10 w-full overflow-hidden gap-2">
            <div class="flex-shrink pr-2">
              <h3 class="text-white font-heavy text-[4vw] min-[400px]:text-[22px] sm:text-[28px] md:text-[36px] uppercase leading-none mb-1 sm:mb-2 drop-shadow-lg truncate ...">
                {{ __('PARTICULIERS & FAMILLES') }}
              </h3>
              <p class="text-white font-book text-[2.5vw] min-[400px]:text-[12px] sm:text-[15px] md:text-[18px] leading-tight drop-shadow-md">
                {{ __('Vous souhaitez construire votre résidence au Togo avec un partenaire fiable.') }}
              </p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white/10 hover:bg-white/30 backdrop-blur-sm text-white text-[7px] sm:text-[8px] md:text-[10px] font-bold px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 rounded-full border border-white/50 transition-all uppercase tracking-wider shrink-0 mr-2 sm:mr-4 hover:scale-105 drop-shadow-lg">
              {{ __('CONTACTEZ-NOUS') }}
            </a>
          </div>
        </div>

        <!-- DIASPORA -->
        <div class="relative group h-64 sm:h-[350px] md:h-[450px] overflow-hidden">
          <img src="{{ asset('aiae-frontend/Images/nDiaspora.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Diaspora Togolaise" />
          <div class="absolute inset-x-0 bottom-0 p-4 sm:p-6 md:p-8 flex items-end justify-between z-10 w-full overflow-hidden gap-2">
            <div class="flex-shrink pr-2">
              <h3 class="text-white font-heavy text-[4vw] min-[400px]:text-[22px] sm:text-[28px] md:text-[36px] uppercase leading-none mb-1 sm:mb-2 drop-shadow-lg truncate ...">
                {{ __('DIASPORA TOGOLAISE') }}
              </h3>
              <p class="text-white font-book text-[2.5vw] min-[400px]:text-[12px] sm:text-[15px] md:text-[18px] leading-tight drop-shadow-md">
                {{ __('Vous vivez à l\'étranger et voulez construire à distance en toute confiance.') }}
              </p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white/10 hover:bg-white/30 backdrop-blur-sm text-white text-[7px] sm:text-[8px] md:text-[10px] font-bold px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 rounded-full border border-white/50 transition-all uppercase tracking-wider shrink-0 mr-2 sm:mr-4 hover:scale-105 drop-shadow-lg">
              {{ __('CONTACTEZ-NOUS') }}
            </a>
          </div>
        </div>

        <!-- ENTREPRISES -->
        <div class="relative group h-64 sm:h-[350px] md:h-[450px] overflow-hidden">
          <img src="{{ asset('aiae-frontend/Images/nEntreprises.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Entreprises & PME" />
          <div class="absolute inset-x-0 bottom-0 p-4 sm:p-6 md:p-8 flex items-end justify-between z-10 w-full overflow-hidden gap-2">
            <div class="flex-shrink pr-2">
              <h3 class="text-white font-heavy text-[4vw] min-[400px]:text-[22px] sm:text-[28px] md:text-[36px] uppercase leading-none mb-1 sm:mb-2 drop-shadow-lg truncate ...">
                {{ __('ENTREPRISES & PME') }}
              </h3>
              <p class="text-white font-book text-[2.5vw] min-[400px]:text-[12px] sm:text-[15px] md:text-[18px] leading-tight drop-shadow-md">
                {{ __('Vous cherchez l\'autonomie énergétique ou des locaux professionnels.') }}
              </p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white/10 hover:bg-white/30 backdrop-blur-sm text-white text-[7px] sm:text-[8px] md:text-[10px] font-bold px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 rounded-full border border-white/50 transition-all uppercase tracking-wider shrink-0 mb-1 hover:scale-105 drop-shadow-lg">
              {{ __('CONTACTEZ-NOUS') }}
            </a>
          </div>
        </div>

        <!-- INSTITUTIONS -->
        <div class="relative group h-64 sm:h-[350px] md:h-[450px] overflow-hidden">
          <img src="{{ asset('aiae-frontend/Images/nInstitutions.png') }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="Institutions & Administrations" />
          <div class="absolute inset-x-0 bottom-0 p-4 sm:p-6 md:p-8 flex items-end justify-between z-10 w-full overflow-hidden gap-2">
            <div class="flex-shrink pr-2">
              <h3 class="text-white font-heavy text-[4vw] min-[400px]:text-[22px] sm:text-[28px] md:text-[36px] uppercase leading-none mb-1 sm:mb-2 drop-shadow-lg">
                {!! __('INSTITUTIONS &<br>ADMINISTRATIONS') !!}
              </h3>
              <p class="text-white font-book text-[2.5vw] min-[400px]:text-[12px] sm:text-[15px] md:text-[18px] leading-tight drop-shadow-md">
                {{ __('Vous avez besoin d\'infrastructures sécurisées aux normes internationales.') }}
              </p>
            </div>
            <a href="{{ route('contact') }}" class="bg-white/10 hover:bg-white/30 backdrop-blur-sm text-white text-[7px] sm:text-[8px] md:text-[10px] font-bold px-2 py-1 sm:px-3 sm:py-1.5 md:px-4 md:py-2 rounded-full border border-white/50 transition-all uppercase tracking-wider shrink-0 mb-1 hover:scale-105 drop-shadow-lg">
              {{ __('CONTACTEZ-NOUS') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION NOS DIVISIONS ================= -->
  <section class="relative pt-4 md:pt-24 pb-20 md:pb-36 bg-[#f3f3f3] overflow-hidden">

    <!-- forme "demi-cercle" décoratif parfait -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2
              w-[200vw] sm:w-[150vw] md:w-[900px] aspect-square
              bg-gray-200 rounded-full">
    </div>

    <!-- image décorative gauche -->
    <img src="{{ asset('aiae-frontend/Images/Gauche.png') }}" class="absolute left-0 top-1/2 -translate-y-1/2 w-[30vw] md:w-[40vw] lg:w-[470px]">

    <!-- image décorative droite -->
    <img src="{{ asset('aiae-frontend/Images/Droit.png') }}" class="absolute right-0 top-1/2 -translate-y-1/2 w-[30vw] md:w-[40vw] lg:w-[450px]">

    <div class="relative z-10 max-w-[900px] mx-auto text-center px-6">

      <!-- TITRE -->
      <h2 class="text-darkBlue font-black text-[40px] sm:text-[60px] md:text-[90px] leading-[1.05]">
        NOS <span class="text-primary">04</span><br>
        DIVISIONS
      </h2>

      <!-- TEXTE -->
      <p class="mt-4 sm:mt-2 font-normal text-[10px] min-[400px]:text-xs sm:text-sm md:text-base text-black max-w-[520px] mx-auto leading-relaxed">

        AIAE STRUCTURE SON DÉVELOPPEMENT AUTOUR DE<br>

        <span class="font-heavy">QUATRE DIVISIONS COMPLÉMENTAIRES</span>, ENSEMBLE,<br>

        ELLES FORMENT UN <span class="font-heavy">ÉCOSYSTÈME INÉDIT SUR LE</span><br>

        <span class="font-heavy">MARCHÉ OUEST-AFRICAIN.</span>

      </p>

    </div>

  </section>

  <!-- ================= SECTION DIVISIONS ================= -->
  <section class="py-5 bg-[#f3f3f3]">

    <div class="max-w-[1100px] mx-auto px-6 md:px-12">

      <!-- Ligne 1 -->

      <div class="grid md:grid-cols-[400px_1fr] gap-12 md:items-stretch">

        <img src="{{ asset('aiae-frontend/Images/Construction.png') }}" class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center">

        <!-- Texte -->
        <div class="flex flex-col justify-center">
          <h3 class="text-primary font-extrabold text-[32px] md:text-5xl mb-4 leading-tight">
            CONSTRUCTION
          </h3>

          <p class="text-gray-800 leading-relaxed text-[16px] md:text-[22px] font-book">
            <span class="font-heavy text-gray-900">Notre cœur de métier.</span> Nous concevons et<br class="hidden md:block"> réalisisons des
            <span class="font-heavy text-gray-900">infrastructures durables</span> : villas<br class="hidden md:block"> résidentielles,
            bâtiments commerciaux, ouvrages<br class="hidden md:block"> d’art et infrastructures techniques.
            <span class="font-heavy text-primary">Conception<br class="hidden md:block"> architecturale et structurelle.</span>
            <span class="font-heavy text-gray-900">Construction tous<br class="hidden md:block"> standings (Standard à Prestige).
            Ouvrages<br class="hidden md:block"> d’art</span> <span class="font-heavy text-primary">(ponts, murs de soutènement, etc.)</span>.<br class="hidden md:block">
            <span class="font-heavy text-primary">Réhabilitation et extension</span> <span class="font-heavy text-gray-900">de bâtiments<br class="hidden md:block"> existants.</span>
          </p>

          <p class="text-primary mt-5 text-[18px] md:text-[22px] font-book">
            À partir de <span class="font-black text-lg md:text-xl">330 000 FCFA/m²</span>
          </p>

        </div>

      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-10 relative"></div>

      <!-- Ligne 2 -->
      <div class="grid md:grid-cols-[1fr_400px] gap-12 md:items-stretch flex flex-col">

        <!-- Texte énergie -->
        <div class="md:text-right flex flex-col justify-center order-last md:order-first">
          <h3 class="text-secondary font-black text-[32px] md:text-5xl mb-4 leading-tight">
            ÉNERGIE
          </h3>

          <p class="text-gray-800 leading-relaxed text-[16px] md:text-[22px] font-book">
            Solutions <span class="font-heavy text-gray-900">d’autonomie énergétique</span> pour vos<br class="hidden md:block">
            installations. Nous dimensionnons et installons des<br class="hidden md:block">
            <span class="font-heavy text-gray-900">systèmes solaires adaptés aux besoins des entreprises<br class="hidden md:block">
            et exploitations agricoles</span>. <span class="font-heavy text-secondary">Solaire C&I</span> (commercial et<br class="hidden md:block">
            industriel) pour entreprises et exploitations. <span class="font-heavy text-secondary">Systèmes<br class="hidden md:block">
            hybrides</span> avec stockage par batteries. Solutions pour<br class="hidden md:block">
            <span class="font-heavy text-secondary">sites isolés</span> ou <span class="font-heavy text-secondary">sans raccordement</span>. <span class="font-heavy text-secondary">Maintenance et<br class="hidden md:block">
            optimisation</span> des installations
          </p>

          <p class="mt-5 text-gray-600 text-[18px] md:text-2xl font-book">
            Lancement <span class="font-black text-[18px] md:text-2xl">2026</span>
          </p>
        </div>

        <img src="{{ asset('aiae-frontend/Images/Energie.png') }}" class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center order-first md:order-last">

      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-10"></div>

      <!-- Ligne 3 -->
      <div class="grid md:grid-cols-[400px_1fr] gap-12 md:items-stretch">

        <img src="{{ asset('aiae-frontend/Images/Sécurité.png') }}" class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center">

        <!-- Texte sécurité -->
        <div class="text-left flex flex-col justify-center">
          <h3 class="text-primary font-black text-[32px] md:text-5xl mb-4 leading-tight">
            SÉCURITÉ
          </h3>

          <p class="text-gray-800 leading-relaxed text-[16px] md:text-[22px] font-book">
            <span class="font-heavy text-gray-900">Protection haute performance</span> pour vos biens et vos<br class="hidden md:block">
            personnes. Nous concevons et installons <span class="font-heavy text-gray-900">des solutions<br class="hidden md:block">
            de sécurité physique</span> répondant aux <span class="font-heavy text-gray-900">normes<br class="hidden md:block">
            européennes (EN 1143-1)</span>. <span class="font-heavy text-primary">Chambres fortes</span> et <span class="font-heavy text-primary">coffres<br class="hidden md:block">
            certifiés</span> (banques, entreprises). <span class="font-heavy text-primary">Safe rooms</span>, <span class="font-heavy text-primary">salles de<br class="hidden md:block">
            repli sécurisées</span> pour particuliers ou dirigeants.<br class="hidden md:block">
            <span class="font-heavy text-primary">Armureries</span> et <span class="font-heavy text-primary">locaux de stockage sensible.</span> Systèmes<br class="hidden md:block">
            de <span class="font-heavy text-primary">contrôle d’accès</span>
          </p>

          <p class="mt-5 text-primary text-[18px] md:text-2xl font-book">
            Prochainement
          </p>
        </div>

      </div>

      <!-- Séparateur -->
      <div class="border-t border-gray-300 my-10"></div>

      <!-- Ligne 4 -->
      <div class="grid md:grid-cols-[1fr_400px] gap-12 md:items-stretch flex flex-col">

        <!-- Texte prefabrication -->
        <div class="md:text-right flex flex-col justify-center order-last md:order-first">
          <h3 class="text-secondary font-black text-[32px] md:text-5xl mb-4 leading-tight">
            PRÉFABRICATION
          </h3>

          <p class="text-gray-800 leading-relaxed text-[16px] md:text-[22px] font-book">
            Production industrielle d’éléments de construction pour<br class="hidden md:block">
            <span class="font-heavy text-gray-900">des chantiers plus rapides, plus économiques<br class="hidden md:block">
            (-15 à -25% sur les coûts)</span> et de <span class="font-heavy text-gray-900">meilleure qualité.</span> <span class="font-heavy text-secondary">BTC</span><br class="hidden md:block">
            (briques de terre compressée), <span class="font-heavy text-secondary">matériau écologique</span><br class="hidden md:block">
            local. Éléments en <span class="font-heavy text-secondary">béton précontraint</span> (portées longues,<br class="hidden md:block">
            résistance accrue). <span class="font-heavy text-secondary">Nervures</span> et <span class="font-heavy text-secondary">poutrelles</span> pour<br class="hidden md:block">
            planchers. Éléments pour <span class="font-heavy text-secondary">ponts</span> et <span class="font-heavy text-secondary">ouvrages d’art</span>
          </p>

          <p class="mt-5 text-secondary text-[18px] md:text-2xl font-book">
            Prochainement
          </p>
        </div>

        <img src="{{ asset('aiae-frontend/Images/Préfabrication.png') }}" class="rounded-[20px] w-full h-auto max-h-[300px] md:h-full md:max-h-none object-contain object-center order-first md:order-last">

      </div>

    </div>

  </section>

  <!-- ================= BARRE ACTIONS ================= -->
  <div class="w-full bg-[#e9e9e9] py-4">

    <div class="max-w-[1100px] mx-auto flex flex-col sm:flex-row items-center justify-between px-6 sm:px-16 gap-4">

      <!-- Bouton RDV -->
      <button onclick="openRdvModal('physique')" class="flex items-center justify-center bg-primary rounded-full shadow-lg p-1 w-full sm:w-fit hover:opacity-90 transition">
        <span class="px-6 py-2 text-white text-center font-light">
          Prendre rendez-vous maintenant
        </span>
        <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
      </button>

      <!-- Bouton devis -->
      <button class="flex items-center justify-center bg-secondary rounded-full shadow-lg p-1 w-full sm:w-fit hover:opacity-90 transition">
        <span class="px-6 py-2 text-white text-center font-light">
          Demander un devis gratuit
        </span>
        <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
      </button>

    </div>

  </div>

  <!-- ================= SECTION POURQUOI AIAE ================= -->
  <section class="relative w-full bg-primary overflow-hidden">

    <div class="max-w-[1600px] mx-auto px-8 lg:px-[100px] pt-10">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-center text-center lg:text-left">

        <!-- GAUCHE : TEXTE -->
        <div class="text-white relative flex justify-center lg:justify-end">

          <h2 class="text-[40px] sm:text-5xl md:text-6xl lg:text-[80px] font-heavy leading-[1.1] mb-4 lg:mb-10 text-center lg:text-left lg:translate-x-10 z-10">
            Pourquoi<br>
            Choisir AIAE ?
          </h2>

        </div>

        <!-- DROITE : IMAGE -->
        <div class="relative flex justify-center lg:justify-start">

          <img src="{{ asset('aiae-frontend/Images/Défile.png') }}" alt="bloc glass" class="w-full max-w-[450px]">

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION AVANTAGES ================= -->
  <section class="bg-[#f3f3f3] py-20">

    <div class="max-w-[1200px] mx-auto px-8 ">

      <div class="grid md:grid-cols-2 gap-x-16 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-primary text-white font-heavy text-xl shrink-0 pt-1">
            01
          </div>

          <div>
            <h3 class="text-primary font-extrabold text-2xl mb-2">
              UN INTERLOCUTEUR UNIQUE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Fini la coordination entre architecte, bureau<br class="hidden xl:block">
              d’études, constructeur et installateurs. <span class="font-heavy">AIAE<br class="hidden xl:block">
              prend en charge l’intégralité de votre projet</span>,<br class="hidden xl:block">
              de la première esquisse à la remise des clés.
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-primary text-white font-heavy text-xl shrink-0 pt-1">
            02
          </div>

          <div>
            <h3 class="text-primary font-extrabold text-2xl mb-2">
              EXPERTISE TECHNIQUE AVANCÉE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Forte de plus de 18 ans d’expérience en génie<br class="hidden xl:block">
              civil</span>, AIAE dispose de <span class="font-heavy">compétences rares pour<br class="hidden xl:block">
              traiter des projets complexes</span> : ouvrages d’art,<br class="hidden xl:block">
              béton précontraint, structures spéciales.
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-primary text-white font-heavy text-xl shrink-0 pt-1">
            03
          </div>

          <div>
            <h3 class="text-primary font-extrabold text-2xl mb-2">
              DES ENGAGEMENTS TENUS
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Dans un secteur où la parole ne vaut souvent<br class="hidden xl:block">
              rien, <span class="font-heavy">nous faisons de la fiabilité notre marque<br class="hidden xl:block">
              de fabrique.</span> Délais respectés, budgets<br class="hidden xl:block">
              maîtrisés, qualité garantie.
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-primary text-white font-heavy text-xl shrink-0 pt-1">
            04
          </div>

          <div>
            <h3 class="text-primary font-extrabold text-2xl mb-2">
              TRANSPARENCE TOTALE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Devis détaillés basés sur notre Bordereau<br class="hidden xl:block">
              des Prix Unitaires (BPU)</span>, suivi de chantier<br class="hidden xl:block">
              accessible, facturation claire. <span class="font-heavy">Vous savez<br class="hidden xl:block">
              exactement ce que vous payez et pourquoi.</span>
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-primary text-white font-heavy text-xl shrink-0 pt-1">
            05
          </div>

          <div>
            <h3 class="text-primary font-extrabold text-2xl mb-2">
              SOLUTIONS INTÉGRÉES UNIQUES
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Construction + Énergie + Sécurité : <span class="font-heavy">nous<br class="hidden xl:block">
              pouvons livrer un bâtiment autonome en<br class="hidden xl:block">
              énergie et sécurisé dès la conception.</span> Une<br class="hidden xl:block">
              combinaison rare sur le marché togolais.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col justify-center gap-14">

          <!-- bouton RDV -->
          <button onclick="openRdvModal('physique')" class="flex items-center justify-center bg-primary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Prendre rendez-vous maintenant
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

          <!-- bouton devis -->
          <button class="flex items-center justify-center bg-secondary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Demander un devis gratuit
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION ENGAGEMENTS================= -->
  <section class="relative w-full bg-darkBlue overflow-hidden">

    <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px] pt-10">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-12 items-center text-center lg:text-left">

        <!-- GAUCHE : TEXTE -->
        <div class="text-white relative mx-auto lg:ml-20 max-w-xl">

          <h2 class="text-[40px] sm:text-5xl lg:text-6xl font-heavy leading-tight mb-4 lg:mb-10 text-center lg:text-left">
            Nos<br> Engagements<br> Concrets
          </h2>

        </div>

        <!-- DROITE : IMAGE -->
        <div class="relative lg:mr-20 flex justify-center scale-100 sm:scale-105 md:scale-125 lg:scale-150 transform transition duration-300">

          <img src="{{ asset('aiae-frontend/Images/engagement.png') }}" alt="bloc glass" class="ml-0 lg:ml-20">

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION GARANTIES ================= -->
  <section class="bg-[#f3f3f3] py-20">

    <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px]">

      <div class="grid md:grid-cols-2 gap-x-16 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            01
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              DEVIS GRATUIT DÉTAILLÉ
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Vous recevez un <span class="font-heavy">devis ligne par<br class="hidden xl:block">
              ligne, basé sur notre BPU</span>. Pas de<br class="hidden xl:block">
              mauvaises surprises.
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            02
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              PLANNING CONTRACTUEL
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Les délais sont inscrits au contrat. <span class="font-heavy">En<br class="hidden xl:block">
              cas de retard de notre fait, des<br class="hidden xl:block">
              pénalités s’appliquent.</span>
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            03
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              GARANTIE DÉCENNALE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Conformément à la loi, <span class="font-heavy">nous<br class="hidden xl:block">
              garantissons la solidité de<br class="hidden xl:block">
              l’ouvrage pendant 10 ans.</span>
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            04
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              ASSURANCE RC PRO
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Notre responsabilité</span> civile<br class="hidden xl:block">
              professionnelle <span class="font-heavy">couvre les<br class="hidden xl:block">
              dommages éventuels sur chantier.</span>
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            05
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              PAIEMENT PAR ÉTAPES
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Vous payez au fur et à mesure de<br class="hidden xl:block">
              l’avancement</span>, selon un échéancier<br class="hidden xl:block">
              défini ensemble.
            </p>
          </div>

        </div>


        <!-- 06 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            06
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              CONFIDENTIALITÉ
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Tous nos projets sont traités avec<br class="hidden xl:block">
              discrétion. <span class="font-heavy">Secret professionnel<br class="hidden xl:block">
              contractualisé.</span>
            </p>
          </div>

        </div>


        <!-- 07 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-darkBlue text-white font-heavy text-xl shrink-0 pt-1">
            07
          </div>

          <div>
            <h3 class="text-darkBlue font-extrabold text-2xl mb-2">
              ACCOMPAGNEMENT FINANCEMENT
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Nous pouvons vous orienter dans<br class="hidden xl:block">
              vos démarches de crédit</span> auprès des<br class="hidden xl:block">
              banques partenaires.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col justify-center gap-14">

          <!-- bouton RDV -->
          <button onclick="openRdvModal('physique')" class="flex items-center justify-center bg-primary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Prendre rendez-vous maintenant
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

          <!-- bouton devis -->
          <button class="flex items-center justify-center bg-secondary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Demander un devis gratuit
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION VALEURS ================= -->
  <section class="relative w-full bg-secondary overflow-hidden pt-10">

    <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px]">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center text-center lg:text-left">

        <!-- GAUCHE : TEXTE -->
        <div class="text-white lg:ml-20 max-w-xl text-left">

          <h2 class="text-[40px] sm:text-5xl md:text-6xl lg:text-[80px] font-heavy leading-tight mb-4 lg:mb-8 whitespace-nowrap">
            Nos Valeurs
          </h2>

          <p class="text-[18px] md:text-xl leading-relaxed opacity-95 font-light">
            Ces valeurs constituent l’ADN d’AIAE. Elles<br class="hidden md:block">
            ne sont pas négociables, quelles que soient<br class="hidden md:block">
            les circonstances.
          </p>

        </div>

        <!-- DROITE : BLOC VALEURS -->
        <div class="relative lg:mr-20 flex justify-center lg:justify-end">

          <img src="{{ asset('aiae-frontend/Images/valeurs.png') }}" alt="Valeurs AIAE" class="w-[420px] drop-shadow-2xl">

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION VALEURS DETAILS ================= -->
  <section class="bg-[#f3f3f3] py-20">

    <div class="max-w-[1200px] mx-auto px-8 lg:px-[100px]">

      <div class="grid md:grid-cols-2 gap-x-20 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-secondary text-white font-heavy text-xl shrink-0 pt-1">
            01
          </div>

          <div>
            <h3 class="text-secondary font-extrabold text-2xl mb-2">
              LA QUALITÉ EST<br>
              PRIMORDIALE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Nous ne construisons pas pour<br class="hidden xl:block">
              aujourd’hui, <span class="font-heavy">nous construisons<br class="hidden xl:block">
              pour des générations.</span>
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-secondary text-white font-heavy text-xl shrink-0 pt-1">
            02
          </div>

          <div>
            <h3 class="text-secondary font-extrabold text-2xl mb-2">
              LA PAROLE DONNÉE<br>
              EST SACRÉE
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Un engagement pris est un<br class="hidden xl:block">
              engagement tenu.</span> Sans<br class="hidden xl:block">
              exception.
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-secondary text-white font-heavy text-xl shrink-0 pt-1">
            03
          </div>

          <div>
            <h3 class="text-secondary font-extrabold text-2xl mb-2">
              HONNÊTETÉ ENVERS<br>
              LES CLIENTS
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              Un <span class="font-heavy">client bien informé</span> est<br class="hidden xl:block">
              un client satisfait.
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-secondary text-white font-heavy text-xl shrink-0 pt-1">
            04
          </div>

          <div>
            <h3 class="text-secondary font-extrabold text-2xl mb-2">
              RESPECT DES ÉQUIPES
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              La qualité dépend du <span class="font-heavy">respect<br class="hidden xl:block">
              accordé à ceux qui réalisent.</span>
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-[60px] h-[60px] rounded-full bg-secondary text-white font-heavy text-xl shrink-0 pt-1">
            05
          </div>

          <div>
            <h3 class="text-secondary font-extrabold text-2xl mb-2">
              RESPECT DES DÉLAIS<br>
              ET DES COÛTS
            </h3>

            <p class="text-gray-700 text-[18px] xl:text-[24px] leading-relaxed font-medium">
              <span class="font-heavy">Un projet en retard ou hors<br class="hidden xl:block">
              budget est un échec</span>, même<br class="hidden xl:block">
              s’il est techniquement parfait.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col justify-center gap-14">

          <!-- bouton RDV -->
          <button onclick="openRdvModal('physique')" class="flex items-center justify-center bg-primary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Prendre rendez-vous maintenant
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

          <!-- bouton devis -->
          <button class="flex items-center justify-center bg-secondary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Demander un devis gratuit
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION DIASPORA ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[1200px] mx-auto px-4 md:px-12">

      <!-- Bloc vert -->
      <div class="bg-primary rounded-[30px] p-6 lg:p-12">

        <!-- TITRE -->
        <h2 class="text-[35px] text-white sm:text-5xl md:text-6xl lg:text-[60px] font-heavy leading-tight mb-4">
          Vous vivez à l'étranger ?
        </h2>

        <p class="text-white/90 mb-8 lg:mb-12 text-[18px] lg:text-[24px]">
          Construire au Togo depuis l’étranger, c’est<br> possible et serein avec AIAE.
        </p>


        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Interlocuteur.png') }}" class="w-full h-auto">

            <div class="p-5">
              <h3 class="font-heavy text-primary mb-3 text-[20px] xl:text-2xl">
                Interlocuteur unique francophone
              </h3>

              <p class="text-gray-700 text-[16px] xl:text-[20px]">
                Un chef de projet dédié qui parle votre<br class="hidden xl:block"> langue et comprend vos contraintes de<br class="hidden xl:block"> décalage horaire.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Suivi à distance.png') }}" class="w-full h-auto">

            <div class="p-5">
            <h3 class="font-heavy text-primary mb-3 text-[20px] xl:text-2xl">
                Suivi à distance en temps réel
              </h3>

              <p class="text-gray-700 text-[16px] xl:text-[20px]">
                Rapports photos et vidéos réguliers,<br class="hidden xl:block"> visioconférences de suivi, accès à<br class="hidden xl:block"> l’avancement du
                chantier.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Paiement.png') }}" class="w-full h-auto">

            <div class="p-5">
              <h3 class="font-heavy text-primary mb-3 text-[20px] xl:text-2xl">
                Paiements sécurisés
              </h3>

              <p class="text-gray-700 text-[16px] xl:text-[20px]">
                Virements internationaux vers un<br class="hidden xl:block"> compte bancaire togolais vérifié.<br class="hidden xl:block"> Échéancier clair.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Gestion.png') }}" class="w-full h-auto">

            <div class="p-5">
              <h3 class="font-heavy text-primary mb-3 text-[20px] xl:text-2xl">
                Gestion clé en main
              </h3>

              <p class="text-gray-700 text-[16px] xl:text-[20px]">
                Nous gérons les démarches<br class="hidden xl:block"> administratives locales (permis,<br class="hidden xl:block"> raccordements) pour vous.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Transpaence.png') }}" class="w-full h-auto">

            <div class="p-5">
              <h3 class="font-heavy text-primary mb-3 text-[20px] xl:text-2xl">
                Transparence totale
              </h3>

              <p class="text-gray-700 text-[16px] xl:text-[20px]">
                Devis détaillé, contrat clair<br class="hidden xl:block"> signable devant le notaire au Togo,<br class="hidden xl:block"> aucune mauvaise surprise à
                votre retour.
              </p>
            </div>
          </div>


          <!-- CALL TO ACTION -->
          <div class="flex flex-col justify-center text-white px-6">

            <p class="text-[20px] lg:text-[30px] leading-relaxed mb-6 font-book">
              <strong class="font-heavy">Appelez-nous</strong> ou <strong class="font-heavy">prenez<br class="hidden lg:block"> rendez-vous en visio</strong>
              nous<br class="hidden lg:block"> nous adaptons à votre<br class="hidden lg:block"> fuseau horaire.
            </p>

           <!-- BOUTONS -->
    

          <!-- bouton RDV -->
          <button onclick="openRdvModal('physique')" class="flex items-center justify-center bg-primary border-2 border-white rounded-full shadow-lg p-1 mb-6 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Prendre rendez-vous maintenant
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

          <!-- bouton devis -->
          <button class="flex items-center justify-center bg-secondary rounded-full shadow-lg p-1 w-full sm:w-[350px] hover:opacity-90 transition">
            <span class="px-6 py-2 text-white text-center font-light">
              Demander un devis gratuit
            </span>
            <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" class="h-7 w-7" />
          </button>

   

          </div>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION FAQ ================= -->
  <section class="bg-darkBlue py-10">

    <div class="max-w-[1200px] mx-auto px-12 text-center">

      <!-- TITRE -->
      <h2 class="text-white text-6xl md:text-[70px] font-heavy mb-8">
        Foire Aux Questions
      </h2>

      <!-- TEXTE -->
      <p class="text-white/80 text-[18px] leading-relaxed max-w-2xl mx-auto">
        Trouvez rapidement des réponses aux questions les plus fréquentes
        et contactez-nous pour poser vos questions gratuitement.
      </p>

    </div>

  </section>

  <!-- ================= SECTION QUESTIONS ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[1200px] mx-auto px-6 space-y-4">


      <!-- QUESTION 01 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              01
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Combien coûte la construction d’une maison au Togo ?
            </p>

          </div>

          <!-- ICON -->
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Le coût dépend du standing et de la surface. À titre indicatif, nos prix démarrent à <strong>330 000
            FCFA/m²</strong> pour un standing Standard et peuvent atteindre <strong>1 200 000 FCFA/m²</strong> pour du
          Prestige. Demandez un devis personnalisé gratuit pour une estimation précise.
        </div>

      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              02
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Quels sont les délais de construction ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Une villa standard de 150 m² prend généralement <strong>8 à 12 mois</strong>, selon le standing et les
          finitions. Les délais exacts sont définis ensemble et inscrits au contrat.
        </div>

      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              03
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Je vive à l’étranger, comment suivre mon chantier ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Nous proposons un suivi à distance avec rapports photos/vidéos réguliers et visioconférences selon vos
          disponibilités. Un chef de projet dédié est votre interlocuteur unique.
        </div>

      </details>

      <!-- QUESTION 04 (ouverte par défaut) -->
      <details open class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              04
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Proposez-vous des facilités de paiement ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Oui. Le paiement se fait par étapes, au fur et à mesure de l’avancement des travaux. L’échéancier est défini
          ensemble avant le démarrage du chantier.
        </div>

      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              05
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Intervenez-vous en dehors de Lomé ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Oui. Nous intervenons sur tout le territoire togolais : Grand Lomé, région Maritime, Plateaux, Centrale, Kara
          et Savanes. Un coefficient géographique est appliqué selon la zone.
        </div>

      </details>


      <!-- QUESTION 06 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              06
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Quelles garanties offrez-vous ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Garantie décennale sur la structure, garantie de parfait achèvement (1 an), assurance responsabilité civile
          professionnelle. Tous nos engagements sont contractualisés.
        </div>

      </details>


      <!-- QUESTION 07 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              07
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Puis-je voir des exemples de vos réalisations ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />
        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Par respect pour la confidentialité de nos clients, nous ne publions pas de photos de nos chantiers. Nous
          pouvons cependant vous fournir des références vérifiables sur demande lors d’un rendez-vous.
        </div>

      </details>


      <!-- QUESTION 08 -->
      <details class="group border border-darkBlue rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-darkBlue text-white flex-shrink-0 w-10 h-10 flex items-center justify-center rounded-full text-xl font-bold">
              08
            </span>

            <p class="font-heavy text-2xl text-darkBlue">
              Comment AIAE se compare-t-elle aux grandes entreprises étrangères ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-9 h-9 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-darkBlue font-book text-xl">
          Nous offrons une expertise technique de niveau international avec un ancrage local. Cela signifie :
          réactivité, connaissance approfondie du terrain togolais, et des prix justes sans les surcoûts liés aux
          équipes expatriées. Notre fondateur a été formé aux standards européens tout en maîtrisant parfaitement les
          réalités locales.
        </div>

      </details>

    </div>

  </section>

  <!-- ================= SECTION CTA ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[1400px] mx-auto text-left md:text-center px-6">

      <!-- TITRE -->
      <h2 class="text-black text-4xl md:text-[65px] lg:text-[70px] font-heavy mb-8">
        Prêt À Concrétiser Votre Projet ?
      </h2>

      <!-- TEXTE -->
      <p class="text-black leading-relaxed mb-10 text-[18px] md:text-[24px] font-light">
        Vous êtes un particulier souhaitant construire votre résidence ?
        Une entreprise<br class="hidden md:block"> cherchant l’autonomie énergétique ?
        Une institution nécessitant des infrastructures<br class="hidden md:block"> sécurisées ?
        Nos équipes sont à votre écoute.
      </p>

      <!-- BOUTONS -->
      <div class="flex flex-col md:flex-row justify-center">

        <!-- BOUTON 1 -->
        <a href="#" class="bg-secondary text-white px-10 py-5 text-center font-heavy">

          DEMANDER UN DEVIS GRATUIT
          <span class="block text-sm font-light text-white">
            Réponse sous 48h
          </span>

        </a>

        <!-- BOUTON 2 -->
        <a href="javascript:void(0)" onclick="openRdvModal('physique')" class="bg-primary text-white px-10 py-5 text-center font-heavy cursor-pointer">

          PRENDRE RENDEZ-VOUS
          <span class="block text-sm font-light text-white">
            En personne ou en visio
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
            +228 <span class="font-bold">XX XX XX XX</span>
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

          <img src="{{ asset('aiae-frontend/Images/logos/LOGO AIAE FINAL - Copie.png') }}" class="w-80 pb-5" alt="AIAE Logo">

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
    // changement d'image dans le hero
    const buttons = document.querySelectorAll(".tabBtn");
    const hero = document.getElementById("heroImage");
    let selectedSecteur = "residentiel";

    buttons.forEach((btn) => {
      btn.addEventListener("click", () => {
        hero.src = btn.dataset.img;
        selectedSecteur = btn.dataset.secteur;

        buttons.forEach((b) => {
          b.classList.remove("bg-white", "shadow");
          b.classList.add("bg-glassDark");
        });
        btn.classList.remove("bg-glassDark");
        btn.classList.add("bg-white", "shadow");
      });
    });

    // ---------------- STANDING SELECTION ------------------
    let selectedStanding = "confort";
    const standOptions = document.querySelectorAll(".standOption");
    standOptions.forEach(opt => {
        opt.onclick = (e) => {
            e.stopPropagation();
            selectedStanding = opt.dataset.value;
            standOptions.forEach(o => o.classList.remove("bg-gray-100"));
            opt.classList.add("bg-gray-100");
            standPanel.classList.add("hidden");
            openStand.querySelector(".arrow").classList.remove("rotate-180");
        };
    });

    // ---------------- DROPDOWN LOGIC ------------------
    function togglePanel(button, panel) {
      const isHidden = panel.classList.contains("hidden");
      
      // Close all first
      [configPanel, standPanel, optionsPanel].forEach(p => p.classList.add("hidden"));
      document.querySelectorAll(".arrow").forEach(a => a.classList.remove("rotate-180"));

      if (isHidden) {
        panel.classList.remove("hidden");
        const arrow = button.querySelector(".arrow");
        arrow.classList.add("rotate-180");
      }
    }

    openConfig.onclick = (e) => { e.stopPropagation(); togglePanel(openConfig, configPanel); };
    openStand.onclick = (e) => { e.stopPropagation(); togglePanel(openStand, standPanel); };
    openOptions.onclick = (e) => { e.stopPropagation(); togglePanel(openOptions, optionsPanel); };

    // Prevent panel clicks from closing themselves
    [configPanel, standPanel, optionsPanel].forEach(p => {
        p.onclick = (e) => e.stopPropagation();
    });

    // Clic extérieur pour fermer
    document.addEventListener("click", () => {
      [configPanel, standPanel, optionsPanel].forEach(p => p.classList.add("hidden"));
      document.querySelectorAll(".arrow").forEach(a => a.classList.remove("rotate-180"));
    });

    // Salles de bain counter
    document.querySelector(".plusBath").onclick = () => {
      bathCount.textContent = Number(bathCount.textContent) + 1;
    };
    document.querySelector(".minusBath").onclick = () => {
      if (Number(bathCount.textContent) > 0)
        bathCount.textContent = Number(bathCount.textContent) - 1;
    };

    // Chambres counter
    document.querySelector(".plusBed").onclick = () => {
      bedCount.textContent = Number(bedCount.textContent) + 1;
    };
    document.querySelector(".minusBed").onclick = () => {
      if (Number(bedCount.textContent) > 0)
        bedCount.textContent = Number(bedCount.textContent) - 1;
    };

    // ---------------- START SIMULATION ------------------
    function startSimulation() {
        const params = new URLSearchParams();
        params.append("secteur", selectedSecteur);
        params.append("surface", document.getElementById("surfaceBatie").value || "");
        params.append("surface_terrain", document.getElementById("surfaceDispo").value || "");
        params.append("standing", selectedStanding);
        
        // Configuration
        params.append("espaces_communs", document.getElementById("checkEspaces").checked ? 1 : 0);
        params.append("nb_baths", bathCount.textContent);
        params.append("nb_beds", bedCount.textContent);

        // Options
        const options = [];
        if (document.getElementById("checkForage").checked) options.push("forage");
        if (document.getElementById("checkCloture").checked) options.push("cloture");
        if (document.getElementById("checkPaysage").checked) options.push("paysager");
        if (document.getElementById("checkDomotique").checked) options.push("domotique");
        if (document.getElementById("checkSolaire").checked) options.push("solaire");
        if (document.getElementById("checkPiscine").checked) options.push("piscine");
        
        if (options.length > 0) {
            params.append("options", options.join(","));
        }

        window.location.href = "{{ route('simulator.v1') }}?" + params.toString();
    }
  </script>
  @include('frontend.partials.rdv-modal')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
