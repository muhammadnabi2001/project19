<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtrebuteCharacter extends Model
{
    protected $fillable=[
        'atrebute_id',
        'character_id'
    ];
    public function atrebutes()
    {
        return $this->belongsTo(Atrebute::class,'atrebute_id');
    }
    public function characters()
    {
        return $this->belongsTo(Character::class,'character_id');
    }
}
