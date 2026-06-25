@php
    $routeName = Route::currentRouteName();
    
    // Config per page as in original header.js
    $pageConfigs = [
        'home' => ['mode' => 'floating', 'bg' => '', 'color' => '#1a1f4d'],
        'about' => ['mode' => 'fullwidth', 'bg' => 'bg-[#1a1f4d]', 'color' => '#1a1f4d'],
        'divisions' => ['mode' => 'fullwidth', 'bg' => 'bg-[#1a1f4d]', 'color' => '#1a1f4d'],
        'diaspora' => ['mode' => 'fullwidth', 'bg' => 'bg-primary', 'color' => '#05482c'],
        'faq' => ['mode' => 'fullwidth', 'bg' => 'bg-[#161c42]', 'color' => '#161c42'],
        'contact' => ['mode' => 'fullwidth', 'bg' => 'bg-[#0b5b3a]', 'color' => '#0b5b3a'],
        'mentions-legales' => ['mode' => 'fullwidth', 'bg' => 'bg-darkBlue', 'color' => '#121a44'],
        'profile' => ['mode' => 'fullwidth', 'bg' => 'bg-[#16205a]', 'color' => '#16205a'],
        'profile.simulations.show' => ['mode' => 'fullwidth', 'bg' => 'bg-[#16205a]', 'color' => '#16205a'],
    ];

    $config = $pageConfigs[$routeName] ?? ['mode' => 'fullwidth', 'bg' => 'bg-darkBlue', 'color' => '#121a44'];
    
    $menuItems = [
        ['label' => __('Accueil'), 'route' => 'home'],
        ['label' => __('À propos'), 'route' => 'about'],
        [
            'label' => __('Nos divisions'),
            'type' => 'dropdown',
            'active_route' => 'divisions',
            'items' => [
                ['label' => __('Construction'), 'route' => 'divisions'],
                ['label' => __('Énergie'), 'alert' => __('Cette section sera bientôt disponible.')],
                ['label' => __('Sécurité'), 'alert' => __('Cette section sera bientôt disponible.')],
                ['label' => __('Préfabrication'), 'alert' => __('Cette section sera bientôt disponible.')],
            ]
        ],
        ['label' => __('Simulateurs'), 'route' => 'simulator.index'],
        ['label' => __('Diaspora'), 'route' => 'diaspora'],
        ['label' => __('FAQ'), 'route' => 'faq'],
    ];
@endphp

<style>
    .nav-scrolled {
        background: rgba(18, 26, 68, 0.8) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    @if($config['mode'] === 'floating')
    #navBar {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    #navBar.nav-scrolled {
        top: 1rem !important;
        width: 90% !important;
    }
    @endif
</style>

<!-- ================= NAVBAR ================= -->
<header id="navBar" 
    @if($config['mode'] === 'floating')
        class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-7xl rounded-[28px] overflow-visible transition-all duration-300"
    @else
        class="fixed top-0 left-0 w-full z-50 {{ $config['bg'] }} overflow-visible transition-all duration-300"
    @endif
>
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3">
        <a href="{{ route('home') }}">
            <img src="{{ asset('aiae-frontend/Images/logos/LOGO_AIAE_BLANC.png') }}" alt="AIAE" class="aiae-header-logo h-12 md:h-16 w-auto object-contain" />
        </a>

        <ul class="hidden lg:flex items-center gap-2 text-sm font-medium">
            @foreach($menuItems as $item)
                @if(isset($item['type']) && $item['type'] === 'dropdown')
                    @php
                        $isActive = Route::is($item['active_route']);
                        $activeCls = "bg-white text-[{$config['color']}] shadow";
                        $inactiveCls = "bg-glassDark text-white hover:bg-white hover:text-[{$config['color']}]";
                    @endphp
                    <li class="relative group">
                        <span class="px-4 py-2 rounded-full block whitespace-nowrap font-light transition-colors cursor-pointer {{ $isActive ? $activeCls : $inactiveCls }}">
                            {{ $item['label'] }} ▾
                        </span>
                        <ul class="absolute left-0 top-full mt-2 w-56 bg-white rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-[100] border border-gray-100 overflow-hidden">
                            @foreach($item['items'] as $sub)
                                @if(isset($sub['route']))
                                    <li><a href="{{ route($sub['route']) }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">{{ $sub['label'] }}</a></li>
                                @else
                                    <li><a href="#" onclick="openComingSoon(); return false;" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-100 whitespace-nowrap">{{ $sub['label'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @else
                    @php
                        $isActive = Route::is($item['route']);
                        $activeCls = "bg-white text-[{$config['color']}] shadow";
                        $inactiveCls = "bg-glassDark text-white hover:bg-white hover:text-[{$config['color']}]";
                    @endphp
                    <li>
                        <a href="{{ route($item['route']) }}" 
                           class="px-4 py-2 rounded-full block whitespace-nowrap font-light transition-colors {{ $isActive ? $activeCls : $inactiveCls }}">
                            {{ $item['label'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        <div class="flex items-center gap-3">
            <div class="relative lang-switcher cursor-pointer">
                <div id="langBtn" class="flex items-center gap-1 px-3 h-10 rounded-full bg-glassDark justify-center hover:bg-white/20 transition-colors">
                    <span class="text-white font-bold text-sm">{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="w-3 h-3 text-white transition-transform duration-300" id="langArrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                
                <div id="langDropdown" class="absolute left-0 top-full mt-2 w-max min-w-[140px] bg-white rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 z-[100] border border-gray-100">
                    <a href="{{ route('lang.switch', 'fr') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'fr' ? 'font-bold bg-gray-50' : '' }} whitespace-nowrap">
                        Français
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() == 'en' ? 'font-bold bg-gray-50' : '' }} whitespace-nowrap">
                        English
                    </a>
                </div>
            </div>

            <a href="{{ route('profile') }}" class="w-10 h-10 rounded-full bg-glassDark flex items-center justify-center hover:bg-white/20 transition-colors">
                <img src="{{ asset('aiae-frontend/Images/Contact blanc.svg') }}" alt="Profile" class="h-5 w-5" />
            </a>
            <a href="{{ route('contact') }}" class="hidden sm:block px-5 py-2 rounded-full bg-white text-[{{ $config['color'] }}] shadow hover:bg-gray-100 transition-colors">
                {{ __('Contact') }}
            </a>
            <button id="burger" class="lg:hidden text-2xl rounded-full bg-glassDark p-2" aria-label="Menu">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Menu mobile -->
    <div id="mobileMenu" class="hidden lg:hidden mt-1 backdrop-blur-xl rounded-2xl p-4 space-y-2 shadow-xl mx-4" style="background:rgba(0,0,0,0.75)">
        <button id="closeMobile" class="w-full flex justify-end px-2 mb-2" aria-label="Fermer le menu">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
            </svg>
        </button>

        @foreach($menuItems as $item)
            @if(isset($item['type']) && $item['type'] === 'dropdown')
                @php $isActive = Route::is($item['active_route']); @endphp
                <div>
                    <div class="flex items-center justify-between px-4 py-3 rounded-lg transition-colors cursor-pointer {{ $isActive ? "bg-white text-[{$config['color']}]" : "bg-white/20 text-white hover:bg-white/30" }}"
                         onclick="this.nextElementSibling.classList.toggle('hidden')">
                        <span>{{ $item['label'] }}</span>
                        <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="hidden pl-4 space-y-1">
                        @foreach($item['items'] as $sub)
                            @if(isset($sub['route']))
                                <a href="{{ route($sub['route']) }}" class="block px-4 py-2 rounded-lg bg-white/10 text-white hover:bg-white/20">{{ $sub['label'] }}</a>
                            @else
                                <a href="#" onclick="openComingSoon(); return false;" class="block px-4 py-2 rounded-lg bg-white/10 text-white hover:bg-white/20">{{ $sub['label'] }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                @php $isActive = Route::is($item['route']); @endphp
                <a href="{{ route($item['route']) }}" 
                   class="block px-4 py-3 rounded-lg transition-colors {{ $isActive ? "bg-white text-[{$config['color']}]" : "bg-white/20 text-white hover:bg-white/30" }}">
                    {{ $item['label'] }}
                </a>
            @endif
        @endforeach
        
        <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg bg-white text-center text-[{{ $config['color'] }}] sm:hidden">
            {{ __('Contact') }}
        </a>
    </div>
</header>

<script>
    // Logic for Mobile Menu (Vanilla JS)
    document.addEventListener('DOMContentLoaded', () => {
        const burger = document.getElementById('burger');
        const mobileMenu = document.getElementById('mobileMenu');
        const closeMobile = document.getElementById('closeMobile');

        if (burger && mobileMenu) {
            burger.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        if (closeMobile && mobileMenu) {
            closeMobile.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        }

        // Close menu on link click
        const mobileLinks = mobileMenu?.querySelectorAll('a');
        mobileLinks?.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });

        // Language Switcher Logic
        const langBtn = document.getElementById('langBtn');
        const langDropdown = document.getElementById('langDropdown');
        const langArrow = document.getElementById('langArrow');

        if (langBtn && langDropdown) {
            langBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isVisible = !langDropdown.classList.contains('invisible');
                if (isVisible) {
                    langDropdown.classList.add('invisible', 'opacity-0');
                    langArrow?.classList.remove('rotate-180');
                } else {
                    langDropdown.classList.remove('invisible', 'opacity-0');
                    langArrow?.classList.add('rotate-180');
                }
            });

            // Close when clicking outside
            document.addEventListener('click', () => {
                langDropdown.classList.add('invisible', 'opacity-0');
                langArrow?.classList.remove('rotate-180');
            });
        }

        // Scroll effect for floating navbar
        const navBar = document.getElementById('navBar');
        if (navBar) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 40) {
                    navBar.classList.add('nav-scrolled');
                } else {
                    navBar.classList.remove('nav-scrolled');
                }
            });
        }
    });
</script>
