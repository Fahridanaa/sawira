<?php

namespace App\View\Components\cards;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
	public $background;
	public $iconType;
	public $iconName;
	public $title;
	public $value;

	/**
	 * Create a new component instance.
	 */
	public function __construct($background, $iconType, $iconName, $title, $value)
	{
		$this->background = $background;
		$this->iconType = $iconType;
		$this->iconName = $iconName;
		$this->title = $title;
		$this->value = $value;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.cards.stat-card');
	}
}
