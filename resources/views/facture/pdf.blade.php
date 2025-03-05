<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Invoice - {{ $reservation->id }}</title>
</head>

<body style="background-color: #f9fafb;">
    <div
        style="max-width: 48rem; margin-left: auto; margin-right: auto; margin-top: 2rem; margin-bottom: 2rem; background-color: #ffffff; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); border-radius: 0.5rem; overflow: hidden;">
        <!-- Header -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h1 style="font-size: 1.5rem; line-height: 2rem; font-weight: 700; color: #f43f5e;">Touristay 2030
                    </h1>
                    <p style="font-size: 0.875rem; line-height: 1.25rem; color: #6b7280;">Invoice
                        #{{ $reservation->id }}</p>
                </div>
                <div style="text-align: right;">
                    <p style="font-size: 0.875rem; line-height: 1.25rem; color: #6b7280;">Date d'émission</p>
                    <p style="font-weight: 500;">{{ $reservation->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Reservation Info -->
        <div style="padding: 1.5rem; border-bottom: 1px solid #e5e7eb;">
            <div style="display: flex; flex-direction: column; justify-content: space-between;">
                <div style="margin-bottom: 1rem;">
                    <h2 style="font-size: 1.125rem; line-height: 1.75rem; font-weight: 600; margin-bottom: 0.5rem;">
                        Détails de la réservation</h2>
                    <div style="display: flex; align-items: flex-start; margin-bottom: 0.5rem;">
                        <img src="{{ asset('storage/' . $reservation->annonce->images) }}"
                            alt="{{ $reservation->annonce->title }}"
                            style="width: 5rem; height: 5rem; object-fit: cover; border-radius: 0.375rem; margin-right: 1rem;">
                        <div>
                            <h3 style="font-weight: 500;">{{ $reservation->annonce->title }}</h3>
                            <p style="font-size: 0.875rem; line-height: 1.25rem; color: #4b5563;">
                                {{ $reservation->annonce->city }},
                                {{ $reservation->annonce->country }}</p>
                            <p style="font-size: 0.875rem; line-height: 1.25rem; color: #4b5563;">Hôte:
                                {{ $reservation->annonce->user->firstname }} {{ $reservation->annonce->user->lastname }}</p>
                        </div>
                    </div>
                    <div style="margin-top: 1rem;">
                        <p style="font-size: 0.875rem; line-height: 1.25rem;"><span
                                style="font-weight: 500;">Check-in:</span>
                            {{ $reservation->start_date }} (à partir de 15h00)</p>
                        <p style="font-size: 0.875rem; line-height: 1.25rem;"><span
                                style="font-weight: 500;">Check-out:</span>
                            {{ $reservation->end_date }} (avant 11h00)</p>
                    </div>
                </div>
                <div>
                    <h2 style="font-size: 1.125rem; line-height: 1.75rem; font-weight: 600; margin-bottom: 0.5rem;">
                        Informations client</h2>
                    <p style="font-size: 0.875rem; line-height: 1.25rem;">{{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</p>
                    <p style="font-size: 0.875rem; line-height: 1.25rem;">{{ $reservation->user->email }}</p>
                    <p style="font-size: 0.875rem; line-height: 1.25rem;">+212-654-540581</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="padding: 1.5rem; background-color: #f9fafb;">
            <div style="text-align: center; font-size: 0.875rem; line-height: 1.25rem; color: #6b7280;">
                <p style="margin-bottom: 0.5rem;">Réservation #{{ $reservation->id }}</p>
                <p>Pour toute question concernant cette facture, veuillez contacter notre service client.</p>
                <p>support@touristay.com | +33 1 23 45 67 89</p>
            </div>
        </div>
    </div>
    {{-- {{ dd($reservation) }} --}}
</body>

</html>
