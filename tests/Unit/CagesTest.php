<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CagesTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/cages');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/cages/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/cages', 
        [
            'area' => '15',
            'spaces_number' => '3',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/cages/2', 
        [
            'area' => '17',
            'spaces_number' => '3',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/cages/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
