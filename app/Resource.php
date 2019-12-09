<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['type', 'name', 'amount', 'shelter_id'];
}
