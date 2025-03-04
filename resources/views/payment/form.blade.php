<x-app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Payment for Reservation</h1>
        <form action="{{ route('payment.process') }}" method="POST">
            @csrf
            <p class="py-6 text-gray-600">Before finalizing your payment, please carefully review your order details.
                Ensure that all the
                information entered is correct, including the delivery address and selected options. Your transaction is
                secure, and your data is protected. Once the payment is completed, you will receive a confirmation email
                with all the details of your purchase. Thank you for your trust!</p>
            <input type="hidden" name="total_price" value="{{ $total_price }}">
            <button type="submit"
                class="w-full py-3 bg-gray-800 hover:bg-gray-800 text-white rounded-lg shadow font-medium transition">
                Pay {{ number_format($annonce->price, 2, ',', ' ') }} MAD
            </button>
        </form>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    </script>
</x-app>
