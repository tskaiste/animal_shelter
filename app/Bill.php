<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['date', 'sum', 'type', 'sender', 'shelter_id'];
}
