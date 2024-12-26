<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AtrebuteCharacter;
use App\Models\Character;
use App\Models\Element;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        // return response()->json('success');
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'title' => 'required',
            'price' => 'required',
            'atrebute_id' => 'required',
            'character_id' => 'required',
        ]);

        $data = Product::create(    [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        $item = Element::create([
            'product_id' => $data->id,
            'title' => $request->title,
            'price' => $request->price,
        ]);
        $character=AtrebuteCharacter::create([
            'atrebute_id'=>$request->atrebute_id,
            'character_id'=>$request->character_id,
        ]);
        $option = Option::create([
            'element_id' => $item->id,
            'atrebut_character_id' => $character->id,
        ]);

        return response()->json([
            'Product' => $data,
            'Element' => $item,
            'Option' => $option
        ]);
    }
    public function show()
    {
        
        return response()->json('success12');
    }
}
