<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavorisController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name("welcome");
    Route::get('/annonces/search', [AnnonceController::class, 'search'])->name("annonces.search");

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');

    Route::get('annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('annonces/{id}', [AnnonceController::class, 'show'])->name('annonces.show');

    // delete an annonce, possible for both admin and proprietaire
    Route::middleware('isAdminOrProprietaire')->group(function () {
        Route::delete('annonces/{id}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');
        Route::put('annonces/{id}', [AnnonceController::class, 'restore'])->name('annonces.restore');
    });

    // routes possibles for admin
    Route::middleware('isAdmin')->group(function () {
        Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::get('corbeille', [AnnonceController::class, 'corbeille'])->name('annonces.corbeille');

        Route::get('listReservations', [ReservationController::class, 'listReservations'])->name('reservations.listReservations');
    });

    // routes possibles for proprietaire
    Route::middleware('isProprietaire')->group(function () {
        Route::get('my-annonces', [AnnonceController::class, 'myannonces'])->name('annonces.myannonces');
        Route::post('annonces', [AnnonceController::class, 'store'])->name('annonces.store');
        Route::get('my-annonces/{id}/edit', [AnnonceController::class, 'edit'])->name('my-annonces.edit');
        Route::put('my-annonces/{id}', [AnnonceController::class, 'update'])->name('my-annonces.update');
        Route::get('my-reservations', [ReservationController::class, 'manage'])->name('reservations.manage');
    });

    // touriste possibles routes
    Route::middleware('isTouriste')->group(function () {
        Route::get('favoris', [FavorisController::class, 'index'])->name('favoris.index');
        Route::post('favoris/{annonce}', [FavorisController::class, 'store'])->name('favoris.store');

        Route::post('/reservations/{annonce}', [ReservationController::class, 'store'])->name('reservations.store');
        Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
        
        Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
        Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');
        Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
    
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        Route::get('/facture/pdf/{reservation}', [PDFController::class, 'index'])->name("facture.index");
    });
});
