<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact - AIAE</title>
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

    /* Country Select Dropdown Styles */
    .country-dropdown {
      position: absolute;
      top: 100%;
      left: 0;
      right: 0;
      background: white;
      border: 1px solid #d1d5db;
      border-top: none;
      border-radius: 0 0 0.75rem 0.75rem;
      z-index: 50;
      max-height: 300px;
      overflow-y: auto;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      display: none;
    }

    .country-dropdown.active {
      display: block;
    }

    .country-item {
      display: flex;
      align-items: center;
      padding: 0.75rem 1rem;
      cursor: pointer;
      transition: background 0.2s;
    }

    .country-item:hover {
      background: #f3f4f6;
    }

    .country-flag {
      width: 24px;
      height: 16px;
      margin-right: 12px;
      object-fit: cover;
      border-radius: 2px;
      box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    /* Custom scrollbar for dropdown */
    .country-dropdown::-webkit-scrollbar {
      width: 8px;
    }
    .country-dropdown::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    .country-dropdown::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }
    .country-dropdown::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
  <script src="{{ asset('aiae-frontend/js/tailwind-config.js') }}"></script>
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @include('frontend.partials.navbar')

  <!-- ================= PETITE SECTION BLANCHE ================= -->
  <section class="w-full bg-[#f4f5f7] pt-24 md:pt-36 pb-4"></section>

  <!-- ================= SECTION HERO ================= -->
  <section class="bg-[#e6e6e6] pt-10 pb-10">
    <div class="max-w-[1000px] mx-auto text-left md:text-center px-6">
      <h1 class="text-[34px] sm:text-[45px] md:text-[70px] font-extrabold text-darkBlue mb-4 leading-tight whitespace-nowrap">
       {!! __('Demandez <span class="text-secondary">Un Devis</span> Gratuit') !!}
      </h1>
      <p class="text-[18px] sm:text-[22px] md:text-[40px] text-[#4a4a4a] font-light leading-snug">
       {!! __('Réponse <strong class="text-darkBlue">personnalisée</strong> sous <strong class="text-darkBlue">48h</strong> ouvrées.') !!}
      </p>
    </div>
  </section>

  <!-- ================= SECTION FORMULAIRE ================= -->
  <section class="bg-[#f4f5f7] py-5 w-full">
    <div class="max-w-[950px] mx-auto px-6">
      <form id="quotationForm" action="{{ route('quotation.request') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Nom complet -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Nom complet') }} <span class="text-red-500">*</span></label>
          <input type="text" name="full_name" aria-label="{{ __('Nom complet') }}" required placeholder="{{ __('Votre nom complet') }}"
            class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-3 outline-none focus:border-secondary text-gray-700 placeholder-gray-400">
        </div>

        <!-- Adresse e-mail -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Adresse e-mail') }} <span class="text-red-500">*</span></label>
          <input type="email" name="email" aria-label="{{ __('Adresse e-mail') }}" required placeholder="{{ __('nomprenom@gmail.com') }}"
            class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-3 outline-none focus:border-secondary text-gray-700 placeholder-gray-400">
        </div>

        <!-- Téléphone -->
        <div class="relative" id="phoneContainer">
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Téléphone') }}</label>
          <div
            class="flex items-center w-full border border-gray-400 rounded-xl px-4 py-3 bg-transparent focus-within:border-secondary overflow-hidden">
            
            <!-- Selected Country Display -->
            <div id="selectedCountry" class="flex items-center gap-2 pr-3 cursor-pointer border-r border-[#d4d4d4] shrink-0">
              <img id="currentFlag" src="https://flagcdn.com/w20/tg.png" alt="TG" class="w-6 h-4 object-contain shadow-sm rounded-sm">
              <span id="dialCodeText" class="text-gray-700 font-medium">+228</span>
              <svg class="w-4 h-4 text-[#4a4a4a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </div>

            <input type="tel" id="phoneInput" aria-label="{{ __('Téléphone') }}" placeholder="90 03 54 16" required
              class="bg-transparent pl-4 w-full outline-none text-gray-700 placeholder-gray-400">
            <input type="hidden" name="phone" id="fullPhone">
          </div>

          <!-- Country Dropdown -->
          <div id="countryDropdown" class="country-dropdown">
            <div class="p-2 sticky top-0 bg-white border-b">
              <input type="text" id="countrySearch" aria-label="{{ __('Rechercher un pays...') }}" placeholder="{{ __('Rechercher un pays...') }}" 
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:border-secondary">
            </div>
            <div id="countryList">
              <!-- JS Populated -->
            </div>
          </div>
        </div>

        <!-- Pays de résidence -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Pays de résidence') }}</label>
          <div class="relative">
            <select id="countryResidenceSelect" name="country_residence" aria-label="{{ __('Pays de résidence') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-400 appearance-none cursor-pointer">
              <option value="" disabled selected>{{ __('Sélectionnez votre pays de résidence') }}</option>
            </select>
            <div
              class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 font-light text-2xl">
              +
            </div>
          </div>
        </div>

        <!-- Type de projet -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Type de projet') }}</label>
          <div class="relative">
            <select id="projectTypeSelect" name="project_type" aria-label="{{ __('Type de projet') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-400 appearance-none cursor-pointer">
              <option value="" disabled selected>{{ __('Sélectionnez le type de projet') }}</option>
              <option value="residentiel">{{ __('Résidentiel (Villas, immeubles)') }}</option>
              <option value="tertiaire">{{ __('Tertiaire (Bureaux, hôtels)') }}</option>
              <option value="industriel">{{ __('Industriel (Usines, entrepôts)') }}</option>
              <option value="agricole">{{ __('Agricole (Élevage, stockage)') }}</option>
            </select>
            <div
              class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 font-light text-2xl">
              +
            </div>
          </div>
        </div>

        <!-- Sélectionnez un délai -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Sélectionnez un délai') }}</label>
          <div class="relative">
            <select name="delay" aria-label="{{ __('Sélectionnez un délai') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-400 appearance-none cursor-pointer">
              <option value="" disabled selected>{{ __('Quel délai souhaitez vous pour finaliser votre projet ? Sélectionnez.') }}
              </option>
              <option value="urgent">{{ __('Urgent') }}</option>
              <option value="3mois">{{ __('Dans les 3 mois') }}</option>
              <option value="6mois">{{ __('Dans les 6 mois') }}</option>
            </select>
            <div
              class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 font-light text-2xl">
              +
            </div>
          </div>
        </div>

        <!-- Votre projet -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Votre projet') }} <span class="text-red-500">*</span></label>
          <textarea rows="4" name="project_description" aria-label="{{ __('Votre projet') }}" required placeholder="{{ __('Décrivez brièvement votre projet...') }}"
            class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-700 placeholder-gray-400 resize-none"></textarea>
        </div>

        <!-- Localisation du projet -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Localisation du projet') }}</label>
          <div class="relative">
            <input type="text" name="location" aria-label="{{ __('Localisation du projet') }}" placeholder="{{ __('Quel est le lieu de votre projet ?') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-700 placeholder-gray-400 pr-12">
          </div>
        </div>

        <!-- Budget estimé -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Budget estimé') }}</label>
          <div class="relative">
            <input type="text" name="budget" aria-label="{{ __('Budget estimé') }}" placeholder="{{ __('Quel budget envisagez-vous ?') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-700 placeholder-gray-400 pr-12">
          </div>
        </div>

        <!-- Comment avez-vous connu AIAE ? -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Comment avez-vous connu AIAE ?') }}</label>
          <div class="relative">
            <select name="source_discovery" aria-label="{{ __('Comment avez-vous connu AIAE ?') }}"
              class="w-full bg-transparent border border-gray-400 rounded-xl px-5 py-4 outline-none focus:border-secondary text-gray-400 appearance-none cursor-pointer">
              <option value="" disabled selected>{{ __('Par quel moyen avez vous entendu parler de nous ? Sélectionnez.') }}
              </option>
              <option value="reseaux">{{ __('Réseaux Sociaux') }}</option>
              <option value="recherche">{{ __('Recherche Google') }}</option>
            </select>
            <div
              class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500 font-light text-2xl">
              +
            </div>
          </div>
        </div>

        <!-- Pièce jointe -->
        <div>
          <label class="block text-[20px] font-heavy text-[#4a4a4a] mb-2">{{ __('Pièce jointe') }}</label>
          <div
            class="relative flex items-center justify-between border border-gray-400 rounded-xl px-5 py-4 bg-transparent cursor-pointer hover:border-secondary focus-within:border-secondary transition-colors overflow-hidden">
            <input type="file" name="attachment" id="file_upload" aria-label="{{ __('Pièce jointe') }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            <span id="file_name_display" class="text-gray-400 pointer-events-none">
              {{ __('Ajoutez vos plans, photos terrain ou croquis (PDF, JPG, PNG).') }} <span
                class="italic text-gray-300">{{ __('Facultatif') }}</span>
            </span>
            <div class="text-[#4a4a4a] pointer-events-none shrink-0 border-l border-gray-400 pl-4 ml-4">
              <!-- Paperclip SVG -->
              <svg class="h-5 w-5 rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
              </svg>
            </div>
          </div>
        </div>

        <!-- Checkbox acceptation -->
        <div class="flex items-start gap-4 mt-8 pb-6">
          <div
            class="relative flex items-center justify-center shrink-0 w-[24px] h-[24px] rounded bg-white border-2 border-[#3a3939] overflow-hidden mt-1 cursor-pointer">
            <input type="checkbox" aria-label="{{ __('Acceptation des données') }}" class="absolute inset-0 opacity-0 cursor-pointer peer" checked>
            <svg class="w-4 h-4 text-[#3a3939] opacity-0 peer-checked:opacity-100 pointer-events-none" fill="none"
              stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
          <p class="text-[20px] md:text-[22px] text-black font-heavy leading-snug">
           {!! __("J'accepte que mes données soient traitées par AIAE SARL<br> dans le cadre de ma demande (voir politique de<br> confidentialité).") !!}
          </p>
        </div>

        <!-- Bouton Envoyer -->
        <div class="pt-4 pb-12">
          <button type="submit"
            class="block w-full bg-[#111736] text-white py-5 rounded-xl font-bold text-[18px] md:text-[20px] tracking-wide hover:bg-darkBlue transition-colors outline-none cursor-pointer">
            {{ __('ENVOYER MA DEMANDE') }}
          </button>
        </div>

      </form>
    </div>
  </section>


  <!-- ================= SECTION COORDONNÉES ================= -->
  <section class="bg-white py-20 w-full">
    <div class="max-w-[1150px] mx-auto px-6 relative">

      <!-- Badge Titre -->
      <div
        class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-full bg-secondary text-white px-10 py-2 rounded-xl text-[22px] md:text-[26px] font-heavy border-2 border-primary z-10 text-center uppercase tracking-wider mb-2">
        {{ __('Nos Coordonnées') }}
      </div>

      <!-- Encadré vert -->
      <div
        class="bg-[#0e4e32] rounded-[24px] pt-12 md:pt-16 pb-12 px-6 sm:px-16 text-white text-[18px] sm:text-[22px] md:text-[26px] shadow-2xl relative">

        <!-- Ligne du haut : Siège/Email VS Tél/WhatsApp -->
        <div class="grid md:grid-cols-2 gap-8 md:gap-4 mb-10 text-left">

          <div class="flex flex-col gap-5 md:pl-10">
            <div class="flex items-start gap-3">
              <img src="{{ asset('aiae-frontend/Images/localisation.png') }}" alt="Localisation" class="w-6 h-8 shrink-0 object-contain mt-1" />
              <p><strong class="font-heavy text-white">{{ __('Siège social :') }}</strong> {{ __('Quartier Kléme Zanguéra Rue Agoe Nyive - Lomé Togo') }}</p>
            </div>
            <div class="flex items-start gap-3">
              <img src="{{ asset('aiae-frontend/Images/mail.png') }}" alt="Email" class="w-7 h-5 shrink-0 object-contain mt-1.5" />
              <p><strong class="font-heavy text-white">{{ __('Email :') }}</strong> contact@aiae.services</p>
            </div>
          </div>

          <div class="flex flex-col gap-5 md:pl-10">
            <div class="flex items-start gap-3">
              <img src="{{ asset('aiae-frontend/Images/telephone.png') }}" alt="Téléphone" class="w-6 h-6 shrink-0 object-contain mt-1" />
              <p><strong class="font-heavy text-white">{{ __('Téléphone :') }}</strong> +228 90 03 54 16</p>
            </div>
            <div class="flex items-start gap-3">
              <img src="{{ asset('aiae-frontend/Images/Whatsapp.png') }}" alt="WhatsApp" class="w-7 h-7 shrink-0 object-contain mt-1" />
              <p><strong class="font-heavy text-white">WhatsApp :</strong> +228 90 03 54 16</p>
            </div>
          </div>

        </div>

        <!-- Ligne du bas : Horaires -->
        <div class="text-left md:text-center font-light leading-[1.8] border-t border-white/20 pt-10">
          <div class="flex items-center justify-start md:justify-center gap-4 mb-6">
            <img src="{{ asset('aiae-frontend/Images/heure.png') }}" alt="Horaires" class="w-7 h-7 object-contain" />
            <h3 class="font-heavy text-[22px] md:text-[24px] tracking-wide">{{ __('Horaires :') }}</h3>
          </div>

          <div class="space-y-2">
            <p><strong class="font-heavy tracking-wide text-white">{{ __('Lundi à Vendredi :') }}</strong> 8h00 — 18h00 (GMT+0)</p>
            <p><strong class="font-heavy tracking-wide text-white">{{ __('Samedi :') }}</strong> 8h00 — 13h00</p>
            <p><strong class="font-heavy tracking-wide text-white">{{ __('Dimanche :') }}</strong> {{ __('Fermé (urgences par téléphone uniquement)') }}</p>
            <p class="pt-2"><strong class="font-heavy tracking-wide text-white">{{ __('Diaspora :') }}</strong> {{ __('RDV en soirée et week-end sur demande (visioconférence)') }}</p>
          </div>
        </div>

      </div>

    </div>
  </section>

  <!-- ================= SECTION CARTE (GOOGLE MAPS) ================= -->
  <section class="bg-white pb-20 w-full">
    <div class="max-w-[1250px] mx-auto px-6">
      <!-- Fond gris avec arrondi comme sur la maquette -->
      <div class="w-full bg-[#f4f5f7] p-3 md:p-4 rounded-[28px]">
        <div class="w-full h-[350px] md:h-[450px] rounded-2xl overflow-hidden">
          <!-- TODO : Remplacer l'URL dans 'src' par votre lien d'intégration Google Maps ('Intégrer une carte' -> src="...") -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3966.2622704545247!2d1.1308490749904325!3d6.229112993759031!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMTMnNDQuOCJOIDHCsDA4JzAwLjMiRQ!5e0!3m2!1sfr!2stg!4v1775841080183!5m2!1sfr!2stg"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION CTA (Prenez Rendez-Vous) ================= -->
  <section class="bg-[#e6e6e6] py-10 w-full font-FuturaStdLight">
    <div class="max-w-[900px] mx-auto text-left md:text-center px-6">

      <h2 class="text-black text-4xl md:text-[55px] font-heavy mb-6 leading-tight">
         {{ __('Prenez Rendez-Vous') }}
      </h2>
      <p class="text-gray-600 leading-relaxed font-light mb-10 text-[16px] md:text-[27px] max-w-[700px] md:mx-auto">
        {{ __('Deux modalités proposées au visiteur') }}
      </p>

      <div class="flex flex-col md:flex-row justify-center w-full max-w-[950px] mx-auto shadow-2xl overflow-hidden rounded-sm">
        <!-- Bouton Orange -->
        <a href="javascript:void(0)" onclick="openRdvModal('physique')" class="flex-1 bg-secondary text-white px-10 py-5 text-center transition-all duration-300 hover:brightness-110 group">
          <span class="block text-[22px] md:text-[28px] font-heavy tracking-wide mb-3 uppercase">
            {{ __('RENDEZ-VOUS SUR PLACE') }}
          </span>
          <span class="block text-[11px] md:text-[15px] text-white/90 leading-relaxed max-w-[320px] mx-auto">
            {{ __('Visitez notre siège à Lomé pour discuter de votre projet.') }}
          </span>
        </a>

        <!-- Bouton Vert -->
        <a href="javascript:void(0)" onclick="openRdvModal('en_ligne')" class="flex-1 bg-primary text-white px-10 py-5 text-center transition-all duration-300 hover:brightness-110 group">
          <span class="block text-[22px] md:text-[28px] font-heavy tracking-wide mb-3 uppercase">
            {{ __('RENDEZ-VOUS EN LIGNE') }}
          </span>
          <span class="block text-[11px] md:text-[15px]  text-white/90 leading-relaxed max-w-[350px] mx-auto">
            {!! __('Pour la diaspora ou contraintes de temps, <span class="font-light">nous<br> proposons des visioconférences.</span>') !!}
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

    // --- Dynamic Country Data & Phone Picker ---
    const countryResidenceSelect = document.getElementById('countryResidenceSelect');
    const countryList = document.getElementById('countryList');
    const countrySearch = document.getElementById('countrySearch');
    const selectedCountry = document.getElementById('selectedCountry');
    const countryDropdown = document.getElementById('countryDropdown');
    const currentFlag = document.getElementById('currentFlag');
    const dialCodeText = document.getElementById('dialCodeText');

    let allCountries = [];

    async function fetchCountries() {
      try {
        // Fetch all countries with specific fields
        const response = await fetch('https://restcountries.com/v3.1/all?fields=name,cca2,idd,flags');
        if (!response.ok) throw new Error('Network response was not ok');
        const data = await response.json();
        
        allCountries = data.map(c => ({
          name: c.name.common,
          iso: c.cca2.toLowerCase(),
          // Correctly format IDD code (root + first suffix)
          code: c.idd.root ? (c.idd.root + (c.idd.suffixes ? c.idd.suffixes[0] : '')) : '',
          flag: c.flags.png || `https://flagcdn.com/w20/${c.cca2.toLowerCase()}.png`
        })).filter(c => c.code !== '').sort((a,b) => a.name.localeCompare(b.name));

        populateSelectors(allCountries);
      } catch (error) {
        console.error('Error fetching countries:', error);
        // Fallback for offline or API issues
        const fallback = [
          { name: 'Togo', iso: 'tg', code: '+228', flag: 'https://flagcdn.com/w20/tg.png' },
          { name: 'Bénin', iso: 'bj', code: '+229', flag: 'https://flagcdn.com/w20/bj.png' },
          { name: 'Côte d\'Ivoire', iso: 'ci', code: '+225', flag: 'https://flagcdn.com/w20/ci.png' },
          { name: 'France', iso: 'fr', code: '+33', flag: 'https://flagcdn.com/w20/fr.png' },
          { name: 'Sénégal', iso: 'sn', code: '+221', flag: 'https://flagcdn.com/w20/sn.png' },
          { name: 'Burkina Faso', iso: 'bf', code: '+226', flag: 'https://flagcdn.com/w20/bf.png' },
          { name: 'Gabon', iso: 'ga', code: '+241', flag: 'https://flagcdn.com/w20/ga.png' },
          { name: 'Cameroun', iso: 'cm', code: '+237', flag: 'https://flagcdn.com/w20/cm.png' }
        ];
        allCountries = fallback;
        populateSelectors(fallback);
      }
    }

    function populateSelectors(countries) {
      if (countryResidenceSelect) {
        countries.forEach(c => {
          const opt = document.createElement('option');
          opt.value = c.name;
          opt.textContent = c.name;
          countryResidenceSelect.appendChild(opt);
        });
      }
      renderCountryList(countries);
    }

    function renderCountryList(countries) {
      if (!countryList) return;
      countryList.innerHTML = '';
      countries.forEach(c => {
        const item = document.createElement('div');
        item.className = 'country-item';
        item.innerHTML = `
          <img src="${c.flag}" alt="${c.iso}" class="country-flag">
          <span class="text-gray-700 font-medium mr-2">${c.code}</span>
          <span class="text-gray-600 text-sm truncate">${c.name}</span>
        `;
        item.onclick = () => {
          if (currentFlag) currentFlag.src = c.flag;
          if (dialCodeText) dialCodeText.textContent = c.code;
          countryDropdown.classList.remove('active');
        };
        countryList.appendChild(item);
      });
    }

    if (selectedCountry && countryDropdown) {
      selectedCountry.onclick = (e) => {
        e.stopPropagation();
        countryDropdown.classList.toggle('active');
        if (countryDropdown.classList.contains('active')) {
          countrySearch.focus();
        }
      };

      document.addEventListener('click', () => {
        countryDropdown.classList.remove('active');
      });

      countryDropdown.onclick = (e) => e.stopPropagation();
    }

    if (countrySearch) {
      countrySearch.oninput = (e) => {
        const term = e.target.value.toLowerCase();
        const filtered = allCountries.filter(c => 
          c.name.toLowerCase().includes(term) || c.code.includes(term)
        );
        renderCountryList(filtered);
      };
    }

    fetchCountries();

    // --- Quotation Form Submission ---
    (function() {
      // Use a self-executing function to avoid scope issues
      const initForm = () => {
        const form = document.getElementById('quotationForm');
        const fileUpload = document.getElementById('file_upload');
        const fileNameDisplay = document.getElementById('file_name_display');

        console.log("Initializing Quotation Form Handler");

        if (fileUpload && fileNameDisplay) {
          fileUpload.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
              const name = this.files[0].name;
              fileNameDisplay.textContent = name;
              fileNameDisplay.classList.remove('text-gray-400');
              fileNameDisplay.classList.add('text-[#FF8400]', 'font-bold');
              console.log("File selected:", name);
            }
          });
        }

        if (form) {
          form.addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log("Form submit triggered");
            
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn.textContent;
            
            // Combine dial code and phone number
            const dialCodeEl = document.getElementById('dialCodeText');
            const phoneInput = document.getElementById('phoneInput');
            const fullPhoneHidden = document.getElementById('fullPhone');
            
            if (dialCodeEl && phoneInput && fullPhoneHidden) {
              fullPhoneHidden.value = dialCodeEl.textContent.trim() + ' ' + phoneInput.value.trim();
            }

            // Disable button and show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'CHARGEMENT...';
            submitBtn.style.opacity = '0.7';

            const formData = new FormData(this);

            try {
              const response = await fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
              });

              const result = await response.json();
              console.log("Server response:", result);

              if (response.ok && result.success) {
                if (typeof Swal !== 'undefined') {
                  Swal.fire({
                    title: 'Succès !',
                    text: result.message,
                    icon: 'success',
                    confirmButtonColor: '#111736',
                    confirmButtonText: 'OK'
                  }).then(() => {
                    form.reset();
                    if (fileNameDisplay) {
                      fileNameDisplay.textContent = 'Ajoutez vos plans, photos terrain ou croquis (PDF, JPG, PNG). Facultatif';
                      fileNameDisplay.classList.replace('text-[#FF8400]', 'text-gray-400');
                      fileNameDisplay.classList.remove('font-bold');
                    }
                  });
                } else {
                  alert(result.message);
                  form.reset();
                }
              } else {
                throw new Error(result.message || 'Une erreur est survenue lors de l\'envoi.');
              }
            } catch (error) {
              console.error('Submission Error:', error);
              if (typeof Swal !== 'undefined') {
                Swal.fire({
                  title: 'Oups...',
                  text: error.message,
                  icon: 'error',
                  confirmButtonColor: '#FF8400'
                });
              } else {
                alert('Erreur: ' + error.message);
              }
            } finally {
              submitBtn.disabled = false;
              submitBtn.textContent = originalBtnText;
              submitBtn.style.opacity = '1';
            }
          });
        } else {
          console.error("Form #quotationForm not found!");
        }
      };

      // Run on load and also check if already loaded
      if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initForm);
      } else {
        initForm();
      }
    })();
  </script>
  @include('frontend.partials.rdv-modal')
  <!-- SweatAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @include('frontend.partials.cookie-consent')
</body>

</html>
