/**
 * AIAE — Centralized Header Component
 * Injects a consistent header + mobile menu into every page.
 * Detects the current page to apply the correct desktop style
 * and highlight the active menu link.
 *
 * USAGE: Add <div id="header-placeholder"></div> in your HTML
 *        then <script src="js/header.js"></script> before </body>.
 */

(function () {
  "use strict";

  // ── Page detection ──────────────────────────────────────────
  const path = window.location.pathname.split("/").pop() || "index.html";
  const page = path.replace(".html", "").toLowerCase();

  // ── Config per page ─────────────────────────────────────────
  // floating = glassmorphism rounded navbar (index, simulator)
  // fullwidth = full-width solid bg navbar (all other pages)
  const PAGE_CONFIG = {
    index:     { mode: "floating", bg: "", color: "#1a1f4d" },
    simulator: { mode: "floating", bg: "", color: "#1a1f4d" },
    about:     { mode: "fullwidth", bg: "bg-[#1a1f4d]", color: "#1a1f4d" },
    division:  { mode: "fullwidth", bg: "bg-[#1a1f4d]", color: "#1a1f4d" },
    diaspora:  { mode: "fullwidth", bg: "bg-primary", color: "#05482c" },
    faq:       { mode: "fullwidth", bg: "bg-[#161c42]", color: "#161c42" },
    contact:   { mode: "fullwidth", bg: "bg-[#0b5b3a]", color: "#0b5b3a" },
    "mentions-legales": { mode: "fullwidth", bg: "bg-darkBlue", color: "#121a44" },
  };

  const config = PAGE_CONFIG[page] || PAGE_CONFIG["index"];

  // ── Menu items (single source of truth) ─────────────────────
  const MENU_ITEMS = [
    { label: "Accueil",       href: "index.html",     key: "index"     },
    { label: "À propos",      href: "about.html",     key: "about"     },
    { label: "Division construction", href: "division.html",  key: "division"  },
    { label: "Simulateurs",   href: "simulator.html", key: "simulator" },
    { label: "Diaspora",      href: "diaspora.html",  key: "diaspora"  },
    { label: "FAQ",           href: "faq.html",       key: "faq"       },
  ];

  // ── Build desktop menu links ────────────────────────────────
  function buildDesktopLinks() {
    return MENU_ITEMS.map(function (item) {
      var isActive = item.key === page;
      var cls = isActive
        ? 'px-4 py-2 rounded-full bg-white text-[' + config.color + '] shadow block whitespace-nowrap font-light'
        : 'px-4 py-2 rounded-full bg-glassDark text-white block whitespace-nowrap hover:bg-white hover:text-[' + config.color + '] transition-colors font-light';
      return '<li><a href="' + item.href + '" class="' + cls + '">' + item.label + '</a></li>';
    }).join("\n");
  }

  // ── Build mobile menu links ─────────────────────────────────
  function buildMobileLinks() {
    return MENU_ITEMS.map(function (item) {
      var isActive = item.key === page;
      var cls = isActive
        ? 'block px-4 py-3 rounded-lg bg-white text-[' + config.color + ']'
        : 'block px-4 py-3 rounded-lg bg-white/20 text-white hover:bg-white/30 transition-colors';
      return '<a href="' + item.href + '" class="' + cls + '">' + item.label + '</a>';
    }).join("\n");
  }

  // ── Generate HTML ───────────────────────────────────────────
  var headerHTML;

  if (config.mode === "floating") {
    // ▸ FLOATING STYLE (index.html, simulator.html)
    headerHTML = '\
<header id="navBar" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-7xl rounded-[28px] overflow-visible transition-all duration-300">\
  <nav class="flex items-center justify-between px-4 sm:px-6 py-3">\
    <a href="index.html">\
      <img src="Images/logos/LOGO_AIAE_BLANC.png" alt="AIAE" class="aiae-header-logo" />\
    </a>\
    <ul class="hidden lg:flex items-center gap-2 text-sm font-medium">\
      ' + buildDesktopLinks() + '\
    </ul>\
    <div class="flex items-center gap-2">\
      <button class="w-11 h-11 rounded-full bg-glassDark flex items-center justify-center">\
        <img src="Images/Contact blanc.svg" alt="" height="25" width="25" />\
      </button>\
      <a href="contact.html" class="hidden sm:block px-5 py-2 rounded-full bg-white text-black">Contact</a>\
      <button id="aiae-burger" class="lg:hidden text-2xl rounded-full bg-glassDark p-2" aria-label="Menu">\
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">\
          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />\
        </svg>\
      </button>\
    </div>\
  </nav>\
  <!-- Mobile Menu -->\
  <div id="aiae-mobile-menu" class="hidden lg:hidden mt-3 bg-glass backdrop-blur-xl rounded-2xl p-4 space-y-2 shadow-xl mx-2">\
    <button id="aiae-close-mobile" class="w-full flex justify-end px-2 mb-2" aria-label="Fermer le menu">\
      <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">\
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />\
      </svg>\
    </button>\
    ' + buildMobileLinks() + '\
    <a href="contact.html" class="block px-4 py-3 rounded-lg bg-white text-center text-[' + config.color + '] sm:hidden">Contact</a>\
  </div>\
</header>';

  } else {
    // ▸ FULL-WIDTH STYLE (about, division, diaspora, faq, contact)
    headerHTML = '\
<header id="navBar" class="fixed top-0 left-0 w-full z-50 ' + config.bg + '">\
  <nav class="max-w-7xl mx-auto flex items-center justify-between px-6 py-3">\
    <a href="index.html">\
      <img src="Images/logos/LOGO_AIAE_BLANC.png" alt="AIAE" class="aiae-header-logo" />\
    </a>\
    <ul class="hidden lg:flex items-center gap-2 text-sm font-medium">\
      ' + buildDesktopLinks() + '\
    </ul>\
    <div class="flex items-center gap-3">\
      <button class="w-10 h-10 rounded-full bg-glassDark flex items-center justify-center">\
        <img src="Images/Contact blanc.svg" alt="" class="h-5 w-5" />\
      </button>\
      <a href="contact.html" class="hidden sm:block px-5 py-2 rounded-full bg-white text-[' + config.color + '] shadow">Contact</a>\
      <button id="aiae-burger" class="lg:hidden text-2xl rounded-full bg-glassDark p-2" aria-label="Menu">\
        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">\
          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10" />\
        </svg>\
      </button>\
    </div>\
  </nav>\
  <!-- Mobile Menu -->\
  <div id="aiae-mobile-menu" class="hidden lg:hidden mt-1 backdrop-blur-xl rounded-2xl p-4 space-y-2 shadow-xl mx-4" style="background:rgba(0,0,0,0.75)">\
    <button id="aiae-close-mobile" class="w-full flex justify-end px-2 mb-2" aria-label="Fermer le menu">\
      <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">\
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />\
      </svg>\
    </button>\
    ' + buildMobileLinks() + '\
    <a href="contact.html" class="block px-4 py-3 rounded-lg bg-white text-center text-[' + config.color + '] sm:hidden">Contact</a>\
  </div>\
</header>';
  }

  // ── Inject into DOM ─────────────────────────────────────────
  var placeholder = document.getElementById("header-placeholder");
  if (placeholder) {
    placeholder.innerHTML = headerHTML;
  } else {
    // Fallback: insert at the beginning of <body>
    document.body.insertAdjacentHTML("afterbegin", headerHTML);
  }

  // ── Burger toggle ───────────────────────────────────────────
  var burger = document.getElementById("aiae-burger");
  var mobileMenu = document.getElementById("aiae-mobile-menu");
  var closeBtn = document.getElementById("aiae-close-mobile");

  function openMenu() {
    if (mobileMenu) mobileMenu.classList.remove("hidden");
  }

  function closeMenu() {
    if (mobileMenu) mobileMenu.classList.add("hidden");
  }

  if (burger) {
    burger.addEventListener("click", function (e) {
      e.stopPropagation();
      if (mobileMenu.classList.contains("hidden")) {
        openMenu();
      } else {
        closeMenu();
      }
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      closeMenu();
    });
  }

  // ── Close on outside click ──────────────────────────────────
  document.addEventListener("click", function (e) {
    if (!mobileMenu || mobileMenu.classList.contains("hidden")) return;
    // If the click is outside the mobile menu AND outside the burger
    var isInsideMenu = mobileMenu.contains(e.target);
    var isInsideBurger = burger && burger.contains(e.target);
    if (!isInsideMenu && !isInsideBurger) {
      closeMenu();
    }
  });

  // ── Scroll effect (floating mode only) ──────────────────────
  if (config.mode === "floating") {
    var navBar = document.getElementById("navBar");
    if (navBar) {
      window.addEventListener("scroll", function () {
        if (window.scrollY > 30) {
          navBar.classList.add("nav-scrolled");
        } else {
          navBar.classList.remove("nav-scrolled");
        }
      });
    }
  }

})();
