<!-- resources/views/emails/loyalty_card.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte de Fidélité</title>
    <style>
        /* Exemple de style pour la carte de fidélité */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .loyalty-card {
            border: 2px solid #007bff;
            padding: 20px;
            width: 300px;
            text-align: center;
            background-color: white;
            margin: 0 auto;
        }
        .loyalty-card h2 {
            font-size: 24px;
            color: #007bff;
        }
        .loyalty-card p {
            font-size: 18px;
            margin: 5px 0;
        }
        .loyalty-card .name {
            font-weight: bold;
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="loyalty-card">
    <h2>Carte de Fidélité</h2>
    <p class="name">{{ $user->prenom }} {{ $user->nom }}</p>
    <p>Merci de faire partie de notre programme de fidélité !</p>
    <p>Email : {{ $user->email }}</p>
</div>

</body>
</html>
