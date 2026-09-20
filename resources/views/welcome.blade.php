@extends('layout')
@section('content')

<body class="bg-gradient-to-br from-slate-100 to-slate-200 text-slate-800 font-sans min-h-screen flex flex-col justify-between">


<!-- Main Container with Side Banners -->
<div class="max-w-7xl mx-auto w-full flex flex-col gap-6 p-4 my-6 flex-grow">

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

    <!-- Grid layout for Side Banners and Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        <a href="https://manualhandling-ireland.ie/" target="_blank" class="hidden lg:flex lg:col-span-1 bg-white/95 backdrop-blur border border-slate-300 rounded-2xl p-4 flex-col items-center justify-between text-center min-h-[600px] shadow-sm relative overflow-hidden group hover:border-emerald-500 transition duration-200 block">
    
    <!-- Top Label & Logo -->
    <div class="w-full flex flex-col items-center gap-2 pb-3 border-b border-slate-200">
        <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md">
            AD
        </span>
        <img src="{{ asset('mhLogo.png') }}" alt="Manual Handling Ireland Logo" class="h-8 w-auto object-contain mt-1">
    </div>

    <!-- Center Content Stack -->
    <div class="my-auto flex flex-col items-center gap-3">
        <span class="text-[11px] uppercase font-extrabold tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded">
            Online & HSA Compliant
        </span>
        
        <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-700 transition duration-200 leading-tight">
            NEED YOUR CERTIFICATE TODAY?
        </h3>

        <div class="text-left text-xs font-semibold space-y-2 w-full bg-slate-50 p-3 rounded-xl border border-slate-200 text-slate-700">
            <p>✔️ 100% Online Course</p>
            <p>✔️ RoSPA Approved</p>
            <p>✔️ Instant Certificate</p>
            <p>✔️ 30 Minute Course</p>
            <p>✔️ Start Instantly</p>
        </div>
    </div>

    <!-- Action & Footer -->
    <div class="w-full space-y-3">
        <span class="block w-full bg-emerald-600 group-hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wide py-3 px-2 rounded-xl shadow-md transition duration-200">
            Start Now
        </span>
        <span class="text-[9px] text-slate-400 block">manualhandling-ireland.ie</span>
    </div>

</a>
        <!-- CENTER CONTENT (Map & Cities Grid) -->
        <main class="lg:col-span-3 flex flex-col gap-6">

            <!-- Map Section -->
            <div class="bg-white p-3 rounded-2xl shadow-md border border-slate-200/80">
                <div class="flex justify-between items-center mb-3 px-2">
                    <h2 class="text-md font-bold text-slate-700 flex items-center gap-2">
                        🗺️ Interactive Weather Map & Regions
                    </h2>
                    <span class="text-xs font-medium text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg">Ireland Focus Locked</span>
                </div>
                <div id="map"></div>
            </div>

            <!-- City Weather Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($weatherData as $data)
                    @php
                        $temp = $data['temp'];
                        if ($temp <= 8) {
                            $cardBg = 'bg-sky-50/70 border-sky-200 hover:bg-sky-100/70';
                            $textCol = 'text-sky-700';
                            $badgeBg = 'bg-sky-600 text-white';
                        } elseif ($temp >= 16) {
                            $cardBg = 'bg-amber-50/70 border-amber-200 hover:bg-amber-100/70';
                            $textCol = 'text-amber-700';
                            $badgeBg = 'bg-amber-600 text-white';
                        } else {
                            $cardBg = 'bg-emerald-50/70 border-emerald-200 hover:bg-emerald-100/70';
                            $textCol = 'text-emerald-700';
                            $badgeBg = 'bg-emerald-600 text-white';
                        }
                    @endphp

                    <!-- Clickable Card Wrapper -->
                    <a href="/city/{{ strtolower($data['name']) }}" class="{{ $cardBg }} border p-5 rounded-2xl flex items-center justify-between shadow-xs hover:shadow-md transition duration-200 block">
                        <div>
                            <div class="flex items-center gap-2.5">
                                <h3 class="font-extrabold text-slate-900 text-xl">{{ $data['name'] }}</h3>
                                <span class="text-[11px] uppercase font-bold px-2 py-0.5 rounded-md {{ $badgeBg }}">
                                    {{ $temp <= 8 ? 'Cool' : ($temp >= 16 ? 'Warm' : 'Mild') }}
                                </span>
                            </div>
                            
                            <div class="flex items-center gap-2 mt-2.5">
                                <span class="text-2xl leading-none">{{ $data['icon'] ?? '⛅' }}</span>
                                <p class="text-sm text-slate-700 font-semibold capitalize">{{ $data['condition'] ?? $data['description'] ?? '' }}</p>
                            </div>

                            <div class="text-xs text-slate-600 mt-3 flex gap-4">
                                <span>Wind: <strong class="text-slate-900 text-sm font-bold">{{ $data['wind'] }} m/s</strong></span>
                                <span>Humidity: <strong class="text-slate-900 text-sm font-bold">{{ $data['humidity'] }}%</strong></span>
                            </div>
                        </div>
                        
                        <div class="text-right pl-3">
                            <span class="text-4xl font-black tracking-tight {{ $textCol }}">{{ $temp }}°C</span>
                        </div>
                    </a>
                @empty
                    <div class="col-span-2 text-center py-12 text-slate-400 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                        <p class="font-medium text-slate-600">Waiting for OpenWeatherMap Key Activation...</p>
                    </div>
                @endforelse
            </div>

        </main>

       <!-- RIGHT PROMO SLOT -->
<!-- RIGHT PROMO SLOT -->
<a href="https://manualhandling-ireland.ie/" target="_blank" class="hidden lg:flex lg:col-span-1 bg-white/95 backdrop-blur border border-slate-300 rounded-2xl p-4 flex-col items-center justify-between text-center min-h-[600px] shadow-sm relative overflow-hidden group hover:border-emerald-500 transition duration-200 block">
    
    <!-- Top Label & Logo -->
    <div class="w-full flex flex-col items-center gap-2 pb-3 border-b border-slate-200">
        <span class="text-[10px] uppercase font-bold tracking-widest text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-md">
            AD
        </span>
        <img src="{{ asset('mhLogo.png') }}" alt="Manual Handling Ireland Logo" class="h-8 w-auto object-contain mt-1">
    </div>

    <!-- Center Content Stack -->
    <div class="my-auto flex flex-col items-center gap-3">
        <span class="text-[11px] uppercase font-extrabold tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded">
            Online & HSA Compliant
        </span>
        
        <h3 class="text-lg font-extrabold text-slate-900 group-hover:text-emerald-700 transition duration-200 leading-tight">
            NEED YOUR CERTIFICATE TODAY?
        </h3>

        <div class="text-left text-xs font-semibold space-y-2 w-full bg-slate-50 p-3 rounded-xl border border-slate-200 text-slate-700">
            <p>✔️ 100% Online Course</p>
            <p>✔️ RoSPA Approved</p>
            <p>✔️ Instant Certificate</p>
            <p>✔️ 30 Minute Course</p>
            <p>✔️ Start Instantly</p>
        </div>
    </div>

    <!-- Action & Footer -->
    <div class="w-full space-y-3">
        <span class="block w-full bg-emerald-600 group-hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wide py-3 px-2 rounded-xl shadow-md transition duration-200">
            Start Now
        </span>
        <span class="text-[9px] text-slate-400 block">manualhandling-ireland.ie</span>
    </div>

</a>

    </div>

</div>

</body>
@endsection