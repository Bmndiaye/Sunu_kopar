<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>espace-tontine</title>
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="../assets/images/favicon.ico" />
  <link rel="stylesheet" href="../assets/css/libs.min.css">
  <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
  <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet">
  <!-- flatpickr css -->
  <link rel="stylesheet" href="../assets/vendor/flatpickr/dist/flatpickr.min.css" />
  <!-- Sweetlaert2 css -->
  <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" />
  
  <!-- vanillajs css -->
  <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
  
  <!-- zuck -->y
   
  
  <!-- Custom Css -->
  <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
  
  <!-- Customizer Css -->
  <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" /></head>
         <!-- flatpickr css -->


</head>
<body>
<style>
body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container-fluid {
            padding: 10px;
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .dashboard {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 15px;
        }

        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            padding: 15px;
            margin-bottom: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .card h3, .card h5 {
            margin-top: 0;
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            font-size: 1.2rem;
        }

        .card-header {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            font-weight: 600;
            padding: 0.8rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .amount {
            font-weight: bold;
            color: #27ae60;
        }

        .button, .btn-primary, .btn-success {
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            cursor: pointer;
            color: white;
            width: auto;
        }

        .button {
            background-color: #3498db;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3a7bd5, #00d2ff);
        }

        .btn-primary:hover {
            box-shadow: 0 5px 15px rgba(0,123,255,0.4);
            transform: translateY(-2px);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e, #38ef7d);
        }

        .btn-success:hover {
            box-shadow: 0 5px 15px rgba(40,167,69,0.4);
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border-radius: 20px;
            border: 1px solid #3a7bd5;
            color: #3a7bd5;
            font-weight: 600;
            transition: all 0.2s;
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .btn-outline-primary:hover {
            background-color: #3a7bd5;
            color: white;
        }

        .status {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 20px;
            font-size: 11px;
        }

        .status-paid {
            background-color: #e8f5e9;
            color: #28a745;
        }

        .status-late {
            background-color: #ffebee;
            color: #dc3545;
        }

        .status-coming {
            background-color: #e3f2fd;
            color: #0d6efd;
        }

        .paid {
            background-color: #e6f7e6;
            color: #27ae60;
        }

        .unpaid {
            background-color: #fdeaea;
            color: #e74c3c;
        }

        .tontine-selector {
            margin-bottom: 15px;
        }

        .tontine-selector select {
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ddd;
            width: 100%;
            font-size: 0.9rem;
        }

        .qr-code {
            text-align: center;
            margin: 15px 0;
        }

        .qr-code img {
            max-width: 120px;
            border: 1px solid #ddd;
            padding: 8px;
            background-color: white;
        }

        .qr-code p {
            font-size: 0.8rem;
            margin-top: 5px;
        }

        .scan-area {
            height: 240px;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }

        .form-select, .form-control {
            border-radius: 8px;
            padding: 0.6rem 0.8rem;
            border: 1px solid #e0e0e0;
            font-size: 0.9rem;
        }

        .user-info-item {
            padding: 0.6rem 0;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.9rem;
        }

        .user-info-label {
            font-weight: 600;
            color: #495057;
        }

        .user-info-value {
            color: #212529;
        }

        .amount-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .amount-btn {
            padding: 0.3rem 0.6rem;
            font-size: 0.8rem;
        }

        .toast-container {
            z-index: 1060;
        }
        
        /* Ajustements spécifiques pour mobile */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 8px;
            }
            
            h5 {
                font-size: 1rem;
            }
            
            .card {
                padding: 10px;
            }
            
            .card-header {
                padding: 0.6rem;
            }
            
            table {
                font-size: 0.8rem;
            }
            
            th, td {
                padding: 6px 4px;
            }
            
            /* Améliorer la lisibilité des tableaux sur mobile */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            /* Ajuster les boutons pour mobile */
            .btn {
                padding: 0.4rem 0.7rem;
                font-size: 0.8rem;
            }
            
            /* Optimisation du scanner QR */
            #reader {
                height: 250px !important;
                width: 100% !important;
            }
            
            /* Rendre les formulaires plus faciles à utiliser sur mobile */
            .form-select, .form-control {
                font-size: 16px; /* Évite le zoom automatique sur iOS */
            }
        }
</style>
@include('layouts.sidebar')
  @include('layouts.navbar')


    @if(Auth::user()->hasRole('GERANT'))
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

<div class="container-fluid mt-4" style="width: 85%; margin-left: auto; margin-right: 0;">
    <!-- Scanner QR et Informations utilisateur sur la même ligne -->
    <div class="row">
        <!-- Scanner QR -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="text-center">Scanner un QR Code</h5>
                </div>
                <div class="card-body d-flex flex-column">
                    <div id="reader" style="width: 100%; height: 350px;" class="mb-auto"></div>
                    <div class="text-center mt-3">
                        <button id="startScan" class="btn btn-primary">Démarrer le scan</button>
                        <input type="hidden" id="qrResult">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Informations utilisateur -->
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header">
                    <h5>Informations utilisateur</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Informations de base -->
                        <div class="col-12">
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <p id="userId" class="mb-1">ID : </p>
                                    <p id="userName" class="mb-1">Nom : </p>
                                </div>
                                <div class="col-md-6">
                                    <p id="userPrenom" class="mb-1">Prénom : </p>
                                    <p id="userEmail" class="mb-1">Email : </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Formulaire - première colonne -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tontineSelect" class="form-label">Tontine</label>
                                <select class="form-select" id="tontineSelect">
                                    <option value="">Sélectionnez une tontine</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="statut" class="form-label">État de paiement</label>
                                <select class="form-select" id="statut">
                                    <option value="non_payees" selected>Échéances non payées</option>
                                    <option value="toutes">Toutes les échéances</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dateSelect" class="form-label">Date de cotisation</label>
                                <select class="form-select" id="dateSelect">
                                    <option value="">Sélectionnez une date</option>
                                </select>
                                <div id="dateStatus" class="mt-2"></div>
                            </div>
                        </div>
                        
                        <!-- Formulaire - deuxième colonne -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="cotisationAmount" class="form-label">Montant</label>
                                <input type="text" class="form-control" id="cotisationAmount">
                                <div class="mt-2">
                                    <button class="btn btn-outline-primary amount-btn" data-amount="1000">1000</button>
                                    <button class="btn btn-outline-primary amount-btn" data-amount="5000">5000</button>
                                    <button class="btn btn-outline-primary amount-btn" data-amount="10000">10000</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="moyenPaiement" class="form-label">Moyen de paiement</label>
                                <select class="form-select" id="moyenPaiement">
                                    <option value="">Sélectionnez un moyen de paiement</option>
                                    <option value="Mobile Money">Mobile Money</option>
                                    <option value="Carte bancaire">Carte bancaire</option>
                                    <option value="ESPECES">Espèces</option>
                                    <option value="Virement bancaire">Virement bancaire</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Bouton d'enregistrement -->
                    <div class="text-center mt-3">
                        <button id="enregistrerCotisation" class="btn btn-success btn-lg">Enregistrer la cotisation</button>
                    </div>
                </div>
            </div>
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
                tontineSelect.innerHTML = '<option value="">Sélectionnez une tontine</option>';
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

    // Fonction pour charger les dates selon le filtre
    function loadDates() {
        const tontineId = document.getElementById('tontineSelect').value;
        const userId = document.getElementById('userId').textContent.split(': ')[1];
        const statut = document.getElementById('statut').value;
        
        if (tontineId && userId) {
            // Construire l'URL avec le paramètre de filtre
            const url = `/api/tontines/${tontineId}/echeances/${userId}?statut=${statut}`;
            
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const dateSelect = document.getElementById('dateSelect');
                    dateSelect.innerHTML = '<option value="">Sélectionnez une date</option>';
                    
                    if (data.dates && data.dates.length > 0) {
                        data.dates.forEach(date => {
                            const option = document.createElement('option');
                            option.value = date.date;
                            option.textContent = date.date;
                            if (date.dejaCotise) {
                                option.dataset.status = 'payé';
                                option.classList.add('text-success');
                            } else if (new Date(date.date.split('/').reverse().join('-')) < new Date()) {
                                option.dataset.status = 'en retard';
                                option.classList.add('text-danger');
                            } else {
                                option.dataset.status = 'à venir';
                                option.classList.add('text-info');
                            }
                            dateSelect.appendChild(option);
                        });
                    } else {
                        dateSelect.innerHTML = '<option value="">Aucune date disponible</option>';
                    }
                    
                    // Charger le montant de base de la tontine
                    if (data.montant_de_base) {
                        document.getElementById('cotisationAmount').value = data.montant_de_base;
                    }
                })
                .catch(error => console.error('Erreur:', error));
        }
    }

    // Événement de changement de tontine
    document.getElementById('tontineSelect').addEventListener('change', loadDates);
    
    // Événement de changement de statut
    document.getElementById('statut').addEventListener('change', loadDates);
    
    // Événement de changement de date pour afficher le statut
    document.getElementById('dateSelect').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const status = selectedOption.dataset.status;
    const dateStatus = document.getElementById('dateStatus');
    const enregistrerButton = document.getElementById('enregistrerCotisation');
    
    if (status) {
        dateStatus.innerHTML = '';
        let badge = document.createElement('span');
        
        if (status === 'payé') {
            badge.className = 'badge bg-success';
            badge.textContent = 'Déjà payé';
            // Désactiver le bouton si déjà payé
            enregistrerButton.disabled = true;
            enregistrerButton.classList.add('disabled');
            // Changer la couleur du bouton en gris
            enregistrerButton.classList.remove('btn-success');
            enregistrerButton.classList.add('btn-secondary');
        } else if (status === 'en retard') {
            badge.className = 'badge bg-danger';
            badge.textContent = 'En retard';
            // Activer le bouton
            enregistrerButton.disabled = false;
            enregistrerButton.classList.remove('disabled');
            // Remettre la couleur verte
            enregistrerButton.classList.remove('btn-secondary');
            enregistrerButton.classList.add('btn-success');
        } else {
            badge.className = 'badge bg-info';
            badge.textContent = 'À venir';
            // Activer le bouton
            enregistrerButton.disabled = false;
            enregistrerButton.classList.remove('disabled');
            // Remettre la couleur verte
            enregistrerButton.classList.remove('btn-secondary');
            enregistrerButton.classList.add('btn-success');
        }
        
        dateStatus.appendChild(badge);
    } else {
        dateStatus.innerHTML = '';
        // Par défaut, désactiver le bouton si aucune date n'est sélectionnée
        enregistrerButton.disabled = true;
        enregistrerButton.classList.add('disabled');
        // Changer la couleur du bouton en gris
        enregistrerButton.classList.remove('btn-success');
        enregistrerButton.classList.add('btn-secondary');
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
        const dateSelectionnee = document.getElementById('dateSelect').value;
        const montant = document.getElementById('cotisationAmount').value;
        const moyenPaiement = document.getElementById('moyenPaiement').value;

        if (!userId || !tontineId || !dateSelectionnee || !montant || !moyenPaiement) {
            alert("Veuillez remplir tous les champs.");
            return;
        }

        // Convertir la date au format YYYY-MM-DD pour le backend
        const [jour, mois, annee] = dateSelectionnee.split('/');
        const formattedDate = `${annee}-${mois}-${jour}`;

        fetch('/cotisations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                body: JSON.stringify({
                    iduser: userId,
                    idtontine: tontineId,
                    montant: parseInt(montant, 10),
                    moyen_paiement: moyenPaiement,
                    created_at: formattedDate
                })
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.text().then(text => {
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error("Erreur de parsing JSON:", e);
                    throw new Error("La réponse n'est pas au format JSON valide");
                }
            });
        })
        .then(data => {
            const toastEl = document.getElementById('qrToast');
            
            // Définir le message du toast
            document.querySelector('#qrToast .toast-body').textContent = data.message || 'Cotisation enregistrée avec succès';
            
            // Afficher le toast
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
            
            // Recharger les dates après l'enregistrement
            setTimeout(() => {
                loadDates();
                
                // Réinitialiser les champs
                document.getElementById('dateSelect').value = '';
                document.getElementById('dateStatus').innerHTML = '';
                document.getElementById('moyenPaiement').value = '';
            }, 1000);
        })
        .catch(error => {
            console.error('Erreur:', error);
            
            // Afficher un toast d'erreur en cas d'échec de la requête
            const toastEl = document.getElementById('qrToast');
            toastEl.classList.remove('bg-success');
            toastEl.classList.add('bg-danger');
            document.querySelector('#qrToast .toast-body').textContent = 'Erreur: ' + error.message;
            
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    });
});
</script>

@else



<div class="container">
    <!-- Section 1: En-tête avec sélecteur de tontine et QR Code -->
    <div class="header-section">
        <div class="tontine-selector">
            <select id="tontineSelector">
                <option value="">Choisir une tontine</option>
                @foreach($calendriers as $tontineId => $calendrier)
                    <option value="{{ $tontineId }}">{{ $calendrier['tontine']->libelle }}</option>
                @endforeach
            </select>
        </div>

        <div class="qr-code">
            <h3>Votre QR Code</h3>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ Auth::user()->telephone }}" alt="QR Code">
            <p>Scannez ce code pour effectuer une cotisation</p>
        </div>
    </div>

    <!-- Section 2: Conteneurs de tontines (un pour chaque tontine) -->
    @foreach($calendriers as $tontineId => $calendrier)
        <div class="tontine-container" id="tontine-{{ $tontineId }}" style="display: none;">
            <!-- Section 2.1: Panneau d'information générale -->
            <div class="dashboard">
                <!-- Informations générales sur la tontine -->
                <div class="card info-card">
                    <h3>Informations générales</h3>
                    <p><strong>Tontine:</strong> {{ $calendrier['tontine']->libelle }}</p>
                    <p><strong>Type:</strong> {{ $calendrier['tontine']->frequence }}</p>
                    <p><strong>Montant de cotisation:</strong> <span class="amount">{{ number_format($calendrier['tontine']->montant_de_base, 0, ',', ' ') }} FCFA</span></p>
                    <p><strong>Nombre de participants:</strong> {{ count($calendrier['participants']) }}</p>
                    <p><strong>Montant total à reverser:</strong> {{ number_format(count($calendrier['participants']) * $calendrier['tontine']->montant_de_base, 0, ',', ' ') }} FCFA</p>
                    
                    @php
                        $prochainBeneficiaire = null;
                        $dateActuelle = new DateTime();
                        foreach($calendrier['participants'] as $participant) {
                            if(new DateTime($participant->date_prevue) > $dateActuelle) {
                                $prochainBeneficiaire = $participant;
                                break;
                            }
                        }
                    @endphp
                 
                </div>

                <!-- Informations sur le compte du membre -->
                <div class="card account-card">
                    <h3>Votre compte</h3>
                    <p><strong>Membre:</strong> <span id="userId">{{ Auth::id() }}</span> {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
                    <p><strong>Statut:</strong> Actif</p>
                    
                    @php
                        $mesVersements = $calendrier['cotisations'][Auth::id()] ?? 0;
                        $monRang = null;
                        $maDate = null;
                        foreach($calendrier['participants'] as $participant) {
                            if($participant->id == Auth::id()) {
                                $monRang = $participant->ordre;
                                $maDate = $participant->date_prevue;
                                break;
                            }
                        }
                    @endphp
                    
                    <!-- <p><strong>Cotisations versées:</strong> <span class="amount">{{ number_format($mesVersements, 0, ',', ' ') }} FCFA</span></p> -->
                    @if($maDate)
                        <p><strong>Date de réception:</strong> {{ date('d/m/Y', strtotime($maDate)) }}</p>
                    @endif
                    @if($monRang)
                        <p><strong>Votre rang:</strong> {{ $monRang }} / {{ count($calendrier['participants']) }}</p>
                    @endif
                    
                    <!-- <button class="button action-button" onclick="location.href='{{ route('cotisations.create') }}'">Faire une cotisation</button> -->
                </div>
            </div>

            <!-- Section 2.2: Tableau de dates à cotiser -->
            <div class="card payment-schedule-card">
                <h3>Échéancier de paiement</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Statut</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calendrier['datesACotiser'] as $date)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $date['date'] }}</td>
                                <td>{{ number_format($calendrier['tontine']->montant_de_base, 0, ',', ' ') }} FCFA</td>
                                <td>
                                    @if($date['dejaCotise'])
                                        <span class="badge bg-success">Payé</span>
                                    @elseif(\Carbon\Carbon::createFromFormat('d/m/Y', $date['date'])->isPast())
                                        <span class="badge bg-danger">En retard</span>
                                    @elseif(\Carbon\Carbon::createFromFormat('d/m/Y', $date['date'])->isToday())
                                        <span class="badge bg-warning">Aujourd'hui</span>
                                    @else
                                        <span class="badge bg-info">À venir</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$date['dejaCotise'])
                                        <button class="btn btn-primary btn-sm pay-btn" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#paymentModal"
                                                data-date="{{ $date['date'] }}"
                                                data-montant="{{ $calendrier['tontine']->montant_de_base }}"
                                                data-tontine-id="{{ $tontineId }}">
                                            Payer
                                        </button>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm" disabled>Payé</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Section 2.3: Historique des cotisations -->
            <div class="card contribution-history-card">
                <h3>Suivi des cotisations</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Montant</th>
                            <th>Méthode</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cotisationsDuParticipant = App\Models\Cotisation::where([
                                'iduser' => Auth::id(),
                                'idtontine' => $tontineId
                            ])->orderBy('created_at', 'desc')->get();
                        @endphp
                        
                        @if($cotisationsDuParticipant->count() > 0)
                            @foreach($cotisationsDuParticipant as $cotisation)
                                <tr>
                                    <td>{{ date('d/m/Y', strtotime($cotisation->created_at)) }}</td>
                                    <td>{{ number_format($cotisation->montant, 0, ',', ' ') }} FCFA</td>
                                    <td>{{ $cotisation->moyen_paiement }}</td>
                                    <td><span class="status paid">Payé</span></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" style="text-align: center;">Aucune cotisation effectuée</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            
            
        </div>
    @endforeach
    
    <!-- Modal de paiement -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Effectuer un paiement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="paymentDate" class="form-label">Date de cotisation</label>
                        <input type="text" class="form-control" id="paymentDate" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="cotisationAmount" class="form-label">Montant</label>
                        <input type="text" class="form-control" id="cotisationAmount" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="moyenPaiement" class="form-label">Moyen de paiement</label>
                        <select class="form-select" id="moyenPaiement">
                            <option value="">Sélectionnez un moyen de paiement</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Carte bancaire">Carte bancaire</option>
                            <option value="ESPECES">Espèces</option>
                            <option value="Virement bancaire">Virement bancaire</option>
                        </select>
                    </div>
                    <input type="hidden" id="tontineSelect">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="enregistrerCotisation">Confirmer le paiement</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Toast pour les notifications -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="qrToast" class="toast align-items-center text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Cotisation enregistrée avec succès!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    console.log("DOM chargé - Début d'initialisation");
    
    const paymentModal = document.getElementById("paymentModal");
    console.log("Modal trouvé:", paymentModal);
    
    let selectedUserId, selectedDate, selectedMontant, selectedTontineId;
    
    // Gestion du sélecteur de tontine
    const tontineSelector = document.getElementById("tontineSelector");
    console.log("Sélecteur de tontine trouvé:", tontineSelector);
    
    tontineSelector.addEventListener("change", function() {
        const tontineId = this.value;
        console.log("Tontine sélectionnée:", tontineId);
        
        document.querySelectorAll(".tontine-container").forEach(container => {
            container.style.display = "none";
        });
        
        if(tontineId) {
            const container = document.getElementById("tontine-" + tontineId);
            console.log("Container à afficher:", container);
            if (container) {
                container.style.display = "block";
            } else {
                console.error("Container de tontine non trouvé:", "tontine-" + tontineId);
            }
        }
    });
    
    // Gestion du clic sur le bouton "Payer"
    const payButtons = document.querySelectorAll(".pay-btn");
    console.log("Nombre de boutons de paiement trouvés:", payButtons.length);
    
    payButtons.forEach(button => {
        button.addEventListener("click", function () {
            console.log("Bouton Payer cliqué");
            
            selectedUserId = document.getElementById("userId").textContent;
            console.log("ID utilisateur:", selectedUserId);
            
            selectedDate = this.getAttribute("data-date");
            
            console.log("Date sélectionnée:", selectedDate);
            
            selectedMontant = this.getAttribute("data-montant");
            console.log("Montant:", selectedMontant);
            
            selectedTontineId = this.getAttribute("data-tontine-id");
            console.log("ID Tontine:", selectedTontineId);
            
            // Remplir les infos dans le modal
            document.getElementById("paymentDate").value = selectedDate;
            document.getElementById("cotisationAmount").value = new Intl.NumberFormat("fr-FR").format(selectedMontant) + " FCFA";
            document.getElementById("tontineSelect").value = selectedTontineId;
            
            // Essayer d'afficher le modal manuellement
            console.log("Tentative d'affichage du modal");
            try {
                if (typeof bootstrap !== 'undefined') {
                    console.log("Bootstrap est défini, utilisation de l'API Bootstrap");
                    const modal = new bootstrap.Modal(paymentModal);
                    modal.show();
                } else {
                    console.log("Bootstrap n'est pas défini, affichage manuel");
                    paymentModal.style.display = "block";
                    paymentModal.classList.add("show");
                }
            } catch (error) {
                console.error("Erreur lors de l'affichage du modal:", error);
                alert("Erreur d'affichage du modal. Vérifiez la console pour plus de détails.");
            }
        });
    });
 
    // Gestion de la confirmation du paiement
    const confirmButton = document.getElementById("enregistrerCotisation");

    
    console.log("Bouton de confirmation trouvé:", confirmButton);
    
    confirmButton.addEventListener("click", function () {
        console.log("Bouton Confirmer cliqué");
        
        const moyenPaiement = document.getElementById("moyenPaiement").value;
        console.log("Moyen de paiement sélectionné:", moyenPaiement);
        
        if (!moyenPaiement) {
            console.warn("Aucun moyen de paiement sélectionné");
            alert("Veuillez sélectionner un moyen de paiement");
            return;
        }
        
        let csrfToken;
        try {
            const metaTag = document.querySelector('meta[name="csrf-token"]');
            console.log("Meta tag CSRF trouvé:", metaTag);
            csrfToken = metaTag.getAttribute("content");
            console.log("CSRF Token:", csrfToken);
        } catch (error) {
            console.error("Erreur lors de la récupération du CSRF token:", error);
            alert("Erreur: CSRF token non trouvé");
            return;
        }

        let parts = selectedDate.split('/'); // Séparer jour, mois, année
let formattedDate = `${parts[2]}-${parts[1]}-${parts[0]}`; // Reformatage

// Vérifier si la date est valide
let dateObj = new Date(formattedDate);
if (isNaN(dateObj.getTime())) {
    console.error("Date invalide:", selectedDate);
} else {
    console.log("Date formatée:", formattedDate);
}
        
    console.log("Préparation des données pour envoi:", {
    iduser: parseInt(selectedUserId),
    idtontine: parseInt(selectedTontineId),
    montant: parseFloat(selectedMontant),
    moyen_paiement: moyenPaiement,
    created_at: formattedDate

        });
        
        fetch('/cotisations', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",  // <-- Ajoute cette ligne
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({
                body: JSON.stringify({

                iduser: selectedUserId,
                idtontine: selectedTontineId,
                montant: parseInt(selectedMontant, 10),  // ✅ Convertit en entier
                moyen_paiement: moyenPaiement,
                created_at: formattedDate
})

            })
        })
        .then(response => {
            console.log("Réponse reçue:", response);
            console.log("Status:", response.status);
            console.log("OK:", response.ok);
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }
            return response.text().then(text => {
                console.log("Réponse brute:", text);
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error("Erreur de parsing JSON:", e);
                    throw new Error("La réponse n'est pas au format JSON valide");
                }
            });
        })
        .then(data => {
            console.log("Données traitées:", data);
            if (data.success) {
                console.log("Paiement réussi");
                
                try {
                    console.log("Fermeture du modal");
                    if (typeof bootstrap !== 'undefined') {
                        const modalInstance = bootstrap.Modal.getInstance(paymentModal);
                        modalInstance.hide();
                    } else {
                        paymentModal.style.display = "none";
                        paymentModal.classList.remove("show");
                    }
                } catch (error) {
                    console.error("Erreur lors de la fermeture du modal:", error);
                }
                
                try {
                    console.log("Affichage du toast");
                    const toastEl = document.getElementById('qrToast');
                    if (typeof bootstrap !== 'undefined') {
                        const toast = new bootstrap.Toast(toastEl);
                        toast.show();
                    } else {
                        toastEl.style.display = "block";
                        setTimeout(() => { toastEl.style.display = "none"; }, 3000);
                    }
                } catch (error) {
                    console.error("Erreur lors de l'affichage du toast:", error);
                }
                
                console.log("Rechargement de la page dans 2 secondes");
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                console.error("Erreur lors du paiement:", data.message);
                alert("Erreur lors du paiement : " + data.message);
            }
        })
        .catch(error => {
            console.error("Erreur de fetch:", error);
            alert("Une erreur est survenue: " + error.message);
        });
    });
    
    console.log("Initialisation terminée");
});

document.addEventListener("DOMContentLoaded", function () {
    // Initialiser le modal manuellement
    const paymentModal = new bootstrap.Modal(document.getElementById("paymentModal"));
    let selectedUserId, selectedDate, selectedMontant, selectedTontineId;
    
    // Gestion du clic sur le bouton "Payer"
    document.querySelectorAll(".pay-btn").forEach(button => {
        button.addEventListener("click", function () {
            selectedUserId = document.getElementById("userId").textContent;
            selectedDate = this.getAttribute("data-date");
            selectedMontant = this.getAttribute("data-montant");
            selectedTontineId = this.getAttribute("data-tontine-id");
            
            // Remplir les infos dans le modal
            document.getElementById("paymentDate").value = selectedDate;
            document.getElementById("cotisationAmount").value = new Intl.NumberFormat("fr-FR").format(selectedMontant) + " FCFA";
            document.getElementById("tontineSelect").value = selectedTontineId;
            
            // Afficher le modal manuellement
            paymentModal.show();
        });
    });
    
    // Reste du code...
    
    // Gestion de la confirmation du paiement
    document.getElementById("enregistrerCotisation").addEventListener("click", function () {
        // ... code existant ...
        
        // Pour fermer le modal :
        paymentModal.hide();
        
        // ... reste du code ...
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endif

  <!-- Backend Bundle JavaScript -->
  <script src="../assets/js/libs.min.js"></script>
  <!-- Lodash Utility -->
  <script src="../assets/vendor/lodash/lodash.min.js"></script>
  <!-- Utilities Functions -->
  <script src="../assets/js/setting/utility.js"></script>
  <!-- Settings Script -->
  <script src="../assets/js/setting/setting.js"></script>
  <!-- Settings Init Script -->
  <script src="../assets/js/setting/setting-init.js" defer></script>
  <!-- slider JavaScript -->
  <script src="../assets/js/slider.js"></script>
  <!-- masonry JavaScript --> 
  <script src="../assets/js/masonry.pkgd.min.js"></script>
  <!-- SweetAlert JavaScript -->
  <script src="../assets/js/enchanter.js"></script>
  <!-- Sweet-alert Script -->
  <script src="../assets/vendor/sweetalert2/dist/sweetalert2.min.js" async></script>
  <script src="../assets/js/sweet-alert.js" defer></script>
  <!-- Chart Custom JavaScript -->
  <!-- app JavaScript -->
  <script src="../assets/js/charts/weather-chart.js"></script>
  <script src="../assets/js/app.js"></script>
  <!-- Flatpickr Script -->
  <script src="../assets/vendor/flatpickr/dist/flatpickr.min.js"></script>
  <!-- fslightbox Script -->
  <script src="../assets/js/fslightbox.js" defer></script> 
  <!-- vanilla Script -->
  <script src="../assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>
  <!--lottie Script -->
  <script src="../assets/js/lottie.js"></script>
  <!--select2 Script -->
  <script src="../assets/js/select2.js"></script>
  <!--ecommerce Script -->
  <script src="../assets/js/ecommerce.js"></script>
  

</body>
</html>