<?php
namespace KoalaBank\Account\Events;

use Broadway\Serializer\Serializable;

abstract class BankAccountEvent implements Serializable
{
    public $bankAccountId;

    public function __construct($bankAccountId)
    {
        $this->bankAccountId = $bankAccountId;
    }

    /**
     * {@inheritDoc}
     */
    abstract public static function deserialize(array $data);

    /**
     * {@inheritDoc}
     */
    abstract public function serialize();
}
