<?php
namespace App\Payment\PagSeguro;


use App\User;

class CreditCard
{
    private array $items;
    private User $user;
    private array $cardInfo;
    private string $reference;

    /**
     * CreditCard constructor.
     *
     * @param array $items
     * @param User $user
     * @param array $cardInfo
     * @param string $reference
     */
    public function __construct(array $items, User $user, array $cardInfo, string $reference)
    {
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function doPayment()
    {
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference($this->reference);
        $creditCard->setCurrency("BRL");

        foreach ($this->items as $cartItem) {
            $creditCard->addItems()->withParameters(
                $this->reference,
                $cartItem['name'],
                $cartItem['amount'],
                $cartItem['price']
            );
        }

        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'test@sandbox.pagseguro.com.br' : $user->email;

        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $userCPF = 14260559001;
        $creditCard->setSender()->setDocument()->withParameters('CPF', $userCPF);

        $creditCard->setSender()->setHash($this->cardInfo['hash']);
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

        $creditCard->setToken($this->cardInfo['card_token']);
        [$quantity, $installmentAmount] = explode('|', $this->cardInfo['installment']);
        $creditCard->setInstallment()->withParameters($quantity, number_format($installmentAmount, 2, '.', ''));

        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->cardInfo['card_name']); // Equals in Credit Card

        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters('CPF', $userCPF);

        $creditCard->setMode('DEFAULT');

        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    }
}
