<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserOrderController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $userOrders = auth()->user()->orders()->paginate(15);

        return view('user-orders', compact('userOrders'));
    }
}
