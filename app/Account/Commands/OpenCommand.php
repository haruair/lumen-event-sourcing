<?php
namespace KoalaBank\Account\Commands;

class OpenCommand extends StatusChangeCommand
{
    public $name;

    public function __construct($bankAccountId, $name)
    {
        parent::__construct($bankAccountId);
        $this->name = $name;
    }
}
