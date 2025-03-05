<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use App\Models\Reservation;
use App\Notifications\ReservationCreated;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function showPaymentForm(Request $request)
    {
        $annonce = $request->session()->get('annonce');
        $start_date = $request->session()->get('start_date');
        $end_date = $request->session()->get('end_date');
        $total_price = $request->session()->get('total_price');

        return view('payment.form', compact('annonce', 'start_date', 'end_date', 'total_price'));
    }

    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => 'Reservation Payment',
                    ],
                    'unit_amount' => $request->total_price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        $annonce = $request->session()->get('annonce');
        $start_date = $request->session()->get('start_date');
        $end_date = $request->session()->get('end_date');
        $total_price = $request->session()->get('total_price');

        // Create the reservation
        Reservation::create([
            'user_id' => Auth::id(),
            'annonce_id' => $annonce->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'price_total' => $total_price,
        ]);

        $user = $annonce->user;
        $user->notify(new ReservationCreated($annonce));

        return redirect()->route('reservations.index')->with('success', 'Payment successful and reservation stored.');
    }

    public function paymentCancel()
    {
        return redirect()->route('annonces.show')->with('error', 'Payment was cancelled.');
    }
}
