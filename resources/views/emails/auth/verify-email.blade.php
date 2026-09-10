<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Vérification de votre adresse e-mail</title>
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
                        <td
                            style="
                                background-color: #1e3a8a;
                                padding: 28px 32px;
                                text-align: center;
                            "
                        >
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
                                Bienvenue sur SELLIA 👋
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
                                Merci d'avoir créé votre compte sur SELLIA.
                                Pour commencer à utiliser votre espace,
                                veuillez confirmer votre adresse e-mail.
                            </p>

                            {{-- Bouton --}}
                            <div style="
                                text-align: center;
                                margin: 32px 0;
                            ">
                                <a
                                    href="{{ $verificationUrl }}"
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
                                    Vérifier mon adresse e-mail
                                </a>
                            </div>

                            <p style="
                                margin: 0 0 16px;
                                font-size: 13px;
                                line-height: 1.7;
                                color: #64748b;
                            ">
                                Si le bouton ne fonctionne pas, vous pouvez
                                également utiliser le lien suivant :
                            </p>

                            <p style="
                                margin: 0 0 24px;
                                word-break: break-all;
                                font-size: 12px;
                                line-height: 1.6;
                                color: #2563eb;
                            ">
                                {{ $verificationUrl }}
                            </p>

                            <div style="
                                border-top: 1px solid #e2e8f0;
                                padding-top: 20px;
                            ">
                                <p style="
                                    margin: 0;
                                    font-size: 13px;
                                    line-height: 1.6;
                                    color: #64748b;
                                ">
                                    Si vous n'êtes pas à l'origine de cette
                                    inscription, vous pouvez simplement
                                    ignorer cet e-mail.
                                </p>
                            </div>

                        </td>
                    </tr>

                    {{-- Pied de page --}}
                    <tr>
                        <td
                            style="
                                background-color: #f8fafc;
                                padding: 24px 32px;
                                text-align: center;
                            "
                        >
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