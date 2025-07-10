<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="card-title mb-0">Liste des Utilisateurs</h4>
                                <div class="card-tools">
                                    <a href="" class="btn btn-primary btn-sm">
                                        <i class="fas fa-plus"></i> Ajouter Utilisateur
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                
                                {!! $dataTable->table([
                                    'class' => 'table table-bordered table-striped',
                                    'width' => '100%',
                                    'footer' => true
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Scripts JS nécessaires -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
    
    @stack('scripts')
    <script>
        // Script pour gérer d'éventuels problèmes spécifiques
        $(document).ready(function() {
            // Ajouter cette ligne pour debug
            console.log('Document ready');
            
            // S'assurer que la classe est bien appliquée aux boutons
            setTimeout(function() {
                $('.dt-buttons').addClass('btn-group btn-group-sm');
            }, 500);
            
            // S'assurer que les filtres par colonne sont ajoutés correctement
            $(document).on('init.dt', function(e, settings) {
                var api = new $.fn.dataTable.Api(settings);
                
                // Vérifier si le footer existe
                if ($('#' + settings.sTableId + ' tfoot').length === 0) {
                    $('#' + settings.sTableId).append('<tfoot><tr></tr></tfoot>');
                }
                
                // Ajouter les champs de recherche dans chaque colonne du footer
                api.columns().every(function(colIndex) {
                    var column = this;
                    var title = $(column.header()).text();
                    
                    // Ne pas ajouter de filtre pour la colonne d'actions
                    if (title !== 'Action') {
                        var input = $('<input type="text" class="form-control form-control-sm" placeholder="Filtrer ' + title + '" />');
                        
                        $('tfoot tr', api.table().footer()).append('<th></th>');
                        var th = $('tfoot th:eq(' + colIndex + ')', api.table().footer());
                        $(th).html(input);
                        
                        input.on('keyup change', function() {
                            if (column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    } else {
                        $('tfoot tr', api.table().footer()).append('<th></th>');
                    }
                });
            });
        });
    </script>
    
    {!! $dataTable->scripts() !!}
</body>
</html>
```