<?php

namespace App\DataTables;

use App\Models\RiwayatKKModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Carbon;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FamilyHistoryDataTable extends DataTable
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
				if ($row->status === 'Kematian') return null;
				$buttonHTML = '<div class="btn-group" data-id="' . $row->id_riwayatKK . '">';
				if ($row->file_surat === null) {
					$buttonHTML = '<button class="upload-file-btn btn btn-success btn-sm" data-toggle="modal" data-target="#upload-file-modal" data-id="' . $row->id_riwayatKK . '">Upload</button>';
				} else {
					$buttonHTML .= '<a href="' . route('family-history.download', $row->id_riwayatKK) . '" class="btn btn-primary btn-sm">Download</a>';
					$buttonHTML .= '<button class="upload-file-btn btn btn-warning btn-sm ml-2" data-toggle="modal" data-target="#upload-file-modal" data-id="' . $row->id_riwayatKK . '">Replace</button>';
				}
				$buttonHTML .= '<a href="' . route('family-history.restore', $row->id_riwayatKK) . '" class="restore-btn btn btn-danger btn-sm ml-2">Restore</a>';
				$buttonHTML .= '</div>';

				return $buttonHTML;
			})
			->editColumn('tanggal', function ($row) {
				return $row->tanggal ? with(new Carbon($row->tanggal))->format('d/m/Y') : '';
			})
			->addColumn('no_kk', function ($row) {
				return $row->KK->no_kk ?? 'N/A';
			})
			->addColumn('nama_lengkap', function ($nama) {
				return $nama->KK->citizens->where('id_hubungan', 1)->first()->nama_lengkap ?? 'N/A';
			})
			->addColumn('id_rt', function ($row) {
				return $row->KK->id_rt;
			})
			->rawColumns(['action'])
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(RiwayatKKModel $model): QueryBuilder
	{
		$query = $model->newQuery()->with(['KK' => function ($query) {
			$query->withTrashed();
		}]);

		if (auth()->user()->role !== 'rw') {
			$rt = str_replace('rt', '', auth()->user()->role);
			$query->whereHas('kk', function ($query) use ($rt) {
				$query->withTrashed()->where('id_rt', $rt);
			});
		} else if (request()->has('id_rt') && request('id_rt') != '') {
			$query->whereHas('KK', function ($query) {
				$query->withTrashed()->where('id_rt', request('id_rt'));
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
			->setTableId('family-history-table')
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
			Column::make('status')->title('Status'),
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
