document.addEventListener("DOMContentLoaded", function () {
    // Check if this is the main map page (with map-container) or coordinate picker page
    const mainMapContainer = document.getElementById("map-container");
    const coordinatePickerMap = document.getElementById(
        "coordinate-picker-map",
    );

    // Only initialize main map if map-container exists
    if (mainMapContainer && window.mapData) {
        initializeMainMap();
    }

    // Initialize coordinate picker if it exists
    if (coordinatePickerMap) {
        initializeCoordinatePicker();
    }
});

function initializeMainMap() {
    let { markers, mapCenter } = window.mapData || {};

    // Define tile layers
    let streets = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: "© OpenStreetMap contributors",
        },
    );

    let satellite = L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            attribution:
                "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
        },
    );

    // Initialize main map with default layer
    let map = L.map("map-container", {
        center: [mapCenter.lat, mapCenter.lng],
        zoom: 15,
        layers: [satellite],
        touchZoom: true,
        scrollWheelZoom: false,
        doubleClickZoom: true,
        boxZoom: false,
        keyboard: false,
        dragging: true,
    });

    // Add layer control
    let baseMaps = {
        Streets: streets,
        Satellite: satellite,
    };

    L.control.layers(baseMaps).addTo(map);

    // Polyline coordinates (approximate - convert from static pixel coords)
    // let polylineCoords = markers.map(function (marker) {
    //     return [marker?.lat, marker?.lng];
    // });
    //
    // L.polyline(polylineCoords, {
    //     color: "#3b82f6",
    //     weight: 4,
    //     opacity: 0.8,
    // }).addTo(map);

    // Markers with popup data
    markers = markers.map((marker) => ({
        lat: parseFloat(marker.lat),
        lng: parseFloat(marker.lng),
        name: marker.name,
        address: marker.street_name,
        property: marker.property_number,
        position: marker.location_description,
        is_open: marker.is_open,
    }));

    // Table row click handlers
    document.querySelectorAll("tbody tr").forEach(function (row, index) {
        row.addEventListener("click", function () {
            if (markers[index]) {
                map.setView([markers[index].lat, markers[index].lng], 18);
                // Find marker and open popup
                map.eachLayer(function (layer) {
                    if (
                        layer instanceof L.Marker &&
                        layer
                            .getLatLng()
                            .equals(
                                L.latLng(
                                    markers[index].lat,
                                    markers[index].lng,
                                ),
                            )
                    ) {
                        layer.openPopup();
                    }
                });
            }
        });
    });

    // Apply custom icon to markers
    markers.forEach(function (markerData) {
        // Determine icon based on is_open
        let iconHtml = markerData.is_open
            ? '<div style="background-color: #3b82f6; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>'
            : '<div style="background-color: #ef4444; width: 24px; height: 24px; border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.3);"></div>';

        let customIcon = L.divIcon({
            className: "custom-valve-icon",
            html: iconHtml,
            iconSize: [24, 24],
            iconAnchor: [12, 12],
        });

        L.marker([markerData.lat, markerData.lng], {
            icon: customIcon,
        }).addTo(map).bindPopup(`<div class="min-w-[200px]">
            <p class="font-semibold text-foreground">${markerData.name}</p>
            <p class="text-sm text-muted-foreground">${markerData.address}</p>
            <div class="mt-2 space-y-1">
                <p class="text-xs"><span class="font-medium">Fastighet:</span> ${markerData.property || "N/A"}</p>
                <p class="text-xs"><span class="font-medium">Avstängare:</span> ${markerData.position}</p>
                <p class="text-xs"><span class="font-medium">Status:</span> ${markerData.is_open ? "Öppen" : "Stängd"}</p>
            </div>
        </div>`);
    });
}

function initializeCoordinatePicker() {
    const mapContainer = document.getElementById("coordinate-picker-map");
    if (!mapContainer) return;

    // Get current coordinates from data attributes or form inputs
    const currentLat =
        parseFloat(mapContainer.dataset.currentLat) ||
        parseFloat(document.getElementById("latitude")?.value) ||
        64.330775;
    const currentLng =
        parseFloat(mapContainer.dataset.currentLng) ||
        parseFloat(document.getElementById("longitude")?.value) ||
        15.723076;

    // Define tile layers for picker map
    let streets = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: "© OpenStreetMap contributors",
        },
    );

    let satellite = L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            attribution:
                "Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community",
        },
    );

    // Initialize picker map
    let pickerMap = L.map(mapContainer, {
        center: [currentLat, currentLng],
        zoom: 16,
        layers: [satellite],
        touchZoom: true,
    });

    // Add layer control
    let baseMaps = {
        Streets: streets,
        Satellite: satellite,
    };

    L.control.layers(baseMaps).addTo(pickerMap);

    // Current position marker
    let currentMarker = L.marker([currentLat, currentLng], {
        draggable: true,
    }).addTo(pickerMap);

    // Update form inputs when marker is dragged
    currentMarker.on("dragend", function (e) {
        const position = e.target.getLatLng();
        updateCoordinateInputs(position.lat, position.lng);
    });

    // Update form inputs when map is clicked
    pickerMap.on("click", function (e) {
        const position = e.latlng;
        currentMarker.setLatLng(position);
        updateCoordinateInputs(position.lat, position.lng);
    });

    // Update marker position when form inputs change
    const latInput = document.getElementById("latitude");
    const lngInput = document.getElementById("longitude");

    if (latInput && lngInput) {
        latInput.addEventListener("input", function () {
            const lat = parseFloat(this.value);
            const lng = parseFloat(lngInput.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                currentMarker.setLatLng([lat, lng]);
                pickerMap.setView([lat, lng]);
            }
        });

        lngInput.addEventListener("input", function () {
            const lat = parseFloat(latInput.value);
            const lng = parseFloat(this.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                currentMarker.setLatLng([lat, lng]);
                pickerMap.setView([lat, lng]);
            }
        });
    }

    function updateCoordinateInputs(lat, lng) {
        const latInput = document.getElementById("latitude");
        const lngInput = document.getElementById("longitude");

        if (latInput) {
            latInput.value = lat.toFixed(6);
        }
        if (lngInput) {
            lngInput.value = lng.toFixed(6);
        }
    }
}
