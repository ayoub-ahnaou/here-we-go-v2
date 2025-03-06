<x-dashboard>
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Reservations</h2>
    </div>

    <div class="bg-white shadow-md rounded-sm overflow-hidden">
        <div class="px-4 py-5 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-800">List of reservations <span
                    class="text-xs text-gray-600">({{ sizeof($reservations) }})</span></h3>
        </div>

        <div class="overflow-x-auto">
            @if (sizeof($reservations) == 0)
                <p class="text-red-500 p-2 text-sm">No reservations available</p>
            @else
                <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Touriste
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Annonce
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                localisation
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                start date
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                end date
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                price
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                created at
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                price total
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-500">#{{ $reservation->id }}
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->user->firstname }} {{ $reservation->user->lastname }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->annonce->title }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->annonce->city }}, {{ $reservation->annonce->country }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->start_date }}
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->end_date }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->annonce->price }} MAD
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $reservation->price_total }} MAD
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-dashboard>
