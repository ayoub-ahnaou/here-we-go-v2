<x-dashboard>
    <div class="flex flex-col md:flex-row items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4 md:mb-0">Offres d'hébérgement</h2>
    </div>

    <div class="bg-white shadow-md rounded-sm overflow-hidden">
        <div class="px-4 py-5 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-800">List of annonces <span
                    class="text-xs text-gray-600">({{ sizeof($annonces) }})</span></h3>
        </div>

        <div class="overflow-x-auto">
            @if (sizeof($annonces) == 0)
                <p class="text-red-500 p-2 text-sm">No annonces available</p>
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
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Localisation
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                disponibility
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                price
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                equipements
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                created at
                            </th>
                            <th scope="col"
                                class="px-6 py-1 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($annonces as $annonce)
                            <tr>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-500">#{{ $annonce->id }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">{{ $annonce->title }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">{{ $annonce->city }},
                                    {{ $annonce->country }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">
                                    {{ $annonce->disponibility }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">{{ $annonce->price }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900"
                                    title="{{ $annonce->equipements }}">
                                    {{ Str::limit($annonce->equipements, 40, '...') }}</td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-900">{{ $annonce->created_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-1 text-xs whitespace-nowrap text-gray-500">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('annonces.destroy', $annonce) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 underline">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-dashboard>
