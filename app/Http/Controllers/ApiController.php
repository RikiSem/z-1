<?php

namespace App\Http\Controllers;

use App\Http\Classes\Services\EmployeeService;
use App\Http\Classes\Services\TransactionService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function createEmployee(Request $request, EmployeeService $employeeService)
    {
        return $employeeService->handle($request);
    }

    public function addTransaction(Request $request, TransactionService $transactionService)
    {
        return $transactionService->handle($request, 'add');
    }

    public function getTransactions(TransactionService $transactionService)
    {
        return $transactionService->handle(null, 'get');
    }

    public function payMoney(TransactionService $transactionService){
        $transactionService->handle(null, 'pay');
    }
}
