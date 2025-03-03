<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HereWeGo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="flex flex-col justify-between min-h-screen">
        @include('components.navbar')
        <main class="flex-grow container mx-auto w-full">
            {{ $slot }}
        </main>
        @include('components.footer')
    </div>
</body>

</html>
