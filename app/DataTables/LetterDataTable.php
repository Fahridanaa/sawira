<?php

namespace App\DataTables;

use App\Models\ArsipSuratModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LetterDataTable extends DataTable
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
				$btn = '<a href="' . route('letter.show', $row->id_arsip_surat) . '" class="edit btn btn-success btn-sm">Download</a>';
				return $btn;
			})
			->addColumn('No', function ($row) {
				return '';
			})
			->editColumn('tanggal_pengajuan', function ($row) {
				return $row->tanggal_pengajuan ? with(new Carbon($row->tanggal_pengajuan))->format('d/m/Y') : '';
			})
			->editColumn('Jenis Surat', function ($row) {
				return $row->templateSurat->nama_surat;
			})
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(ArsipSuratModel $model): QueryBuilder
	{
		$user = auth()->user();
		$id_user = $user->id_user;
		return $model->newQuery()
			->with(['templateSurat'])
			->select('arsip_surat.*')
			->where('arsip_surat.id_user', $id_user);
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('letter-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->parameters([
				'dom' => 'ft', // This line will only show table
				'paging' => false, // This will disable the pagination
//				'searching' => true, // this will disable the search bar
			]);
	}

	/**
	 * Get the dataTable columns definition.
	 */
	public function getColumns(): array
	{
		return [
			Column::make('No'),
			Column::computed('Jenis Surat'),
			Column::make('tanggal_pengajuan'),
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
		return 'Letter_' . date('YmdHis');
	}
}
