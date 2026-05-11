@extends('admin.layouts.master')

@section('title', 'Détails du Devis - ' . $quotation->quotation_number)

@section('content')
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Détails Devis: {{ $quotation->quotation_number }}</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.quotations.index') }}">Devis</a></li>
                <li class="breadcrumb-item">Détails</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <!-- Quotation Info -->
            <div class="col-xxl-4 col-lg-5">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <div class="avatar-text avatar-xl bg-soft-info text-info mx-auto mb-3">
                                <i class="feather-file-text fs-1"></i>
                            </div>
                            <h4 class="mb-1">{{ $quotation->quotation_number }}</h4>
                            <span class="badge bg-soft-primary text-primary">{{ $quotation->status }}</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Lead / Client</span>
                                <span class="fw-medium text-dark">
                                    @if($quotation->lead)
                                        <a href="{{ route('admin.leads.show', $quotation->lead) }}">{{ $quotation->lead->first_name }} {{ $quotation->lead->last_name }}</a>
                                    @else
                                        Inconnu
                                    @endif
                                </span>
                            </li>
                            @if($quotation->lead && $quotation->lead->phone)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Téléphone</span>
                                <span class="fw-medium text-dark">{{ $quotation->lead->phone }}</span>
                            </li>
                            @endif
                            @if($quotation->lead && $quotation->lead->pays_residence)
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Pays de résidence</span>
                                <span class="fw-medium text-dark">{{ $quotation->lead->pays_residence }}</span>
                            </li>
                            @endif
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Simulation</span>
                                <span class="fw-medium text-dark">
                                    @if($quotation->simulation_id)
                                        <a href="{{ route('admin.simulations.show', $quotation->simulation_id) }}">
                                            {{ $quotation->simulation->reference_id ?? 'SIM-' . $quotation->simulation_id }}
                                        </a>
                                    @else
                                        <span class="text-muted italic">Aucune (Demande Directe)</span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Date d'émission</span>
                                <span class="fw-medium text-dark">{{ $quotation->created_at->format('d/m/Y') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Date de validité</span>
                                <span class="fw-medium text-{{ $quotation->valid_until->isPast() ? 'danger' : 'dark' }}">
                                    {{ $quotation->valid_until->format('d/m/Y') }}
                                </span>
                            </li>
                        </ul>
                        <div class="mt-4 d-grid gap-2">
                            @if($quotation->status != 'accepted')
                                <form action="{{ route('admin.quotations.accept', $quotation) }}" method="POST" class="d-grid">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="feather-check-circle me-2"></i>Accepter le Devis
                                    </button>
                                </form>
                            @endif
                            @if($quotation->status != 'rejected')
                                <form action="{{ route('admin.quotations.reject', $quotation) }}" method="POST" class="d-grid">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="feather-x-circle me-2"></i>Refuser le Devis
                                    </button>
                                </form>
                            @endif


                            
                            @if($quotation->pdf_path)
                                <a href="{{ asset('storage/' . $quotation->pdf_path) }}" class="btn btn-primary" target="_blank">
                                    <i class="feather-download me-2"></i>Télécharger le Document
                                </a>
                            @else
                                <button class="btn btn-light disabled">
                                    <i class="feather-slash me-2"></i>Document non disponible
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Linked Simulation or Contact Request Detailed Info -->
            <div class="col-xxl-8 col-lg-7">
                @if($quotation->simulation_id)
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Résumé de la Simulation Associée</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <h6 class="text-muted fs-12 text-uppercase mb-2">Type de Secteur</h6>
                                <p class="fw-bold text-dark mb-0">{{ $quotation->simulation->sectorType->name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-sm-6 text-sm-end">
                                <h6 class="text-muted fs-12 text-uppercase mb-2">Montant Total TTC</h6>
                                <h4 class="text-primary mb-0">{{ number_format($quotation->simulation->total_amount_ttc, 0, ',', ' ') }} XOF</h4>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-end">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Prix de Base ({{ $quotation->simulation->input_quantity }} @if($quotation->simulation->sectorType && $quotation->simulation->sectorType->base_price_mode == 'area') m² @else unités @endif)</td>
                                        <td class="text-end">{{ number_format($quotation->simulation->base_amount, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                    <tr>
                                        <td>Options Sélectionnées</td>
                                        <td class="text-end">{{ number_format($quotation->simulation->options_amount, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total HT</td>
                                        <td class="text-end">{{ number_format($quotation->simulation->total_amount_ht, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                    <tr>
                                        <td>TVA / Taxes</td>
                                        <td class="text-end">{{ number_format($quotation->simulation->tax_amount, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-dark text-white">
                                    <tr class="fw-bold">
                                        <td class="text-white">TOTAL TTC</td>
                                        <td class="text-end text-white text-primary">{{ number_format($quotation->simulation->total_amount_ttc, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="text-end">
                    <a href="{{ route('admin.simulations.show', $quotation->simulation_id) }}" class="btn btn-light-brand">
                        Voir la simulation complète <i class="feather-arrow-right ms-2"></i>
                    </a>
                </div>
                @endif

                @if($quotation->lead)
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Détails de la demande client</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="text-muted fs-11 text-uppercase mb-1">Type de projet</h6>
                                <p class="fw-bold text-dark">{{ $quotation->lead->type_projet ?: 'Non spécifié' }}</p>
                            </div>
                            <div class="col-md-6 text-sm-end">
                                <h6 class="text-muted fs-11 text-uppercase mb-1">Budget estimé</h6>
                                <p class="fw-bold text-primary fs-16">{{ number_format($quotation->lead->budget_estime, 0, ',', ' ') }} XOF</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted fs-11 text-uppercase mb-1">Délai souhaité</h6>
                                <p class="fw-bold text-dark">{{ $quotation->lead->delai_souhaite ?: 'Non spécifié' }}</p>
                            </div>
                            <div class="col-md-6 text-sm-end">
                                <h6 class="text-muted fs-11 text-uppercase mb-1">Localisation du projet</h6>
                                @if($quotation->lead->localisation_projet)
                                    <a href="https://www.google.com/maps/search/{{ urlencode($quotation->lead->localisation_projet) }}" target="_blank" class="fw-bold text-info text-decoration-underline">
                                        <i class="feather-map-pin me-1"></i>{{ $quotation->lead->localisation_projet }}
                                    </a>
                                @else
                                    <p class="fw-bold text-dark">Non spécifié</p>
                                @endif
                            </div>
                            <div class="col-12 mt-4">
                                <h6 class="text-muted fs-11 text-uppercase mb-1 text-primary border-bottom pb-1">Description du projet</h6>
                                <p class="text-dark bg-light p-3 rounded" style="white-space: pre-line;">{{ $quotation->lead->description_projet ?: $quotation->lead->message ?: 'Aucune description fournie.' }}</p>
                            </div>
                            
                            @if($quotation->pdf_path)
                            <div class="col-12 mt-4">
                                <div class="bg-soft-info p-3 rounded d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <i class="feather-paperclip fs-4 text-info me-3"></i>
                                        <div>
                                            <h6 class="mb-0">Pièce jointe du client</h6>
                                            <small class="text-muted">Document ou croquis fourni lors de la demande</small>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $quotation->pdf_path) }}" class="btn btn-info btn-sm" target="_blank">
                                        <i class="feather-external-link me-1"></i> Voir le document
                                    </a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
