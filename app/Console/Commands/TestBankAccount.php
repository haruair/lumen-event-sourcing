<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use Broadway\EventStore\EventStore;
use KoalaBank\Account\BankAccountRepository;
use KoalaBank\Account\Projectors\TransactionProjector;
use Broadway\EventStore\CallableEventVisitor;

class TestBankAccount extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test bank account';

    /**
     * The Event Store.
     *
     * @var EventStore
     */
    protected $eventStore;

    /**
     * The projector.
     *
     * @var TransactionProjector
     */
    protected $projector;

    /**
     * Create a new command instance.
     *
     * @param  EventStore $eventStore
     * @return void
     */
    public function __construct(EventStore $eventStore, TransactionProjector $projector) {
        parent::__construct();
        $this->eventStore = $eventStore;
        $this->projector = $projector;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projector = $this->projector;
        $criteria = $projector->createReplayCriteria();

        $this->eventStore->visitEvents($criteria, new CallableEventVisitor(function ($domainMessage) use ($projector) {
            $projector->handle($domainMessage);
        }));
    }
}
