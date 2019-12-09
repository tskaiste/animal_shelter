<?php

use App\User;
use App\Shelter;
use App\Employee;
use App\Animal;
use App\Bill;
use App\Cage;
use App\Client;
use App\Donation;
use App\Resource;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 2
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role' => 1
        ]);

        Shelter::create([
            'address' => 'Address1',
            'area' => '250',
            'phone' => '+37061525269',
            'email' => 'shelter1@test.com',
            'bank_account_number' => '123456789',
        ]);

        Employee::create([
            'first_name' => 'Employee1',
            'last_name' => 'EmployeeLastName1',
            'age' => '30',
            'phone' => '+37061525267',
            'email' => 'employee1@test.com',
            'bank_account_number' => '123456789',
            'shelter_id' => '2'
        ]);

        Client::create([
            'first_name' => 'Client1',
            'last_name' => 'ClientLastName1',
            'age' => '25',
            'phone' => '+37061525267',
            'email' => 'client1@test.com',
            'activity_level' => 'low',
            'home_type' => 'flat',
            'has_yard' => 'no',
            'shelter_id' => '2'
        ]);

        Cage::create([
            'area' => '15',
            'spaces_number' => '3',
            'shelter_id' => '2',
        ]);

        Animal::create([
            'type' => 'dog',
            'name' => 'Luna',
            'color' => 'black',
            'breed' => 'mixed',
            'size' => 'small',
            'age' => '2',
            'gender' => 'female',
            'is_sterilised' => '1',
            'cage_id' => '1',
        ]);

        Bill::create([
            'date' => '2019-10-10',
            'sum' => '15',
            'type' => 'medicine',
            'sender' => 'vetInc',
            'shelter_id' => '2',
        ]);

        Donation::create([
            'date' => '2019-10-15',
            'sum' => '10',
            'purpose' => 'for Luna',
            'sender' => 'Tom',
            'shelter_id' => '2',
        ]);

        Resource::create([
            'type' => 'food',
            'name' => 'KittyFood',
            'amount' => '10kg',
            'shelter_id' => '1',
        ]);
    }
}
