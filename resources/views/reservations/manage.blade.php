<x-app>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Manage Reservations</h1>

        @foreach ($annonces as $annonce)
            <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800">{{ $annonce->title }}</h2>
                    <span class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio debitis maxime est
                        consectetur, magnam, similique tempore ab pariatur placeat sapiente eveniet voluptate vel,
                        reiciendis provident.</span>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full bg-white text-xs">
                            <thead>
                                <tr>
                                    <th class="text-left py-2 px-4 border-b border-gray-200">Tourist</th>
                                    <th class="text-left py-2 px-4 border-b border-gray-200">Start Date</th>
                                    <th class="text-left py-2 px-4 border-b border-gray-200">End Date</th>
                                    <th class="text-left py-2 px-4 border-b border-gray-200">Total Price</th>
                                    <th class="text-left py-2 px-4 border-b border-gray-200">Reserved At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($annonce->reservations as $reservation)
                                    <tr>
                                        <td class="py-2 px-4 border-b border-gray-200 flex items-center gap-1">
                                            <img src="{{ asset('storage/' . $reservation->user->image) }}"
                                                class="size-5 rounded-full object-cover" alt="">
                                            {{ $reservation->user->firstname }} {{ $reservation->user->lastname }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->start_date }}
                                        </td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->end_date }}</td>
                                        <td class="py-2 px-4 border-b border-gray-200">{{ $reservation->price_total }}
                                            MAD</td>
                                        <td class="py-2 px-4 border-b border-gray-200">
                                            {{ $reservation->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app>
