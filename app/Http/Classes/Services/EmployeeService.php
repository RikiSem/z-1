<?php


namespace App\Http\Classes\Services;

use App\Http\Classes\Repositories\EmployeeRepository;
use Illuminate\Http\Request;


class EmployeeService
{
    private const EMAIL_OR_PASS_IS_EMPTY = 'Email or password is empty';

    public function handle(Request $request)
    {
        $email = $this->getEmailFromRequest($request);
        $password = $this->getPasswordFromRequest($request);

        if (!empty($email) && !empty($password)) {
            try {
                $result = EmployeeRepository::createNewEmployee($email, $password)->id;
            } catch (\Exception $e) {
                $result = $e->getMessage();
            }
        } else {
            $result = self::EMAIL_OR_PASS_IS_EMPTY;
        }

        return $result;
    }

    public function getEmailFromRequest(Request $request): string
    {
        return $request->get('email');
    }

    public function getPasswordFromRequest(Request $request): string
    {
        return $request->get('password');
    }
}
