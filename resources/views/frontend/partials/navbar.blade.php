  <!-- ================= NAVBAR ================= -->
  <header id="navBar"
    class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-7xl rounded-[28px] overflow-hidden transition-all duration-300">
    <nav class="flex items-center justify-between px-4 sm:px-6 py-3">
      <img src="{{ asset('aiae-frontend/Images/logos/LOGO AIAE BLANC.png') }}" alt="logo"
        class="h-10 sm:h-12 md:h-14 lg:h-16 w-auto object-contain" />
      <ul class="hidden lg:flex items-center gap-2 text-sm font-medium font-FuturaStdLight">
        <li>
          <a href="{{ route('home') }}" class="px-4 py-2 rounded-full @if(Route::is('home')) bg-white shadow @else bg-glassDark text-white @endif block whitespace-nowrap">Accueil</a>
        </li>

        <li>
          <a href="#" class="px-4 py-2 rounded-full bg-glassDark text-white block whitespace-nowrap">À
            propos</a>
        </li>

        <li>
          <a href="#" class="px-4 py-2 rounded-full bg-glassDark text-white block whitespace-nowrap">Nos
            divisions</a>
        </li>

        <li>
          <a href="{{ route('simulator.index') }}"
            class="px-4 py-2 rounded-full @if(Route::is('simulator.index') || Route::is('simulator.v1')) bg-white shadow @else bg-glassDark text-white @endif block whitespace-nowrap">Simulateurs</a>
        </li>


        <li>
          <a href="#" class="px-4 py-2 rounded-full bg-glassDark text-white block whitespace-nowrap">Projets
            & Réalisations</a>
        </li>

        <li>
          <a href="#" class="px-4 py-2 rounded-full bg-glassDark text-white block whitespace-nowrap">FAQ</a>
        </li>
      </ul>

      <div class="flex items-center gap-2">
        <a href="{{ route('profile') }}" class="w-11 h-11 rounded-full bg-glassDark flex items-center justify-center hover:bg-white/20 transition-colors">
          <img src="{{ asset('aiae-frontend/Images/Contact blanc.svg') }}" alt="Profile" height="25" width="25" />
        </a>
        <button class="hidden sm:block px-5 py-2 rounded-full bg-white text-black">
          Contact
        </button>
        <button id="burger" class="lg:hidden text-2xl rounded-full bg-glassDark p-2">
          <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
          </svg>
        </button>
      </div>
    </nav>

    <!-- Menu mobile -->
    <div id="mobileMenu" class="hidden lg:hidden mt-3 bg-glass backdrop-blur-xl rounded-2xl p-4 space-y-2 shadow-xl">
      <button id="closeMobile" class="w-full text-right text-lg font-bold px-2 mb-2">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          width="24" height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18 17.94 6M18 18 6.06 6" />
        </svg>
      </button>

      <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg @if(Route::is('home')) bg-white @else bg-glassDark @endif">Accueil</a>
      <a href="#" class="block px-4 py-2 rounded-lg bg-glassDark">À propos</a>
      <a href="#" class="block px-4 py-2 rounded-lg bg-glassDark">Nos divisions</a>
      <a href="{{ route('simulator.index') }}" class="block px-4 py-2 rounded-lg @if(Route::is('simulator.index')) bg-white @else bg-glassDark @endif">Simulateurs</a>
      <a href="#" class="block px-4 py-2 rounded-lg bg-glassDark">Diaspora</a>
      <a href="#" class="block px-4 py-2 rounded-lg bg-glassDark">FAQ</a>
    </div>
  </header>
