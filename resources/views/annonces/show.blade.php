<x-app>
    <div class="container mx-auto px-4 py-8 text-sm" x-data="hebergementDetails()">
        <!-- Bannière et navigation -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
            <div class="relative">
                <img src="{{ asset('storage/' . $annonce->images) }}" alt="Photo principale de l'hébergement"
                    class="w-full h-[400px] object-cover">
                <div class="absolute top-4 left-4 text-gray-800 bg-white px-3 py-1 rounded-full text-sm font-semibold">
                    <span x-text="hebergement.categorie"></span>
                </div>
                <div class="absolute bottom-4 right-4 bg-white bg-opacity-90 px-4 py-2 rounded-lg shadow-lg">
                    <span class="text-2xl font-bold text-gray-700" x-text="hebergement.prix + ' MAD'"></span>
                    <span class="text-gray-600 text-sm">par nuit</span>
                </div>

                <form action="{{ route('favoris.store', $annonce) }}" method="POST">
                    @csrf
                    <button type="submit" class="absolute top-3 right-3 text-transparent">
                        <svg class="w-10 h-10" fill="{{ Auth::user()->hasFavorited($annonce) ? 'red' : 'none' }}"
                            stroke="red" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Informations principales -->
            <div class="p-6">
                <div class="flex flex-wrap justify-between items-start mb-6">
                    <div class="w-full md:w-2/3 mb-4 md:mb-0">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2" x-text="hebergement.titre"></h1>
                        <p class="text-gray-600 mb-3">
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span x-text="hebergement.lieu"></span>
                            </span>
                        </p>
                        {{-- <div class="flex items-center mb-2">
                            <div class="flex mr-2">
                                <template x-for="i in 5">
                                    <svg :class="i <= 4 ? 'text-yellow-400' : 'text-gray-300'"
                                        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </template>
                            </div>
                            <span class="text-gray-600 text-sm">(4.8/5 - 42 avis)</span>
                        </div> --}}
                        <div class="text-gray-600 mt-4">
                            {{-- <span class="inline-flex items-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                </svg>
                                <span>6 voyageurs max</span>
                            </span>
                            <span class="inline-flex items-center mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd"
                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span x-text="`Vu ${hebergement.vues} fois`"></span>
                            </span> --}}
                            <span class="inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span>Disponible jusqu'à <span
                                        x-text="formatDate(hebergement.disponibilite)"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 flex justify-end">
                        <div class="flex space-x-2">
                            <button
                                class="bg-gray-800 hover:bg-gray-800 text-white px-4 py-2 rounded-lg shadow font-medium transition">
                                Réserver maintenant
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="flex flex-wrap -mx-4">
            <!-- Colonne principale -->
            <div class="w-full lg:w-2/3 px-4 mb-8">
                <!-- Description -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Description</h2>
                        <div class="prose max-w-none text-gray-600" x-html="hebergement.description"></div>
                        {{-- <button @click="showFullDescription = !showFullDescription"
                            class="mt-4 text-gray-600 hover:text-gray-800 font-medium flex items-center">
                            <span x-text="showFullDescription ? 'Voir moins' : 'Voir plus'"></span>
                            <svg x-show="!showFullDescription" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="showFullDescription" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button> --}}
                    </div>
                </div>

                <!-- Équipements -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Équipements</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4">
                            <?php $equipements = explode(',', $annonce->equipements) ?>
                            @foreach ($equipements as $equip)
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ $equip }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Avis -->
                {{-- <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Avis (42)</h2>
                            <div class="flex items-center">
                                <div class="flex mr-2">
                                    <template x-for="i in 5">
                                        <svg :class="i <= 4 ? 'text-yellow-400' : 'text-gray-300'"
                                            xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </template>
                                </div>
                                <span class="text-gray-600">4.8/5</span>
                            </div>
                        </div>

                        <!-- Liste des avis -->
                        <div class="space-y-6">
                            <template x-for="(avis, index) in [1]" :key="index">
                                <div class="border-b border-gray-200 pb-6 mb-6 last:border-0 last:pb-0">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center mr-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-800">Sophie Martin</p>
                                                <p class="text-sm text-gray-500">Janvier 2023</p>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <template x-for="i in 5">
                                                <svg :class="i <= 5 ? 'text-yellow-400' : 'text-gray-300'"
                                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </template>
                                        </div>
                                    </div>
                                    <p class="text-gray-600">Un séjour magnifique dans cette villa luxueuse ! Tout
                                        était parfait, de l'accueil chaleureux aux équipements haut de gamme. La vue
                                        sur Paris est à couper le souffle et la piscine chauffée a été très
                                        appréciée. Je recommande vivement cette propriété pour un séjour de rêve !
                                    </p>
                                </div>
                            </template>
                        </div>

                        <button
                            class="mt-4 w-full py-2 bg-white border border-gray-600 text-gray-600 rounded-lg shadow-sm hover:bg-gray-80 font-medium transition">
                            Voir tous les avis
                        </button>
                    </div>
                </div> --}}
            </div>

            <!-- Colonne latérale -->
            <div class="w-full lg:w-1/3 px-4">
                <!-- Tarifs et réservation -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8 sticky top-4">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Tarifs</h2>
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-3xl font-bold text-gray-700" x-text="hebergement.prix + ' MAD'"></span>
                            <span class="text-gray-600">par nuit</span>
                        </div>

                        <div class="mb-6">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Arrivée</label>
                                    <input type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                                </div>
                                <div>
                                    <label class="block text-gray-700 text-sm font-medium mb-2">Départ</label>
                                    <input type="date"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Voyageurs</label>
                                <select
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                                    <option>1 voyageur</option>
                                    <option>2 voyageurs</option>
                                    <option>3 voyageurs</option>
                                    <option>4 voyageurs</option>
                                    <option>5 voyageurs</option>
                                    <option>6 voyageurs</option>
                                </select>
                            </div>
                        </div>

                        <button
                            class="w-full py-3 bg-gray-800 hover:bg-gray-800 text-white rounded-lg shadow font-medium transition">
                            Réserver maintenant
                        </button>

                        <div class="mt-6 border-t border-gray-200 pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">999.99 MAD x 3 nuits</span>
                                <span class="text-gray-800 font-medium">2,999.97 MAD</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg border-t border-gray-200 pt-4 mt-4">
                                <span>Total</span>
                                <span>3,699.97 MAD</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hôte -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Votre hôte</h2>
                        <div class="flex items-center mb-4">
                            <img src="{{ asset('storage/' . $annonce->user->image) }}" alt=""
                                class="w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center mr-4">
                            <div>
                                <p class="font-bold text-gray-800">{{ $annonce->user->firstname }}
                                    {{ $annonce->user->lastname }}</p>
                                <p class="text-sm text-gray-500">Joined
                                    {{ $annonce->user->created_at->diffForHumans() }}</p>
                                {{-- <div class="flex items-center mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="text-sm text-gray-500 ml-1">4.9 · 125 avis</span>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <p class="text-gray-600 mb-4">Passionné de voyage et d'architecture, je suis ravi de vous
                            accueillir dans ma villa parisienne. Je mets un point d'honneur à offrir une expérience
                            inoubliable à tous mes hôtes.</p>
                        <button
                            class="w-full py-2 bg-white border border-gray-600 text-gray-600 rounded-lg shadow-sm hover:bg-gray-80 font-medium transition">
                            Contacter l'hôte
                        </button> --}}
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function hebergementDetails() {
            return {
                favoris: false,
                showFullDescription: false,
                showMoreEquipements: false,
                hebergement: {
                    titre: '{{ $annonce->title }}',
                    categorie: "{{ $annonce->category->name }}",
                    prix: '{{ $annonce->price }}',
                    lieu: "{{ $annonce->city }}, {{ $annonce->country }}",
                    vues: 0,
                    disponibilite: "{{ $annonce->disponibility }}",
                    description: `
                        <p>Cette magnifique villa située en plein cœur de Paris offre un cadre luxueux et paisible pour vos vacances. Avec ses 4 chambres spacieuses, sa piscine chauffée et son jardin privé, vous profiterez d'un séjour inoubliable. La villa est entièrement équipée avec des meubles haut de gamme, une cuisine moderne, et un système de sécurité avancé. Idéale pour les familles ou les groupes d'amis, elle est proche des principales attractions parisiennes.</p>
                    `,
                },
                equipements: "{{ $annonce->equipements }}",
                equipementsExtra: [
                    "Salle de sport",
                    "Sauna",
                    "Home cinéma",
                    "Lave-linge et sèche-linge",
                    "Service de ménage quotidien",
                ],
                formatDate(dateString) {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('fr-FR', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                },
            };
        }
    </script>
</x-app>
