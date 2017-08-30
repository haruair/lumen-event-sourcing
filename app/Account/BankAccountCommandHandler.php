<?php
namespace KoalaBank\Account;

use Broadway\CommandHandling\SimpleCommandHandler;
use Broadway\EventSourcing\EventSourcingRepository;

use KoalaBank\Account\Commands\OpenCommand;
use KoalaBank\Account\Commands\CloseCommand;
use KoalaBank\Account\Commands\DepositCommand;
use KoalaBank\Account\Commands\WithdrawCommand;

class BankAccountCommandHandler extends SimpleCommandHandler
{
    /**
     * @var EventSourcingRepository
     */
    private $repository;

    public function __construct(EventSourcingRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function handleOpenCommand(OpenCommand $command)
    {
        $bankAccount = BankAccount::open($command->bankAccountId, $command->name);
        $this->repository->save($bankAccount);
    }

    protected function handleCloseCommand(CloseCommand $command)
    {
        $bankAccount = $this->repository->load($command->bankAccountId);
        $bankAccount->close();
        $this->repository->save($bankAccount);
    }

    protected function handleDepositCommand(DepositCommand $command)
    {
        $bankAccount = $this->repository->load($command->bankAccountId);
        $bankAccount->deposit($command->amount);
        $this->repository->save($bankAccount);
    }

    protected function handleWithdrawCommand(WithdrawCommand $command)
    {
        $bankAccount = $this->repository->load($command->bankAccountId);
        $bankAccount->withdraw($command->amount);
        $this->repository->save($bankAccount);
    }
}
