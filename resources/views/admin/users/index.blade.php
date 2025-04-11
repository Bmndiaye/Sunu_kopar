<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Role Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
      <!-- End Config Options -->
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
  <link rel="stylesheet" href="../assets/css/libs.min.css">
  <link rel="stylesheet" href="../assets/css/socialv.css?v=5.2.0">
  <link rel="stylesheet"href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet">
  <!-- flatpickr css -->
  <link rel="stylesheet" href="../assets/vendor/flatpickr/dist/flatpickr.min.css" />
  <!-- Sweetlaert2 css -->
  <link rel="stylesheet" href="../assets/vendor/sweetalert2/dist/sweetalert2.min.css" />
  
  <!-- vanillajs css -->
  <link rel="stylesheet" href="../assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css">
  
  <!-- zuck -->
  
  <!-- Custom Css -->
  <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
  
  <!-- Customizer Css -->
  <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" />
    <!-- Custom Styles -->
    <style>
        .card {
            border-radius: 0.5rem;
            overflow: hidden;
            border: none;
        }
        
        .card-header {
            background: linear-gradient(135deg, #4e73df, #2548b8);
            border-bottom: 0;
            padding: 1rem 1.5rem;
        }
        
        .table th {
            font-weight: 600;
            border-top: none;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.4rem 0.7rem;
            border-radius: 30px;
        }
        
        .bg-info {
            background-color: #e0f7fa !important;
        }
        
        .text-dark {
            color: #0277bd !important;
        }
        
        .btn-outline-primary {
            border-color: #4e73df;
            color: #4e73df;
        }
        
        .btn-outline-primary:hover {
            background-color: #4e73df;
            color: white;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }
        
        .table-light th {
            background-color: #f8f9fc;
            color: #6e707e;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
        }
    </style>
</head>
<body class="bg-light">

  @include('layouts.sidebar')
  @include('layouts.navbar')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="mb-0 fs-4">Gestion Des Roles</h1>
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="bi bi-plus-circle me-1"></i>Ajouter un utilisateur
</button>
                </div>

                
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td class="align-middle ps-4">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->email }}</td>
                                <td class="align-middle">
                                    @foreach($user->roles as $role)
                                    <span class="badge bg-info text-dark me-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-end pe-4">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square me-1"></i>Edit
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-1">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                <div>Showing <span class="fw-bold">{{ count($users) }}</span> users</div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout d'utilisateur -->
<!-- Modal d'ajout d'utilisateur -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('inscription.register2') }}" method="POST" id="inscriptionForm">
          @csrf
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="prenom" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
              <div class="invalid-feedback" id="prenomError"></div>
            </div>
            <div class="col-md-6">
              <label for="nom" class="form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
              <div class="invalid-feedback" id="nomError"></div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
              <div class="invalid-feedback" id="emailError"></div>
            </div>
            <div class="col-md-6">
              <label for="telephone" class="form-label">Téléphone</label>
              <input type="text" class="form-control" id="telephone" name="telephone" required>
              <div class="invalid-feedback" id="telephoneError"></div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="dateNaissance" class="form-label">Date de naissance</label>
              <input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
              <div class="invalid-feedback" id="dateNaissanceError"></div>
            </div>
            <div class="col-md-6">
              <label for="cni" class="form-label">CNI</label>
              <input type="text" class="form-control" id="cni" name="cni" required>
              <div class="invalid-feedback" id="cniError"></div>
            </div>
          </div>
          <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" required>
            <div class="invalid-feedback" id="adresseError"></div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" name="password" required>
              <div class="invalid-feedback" id="passwordError"></div>
            </div>
            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
              <div class="invalid-feedback" id="password_confirmationError"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('inscriptionForm');
  
  // Fonction pour réinitialiser les erreurs de formulaire
  function resetFormErrors() {
    const errorElements = document.querySelectorAll('.invalid-feedback');
    const inputElements = document.querySelectorAll('.form-control');
    
    errorElements.forEach(element => {
      element.textContent = '';
    });
    
    inputElements.forEach(element => {
      element.classList.remove('is-invalid');
    });
  }
  
  // Fonction pour afficher les erreurs de validation
  function displayValidationErrors(errors) {
    for (const [field, messages] of Object.entries(errors)) {
      const errorElement = document.getElementById(`${field}Error`);
      const inputElement = document.getElementById(field);
      
      if (errorElement && inputElement) {
        errorElement.textContent = messages[0];
        inputElement.classList.add('is-invalid');
      }
    }
  }
  
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    resetFormErrors();
    
    const formData = new FormData(form);
    
    fetch('{{ route("inscription.register2") }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
        'Accept': 'application/json'
      },
      credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
      if(data.success) {
        // Fermer la modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('addUserModal'));
        modal.hide();
        
        // Afficher un message de succès
        Swal.fire({
          icon: 'success',
          title: 'Succès',
          text: data.message || 'Utilisateur ajouté avec succès!'
        }).then(() => {
          // Recharger la page pour afficher le nouvel utilisateur
          window.location.reload();
        });
      } else if (data.errors) {
        // Afficher les erreurs de validation
        displayValidationErrors(data.errors);
      } else {
        // Afficher un message d'erreur général
        Swal.fire({
          icon: 'error',
          title: 'Erreur',
          text: data.message || 'Une erreur est survenue'
        });
      }
    })
    .catch(error => {
      console.error('Erreur:', error);
      Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Une erreur est survenue lors de la communication avec le serveur'
      });
    });
  });
});
</script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>