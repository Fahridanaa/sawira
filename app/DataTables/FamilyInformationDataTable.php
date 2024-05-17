<?php

namespace App\DataTables;

use App\Models\CitizensModel;
use App\Models\KartuKeluarga;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FamilyInformationDataTable extends DataTable
{
	public $id_kk;

	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return datatables()
			->eloquent($query)
			->editColumn('tanggal_lahir', function ($row) {
				return $row->tanggal_lahir ? with(new Carbon($row->tanggal_lahir))->format('d/m/Y') : '';
			})
			->addColumn('No', function ($row) {
				return '';
			})
			->addColumn('show', function () {
				return '<button class="btn btn-primary trigger--fire-modal-2" id="modal-2">Detail</button>';
			})
			->rawColumns(['show']);
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(CitizensModel $model): QueryBuilder
	{
		return $model->newQuery()
			->with(['kk:id_kk,no_kk', 'statusHubunganWarga:nama_hubungan'])
			->select('semua_warga.*')
			->where('semua_warga.id_kk', $this->id_kk);
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('kartukeluarga-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->parameters([
				'dom' => 't', // This line will only show table
				'paging' => false, // This will disable the pagination
				'searching' => false, // this will disable the search bar
			]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		return [
			Column::make('No'),
			Column::make('nama_lengkap'),
			Column::make('nik'),
			Column::make('asal_kota'),
			Column::make('tanggal_lahir'),
			Column::make('no_telp'),
			Column::computed('show')
				->exportable(false)
				->printable(false)
				->width(90)
				->addClass('text-center')
				->title('Detail'),
		];
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'KartuKeluarga_' . date('YmdHis');
	}
}
