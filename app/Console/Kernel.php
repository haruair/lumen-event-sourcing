<?php

namespace KoalaBank\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\OpenBankAccount::class,
        Commands\InstallEventStore::class,
        Commands\CloseBankAccount::class,
        Commands\WithdrawBalance::class,
        Commands\DepositBalance::class,
        Commands\BankAccountStatus::class,
        Commands\TestBankAccount::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
