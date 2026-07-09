<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle demande de devis</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="background-color:#1a3a5c; padding:25px 30px; text-align:center;">
                            <h1 style="color:#ffffff; margin:0; font-size:20px;">AIAE - Nouvelle Demande de Devis</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;">
                            <p style="color:#333; font-size:15px; margin:0 0 20px;">Une nouvelle demande de devis a été reçue via le formulaire de contact.</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9f9f9; border-radius:6px; padding:20px; margin-bottom:20px;">
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Numéro de demande :</strong>
                                        <span style="color:#333;">{{ $data['quotation_number'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Nom complet :</strong>
                                        <span style="color:#333;">{{ $data['full_name'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">E-mail :</strong>
                                        <span style="color:#333;">{{ $data['email'] }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Téléphone :</strong>
                                        <span style="color:#333;">{{ $data['phone'] }}</span>
                                    </td>
                                </tr>
                                @if($data['country_residence'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Pays de résidence :</strong>
                                        <span style="color:#333;">{{ $data['country_residence'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['project_type'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Type de projet :</strong>
                                        <span style="color:#333;">{{ $data['project_type'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['standing'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Standing :</strong>
                                        <span style="color:#333;">{{ $data['standing'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['delay'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Délai souhaité :</strong>
                                        <span style="color:#333;">{{ $data['delay'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['location'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Localisation :</strong>
                                        <span style="color:#333;">{{ $data['location'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['budget'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Budget estimé :</strong>
                                        <span style="color:#333;">{{ $data['budget'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['source_discovery'] ?? null)
                                <tr>
                                    <td style="padding:12px 15px; border-bottom:1px solid #eee;">
                                        <strong style="color:#1a3a5c;">Comment nous a-t-il connu :</strong>
                                        <span style="color:#333;">{{ $data['source_discovery'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td style="padding:12px 15px;">
                                        <strong style="color:#1a3a5c;">Description du projet :</strong>
                                        <p style="color:#333; margin:8px 0 0; white-space:pre-wrap;">{{ $data['project_description'] }}</p>
                                    </td>
                                </tr>
                            </table>

                            @if($data['has_attachment'] ?? false)
                            <p style="color:#666; font-size:13px; margin:0 0 15px;">Une pièce jointe a été fournie avec cette demande.</p>
                            @endif

                            <p style="color:#666; font-size:13px; margin:0;">Demande reçue le {{ now()->format('d/m/Y à H:i') }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="background-color:#f0f0f0; padding:15px 30px; text-align:center;">
                            <p style="color:#999; font-size:11px; margin:0;">AIAE - Afrika Infrastructures And Equipements | aiae.services</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
