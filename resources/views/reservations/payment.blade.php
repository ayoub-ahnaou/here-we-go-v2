<x-app>
    <div>
        <h1>Payment for Reservation</h1>
        <form id="payment-form">
            @csrf
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <button id="submit-button">Pay Now</button>
            <div id="error-message" role="alert"></div>
        </form>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount('#card-element');

            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit-button');
            const errorMessage = document.getElementById('error-message');

            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                submitButton.disabled = true;

                const {
                    error,
                    paymentMethod
                } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                });

                if (error) {
                    errorMessage.textContent = error.message;
                    submitButton.disabled = false;
                } else {
                    // Send paymentMethod.id to your server
                    fetch('/reservations/payment', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                            },
                            body: JSON.stringify({
                                payment_method_id: paymentMethod.id,
                                annonce_id: '{{ $annonce->id }}',
                                start_date: '{{ $start_date }}',
                                end_date: '{{ $end_date }}',
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                window.location.href = '/reservations/success';
                            } else {
                                errorMessage.textContent = data.error;
                                submitButton.disabled = false;
                            }
                        });
                }
            });
        </script>
    </div>
</x-app>
