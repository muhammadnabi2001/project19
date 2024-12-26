<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atrebute extends Model
{
    protected $fillable = [
        'name',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function atrebuteCharacters()
    {
        return $this->hasMany(AtrebuteCharacter::class,);
    }
}
