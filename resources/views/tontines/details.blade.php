<!doctype html>
<html lang="fr" class="theme-fs-md" data-bs-theme-color="default" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teranga Cash</title>
   
<style>
    /* Base Styles */
:root {
  --primary-color: #0069d9;
  --secondary-color: #6c757d;
  --success-color: #28a745;
  --danger-color: #dc3545;
  --warning-color: #ffc107;
  --info-color: #17a2b8;
  --light-color: #f8f9fa;
  --dark-color: #343a40;
  --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  --border-radius: 0.25rem;
  --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

body {
  font-family: var(--font-family);
  background-color: #f5f7fa;
  color: #495057;
  line-height: 1.6;
  margin: 0;
  padding: 0;
}

n-content {
  padding: 2rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

/* Card Styles */
.card {
  background-color: #fff;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  margin-bottom: 1.5rem;
  border: none;
}

.card-header {
  background-color: #fff;
  border-bottom: 1px solid rgba(0, 0, 0, 0.125);
  padding: 1rem;
  border-top-left-radius: var(--border-radius);
  border-top-right-radius: var(--border-radius);
}

.card-body {
  padding: 1rem;
}

.card-header h4 {
  margin: 0;
  color: var(--primary-color);
  font-weight: 600;
}

/* Table Styles */
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  border-collapse: collapse;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: middle;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

/* Button Styles */
.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  vertical-align: middle;
  user-select: none;
  border: 1px solid transparent;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border-radius: var(--border-radius);
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
  cursor: pointer;
}

.btn-primary {
  color: #fff;
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}

.btn-success {
  color: #fff;
  background-color: var(--success-color);
  border-color: var(--success-color);
}

.btn-success:hover {
  background-color: #218838;
  border-color: #1e7e34;
}

.btn-danger {
  color: #fff;
  background-color: var(--danger-color);
  border-color: var(--danger-color);
}

.btn-danger:hover {
  background-color: #c82333;
  border-color: #bd2130;
}

.btn-secondary {
  color: #fff;
  background-color: var(--secondary-color);
  border-color: var(--secondary-color);
}

.btn-secondary:hover {
  background-color: #5a6268;
  border-color: #545b62;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
  line-height: 1.5;
}

/* Badges */
.badge {
  display: inline-block;
  padding: 0.35em 0.65em;
  font-size: 0.75em;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
}

.bg-success {
  background-color: var(--success-color) !important;
  color: white;
}

.bg-danger {
  background-color: var(--danger-color) !important;
  color: white;
}

.bg-info {
  background-color: var(--info-color) !important;
  color: white;
}

/* Alerts */
.alert {
  position: relative;
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: var(--border-radius);
}

.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
}

.alert-info {
  color: #0c5460;
  background-color: #d1ecf1;
  border-color: #bee5eb;
}

/* Modal Styles */
.modal-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1040;
  width: 100vw;
  height: 100vh;
  background-color: #000;
  opacity: 0.5;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1050;
  width: 100%;
  height: 100%;
  overflow: hidden;
  outline: 0;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
}

.modal.show {
  display: block;
}

.modal-dialog {
  position: relative;
  width: auto;
  margin: 1.75rem auto;
  max-width: 800px;
}

.modal-content {
  position: relative;
  display: flex;
  flex-direction: column;
  width: 100%;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 0.3rem;
  outline: 0;
}

.modal-header {
  display: flex;
  flex-shrink: 0;
  align-items: center;
  justify-content: space-between;
  padding: 1rem;
  border-bottom: 1px solid #dee2e6;
  border-top-left-radius: calc(0.3rem - 1px);
  border-top-right-radius: calc(0.3rem - 1px);
}

.modal-title {
  margin: 0;
  color: var(--primary-color);
}

.modal-body {
  position: relative;
  flex: 1 1 auto;
  padding: 1rem;
}

.modal-footer {
  display: flex;
  flex-wrap: wrap;
  flex-shrink: 0;
  align-items: center;
  justify-content: flex-end;
  padding: 0.75rem;
  border-top: 1px solid #dee2e6;
  border-bottom-right-radius: calc(0.3rem - 1px);
  border-bottom-left-radius: calc(0.3rem - 1px);
}

.btn-close {
  box-sizing: content-box;
  width: 1em;
  height: 1em;
  padding: 0.25em;
  color: #000;
  background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
  border: 0;
  border-radius: 0.25rem;
  opacity: 0.5;
  cursor: pointer;
}

/* Utility Classes */
.d-flex {
  display: flex !important;
}

.justify-content-center {
  justify-content: center !important;
}

.justify-content-between {
  justify-content: space-between !important;
}

.align-items-center {
  align-items: center !important;
}

.text-center {
  text-align: center !important;
}

.text-white {
  color: #fff !important;
}

.text-danger {
  color: var(--danger-color) !important;
}

.d-inline {
  display: inline !important;
}

.d-none {
  display: none !important;
}

.mb-0 {
  margin-bottom: 0 !important;
}

.mb-3 {
  margin-bottom: 1rem !important;
}

.mb-4 {
  margin-bottom: 1.5rem !important;
}

/* Table Row Status */
.table-danger {
  background-color: #f8d7da !important;
}

/* Responsive Media Queries */
@media (max-width: 768px) {
  .col-md-6 {
    width: 100%;
    margin-bottom: 1.5rem;
  }
  
  .modal-dialog {
    margin: 0.5rem;
    max-width: calc(100% - 1rem);
  }
}
</style>

</head>

<body>
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <main class="main-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Tontine : {{ $tontine->libelle }}</h4>
                        <!-- <div>
                            @if(!$isParticipant)
                                <form action="{{ route('tontine.participer', $tontine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Participer</button>
                                </form>
                            @else
                                <form action="{{ route('tontine.quitter', $tontine->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Quitter</button>
                                </form>
                            @endif -->
                                <table class="table table-bordered">
                                    <tr><th>Fréquence :</th><td>{{ $tontine->frequence }}</td></tr>
                                    <tr><th>Date de début :</th><td class="format-date">{{ $tontine->datedebut }}</td></tr>
                                    <tr><th>Date de fin :</th><td class="format-date">{{ $tontine->datefin }}</td></tr>
                                    <tr><th>Montant par cotisation :</th><td class="format-number">{{ $tontine->montant }}</td></tr>
                                    <tr><th>État :</th><td>{{ $tontine->etat }}</td></tr>
                                </table>
                              </div>
                                    <div class="card-body">
                                        <p><strong>Total collecté :</strong> <span class="format-number">{{ $totalCollected ?? 0 }}</span> FCFA</p>
                                        <p><strong>Nombre de participants :</strong> {{ $tontine->participants->count() }}</p>
                                   
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="card-body">
                        

                        <h5 class="mb-3">Liste des participants</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nom et Prénom</th>
                                        <th>Contacts</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tontine->participants as $participant)
                                        <tr class="{{ $participant->paymentStatus == 'En retard' ? 'table-danger' : '' }}">
                                            <td>{{ $participant->prenom }} {{ $participant->nom }}</td>
                                            <td>{{ $participant->telephone }} / {{ $participant->email }}</td>
                                            <td>
                                                <span class="badge {{ $participant->paymentStatus == 'À jour' ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $participant->paymentStatus ?? 'Non évalué' }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary view-payments" 
                                                        data-participant-id="{{ $participant->id }}">
                                                    Voir paiements
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal pour afficher les détails des paiements -->
<div class="modal fade" id="paymentsModal" tabindex="-1" aria-labelledby="paymentsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentsModalLabel">Détails des paiements</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Montant</th>
                                <th>Moyen de paiement</th>
                            </tr>
                        </thead>
                        <tbody id="paymentsTableBody">
                            <!-- Les paiements seront chargés ici -->
                        </tbody>
                    </table>
                </div>
                <div id="noPaymentsMessage" class="alert alert-info d-none">
                    Aucun paiement enregistré pour ce participant.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Formatage des dates
    document.querySelectorAll(".format-date").forEach(el => {
        if (el.textContent && el.textContent.trim() !== 'Non définie') {
            let date = new Date(el.textContent.trim());
            el.textContent = date.toLocaleDateString("fr-FR");
        }
    });

    // Formatage des montants
    document.querySelectorAll(".format-number").forEach(el => {
        if (el.textContent && !isNaN(el.textContent.trim())) {
            el.textContent = new Intl.NumberFormat("fr-FR", { 
                style: "currency", 
                currency: "XOF",
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(el.textContent.trim());
        }
    });

    // Gestion des formulaires
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            let btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = "Traitement...";
            btn.disabled = true;
        });
    });

    // Vérifier si Bootstrap est disponible
    if (typeof bootstrap === 'undefined') {
        console.error("La bibliothèque Bootstrap n'est pas chargée correctement");
        
        // Solution de secours pour les modals sans Bootstrap
        const modalFallback = {
            show: function() {
                document.getElementById('paymentsModal').style.display = 'block';
                document.getElementById('paymentsModal').classList.add('show');
                document.body.classList.add('modal-open');
                
                // Créer un backdrop manuellement
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                document.body.appendChild(backdrop);
            }
        };
        
        // Ajouter un gestionnaire pour fermer la modal
        document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('paymentsModal').style.display = 'none';
                document.getElementById('paymentsModal').classList.remove('show');
                document.body.classList.remove('modal-open');
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            });
        });
        
        var paymentsModal = modalFallback;
    } else {
        // Utiliser Bootstrap si disponible
        var paymentsModal = new bootstrap.Modal(document.getElementById('paymentsModal'));
    }
    
    // Gestion des clics sur le bouton "Voir paiements"
    document.querySelectorAll('.view-payments').forEach(button => {
        button.addEventListener('click', function() {
            const participantId = this.getAttribute('data-participant-id');
            loadPaymentDetails(participantId);
        });
    });

    // Fonction pour charger les détails de paiement
    function loadPaymentDetails(participantId) {
        // Afficher l'indicateur de chargement
        document.getElementById('paymentsTableBody').innerHTML = '<tr><td colspan="3" class="text-center">Chargement...</td></tr>';
        document.getElementById('noPaymentsMessage').classList.add('d-none');
        
        // Récupérer les détails de paiement
        fetch(`/tontine/participant/${participantId}/paiements`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur lors de la récupération des données');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.getElementById('paymentsTableBody');
            
            if (data.length === 0) {
                // Aucun paiement trouvé
                tableBody.innerHTML = '';
                document.getElementById('noPaymentsMessage').classList.remove('d-none');
            } else {
                // Afficher les paiements
                tableBody.innerHTML = '';
                data.forEach(payment => {
                    const row = document.createElement('tr');
                    
                    // Formater la date
                    const paymentDate = new Date(payment.date);
                    const formattedDate = paymentDate.toLocaleDateString("fr-FR");
                    
                    // Formater le montant
                    const formattedAmount = new Intl.NumberFormat("fr-FR", { 
                        style: "currency", 
                        currency: "XOF",
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(payment.montant);
                    
                    row.innerHTML = `
                        <td>${formattedDate}</td>
                        <td>${formattedAmount}</td>
                        <td>${payment.moyen_paiement || 'Non spécifié'}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }
            
            // Afficher la modal
            paymentsModal.show();
        })
        .catch(error => {
            console.error('Erreur lors du chargement des détails de paiement:', error);
            document.getElementById('paymentsTableBody').innerHTML = 
                '<tr><td colspan="3" class="text-center text-danger">Erreur lors du chargement des données</td></tr>';
            paymentsModal.show();
        });
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>