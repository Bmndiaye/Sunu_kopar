<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <style>
        body { text-align: center; font-family: Arial, sans-serif; }
        .qr-container { margin-top: 50px; }
        img { width: 200px; height: 200px; }
    </style>
</head>
<body>
    <h2>Votre QR Code</h2>
    <div class="qr-container">
        <img src="{{ public_path('storage/' . basename($qrCodePath)) }}" alt="QR Code">
    </div>
</body>
</html>
