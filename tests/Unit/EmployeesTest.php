<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class EmployeesTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    public function testGetAll()
    {
        $response = $this->json('GET', '/employees');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/employees/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/employees', 
        [
            'first_name' => 'Anna', 
            'last_name' => 'Mullins', 
            'age' => '32', 
            'phone' => '8521223', 
            'email' => 'empl2@test.com',
            'bank_account_number' => '11111',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/employees/2', 
        [
            'first_name' => 'Anna', 
            'last_name' => 'Mullins', 
            'age' => '32', 
            'phone' => '8521223', 
            'email' => 'empl2@test.com',
            'bank_account_number' => '111121',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/employees/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
