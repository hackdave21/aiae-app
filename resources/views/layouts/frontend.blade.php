<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'AIAE')</title>
  <link rel="icon" type="image/png" href="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL.png') }}">
  <link rel="stylesheet" href="{{ asset('aiae-frontend/css/responsive.css') }}">

  <meta name="description" content="@yield('meta_description', __('AIAE : Construction, énergie solaire, sécurité et préfabrication au Togo. De la conception à la réalisation, un partenaire unique pour vos projets d\'infrastructure.'))">

  <meta property="og:title" content="@yield('og_title', __('AIAE - Afrika Infrastructures And Equipements'))">
  <meta property="og:description" content="@yield('og_description', __('AIAE : Construction, énergie solaire, sécurité et préfabrication au Togo. De la conception à la réalisation.'))">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:image" content="@yield('og_image', asset('aiae-frontend/Images/logos/LOGO_AIAE_FINAL_-_Copie.png'))">
  <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
  <meta property="og:site_name" content="AIAE">

  <link rel="alternate" hreflang="fr" href="{{ url()->current() }}?lang=fr">
  <link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
  <link rel="alternate" hreflang="x-default" href="{{ url('/') }}">

  @include('frontend.partials.schema-org')


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
      font-weight: 800;
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
  </style>
  @yield('styles')
</head>

<body class="font-futura bg-gray-100 overflow-x-hidden">
  @if(!isset($hideHeaderFooter) || !$hideHeaderFooter)
    @include('frontend.partials.navbar')
  @endif

  @yield('content')

  @if(!isset($hideHeaderFooter) || !$hideHeaderFooter)
    @include('frontend.partials.footer')
  @endif

  <!-- ================= JS ================= -->
  <script>
    function togglePanel(button, panel) {
      panel.classList.toggle("hidden");
      const arrow = button.querySelector(".arrow");
      arrow?.classList.toggle("rotate-180");
    }
  </script>
  @yield('scripts')
  @include('frontend.partials.rdv-modal')
  @include('frontend.partials.cookie-consent')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
