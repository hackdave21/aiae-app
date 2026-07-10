<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <title>Estimation AIAE - {{ $ref ?? '' }}</title>
  <style>
    @page { margin: 15mm; }
    body { font-family: 'DejaVu Sans', sans-serif; font-size: 10pt; color: #333; }
    table { width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 9pt; }
    th { background: #0E1540; color: white; padding: 6px 8px; text-align: left; }
    td { padding: 4px 8px; border-bottom: 1px solid #ddd; }
    .total-row { background: #0E1540; color: white; font-weight: bold; }
    .total-row td { padding: 8px; }
    h1 { font-size: 16pt; color: #0E1540; border-bottom: 2px solid #CC6A00; padding-bottom: 4px; }
    h2 { font-size: 12pt; color: #05482C; margin-top: 16px; }
    .header { text-align: center; margin-bottom: 20px; }
    .header img { height: 50px; }
    .header h1 { font-size: 18pt; border: none; }
    .grid { display: flex; gap: 8px; flex-wrap: wrap; }
    .grid-item { flex: 1; min-width: 120px; background: #f8fafc; padding: 6px; border-radius: 4px; }
    .grid-item label { font-size: 7pt; color: #666; }
    .grid-item value { font-weight: bold; }
    .footer { margin-top: 30px; font-size: 7pt; color: #999; text-align: center; border-top: 1px solid #ddd; padding-top: 10px; }
    .badge { display: inline-block; padding: 2px 6px; border-radius: 3px; font-size: 8pt; }
    .badge-green { background: #dcfce7; color: #05482C; }
    .badge-blue { background: #e0e7ff; color: #0E1540; }
    .badge-orange { background: #ffedd5; color: #CC6A00; }
  </style>
  <script>window.onload=()=>{setTimeout(()=>window.print(),500)}</script>
</head>
<body>
  <div class="header">
    <img src="{{ asset('aiae-frontend/Images/logos/Symbole_AIAE_FINAL_Clr.png') }}" alt="AIAE">
    <h1>Estimation de Projet</h1>
    <p style="color:#666;font-size:9pt">Afrika Infrastructures And Equipements (AIAE) • Référentiel Décembre 2025</p>
  </div>

  @if(isset($config))
  <h2>1. Synthèse du projet</h2>
  <div class="grid">
    <div class="grid-item"><label>Référence</label><br><value>{{ $ref ?? 'N/A' }}</value></div>
    <div class="grid-item"><label>Date</label><br><value>{{ date('d/m/Y') }}</value></div>
    <div class="grid-item"><label>Type</label><br><value>{{ $config['typeBat'] ?? 'N/A' }}</value></div>
    <div class="grid-item"><label>Standing</label><br><value>{{ $config['standing'] ?? 'N/A' }}</value></div>
    <div class="grid-item"><label>Zone</label><br><value>{{ $config['zone'] ?? 'N/A' }}</value></div>
    <div class="grid-item"><label>Sol</label><br><value>{{ $config['sol'] ?? 'N/A' }}</value></div>
  </div>
  <div class="grid" style="margin-top:6px">
    <div class="grid-item"><label>Surface terrain</label><br><value>{{ number_format($config['dimensions']['surface'] ?? 0, 0, ',', ' ') }} m²</value></div>
    <div class="grid-item"><label>Surface plancher</label><br><value>{{ number_format($config['dimensions']['surfaceBatie'] ?? 0, 0, ',', ' ') }} m²</value></div>
    <div class="grid-item"><label>Niveaux</label><br><value>R+{{ max(0, ($config['niveaux'] ?? 1) - 1) }}{{ ($config['ssSol'] ?? 0) > 0 ? ' + '.$config['ssSol'].' ss' : '' }}</value></div>
    <div class="grid-item"><label>Hauteur totale</label><br><value>{{ number_format($config['dimensions']['hauteurTotale'] ?? 0, 1) }} m</value></div>
    <div class="grid-item"><label>Durée estimée</label><br><value>{{ $config['duree'] ?? 'N/A' }} mois</value></div>
    <div class="grid-item"><label>Catégorie</label><br><value><span class="badge badge-blue">{{ $config['categorie'] ?? 'A1' }}</span></value></div>
  </div>

  @if(isset($config['postes']) && count($config['postes']) > 0)
  <h2>2. Estimation budgétaire</h2>
  <table>
    <thead><tr><th>Code</th><th>Poste</th><th>Détail</th><th style="text-align:right">Min</th><th style="text-align:right">Max</th><th style="text-align:right">Montant</th></tr></thead>
    <tbody>
      @foreach($config['postes'] as $p)
      <tr>
        <td style="color:#999">{{ $p['code'] }}</td>
        <td>{{ $p['nom'] }}</td>
        <td style="color:#666;font-size:8pt">{{ $p['detail'] ?? '' }}</td>
        <td style="text-align:right">{{ number_format($p['montantMin'] ?? 0, 0, ',', ' ') }}</td>
        <td style="text-align:right">{{ number_format($p['montantMax'] ?? 0, 0, ',', ' ') }}</td>
        <td style="text-align:right;font-weight:bold">{{ number_format($p['montant'] ?? 0, 0, ',', ' ') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif

  <h2>3. Récapitulatif financier</h2>
  <table>
    <tr><td><strong>Total estimation</strong></td><td style="text-align:right;font-weight:bold;font-size:12pt">{{ number_format(($config['total'] ?? 0) + ($config['foncier'] ?? 0), 0, ',', ' ') }} FCFA</td></tr>
    <tr><td>Fourchette basse</td><td style="text-align:right">{{ number_format($config['totalMin'] ?? 0, 0, ',', ' ') }} FCFA</td></tr>
    <tr><td>Fourchette haute</td><td style="text-align:right">{{ number_format($config['totalMax'] ?? 0, 0, ',', ' ') }} FCFA</td></tr>
    <tr><td>Prix au m² (hors foncier)</td><td style="text-align:right">{{ isset($config['dimensions']['surfaceBatie']) && $config['dimensions']['surfaceBatie'] > 0 ? number_format(($config['total'] ?? 0) / $config['dimensions']['surfaceBatie'], 0, ',', ' ') : 'N/A' }} FCFA/m²</td></tr>
    <tr><td>Besoins énergétiques</td><td style="text-align:right">{{ $config['besoins'] ?? 'N/A' }} kW</td></tr>
  </table>

  <p style="font-size:8pt;color:#999;margin-top:16px;border-left:3px solid #CC6A00;padding-left:8px">
    Cette estimation est indicative et non contractuelle. Une étude détaillée sera réalisée pour l'établissement du devis définitif.
  </p>
  @endif

  <div class="footer">
    AIAE (Afrika Infrastructures And Equipements) • contact@aiae.services • Quartier Kléme Zanguéra, Lomé, Togo<br>
    Document généré le {{ date('d/m/Y à H:i') }} • Référentiel Décembre 2025
  </div>
</body>
</html>
