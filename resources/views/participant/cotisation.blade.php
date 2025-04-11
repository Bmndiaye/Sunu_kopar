<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement de Cotisation - Tontine</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px;
        }
        h1 {
            margin: 0;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2c3e50;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .amount {
            font-size: 24px;
            text-align: center;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            margin: 15px 0;
            color: #2c3e50;
        }
        .payment-methods {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .payment-method {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            width: 30%;
        }
        .payment-method.active {
            border-color: #3498db;
            background-color: #ebf5fb;
        }
        .payment-method img {
            max-width: 100%;
            height: 40px;
            object-fit: contain;
        }
        .button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        .button:hover {
            background-color: #2980b9;
        }
        .button.outline {
            background-color: transparent;
            border: 1px solid #3498db;
            color: #3498db;
            margin-top: 10px;
        }
        .summary {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .summary p {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .summary p.total {
            font-weight: bold;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Paiement de Cotisation</h1>
        </header>
        
        <div class="form-group">
            <label for="date">Date de cotisation:</label>
            <input type="date" id="date" value="2025-03-13">
        </div>
        
        <div class="summary">
            <p><span>Cotisation journalière:</span> <span>5000 FCFA</span></p>
            <p><span>Frais de service (0%):</span> <span>0 FCFA</span></p>
            <p class="total"><span>Total à payer:</span> <span>5000 FCFA</span></p>
        </div>
        
        <div class="form-group">
            <label>Méthode de paiement:</label>
            <div class="payment-methods">
                <div class="payment-method active">
                    <img src="/api/placeholder/80/40" alt="Mobile Money">
                    <div>Mobile Money</div>
                </div>
                <div class="payment-method">
                    <img src="/api/placeholder/80/40" alt="Carte bancaire">
                    <div>Carte bancaire</div>
                </div>
                <div class="payment-method">
                    <img src="/api/placeholder/80/40" alt="Espèces">
                    <div>Espèces</div>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="phone">Numéro de téléphone:</label>
            <input type="tel" id="phone" placeholder="Votre numéro mobile money">
        </div>
        
        <button class="button">Confirmer le paiement</button>
        <button class="button outline">Annuler</button>
    </div>
</body>
</html>