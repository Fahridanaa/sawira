<?php

namespace App\DataTables;

use App\Models\SMARTRankModel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SMARTRankingDataTable extends DataTable
{
	/**
	 * Build the DataTable class.
	 *
	 * @param QueryBuilder $query Results from query() method.
	 */
	public function dataTable(QueryBuilder $query): EloquentDataTable
	{
		return (new EloquentDataTable($query))
			->addColumn('kondisiKeluarga.kk.no_kk', function ($row) {
				return $row->kondisiKeluarga->kk->no_kk;
			})
			->addColumn('kondisiKeluarga.kk.citizens', function ($row) {
				return $row->kondisiKeluarga->kk->citizens->where('id_hubungan', 1)->first()->nama_lengkap;
			})
			->addColumn('nilai_smart', function ($row) {
				return round($row->nilai_smart, 3);
			})
			->addColumn('id_smart_rank', function ($row) {
				return $row->id_smart_rank;
			});
	}

	/**
	 * Get the query source of dataTable.
	 */
	public function query(SMARTRankModel $model): QueryBuilder
	{
		return $model->newQuery()
			->with(['kondisiKeluarga.kk.citizens'])
			->select('smart_rank.*');
	}

	/**
	 * Optional method if you want to use the html builder.
	 */
	public function html(): HtmlBuilder
	{
		return $this->builder()
			->setTableId('smart-table')
			->columns($this->getColumns())
			->minifiedAjax()
			//->dom('Bfrtip')
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
			Column::make('id_smart_rank')->title('Ranking'),
			Column::make('kondisiKeluarga.kk.no_kk')->title('No. KK'),
			Column::make('kondisiKeluarga.kk.citizens')->title('Kepala Keluarga'),
			Column::make('nilai_smart'),
		];
	}

	/**
	 * Get the filename for export.
	 */
	protected function filename(): string
	{
		return 'SMARTRanking_' . date('YmdHis');
	}
}
