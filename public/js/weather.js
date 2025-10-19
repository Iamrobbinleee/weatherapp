document.addEventListener('DOMContentLoaded', () => {
    const LOCATION_NAME        = document.getElementById('location-name');
    const LOCATION_TEMP_VALUE  = document.getElementById('location-temp-value');
    const LOCATION_FAHR_VALUE  = document.getElementById('location-fahr-value');
    const LOCATION_HUM_VALUE   = document.getElementById('location-hum-value');
    const LOCATION_WIND_VALUE  = document.getElementById('location-wind-value');
    const LOCATION_VIS_VALUE   = document.getElementById('location-vis-value');
    const LOCATION_PRESS_VALUE = document.getElementById('location-press-value');
    
    let seven_days_forecast        = document.getElementById('seven-days-forecast');
    let twentyfour_hours_forecast  = document.getElementById('twentyfour-hours-forecast');
    let loader                     = document.getElementById('loader');
    let first_grid                 = document.getElementById('first-grid');
    let sdf_loader                 = document.getElementById('sdf-loader');
    let tfh_loader                 = document.getElementById('tfh-loader');

    async function getWeatherData() {
        try {
            const response = await fetch('https://weatherapp.proj/api/weather');
            if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
            }
            loader.style.display = "none";
            sdf_loader.style.display = "none";
            tfh_loader.style.display = "none";
            first_grid.style.display = "";
            
            const data = await response.json();
            LOCATION_NAME.textContent = `${data.locationDetails.results[0].name}, ${data.locationDetails.results[0].country}`;
            LOCATION_TEMP_VALUE.textContent = data.currentWeather.current.temperature_2m + data.currentWeather.current_units.temperature_2m;
            LOCATION_FAHR_VALUE.textContent = "(72°F)";
            LOCATION_HUM_VALUE.textContent = data.currentWeather.current.relative_humidity_2m + data.currentWeather.current_units.relative_humidity_2m;
            LOCATION_WIND_VALUE.textContent = data.currentWeather.current.wind_speed_10m + data.currentWeather.current_units.wind_speed_10m;
            LOCATION_VIS_VALUE.textContent = data.currentWeather.current.visibility + data.currentWeather.current_units.visibility;
            LOCATION_PRESS_VALUE.textContent = data.currentWeather.current.pressure_msl + data.currentWeather.current_units.pressure_msl;

            sevenDaysForecast(data.sevenDaysForecast.daily);
            twentyFourHours(data.twentyFourHrForecast.hourly);
            
            console.log(data);
        } catch (error) {
            loader.style.display = "";
            sdf_loader.style.display = "";
            tfh_loader.style.display = "";
            first_grid.style.display = "none";
            console.error('Error fetching data:', error.message);
        }
    }
    getWeatherData();

    function sevenDaysForecast(data){
        const times = data.time;
        const maxTemps = data.temperature_2m_max;
        const minTemps = data.temperature_2m_min;
        const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        seven_days_forecast.innerHTML = "";

        days.forEach((day, i) => {
            const item = `
                <div class="bg-white/10 rounded-2xl p-4 text-center">
                    <div class="text-sm opacity-90 mb-2">${day}</div>
                    <i class="fas fa-cloud-sun text-3xl mb-2"></i>
                    <div class="text-xl font-semibold">${maxTemps[i]}°C (0°F)</div>
                    <div class="text-sm opacity-90">${minTemps[i]}°C (0°F)</div>
                </div>
            `;
            seven_days_forecast.insertAdjacentHTML('beforeend', item);
        });
    }

    function twentyFourHours(data){
        const data_time = data.time;
        const temps = data.temperature_2m;
        const times = ['9:00 AM', '12:00 PM', '3:00 PM', '6:00 PM', '9:00 PM', '12:00 AM', '3:00 AM', '6:00 AM'];

        twentyfour_hours_forecast.innerHTML = "";

        times.forEach((time, i) => {
            const item = `
                <div class="bg-white/10 rounded-2xl p-4 min-w-[100px] text-center flex-shrink-0">
                    <div class="text-sm opacity-90 mb-2">${time}</div>
                    <i class="fas fa-sun text-2xl mb-2"></i>
                    <div class="text-lg font-semibold">${temps[i]}°C (0°F)</div>
                </div>
            `;
            twentyfour_hours_forecast.insertAdjacentHTML('beforeend', item);
        });
    }

    function searchLocation(){
        document.getElementById('searchBtn').addEventListener('click', function() {
        const location = document.getElementById('locationInput').value;
            if (location) {
                console.log('Searching for:', location);
            }
        });
    }
    searchLocation();

    async function useCurrentLocation(){
        document.getElementById('currentLocationBtn').addEventListener('click', async function() {
            loader.style.display = "";
            sdf_loader.style.display = "";
            tfh_loader.style.display = "";
            first_grid.style.display = "none";
            seven_days_forecast.style.display = "none";
            twentyfour_hours_forecast.style.display = "none";

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    const locationData = {
                        latitude: lat,
                        longitude: lon
                    };

                    try {
                        const response = await axios.post('https://weatherapp.proj/my-current-location', locationData);
                        loader.style.display = "none";
                        sdf_loader.style.display = "none";
                        tfh_loader.style.display = "none";
                        first_grid.style.display = "";
                        seven_days_forecast.style.display = "";
                        twentyfour_hours_forecast.style.display = "";

                        const data = response.data;
                        LOCATION_NAME.textContent = `${data.locationDetails.results[0].name}, ${data.locationDetails.results[0].country}`;
                        LOCATION_TEMP_VALUE.textContent = data.currentWeather.current.temperature_2m + data.currentWeather.current_units.temperature_2m;
                        LOCATION_FAHR_VALUE.textContent = "(72°F)";
                        LOCATION_HUM_VALUE.textContent = data.currentWeather.current.relative_humidity_2m + data.currentWeather.current_units.relative_humidity_2m;
                        LOCATION_WIND_VALUE.textContent = data.currentWeather.current.wind_speed_10m + data.currentWeather.current_units.wind_speed_10m;
                        LOCATION_VIS_VALUE.textContent = data.currentWeather.current.visibility + data.currentWeather.current_units.visibility;
                        LOCATION_PRESS_VALUE.textContent = data.currentWeather.current.pressure_msl + data.currentWeather.current_units.pressure_msl;

                        sevenDaysForecast(data.sevenDaysForecast.daily);
                        twentyFourHours(data.twentyFourHrForecast.hourly);
                        
                        console.log('Use my current location: ', response.data);
                    } catch (error) {
                        loader.style.display = "";
                        sdf_loader.style.display = "";
                        tfh_loader.style.display = "";
                        first_grid.style.display = "none";
                        seven_days_forecast.style.display = "none";
                        twentyfour_hours_forecast.style.display = "none";
                        
                        console.error(error);
                    }
                    console.log('Use my Current location:', lat, lon);
                }, function(error) {
                    console.log('Geolocation not supported or permission denied.', error);
                });
            } else {
                console.log('Geolocation not supported by this browser.');
            }
        });
    }
    useCurrentLocation();
});