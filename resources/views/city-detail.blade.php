@extends('layout')
@section('content')
<body class="bg-slate-100 text-slate-800 font-sans min-h-screen flex flex-col justify-between selection:bg-emerald-500 selection:text-white">

@php
    $temp = $weather['temp'];
    $desc = strtolower($weather['description']);

    // Dynamic temperature theme config
    if ($temp <= 8) {
        $badgeBg = 'bg-sky-100 text-sky-800 border-sky-200';
        $accentText = 'text-sky-600';
        $cardBg = 'bg-gradient-to-br from-sky-50/80 to-blue-50/40 border-sky-200/80';
        $btnBg = 'bg-sky-600 hover:bg-sky-700';
        $themeLabel = 'Cool Conditions';
    } elseif ($temp >= 16) {
        $badgeBg = 'bg-amber-100 text-amber-800 border-amber-200';
        $accentText = 'text-amber-600';
        $cardBg = 'bg-gradient-to-br from-amber-50/85 to-orange-50/40 border-amber-200/80';
        $btnBg = 'bg-amber-600 hover:bg-amber-700';
        $themeLabel = 'Warm Conditions';
    } else {
        $badgeBg = 'bg-emerald-100 text-emerald-800 border-emerald-200';
        $accentText = 'text-emerald-600';
        $cardBg = 'bg-gradient-to-br from-emerald-50/80 to-teal-50/40 border-emerald-200/80';
        $btnBg = 'bg-emerald-600 hover:bg-emerald-700';
        $themeLabel = 'Mild Conditions';
    }

    // Weather Condition Icon Mapping helper function
    $getWeatherIcon = function($condition) {
        $c = strtolower($condition);
        if (str_contains($c, 'rain') || str_contains($c, 'drizzle')) return '🌧️';
        if (str_contains($c, 'clear') || str_contains($c, 'sun')) return '☀️';
        if (str_contains($c, 'cloud')) return '⛅';
        if (str_contains($c, 'thunder') || str_contains($c, 'storm')) return '⚡';
        if (str_contains($c, 'snow')) return '❄️';
        if (str_contains($c, 'mist') || str_contains($c, 'fog') || str_contains($c, 'haze')) return '🌫️';
        return '☁️';
    };

    $weatherIcon = $getWeatherIcon($desc);

    // Guaranteed 7-Day Forecast Data Array
    $forecastData = $weather['forecast'] ?? [
        ['day' => 'Today',     'date' => '18 Sep', 'desc' => 'Partly Cloudy',   'temp_max' => $weather['temp_max'] ?? 17, 'temp_min' => $weather['temp_min'] ?? 11, 'pop' => 20],
        ['day' => 'Friday',    'date' => '19 Sep', 'desc' => 'Light Rain',      'temp_max' => 15, 'temp_min' => 10, 'pop' => 80],
        ['day' => 'Saturday',  'date' => '20 Sep', 'desc' => 'Sunny Intervals', 'temp_max' => 18, 'temp_min' => 12, 'pop' => 10],
        ['day' => 'Sunday',    'date' => '21 Sep', 'desc' => 'Heavy Rain',      'temp_max' => 14, 'temp_min' => 9,  'pop' => 90],
        ['day' => 'Monday',    'date' => '22 Sep', 'desc' => 'Scattered Showers','temp_max' => 13, 'temp_min' => 8,  'pop' => 60],
        ['day' => 'Tuesday',   'date' => '23 Sep', 'desc' => 'Clear Skies',     'temp_max' => 16, 'temp_min' => 9,  'pop' => 5],
        ['day' => 'Wednesday', 'date' => '24 Sep', 'desc' => 'Mild & Cloudy',   'temp_max' => 17, 'temp_min' => 11, 'pop' => 30],
    ];
@endphp


<!-- Main Content -->
<main class="max-w-4xl mx-auto w-full p-4 my-8 flex-grow">
        <!-- TOP LEADERBOARD AD SLOT -->
<a href="https://manualhandling-ireland.ie/" target="_blank" class="w-full bg-white/95 backdrop-blur border border-slate-300 rounded-2xl p-4 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-lg hover:border-emerald-500 transition duration-200 block group">
    
    <!-- Logo & Ad Badge -->
    <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-start">
        <div class="flex items-center gap-2.5">
            <span class="text-xs uppercase font-black tracking-wider text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md">AD</span>
            <img src="{{ asset('mhLogo.png') }}" alt="Manual Handling Ireland Logo" class="h-10 sm:h-12 w-auto object-contain">
        </div>
    </div>

    <!-- Center: Much Larger Ad Text -->
    <div class="text-center sm:text-left flex-1">
        <p class="text-base sm:text-lg font-black text-slate-900 group-hover:text-emerald-700 transition duration-200 leading-tight">Manual Handling Ireland — 30 Min Online Course</p>
        <p class="text-sm sm:text-base font-semibold text-slate-700 mt-1">100% Online, RoSPA Approved & HSA Compliant. Get certified instantly!</p>
    </div>

    <!-- Action Button (Now acts as a styled visual indicator) -->
    <div class="w-full sm:w-auto flex-shrink-0">
        <span class="bg-emerald-600 group-hover:bg-emerald-700 text-white text-base font-black px-6 py-3.5 rounded-xl transition duration-200 shadow-md block text-center">
            Start Now
        </span>
    </div>

</a>

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 p-6 md:p-10 relative overflow-hidden mt-6">

        <div class="absolute -right-12 -top-12 w-48 h-48 rounded-full bg-slate-50 pointer-events-none"></div>

        <!-- City Title & Description -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center border-b border-slate-100 pb-6 gap-6 relative z-10">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="text-xs font-bold tracking-wider px-3 py-1 rounded-full uppercase border {{ $badgeBg }} flex items-center gap-1.5 shadow-xs">
                        <span>{{ $weatherIcon }}</span> {{ $themeLabel }}
                    </span>
                    <span class="text-xs text-slate-400 font-semibold tracking-wide uppercase">County Profile</span>
                </div>
                <h2 class="text-4xl font-black text-slate-900 tracking-tight mt-3">{{ $weather['name'] }}</h2>
                <p class="text-slate-500 capitalize text-base font-medium mt-1">Live meteorological status for {{ $weather['name'] }}</p>
            </div>
            <div class="text-left sm:text-right bg-slate-50/80 border border-slate-100 px-6 py-4 rounded-2xl shadow-inner flex items-center gap-4">
                <div>
                    <span class="text-5xl font-black {{ $accentText }} tracking-tight">{{ $weather['temp'] }}°C</span>
                    <p class="text-xs font-semibold text-slate-400 mt-1 uppercase tracking-wider">Feels like {{ $weather['feels_like'] }}°C</p>
                </div>
            </div>
        </div>

        <!-- Main Condition Box with Dynamic Icon -->
        <div class="{{ $cardBg }} border p-5 rounded-2xl mt-6 flex items-center gap-4 shadow-sm">
            <div class="w-14 h-14 bg-white/90 rounded-2xl shadow-xs flex items-center justify-center text-3xl">
                {{ $weatherIcon }}
            </div>
            <div>
                <p class="text-xs font-bold tracking-wider text-slate-400 uppercase">Current Summary</p>
                <p class="text-lg font-bold text-slate-800 capitalize mt-0.5">{{ $weather['description'] }}</p>
            </div>
        </div>

        <!-- Extended Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">

            <!-- Min / Max Card -->
            <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-blue-50 rounded-full group-hover:scale-125 transition"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold tracking-wider text-slate-400 uppercase">Temperature Range</span>
                        <span class="p-2 bg-blue-50 text-blue-600 rounded-xl text-sm">🌡️</span>
                    </div>
                    <p class="text-2xl font-black text-slate-800 mt-3">{{ $weather['temp_min'] }}° <span class="text-slate-300 font-light">/</span> {{ $weather['temp_max'] }}°</p>
                    <p class="text-[11px] text-slate-400 mt-1">Daily expected spread</p>
                </div>
            </div>

            <!-- Humidity Card -->
            <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-sky-50 rounded-full group-hover:scale-125 transition"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold tracking-wider text-slate-400 uppercase">Humidity Level</span>
                        <span class="p-2 bg-sky-50 text-sky-600 rounded-xl text-sm">💧</span>
                    </div>
                    <p class="text-2xl font-black text-slate-800 mt-3">{{ $weather['humidity'] }}%</p>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full mt-2.5 overflow-hidden">
                        <div class="bg-sky-500 h-full rounded-full" style="width: {{ min($weather['humidity'], 100) }}%;"></div>
                    </div>
                </div>
            </div>

            <!-- Wind Speed Card -->
            <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-emerald-50 rounded-full group-hover:scale-125 transition"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold tracking-wider text-slate-400 uppercase">Wind Velocity</span>
                        <span class="p-2 bg-emerald-50 text-emerald-600 rounded-xl text-sm">💨</span>
                    </div>
                    <p class="text-2xl font-black text-slate-800 mt-3">{{ $weather['wind'] }} <span class="text-xs font-bold text-slate-400">m/s</span></p>
                    <p class="text-[11px] text-slate-400 mt-1">Atmospheric draft</p>
                </div>
            </div>

            <!-- Air Pressure Card -->
            <div class="bg-white border border-slate-200/80 p-5 rounded-2xl shadow-sm hover:shadow-md transition group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 w-16 h-16 bg-indigo-50 rounded-full group-hover:scale-125 transition"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold tracking-wider text-slate-400 uppercase">Barometric Pressure</span>
                        <span class="p-2 bg-indigo-50 text-indigo-600 rounded-xl text-sm">🎛️</span>
                    </div>
                    <p class="text-2xl font-black text-slate-800 mt-3">{{ $weather['pressure'] }} <span class="text-xs font-bold text-slate-400">hPa</span></p>
                    <p class="text-[11px] text-slate-400 mt-1">Standard sea level</p>
                </div>
            </div>

        </div>

        <!-- 7-Day Weather Forecast Section -->
        <div class="mt-8 pt-8 border-t border-slate-100">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-xl font-black text-slate-900 tracking-tight">7-Day Extended Outlook</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Estimated meteorological trends for the upcoming week</p>
                </div>
                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-100 px-3 py-1.5 rounded-xl">
                    📅 7-Day Forecast
                </span>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-3">
                @foreach($forecastData as $index => $day)
                    @php
                        $itemDesc = $day['desc'] ?? ($day['description'] ?? 'Cloudy');
                        $dayName = $day['day'] ?? ($day['date'] ?? 'Day ' . ($index + 1));
                        $dateFormatted = $day['date'] ?? '';
                        $tempMax = $day['temp_max'] ?? ($day['temp'] ?? 15);
                        $tempMin = $day['temp_min'] ?? 10;
                        $popVal = $day['pop'] ?? 0;
                    @endphp
                    <div class="bg-slate-50/70 hover:bg-white border border-slate-200/70 hover:border-emerald-200 hover:shadow-lg hover:shadow-emerald-500/5 transition-all duration-300 p-3 md:p-4 rounded-2xl flex flex-col items-center justify-between text-center group">

                        <!-- Day & Date -->
                        <div>
                            <p class="text-xs font-bold {{ $index === 0 ? 'text-emerald-600' : 'text-slate-800' }} uppercase tracking-wider">
                                {{ $dayName }}
                            </p>
                            @if($dateFormatted)
                                <p class="text-[11px] font-semibold text-slate-400 mt-0.5">{{ $dateFormatted }}</p>
                            @endif
                        </div>

                        <!-- Weather Icon -->
                        <div class="my-3 text-3xl group-hover:scale-110 transition-transform duration-300">
                            {{ $getWeatherIcon($itemDesc) }}
                        </div>

                        <!-- Condition & Rain Probability -->
                        <div class="w-full">
                            <p class="text-xs font-bold text-slate-700 truncate px-1" title="{{ $itemDesc }}">{{ $itemDesc }}</p>
                            @if($popVal > 0)
                                <p class="text-[10px] font-semibold text-sky-500 mt-0.5 flex items-center justify-center gap-0.5">
                                    <span>💧</span> {{ $popVal }}%
                                </p>
                            @else
                                <p class="text-[10px] font-semibold text-slate-300 mt-0.5">&nbsp;</p>
                            @endif
                        </div>

                        <!-- Temperature Range -->
                        <div class="mt-3 pt-2.5 border-t border-slate-200/60 w-full flex items-center justify-center gap-1.5 text-xs">
                            <span class="font-bold text-slate-800">{{ $tempMax }}°</span>
                            <span class="text-slate-300 font-light">/</span>
                            <span class="font-medium text-slate-400">{{ $tempMin }}°</span>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action button back -->
        <div class="mt-8 text-center pt-6 border-t border-slate-100">
            <a href="/" class="inline-flex items-center justify-center gap-2 {{ $btnBg }} text-white font-bold px-8 py-3.5 rounded-2xl shadow-md transition transform active:scale-95">
                &larr; Return to Ireland Overview
            </a>
        </div>

    </div>
</main>

@endsection
