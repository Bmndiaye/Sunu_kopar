<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Styles généraux */
:root {
  --primary-color: #4e73df;
  --primary-hover: #2e59d9;
  --secondary-color: #1cc88a;
  --danger-color: #e74a3b;
  --light-bg: #f8f9fc;
  --dark-text: #5a5c69;
  --border-radius: 0.35rem;
  --shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
}

body {
  font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  background-color: var(--light-bg);
  color: var(--dark-text);
}

/* Styles de la carte */
.card {
  border: none;
  border-radius: var(--border-radius);
  box-shadow: var(--shadow);
  margin-bottom: 1.5rem;
}

.card-header {
  background-color: white;
  border-bottom: 1px solid #e3e6f0;
  padding: 1rem 1.25rem;
}

.card-title {
  color: var(--primary-color);
  font-weight: 700;
  margin-bottom: 0;
}

.card-body {
  padding: 1.25rem;
}

/* Styles du formulaire */
.form-control {
  border-radius: var(--border-radius);
  padding: 0.75rem 1rem;
  font-size: 0.85rem;
  border: 1px solid #d1d3e2;
}

.form-control:focus {
  border-color: var(--primary-color);
  box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
}

.form-label {
  font-weight: 600;
  color: var(--dark-text);
}

.form-check-input:checked {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

/* Styles des boutons */
.btn {
  border-radius: var(--border-radius);
  padding: 0.5rem 1rem;
  font-weight: 600;
  font-size: 0.85rem;
  transition: all 0.15s ease-in-out;
}

.btn-primary {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
}

.btn-primary:hover {
  background-color: var(--primary-hover);
  border-color: var(--primary-hover);
}

.btn-danger {
  background-color: var(--danger-color);
  border-color: var(--danger-color);
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

/* Styles de la table */
.table {
  border-radius: var(--border-radius);
  overflow: hidden;
}

.table thead th {
  background-color: var(--primary-color);
  color: white;
  border-bottom: none;
  padding: 0.75rem;
  font-weight: 600;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(78, 115, 223, 0.05);
}

/* Styles des badges */
.badge {
  font-weight: 600;
  padding: 0.35em 0.65em;
  border-radius: var(--border-radius);
}

.bg-primary {
  background-color: var(--primary-color) !important;
}

.bg-info {
  background-color: #36b9cc !important;
}

/* Styles des alertes */
.alert {
  border-radius: var(--border-radius);
  border: none;
  padding: 1rem;
  margin-bottom: 1.5rem;
  font-weight: 500;
}

.alert-success {
  background-color: rgba(28, 200, 138, 0.15);
  color: var(--secondary-color);
}

.alert-danger {
  background-color: rgba(231, 74, 59, 0.15);
  color: var(--danger-color);
}

/* Animations */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.alert {
  animation: fadeIn 0.5s ease;
}

/* Styles pour le DataTable */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
  margin-bottom: 1rem;
}

.dataTables_wrapper .dataTables_length select,
.dataTables_wrapper .dataTables_filter input {
  border: 1px solid #d1d3e2;
  border-radius: var(--border-radius);
  padding: 0.4rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  border-radius: var(--border-radius) !important;
  padding: 0.3rem 0.6rem !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background: var(--primary-color) !important;
  color: white !important;
  border: 1px solid var(--primary-color) !important;
}

/* Adaptations pour mobiles */
@media (max-width: 768px) {
  .col-md-3 {
    flex: 0 0 50%;
    max-width: 50%;
  }
}

@media (max-width: 576px) {
  .col-md-3 {
    flex: 0 0 100%;
    max-width: 100%;
  }
}
    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Gestion des rôles</h4>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Create Role Form -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Ajouter un nouveau rôle</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.roles_store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom du rôle</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Permissions</label>
                                    <div class="row">
                                        @if(isset($permissions) && count($permissions) > 0)
                                            @foreach($permissions as $permission)
                                                <div class="col-md-3 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="permissions[]" value="{{ $permission->id }}" 
                                                               id="permission-{{ $permission->id }}">
                                                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12">
                                                <p class="text-muted">Aucune permission disponible. Veuillez créer des permissions d'abord.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter le rôle</button>
                        </form>
                    </div>
                </div>

                <!-- Roles Table -->
                <div class="table-responsive">
                    <table id="roles-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if($role->permissions->count() > 0)
                                        <span class="badge bg-primary">{{ $role->permissions->count() }}</span>
                                        <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" 
                                                data-bs-target="#permissions-{{ $role->id }}" aria-expanded="false">
                                            Voir les permissions
                                        </button>
                                        <div class="collapse" id="permissions-{{ $role->id }}">
                                            <div class="mt-2">
                                                @foreach($role->permissions as $permission)
                                                    <span class="badge bg-info me-1">{{ $permission->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Aucune permission</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary me-2">
                                            <i class="material-symbols-outlined">edit</i>
                                        </a>
                                        @if(!in_array($role->name, ['SUPER_ADMIN']))
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" 
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="material-symbols-outlined">delete</i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
@section('scripts')
<script>
    $(document).ready(function() {
        if ($.fn.DataTable) {
            $('#roles-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
                }
            });
        }
    });
</script>
@endsection

</body>
</html>
