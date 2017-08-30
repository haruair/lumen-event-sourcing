<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use KoalaBank\BankCommandBus;
use KoalaBank\Account\Commands\DepositCommand;

class DepositBalance extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account:deposit {id} {amount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deposit from the account';

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
        $amount = $this->argument('amount');

        echo $id . ' is Depositing.' . PHP_EOL;

        $command = new DepositCommand($id, $amount);
        $this->commandBus->dispatch($command);
    }
}
