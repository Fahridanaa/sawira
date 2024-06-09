<?php

namespace App\View\Components\charts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class totalCitizensBarChart extends Component
{
	public string $cardTitle;

	public Collection $genderManStatistics;
	public Collection $genderWomanStatistics;

	/**
	 * Create a new component instance.
	 */
	public function __construct(string $cardTitle, Collection $genderManStatistics, Collection $genderWomanStatistics)
	{
		$this->cardTitle = $cardTitle;
		$this->genderManStatistics = $genderManStatistics;
		$this->genderWomanStatistics = $genderWomanStatistics;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.charts.total-citizens-bar-chart');
	}
}
