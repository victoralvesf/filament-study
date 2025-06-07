<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Filament Study')</title>
    @livewireStyles
</head>

<body class="antialiased bg-gray-100 text-gray-900">

    <div class="container mx-auto py-8">
        @yield('content')
    </div>

    @livewireScripts
</body>

</html>
