<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mentions Légales - AIAE</title>
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
            darkBlue: "#121a44",
            glass: "rgba(255,255,255,0.55)",
            glassDark: "rgba(255,255,255,0.35)",
          },
        },
      },
    };
  </script>

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

    html {
      scroll-behavior: smooth;
    }

    .legal-card {
      background: white;
      border-radius: 20px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
      padding: 2.5rem;
      margin-bottom: 2rem;
    }

    .legal-title {
      color: #121a44;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .legal-title::before {
      content: "";
      display: block;
      width: 4px;
      height: 24px;
      background: #05482C;
      border-radius: 2px;
    }

    .legal-section-anchor {
      scroll-margin-top: 100px;
    }

    .toc-link {
      transition: all 0.3s ease;
      border-left: 2px solid transparent;
      padding-left: 1rem;
      display: block;
    }

    .toc-link:hover {
      border-left-color: #CC6A00;
      color: #CC6A00;
      transform: translateX(5px);
    }
  </style>
</head>

<body class="font-futura bg-[#f8f9fa] text-gray-800">

  @include('frontend.partials.navbar')

  <!-- HERO -->
  <section class="pt-40 pb-20 bg-darkBlue text-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-xl sm:text-2xl md:text-3xl font-heavy mb-4 uppercase tracking-tighter">
        Mentions <span class="text-[#FF8400]">Légales</span>
      </h2>
      <p class="text-lg opacity-80 font-light max-w-2xl mx-auto">
        Transparence, conformité et protection de vos données. Retrouvez ici l'ensemble de nos informations juridiques.
      </p>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 lg:grid-cols-[300px_1fr] gap-12">

    <!-- SOMMAIRE (SIDEBAR) -->
    <aside class="hidden lg:block">
      <div class="sticky top-28 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="font-bold text-darkBlue mb-6 text-xl uppercase tracking-wider">Sommaire</h2>
        <nav class="flex flex-col gap-4 text-sm font-medium text-gray-500">
          <a href="#mentions" class="toc-link">1. Mentions Légales</a>
          <a href="#cgu" class="toc-link">2. CGU</a>
          <a href="#confidentialite" class="toc-link">3. Confidentialité</a>
          <a href="#cookies" class="toc-link">4. Cookies</a>
        </nav>
      </div>
    </aside>

    <!-- CONTENT AREA -->
    <div class="space-y-12">

      <!-- SOMMAIRE (MOBILE) -->
      <div class="lg:hidden bg-white p-6 rounded-2xl shadow-sm mb-8">
        <h2 class="font-bold text-darkBlue mb-4 text-[18px]">Sommaire</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm font-medium">
          <a href="#mentions" class="text-primary hover:underline">1. Mentions Légale</a>
          <a href="#cgu" class="text-primary hover:underline">2. CGU</a>
          <a href="#confidentialite" class="text-primary hover:underline">3. Confidentialité</a>
          <a href="#cookies" class="text-primary hover:underline">4. Cookies</a>
        </div>
      </div>

      <!-- SECTION 1: MENTIONS LÉGALES -->
      <div id="mentions" class="legal-section-anchor">
        <div class="legal-card">
          <h2 class="legal-title text-2xl">1. Éditeur du site</h2>
          <div class="space-y-6 text-gray-600 leading-relaxed font-light">
            <p>
              <strong class="text-darkBlue font-bold">Raison sociale :</strong> Afrika Infrastructures And Equipment
              (AIAE SARL)
            </p>
            <p>
              <strong class="text-darkBlue font-bold">Forme juridique :</strong> Société à Responsabilité Limitée
              (SARL), de droit togolais, régie par l'Acte Uniforme OHADA relatif au droit des sociétés commerciales et
              du groupement d'intérêt économique.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <p><strong class="text-darkBlue font-bold">Capital social :</strong> 5 000 000 FCFA</p>
              <p><strong class="text-darkBlue font-bold">RCCM :</strong> TG-LFW-01-2025-B12-00590</p>
              <p><strong class="text-darkBlue font-bold">NIF :</strong> 1002039587</p>
            </div>
            <p>
              <strong class="text-darkBlue font-bold">Siège social :</strong> Quartier Kléme Zanguéra Rue Agoe Nyive -
              Lomé Togo
            </p>
            <p>
              <strong class="text-darkBlue font-bold">Représentant légal :</strong> Mme METILABE Tchable, Gérante<br>
              <strong class="text-darkBlue font-bold">Directeur de la publication :</strong> M. AMEGAN Kokou Alexandre,
              Directeur Général
            </p>
            <div class="pt-4 border-t border-gray-100 flex flex-col md:flex-row gap-6">
              <p><strong class="text-darkBlue font-bold">Téléphone :</strong> +228 90 03 54 16</p>
              <p><strong class="text-darkBlue font-bold">Email :</strong> contact@aiae.services</p>
            </div>
          </div>
        </div>

      <div class="legal-card">
  <h2 class="legal-title text-2xl">2. Hébergeur</h2>
  <div class="bg-gray-50 border-l-4 border-primary p-6 rounded-r-lg">
    <p class="text-gray-700 font-medium">TRIOOTI Web Association</p>
    <p class="text-gray-600 font-light">Avenue de Souza, Hôtel de la Paix, Bè – Lomé, Togo</p>
    <p class="text-gray-600 font-light mt-1">
      Tél : <a href="tel:+22898674198" class="text-primary hover:underline">(+228) 98 67 41 98</a>
    </p>
    <p class="text-gray-600 font-light">
      Présent au Togo, Bénin et Ghana
    </p>
    <a href="https://triooti.com/corporate/"
      class="text-primary hover:underline text-sm mt-2 block">www.triooti.com</a>
  </div>
</div>

        <div class="legal-card">
          <h2 class="legal-title text-2xl">3. Conception et développement</h2>
          <p class="text-gray-600 font-light">
            <strong class="text-darkBlue font-medium">Conception et développement web :</strong> M. ADZINDA Jean<br>
            <strong class="text-darkBlue font-medium">Identité visuelle et charte graphique :</strong> M. ADZINDA Jean
          </p>
        </div>

        <div class="legal-card">
          <h2 class="legal-title text-2xl">4. Propriété intellectuelle</h2>
          <div class="text-gray-600 font-light space-y-4">
            <p>
              L'ensemble du contenu du site <strong class="text-primary">aiae.services</strong> (textes, images,
              graphismes, logo, icônes, vidéos, sons, logiciels, bases de données, algorithmes du simulateur) est la
              propriété exclusive de AIAE SARL ou de ses partenaires et est protégé par les lois togolaises et
              internationales relatives à la propriété intellectuelle, notamment l'Accord de Bangui révisé (OAPI).
            </p>
            <p>
              Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments
              du site est interdite sans autorisation écrite préalable de AIAE SARL.
            </p>
            <p class="bg-[#CC6A00]/5 p-4 rounded-xl border border-[#CC6A00]/20 text-[#CC6A00] font-medium">
              Le simulateur de coût de construction, ses algorithmes, ses bases de données de prix et coefficients
              constituent un système propriétaire protégé. L'extraction systématique, le scraping ou le reverse
              engineering sont strictement interdits.
            </p>
          </div>
        </div>

        <div class="legal-card">
          <h2 class="legal-title text-2xl">5. Crédits visuels</h2>
          <p class="text-gray-600 font-light">
            Les photographies et illustrations proviennent de banques d'images sous licence (Unsplash, Pexels, Adobe
            Stock) ou sont la propriété d'AIAE SARL.
          </p>
        </div>
      </div>

      <!-- SECTION 2: CGU -->
      <div id="cgu" class="legal-section-anchor">
        <div class="legal-card">
          <h2 class="legal-title text-2xl">2. CGU</h2>
          <div class="text-gray-700 space-y-4">
            <p>Les présentes Conditions Générales d'Utilisation (CGU) régissent l'accès et l'utilisation du site
              www.aiae.services. En naviguant sur ce site, l'utilisateur reconnaît avoir pris connaissance des présentes
              conditions et les accepter sans réserve.</p>
            <p>AIAE SARL se réserve le droit de modifier à tout moment le contenu du site ainsi que les présentes
              mentions légales pour se conformer aux évolutions législatives ou aux besoins de ses services.</p>
          </div>
        </div>
      </div>

      <!-- SECTION 3: CONFIDENTIALITÉ -->
      <div id="confidentialite" class="legal-section-anchor">
        <div class="legal-card">
          <h2 class="legal-title text-2xl">3. Confidentialité</h2>
          <div class="text-gray-700 space-y-4">
            <p>La protection de vos données personnelles est une priorité pour AIAE SARL. Nous collectons uniquement les
              informations nécessaires au traitement de vos demandes de services et de devis.</p>
            <p>Conformément à la réglementation en vigueur, vous disposez d'un droit d'accès, de rectification et de
              suppression de vos données. Pour toute demande, veuillez nous contacter à l'adresse :
              contact@aiae.services.</p>
          </div>
        </div>
      </div>

      <!-- SECTION 4: COOKIES -->
      <div id="cookies" class="legal-section-anchor">
        <div class="legal-card">
          <h2 class="legal-title text-2xl">4. Cookies</h2>
          <div class="text-gray-700 space-y-4">
            <p>Notre site utilise des cookies techniques nécessaires au bon fonctionnement de la navigation et à
              l'amélioration de l'expérience utilisateur. Ces cookies ne permettent pas l'identification personnelle de
              l'utilisateur.</p>
            <p>Vous pouvez à tout moment configurer votre navigateur pour refuser l'installation de ces cookies, bien
              que cela puisse limiter l'accès à certaines fonctionnalités du site.</p>
          </div>
        </div>
      </div>

    </div>
  </main>


  <!-- ================= FOOTER ================= -->
  <footer class="bg-[#e6e6e6] pt-20">

    <div class="max-w-7xl mx-auto px-6">

      <div class="grid grid-cols-1 md:grid-cols-[1.6fr_1fr_1fr_1fr] gap-16">

        <!-- LOGO + DESCRIPTION -->
        <div>

          <img src="{{ asset('aiae-frontend/Images/logos/LOGO_AIAE_FINAL_-_Copie.png') }}" class="w-80 pb-5"
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

  @include('frontend.partials.rdv-modal')
</body>

</html>