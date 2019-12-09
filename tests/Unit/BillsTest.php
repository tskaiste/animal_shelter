<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BillsTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/bills');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/bills/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/bills', 
        [
            'date' => '2019-09-15', 
            'sum' => '30', 
            'type' => 'medicine', 
            'sender' => 'PetPharm', 
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/bills/2', 
        [
            'date' => '2019-09-15', 
            'sum' => '300', 
            'type' => 'medicine', 
            'sender' => 'PetPharm', 
            'shelter_id' => '123456789'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/bills/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
