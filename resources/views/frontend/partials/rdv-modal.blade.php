{{-- ============================================================
     MODAL RENDEZ-VOUS — Include this partial before </body>
     Requires: SweetAlert2 + Tailwind
     ============================================================ --}}

{{-- Modal Overlay --}}
<div id="rdvModalOverlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9998] hidden transition-opacity duration-300 opacity-0"></div>

{{-- Modal Content --}}
<div id="rdvModal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 hidden">
  <div class="bg-white rounded-3xl shadow-2xl w-full max-w-[520px] overflow-hidden transform scale-95 transition-transform duration-300" id="rdvModalContent">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-[#162064] to-[#05482C] px-8 py-6 relative">
      <button onclick="closeRdvModal()" class="absolute top-4 right-4 text-white/70 hover:text-white transition-colors">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
      <h3 class="text-white text-2xl font-heavy">{{ __('Prendre Rendez-vous') }}</h3>
      <p class="text-white/70 text-sm mt-1">{{ __('Choisissez la modalité qui vous convient') }}</p>
    </div>

    {{-- Body --}}
    <form id="rdvForm" class="px-8 py-6 space-y-5">
      @csrf

      {{-- Type de RDV --}}
      <div>
        <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">{{ __('Type de rendez-vous') }}</label>
        <div class="grid grid-cols-2 gap-3">
          <label class="rdv-type-option group">
            <input type="radio" name="rdv_type" value="physique" class="hidden peer" checked>
            <div class="peer-checked:border-[#FF8400] peer-checked:bg-[#FF8400]/5 border-2 border-gray-200 rounded-2xl p-4 cursor-pointer transition-all hover:border-[#FF8400]/50 text-center">
              <div class="mb-2 flex justify-center text-[#162064] group-hover:text-[#FF8400] transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
              </div>
              <div class="font-bold text-[#162064] text-sm">{{ __('Au siège') }}</div>
              <div class="text-[10px] text-gray-400 mt-1">Lomé, Togo</div>
            </div>
          </label>
          <label class="rdv-type-option group">
            <input type="radio" name="rdv_type" value="appel" class="hidden peer">
            <div class="peer-checked:border-[#FF8400] peer-checked:bg-[#FF8400]/5 border-2 border-gray-200 rounded-2xl p-4 cursor-pointer transition-all hover:border-[#FF8400]/50 text-center">
              <div class="mb-2 flex justify-center text-[#162064] group-hover:text-[#FF8400] transition-colors">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
              </div>
              <div class="font-bold text-[#162064] text-sm">{{ __('Par appel') }}</div>
              <div class="text-[10px] text-gray-400 mt-1">{{ __('Téléphone / Visio') }}</div>
            </div>
          </label>
        </div>
      </div>

      {{-- Message --}}
      <div>
        <label class="block text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">{{ __('Message') }} <span class="text-gray-300 normal-case font-normal">{{ __('(facultatif)') }}</span></label>
        <textarea name="rdv_message" rows="3" placeholder="{{ __('Décrivez brièvement l\'objet de votre rendez-vous...') }}"
          class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-700 placeholder-gray-400 outline-none focus:border-[#FF8400] resize-none transition-colors"></textarea>
      </div>

      {{-- Submit --}}
      <button type="submit" id="rdvSubmitBtn"
        class="w-full bg-[#111736] text-white py-4 rounded-xl font-bold text-base tracking-wide hover:bg-[#FF8400] transition-all duration-300 cursor-pointer">
        {{ __('ENVOYER MA DEMANDE') }}
      </button>

      <p class="text-center text-[11px] text-gray-400">
        {{ __('Notre équipe vous recontactera sous 24 à 48h pour confirmer votre rendez-vous.') }}
      </p>
    </form>
  </div>
</div>

{{-- ============================================================
     JAVASCRIPT — Modal Logic + AJAX Submission
     ============================================================ --}}
<script>
  function openRdvModal(type) {
    @auth
      // User is logged in — show the modal
      const overlay = document.getElementById('rdvModalOverlay');
      const modal = document.getElementById('rdvModal');
      const content = document.getElementById('rdvModalContent');

      overlay.classList.remove('hidden');
      modal.classList.remove('hidden');

      // Animate in
      requestAnimationFrame(() => {
        overlay.style.opacity = '1';
        content.style.transform = 'scale(1)';
      });

      // Pre-select type
      if (type === 'appel' || type === 'visio' || type === 'en_ligne') {
        const appelRadio = document.querySelector('input[name="rdv_type"][value="appel"]');
        if (appelRadio) appelRadio.checked = true;
      } else {
        const physiqueRadio = document.querySelector('input[name="rdv_type"][value="physique"]');
        if (physiqueRadio) physiqueRadio.checked = true;
      }

      // Close on overlay click
      overlay.onclick = closeRdvModal;

      // Close on Escape
      document.addEventListener('keydown', function escHandler(e) {
        if (e.key === 'Escape') {
          closeRdvModal();
          document.removeEventListener('keydown', escHandler);
        }
      });
    @else
      // User is NOT logged in — redirect to login/register
      if (typeof Swal !== 'undefined') {
        Swal.fire({
          title: 'Connexion requise',
          text: 'Vous devez être connecté pour prendre un rendez-vous.',
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#162064',
          cancelButtonColor: '#FF8400',
          confirmButtonText: 'Se connecter',
          cancelButtonText: 'S\'inscrire'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '{{ route("login") }}';
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = '{{ route("register") }}';
          }
        });
      } else {
        if (confirm('Vous devez être connecté pour prendre un rendez-vous. Voulez-vous vous connecter ?')) {
          window.location.href = '{{ route("login") }}';
        }
      }
    @endauth
  }

  function closeRdvModal() {
    const overlay = document.getElementById('rdvModalOverlay');
    const modal = document.getElementById('rdvModal');
    const content = document.getElementById('rdvModalContent');

    overlay.style.opacity = '0';
    content.style.transform = 'scale(0.95)';

    setTimeout(() => {
      overlay.classList.add('hidden');
      modal.classList.add('hidden');
    }, 300);
  }

  // Form submission
  document.addEventListener('DOMContentLoaded', function() {
    const rdvForm = document.getElementById('rdvForm');
    if (rdvForm) {
      rdvForm.addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('rdvSubmitBtn');
        const originalText = submitBtn.textContent;
        submitBtn.disabled = true;
        submitBtn.textContent = 'ENVOI EN COURS...';
        submitBtn.style.opacity = '0.7';

        const formData = new FormData(this);

        try {
          const response = await fetch('{{ route("appointment.request") }}', {
            method: 'POST',
            body: formData,
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('#rdvForm input[name="_token"]').value
            }
          });

          const result = await response.json();

          if (response.ok && result.success) {
            closeRdvModal();
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                title: 'Demande envoyée !',
                text: result.message,
                icon: 'success',
                confirmButtonColor: '#162064',
                confirmButtonText: 'OK'
              });
            } else {
              alert(result.message);
            }
            rdvForm.reset();
          } else {
            throw new Error(result.message || 'Une erreur est survenue.');
          }
        } catch (error) {
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
          submitBtn.textContent = originalText;
          submitBtn.style.opacity = '1';
        }
      });
    }
  });
</script>
