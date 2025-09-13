<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Notification TicketApp' }}</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Arial', sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 540px;
            margin: 30px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            padding: 32px 24px 24px 24px;
        }
        .logo {
            margin-bottom: 24px;
            text-align: center;
        }
        .footer {
            font-size: 12px;
            color: #999;
            text-align: center;
            margin-top: 40px;
        }
        .action-btn {
            display: inline-block;
            padding: 12px 32px;
            background: #2563eb;
            color: #fff !important;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin: 24px 0;
        }
        hr {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 32px 0 16px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Ticket App" width="120">
        </div>

        <!-- Titre dynamique -->
        <h1 style="color: #2563eb; font-size: 1.5em; margin-bottom: 16px;">
            {{ $title ?? 'Bienvenue sur TicketApp !' }}
        </h1>

        <!-- Message principal dynamique -->
        <p style="font-size: 1.1em; color: #444;">
            {{ $message ?? "Vous avez reçu une notification." }}
        </p>

        <!-- Bouton d'action dynamique -->
        @if(!empty($link))
        <div style="text-align: center;">
            <a href="{{ $link }}" class="action-btn">
                {{ $buttonText ?? 'Voir le détail' }}
            </a>
        </div>
        @endif

        <p style="margin-top: 32px;">Merci,<br>
        <strong>{{ config('app.name', 'TicketApp') }}</strong></p>

        <hr>

        <!-- Pied de page -->
        <div class="footer">
            © {{ date('Y') }} {{ config('app.name', 'TicketApp') }}. All rights reserved.<br>
            Cet email a été envoyé automatiquement par <strong>{{ config('app.name', 'TicketApp') }} System</strong>.<br>
            Pour toute question, contactez-nous à <a href="mailto:support@ticketapp.com">support@ticketapp.com</a><br>
            ou visitez notre site web : <a href="https://www.ticketapp.com">www.ticketapp.com</a>
        </div>
    </div>
</body>
</html>
