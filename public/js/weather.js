document.addEventListener('DOMContentLoaded', () => {
    const LOCATION_NAME        = document.getElementById('location-name');
    const LOCATION_TEMP_VALUE  = document.getElementById('location-temp-value');
    const LOCATION_FAHR_VALUE  = document.getElementById('location-fahr-value');
    const LOCATION_HUM_VALUE   = document.getElementById('location-hum-value');
    const LOCATION_WIND_VALUE  = document.getElementById('location-wind-value');
    const LOCATION_VIS_VALUE   = document.getElementById('location-vis-value');
    const LOCATION_PRESS_VALUE = document.getElementById('location-press-value');
    
    let loader     = document.getElementById('loader');
    let first_grid = document.getElementById('first-grid');

    async function getWeatherData() {
        try {
            const response = await fetch('https://weatherapp.proj/api/weather');
            if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
            }
            loader.style.display = "none";
            first_grid.style.display = "";
            
            const data = await response.json();
            LOCATION_NAME.textContent = `${data.locationDetails.results[0].name}, ${data.locationDetails.results[0].country}`;
            LOCATION_TEMP_VALUE.textContent = data.currentWeather.current.temperature_2m + data.currentWeather.current_units.temperature_2m;
            LOCATION_FAHR_VALUE.textContent = "(72°F)";
            LOCATION_HUM_VALUE.textContent = data.currentWeather.current.relative_humidity_2m + data.currentWeather.current_units.relative_humidity_2m;
            LOCATION_WIND_VALUE.textContent = data.currentWeather.current.wind_speed_10m + data.currentWeather.current_units.wind_speed_10m;
            LOCATION_VIS_VALUE.textContent = data.currentWeather.current.visibility + data.currentWeather.current_units.visibility;
            LOCATION_PRESS_VALUE.textContent = data.currentWeather.current.pressure_msl + data.currentWeather.current_units.pressure_msl;
            
            console.log(data);
        } catch (error) {
            loader.style.display = "";
            first_grid.style.display = "none";
            console.error('Error fetching data:', error.message);
        }
    }
getWeatherData();
});

document.getElementById('searchBtn').addEventListener('click', function() {
    const location = document.getElementById('locationInput').value;
    if (location) {
        console.log('Searching for:', location);
    }
});

document.getElementById('currentLocationBtn').addEventListener('click', function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            console.log('Current location:', lat, lon);
        }, function(error) {
            alert('Geolocation not supported or permission denied.');
        });
    } else {
        alert('Geolocation not supported by this browser.');
    }
});