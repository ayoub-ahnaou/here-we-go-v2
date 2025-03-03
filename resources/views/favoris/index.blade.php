<x-app>
    <div class="pt-4 text-xl font-bold">
        <span>Favorites <span class="text-sm text-gray-600">({{ sizeof($favoris) }})</span></span>
    </div>

    <div class="container mx-auto pb-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 my-6">
            @foreach ($favoris as $annonce)
                <div class="space-y-1">
                    <div class="relative aspect-square rounded-xl overflow-hidden">
                        <a href="{{ route('annonces.show', $annonce->id) }}">
                            <img src="{{ asset('storage/' . $annonce->images) }}" alt="{{ $annonce->city }}"
                                class="w-full h-full object-cover" />
                        </a>

                        <form action="{{ route('favoris.store', $annonce) }}" method="POST">
                            @csrf
                            <button type="submit" class="absolute top-3 right-3 text-transparent">
                                <svg class="w-6 h-6" fill="{{Auth::user()->hasFavorited($annonce) ? 'red' : 'none'}}" stroke="red" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </button>
                        </form>

                        <div class="absolute top-3 left-3 bg-white px-2 py-1 rounded-md text-xs">
                            {{ $annonce->category->name }}
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <div>
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold">{{ $annonce->city }}, {{ $annonce->country }}</h3>
                            </div>

                            <p class="text-gray-500 text-sm">Séjournez chez {{ $annonce->user->firstname }}
                                {{ $annonce->user->lastname }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-sm">{{ $annonce->price }} MAD / nuit</p>
                </div>
            @endforeach
        </div>

        {{-- <div class="">
            {{ $favoris->links() }}
        </div> --}}
    </div>
</x-app>
