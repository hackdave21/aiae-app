@extends('layouts.frontend')

@section('title', 'Simulateur AIAE')

@section('styles')
  <style>
    .hero-simulator {
      min-h-screen pt-24 pb-10 text-white relative overflow-hidden;
      background-image:url('{{ asset('aiae-frontend/Images/sim1.png') }}'); 
      background-size:cover; 
      background-position:center;
    }
  </style>
@endsection

@section('content')
  <!-- ================= HERO SIMULATEUR ================= -->
  <section class="min-h-screen pt-24 pb-10 text-white relative overflow-hidden"
    style="background-image:url('{{ asset('aiae-frontend/Images/sim1.png') }}'); background-size:cover; background-position:center;">

    <div class="max-w-6xl mx-auto px-6 text-center">

      <h1 class="text-4xl md:text-5xl font-bold mb-3">
        Simulateur d'Estimation
      </h1>

      <p class="text-sm sm:text-base opacity-80 mb-10 tracking-wide break-words">
        AFRIKA INFRASTRUCTURE AND EQUIPEMENTS
      </p>

      <!-- CARD -->
      <div class="relative max-w-5xl mx-auto bg-[#8c93a9]/60 backdrop-blur-md rounded-[36px] p-6 md:p-8">

        <div class="absolute -top-4 left-6 bg-white text-black px-5 py-1.5 rounded-full text-xs">
          Sélectionnez votre secteur
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

          <!-- RESIDENTIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'residentiel']) }}"
            class="bg-white text-black rounded-2xl p-6 text-center cursor-pointer hover:scale-105 transition block">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-[#1a1f4d]" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4a2 2 0 01-2-2V12H9v8a2 2 0 01-2 2H3z" />
            </svg>

            <h3 class="text-lg font-semibold">Résidentiel</h3>
            <p class="text-xs text-gray-500">Villas, immeubles</p>

          </a>

          <!-- TERTIAIRE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'tertiaire']) }}"
            class="bg-white text-black rounded-2xl p-6 text-center cursor-pointer hover:scale-105 transition block">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-[#1a1f4d]" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 3h16v18H4zM9 21V9h6v12" />
            </svg>

            <h3 class="text-lg font-semibold">Tertiaire</h3>
            <p class="text-xs text-gray-500">Bureaux, hôtels</p>

          </a>

          <!-- INDUSTRIEL -->
          <a href="{{ route('simulator.v1', ['secteur' => 'industriel']) }}"
            class="bg-white text-black rounded-2xl p-6 text-center cursor-pointer hover:scale-105 transition block">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-[#1a1f4d]" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 21h18M5 21V8l7-4v17M19 21V10l-6-3" />
            </svg>

            <h3 class="text-lg font-semibold">Industriel</h3>
            <p class="text-xs text-gray-500">Usines, entrepôts</p>

          </a>

          <!-- AGRICOLE -->
          <a href="{{ route('simulator.v1', ['secteur' => 'agricole']) }}"
            class="bg-white text-black rounded-2xl p-6 text-center cursor-pointer hover:scale-105 transition block">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 mx-auto mb-3 text-[#1a1f4d]" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 3v18M6 7c2 2 2 6 0 8M18 7c-2 2-2 6 0 8" />
            </svg>

            <h3 class="text-lg font-semibold">Agricole</h3>
            <p class="text-xs text-gray-500">Élevage, stockage</p>

          </a>

        </div>
      </div>

      <!-- BOUTON -->
      <div class="mt-10 flex justify-center w-full">

        <a href="{{ route('energie.calculator') }}" target="_blank"
          class="bg-[#f78b0c] hover:bg-orange-600 transition text-white text-sm sm:text-lg font-semibold px-6 sm:px-8 py-4 rounded-full flex items-center justify-center gap-3 w-full sm:w-auto">

          Ouvrir Le Calculateur d’énergies Renouvelables

          <span class="bg-white text-orange-500 rounded-full w-8 h-8 flex items-center justify-center text-sm shrink-0">
            ➤
          </span>

        </a>

      </div>

    </div>
  </section>
@endsection
