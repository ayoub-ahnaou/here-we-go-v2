<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $annoncesCount = Annonce::count();
        $usersCount = User::count();
        $categoriesCount = Category::count();
        $annoncesByCategory = Category::withCount('annonces')->get();

        // New: Fetch reservation and revenue data
        $reservationsData = Reservation::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_reservations')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $revenueData = Reservation::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(price_total) as total_revenue')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $reservationsData->pluck('date');
        $reservationsCount = $reservationsData->pluck('total_reservations');
        $revenue = $revenueData->pluck('total_revenue');

        return view('admin.stats', compact(
            'annoncesCount',
            'usersCount',
            'categoriesCount',
            'annoncesByCategory',
            'dates',
            'reservationsCount',
            'revenue'
        ));
    }
}
