<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{ public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->take(12)->get();
        return view('welcome', compact('products'));
    }
}
