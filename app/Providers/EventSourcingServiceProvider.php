<?php

namespace KoalaBank\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

use Broadway;
use Doctrine;
use KoalaBank;

class EventSourcingServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->instance(
            Doctrine\DBAL\Connection::class,
            DB::getDoctrineConnection()
        );

        $app->singleton(
            Broadway\EventHandling\EventBus::class,
            function ($app) {
                // Is this okay to do?
                $projector = $app->make(KoalaBank\Account\Projectors\TransactionProjector::class);

                $bus = new Broadway\EventHandling\SimpleEventBus;
                $bus->subscribe($projector);
                return $bus;
            }
        );
        
        $app->singleton(
            Broadway\EventStore\EventStore::class,
            function ($app) {
                $conn = $app->make(Doctrine\DBAL\Connection::class);
                $payload = $app->make(Broadway\Serializer\SimpleInterfaceSerializer::class);
                $metadata = $app->make(Broadway\Serializer\SimpleInterfaceSerializer::class);
                $converter = $app->make(Broadway\UuidGenerator\Converter\BinaryUuidConverter::class);
        
                return new Broadway\EventStore\Dbal\DBALEventStore($conn, $payload, $metadata, 'events', false, $converter);
            }
        );
        
        $app->singleton(
            KoalaBank\Account\BankAccountCommandHandler::class,
            function ($app) {
                $repository = $app->make(KoalaBank\Account\BankAccountRepository::class);
                return new KoalaBank\Account\BankAccountCommandHandler($repository);
            }
        );
        
    }
}
