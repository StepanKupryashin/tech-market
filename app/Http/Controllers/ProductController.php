<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{



    public function index(Request $request)
    {

        $products = Product::with('categories')->get();

        if($category = $request->get('category'))
        {
            $products = Product::with('categories')
            ->whereRelation('categories', 'name', '=', $category)
            ->get();
        }

        return $this->successResponse($products);
    }

}
