<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HereWeGo - Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col justify-between min-h-screen">
        <main class="flex-grow w-full">
            <div class="flex flex-col md:flex-row min-h-screen">
                <div class="bg-white shadow-md w-full md:w-64 min-h-screen flex flex-col">
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <a href="{{ route('welcome') }}" class="flex items-center gap-1">
                                <img src="{{ asset('assets/icons/logo.svg') }}" class="size-5" alt="">
                                <h1 class="text-xl font-bold text-gray-700">HereWeGo</h1>
                            </a>
                            <div class="">
                                <img src="{{ asset('assets/icons/chevron-right-2.svg') }}"
                                    class="size-4 p-1 cursor-pointer hover:bg-gray-200 rotate-180 bg-gray-100 rounded-full"
                                    alt="">
                            </div>
                        </div>
                    </div>

                    <nav class="py-2 text-sm flex flex-col justify-between flex-grow">
                        <ul>
                            <li class="mb-1">
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 {{ request()->routeIs('dashboard') ? ' text-gray-800 font-medium bg-gray-100' : ' text-gray-600 hover:bg-gray-100' }}">
                                    Statistiques
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('users.index') }}"
                                    class="block px-4 py-2 {{ request()->routeIs('users.index') ? ' text-gray-800 font-medium bg-gray-100' : ' text-gray-600 hover:bg-gray-100' }}">
                                    Users
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('annonces.index') }}"
                                    class="block px-4 py-2 {{ request()->routeIs('annonces.index') ? ' text-gray-800 font-medium bg-gray-100' : ' text-gray-600 hover:bg-gray-100' }}">
                                    Offres d'hebergement
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('categories.index') }}"
                                    class="block px-4 py-2 {{ request()->routeIs('categories.index') ? ' text-gray-800 font-medium bg-gray-100' : ' text-gray-600 hover:bg-gray-100' }}">
                                    Categories
                                </a>
                            </li>
                            <li class="mb-1">
                                <a href="{{ route('annonces.corbeille') }}"
                                    class="block px-4 py-2 {{ request()->routeIs('annonces.corbeille') ? ' text-gray-800 font-medium bg-gray-100' : ' text-gray-600 hover:bg-gray-100' }}">
                                    Corbeille
                                </a>
                            </li>
                        </ul>

                        <ul>
                            <li>
                                <a href="{{ route('profile.edit') }}"
                                    class="px-4 py-2 border-t border-gray-200 text-gray-600 hover:bg-gray-100 flex items-center gap-2">
                                    <img src="{{ Auth::user()->image != null ? asset('storage/' . Auth::user()->image) : asset('assets/icons/profile.svg') }}"
                                        class="size-5 rounded-full object-cover" alt="" />
                                    <span>
                                        {{ Auth::user()->firstname }} {{ Auth::user()->firstname }}
                                    </span>
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-4 py-2 border-t border-gray-200 flex items-center gap-1 text-gray-600 hover:bg-gray-100">
                                        <img src="{{ asset('assets/icons/logout.svg') }}" class="size-4"
                                            alt="">
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex-1 p-4">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
</body>

</html>
