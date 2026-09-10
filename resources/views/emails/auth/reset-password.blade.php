<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Réinitialisation de votre mot de passe</title>
</head>

<body style="
    margin: 0;
    padding: 0;
    background-color: #f8fafc;
    font-family: Arial, Helvetica, sans-serif;
    color: #0f172a;
">

<table
    width="100%"
    cellpadding="0"
    cellspacing="0"
    role="presentation"
    style="padding: 40px 16px;"
>
    <tr>
        <td align="center">

            <table
                width="100%"
                cellpadding="0"
                cellspacing="0"
                role="presentation"
                style="
                    max-width: 600px;
                    background-color: #ffffff;
                    border-radius: 12px;
                    overflow: hidden;
                    border: 1px solid #e2e8f0;
                "
            >

                {{-- En-tête --}}
                <tr>
                    <td style="
                        background-color: #1e3a8a;
                        padding: 28px 32px;
                        text-align: center;
                    ">
                        <div style="
                            font-size: 28px;
                            font-weight: bold;
                            letter-spacing: 1px;
                            color: #ffffff;
                        ">
                            SELLIA
                        </div>

                        <div style="
                            margin-top: 6px;
                            font-size: 13px;
                            color: #dbeafe;
                        ">
                            Gérez. Vendez. Progressez.
                        </div>
                    </td>
                </tr>

                {{-- Contenu --}}
                <tr>
                    <td style="padding: 40px 32px;">

                        <h1 style="
                            margin: 0 0 20px;
                            font-size: 24px;
                            line-height: 1.4;
                            color: #0f172a;
                        ">
                            Réinitialisation de votre mot de passe
                        </h1>

                        <p style="
                            margin: 0 0 16px;
                            font-size: 15px;
                            line-height: 1.7;
                            color: #475569;
                        ">
                            Bonjour {{ $user->name }},
                        </p>

                        <p style="
                            margin: 0 0 24px;
                            font-size: 15px;
                            line-height: 1.7;
                            color: #475569;
                        ">
                            Nous avons reçu une demande de réinitialisation
                            du mot de passe associé à votre compte SELLIA.
                        </p>

                        {{-- Bouton --}}
                        <div style="
                            text-align: center;
                            margin: 32px 0;
                        ">
                            <a
                                href="{{ $resetUrl }}"
                                style="
                                    display: inline-block;
                                    padding: 14px 28px;
                                    background-color: #1e3a8a;
                                    color: #ffffff;
                                    text-decoration: none;
                                    font-size: 14px;
                                    font-weight: bold;
                                    border-radius: 8px;
                                "
                            >
                                Réinitialiser mon mot de passe
                            </a>
                        </div>

                        <p style="
                            margin: 0 0 16px;
                            font-size: 13px;
                            line-height: 1.7;
                            color: #64748b;
                        ">
                            Ce lien expirera dans {{ $expire }} minutes.
                        </p>

                        <p style="
                            margin: 0 0 16px;
                            font-size: 13px;
                            line-height: 1.7;
                            color: #64748b;
                        ">
                            Si vous n'avez pas demandé cette réinitialisation,
                            aucune action n'est nécessaire. Votre mot de passe
                            actuel restera inchangé.
                        </p>

                        {{-- Lien de secours --}}
                        <div style="
                            border-top: 1px solid #e2e8f0;
                            margin-top: 28px;
                            padding-top: 20px;
                        ">

                            <p style="
                                margin: 0 0 10px;
                                font-size: 12px;
                                color: #64748b;
                            ">
                                Si le bouton ne fonctionne pas, utilisez ce lien :
                            </p>

                            <p style="
                                margin: 0;
                                word-break: break-all;
                                font-size: 12px;
                                line-height: 1.6;
                                color: #2563eb;
                            ">
                                {{ $resetUrl }}
                            </p>

                        </div>

                    </td>
                </tr>

                {{-- Pied de page --}}
                <tr>
                    <td style="
                        background-color: #f8fafc;
                        padding: 24px 32px;
                        text-align: center;
                    ">
                        <p style="
                            margin: 0;
                            font-size: 12px;
                            color: #94a3b8;
                        ">
                            © {{ date('Y') }} SELLIA. Tous droits réservés.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>

</html>