<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ResourcesTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/resources');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/resources/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/resources', 
        [
            'type' => 'food',
            'name' => 'DoggyFood',
            'amount' => '10',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/resources/2', 
        [
            'type' => 'food',
            'name' => 'DoggyFood',
            'amount' => '15',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/resources/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
