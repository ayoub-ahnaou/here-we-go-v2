<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $annoncesCount = Annonce::count();
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $annoncesByCategory = Category::withCount('annonces')->get();

        return view('admin.stats', compact('annoncesCount', 'usersCount', 'categoriesCount', 'annoncesByCategory'));
    }
}
