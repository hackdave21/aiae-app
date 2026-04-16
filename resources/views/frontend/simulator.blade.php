@extends('layouts.frontend')

@section('title', 'Simulateur AIAE')

@section('content')
  <!-- ================= HERO SIMULATEUR ================= -->
  <section class="min-h-screen pt-28 pb-10 text-white relative overflow-hidden"
    style="background-image:url('{{ asset('aiae-frontend/Images/sim1.png') }}'); background-size:cover; background-position:center;">

    <div class="max-w-6xl mx-auto px-6 text-center">

      <h1 class="text-4xl md:text-5xl font-bold mb-3">
        {{ __('Simulateur d\'Estimation') }}
      </h1>

      <p class="text-sm sm:text-base opacity-80 mb-10 tracking-wide break-words font-light">
        {{ __('AFRIKA INFRASTRUCTURE AND EQUIPEMENTS') }}
      </p>

      <!-- CARD -->
      <div class="relative max-w-5xl mx-auto bg-[#8c93a9]/60 backdrop-blur-md rounded-[40px] p-6 md:p-8">

        <div class="absolute -top-4 left-6 bg-white text-black px-5 py-1.5 rounded-full text-[18px]">
          {{ __('Sélectionnez votre secteur') }}
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

          <!-- RESIDENTIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'residentiel']) }}"
            class="bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/resid.png') }}" alt="Résidentiel" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Résidentiel') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Villas, immeubles') }}</p>

          </a>

          <!-- TERTIAIRE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'tertiaire']) }}"
             class="bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/tert.png') }}" alt="Tertiaire" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Tertiaire') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Bureaux, hôtels') }}</p>

          </a>

          <!-- INDUSTRIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'industriel']) }}"
            class="bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/indus.png') }}" alt="Industriel" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Industriel') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Usines, entrepôts') }}</p>

          </a>

          <!-- AGRICOLE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'agricole']) }}"
            class="bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/agri.png') }}" alt="Agricole" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Agricole') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Élevage, stockage') }}</p>

          </a>

        </div>
      </div>

      <!-- BOUTON -->
      <div class="mt-10 flex justify-center w-full">

        <a href="{{ route('energie.calculator') }}"
          class="bg-[#f78b0c] hover:bg-orange-600 transition text-white text-xl sm:text-2xl font-heavy px-6 sm:px-8 py-4 rounded-full flex items-center justify-center gap-3 w-full sm:w-auto">
          {{ __('Calculateur Énergie') }}

          <img src="{{ asset('aiae-frontend/Images/envoiblanc.png') }}" alt="" class="flex-shrink-0 w-10 h-10 object-contain">

        </a>

      </div>

    </div>
  </section>
@endsection

