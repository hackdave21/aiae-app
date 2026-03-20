@extends('layouts.frontend')

@section('title', 'AIAE - Accueil')

@section('content')
  <!-- ================= HERO ================= -->
  <section class="relative px-1 sm:px-1 pt-1">
    <div class="relative max-w-[1600px] mx-auto rounded-[15px] overflow-hidden shadow-2xl">
      <img id="heroImage" src="{{ asset('aiae-frontend/Images/home.png') }}" class="w-full h-[75vh] md:h-[90vh] object-cover" />

      <!-- overlay -->
      <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>

      <!-- contenu -->
      <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 px-10 md:px-16 max-w-7xl text-white">
        <!-- TITRE -->
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-[44px] font-bold mb-6">
          De La Conception À La Réalisation
        </h1>

        <!-- TEXTE -->
        <p class="text-sm sm:text-base md:text-lg leading-relaxed mb-8 max-w-xl">
          Construction, énergie solaire, sécurité haute performance et
          préfabrication industrielle :<br />
          AIAE réunit toutes les compétences pour mener votre projet de A à Z.
          <br /><br />
          <span class="font-semibold">
            Un interlocuteur unique, des engagements tenus.
          </span>
        </p>

        <!-- BOUTONS -->
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full mt-8">
          <!-- BOUTON GAUCHE -->
          <button
            class="bg-primary text-white px-6 py-3 rounded-lg text-sm shadow-lg whitespace-nowrap w-full sm:w-auto">
            Prendre rendez-vous maintenant
          </button>

          <!-- BOUTON MILIEU -->
          <div class="flex items-center bg-white rounded-full shadow-lg p-1 w-full sm:w-auto">
            <span class="px-6 py-2 text-black text-sm whitespace-nowrap flex-1 text-center sm:text-left">
              Demander un devis gratuit
            </span>
            <div class="w-10 h-10 flex items-center justify-center bg-white rounded-full shrink-0">
              <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-5" />
            </div>
          </div>

          <!-- TEXTE DROITE -->
          <div class="flex items-start text-white sm:ml-auto">
            <img src="{{ asset('aiae-frontend/Images/Arrow4Expertises.svg') }}" class="w-6 mt-[2px] mr-2 shrink-0" />
            <p class="text-sm md:text-base font-medium leading-[1.2]">
              Un partenaire. Quatre<br />
              expertises. Zéro compromis.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= PANNEAU SIMULATEUR ================= -->
  <section class="relative -mt-16 md:-mt-20 z-10 px-2 sm:px-4">
    <div
      class="w-full max-w-[92%] sm:max-w-[640px] md:max-w-[820px] lg:max-w-[900px] xl:max-w-[990px] mx-auto bg-glass backdrop-blur-xl rounded-2xl shadow-xl p-4 sm:p-5">
      <!-- Onglets -->
      <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-2 mb-4" id="categoryButtons">
        <div class="flex flex-wrap gap-2">
          <button data-img="{{ asset('aiae-frontend/Images/residentiel.png') }}" data-secteur="residentiel"
            class="tabBtn px-3 py-2 rounded-lg bg-white text-xs sm:text-sm shadow">
            Résidentiel
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/tertiaire.png') }}" data-secteur="tertiaire" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            Tertiaire
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/industriel.png') }}" data-secteur="industriel" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            Industriel
          </button>

          <button data-img="{{ asset('aiae-frontend/Images/agricole.png') }}" data-secteur="agricole" class="tabBtn px-3 py-2 rounded-lg bg-glassDark text-xs sm:text-sm">
            Agricole
          </button>
        </div>

        <a href="{{ route('energie.calculator') }}"  class="w-full sm:w-auto sm:ml-auto px-4 py-2 bg-[#f78b0c] text-white rounded-lg text-xs sm:text-sm text-center font-bold hover:bg-orange-600 transition">
          Ouvrir le Calculateur d'Énergies
        </a>
      </div>

      <!-- Formulaire -->
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3">
        <input class="col-span-1 sm:col-span-1 md:col-span-2 h-10 px-3 rounded-lg text-xs sm:text-sm"
          placeholder="Surface dispo (m²)" />

        <input class="col-span-1 sm:col-span-1 md:col-span-2 h-10 px-3 rounded-lg text-xs sm:text-sm"
          placeholder="Surface bâtie (m²)" />

        <!-- CONFIGURATION -->
        <div class="relative col-span-1 sm:col-span-2 md:col-span-2">
          <button id="openConfig"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            Configuration
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="configPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-2 z-20">
            <label class="flex justify-between items-center text-xs sm:text-sm">
              Espaces Communs <input type="checkbox" />
            </label>

            <div class="flex justify-between items-center text-xs sm:text-sm">
              Salles De Bain
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
              Chambres
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

            <button class="w-full bg-[#05482C] text-white rounded-lg py-2 text-xs sm:text-sm">
              Valider
            </button>
          </div>
        </div>

        <!-- STANDING -->
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <button id="openStand"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            Standing
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="standPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-1 z-20">
            <button class="block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              Prestige
            </button>
            <button class="block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              Premium
            </button>
            <button class="block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              Confort
            </button>
            <button class="block w-full text-left hover:bg-gray-100 rounded-lg px-2 py-1">
              Standard
            </button>
          </div>
        </div>

        <!-- OPTIONS -->
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2">
          <button id="openOptions"
            class="w-full h-10 bg-white text-left px-3 rounded-lg text-xs sm:text-sm flex justify-between items-center">
            Options
            <span><img src="{{ asset('aiae-frontend/Images/Flèche haut.svg') }}" class="arrow transition-transform duration-200" alt="" /></span>
          </button>

          <div id="optionsPanel"
            class="hidden absolute left-0 right-0 bottom-full mb-2 bg-white rounded-xl shadow-lg p-3 space-y-2 z-20">
            <label class="flex justify-between text-xs sm:text-sm">Forage <input type="checkbox" /></label>
            <label class="flex justify-between text-xs sm:text-sm">Clôture <input type="checkbox" /></label>
            <label class="flex justify-between text-xs sm:text-sm">Aménagement Paysager <input
                type="checkbox" /></label>
            <label class="flex justify-between text-xs sm:text-sm">Domotique <input type="checkbox" /></label>
            <label class="flex justify-between text-xs sm:text-sm">Solaire <input type="checkbox" /></label>
            <label class="flex justify-between text-xs sm:text-sm">Piscine <input type="checkbox" /></label>

            <button class="w-full bg-[#05482C] text-white rounded-lg py-2 text-xs sm:text-sm">
              Valider
            </button>
          </div>
        </div>

        <!-- BOUTON FINAL -->
        <a id="btn-poursuivre" href="{{ route('simulator.v1', ['secteur' => 'residentiel']) }}"
          class="col-span-1 sm:col-span-2 md:col-span-2 h-10 bg-[#05482C] text-white rounded-lg text-xs sm:text-sm flex items-center justify-center whitespace-nowrap hover:bg-[#0b5b3a] transition">
          Poursuivre la simulation
        </a>
      </div>
    </div>
  </section>

  <!-- ================= SECTION QUI SOMMES NOUS ================= -->
  <section class="relative py-16">
    <!-- fond bleu -->
    <div class="absolute bottom-0 left-0 w-full h-[380px] bg-[#162064]"></div>

    <div class="relative max-w-[1200px] mx-auto px-6">
      <!-- carte grise -->
      <div class="bg-[#f2f2f2] rounded-xl shadow-[0_30px_70px_rgba(0,0,0,0.35)] p-12">
        <div class="grid md:grid-cols-2 gap-10 items-start">
          <!-- TEXTE GAUCHE -->
          <div>
            <h2 class="text-[#162064] font-bold text-2xl md:text-3xl mb-6">
              QUI SOMMES-NOUS ?
            </h2>
            <p class="text-gray-700 text-lg leading-relaxed mb-4">
              AIAE (
              <span class="font-semibold">Afrika Infrastructures And Equipments</span>)<br />
              est une entreprise togolaise
              <span class="font-semibold">fondée par des experts avec plus de 15 ans d'expérience en génie civil</span>,
              avec une ambition claire :<br />
              <span class="font-semibold">transformer le secteur de la construction en Afrique de l'Ouest.</span>
            </p>

            <p class="text-gray-600 leading-relaxed mb-4">
              Face à un marché où le client doit coordonner lui-même<br class="hidden sm:inline" />
              architecte, bureau d'études, constructeur et installateurs,<br class="hidden sm:inline" />
              <span class="text-primary mb-4">
                AIAE propose un modèle intégré : de la conception<br class="hidden sm:inline" />
                jusqu'à la remise des clés, en passant par l'autonomie<br class="hidden sm:inline" />
                énergétique et la sécurisation des installations.
              </span>
            </p>

            <button
              class="bg-[#0b5b3a] text-white px-5 py-2 mt-10 rounded-lg text-sm flex items-center gap-2 whitespace-nowrap">
              En savoir plus sur nous
              <img src="{{ asset('aiae-frontend/Images/Arrow4Expertises.svg') }}" class="w-4" />
            </button>

            <p class="text-xs text-gray-500 mt-10">
              Cliquez <span class="underline font-semibold">Simulation</span>
              & simulez votre projet en 2 minutes !
            </p>
          </div>

          <!-- COLONNE DROITE -->
          <div class="space-y-4 flex flex-col items-center md:items-end pt-2">
            <img src="{{ asset('aiae-frontend/Images/Expertise.png') }}" class="w-full max-w-[460px] rounded-lg shadow-sm" alt="Expertise" />

            <img src="{{ asset('aiae-frontend/Images/Siège.png') }}" class="w-full max-w-[460px] rounded-lg shadow-sm" alt="Siège" />

            <img src="{{ asset('aiae-frontend/Images/Ambition.png') }}" class="w-full max-w-[460px] rounded-lg shadow-sm" alt="Modèle" />
          </div>
        </div>

      </div> <!-- FIN CARTE GRISE -->

      <!-- STATS BAS - SORTIE DE LA CARTE POUR ÊTRE SUR LE FOND BLEU -->
      <div class="grid grid-cols-2 md:grid-cols-4 text-center text-white mt-14 gap-6 relative z-10">
        <div>
          <p class="text-5xl font-bold">+18</p>
          <p class="text-sm mt-2 font-medium">Années d'expertise</p>
        </div>

        <div>
          <p class="text-5xl font-bold">04</p>
          <p class="text-sm mt-2 font-medium">Divisions complémentaires</p>
        </div>

        <div>
          <p class="text-5xl font-bold">05</p>
          <p class="text-sm mt-2 font-medium">Zones d’intervention</p>
        </div>

        <div>
          <p class="text-5xl font-bold">04</p>
          <p class="text-sm mt-2 font-medium">Niveaux de standing</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION CIBLES ================= -->
  <section class="relative pt-16 bg-[#f2f2f2] overflow-hidden">
    <!-- forme décorative -->
    <div class="absolute -top-32 -left-32 w-[520px] h-[520px] bg-gray-200 rounded-full opacity-70"></div>

    <div class="relative max-w-[1200px] mx-auto px-6">
      <!-- Titre -->
      <h2 class="text-[#162064] font-bold text-2xl md:text-3xl mb-8">
        À QUI S'ADRESSE AIAE ?
      </h2>

      <!-- GRID -->
      <div class="grid grid-cols-2 rounded-xl overflow-hidden">
        <!-- PARTICULIERS -->
        <div class="relative group">
          <img src="{{ asset('aiae-frontend/Images/familles.png') }}" class="w-full h-full object-cover" />

          <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur text-white text-xs px-4 py-1 rounded-full">
            Contactez-nous
          </button>
        </div>

        <!-- DIASPORA -->
        <div class="relative group">
          <img src="{{ asset('aiae-frontend/Images/diaspora.png') }}" class="w-full h-full object-cover" />

          <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur text-white text-xs px-4 py-1 rounded-full">
            Contactez-nous
          </button>
        </div>

        <!-- ENTREPRISES -->
        <div class="relative group">
          <img src="{{ asset('aiae-frontend/Images/entreprises.png') }}" class="w-full h-full object-cover" />

          <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur text-white text-xs px-4 py-1 rounded-full">
            Contactez-nous
          </button>
        </div>

        <!-- INSTITUTIONS -->
        <div class="relative group">
          <img src="{{ asset('aiae-frontend/Images/institutions.png') }}" class="w-full h-full object-cover" />

          <button class="absolute bottom-6 right-6 bg-white/20 backdrop-blur text-white text-xs px-4 py-1 rounded-full">
            Contactez-nous
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION NOS DIVISIONS ================= -->
  <section class="relative py-24 bg-[#f3f3f3] overflow-hidden">
    <!-- forme cercle décorative -->
    <div class="absolute top-1/2 left-1/2 w-[650px] h-[650px] bg-gray-200 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
    <!-- image décorative gauche -->
    <img src="{{ asset('aiae-frontend/Images/Gauche.png') }}" class="absolute left-0 top-1/2 -translate-y-1/2 w-[480px]">
    <!-- image décorative droite -->
    <img src="{{ asset('aiae-frontend/Images/Droit.png') }}" class="absolute right-0 top-1/2 -translate-y-1/2 w-[480px]">

    <div class="relative max-w-[900px] mx-auto text-center px-6">
      <h2 class="text-[#162064] font-black text-[40px] sm:text-[60px] md:text-[90px] leading-[1.05]">
        NOS <span class="text-[#0b5b3a]">04</span><br>
        DIVISIONS
      </h2>
      <p class="mt-6 text-sm md:text-base text-gray-700 max-w-[520px] mx-auto leading-relaxed">
        AIAE STRUCTURE SON DÉVELOPPEMENT AUTOUR DE<br>
        <span class="font-bold">QUATRE DIVISIONS COMPLÉMENTAIRES</span>, ENSEMBLE,<br>
        ELLES FORMENT UN <span class="font-bold">ÉCOSYSTÈME INÉDIT SUR LE</span><br>
        <span class="font-bold">MARCHÉ OUEST-AFRICAIN.</span>
      </p>
    </div>
  </section>

  <!-- ================= SECTION DIVISIONS ================= -->
  <section class="py-20 bg-[#f3f3f3]">
    <div class="max-w-[1100px] mx-auto px-6">
      <!-- Ligne 1 -->
      <div class="grid md:grid-cols-2 gap-12 items-stretch">
        <img src="{{ asset('aiae-frontend/Images/Construction.png') }}" class="rounded-xl w-full h-full object-cover">
        <div class="flex flex-col justify-between h-full">
          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-5xl mb-4">CONSTRUCTION</h3>
            <p class="text-gray-700 leading-relaxed text-[24px]">
              Notre cœur de métier. Nous concevons et réalisons des
              <strong>infrastructures durables</strong> : villas résidentielles,
              bâtiments commerciaux, ouvrages d’art et infrastructures techniques.
              <strong>Conception architecturale et structurelle.</strong>
              Construction tous standings (Standard à Prestige).
              Ouvrages d’art (<strong>ponts, murs de soutènement, etc.</strong>).
              <strong>Réhabilitation et extension</strong> de bâtiments existants.
            </p>
          </div>
          <p class="text-[#0b5b3a] mt-6 text-[24px]">
            À partir de <span class="font-semibold">330 000 FCFA/m²</span>
          </p>
        </div>
      </div>
      <div class="border-t border-gray-300 my-16"></div>
      <!-- Ligne 2 -->
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="text-right">
          <h3 class="text-[#d86d00] font-extrabold text-5xl mb-4">ÉNERGIE</h3>
          <p class="text-gray-700 leading-relaxed text-[24px]">
              Solutions d’autonomie énergétique pour vos installations.
              Nous dimensionnons et installons des
              <strong>systèmes solaires adaptés aux besoins des entreprises</strong>
              et exploitations agricoles.
              <strong class="text-[#d86d00]">Solaire C&I</strong> (commercial et industriel).
              <strong class="text-[#d86d00]">Systèmes hybrides</strong> avec stockage par batteries.
              Solutions pour sites isolés ou sans raccordement.
              <strong>Maintenance et optimisation</strong> des installations.
          </p>
          <p class="mt-3 text-gray-600 text-[24px]">
            Lancement <span class="font-semibold">2026</span>
          </p>
        </div>
        <img src="{{ asset('aiae-frontend/Images/Energie.png') }}" class="rounded-xl w-full object-cover">
      </div>
      <div class="border-t border-gray-300 my-16"></div>
      <!-- Ligne 3 -->
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <img src="{{ asset('aiae-frontend/Images/Sécurité.png') }}" class="rounded-xl w-full object-cover">
        <div>
          <h3 class="text-[#0b5b3a] font-extrabold text-5xl mb-4">SÉCURITÉ</h3>
          <p class="text-gray-700 leading-relaxed text-[24px]">
            Protection haute performance pour vos biens et vos personnes.
            Nous concevons et installons des solutions de sécurité physique
            répondant aux normes européennes.
            <strong>Chambres fortes et coffres certifiés</strong> (banques, entreprises).
            <strong>Safe rooms</strong>, salles de repli sécurisées.
            Armureries et locaux de stockage sensible.
            Systèmes de contrôle d’accès.
          </p>
          <p class="mt-3 text-[#0b5b3a] text-[24px]">Prochainement</p>
        </div>
      </div>
      <div class="border-t border-gray-300 my-16"></div>
      <!-- Ligne 4 -->
      <div class="grid md:grid-cols-2 gap-12 items-center">
        <div class="text-right">
          <h3 class="text-[#d86d00] font-extrabold text-5xl mb-4">PRÉFABRICATION</h3>
          <p class="text-gray-700 leading-relaxed text-[24px]">
            Production industrielle d’éléments de construction pour
            des chantiers plus rapides et économiques.
            <strong>BTC (briques de terre compressée)</strong>,
            matériau écologique local.
            Éléments en <strong>béton précontraint</strong> (portées longues,
            résistance accrue).
            Nervures et poutrelles pour planchers.
            Éléments pour ponts et ouvrages d’art.
          </p>
          <p class="mt-3 text-[#d86d00] text-[24px]">Prochainement</p>
        </div>
        <img src="{{ asset('aiae-frontend/Images/Préfabrication.png') }}" class="rounded-xl w-full object-cover">
      </div>
    </div>
  </section>

  <!-- ================= BARRE ACTIONS ================= -->
  <div class="w-full bg-[#e9e9e9] py-4">
    <div class="max-w-[1100px] mx-auto flex flex-col sm:flex-row items-center justify-between px-6 sm:px-16 gap-4">
      <button class="bg-[#0b5b3a] text-white px-10 py-3 rounded-lg text-[16px] font-medium hover:opacity-90 transition w-full sm:w-auto">
        Prendre rendez-vous maintenant
      </button>
      <button class="flex items-center justify-center text-[16px] bg-[#ffffff] gap-3 border border-black px-10 py-3 rounded-full text-sm font-medium hover:bg-gray-100 transition w-full sm:w-auto">
        Demander un devis gratuit
        <span class="flex items-center justify-center w-7 h-7 border border-black rounded-full shrink-0">
          <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-3">
        </span>
      </button>
    </div>
  </div>

  <!-- ================= SECTION POURQUOI AIAE ================= -->
  <section class="relative w-full bg-[#05482C] overflow-hidden">
    <div class="max-w-[1600px] mx-auto px-6 pt-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center text-center lg:text-left">
        <div class="text-white relative mx-auto lg:ml-20 max-w-xl">
          <h2 class="text-5xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-10 text-center lg:text-left">
            Pourquoi<br>Choisir AIAE ?
          </h2>
        </div>
        <div class="relative lg:mr-20 flex justify-center">
          <img src="{{ asset('aiae-frontend/Images/Défile.png') }}" alt="bloc glass" class="ml-20">
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SECTION AVANTAGES ================= -->
  <section class="bg-[#f3f3f3] py-20">

    <div class="max-w-[1200px] mx-auto px-6">

      <div class="grid md:grid-cols-2 gap-x-16 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-start justify-center w-12 h-12 rounded-full bg-[#0b5b3a] text-white font-bold text-lg shrink-0">
            01
          </div>

          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-2xl mb-2">
              UN INTERLOCUTEUR UNIQUE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Fini la coordination entre architecte, bureau d’études, constructeur
              et installateurs. <strong>AIAE prend en charge l’intégralité de votre projet</strong>,
              de la première esquisse à la remise des clés.
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-start justify-center w-12 h-12 rounded-full bg-[#0b5b3a] text-white font-bold text-lg shrink-0">
            02
          </div>

          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-2xl mb-2">
              EXPERTISE TECHNIQUE AVANCÉE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              <strong>Forte de plus de 15 ans d’expérience en génie civil</strong>, AIAE dispose
              de compétences rares pour traiter des projets complexes :
              ouvrages d’art, béton précontraint, structures spéciales.
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-start justify-center w-12 h-12 rounded-full bg-[#0b5b3a] text-white font-bold text-lg shrink-0">
            03
          </div>

          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-2xl mb-2">
              DES ENGAGEMENTS TENUS
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Dans un secteur où la parole ne vaut souvent rien,
              <strong>nous faisons de la fiabilité notre marque de fabrique.</strong>
              Délais respectés, budgets maîtrisés, qualité garantie.
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-start justify-center w-12 h-12 rounded-full bg-[#0b5b3a] text-white font-bold text-lg shrink-0">
            04
          </div>

          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-2xl mb-2">
              TRANSPARENCE TOTALE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              <strong>Devis détaillés basés sur notre Bordereau des Prix Unitaires (BPU)</strong>,
              suivi de chantier accessible, facturation claire.
              Vous savez exactement ce que vous payez et pourquoi.
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-start justify-center w-12 h-12 rounded-full bg-[#0b5b3a] text-white font-bold text-lg shrink-0">
            05
          </div>

          <div>
            <h3 class="text-[#0b5b3a] font-extrabold text-2xl mb-2">
              SOLUTIONS INTÉGRÉES UNIQUES
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Construction + Énergie + Sécurité :
              <strong>nous pouvons livrer un bâtiment autonome en énergie et sécurisé
                dès la conception.</strong> Une combinaison rare sur le marché togolais.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col gap-6 justify-center">

          <!-- bouton RDV -->
          <button class="bg-[#0b5b3a] text-white px-8 py-3 rounded-lg text-sm font-medium w-fit">
            Prendre rendez-vous maintenant
          </button>

          <!-- bouton devis -->
          <button class="flex items-center gap-3 border border-black px-8 py-3 rounded-full text-sm font-medium w-fit">

            Demander un devis gratuit

            <span class="flex items-center justify-center w-7 h-7 border border-black rounded-full">
              <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-3">
            </span>

          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION ENGAGEMENTS================= -->
  <section class="relative w-full bg-[#0E1540] overflow-hidden">

    <div class="max-w-[1600px] mx-auto px-6 pt-10">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center text-center lg:text-left">

        <!-- GAUCHE : TEXTE -->
        <div class="text-white relative mx-auto lg:ml-20 max-w-xl">

          <h2 class="text-5xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-10 text-center lg:text-left">
            Nos<br> Engagements<br> Concrets
          </h2>

        </div>

        <!-- DROITE : IMAGE -->
        <div class="relative lg:mr-20 flex justify-center">

          <img src="{{ asset('aiae-frontend/Images/engagement.png') }}" alt="bloc glass" class="ml-20">

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION GARANTIES ================= -->
  <section class="bg-[#f3f3f3] py-20">

    <div class="max-w-[1200px] mx-auto px-6">

      <div class="grid md:grid-cols-2 gap-x-16 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            01
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              DEVIS GRATUIT DÉTAILLÉ
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Vous recevez un devis ligne par ligne,
              <strong>basé sur notre BPU.</strong> Pas de mauvaises surprises.
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            02
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              PLANNING CONTRACTUEL
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Les délais sont inscrits au contrat. En cas de retard de notre fait,
              <strong>des pénalités s’appliquent.</strong>
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            03
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              GARANTIE DÉCENNALE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Conformément à la loi, <strong>nous garantissons la solidité
                de l’ouvrage pendant 10 ans.</strong>
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            04
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              ASSURANCE RC PRO
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Notre responsabilité civile professionnelle couvre
              <strong>les dommages éventuels sur le chantier.</strong>
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            05
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              PAIEMENT PAR ÉTAPES
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Vous payez au fur et à mesure de l’avancement,
              selon un échéancier défini ensemble.
            </p>
          </div>

        </div>


        <!-- 06 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            06
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              CONFIDENTIALITÉ
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Tous nos projets sont traités avec discrétion.
              <strong>Secret professionnel contractualisé.</strong>
            </p>
          </div>

        </div>


        <!-- 07 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#162064] text-white font-bold text-lg shrink-0">
            07
          </div>

          <div>
            <h3 class="text-[#162064] font-extrabold text-xl mb-2">
              ACCOMPAGNEMENT FINANCEMENT
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Nous pouvons vous orienter dans vos démarches
              de crédit auprès des banques partenaires.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col gap-6 justify-center">

          <!-- bouton RDV -->
          <button class="bg-[#0b5b3a] text-white px-8 py-3 rounded-lg text-sm font-medium w-fit">
            Prendre rendez-vous maintenant
          </button>

          <!-- bouton devis -->
          <button class="flex items-center gap-3 border border-black px-8 py-3 rounded-full text-sm font-medium w-fit">

            Demander un devis gratuit

            <span class="flex items-center justify-center w-7 h-7 border border-black rounded-full">
              <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-3">
            </span>

          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION VALEURS ================= -->
  <section class="relative w-full bg-[#D97706] overflow-hidden pt-10">

    <div class="max-w-[1600px] mx-auto px-6">

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        <!-- GAUCHE : TEXTE -->
        <div class="text-white lg:ml-20 max-w-xl">

          <h2 class="text-5xl md:text-6xl lg:text-7xl font-extrabold leading-tight mb-8">
            Nos Valeurs
          </h2>

          <p class="text-[18px] leading-relaxed opacity-95">
            Ces valeurs constituent l’ADN d’AIAE. Elles<br>
            ne sont pas négociables, quelles que soient<br>
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

    <div class="max-w-[1200px] mx-auto px-6">

      <div class="grid md:grid-cols-2 gap-x-20 gap-y-14">

        <!-- 01 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#d97706] text-white font-bold text-lg shrink-0">
            01
          </div>

          <div>
            <h3 class="text-[#d97706] font-extrabold text-xl mb-2">
              LA QUALITÉ EST PRIMORDIALE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              Nous ne construisons pas pour aujourd’hui,
              <strong>nous construisons pour des générations.</strong>
            </p>
          </div>

        </div>


        <!-- 02 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#d97706] text-white font-bold text-lg shrink-0">
            02
          </div>

          <div>
            <h3 class="text-[#d97706] font-extrabold text-xl mb-2">
              LA PAROLE DONNÉE EST SACRÉE
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              <strong>Un engagement pris est un engagement tenu.</strong>
              Sans exception.
            </p>
          </div>

        </div>


        <!-- 03 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#d97706] text-white font-bold text-lg shrink-0">
            03
          </div>

          <div>
            <h3 class="text-[#d97706] font-extrabold text-xl mb-2">
              HONNÊTETÉ ENVERS LES CLIENTS
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              <strong>Un client bien informé</strong> est un client satisfait.
            </p>
          </div>

        </div>


        <!-- 04 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#d97706] text-white font-bold text-lg shrink-0">
            04
          </div>

          <div>
            <h3 class="text-[#d97706] font-extrabold text-xl mb-2">
              RESPECT DES ÉQUIPES
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              La qualité dépend du <strong>respect accordé à ceux qui réalisent.</strong>
            </p>
          </div>

        </div>


        <!-- 05 -->
        <div class="flex gap-6">

          <div
            class="flex items-center justify-center w-12 h-12 rounded-full bg-[#d97706] text-white font-bold text-lg shrink-0">
            05
          </div>

          <div>
            <h3 class="text-[#d97706] font-extrabold text-xl mb-2">
              RESPECT DES DÉLAIS ET DES COÛTS
            </h3>

            <p class="text-gray-700 text-[24px] leading-relaxed">
              <strong>Un projet en retard ou hors budget est un échec</strong>,
              même s’il est techniquement parfait.
            </p>
          </div>

        </div>


        <!-- BOUTONS -->
        <div class="flex flex-col gap-6 justify-center">

          <!-- bouton RDV -->
          <button class="bg-[#0b5b3a] text-white px-8 py-3 rounded-lg text-sm font-medium w-fit">
            Prendre rendez-vous maintenant
          </button>

          <!-- bouton devis -->
          <button class="flex items-center gap-3 border border-black px-8 py-3 rounded-full text-sm font-medium w-fit">

            Demander un devis gratuit

            <span class="flex items-center justify-center w-7 h-7 border border-black rounded-full">
              <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-3">
            </span>

          </button>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION DIASPORA ================= -->

  <section class="bg-[#f3f3f3] py-24">

    <div class="max-w-[1200px] mx-auto px-6">

      <!-- Bloc vert -->
      <div class="bg-[#0b5b3a] rounded-[30px] p-12">

        <!-- TITRE -->
        <h2 class="text-white text-5xl font-extrabold mb-3">
          Vous vivez à l’étranger ?
        </h2>

        <p class="text-white/90 mb-12 text-[24px]">
          Construire au Togo depuis l’étranger, c’est<br> possible et serein avec AIAE.
        </p>


        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Interlocuteur.png') }}" class="w-full h-40 object-cover">

            <div class="p-5">
              <h3 class="font-semibold text-[#0b5b3a] mb-2 text-[18px]">
                Interlocuteur unique francophone
              </h3>

              <p class="text-gray-600 text-[18px]">
                Un chef de projet dédié qui parle votre<br> langue et comprend vos contraintes de<br> décalage horaire.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Suivi à distance.png') }}" class="w-full h-40 object-cover">

            <div class="p-5">
              <h3 class="font-semibold text-[#0b5b3a] mb-2 text-[18px]">
                Suivi à distance en temps réel
              </h3>

              <p class="text-gray-600 text-[18px]">
                Rapports photos et vidéos réguliers,<br> visioconférences de suivi, accès à<br> l’avancement du
                chantier.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Paiement.png') }}" class="w-full h-40 object-cover">

            <div class="p-5">
              <h3 class="font-semibold text-[#0b5b3a] mb-2 text-[18px]">
                Paiements sécurisés
              </h3>

              <p class="text-gray-600 text-[18px]">
                Virements internationaux vers un<br> compte bancaire togolais vérifié.<br> Échéancier clair.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Gestion.png') }}" class="w-full h-40 object-cover">

            <div class="p-5">
              <h3 class="font-semibold text-[#0b5b3a] mb-2 text-[18px]">
                Gestion clé en main
              </h3>

              <p class="text-gray-600 text-[18px]">
                Nous gérons les démarches<br> administratives locales (permis,<br> raccordements) pour vous.
              </p>
            </div>
          </div>


          <!-- CARD -->
          <div class="bg-white rounded-xl overflow-hidden">
            <img src="{{ asset('aiae-frontend/Images/Transpaence.png') }}" class="w-full h-40 object-cover">

            <div class="p-5">
              <h3 class="font-semibold text-[#0b5b3a] mb-2 text-[18px]">
                Transparence totale
              </h3>

              <p class="text-gray-600 text-[18px]">
                Devis détaillé, contrat clair<br> signable devant le notaire au Togo,<br> aucune mauvaise surprise à
                votre retour.
              </p>
            </div>
          </div>


          <!-- CALL TO ACTION -->
          <div class="flex flex-col justify-center text-white px-6">

            <p class="text-[24px] leading-relaxed mb-6">
              <strong>Appelez-nous</strong> ou <strong>prenez<br> rendez-vous en visio</strong>
              nous<br> nous adaptons à votre<br> fuseau horaire.
            </p>

            <button class="bg-[#b7ff00] text-black px-6 py-3 rounded-lg w-fit mb-4">
              Prendre rendez-vous maintenant
            </button>

            <button class="flex items-center gap-3 border border-white px-6 py-3 rounded-full text-sm w-fit">

              Demander un devis gratuit

              <span class="flex items-center justify-center w-7 h-7 border border-white rounded-full">
                <img src="{{ asset('aiae-frontend/Images/envoi.png') }}" class="w-3">
              </span>

            </button>

          </div>

        </div>

      </div>

    </div>

  </section>

  <!-- ================= SECTION FAQ ================= -->
  <section class="bg-[#111a4b] py-10">

    <div class="max-w-[1000px] mx-auto px-6 text-center">

      <!-- TITRE -->
      <h2 class="text-white text-5xl font-extrabold mb-6">
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

    <div class="max-w-[900px] mx-auto px-6 space-y-4">


      <!-- QUESTION -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              01
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Combien coûte la construction d’une maison au Togo ?
            </p>

          </div>

          <!-- ICON -->
          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Le coût dépend du standing, des matériaux et de la localisation.
          Chez AIAE, les projets démarrent à partir de <strong>330 000 FCFA/m²</strong>.
        </div>

      </details>

      <!-- QUESTION 02 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              02
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Quels sont les délais de construction ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          En moyenne entre 6 et 12 mois selon la taille et la complexité du projet.
        </div>

      </details>

      <!-- QUESTION 03 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              03
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Je vis à l’étranger, comment suivre mon chantier ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Nous proposons un suivi à distance avec photos, vidéos et réunions
          régulières en visioconférence.
        </div>

      </details>

      <!-- QUESTION 04 (ouverte par défaut) -->
      <details open class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              04
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Proposez-vous des facilités de paiement ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Oui. Le paiement se fait par étapes, au fur et à mesure de l’avancement
          des travaux. L’échéancier est défini ensemble avant le démarrage du chantier.
        </div>

      </details>

      <!-- QUESTION 05 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              05
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Intervenez-vous en dehors de Lomé ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Oui, nous intervenons partout au Togo et pouvons également accompagner
          les projets dans la sous-région selon les besoins du client.
        </div>

      </details>


      <!-- QUESTION 06 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              06
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Quelles garanties offrez-vous ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Nous garantissons la qualité des travaux, le respect des normes de
          construction et la transparence dans la gestion du chantier.
          Chaque projet est suivi par des professionnels qualifiés.
        </div>

      </details>


      <!-- QUESTION 07 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              07
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Puis-je voir des exemples de vos réalisations ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />
        </summary>

        <div class="px-16 pb-6 text-gray-600">
          Bien sûr. Nous mettons à disposition un portfolio de nos projets
          réalisés afin que vous puissiez apprécier la qualité de notre travail
          et vous inspirer pour votre propre projet.
        </div>

      </details>


      <!-- QUESTION 08 -->
      <details class="group border border-[#1a1f4d] rounded-lg bg-white">

        <summary class="flex items-center justify-between p-5 cursor-pointer list-none">

          <div class="flex items-center gap-4">

            <span
              class="bg-[#1a1f4d] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold">
              08
            </span>

            <p class="font-semibold text-[#1a1f4d]">
              Comment AIAE se compare-t-elle aux grandes entreprises étrangères ?
            </p>

          </div>

          <img src="{{ asset('aiae-frontend/Images/bfaq.png') }}" alt="icon"
            class="w-5 h-5 transition-transform duration-300 group-open:rotate-180" />

        </summary>

        <div class="px-16 pb-6 text-gray-600">
          AIAE offre le même niveau d’expertise technique tout en proposant
          une meilleure connaissance du terrain local, des coûts plus
          compétitifs et une proximité avec les clients.
        </div>

      </details>

    </div>

  </section>

  <!-- ================= SECTION CTA ================= -->
  <section class="bg-[#f3f3f3] py-10">

    <div class="max-w-[900px] mx-auto text-center px-6">

      <!-- TITRE -->
      <h2 class="text-4xl font-bold  mb-6">
        Prêt À Concrétiser Votre Projet ?
      </h2>

      <!-- TEXTE -->
      <p class="text-gray-600 leading-relaxed mb-10 text-[24px]">
        Vous êtes un particulier souhaitant construire votre résidence ?
        Une entreprise cherchant l’autonomie énergétique ?
        Une institution nécessitant des infrastructures sécurisées ?
        Nos équipes sont à votre écoute.
      </p>

      <!-- BOUTONS -->
      <div class="flex flex-col md:flex-row justify-center">

        <!-- BOUTON 1 -->
        <a href="#" class="bg-[#1a1f4d] text-white px-10 py-5 text-center font-semibold">

          DEMANDER UN DEVIS GRATUIT
          <span class="block text-sm font-normal opacity-80">
            Réponse sous 48h
          </span>

        </a>

        <!-- BOUTON 2 -->
        <a href="#" class="bg-[#0a4f2c] text-white px-10 py-5 text-center font-semibold">

          PRENDRE RENDEZ-VOUS
          <span class="block text-sm font-normal opacity-80">
            En personne ou en visio
          </span>

        </a>

      </div>

    </div>

  </section>
  
@endsection

@section('scripts')
  <script>
    // changement d'image dans le hero
    const tabButtons = document.querySelectorAll(".tabBtn");
    const hero = document.getElementById("heroImage");

    tabButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        hero.src = btn.dataset.img;
        
        // Update URL for simulation
        const btnPoursuivre = document.getElementById('btn-poursuivre');
        if (btnPoursuivre && btn.dataset.secteur) {
            const url = new URL(btnPoursuivre.href);
            url.searchParams.set('secteur', btn.dataset.secteur);
            btnPoursuivre.href = url.toString();
        }

        tabButtons.forEach((b) => {
          b.classList.remove("bg-white", "shadow");
          b.classList.add("bg-glassDark");
        });
        btn.classList.remove("bg-glassDark");
        btn.classList.add("bg-white", "shadow");
      });
    });

    const openConfig = document.getElementById("openConfig");
    const configPanel = document.getElementById("configPanel");
    const openStand = document.getElementById("openStand");
    const standPanel = document.getElementById("standPanel");
    const openOptions = document.getElementById("openOptions");
    const optionsPanel = document.getElementById("optionsPanel");

    if (openConfig) openConfig.onclick = () => togglePanel(openConfig, configPanel);
    if (openStand) openStand.onclick = () => togglePanel(openStand, standPanel);
    if (openOptions) openOptions.onclick = () => togglePanel(openOptions, optionsPanel);

    // Salles de bain counter
    const plusBath = document.querySelector(".plusBath");
    const minusBath = document.querySelector(".minusBath");
    const bathCount = document.getElementById("bathCount");
    if (plusBath) plusBath.onclick = () => { bathCount.textContent = Number(bathCount.textContent) + 1; };
    if (minusBath) minusBath.onclick = () => { if (Number(bathCount.textContent) > 0) bathCount.textContent = Number(bathCount.textContent) - 1; };

    // Chambres counter
    const plusBed = document.querySelector(".plusBed");
    const minusBed = document.querySelector(".minusBed");
    const bedCount = document.getElementById("bedCount");
    if (plusBed) plusBed.onclick = () => { bedCount.textContent = Number(bedCount.textContent) + 1; };
    if (minusBed) minusBed.onclick = () => { if (Number(bedCount.textContent) > 0) bedCount.textContent = Number(bedCount.textContent) - 1; };
  </script>
@endsection
