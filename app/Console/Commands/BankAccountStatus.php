<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use KoalaBank\Account\BankAccountRepository;

class BankAccountStatus extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account:status {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Status of the account';

    /**
     * The repository.
     *
     * @var BankAccountRepository
     */
    protected $repository;

    /**
     * Create a new command instance.
     *
     * @param  BankAccountRepository  $repository
     * @return void
     */
    public function __construct(BankAccountRepository $repository) {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('id');
        $bankAccount = $this->repository->load($id);

        echo $bankAccount->isClosed() ? 'Closed account' : 'Account';
        echo PHP_EOL;

        echo "Name: " . $bankAccount->getName() . PHP_EOL;
        echo "Balance: $ " . number_format($bankAccount->getBalance());
    }
}
