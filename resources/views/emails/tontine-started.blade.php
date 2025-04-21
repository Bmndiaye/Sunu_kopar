<!-- resources/views/emails/tontine-started.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tontine démarrée</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .header {
            background: #4a6da7;
            color: white;
            padding: 10px 20px;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background: white;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
            color: #777;
        }
        .btn {
            display: inline-block;
            background: #4a6da7;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 3px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tontine Démarrée</h1>
        </div>
        <div class="content">
            <h2>Bonjour {{ $user->nom ?? 'Participant' }},</h2>
            
            <p>Nous vous informons que la tontine <strong>{{ $tontine->libelle }}</strong> à laquelle vous participez vient de démarrer officiellement!</p>
            
            <p>Détails de la tontine:</p>
            <ul>
                <li><strong>Nom:</strong> {{ $tontine->libelle }}</li>
                <li><strong>Fréquence des cotisations:</strong> {{ ucfirst(strtolower($tontine->frequence)) }}</li>
                <li><strong>Montant de la cotisation:</strong> {{ number_format($tontine->montant_de_base, 0, ',', ' ') }} FCFA</li>
                <li><strong>Date de début:</strong> {{ date('d/m/Y', strtotime($tontine->dateDebut)) }}</li>
                <li><strong>Date de fin:</strong> {{ date('d/m/Y', strtotime($tontine->dateFin)) }}</li>
            </ul>
            
            <p>N'oubliez pas d'effectuer vos cotisations selon la fréquence prévue pour garantir le bon fonctionnement de la tontine.</p>
            
            <p>Connectez-vous à votre compte pour voir tous les détails de la tontine.</p>
            
            <p>Merci pour votre participation!</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Votre Système de Tontine. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>