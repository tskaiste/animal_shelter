<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cage extends Model
{
    protected $fillable = ['area', 'spaces_number', 'shelter_id'];
}
