<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ClientsTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/clients');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/clients/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/clients', 
        [
            'first_name' => 'Jack', 
            'last_name' => 'Graham', 
            'age' => '25', 
            'phone' => '8521223', 
            'email' => 'client1@test.com',
            'activity_level' => 'high',
            'home_type' => 'flat',
            'has_yard' => 'no',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/clients/2', 
        [
            'first_name' => 'Jack', 
            'last_name' => 'Graham', 
            'age' => '27', 
            'phone' => '8521223', 
            'email' => 'client1@test.com',
            'activity_level' => 'high',
            'home_type' => 'flat',
            'has_yard' => 'no',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/clients/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
