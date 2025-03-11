<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scanner QR - Gestion de Tontine</title>
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <!-- Colonne Gauche - Scanner QR -->
        <div class="col-lg-3 col-md-4">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 120px;">
                        <div id="reader" style="width: 250px;"></div>
                    </div>
                    <button class="btn btn-success w-100 mt-3" id="startScan">Démarrer le Scanner</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <label for="qrResult" class="form-label">Résultat du scan</label>
                    <input type="text" class="form-control" id="qrResult" readonly>
                </div>
            </div>
        </div>

        <!-- Colonne Milieu - Informations du Participant -->
        <div class="col-lg-9 col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="h4 fw-bold">Gestion de Tontine</h1>
                    
                    <div class="mb-3">
                        <h3 class="h6">Informations du Participant :</h3>
                        <div class="card p-3">
                            <p id="userId"><strong>ID :</strong> -</p>
                            <p id="userName"><strong>Nom :</strong> -</p>
                            <p id="userPrenom"><strong>Prénom :</strong> -</p>
                            <p id="userEmail"><strong>Email :</strong> -</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h3 class="h6">Tontines Associées :</h3>
                        <label for="tontineSelect" class="form-label">Sélectionnez la tontine</label>
                        <select class="form-control" id="tontineSelect">
                            <option value="">Aucune tontine disponible</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <h3 class="h6">Montant de la Cotisation :</h3>
                        <div class="btn-group mb-2" role="group">
                            <button class="btn btn-outline-primary amount-btn" data-amount="5000">5k</button>
                            <button class="btn btn-outline-primary amount-btn" data-amount="10000">10k</button>
                            <button class="btn btn-outline-primary amount-btn" data-amount="15000">15k</button>
                            <button class="btn btn-outline-primary amount-btn" data-amount="20000">20k</button>
                            <button class="btn btn-outline-primary amount-btn" data-amount="25000">25k</button>
                        </div>
                        <input type="number" class="form-control" id="cotisationAmount" placeholder="Montant de la cotisation">
                    </div>

                    <div class="mb-3">
                        <h3 class="h6">Méthode de Paiement :</h3>
                        <select class="form-control" id="moyenPaiement">
                            <option value="ESPECES">Espèces</option>
                            <option value="WAVE">Wave</option>
                            <option value="OM">Orange Money</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100 mt-3" id="enregistrerCotisation">Enregistrer la Cotisation</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="qrToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Paiement réussi
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script src="https://unpkg.com/html5-qrcode"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const html5Qrcode = new Html5Qrcode('reader');
    let scannerIsRunning = false;
    
    const qrCodeSuccessCallback = (decodedText) => {
        document.getElementById('qrResult').value = decodedText;
        
        fetch(`/tontines/par-telephone/${decodedText}`)
            .then(response => response.json())
            .then(data => {
                if (data.user) {
                    document.getElementById('userId').textContent = `ID : ${data.user.id}`;
                    document.getElementById('userName').textContent = `Nom : ${data.user.nom}`;
                    document.getElementById('userPrenom').textContent = `Prénom : ${data.user.prenom}`;
                    document.getElementById('userEmail').textContent = `Email : ${data.user.email}`;
                }

                const tontineSelect = document.getElementById('tontineSelect');
                tontineSelect.innerHTML = '';
                if (data.tontines && data.tontines.length > 0) {
                    data.tontines.forEach(tontine => {
                        const option = document.createElement('option');
                        option.value = tontine.tontine_id; 
                        option.textContent = tontine.libelle;
                        tontineSelect.appendChild(option);
                    });
                } else {
                    tontineSelect.innerHTML = '<option value="">Aucune tontine disponible</option>';
                }
            })
            .catch(error => console.error('Erreur:', error));

        html5Qrcode.stop();
        scannerIsRunning = false;
    };

    const config = { fps: 10, qrbox: { width: 250, height: 250 } };
    
    document.getElementById('startScan').addEventListener('click', function() {
        if (!scannerIsRunning) {
            html5Qrcode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
                .then(() => scannerIsRunning = true)
                .catch(err => console.error("Erreur:", err));
        }
    });

    document.querySelectorAll('.amount-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('cotisationAmount').value = this.getAttribute('data-amount');
        });
    });

    document.getElementById('enregistrerCotisation').addEventListener('click', function() {
        const userId = document.getElementById('userId').textContent.split(': ')[1];
        const tontineId = document.getElementById('tontineSelect').value;
        const montant = document.getElementById('cotisationAmount').value;
        const moyenPaiement = document.getElementById('moyenPaiement').value;

        if (!userId || !tontineId || !montant || !moyenPaiement) {
            alert("Veuillez remplir tous les champs.");
            return;
        }

        fetch('/cotisations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ idUser: userId, idTontine: tontineId, montant, moyen_paiement: moyenPaiement })
        })
        .then(response => response.json())
        .then(data => {
            const toastEl = document.getElementById('qrToast');
            
            // Définir la couleur du toast en fonction du résultat
            if (data.success) {
                toastEl.classList.remove('bg-danger');
                toastEl.classList.add('bg-success');
            } else {
                toastEl.classList.remove('bg-success');
                toastEl.classList.add('bg-danger');
            }
            
            // Définir le message du toast
            document.querySelector('#qrToast .toast-body').textContent = data.message || 'Opération terminée';
            
            // Afficher le toast
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        })
        .catch(error => {
            console.error('Erreur:', error);
            
            // Afficher un toast d'erreur en cas d'échec de la requête
            const toastEl = document.getElementById('qrToast');
            toastEl.classList.remove('bg-success');
            toastEl.classList.add('bg-danger');
            document.querySelector('#qrToast .toast-body').textContent = 'Erreur de connexion au serveur';
            
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
});
</script>

</body>
</html>