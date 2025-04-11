<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des rôles</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        
        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem;
        }
        
        .card-title {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
        
        .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }
        
        .table-striped > tbody > tr:nth-of-type(odd) > * {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .table-responsive {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .bg-info {
            background-color: var(--accent-color) !important;
            color: white;
        }
        
        .btn-link {
            color: var(--primary-color);
            text-decoration: none;
            padding: 0;
        }
        
        .btn-link:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 0.5rem;
            border: none;
        }
        
        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
        
        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-check-label {
            font-size: 0.875rem;
        }
        
        /* Custom DataTables styling */
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }
        
        .dataTables_wrapper .dataTables_info, 
        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1rem;
        }
        
        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        /* Animation for alerts */
        .alert {
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Permission badges cloud style */
        .permissions-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
        }
        
        /* Action buttons styling */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-sm .material-symbols-outlined {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="card-title">
                                <span class="material-symbols-outlined align-middle me-2">admin_panel_settings</span>
                                Gestion des rôlesddddddddddddddddd
                            </h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                <span class="material-symbols-outlined align-middle me-2">check_circle</span>
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <span class="material-symbols-outlined align-middle me-2">error</span>
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Create Role Form -->
                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <span class="material-symbols-outlined align-middle me-2">add_circle</span>
                                    Ajouter un nouveau rôle
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.roles_store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">Nom du rôle</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <span class="material-symbols-outlined">badge</span>
                                                </span>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                                    id="name" name="name" value="{{ old('name') }}" required placeholder="Entrez le nom du rôle">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label d-flex align-items-center">
                                                <span class="material-symbols-outlined me-2">lock</span>
                                                Permissions
                                            </label>
                                            <div class="card p-3 bg-light">
                                                <div class="row">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="material-symbols-outlined align-middle me-1">add</span>
                                        Ajouter le rôle
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Roles Table -->
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <span class="material-symbols-outlined align-middle me-2">list</span>
                                    Liste des rôles
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="roles-table" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">ID</th>
                                                <th width="20%">Nom</th>
                                                <th width="60%">Permissions</th>
                                                <th width="15%">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>
                                                    <span class="fw-bold">{{ $role->name }}</span>
                                                </td>
                                                <td>
                                                    @if($role->permissions->count() > 0)
                                                        <span class="badge bg-primary me-2">{{ $role->permissions->count() }}</span>
                                                        <button class="btn btn-sm btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#permissions-{{ $role->id }}" aria-expanded="false">
                                                            <span class="material-symbols-outlined align-middle me-1">visibility</span>
                                                            Voir les permissions
                                                        </button>
                                                        <div class="collapse mt-2" id="permissions-{{ $role->id }}">
                                                            <div class="permissions-cloud">
                                                                @foreach($role->permissions as $permission)
                                                                    <span class="badge bg-info me-1 mb-1">{{ $permission->name }}</span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted fst-italic">Aucune permission</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-primary" title="Modifier">
                                                            <span class="material-symbols-outlined">edit</span>
                                                        </a>
                                                        @if(!in_array($role->name, ['SUPER_ADMIN']))
                                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                                                    <span class="material-symbols-outlined">delete</span>
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
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#roles-table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/French.json'
                },
                responsive: true,
                columnDefs: [
                    { orderable: false, targets: 3 }
                ]
            });
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
</body>
</html>