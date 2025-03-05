<nav class="h-10 w-full bg-gray-100 px-8 text-gray-600 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between h-full items-center">
        <a href="{{ route('welcome') }}" class="flex items-center gap-1">
            <img src="{{ URL('assets/icons/logo.svg') }}" class="size-4" alt="" />
            <span class="font-medium">HereWeGo</span>
        </a>

        <ul class="text-xs flex items-center h-full">
            @auth
                @if (Auth::user()->role_id === 2)
                    <div class="relative group h-full">
                        <a href="{{ route('notifications.index') }}"
                            class="flex items-center gap-1 hover:bg-gray-200 h-full px-2 cursor-pointer">
                            <svg class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span>Notifications</span>
                            @if (Auth::user()->unreadNotifications->count() > 0)
                                <span class="absolute top-2 left-6 inline-block w-2 h-2 bg-red-600 rounded-full"></span>
                            @endif
                        </a>
                    </div>
                @endif
            @endauth

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

                                <a href="{{ route('reservations.manage') }}"
                                    class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">
                                    Manage Reservations
                                </a>
                            @elseif (Auth::user()->role_id == 3)
                                <a href="{{ route('reservations.index') }}"
                                    class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Mes
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
                                class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-50">Dashboard</a>
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
