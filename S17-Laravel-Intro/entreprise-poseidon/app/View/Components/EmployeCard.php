<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $prenom,
        public string $nom,
        public string $service,
        public float $salaire
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employe-card');
    }
}
