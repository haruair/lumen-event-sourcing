<?php
namespace KoalaBank\Account\Events;

abstract class StatusUpdatedEvent extends BankAccountEvent
{
    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data)
    {
        return new static($data['bankAccountId']);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return [
            'bankAccountId' => $this->bankAccountId,
        ];
    }
}
