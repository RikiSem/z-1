<?php


namespace App\Http\Classes\Repositories;


use App\Models\Employee;

class EmployeeRepository
{
    public static function createNewEmployee(string $email, string $password): Employee
    {
        return Employee::addNewEmployee($email, $password);
    }
}
