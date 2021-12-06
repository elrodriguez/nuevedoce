<?php

namespace Modules\Lend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ChargesController extends Controller
{

    public function filter()
    {
        return view('lend::charges.filter');
    }

    public function pay()
    {
        return view('lend::charges.pay');
    }

}
