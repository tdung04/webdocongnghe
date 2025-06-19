<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $price_range = $request->input('price_range');
        $category = $request->input('category');
    
        $query = Product::query();
    
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }
    
        if ($price_range) {
            switch ($price_range) {
                case '5-20':
                    $query->whereBetween('price', [5000000, 20000000]);
                    break;
                case '20-35':
                    $query->whereBetween('price', [20000001, 35000000]);
                    break;
                case '35-50':
                    $query->whereBetween('price', [35000001, 50000000]);
                    break;
                case '50+':
                    $query->where('price', '>', 50000000);
                    break;
            }
        }
    
        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }
    
        $products = $query->paginate(6);
    
        return view('products.index', compact('products', 'search', 'price_range', 'category'));
    }
    

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
