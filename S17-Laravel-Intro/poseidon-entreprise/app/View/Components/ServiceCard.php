<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{
    public function __construct(
        public int $id,
        public string $nom,
        public string $responsable,
        public string $telephone,
        public string $badge = 'secondary',
    ) {
        
    }

    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}