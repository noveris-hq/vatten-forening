document.addEventListener("DOMContentLoaded", function () {
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

    // Initialize map with default layer
    let map = L.map("map-container", {
        center: [mapCenter.lat, mapCenter.lng],
        zoom: 15,
        layers: [satellite], // Default to streets
        touchZoom: true,
    });
    // var markers = {!! json_encode($markers) !!};

    // Add layer control
    let baseMaps = {
        Streets: streets,
        Satellite: satellite,
    };

    L.control.layers(baseMaps).addTo(map);

    // Polyline coordinates (approximate - convert from static pixel coords)
    let polylineCoords = markers.map(function (marker) {
        return [marker?.lat, marker?.lng];
    });

    L.polyline(polylineCoords, {
        color: "#3b82f6",
        weight: 4,
        opacity: 0.8,
    }).addTo(map);

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
                // Find the marker and open popup
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
});
