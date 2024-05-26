<?php

namespace App\DataTables;

use App\Models\RiwayatPindahModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MoveHistoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'movehistory.action')
            ->editColumn('tanggal', function ($row) {
				return $row->tanggal ? with(new Carbon($row->tanggal))->format('d/m/Y') : '';
			})
            ->addColumn('no_kk', function ($nokk) {
				return $nokk->KK->no_kk ?? 'N/A';
			})
            ->addColumn('nama_lengkap', function ($nama) {
				return $nama->KK->citizens->first()->nama_lengkap ?? 'N/A';
			})
            ->addColumn('id_rt', function ($row) {
				return $row->kk->id_rt;
			})
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(RiwayatPindahModel $model): QueryBuilder
    {
        $role = auth()->user()->role;
        $query = $model->newQuery()->with('KK', 'citizens', 'suratPindah');

        if ($role !== 'rw') {
			$rt = str_replace('rt', '', $role);
			$query->whereHas('kk', function ($query) use ($rt) {
				$query->where('id_rt', $rt);
			});
		}

        return $model->newQuery()
        ->whereHas('KK', function ($query) {
            if (request()->has('id_rt') && request('id_rt') != '') {
                $query->where('id_rt', request('id_rt'));
            }
        });
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $html = $this->builder()
			->setTableId('move-history-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->buttons('l');

        return $html;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $columns = [
			Column::make('no_kk')->title('No. KK'),
			Column::make('nama_lengkap')->title('Kepala Keluarga'),
			Column::make('tanggal')->title('Tanggal'),
			Column::make('alamat_tujuan')->title('Pindah Ke'),
			Column::make('alasan_keluar')->title('Pesan Keluar'),
		];

		if (auth()->user()->role === 'rw') {
			$columns[] = Column::make('id_rt')->title('RT');
		}

        $columns[] = Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width(60)
        ->addClass('text-center');

        return $columns;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'MoveHistory_' . date('YmdHis');
    }
}
