<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xlerion – Soluciones Disruptivas</title>
    {{-- Asume que aquí cargas tus estilos de Tailwind/Vite --}}
    @vite('resources/css/app.css') 
</head>
<body class="bg-gray-900 text-gray-100 antialiased">
    <header class="bg-gray-800 shadow-lg sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <span class="text-xl font-bold text-teal-400">Xlerion</span>
            <div class="hidden sm:flex space-x-4">
                @foreach ($navigationLinks as $link)
                    <a href="{{ $link->route }}" class="text-gray-300 hover:text-teal-400">{{ $link->name }}</a>
                @endforeach
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 border-t border-gray-700 mt-12">
        @include('sections.legal')
    </footer>
</body>
</html>