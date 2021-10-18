<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Modules\Setting\Entities\SetCompany;

class Footer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $company;

    public function __construct()
    {
        $this->company = SetCompany::where('main',true)->first();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }
}
