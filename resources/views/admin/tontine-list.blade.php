<!doctype html>
<html lang="en" class="theme-fs-md" data-bs-theme-color="default" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Gestion des Tontines</title>
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
  <link rel="stylesheet" href="../assets/css/libs.min.css">
  <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
  <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet">
  <link rel="stylesheet" href="../assets/vendor/flatpickr/dist/flatpickr.min.css" />
  <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" />
  <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
  <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
  <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" />
</head>

<body>
  <!-- loader Start -->
  <div id="loading">
        <div id="loading-center">
        </div>
  </div>
  @include('layouts.sidebar')
  @include('layouts.navbar')


  @if(Auth::user()->hasRole('GERANT'))
  <main class="main-content">
    <div class="position-relative">
        <div>
            <div class="position-relative"></div>
            <div class="content-inner" id="page_layout">
                <div class="container">
                    <!-- Toast de confirmation -->
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="mb-2">
                            <h4>Bienvenue</h4>
                            <p>Liste des Tontines</p>
                        </div>
                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTontineModal">
                                <i class="fas fa-plus"></i> Créer une nouvelle tontine
                            </button>
                        </div>

                        <!-- Ajout de la barre de recherche et des filtres -->
                        <div class="col-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('gerant.tontines') }}" method="GET" class="row g-3">
                                        <div class="col-md-4">
                                            <label for="search" class="form-label">Rechercher</label>
                                            <input type="text" class="form-control" id="search" name="search" placeholder="Nom de la tontine..." value="{{ request('search') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="etat" class="form-label">État</label>
                                            <select class="form-select" id="etat" name="etat">
                                                <option value="">Tous</option>
                                                <option value="en_cour" {{ request('etat') == 'en_cour' ? 'selected' : '' }}>En cours</option>
                                                <option value="terminer" {{ request('etat') == 'terminer' ? 'selected' : '' }}>Terminée</option>
                                                <option value="en_attend" {{ request('etat') == 'en_attend' ? 'selected' : '' }}>En attente</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="creator" class="form-label">Créateur</label>
                                            <select class="form-select" id="creator" name="creator">
                                                <option value="">Tous</option>
                                                @foreach($tontines->pluck('creator.name', 'creator.id')->unique() as $id => $name)
                                                    @if($name)
                                                        <option value="{{ $id }}" {{ request('creator') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary me-2">Filtrer</button>
                                            <a href="{{ route('gerant.tontines') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @foreach($tontines as $tontine)
                        <div class="col-sm-6 col-md-4">
                            <div class="card cardhover mb-4">
                                <div class="card-body">
                                    <h5 class="badge {{ $tontine->etat === 'terminer' ? 'bg-success' : ($tontine->etat === 'en_cour' ? 'bg-info' : 'bg-danger') }} text-white">
                                        {{ $tontine->etat === 'terminer' ? 'Terminée' : ($tontine->etat === 'en_cour' ? 'En cours' : 'En attente') }}
                                    </h5>
                                    <h3 class="mt-2">{{ $tontine->libelle }}</h3>
                                    <p class="text-muted">Créée par {{ $tontine->creator->name ?? 'Anonyme' }}</p>
                                    
                                    <div class="mt-2">
                                        <p><strong>📅 Période :</strong> {{ date('d/m/Y', strtotime($tontine->dateDebut)) }} - {{ date('d/m/Y', strtotime($tontine->dateFin)) }}</p>
                                        <p><strong>🔄 Fréquence :</strong> {{ ucfirst(strtolower($tontine->frequence)) }}</p>
                                        <p><strong>💰 Montant :</strong> {{ number_format($tontine->montant_de_base, 0, ',', ' ') }} FCFA</p>
                                    </div>

                                    <!-- Actions spécifiques aux gérants -->
                                    <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('gerant.detailsTontine', $tontine->id) }}" class="btn btn-sm btn-info">👥 Participants</a>
    
                                        @php
                                            $participantCount = App\Models\ParticipantTontine::where('idtontine', $tontine->id)->count();
                                            $isFull = $participantCount >= $tontine->nbreParticipant;
                                        @endphp
                                        
                                            <!-- Correction du bouton de démarrage de tontine -->
                                            @if($tontine->etat === 'en_attend')
                                                @if($isFull)
                                                    <form action="{{ route('gerant.demarrerTontine', $tontine->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success">🚀 Démarrer</button>
                                                    </form>
                                                @else
                                                    <button class="btn btn-sm btn-secondary" disabled title="Il manque {{ $tontine->nbreParticipant - $participantCount }} participant(s)">
                                                        🚀 Démarrer
                                                    </button>
                                                @endif
                                            @endif                                        
                                        <a href="{{ route('gerant.editerTontine', $tontine->id) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTontineModal-{{ $tontine->id }}">🗑 Supprimer</button>
                                                                        </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de suppression pour les gérants -->
                        <div class="modal fade" id="deleteTontineModal-{{ $tontine->id }}" tabindex="-1" aria-labelledby="deleteTontineLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmer la suppression</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Voulez-vous vraiment supprimer cette tontine ?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('gerant.supprimerTontine', $tontine->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal de création de tontine -->
<div class="modal fade" id="createTontineModal" tabindex="-1" aria-labelledby="createTontineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTontineModalLabel">Créer une nouvelle tontine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createTontineForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="libelle" class="form-label">Nom de la tontine</label>
                            <input type="text" class="form-control" id="libelle" name="libelle" required>
                        </div>
                        <div class="col-md-6">
                            <label for="frequence" class="form-label">Fréquence</label>
                            <select class="form-select" id="frequence" name="frequence" required>
                                <option value="JOURNALIERE">Journalière</option>
                                <option value="HEBDOMADAIRE">Hebdomadaire</option>
                                <option value="MENSUEL">Mensuelle</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="dateDebut" class="form-label">Date de début</label>
                            <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dateFin" class="form-label">Date de fin</label>
                            <input type="date" class="form-control" id="dateFin" name="dateFin" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="montant_de_base" class="form-label">Montant de cotisation</label>
                            <input type="number" class="form-control" id="montant_de_base" name="montant_de_base" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nbreParticipant" class="form-label">Nombre de participants</label>
                            <input type="number" class="form-control" id="nbreParticipant" name="nbreParticipant" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="etat" value="en_attend">
                </form>
                <!-- Ajout d'un div pour les messages d'erreur -->
                <div id="formErrors" class="alert alert-danger mt-3" style="display: none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" id="submitTontineBtn" class="btn btn-primary">Créer la tontine</button>
            </div>
        </div>
    </div>
</div>

<!-- Script pour la soumission avec fetch -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.getElementById('submitTontineBtn');
    const tontineForm = document.getElementById('createTontineForm');
    const formErrors = document.getElementById('formErrors');
    const modal = new bootstrap.Modal(document.getElementById('createTontineModal'));
    
    // Vérification des dates
    const dateDebut = document.getElementById('dateDebut');
    const dateFin = document.getElementById('dateFin');
    
    // Définir la date minimale comme aujourd'hui
    const today = new Date().toISOString().split('T')[0];
    dateDebut.min = today;
    
    // Mettre à jour la date de fin minimale lorsque date de début change
    dateDebut.addEventListener('change', function() {
        dateFin.min = this.value;
        if(dateFin.value && dateFin.value < this.value) {
            dateFin.value = this.value;
        }
    });
    
    submitBtn.addEventListener('click', function() {
        // Vérification de base du formulaire HTML5
        if (!tontineForm.checkValidity()) {
            tontineForm.reportValidity();
            return;
        }
        
        // Préparation des données du formulaire
        const formData = new FormData(tontineForm);
        
        // Récupération du token CSRF
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Envoi de la requête
        fetch('{{ route("gerant.creerTontine") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fermeture du modal
                modal.hide();
                
                // Affichage du message de succès avec toast
                const successToast = document.getElementById('successToast');
                const toastBody = successToast.querySelector('.toast-body');
                toastBody.textContent = data.message || "Tontine créée avec succès!";
                
                const bootstrapToast = new bootstrap.Toast(successToast);
                bootstrapToast.show();
                
                // Rechargement de la page après un court délai
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                // Affichage des erreurs
                formErrors.style.display = 'block';
                formErrors.innerHTML = '';
                
                if (typeof data.errors === 'object') {
                    const ul = document.createElement('ul');
                    Object.values(data.errors).forEach(errorArray => {
                        errorArray.forEach(error => {
                            const li = document.createElement('li');
                            li.textContent = error;
                            ul.appendChild(li);
                        });
                    });
                    formErrors.appendChild(ul);
                } else {
                    formErrors.textContent = data.message || 'Une erreur est survenue.';
                }
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            formErrors.style.display = 'block';
            formErrors.textContent = 'Une erreur est survenue lors de la communication avec le serveur.';
        });
    });
});
</script>
</main>
@endif


@if(Auth::user()->hasRole('PARTICIPANT'))
<main class="main-content">
    <div class="position-relative">
        <div class="iq-top-navbar border-bottom"></div>
        <div>
            <div class="content-inner" id="page_layout">
                <div class="container">
                    <!-- Toast de confirmation -->
                    @if(session('success'))
                    <div class="toast-container position-fixed top-0 end-0 p-3">
                        <div id="successToast" class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="mb-4">
                            <h4 class="fw-bold">Bienvenue</h4>
                            <p class="text-muted">Liste des Tontines</p>
                        </div>

                        @foreach($tontines as $tontine)
                        <div class="col-sm-6 col-md-4 mb-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <!-- Image Placeholder -->
                                    <div class="mb-3 text-center">
                                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 120px;">
                                            <span class="text-muted">Image de la tontine</span>
                                        </div>
                                    </div>

                                    <!-- Status badge -->
                                    @php
                                        $statusClass = $tontine->etat === 'Terminée' ? 'bg-success' : ($tontine->etat === 'En cours' ? 'bg-info' : 'bg-danger');
                                    @endphp
                                    <span class="badge {{ $statusClass }} text-white px-2 py-1">{{ ucfirst($tontine->etat) }}</span>

                                    <!-- Tontine details -->
                                    <h5 class="mt-2">{{ $tontine->libelle }}</h5>
                                    <p class="text-muted">Créée par {{ $tontine->creator ? $tontine->creator->name : 'Alain' }}</p>

                                    <div class="mt-3">
    <p><strong>📅 Période :</strong> {{ date('d/m/Y', strtotime($tontine->dateDebut)) }} - {{ date('d/m/Y', strtotime($tontine->dateFin)) }}</p>
    <p><strong>🔄 Fréquence :</strong> {{ ucfirst(strtolower($tontine->frequence)) }}</p>
    <p><strong>💰 Montant :</strong> {{ number_format($tontine->montant_de_base, 0, ',', ' ') }} FCFA</p>
    
    @php
        // Récupérer le nombre actuel de participants
        $participantCount = App\Models\ParticipantTontine::where('idtontine', $tontine->id)->count();
    @endphp
    <p><strong>👥 Participants :</strong> {{ $participantCount }}/{{ $tontine->nbreparticipant }}</p>
    
    <p><strong>📌 Description :</strong> {{ Str::limit($tontine->description, 60) }}</p>
</div>
                                    <!-- Actions -->
                                    <div class="mt-3 d-flex justify-content-between">
                                    @if($tontine->etat === 'en_attend')
                                        @if(auth()->user()->aDejaParticipe($tontine->id))
                                            <span class="text-success"><i class="material-symbols-outlined">check_circle</i> Déjà inscrit</span>
                                        @else
                                            @php
                                                // Récupérer le nombre actuel de participants
                                                $participantCount = App\Models\ParticipantTontine::where('idtontine', $tontine->id)->count();
                                                // Vérifier si le nombre max de participants est atteint
                                                $isFull = $participantCount >= $tontine->nbreparticipant;
                                            @endphp
                                            
                                            @if($isFull)
                                                <span class="text-secondary"><i class="material-symbols-outlined">group_off</i> Complet</span>
                                            @else
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#participerModal-{{ $tontine->id }}">
                                                    <i class="material-symbols-outlined">group_add</i> Participer
                                                </button>
                                            @endif
                                        @endif
                                    @else
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="material-symbols-outlined">group_add</i> Participer
                                        </button>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Participation -->
                        <div class="modal fade" id="participerModal-{{ $tontine->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Termes du contrat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bonjour {{ auth()->user()->nom }}, en rejoignant cette tontine, vous acceptez de cotiser régulièrement.</p>
                                        <p>Vous devez respecter les échéances de paiement et les règles du gestionnaire.</p>
                                        <p>Le non-respect peut entraîner des sanctions, y compris l'exclusion.</p>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="terms-check-{{ $tontine->id }}" required>
                                            <label class="form-check-label" for="terms-check-{{ $tontine->id }}">
                                                J'accepte les termes et conditions
                                            </label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <form action="{{ route('gerant.participerTontine', $tontine->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Confirmer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endif

@if(session('success'))
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const successToast = document.getElementById('successToast');
        if (successToast) {
            let toast = new bootstrap.Toast(successToast);
            toast.show();
            
            // Masquer automatiquement après 5 secondes
            setTimeout(() => {
                toast.hide();
            }, 5000);
        }
    });
</script>
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