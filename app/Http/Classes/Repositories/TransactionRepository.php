<?php


namespace App\Http\Classes\Repositories;


use App\Models\Transactions;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository
{
    public static function createNewTransaction(int $employeeId, int $hours): Transactions
    {
        return Transactions::addNewTransaction($employeeId, $hours);
    }

    public static function getActiveTransactions(): Collection
    {
        return Transactions::getAllActive();
    }

    public static function completeAllTransactions()
    {
        Transactions::completeAll();
    }
}
