<nav class="nxl-navigation">
        <div class="navbar-wrapper">
            <div class="m-header">
                <a href="{{ route('admin.dashboard') }}" class="b-brand">
                    <!-- ========  logos   ============ -->
                    <!-- Light Mode Logos -->
                    <img src="{{ asset('admin-assets/assets/images/Logos/LOGO_AIAE_FINAL.png') }}" alt="AIAE Logo" class="logo logo-lg logo-light-mode" />
                    <img src="{{ asset('admin-assets/assets/images/Logos/Symbole_AIAE_FINAL_Clr.png') }}" alt="AIAE Logo" class="logo logo-sm logo-light-mode" />
                    
                    <!-- Dark Mode Logos -->
                    <img src="{{ asset('admin-assets/assets/images/Logos/LOGO_AIAE_BLANC.png') }}" alt="AIAE Logo" class="logo logo-lg logo-dark-mode" />
                    <img src="{{ asset('admin-assets/assets/images/Logos/Symbole_AIAE_FINAL.png') }}" alt="AIAE Logo" class="logo logo-sm logo-dark-mode" />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                    <li class="nxl-item nxl-caption">
                        <label>Navigation</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-airplay"></i></span>
                            <span class="nxl-mtext">Tableaux de bord</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.dashboard') }}">CRM</a></li>
                            
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-calendar"></i></span>
                            <span class="nxl-mtext">Rendez-vous</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.appointments.index') }}">Liste des RDV</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.appointments.create') }}">Nouveau RDV</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-activity"></i></span>
                        <span class="nxl-mtext">Simulations</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.simulations.index') }}">Toutes les simulations</a></li>
    
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-file-text"></i></span>
                        <span class="nxl-mtext">Devis</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.quotations.index') }}">Tous les devis</a></li>
                    
                    </ul>
                </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                            <span class="nxl-mtext">Leads</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.index') }}">Liste des Leads</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.leads.create') }}">Nouveau Lead</a></li>
                        </ul>
                    </li>

                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-box"></i></span>
                            <span class="nxl-mtext">Reglages du Simulateur</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.zones.index') }}">Zones (Togo)</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.sols.index') }}">Types de Sols</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.type-batiments.index') }}">Types de Bâtiments</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.templates-projets.index') }}">Modèles Premium</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.equipement-options.index') }}">Options Équipements</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-settings"></i></span>
                            <span class="nxl-mtext">Configuration Basique</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.divisions.index') }}">Divisions</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.sectors.index') }}">Secteurs</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.sector-types.index') }}">Types de Secteur</a></li>
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
                        </ul>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a href="javascript:void(0);" class="nxl-link">
                            <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                            <span class="nxl-mtext">Centre d'aide</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                        </a>
                        <ul class="nxl-submenu">
                            <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.help') }}#simulations">Documentation</a></li>
                        </ul>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
