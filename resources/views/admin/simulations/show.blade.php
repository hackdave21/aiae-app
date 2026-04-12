@extends('admin.layouts.master')

@section('title', 'Détails de la Simulation - ' . ($simulation->reference_id ?? $simulation->id))

@section('content')
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Détails Simulation: {{ $simulation->reference_id ?? 'SIM-' . $simulation->id }}</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.simulations.index') }}">Simulations</a></li>
                <li class="breadcrumb-item">Détails</li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <div class="row">
            <!-- Simulation Overview -->
            <div class="col-xxl-4 col-lg-5">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <div class="avatar-text avatar-xl bg-soft-primary text-primary mx-auto mb-3">
                                <i class="feather-activity fs-1"></i>
                            </div>
                            <h4 class="mb-1">{{ $simulation->reference_id ?? 'SIM-' . $simulation->id }}</h4>
                            <span class="badge bg-soft-success text-success">{{ $simulation->status }}</span>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Client / Lead</span>
                                <span class="fw-medium text-dark">
                                    @if($simulation->lead)
                                        <a href="{{ route('admin.leads.show', $simulation->lead) }}">{{ $simulation->lead->first_name }} {{ $simulation->lead->last_name }}</a>
                                    @elseif($simulation->user)
                                        {{ $simulation->user->name }}
                                    @else
                                        Anonyme
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Type de Secteur</span>
                                <span class="fw-medium text-dark">{{ $simulation->sectorType->name ?? 'N/A' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Quantité/Surface</span>
                                <span class="fw-medium text-dark">{{ $simulation->input_quantity }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                <span class="text-muted">Date de création</span>
                                <span class="fw-medium text-dark">{{ $simulation->created_at->format('d/m/Y H:i') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="card stretch stretch-full text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title text-white mb-4">Résumé Financier</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Montant de Base</span>
                            <span class="fw-bold">{{ number_format($simulation->base_amount, 0, ',', ' ') }} XOF</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Options</span>
                            <span class="fw-bold">+ {{ number_format($simulation->options_amount, 0, ',', ' ') }} XOF</span>
                        </div>
                        <hr class="bg-white op-20">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total HT</span>
                            <span class="fw-bold">{{ number_format($simulation->total_amount_ht, 0, ',', ' ') }} XOF</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span>TVA</span>
                            <span>{{ number_format($simulation->tax_amount, 0, ',', ' ') }} XOF</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-white mb-0">TOTAL TTC</h4>
                            <h3 class="text-primary mb-0">{{ number_format($simulation->total_amount_ttc, 0, ',', ' ') }} XOF</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuration Data & Options -->
            <div class="col-xxl-8 col-lg-7">
                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Données de Configuration</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @php
                                $config = $simulation->configuration_data;
                            @endphp

                            @if($config && is_array($config))
                                <!-- 1. Section Terrain & Localisation -->
                                <div class="col-sm-6 col-xxl-4 mb-4">
                                    <h6 class="fs-13 fw-bold text-uppercase mb-3 border-bottom pb-2 text-primary">
                                        <i class="feather-map-pin me-2"></i>Terrain & Zone
                                    </h6>
                                    <div class="space-y-3">
                                        <div class="py-1">
                                            <span class="text-muted d-block fs-11 text-uppercase mb-1">Type de Sol</span>
                                            <span class="fw-bold text-dark">{{ $lookup['sols'][$config['sol'] ?? ''] ?? $config['sol'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="py-1">
                                            <span class="text-muted d-block fs-11 text-uppercase mb-1">Zone Géographique</span>
                                            <span class="fw-bold text-dark d-block" style="line-height: 1.4;">{{ $lookup['zones'][$config['zone'] ?? ''] ?? $config['zone'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="py-1 border-top pt-2">
                                            <span class="text-muted">Terrain Disponible :</span>
                                            <span class="fw-bold text-dark ms-2">{{ ($config['terrainDispo'] ?? '') === 'oui' ? 'Oui' : 'Non / À acquérir' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Section Caractéristiques Bâtiment -->
                                <div class="col-sm-6 col-xxl-4 mb-4 border-start-md">
                                    <h6 class="fs-13 fw-bold text-uppercase mb-3 border-bottom pb-2 text-primary">
                                        <i class="feather-home me-2"></i>Architecture
                                    </h6>
                                    <div class="space-y-2">
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Type Bâtiment :</span>
                                            <span class="fw-bold text-dark">{{ $lookup['types'][$config['typeBat'] ?? ''] ?? $config['typeBat'] ?? 'N/A' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Standing :</span>
                                            <span class="fw-bold text-dark text-capitalize">{{ $lookup['standings'][$config['standing'] ?? ''] ?? $config['standing'] ?? 'Standard' }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Niveaux (H.S) :</span>
                                            <span class="fw-bold text-dark">{{ $config['dimensions']['niveaux'] ?? $config['niveaux'] ?? 1 }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Sous-sol :</span>
                                            <span class="fw-bold text-dark">{{ $config['dimensions']['ssSol'] ?? $config['ssSol'] ?? 0 }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Section Dimensions & Surfaces -->
                                <div class="col-sm-6 col-xxl-4 mb-4 border-start-xxl">
                                    <h6 class="fs-13 fw-bold text-uppercase mb-3 border-bottom pb-2 text-primary">
                                        <i class="feather-maximize me-2"></i>Dimensions
                                    </h6>
                                    <div class="space-y-2">
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Forme :</span>
                                            <span class="fw-bold text-dark">{{ ucfirst($config['dimensions']['forme'] ?? $config['forme'] ?? 'N/A') }}</span>
                                        </div>
                                        @if(isset($config['dimensions']['dimA']) || isset($config['dimA']))
                                            <div class="d-flex justify-content-between py-1">
                                                <span class="text-muted">L / Côté :</span>
                                                <span class="fw-bold text-dark">{{ $config['dimensions']['dimA'] ?? $config['dimA'] }} m</span>
                                            </div>
                                        @endif
                                        @if(isset($config['dimensions']['dimB']) || isset($config['dimB']))
                                            <div class="d-flex justify-content-between py-1">
                                                <span class="text-muted">Largeur :</span>
                                                <span class="fw-bold text-dark">{{ $config['dimensions']['dimB'] ?? $config['dimB'] }} m</span>
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-between py-1">
                                            <span class="text-muted">Surface Bâtie :</span>
                                            <span class="fw-bold text-primary">{{ number_format($config['dimensions']['surfaceBatie'] ?? 0, 0, ',', ' ') }} m²</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4. Section Options Équipements -->
                                <div class="col-12 mt-2">
                                    <h6 class="fs-13 fw-bold text-uppercase mb-3 border-bottom pb-2 text-primary">
                                        <i class="feather-plus-circle me-2"></i>Aperçu Équipements
                                    </h6>
                                    <div class="row">
                                        @php
                                            $opts = $config['options'] ?? [];
                                        @endphp
                                        <div class="col-md-3">
                                            <small class="text-muted d-block mb-1">Solaire</small>
                                            <p class="fw-bold">{{ $opts['solaire'] ? 'Oui (' . strtoupper($opts['solaire']) . ')' : 'Non' }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block mb-1">Groupe</small>
                                            <p class="fw-bold">{{ $opts['groupe'] ? 'Oui (' . strtoupper($opts['groupe']) . ')' : 'Non' }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block mb-1">Sécurité</small>
                                            <p class="fw-bold">{{ !empty($opts['alarme']) || !empty($opts['video']) ? 'Inclus' : 'Aucun' }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block mb-1">Services</small>
                                            <p class="fw-bold">{{ !empty($opts['piscine']) ? 'Piscine' : '' }} {{ !empty($opts['forage']) ? 'Forage' : '' }} {{ empty($opts['piscine']) && empty($opts['forage']) ? 'Aucun' : '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-12">
                                    <p class="text-muted text-center py-4">Aucune donnée de configuration détaillée n'a été trouvée pour cette simulation.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card stretch stretch-full">
                    <div class="card-header">
                        <h5 class="card-title">Détails des Options Sélectionnées</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Équipement / Option</th>
                                        <th>Catégorie</th>
                                        <th class="text-end">Prix Est.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $hasOptions = $simulation->simulationOptions->count() > 0 || $selectedEquipments->count() > 0;
                                    @endphp

                                    @foreach($simulation->simulationOptions as $option)
                                    <tr>
                                        <td>{{ $option->option->name ?? 'Option #' . $option->id }}</td>
                                        <td><span class="badge bg-soft-primary text-primary">Standard</span></td>
                                        <td class="text-end fw-bold">{{ number_format($option->subtotal ?? 0, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                    @endforeach

                                    @foreach($selectedEquipments as $equip)
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-dark">{{ $equip->designation }}</span>
                                            <small class="d-block text-muted">{{ $equip->code }}</small>
                                        </td>
                                        <td><span class="badge bg-soft-info text-info text-uppercase">{{ $equip->categorie }}</span></td>
                                        <td class="text-end fw-bold">~ {{ number_format($equip->prix_min, 0, ',', ' ') }} XOF</td>
                                    </tr>
                                    @endforeach

                                    @if(!$hasOptions)
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">Aucune option spécifique détaillée.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
