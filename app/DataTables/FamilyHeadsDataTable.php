<?php

namespace App\DataTables;

use App\Models\KKModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

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
				$buttonHTML = '<div class="btn-group" data-id="' . $row->id_kk . '">';
				$buttonHTML .= '<button class="edit btn btn-info btn-sm">Tampilkan</button>';
				$buttonHTML .= '<a href="' . route('family-heads.edit', $row->id_kk) . '" class="btn btn-warning text-white ml-2">Edit</a>';
				$buttonHTML .= '<button class="btn btn-danger delete-btn ml-2" data-toggle="modal" data-target="#delete-modal">Hapus</button>';
				$buttonHTML .= '</div>';
				return $buttonHTML;
			})
			->editColumn('user Action', function ($row) {
				return '<a href="' . route('auth.reset.password', $row->id_user) . '" class="btn btn-warning text-white ml-2">Reset Password</a>';
			})
			->addColumn('nama_lengkap', function ($row) {
				return $row->citizens->where('id_hubungan', 1)->first()->nama_lengkap ?? 'N/A';
			})
			->addColumn('id_rt', function ($row) {
				return $row->id_rt;
			})
			->rawColumns(['action', 'no_kk', 'user Action'])
			->setRowId('id');
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(KKModel $model, Request $request): QueryBuilder
	{
		$role = auth()->user()->role;
		$query = $model->newQuery()->with(['user', 'citizens', 'rt']);


		if ($role !== 'rw') {
			$rt = str_replace('rt', '', $role);
			$query->where('id_rt', $rt);
		}

		if ($request->has('id_rt')) {
			$id_rt = $request->input('id_rt');
			$query->where('id_rt', $id_rt);
		}

		return $query;
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		$html = $this->builder()
			->setTableId('family-heads-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->orderBy(1)
			->selectStyleSingle()
			->buttons('l');

		if (auth()->user()->role !== 'rw') {
			$html->buttons([
				[
					'text' => 'Tambah Kartu Keluarga',
					'action' => 'function ( e, dt, node, config ) {
										window.location.href = "' . route('family-heads.create') . '";
									 }',
					'className' => 'btn btn-primary col-6 col-md-12 mt-2',
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
			Column::make('no_kk')->title('No. KK'),
			Column::make('nama_lengkap')->title('Kepala Keluarga'),
			Column::make('user.username')->title('Username'),
		];

		if (auth()->user()->role === 'rw') {
			$columns[] = Column::make('id_rt')->title('RT');
		}

		$columns[] = Column::computed('action')
			->exportable(false)
			->printable(false)
			->width(60)
			->addClass('text-center');

		if (auth()->user()->role === 'rw') {
			$columns[] = Column::computed('user Action');
		}

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
