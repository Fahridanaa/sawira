<?php

namespace App\DataTables;

use App\Models\CitizensModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FamilyHeadsDataTable extends DataTable
{
	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return (new EloquentDataTable($query))
			->addColumn('action', function ($row) {
				return '<a class="edit btn btn-info btn-sm" href="' . route("family-heads.show", $row->id_kk) . '">Tampilkan</a>';
			})
			->addColumn('no_kk', function ($citizens) {
				return $citizens->kk->no_kk ?? 'N/A';
			})
			->filterColumn('no_kk', function ($query, $keyword) {
				$query->whereHas('kk', function ($query) use ($keyword) {
					$query->where('no_kk', 'like', "%$keyword%");
				});
			})
			->rawColumns(['action', 'no_kk'])
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(CitizensModel $model): QueryBuilder
	{
		return $model->newQuery()
			->with(['kk.user'])
			->select('semua_warga.*')
			->where('semua_warga.id_hubungan', 1);
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('family-heads-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->buttons([
				[
					'text' => 'Tambah Kartu Keluarga',
					'action' => 'function ( e, dt, node, config ) {
                                    window.location.href = "/family-heads/create";
                                 }',
					'className' => 'btn btn-primary',
				]
			]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		return [
			Column::make('no_kk')->title('No. KK'),
			Column::make('nama_lengkap')->title('Kepala Keluarga'),
			Column::make('kk.user.username')->title('Username'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-center'),
		];
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'Citizens_' . date('YmdHis');
	}
}
