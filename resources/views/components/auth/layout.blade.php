<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="{{ url('images/icons/icon.png') }}">
    @vite('resources/css/app.css')
    <livewire:styles>
</head>
<body class="bg-authBodyColor md:h-screen">
    <main class="bg-authBodyColor md:h-screen">
    <nav class="bg-navColor h-24 w-full">
        <div class="flex md:flex-row justify-between items-center text-white w-9/12 mx-auto pt-4">
            <a href="/"><img src="{{ url('images/icons/logo.svg') }}"></a>
            <ul class="flex space-x-6 text-xl">
                <li><a href="{{ route('auth.login') }}"  wire:navigate>Login</a></li>
                <li><a href="{{ route('auth.signup') }}" wire:navigate>Sign up</a></li>
            </ul>
        </div>
    </nav>
    <section class="h-44 md:h-38 w-full bg-white">

    </section>
    {{ $slot }}
</main>
<livewire:scripts>
</body>
</html>