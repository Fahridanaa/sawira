<?php

namespace App\View\Components\pagination;

use App\DataTables\AlternativeSPKDataTable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SPKAlternative extends Component
{
	public $dataTable;

	/**
	 * Create a new component instance.
	 */
	public function __construct(AlternativeSPKDataTable $dataTable)
	{
		$this->dataTable = $dataTable;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.pagination.spk-alternative', ['dataTable' => $this->dataTable->render('components.pagination.spk-alternative')]);
	}
}
