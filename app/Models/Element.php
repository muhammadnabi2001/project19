<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable=[
        'product_id',
        'title',
        'price'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
