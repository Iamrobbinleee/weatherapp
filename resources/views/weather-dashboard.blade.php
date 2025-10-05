<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Weather App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
    <link href="{{ asset('css/weather.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-blue-400 via-blue-300 to-indigo-500 min-h-screen p-4">
    <!-- Search Bar -->
    <div class="mb-8 text-center">
        <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
            <div class="relative flex-1">
                <input type="text" id="locationInput" placeholder="Enter location..." class="w-full px-4 py-3 rounded-full text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white shadow-lg pr-12">
                <button id="searchBtn" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button id="currentLocationBtn" class="px-6 py-3 bg-white/20 hover:bg-white/30 rounded-full text-white font-semibold shadow-lg transition-colors">
                <i class="fas fa-location-arrow mr-2"></i>
                Use My Location
            </button>
        </div>
    </div>

    <div class="max-w-10xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-stretch">
            <!-- Left side: Current Weather -->
            <div class="md:col-span-1 p-4 rounded-lg">
                <!-- Current Weather Card -->
                <div class="bg-white/20 backdrop-blur-lg rounded-3xl shadow-xl p-6 md:p-8 mb-6 text-white h-full">
                    <h2 class="text-2xl font-bold mb-6 text-center md:text-left">Current Weather</h2>
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 h-full" id="loader">
                        <div class="ui active centered inline loader"></div> {{-- Loader --}}
                    </div>
                    {{-- 1st Grid (Current Location Weather) --}}
                    <div class="flex flex-col md:flex-row items-center justify-between gap-4 h-full" id="first-grid" style="display: none;">
                        <div class="text-center md:text-left">
                            <h1 class="text-3xl md:text-4xl font-bold mb-2" id="location-name"></h1>
                            <p class="text-lg opacity-90 mb-4">Sunny</p>
                            <div class="flex items-center justify-center md:justify-start gap-2 mb-4">
                                <i class="fas fa-sun text-6xl md:text-7xl"></i>
                            </div>
                            <p class="text-6xl md:text-8xl font-black" id="location-temp-value"></p>
                            <span class="text-4xl md:text-5xl" id="location-fahr-value"></span>
                            {{-- <p class="text-lg opacity-90">Feels like 21°C (70°F)</p> --}}
                        </div>
                        <div class="grid grid-cols-2 gap-4 text-sm md:text-base">
                            <div class="text-center md:text-left">
                                <i class="fas fa-tint mb-1"></i>
                                <div>Humidity</div>
                                <div class="font-semibold" id="location-hum-value"></div>
                            </div>
                            <div class="text-center md:text-left">
                                <i class="fas fa-wind mb-1"></i>
                                <div>Wind</div>
                                <div class="font-semibold" id="location-wind-value"></div>
                            </div>
                            <div class="text-center md:text-left">
                                <i class="fas fa-eye mb-1"></i>
                                <div>Visibility</div>
                                <div class="font-semibold" id="location-vis-value"></div>
                            </div>
                            <div class="text-center md:text-left">
                                <i class="fas fa-thermometer-half mb-1"></i>
                                <div>Pressure</div>
                                <div class="font-semibold" id="location-press-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right side: two stacked cards -->
            <div class="md:col-span-2 flex flex-col gap-4">
                <div class="p-4 rounded-lg">
                    <!-- 5-Day Forecast -->
                    <div class="bg-white/20 backdrop-blur-lg rounded-3xl shadow-xl p-6 md:p-8 mb-6">
                        <h2 class="text-2xl font-bold mb-6 text-center md:text-left">7-Day Forecast</h2>
                        <div class="ui active centered inline loader" id="sdf-loader"></div> {{-- Loader --}}
                        <div class="grid grid-cols-2 md:grid-cols-7 gap-4" id="seven-days-forecast">
                            <!-- Per Day -->
                        </div>
                    </div>
                </div>

                <div class="p-4 rounded-lg">
                    <!-- Next 24 Hours Forecast -->
                    <div class="bg-white/20 backdrop-blur-lg rounded-3xl shadow-xl p-6 md:p-8">
                        <h2 class="text-2xl font-bold mb-6 text-center md:text-left">Next 24 Hours</h2>
                        <div class="ui active centered inline loader" id="tfh-loader"></div> {{-- Loader --}}
                        <div class="flex overflow-x-auto gap-4 pb-4 scrollbar-hide grid grid-cols-2 md:grid-cols-8" id="twentyfour-hours-forecast">
                            <!-- Hour 1: 12 PM -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
<script src="{{ asset('js/weather.js') }}"></script>
</body>
</html>