<meta name="description" content="{{ $metaDescription ?? __('AIAE : Construction, énergie solaire, sécurité et préfabrication au Togo. De la conception à la réalisation, un partenaire unique pour vos projets d\'infrastructure.') }}">

<meta property="og:title" content="{{ $ogTitle ?? __('AIAE - Afrika Infrastructures And Equipements') }}">
<meta property="og:description" content="{{ $ogDescription ?? __('AIAE : Construction, énergie solaire, sécurité et préfabrication au Togo. De la conception à la réalisation.') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="{{ $ogType ?? 'website' }}">
<meta property="og:image" content="{{ $ogImage ?? asset('aiae-frontend/Images/logos/LOGO_AIAE_FINAL_-_Copie.png') }}">
<meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta property="og:site_name" content="AIAE">

<link rel="alternate" hreflang="fr" href="{{ url()->current() }}?lang=fr">
<link rel="alternate" hreflang="en" href="{{ url()->current() }}?lang=en">
<link rel="alternate" hreflang="x-default" href="{{ url('/') }}">
