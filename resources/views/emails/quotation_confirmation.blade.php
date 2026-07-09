<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation demande de devis</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial,Helvetica,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:8px; overflow:hidden;">
                    <tr>
                        <td style="background-color:#1a3a5c; padding:25px 30px; text-align:center;">
                            <h1 style="color:#ffffff; margin:0; font-size:20px;">AIAE - Confirmation de Demande</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:30px;">
                            <p style="color:#333; font-size:15px; margin:0 0 20px;">Bonjour {{ $data['first_name'] }},</p>

                            <p style="color:#333; font-size:15px; margin:0 0 20px;">Nous avons bien reçu votre demande de devis. Voici le récapitulatif :</p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f0f7ff; border-radius:6px; padding:20px; margin-bottom:20px; border-left:4px solid #1a3a5c;">
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong style="color:#1a3a5c;">Numéro de référence :</strong>
                                        <span style="color:#333; font-size:16px;">{{ $data['quotation_number'] }}</span>
                                    </td>
                                </tr>
                                @if($data['project_type'] ?? null)
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong style="color:#1a3a5c;">Type de projet :</strong>
                                        <span style="color:#333;">{{ $data['project_type'] }}</span>
                                    </td>
                                </tr>
                                @endif
                                @if($data['location'] ?? null)
                                <tr>
                                    <td style="padding:8px 0;">
                                        <strong style="color:#1a3a5c;">Localisation :</strong>
                                        <span style="color:#333;">{{ $data['location'] }}</span>
                                    </td>
                                </tr>
                                @endif
                            </table>

                            <p style="color:#333; font-size:15px; margin:0 0 15px;">Notre équipe étudie votre projet et vous contactera <strong>sous 48 heures</strong> pour discuter de vos besoins et vous transmettre une proposition adaptée.</p>

                            <p style="color:#333; font-size:15px; margin:0 0 15px;">Conservez votre numéro de référence : <strong style="color:#1a3a5c;">{{ $data['quotation_number'] }}</strong></p>

                            <p style="color:#333; font-size:15px; margin:0 0 5px;">Pour toute question, vous pouvez nous écrire à <a href="mailto:contact@aiae.services" style="color:#1a3a5c;">contact@aiae.services</a>.</p>

                            <p style="color:#333; font-size:15px; margin:20px 0 0;">Cordialement,<br><strong>L'équipe AIAE</strong></p>
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
