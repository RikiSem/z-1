<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    private const BASE_URI = '/api/transaction';
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     */
    public function test_add_new_transaction(): void
    {
        $response = $this->post(self::BASE_URI . '/add', [
            'employee_id' => 1,
            'hours' => 2
        ]);

        $response->assertStatus(200);
    }

    public function test_get_transactions(): void
    {
        $this->test_add_new_transaction();
        $response = $this->get(self::BASE_URI . '/get');

        $response->assertJson([
            1 => 600
        ]);
    }
}
