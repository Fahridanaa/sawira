<?php

namespace App\View\Components\charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PendudukLineChart extends Component
{
	public string $cardTitle;
	public string $chartId;
	public array $labels;
	public array $entryCitizenData;
	public array $exitCitizenData;

	/**
	 * Create a new component instance.
	 */
	public function __construct($cardTitle, $chartId, $labels, $entryCitizenData, $exitCitizenData)
	{
		$this->cardTitle = $cardTitle;
		$this->chartId = $chartId;
		$this->labels = $labels;
		$this->entryCitizenData = $entryCitizenData;
		$this->exitCitizenData = $exitCitizenData;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.charts.penduduk-line-chart');
	}
}
