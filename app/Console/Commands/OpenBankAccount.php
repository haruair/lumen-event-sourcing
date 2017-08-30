<?php
namespace KoalaBank\Console\Commands;

use Illuminate\Console\Command as ConsoleCommand;
use Broadway\UuidGenerator\Rfc4122\Version4Generator;
use KoalaBank\BankCommandBus;
use KoalaBank\Account\Commands\OpenCommand;

class OpenBankAccount extends ConsoleCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bank:account:open {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open new bank account';

    /**
     * The command bus.
     *
     * @var BankCommandBus
     */
    protected $commandBus;

    /**
     * The uuid generator.
     *
     * @var Version4Generator
     */
    protected $generator;
    
    /**
     * Create a new command instance.
     *
     * @param  BankCommandBus  $commandBus
     * @return void
     */
    public function __construct(
        BankCommandBus $commandBus,
        Version4Generator $generator
    ) {
        parent::__construct();

        $this->commandBus = $commandBus;
        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $id = $this->generator->generate();
        echo $id . ' generated ' . $name;

        $command = new OpenCommand($id, $name);

        $this->commandBus->dispatch($command);
    }
}
