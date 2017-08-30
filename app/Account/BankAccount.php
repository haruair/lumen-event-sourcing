<?php

namespace KoalaBank\Account;

use Broadway\EventSourcing\EventSourcedAggregateRoot;

use KoalaBank\Account\Events\DepositedEvent;
use KoalaBank\Account\Events\WithdrawedEvent;
use KoalaBank\Account\Events\OpenedEvent;
use KoalaBank\Account\Events\ClosedEvent;

use RuntimeException;

class BankAccount extends EventSourcedAggregateRoot
{
    private $bankAccountId;
    private $name;
    private $opened = false;
    private $closed = false;
    private $balance = 0.0;

    public static function open($bankAccountId, $name)
    {
        $bankAccount = new BankAccount;
        $bankAccount->apply(new OpenedEvent($bankAccountId, $name));
        return $bankAccount;
    }

    public function getAggregateRootId()
    {
        return $this->bankAccountId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isOpened()
    {
        return $this->opened;
    }

    public function isClosed()
    {
        return $this->closed;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function deposit($amount)
    {
        if (! $this->opened) {
            throw new RuntimeException('Bank Account is not opened.');
        }

        if ($this->closed) {
            throw new RuntimeException('Bank Account is closed.');
        }

        $this->apply(new DepositedEvent($this->getAggregateRootId(), $amount));
    }

    public function withdraw($amount)
    {
        if (! $this->opened) {
            throw new RuntimeException('Bank Account is not opened.');
        }

        if ($this->closed) {
            throw new RuntimeException('Bank Account is closed.');
        }

        $this->apply(new WithdrawedEvent($this->getAggregateRootId(), $amount));
    }

    public function close()
    {
        if (! $this->opened) {
            throw new RuntimeException('Bank Account is not opened.');
        }

        if ($this->closed) {
            return;
        }

        $this->apply(new ClosedEvent($this->getAggregateRootId()));
    }

    protected function applyDepositedEvent(DepositedEvent $event)
    {
        $this->balance += $event->amount;
    }

    protected function applyWithdrawedEvent(WithdrawedEvent $event)
    {
        $this->balance -= $event->amount;
    }

    protected function applyOpenedEvent(OpenedEvent $event)
    {
        $this->bankAccountId = $event->bankAccountId;
        $this->name = $event->name;
        $this->opened = true;
    }

    protected function applyClosedEvent(ClosedEvent $event)
    {
        $this->closed = true;
    }
}
