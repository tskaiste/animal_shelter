<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['first_name', 'last_name', 'age', 'phone', 'email', 'activity_level', 'home_type', 'has_yard', 'shelter_id'];
}
