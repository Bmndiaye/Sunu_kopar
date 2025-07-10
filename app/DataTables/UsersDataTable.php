<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Construire la classe DataTable.
     *
     * @param mixed $query Résultats de la méthode query().
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('status', function($query) {
                $status = 'warning';
                switch ($query->status) {
                    case 'actif':
                        $status = 'primary';
                        break;
                    case 'inactif':
                        $status = 'danger';
                        break;
                    case 'banni':
                        $status = 'dark';
                        break;
                }
                return '<span class="text-capitalize badge bg-'.$status.'">'.$query->status.'</span>';
            })
            ->editColumn('created_at', function($query) {
                return date('Y/m/d', strtotime($query->created_at));
            })
            ->filterColumn('nom_complet', function($query, $keyword) {
                $sql = "CONCAT(users.prenom,' ',users.nom) like ?";
                return $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('profil', function($query, $keyword) {
                return $query->where('profil', 'like', "%{$keyword}%");
            })
            ->addColumn('action', 'users.action')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Obtenir la source de la requête du dataTable.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = User::query();
        return $this->applyScopes($model);
    }

    /**
     * Méthode optionnelle si vous souhaitez utiliser le constructeur HTML.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
                    ->parameters([
                        "buttons" => [
                            [ "extend" => 'print', "text" => 'Imprimer', "className" => 'btn btn-sm btn-outline-primary', ],
                            [ "extend" => 'excel', "text" => 'Excel', "className" => 'btn btn-sm btn-outline-primary', ],
                            [ "extend" => 'csv', "text" => 'CSV', "className" => 'btn btn-sm btn-outline-primary', ],
                            [ "extend" => 'reload', "text" => 'Actualiser', "className" => 'btn btn-sm btn-outline-primary', ],
                            [ "extend" => 'reset', "text" => 'Réinitialiser', "className" => 'btn btn-sm btn-outline-primary', ],
                        ],
                        "processing" => true,
                        "serverSide" => true,
                        "autoWidth" => false,
                        "language" => [
                            "url" => "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
                        ],
                        'initComplete' => "function () {
                            $('.dt-buttons').addClass('btn-group btn-group-sm')
                        }"
                    ]);
    }
    /**
     * Obtenir les colonnes.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'nom_complet', 'name' => 'nom_complet', 'title' => 'NOM COMPLET', 'orderable' => false],
            ['data' => 'telephone', 'name' => 'telephone', 'title' => 'Téléphone'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'profil', 'name' => 'profil', 'title' => 'Profil'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Statut'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Date d\'inscription'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }

    /**
     * Obtenir le nom du fichier pour l'exportation.
     *
     * @return string
     */
    public function filename(): string
    {
        return 'Utilisateurs_' . date('YmdHis');
    }
    
}