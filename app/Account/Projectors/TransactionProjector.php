<?php
namespace KoalaBank\Account\Projectors;

use Broadway\ReadModel\Projector;
use Broadway\EventStore\Management\Criteria;
use Koalabank\Account\Events\WithdrawedEvent;
use Koalabank\Account\Events\DepositedEvent;

class TransactionProjector extends Projector
{
    public function createReplayCriteria()
    {
        return Criteria::create()->withEventTypes([
            'Koalabank.Account.Events.WithdrawedEvent',
            'Koalabank.Account.Events.DepositedEvent',
        ]);
    }

    protected function applyWithdrawedEvent(WithdrawedEvent $event)
    {
        var_dump($event);
    }

    protected function applyDepositedEvent(DepositedEvent $event)
    {
        var_dump($event);
    }
}
