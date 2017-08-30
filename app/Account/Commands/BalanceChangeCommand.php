<?php
namespace KoalaBank\Account\Commands;

abstract class BalanceChangeCommand extends BankAccountCommand
{
    public $amount;

    public function __construct($bankAccountId, $amount)
    {
        $this->bankAccountId = $bankAccountId;
        $this->amount = $amount;
    }
}
