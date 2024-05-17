<?php

namespace App\View\Components\charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsiaPendudukPieChart extends Component
{
	public string $cardTitle;
	public string $chartId;
	public array $ageGroupData;

	/**
	 * Create a new component instance.
	 */
	public function __construct($cardTitle, $chartId, $ageGroupData)
	{
		$this->cardTitle = $cardTitle;
		$this->chartId = $chartId;
		$this->ageGroupData = $ageGroupData;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.charts.usia-penduduk-pie-chart');
	}
}
