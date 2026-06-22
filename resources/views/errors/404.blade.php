@extends('layouts.frontend')

@section('title', __('Page introuvable - AIAE'))

@section('meta_description', __('La page que vous cherchez n\'existe pas ou a été déplacée.'))

@section('content')
<section class="min-h-screen flex items-center justify-center px-6">
  <div class="text-center max-w-lg">
    <div class="text-[120px] md:text-[180px] font-heavy text-primary leading-none mb-4">404</div>
    <h1 class="text-3xl md:text-4xl font-heavy text-darkBlue mb-4">{{ __('Page introuvable') }}</h1>
    <p class="text-lg text-gray-600 mb-8 font-light">
      {{ __('La page que vous cherchez n\'existe pas ou a été déplacée.') }}
    </p>
    <a href="{{ route('home') }}" class="inline-block bg-primary text-white px-8 py-3 rounded-full font-medium hover:bg-opacity-90 transition-all">
      {{ __('Retour à l\'accueil') }}
    </a>
  </div>
</section>
@endsection
