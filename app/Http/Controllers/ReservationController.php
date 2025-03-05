<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class ReservationController extends Controller
{
    public function showPaymentForm(Request $request, Annonce $annonce)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        return view('reservations.payment', compact('annonce', 'start_date', 'end_date'));
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Create a PaymentIntent
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->price_total * 100, // Amount in cents
                'currency' => 'usd',
                'payment_method' => $request->payment_method_id,
                'confirm' => true,
                'return_url' => route('reservations.success'),
            ]);

            // If payment is successful, create the reservation
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'annonce_id' => $request->annonce_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'price_total' => $request->price_total,
            ]);

            // Send notification to the proprietaire
            // $proprietaire = $reservation->annonce->user;
            // $proprietaire->notify(new NewReservationNotification($reservation));

            return response()->json(['success' => true]);
        } catch (ApiErrorException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::where('user_id', Auth::id())->get();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Annonce $annonce)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $start_date = new \DateTime($request->input('start_date'));
        $end_date = new \DateTime($request->input('end_date'));
        $interval = $start_date->diff($end_date);
        $nights = $interval->days;

        $total_price = $annonce->price * $nights; // Calculate total price

        $request->session()->put('annonce', $annonce);
        $request->session()->put('start_date', $request->input('start_date'));
        $request->session()->put('end_date', $request->input('end_date'));
        $request->session()->put('total_price', $total_price);

        return redirect()->route('payment.form');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public function manage()
    {
        $user = Auth::user();
        $annonces = $user->annonces()->with('reservations.user')->get();
        return view('reservations.manage', compact('annonces'));
    }
}
