<?php
namespace KoalaBank\Account;

use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;

class BankAccountRepository extends EventSourcingRepository
{
    public function __construct(EventStore $eventStore, EventBus $eventBus)
    {
        parent::__construct($eventStore, $eventBus, BankAccount::class, new PublicConstructorAggregateFactory);
    }
}
