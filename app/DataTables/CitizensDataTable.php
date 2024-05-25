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
			->addColumn('id_rt', function ($row) {
				return $row->kk->id_rt;
			})
			->addColumn('action', function ($row) {
				return <<<HTML
            <div class="btn-group" data-id="$row->id_warga">
                <button class="btn btn-primary detail-btn" data-toggle="modal"  data-target="#detailModal">Detail</button>
                <button class="btn btn-warning edit-btn ml-1">Edit</button>
            </div>
            HTML;
			})
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(CitizensModel $model): QueryBuilder
	{
		$role = auth()->user()->role;
		$query = $model->newQuery()->with('kk');

		if ($role !== 'rw') {
			$rt = str_replace('rt', '', $role);
			$query->whereHas('kk', function ($query) use ($rt) {
				$query->where('id_rt', $rt);
			});
		}

		return $query;
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		$html = $this->builder()
			->setTableId('citizens-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->buttons('l');

		if (auth()->user()->role !== 'rw') {
			$html->buttons([
				[
					'text' => 'Tambah Warga',
					'action' => 'function ( e, dt, node, config ) {
										window.location.href = "' . route('citizens.create') . '";
									 }',
					'className' => 'btn btn-primary col-3 col-md-12 mt-2',
				]
			]);
		};

		return $html;
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		$columns = [
			Column::make('nama_lengkap'),
			Column::make('asal_tempat'),
			Column::make('tanggal_lahir'),
			Column::make('no_telp'),
			Column::computed('action')
				->exportable(false)
				->printable(false)
				->width(60)
				->addClass('text-center'),
		];
		if (auth()->user()->role === 'rw') {
			$columns[] = Column::make('id_rt')->title('RT');
		}

//		$columns[] = Column::computed('action')
//			->exportable(false)
//			->printable(false)
//			->width(60)
//			->addClass('text-center');

		return $columns;
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'Citizens_' . date('YmdHis');
	}
}
