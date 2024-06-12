<?php

namespace App\DataTables;

use App\Models\CitizensModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
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
			->addColumn('hubungan', function ($row) {
				return $row->statusHubunganWarga->nama_hubungan;
			})
			->addColumn('action', function ($row) {
				$buttonHTML = '<div class="btn-group" data-id="' . $row->id_warga . '">';
				$buttonHTML .= '<button class="btn btn-primary detail-btn" data-toggle="modal"  data-target="#detailModal">Detail</button>';
				if ($row->id_hubungan != 1) {
					$buttonHTML .= '<a href="' . route('family-heads.pecah', $row->id_warga) . '" class="btn btn-warning text-white ml-2">Pecah</a>';
				}
				$buttonHTML .= '</div>';
				return $buttonHTML;
			})
			->rawColumns(['action']);
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(CitizensModel $model): QueryBuilder
	{
		$user = auth()->user();

		if ($user->role !== 'warga') {
			return $model->newQuery()
				->with(['kk:id_kk,no_kk'])
				->select('warga.*')
				->where('warga.id_kk', $this->id_kk);
		}
		$id_user = $user->id_user;
		return $model->newQuery()
			->with(['kk', 'kk.user'])
			->select('warga.*')
			->whereHas('kk', function ($query) use ($id_user) {
				$query->where('id_user', $id_user);
			});
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
			Column::make('hubungan'),
			Column::make('asal_tempat'),
			Column::make('tanggal_lahir'),
			Column::make('no_telp'),
			Column::computed('action')
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
