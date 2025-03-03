<x-app>
    @if (session('message'))
        <div id="toast"
            class="flex items-center gap-2 absolute top-12 right-0 pr-40 bg-green-100 text-green-700 rounded-md p-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" stroke="green" />
                <path d="M9 12l2 2 4-4" stroke="green" />
            </svg>
            {{ session('message') }}
        </div>
    @endif
    <script>
        setTimeout(() => {
            document.getElementById("toast").style.display = "none";
        }, 2000);
    </script>

    <div class="container mx-auto px-4 py-8">
        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6 flex items-center justify-between">
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Gestion des Offres d'Hébergement</h1>
                <p class="text-gray-600 mt-2">Gérez vos offres de location en un seul endroit</p>
            </header>

            <div class="flex flex-col md:flex-row gap-4">
                <p onclick="openAnnouncementModal()"
                    class="flex cursor-pointer items-center gap-1 bg-gray-50 hover:bg-gray-100 px-4 py-1 rounded-full">
                    <span class="text-xs text-gray-600">Ajouter une annonce</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 8v8M8 12h8" stroke="gray" />
                    </svg>
                </p>
            </div>
        </div>

        <!-- Listings Section -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Listing Header -->
            <div class="bg-gray-50 border-b border-gray-200 px-6 py-3">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-1">Image</div>
                    <div class="col-span-2">Lieu</div>
                    <div class="col-span-3">Titre</div>
                    <div class="col-span-1">Disponibilité</div>
                    <div class="col-span-2">Description</div>
                    <div class="col-span-1">Categorie</div>
                    <div class="col-span-1">Prix</div>
                    <div class="col-span-1">Actions</div>
                </div>
            </div>

            <!-- Listing Item 1 -->
            @foreach ($annonces as $annonce)
                <div class="px-6 py-4 border-b border-gray-200 hover:bg-gray-50 transition">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <!-- Image -->
                        <div class="col-span-1">
                            <img src="{{ asset('storage/' . $annonce->images) }}" alt="Villa à Paris"
                                class="rounded-md w-full h-16 object-cover">
                        </div>

                        <!-- Location -->
                        <div class="col-span-2">
                            <h3 class="font-medium text-gray-800">{{ $annonce->city }}, {{ $annonce->country }}</h3>
                        </div>

                        <!-- Title -->
                        <div class="col-span-3">
                            <h3 class="font-medium text-gray-800">{{ $annonce->title }}</h3>
                        </div>

                        <!-- Disponibilite -->
                        <div class="col-span-1">
                            <h3 class="font-medium text-gray-800">{{ $annonce->disponibility }}</h3>
                        </div>

                        <!-- Description (collapsed by default) -->
                        <div class="col-span-2">
                            <div class="relative">
                                <p class="text-gray-600 text-sm line-clamp-2">Magnifique villa de luxe située au cœur de
                                    Paris. Profitez d'un séjour confortable avec une chambre spacieuse, décoration
                                    élégante
                                    et toutes les commodités modernes.</p>
                                <button class="text-blue-600 text-sm mt-1 hover:underline">Voir plus</button>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="col-span-1">
                            <span
                                class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">{{ $annonce->category->name }}</span>
                        </div>

                        <!-- Price -->
                        <div class="col-span-1">
                            <p class="font-medium text-gray-800">{{ $annonce->price }} MAD</p>
                            <p class="text-xs text-gray-500">par nuit</p>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-1">
                            <div class="flex space-x-2">
                                <a href="{{ route('my-annonces.edit', $annonce->id) }}"
                                    class="p-1 text-blue-600 hover:text-blue-800" title="Modifier">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('annonces.destroy', $annonce) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="p-1 text-red-600 hover:text-red-800"
                                        title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Expanded Description (hidden by default) -->
                    <div class="mt-4 pt-4 border-t border-gray-100 hidden">
                        <h4 class="font-medium text-gray-800 mb-2">Description complète:</h4>
                        <p class="text-gray-700">
                            Magnifique villa de luxe située au cœur de Paris. Cette villa propose une chambre spacieuse
                            avec
                            un lit king-size confortable, une décoration élégante avec des accents locaux, et une salle
                            de
                            bain privée équipée d'articles de toilette de qualité.

                            La villa est équipée de la climatisation, d'une connexion Wi-Fi haut débit, et d'un espace
                            de
                            travail dédié. Vous aurez également accès à une petite kitchenette avec réfrigérateur et
                            machine
                            à café pour votre confort.

                            Idéalement située à proximité des principales attractions touristiques, restaurants et
                            boutiques
                            de Paris. Transport en commun facilement accessible.

                            Un séjour parfait pour les couples ou voyageurs d'affaires cherchant un hébergement luxueux
                            et
                            central à Paris.
                        </p>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <h5 class="font-medium text-gray-800 mb-1">Équipements:</h5>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>• Wi-Fi haut débit</li>
                                    <li>• Climatisation</li>
                                    <li>• Salle de bain privée</li>
                                    <li>• Lit king-size</li>
                                    <li>• Kitchenette</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            {{-- <div class="py-4 px-6">
                {{ $annonces->links() }}
            </div> --}}
        </div>
    </div>

    <!-- Basic JavaScript for toggle functionality -->
    <script>
        // Toggle description visibility
        document.querySelectorAll('.text-blue-600.text-sm.mt-1').forEach(button => {
            button.addEventListener('click', function() {
                const listingItem = this.closest('.px-6.py-4');
                const expandedDesc = listingItem.querySelector('.mt-4.pt-4.border-t');

                if (expandedDesc.classList.contains('hidden')) {
                    expandedDesc.classList.remove('hidden');
                    this.textContent = 'Voir moins';
                } else {
                    expandedDesc.classList.add('hidden');
                    this.textContent = 'Voir plus';
                }
            });
        });
    </script>

    <script>
        function openAnnouncementModal() {
            document.getElementById('addAnnouncementModal').classList.remove('hidden');
            document.querySelector('x-dashboard').classList.add('blur-background');
        }

        function closeAnnouncementModal() {
            document.getElementById('addAnnouncementModal').classList.add('hidden');
            document.querySelector('x-dashboard').classList.remove('blur-background');
        }

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('addAnnouncementModal');
            if (event.target === modal) {
                closeAnnouncementModal();
            }
        };
    </script>

    <div id="addAnnouncementModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden text-sm">

            <form class="p-6 md:p-8 space-y-6" method="POST" action="{{ route('annonces.store') }}"
                enctype="multipart/form-data">
                @csrf
                {{-- {/* Image Upload */} --}}
                <div
                    class="relative border-2 border-dashed border-gray-300 rounded-xl p-2 transition-all hover:border-gray-500 group">
                    <input type="file" name="images" id="images"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                    <div class="flex flex-col items-center justify-center space-y-3">
                        <div class="p-3 bg-blue-50 rounded-full text-gray-500 group-hover:bg-blue-100 transition-all">
                            <Image class="w-8 h-8" />
                        </div>
                        <p class="text-gray-700 font-medium">Drag and drop your images here</p>
                        <p class="text-sm text-gray-500">or click to browse files</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-1">
                            Country
                        </label>
                        <input type="text" id="country" name="country"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                            placeholder="Enter country" />
                    </div>
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                            City
                        </label>
                        <input type="text" id="city" name="city"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                            placeholder="Enter city" />
                    </div>
                </div>

                {{-- {/* Basic Details */} --}}
                <div class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Title
                        </label>
                        <input type="text" id="title" name="title"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                            placeholder="Enter a catchy title" />
                    </div>

                    <div>
                        <label for="disponibility" class="block text-sm font-medium text-gray-700 mb-1">
                            Availability Date
                        </label>
                        <div class="relative">
                            <input type="date" id="disponibility" name="disponibility"
                                class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none" />
                            <Calendar class="absolute right-3 top-3 w-5 h-5 text-gray-400 pointer-events-none" />
                        </div>
                    </div>
                </div>

                {{-- {/* Equipment */} --}}
                <div>
                    <label for="equipements" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                        <Briefcase class="w-4 h-4 mr-1 text-gray-500" />
                        Equipment
                    </label>
                    <textarea id="equipements" name="equipements" rows={5}
                        class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none resize-none"
                        placeholder="List available equipment, separate with comma"></textarea>
                </div>

                {{-- {/* Description */} --}}
                <div>
                    <label for="description" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                        <Briefcase class="w-4 h-4 mr-1 text-gray-500" />
                        Description
                    </label>
                    <textarea id="description" name="description" rows={5}
                        class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none resize-none"
                        placeholder="Description here..."></textarea>
                </div>

                {{-- {/* Category and Price */} --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="category_id" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            <Tag class="w-4 h-4 mr-1 text-gray-500" />
                            Category
                        </label>
                        <select id="category_id" name="category_id"
                            class="w-full p-1 pl-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none appearance-none bg-white">
                            <option value="" disabled selected>
                                Select a category
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price" class="flex items-center text-sm font-medium text-gray-700 mb-1">
                            <DollarSign class="w-4 h-4 mr-1 text-gray-500" />
                            Price
                        </label>
                        <div class="relative">
                            <input type="number" id="price" name="price"
                                class="w-full pl-10 rounded-lg border border-gray-300 focus:ring-2 focus:ring-gray-500 focus:border-transparent transition-all outline-none"
                                placeholder="0.00" />
                            <span class="absolute left-3 top-3 text-gray-500">DH</span>
                        </div>
                    </div>
                </div>

                {{-- {/* Action Buttons */} --}}
                <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-4">
                    <button type="button" onclick="closeAnnouncementModal()"
                        class="px-6 py-3 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-all">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-3 text-white bg-gradient-to-r from-gray-500 to-gray-900 rounded-lg hover:from-gray-500 hover:to-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all">
                        Publish Announcement
                    </button>
                </div>
                </method=>
        </div>
    </div>
</x-app>
