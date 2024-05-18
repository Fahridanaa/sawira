<?php

namespace App\DataTables;

use App\Models\RiwayatWargaModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CitizensHistoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'citizenshistory.action')
            ->addColumn('nama_lengkap', function ($row) {
                return $row->warga->nama_lengkap;
            })
            ->rawColumns(['nama_warga'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RiwayatWargaModel $model): QueryBuilder
    {
        return $model->newQuery()
        ->with(['warga'])
        ->select(['riwayat_warga.*']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('citizenshistory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->dom('lrtip'); // Exclude 'B' for buttons
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('nama_lengkap'),
            Column::make('kategori_riwayat'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'CitizensHistory_' . date('YmdHis');
    }
}
