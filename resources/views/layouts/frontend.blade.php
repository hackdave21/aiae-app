<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'AIAE')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
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
  <!-- WhatsApp Floating Button -->
  <a href="https://wa.me/22890035416" target="_blank" rel="noopener noreferrer" 
     class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-110"
     aria-label="WhatsApp">
    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
  </a>
</body>

</html>
