<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function index(Reservation $reservation)
    {
        Pdf::setOptions(['isRemoteEnabled' => true]);
        $pdf = Pdf::loadView('facture.pdf', ["reservation" => $reservation]);
        return $pdf->download('facture.pdf');
    }
}
