<!DOCTYPE html>
<html>
<head>
    <title>Facture de Cotisation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .facture-details {
            margin-bottom: 20px;
        }
        .facture-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .facture-details th, .facture-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .facture-details th {
            background-color: #f9f9f9;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            font-size: 18px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Facture de Cotisation</h1>
            <p>Tontine: {{ $tontine->nom }}</p>
        </div>
        
        <div class="facture-details">
            <h3>Détails de la cotisation</h3>
            <table>
                <tr>
                    <th>Référence</th>
                    <td>{{ $cotisation->id }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{ $cotisation->created_at->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>Moyen de paiement</th>
                    <td>{{ $cotisation->moyen_paiement }}</td>
                </tr>
            </table>
            
            <div class="total">
                Total payé: {{ number_format($cotisation->montant, 0, ',', ' ') }} FCFA
            </div>
        </div>
        
        <div class="footer">
            <p>Merci pour votre cotisation!</p>
            <p>Pour toute question, veuillez contacter le responsable de la tontine.</p>
        </div>
    </div>
</body>
</html>