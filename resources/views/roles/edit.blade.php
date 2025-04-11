<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SocialV | Responsive Bootstrap 5 Admin Dashboard Template</title>
  <!-- Config Options -->
  <meta name="setting_options" content='{&quot;saveLocal&quot;:&quot;sessionStorage&quot;,&quot;storeKey&quot;:&quot;socialV&quot;,&quot;setting&quot;:{&quot;theme_scheme_direction&quot;:{&quot;value&quot;:&quot;ltr&quot;},&quot;theme_scheme&quot;:{&quot;value&quot;:&quot;light&quot;},&quot;theme_color&quot;:{&quot;colors&quot;:{&quot;--{{prefix}}primary&quot;:&quot;#50b5ff&quot;,&quot;--{{prefix}}info&quot;:&quot;#d592ff&quot;},&quot;value&quot;:&quot;theme-color-default&quot;},&quot;sidebar_type&quot;:{&quot;value&quot;:[]},&quot;sidebar_menu_style&quot;:{&quot;value&quot;:&quot;navs-rounded-all&quot;},&quot;footer&quot;:{&quot;value&quot;:&quot;default&quot;}}}'>
  <!-- End Config Options -->
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
  
  <!-- zuck -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Custom Css -->
  <link rel="stylesheet" href="../assets/css/custom.css?v=5.2.0" />
  
  <!-- Customizer Css -->
  <link rel="stylesheet" href="../assets/css/customizer.css?v=5.2.0" /></head>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Modifier le rôle: {{ $role->name }}</h4>
                </div>
                <div>
                    <a href="{{ route('admin.roles') }}" class="btn btn-primary">
                        <i class="material-symbols-outlined">arrow_back</i> Retour
                    </a>
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

                <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nom du rôle</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $role->name) }}" 
                                   {{ in_array($role->name, ['SUPER_ADMIN']) ? 'readonly' : '' }} required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="row">
                                @foreach($permissions as $permission)
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="permissions[]" value="{{ $permission->id }}" 
                                                   id="permission-{{ $permission->id }}"
                                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour le rôle</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
