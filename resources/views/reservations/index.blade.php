<x-app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">My Reservations</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full bg-white text-xs">
                <thead>
                    <tr>
                        <th class="text-left py-2 px-4 border-b border-gray-200">Annonce</th>
                        <th class="text-left py-2 px-4 border-b border-gray-200">Start Date</th>
                        <th class="text-left py-2 px-4 border-b border-gray-200">End Date</th>
                        <th class="text-left py-2 px-4 border-b border-gray-200">Total Price</th>
                        <th class="text-left py-2 px-4 border-b border-gray-200">Reserved at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200 flex">
                                <a href="{{ route('annonces.show', $reservation->annonce->id) }}">
                                    <img src="{{ asset('storage/' . $reservation->annonce->images) }}" alt=""
                                        class="w-36 h-20 object-cover">
                                </a>
                                <div class="p-2 flex flex-col">
                                    <span class="text-lg">{{ $reservation->annonce->title }}</span>
                                    <span class="text-gray-600">Annonce belong to
                                        <strong>{{ $reservation->annonce->user->firstname }}
                                            {{ $reservation->annonce->user->lastname }}</strong></span>
                                </div>
                            </td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->start_date }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->end_date }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->price_total }} MAD</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                {{ $reservation->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app>
