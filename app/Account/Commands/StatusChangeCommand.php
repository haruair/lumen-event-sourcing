<?php
namespace KoalaBank\Account\Commands;

abstract class StatusChangeCommand extends BankAccountCommand
{
    public function __construct($bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }
}
