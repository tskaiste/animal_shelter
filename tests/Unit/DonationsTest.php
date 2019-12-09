<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DonationsTest extends TestCase
{
    use DatabaseTransactions;
    use WithoutMiddleware;

    public function testGetAll()
    {
        $response = $this->json('GET', '/donations');

        $response->assertStatus(200);
    }
    public function testGet()
    {
        $response = $this->json('GET', '/donations/1');

        $response->assertStatus(200);
    }
    public function testInsert()
    {
        $response = $this->json('POST', '/donations', 
        [
            'date' => '2019-09-10',
            'sum' => '10',
            'purpose' => 'For Rox',
            'sender' => 'Tom',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(201);
    }
    public function testUpdate()
    {
        $response = $this->json('PUT', '/donations/2', 
        [
            'date' => '2019-09-10',
            'sum' => '12',
            'purpose' => 'For Rox',
            'sender' => 'Tom',
            'shelter_id' => '1'
        ]);

        $response->assertStatus(200);
    }
    public function testDelete()
    {
        $response = $this->json('DELETE', '/donations/2', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Deleted successfully.',
            ]);
    }
}
