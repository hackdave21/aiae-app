<div id="cookieConsent" class="fixed bottom-0 left-0 right-0 z-[9999] bg-darkBlue text-white p-4 md:p-6 shadow-2xl translate-y-full transition-transform duration-500">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4">
    <p class="text-sm md:text-base font-light leading-relaxed">
      {{ __('Nous utilisons des cookies pour améliorer votre expérience de navigation. En poursuivant, vous acceptez notre utilisation des cookies.') }}
      <a href="{{ route('mentions-legales') }}" class="underline font-medium hover:opacity-80 transition-opacity">{{ __('En savoir plus') }}</a>.
    </p>
    <div class="flex gap-3 shrink-0">
      <button id="cookieAccept" class="bg-primary text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-opacity-90 transition-all">
        {{ __('Accepter') }}
      </button>
      <button id="cookieDecline" class="bg-white/10 text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-white/20 transition-all">
        {{ __('Refuser') }}
      </button>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var banner = document.getElementById('cookieConsent');
  if (localStorage.getItem('cookie_consent')) {
    banner.remove();
    return;
  }
  setTimeout(function() { banner.classList.remove('translate-y-full'); }, 500);

  function setConsent(value) {
    localStorage.setItem('cookie_consent', value);
    banner.classList.add('translate-y-full');
    setTimeout(function() { banner.remove(); }, 500);
  }

  document.getElementById('cookieAccept').addEventListener('click', function() { setConsent('accepted'); });
  document.getElementById('cookieDecline').addEventListener('click', function() { setConsent('declined'); });
});
</script>
