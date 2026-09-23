<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Tomorrow Ireland | Accurate Daily & Hourly Forecasts</title>
    <meta name="description" content="Get your weather tomorrow in Ireland. Check accurate daily forecasts, rain radars, and hourly updates for Dublin, Cork, Galway, and nationwide. View now!">
    <meta name="keywords" content="weather tomorrow, Ireland weather, weather forecast, Irish weather forecast, rain radar Ireland, hourly weather update">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 520px;
            width: 100%;
            border-radius: 1rem;
            z-index: 10;
        }
        /* Permanent temperature badges on map */
        .weather-badge {
            background: white;
            padding: 4px 10px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 13px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 2px solid rgba(255, 255, 255, 0.9);
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col justify-between">
<header class="bg-gradient-to-r from-emerald-800 to-teal-700 text-white shadow-lg py-5 px-6">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4">
        <a href="/" class="text-3xl sm:text-5xl font-black tracking-tight flex flex-col sm:flex-row items-center text-center sm:text-left gap-2 sm:gap-4">
    <img src="{{ asset('logo.png') }}" alt="weather-tomorrow.ie logo" class="w-16 sm:w-20 object-contain">
    weather-tomorrow.ie
</a>
        <div class="flex items-center gap-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-900/60 text-emerald-100 border border-emerald-600/40">
                <span class="w-2 h-2 mr-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                Live Irish Meteorological Feed
            </span>
        </div>
    </div>
</header>
<!-- Main Page Content from Dashboard View -->
<main class="flex-grow">
    @yield('content')
</main>

<footer class="bg-slate-900 text-slate-400 text-center py-6 text-sm border-t border-slate-800">
    <p>&copy; {{ date('Y') }} weather-tomorrow.ie copyright</p>
</footer>

<!-- 1. Safely pass Laravel data to JavaScript globally -->
<script>
    window.irishWeatherData = @json($weatherData ?? []);
</script>

<!-- 2. Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- 3. Your Map Script -->
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
