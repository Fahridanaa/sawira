<?php

namespace App\DataTables;

use App\Models\CitizensModel;
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
			->editColumn('nik', function ($row) {
				return strtoupper($row->nik);
			})
			->addColumn('show', function () {
				return '<a class="edit btn btn-success btn-sm" href="#">show</a>';
			})
			->rawColumns(['show'])
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
			->orderBy(1)
			->selectStyleSingle()
//			->addTableClass('table-responsive')
			->parameters([
				'buttons' => ['export'],
			]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		return [
			Column::make('nik')->addClass('uppercase-header'),
			Column::make('nama_lengkap'),
			Column::make('no_telp'),
			Column::make('asal_kota'),
			Column::make('agama'),
			Column::computed('show')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass(
					'text-center'
				),
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