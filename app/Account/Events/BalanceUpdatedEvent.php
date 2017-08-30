<?php
namespace KoalaBank\Account\Events;

abstract class BalanceUpdatedEvent extends BankAccountEvent
{
    public $amount;

    public function __construct($bankAccountId, $amount)
    {
        parent::__construct($bankAccountId);
        $this->amount = $amount;
    }

    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data)
    {
        return new static($data['bankAccountId'], $data['amount']);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return [
            'bankAccountId' => $this->bankAccountId,
            'amount' => $this->amount,
        ];
    }
}
