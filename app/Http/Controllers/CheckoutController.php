<?php

namespace App\Http\Controllers;

use App\Payment\PagSeguro\CreditCard;
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

        if (!session()->has('cart')) {
            return redirect()->route('home');
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
        try {
            $data = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $reference = 'XPTO';
            $creditCardPayment = new CreditCard($cartItems, $user, $data, $reference);
            $result = $creditCardPayment->doPayment();
            $userOrder = [
                'reference' => $reference,
                'store_id' => 40,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems)
            ];
            $user->orders()->create($userOrder);
            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json(
                [
                    'data' => [
                        'status' => true,
                        'message' => __('Order created with success'),
                        'order' => $reference
                    ]
                ]
            );
        } catch (Exception $e) {
            $message = env('APP_DEBUG') ? $e->getMessage() : __('Error on process order');
            return response()->json(
                [
                    'data' => [
                        'status' => true,
                        'message' => $message
                    ]
                ],
                401
            );
        }
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

    public function thanks()
    {
        return view('thanks');
    }
}
