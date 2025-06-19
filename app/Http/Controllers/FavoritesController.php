<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function add(Product $product)
    {
        $user = Auth::user();
        
        // Add product to user's favorites
        //$user->favorites()->attach($product->id);

        return redirect()->back()->with('success', 'Product added to favorites!');
    }
}
