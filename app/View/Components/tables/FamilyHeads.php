<?php

namespace App\View\Components\tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

<<<<<<<< HEAD:app/View/Components/tables/FamilyHeads.php
class FamilyHeads extends Component
========
class Citizens extends Component
>>>>>>>> main:app/View/Components/tables/Citizens.php
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
<<<<<<<< HEAD:app/View/Components/tables/FamilyHeads.php
        return view('components.tables.family-heads');
========
        return view('components.tables.citizens');
>>>>>>>> main:app/View/Components/tables/Citizens.php
    }
}
