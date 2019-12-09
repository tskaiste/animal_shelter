<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['date', 'sum', 'purpose', 'sender', 'shelter_id'];
}
