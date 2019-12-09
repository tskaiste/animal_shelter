<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['id', 'first_name', 'last_name', 'bank_account_number', 'age', 'phone', 'email', 'shelter_id'];
}
