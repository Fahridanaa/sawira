<?php

namespace App\DataTables;

use App\Models\CitizensModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CitizensDataTable extends DataTable
{
	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return (new EloquentDataTable($query))
			->editColumn('tanggal_lahir', function ($row) {
				return $row->tanggal_lahir ? with(new Carbon($row->tanggal_lahir))->format('d/m/Y') : '';
			})
			->addColumn('action', function () {
				return '<button class="btn btn-primary trigger--fire-modal-2" id="modal-2">Detail</button>';
			})
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(CitizensModel $model): QueryBuilder
	{
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('citizens-table')
			->columns($this->getColumns())
			->minifiedAjax()
			//->dom('Bfrtip')
			->orderBy(1)
			->selectStyleSingle()
			->buttons([
				[
					'text' => 'Tambah Warga',
					'action' => 'function ( e, dt, node, config ) {
                                    window.location.href = "/citizen/create";
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
			Column::make('nama_lengkap'),
			Column::make('nik'),
			Column::make('asal_kota'),
			Column::make('tanggal_lahir'),
			Column::make('no_telp'),
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
