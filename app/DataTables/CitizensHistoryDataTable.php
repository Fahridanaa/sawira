<?php

namespace App\DataTables;

use App\Models\RiwayatWargaModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
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
			->addColumn('nama_lengkap', function ($row) {
				return $row->warga->nama_lengkap;
			})
			->editColumn('tanggal', function ($row) {
				return $row->tanggal ? with(new Carbon($row->tanggal))->format('d/m/Y') : '';
			})
			->addColumn('id_rt', function ($row) {
				return $row->warga->kk->id_rt;
			})
			->rawColumns(['nama_warga'])
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(RiwayatWargaModel $model): QueryBuilder
	{
		$role = auth()->user()->role;
		$query = $model->newQuery()->with('warga');

		if ($role !== 'rw') {
			$rt = str_replace('rt', '', $role);
			$query->whereHas('warga.kk', function ($query) use ($rt) {
				$query->withTrashed()->where('id_rt', $rt);
			});
		}
		$query->whereHas('warga.kk', function ($query) {
			if (request()->has('id_rt') && request('id_rt') != '') {
				$query->where('id_rt', request('id_rt'));
			}
		});

		return $query;
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('citizens-history-table')
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
		$columns = [
			Column::make('nama_lengkap'),
			Column::make('kategori_riwayat'),
			Column::make('tanggal'),
		];

		if (auth()->user()->role === 'rw') {
			$columns[] = Column::make('id_rt')->title('RT');
		}

		return $columns;
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'CitizensHistory_' . date('YmdHis');
	}
}
