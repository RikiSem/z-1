<?php


namespace App\Http\Classes\Services;


use App\Http\Classes\Repositories\TransactionRepository;
use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionService
{
    private const STATUS_OK = 1;
    private const EMPLOYYE_OR_HOURS_IS_EMPTY = 'Employee or hours is empty';
    private const ADD_ACTION = 'add';
    private const GET_ACTION = 'get';
    private const PAY_ACTION = 'pay';

    public function handle(Request $request = null, string $action)
    {
        $result = self::STATUS_OK;
        switch ($action) {
            case self::ADD_ACTION:
                $result = $this->addEmployee($request);
                break;
            case self::GET_ACTION:
                $result = $this->getNotCompletedEmployees();
                break;
            case self::PAY_ACTION:
                $this->completeTransactions();
                break;
        }

        return $result;
    }

    private function addEmployee(Request $request)
    {
        $employeeId = $this->getEmployeeIdFromRequest($request);
        $hours = $this->getHoursFromRequest($request);

        $result = self::STATUS_OK;
        if (!empty($employeeId) && !empty($hours)) {
            try {
                TransactionRepository::createNewTransaction($employeeId, $hours);
            } catch (\Exception $e) {
                $result = $e->getMessage();
            }
        } else {
            $result = self::EMPLOYYE_OR_HOURS_IS_EMPTY;
        }

        return $result;
    }

    private function getNotCompletedEmployees()
    {
        $transactions = TransactionRepository::getActiveTransactions();
        $result = [];
        foreach ($transactions as $transaction) {
            if (isset($result[$transaction->employeeId])) {
                $result[$transaction->employeeId] += $transaction->hours * Transactions::MONEY_PER_HOUR;
            } else {
                $result[$transaction->employeeId] = $transaction->hours * Transactions::MONEY_PER_HOUR;
            }
        }
        return $result;
    }

    public function completeTransactions()
    {
        TransactionRepository::completeAllTransactions();
    }

    public function getEmployeeIdFromRequest(Request $request): int
    {
        return (int)$request->get('employee_id');
    }

    public function getHoursFromRequest(Request $request): int
    {
        return (int)$request->get('hours');
    }
}
