<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 6);


        $annonces = Annonce::orderBy('created_at', 'desc')->paginate($limit);
        $categories = Category::all();
        return view('welcome', compact('annonces', 'categories'));
    }
}
