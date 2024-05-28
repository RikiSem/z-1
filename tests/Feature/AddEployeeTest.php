<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddEployeeTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     */
    public function test_can_add_new_employee(): void
    {
        $response = $this->post('/api/employee/add', [
            'email' => 'test@mail.com',
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }
}
