<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $guarded = [];

    public const MONEY_PER_HOUR = 300;

    public static function addNewTransaction(int $employeeId, int $hours): self
    {
        return self::create([
            'employeeId' => $employeeId,
            'hours' => $hours
        ]);
    }

    public static function getAllActive(): Collection
    {
        return self::select('employeeId', 'hours')
            ->where('is_complete', '=', false)
            ->get();
    }

    public static function completeAll()
    {
        self::where('is_complete', '=', false)
            ->update([
                'is_complete' => true
            ]);
    }
}
