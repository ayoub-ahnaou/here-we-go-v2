<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Favoris;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\instance;

class FavorisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $favoris = Auth::user()->favoris;
        return view('favoris.index', compact('favoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Annonce $annonce)
    {
        $user = Auth::user();

        if ($user->hasFavorited($annonce)) {
            $user->unfavorite($annonce);
        } else {
            $user->favorite($annonce);
        }

        return back();
    }
}
