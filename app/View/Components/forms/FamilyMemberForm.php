<?php

namespace App\View\Components\forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FamilyMemberForm extends Component
{
	public string $status;
	public string $id;
	public string $iteration;

	/**
	 * Create a new component instance.
	 */
	public function __construct($status, $id, $iteration)
	{
		$this->status = $status;
		$this->id = $id;
		$this->iteration = $iteration;
	}

	/**
	 * Get the view / contents that represent the component.
	 */
	public function render(): View|Closure|string
	{
		return view('components.forms.family-member-form');
	}
}
