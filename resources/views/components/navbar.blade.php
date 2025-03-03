<nav class="h-10 w-full bg-gray-100 px-8 text-gray-600 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between h-full items-center">
        <a href="{{ route('welcome') }}" class="flex items-center gap-1">
            <img src="{{ URL('assets/icons/logo.svg') }}" class="size-4" alt="" />
            <span class="font-medium">HereWeGo</span>
        </a>

        <ul class="text-xs flex items-center h-full">
            {{-- @auth
                <li class="relative group h-full">
                    <div class="flex items-center gap-1 hover:bg-gray-200 h-full px-2 cursor-pointer">
                        <!-- <img src="./imgs/profile.svg" class="size-5" alt="" /> -->
                        <span class="font-medium pl-1">HÉBERGEMENT</span>
                        <img src="{{ URL('assets/icons/chevron-down.svg') }}"
                            class="size-4 group-hover:rotate-180 transition-transform" alt="" />
                    </div>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 hidden group-hover:block w-64 bg-white border border-gray-200 rounded-md shadow-lg py-2 mt-1">
                        <!-- Host Section -->
                        <div class="border-b border-gray-100">
                            <a href="" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Devenir un
                                hôte</a>
                            <a href="" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes
                                propriétés</a>
                            <a href="" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes hôtes</a>
                        </div>
                    </div>
                </li>
            @endauth --}}

            <li class="relative group h-full">
                <div class="flex items-center gap-1 hover:bg-gray-200 h-full px-2 cursor-pointer relative">
                    @auth
                        <img src="{{ Auth::user()->image != null ? asset('storage/' . Auth::user()->image) : asset('assets/icons/profile.svg') }}"
                            class="size-5 rounded-full object-cover" alt="" />
                        @if (sizeof(Auth::user()->favoris) > 0)
                            <div class="absolute h-2 w-2 rounded-full bg-red-600 top-2 left-5"></div>
                        @endif
                    @endauth
                    <span class="font-medium pl-1">
                        @auth
                            {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                        @endauth
                        @guest
                            Mon Compte
                        @endguest
                    </span>
                    <img src="{{ URL('assets/icons/chevron-down.svg') }}"
                        class="size-4 group-hover:rotate-180 transition-transform" alt="" />
                </div>

                <!-- Dropdown Menu -->
                <div
                    class="absolute right-0 hidden group-hover:block w-64 bg-white border border-gray-200 rounded-md shadow-lg py-2 mt-1">
                    <!-- User Section -->
                    @auth
                        <div class="border-b border-gray-100">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mon profil</a>
                            @if (Auth::user()->role_id === 2)
                                <a href="{{ route('annonces.myannonces') }}"
                                    class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes
                                    annonces</a>
                            @elseif (Auth::user()->role_id == 3)
                                <a href="" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes
                                    réservations</a>
                                <a href="{{ route('favoris.index') }}"
                                    class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes
                                    favoris <span class="text-white bg-red-500 w-4 h-4 rounded-full px-1 text-[10px]">
                                        {{ sizeof(Auth::user()->favoris) ?? 0 }} </span></a>
                            @endif
                        </div>
                    @endauth

                    @auth
                        @if (Auth::user()->role_id === 1)
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Dachboard</a>
                        @endif
                    @endauth

                    <hr class="text-gray-200 h-[0.5px]" />

                    <!-- Auth Section -->
                    <div class="">
                        @guest
                            <a href="{{ route('login') }}"
                                class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Se
                                connecter</a>
                            <a href="{{ route('register') }}"
                                class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">S'inscrire</a>
                        @endguest
                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <input type="submit"
                                    class="block px-4 w-full cursor-pointer text-left py-2 text-xs text-gray-700 hover:bg-gray-50"
                                    value="Déconnexion" />
                            </form>
                        @endauth
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
