<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="{{ url('images/icons/icon.png') }}">
    @vite('resources/css/app.css')
    <livewire:styles>
</head>
<body class="bg-navColor relative">
{{ $slot }}
<livewire:scripts>
</body>
</html>