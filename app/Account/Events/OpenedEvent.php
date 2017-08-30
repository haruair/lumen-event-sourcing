<?php
namespace KoalaBank\Account\Events;

class OpenedEvent extends StatusUpdatedEvent
{
    public $name;

    public function __construct($bankAccountId, $name)
    {
        parent::__construct($bankAccountId);
        $this->name = $name;
    }
    
    /**
     * {@inheritDoc}
     */
    public static function deserialize(array $data)
    {
        return new static($data['bankAccountId'], $data['name']);
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return [
            'bankAccountId' => $this->bankAccountId,
            'name' => $this->name,
        ];
    }
}
