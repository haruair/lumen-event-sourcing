<?php
namespace KoalaBank;

use Broadway\CommandHandling\SimpleCommandBus;
use KoalaBank\Account\BankAccountCommandHandler;

class BankCommandBus extends SimpleCommandBus
{
    public function __construct(BankAccountCommandHandler $bankAccountCommandHandler)
    {
        $this->subscribe($bankAccountCommandHandler);
    }
}
