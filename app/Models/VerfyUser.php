<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerfyUser extends Model
{
    protected $fillable=[
        'user_id',
        'code'
    ];
}
