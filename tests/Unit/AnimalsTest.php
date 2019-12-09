<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AnimalsTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;
    
    public function testGetAll()
    {
        $response = $this->json('GET', '/animals');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/animals/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/animals', 
        [
            'type' => 'cat', 
            'name' => 'Lulu', 
            'color' => 'white', 
            'breed' => 'mixed', 
            'size' => 'small',
            'age' => 3,
            'gender' => 'female',
            'is_sterilised' => 1,
            'cage_id' => 1
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/animals/2', 
        [
            'type' => 'cat', 
            'name' => 'Lulu', 
            'color' => 'white', 
            'breed' => 'mixed', 
            'size' => 'small',
            'age' => 4,
            'gender' => 'female',
            'is_sterilised' => 1,
            'cage_id' => 1
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/animals/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
