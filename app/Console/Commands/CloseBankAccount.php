<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use KoalaBank\BankCommandBus;
use KoalaBank\Account\Commands\CloseCommand;

class CloseBankAccount extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account:close {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close the bank account';

    /**
     * The command bus.
     *
     * @var BankCommandBus
     */
    protected $commandBus;

    /**
     * Create a new command instance.
     *
     * @param  BankCommandBus  $commandBus
     * @return void
     */
    public function __construct(BankCommandBus $commandBus) {
        parent::__construct();

        $this->commandBus = $commandBus;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');
        echo $id . ' is closing.' . PHP_EOL;

        $command = new CloseCommand($id);
        $this->commandBus->dispatch($command);
    }
}
