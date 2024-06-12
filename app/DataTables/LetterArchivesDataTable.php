<?php

namespace App\DataTables;

use App\Models\ArsipSuratModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LetterArchivesDataTable extends DataTable
{
	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return (new EloquentDataTable($query))
			->editColumn('tanggal_pengajuan', function ($row) {
				return $row->tanggal_pengajuan ? Carbon::parse($row->tanggal_pengajuan)->format('d/m/Y') : '';
			})
			->editColumn('Jenis Surat', function ($row) {
				return $row->templateSurat->nama_surat;
			})
			->editColumn('Warga', function ($row) {
				return $row->warga->nama_lengkap;
			})
			->filterColumn('Warga', function ($query, $keyword) {
				$query->whereHas('warga', function ($query) use ($keyword) {
					$query->whereRaw("LOWER(`nama_lengkap`) LIKE ?", ["%{$keyword}%"]);
				});
			})
			->editColumn('RT', function ($row) {
				return $row->warga->kk->id_rt ?? 'N/A';
			})
			->editColumn('User', function ($row) {
				return $row->user->username;
			})
			->setRowId('id_arsip_surat');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(ArsipSuratModel $model): QueryBuilder
	{
		$query = $model->newQuery()
			->with(['templateSurat', 'warga', 'user'])
			->select('arsip_surat.*');

		if (request()->has('id_rt') && request('id_rt') != null) {
			$query->whereHas('warga.kk', function ($query) {
				$query->where('id_rt', request('id_rt'));
			});
		}

		return $query;
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('letterArchives-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->parameters([
				'dom' => 'ft',
				'processing' => true,
				'serverSide' => true,
			]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		return [
			Column::make('id_arsip_surat')->title('No'),
			Column::computed('User'),
			Column::computed('Warga')->searchable(),
			Column::computed('Jenis Surat'),
			Column::computed('RT')->title('RT'),
			Column::make('tanggal_pengajuan'),
		];
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'LetterArchives_' . date('YmdHis');
	}
}
