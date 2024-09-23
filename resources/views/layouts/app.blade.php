<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Mantenimiento')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        {{-- Navbar --}}
        @include('layouts.navbar')
    </header>

    <main>
        <div class="bg-red-100 my-4 text-center">
            <h1 class="text-lg font-semibold m-4 uppercase">@yield('cabecera')</h1>
        </div>

        @yield('contenido')

    </main>

    <footer class="footer items-center p-4 bg-neutral text-neutral-content">

        @include('layouts.footer')
    </footer>

</body>

</html>