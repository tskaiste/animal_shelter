<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    protected $fillable = ['type', 'name', 'color', 'breed', 'size', 'age', 'gender', 'is_sterilised', 'cage_id'];
}
