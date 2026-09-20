// public/script.js

// Strict bounding box constraints for Ireland
var irishBounds = L.latLngBounds(
    [51.2, -10.8],
    [55.5, -5.3]
);

var isMobile = window.innerWidth < 768;
var initialZoom = isMobile ? 6 : 7;

var map = L.map('map', {
    center: [53.4129, -8.2439],
    zoom: initialZoom,
    minZoom: 5,
    maxZoom: 12,
    maxBounds: irishBounds,
    maxBoundsViscosity: 1.0
});

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

// Pull data safely from the global window variable defined in Blade
var cities = window.irishWeatherData || [];

cities.forEach(function(city) {
    let borderColor = '#10b981';
    let textColor = '#047857';
    if (city.temp <= 8) {
        borderColor = '#0284c7';
        textColor = '#0369a1';
    } else if (city.temp >= 16) {
        borderColor = '#d97706';
        textColor = '#b45309';
    }

    let weatherIcon = city.icon || '⛅';
    let conditionText = city.condition || city.description || '';
    conditionText = conditionText.charAt(0).toUpperCase() + conditionText.slice(1);

    // Enlarged, highly readable map marker layout
    var customIcon = L.divIcon({
        className: 'custom-weather-marker',
        html: `<div style="background: white; border-color: ${borderColor}; color: ${textColor}; display: flex; align-items: center; gap: 8px; padding: 6px 12px; border-radius: 9999px; border-width: 3px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); white-space: nowrap; transform: translate(-50%, -50%);">
                 <span style="font-size: 20px; line-height: 1;">${weatherIcon}</span>
                 <span style="font-weight: 800; font-size: 14px; color: #1e293b;">${city.name}</span>
                 <span style="background: ${borderColor}; color: white; padding: 3px 9px; border-radius: 9999px; font-weight: 900; font-size: 13px;">${city.temp}°C</span>
               </div>`,
        iconSize: [140, 42],
        iconAnchor: [70, 21]
    });

    var marker = L.marker([city.lat, city.lon], { icon: customIcon }).addTo(map);

    // Enlarged, clean popup content
    marker.bindPopup(`
        <div style="text-align: center; font-family: sans-serif; padding: 6px;">
            <strong style="font-size: 1.25rem; color: #0f172a;">${city.name}</strong><br>
            <div style="font-size: 1.8rem; margin: 6px 0;">${weatherIcon} <span style="font-weight: 900; color: ${textColor};">${city.temp}°C</span></div>
            <span style="text-transform: capitalize; color: #475569; font-size: 14px; font-weight: 700;">${conditionText}</span><br>
            <div style="margin-top: 8px; font-size: 12px; color: #334155; border-top: 1px solid #cbd5e1; padding-top: 6px; font-weight: 600;">
                Wind: ${city.wind} m/s &nbsp;|&nbsp; Humidity: ${city.humidity}%
            </div>
        </div>
    `);
});