<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShelterTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/shelters');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/shelters/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/shelters', 
        [
            'address' => 'Test address', 
            'area' => '200', 
            'phone' => '123456789', 
            'email' => 'testsheler@test.com', 
            'bank_account_number' => '123456789'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/shelters/2', 
        [
            'address' => 'Test address', 
            'area' => '300', 
            'phone' => '123456789', 
            'email' => 'testsheler@test.com', 
            'bank_account_number' => '123456789'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/shelters/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
