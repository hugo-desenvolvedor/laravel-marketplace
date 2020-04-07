<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Http\Request;
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
        session()->forget('pagseguro_session_code');

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $total = 0;
        $cartItems = array_map(
            function ($item) {
                return $item['amount'] * $item['price'];
            },
            session()->get('cart')
        );

        $total = array_sum($cartItems);

        $this->makePagSeguroSession();

        return view('checkout', compact('total'));
    }

    public function process(Request $request)
    {
        $data = $request->all();
        $reference = 'blah';

        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference($reference);
        $creditCard->setCurrency("BRL");

        $cartitems = session()->get('cart');
        foreach ($cartitems as $cartItem) {
            $creditCard->addItems()->withParameters(
                $reference,
                $cartItem['name'],
                $cartItem['amount'],
                $cartItem['price']
            );
        }

        $user = auth()->user();
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $userCPF = 14260559001;
        $creditCard->setSender()->setDocument()->withParameters('CPF', $userCPF);

        $creditCard->setSender()->setHash($data['hash']);
        $creditCard->setSender()->setIp('127.0.0.0');

        $creditCard->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setBilling()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $creditCard->setToken($data['card_token']);
        [$quantity, $installmentAmount] = explode('|', $data['installment']);
        $creditCard->setInstallment()->withParameters($quantity, number_format($installmentAmount, 2, '.', ''));

        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($data['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters('CPF', $userCPF);

        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        dd($result);
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
