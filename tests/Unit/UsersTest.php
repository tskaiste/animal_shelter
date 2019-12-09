<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UsersTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testRegisterAdminSuccess()
    {
        // User doesnt exist with given email
        $response = $this->json('POST', '/register', 
        [
            'name' => 'Tom4',
            'email' => 'test4@test.com',
            'password' => 'test4',
            'c_password' => 'test4',
            'role' => 'admin'
        ]);

        $response->assertStatus(200);
    }

    public function testRegisterEmployeeSuccess()
    {
        $response = $this->json('POST', '/register', 
        [
            'name' => 'EmployeeTest',
            'email' => 'employeetest@test.com',
            'password' => 'employeetest',
            'c_password' => 'employeetest',
            'role' => 'employee'
        ]);

        $response->assertStatus(200);
    }

    public function testRegisterError()
    {
        // User already exists with given email
        $response = $this->json('POST', '/register', 
        [
            'name' => 'Sally',
            'email' => 'test@test.com',
            'password' => 'test',
            'c_password' => 'test',
            'role' => 'admin'
        ]);

        $response->assertStatus(401);
    }

    public function testLoginAdminSuccess()
    {
        $response = $this->json('POST', '/login', 
        [
            'email' => 'test@test.com',
            'password' => 'test'
        ]);

        $response->assertStatus(200);
    }

    public function testLoginEmployeeSuccess()
    {
        $response = $this->json('POST', '/login', 
        [
            'email' => 'emp@test.com',
            'password' => 'emp'
        ]);

        $response->assertStatus(200);
    }

    public function testLoginError()
    {
        $response = $this->json('POST', '/login', 
        [
            'email' => 'testtest@test.com', 
            'password' => 'test'
        ]);

        $response->assertStatus(401);
    }

    public function testLogout()
    {
        $response = $this->json('POST', '/logout', []);
        
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'User logged out.',
            ]);
    }
}
