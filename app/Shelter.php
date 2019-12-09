<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelter extends Model
{
    protected $fillable = ['address', 'area', 'phone', 'email', 'bank_account_number'];
}
