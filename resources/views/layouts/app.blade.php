<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            @auth
                @if(auth()->user()->isAdmin())
                    <nav class="bg-gray-200 py-2 px-4 mb-4">
                        <ul class="flex space-x-4">
                            <li><a href="{{ route('admin.index') }}" class="text-blue-700 font-semibold">Tableau de bord</a></li>
                            <li><a href="{{ route('admin.paie') }}" class="text-blue-700 font-semibold">Paie utilisateurs</a></li>
                            {{-- <li><a href="{{ route('admin.users') }}" class="text-blue-700 font-semibold">Utilisateurs</a></li>
                            <li><a href="{{ route('admin.tickets') }}" class="text-blue-700 font-semibold">Tickets</a></li> --}}
                            {{-- Ajoute d'autres liens selon tes besoins --}}
                        </ul>
                    </nav>
                @endif
            @endauth

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{-- {{ $slot }} --}}
                @yield('content')
            </main>
        </div>
    </body>
</html>
