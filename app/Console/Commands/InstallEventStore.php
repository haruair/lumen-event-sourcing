<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use Broadway\EventStore\EventStore;
use Doctrine\DBAL\Connection;

class InstallEventStore extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:store:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install event store table.';

    /**
     * Event store.
     *
     * @var EventStore
     */
    protected $eventStore;

    /**
     * Doctrine Connection.
     *
     * @var Connection
     */
    protected $connection;
    
    /**
     * Create a new command instance.
     *
     * @param  EventStore  $eventStore
     * @return void
     */
    public function __construct(Connection $connection, EventStore $eventStore) {
        parent::__construct();

        $this->eventStore = $eventStore;
        $this->connection = $connection;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $schemaManager = $this->connection->getSchemaManager();
        $schema = $schemaManager->createSchema();

        $table = $this->eventStore->configureSchema($schema);
        $schemaManager->createTable($table);
    }
}
