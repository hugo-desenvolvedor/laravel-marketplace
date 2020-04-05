<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\View\View;
use PagSeguro\Configuration\Configure;
use PagSeguro\Services\Session;

class CheckoutController extends Controller
{
    /**
     * @return Factory|RedirectResponseAlias|View
     * @throws Exception
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
//        session()->forget('pagseguro_session_code');
        $this->makePagSeguroSession();

        return view('checkout');
    }

    /**
     * Create PagSeguro session integration
     *
     * @return mixed
     * @throws Exception
     */
    private function makePagSeguroSession()
    {
        if (!session()->has('pagseguro_session_code')) {
            $sessionCode = Session::create(
                Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
