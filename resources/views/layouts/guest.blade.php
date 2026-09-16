<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="REQUEST LINK - Layanan Pemendek Tautan dan QR Code Resmi PIK-R REQUEST, SMA Negeri 1 Tasik Putri Puyu. Shorten. Share. Connect.">
    
    <title>{{ $title ?? 'Masuk' }} — REQUEST LINK | PIK-R REQUEST</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased text-slate-100 bg-[#070d19] selection:bg-blue-600 selection:text-white">
    {{ $slot }}
</body>
</html>
