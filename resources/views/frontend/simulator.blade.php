@extends('layouts.frontend')

@section('title', __('Simulateur AIAE (Afrika Infrastructures And Equipements) - Estimation Construction'))

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

      <!-- MODE SELECTEUR -->
      <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-8">
        <span class="text-white/70 text-sm font-medium">{{ __('Mode :') }}</span>
        <button id="mode-express" onclick="setMode('express')"
          class="px-6 py-2.5 rounded-lg font-semibold text-sm transition-all bg-white text-[#0E1540] shadow-lg">
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            {{ __('Express') }}
            <span class="text-[10px] opacity-60">3 {{ __('étapes') }}</span>
          </span>
        </button>
        <button id="mode-expert" onclick="setMode('expert')"
          class="px-6 py-2.5 rounded-lg font-semibold text-sm transition-all bg-white/20 text-white hover:bg-white/30">
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            {{ __('Expert') }}
            <span class="text-[10px] opacity-60">6 {{ __('étapes') }}</span>
          </span>
        </button>
      </div>

      <!-- CARD -->
      <div class="relative max-w-5xl mx-auto bg-[#8c93a9]/60 backdrop-blur-md rounded-[40px] p-6 md:p-8">

        <div class="absolute -top-4 left-6 bg-white text-black px-5 py-1.5 rounded-full text-[18px]">
          {{ __('Sélectionnez votre secteur') }}
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

          <!-- RESIDENTIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'residentiel']) }}"
            class="sector-link bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/resid.png') }}" alt="Résidentiel" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Résidentiel') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Villas, immeubles') }}</p>

          </a>

          <!-- TERTIAIRE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'tertiaire']) }}"
             class="sector-link bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/tert.png') }}" alt="Tertiaire" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Tertiaire') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Bureaux, hôtels') }}</p>

          </a>

          <!-- INDUSTRIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'industriel']) }}"
            class="sector-link bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

            <img src="{{ asset('aiae-frontend/Images/indus.png') }}" alt="Industriel" class="h-12 w-auto mb-4 object-contain">

            <h3 class="text-[28px] font-heavy">{{ __('Industriel') }}</h3>
            <p class="text-[18px] text-gray-500 font-light">{{ __('Usines, entrepôts') }}</p>

          </a>

          <!-- AGRICOLE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'agricole']) }}"
            class="sector-link bg-white text-black rounded-[40px] p-6 text-start cursor-pointer hover:scale-105 transition block">

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

  <script>
    let selectedMode = 'express';
    function setMode(mode) {
      selectedMode = mode;
      document.getElementById('mode-express').className = 'px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ' + (mode === 'express' ? 'bg-white text-[#0E1540] shadow-lg' : 'bg-white/20 text-white hover:bg-white/30');
      document.getElementById('mode-expert').className = 'px-6 py-2.5 rounded-lg font-semibold text-sm transition-all ' + (mode === 'expert' ? 'bg-white text-[#0E1540] shadow-lg' : 'bg-white/20 text-white hover:bg-white/30');
      document.querySelectorAll('.sector-link').forEach(function(link) {
        var url = new URL(link.href);
        url.searchParams.set('mode', mode);
        link.href = url.toString();
      });
    }
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.sector-link').forEach(function(link) {
        var url = new URL(link.href);
        url.searchParams.set('mode', 'express');
        link.href = url.toString();
      });
    });
  </script>
@endsection

