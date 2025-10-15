@extends('layouts.app')

@section('title', 'Peta UMK - ' . $model->id)
@section('subtitle', 'Menampilkan peta lokasi permohonan')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section with Gradient -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Peta UMK #{{ $model->id }}</h1>
                    <p class="text-sm text-white/90 mb-4">Menampilkan peta lokasi permohonan</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">View Only</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map text-xs"></i>
                            <span class="text-xs">{{ $model->alamat_tanah ?? 'Lokasi tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-map text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('member.kkprnon.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
        <a href="{{ route('member.kkprnon.show', $model->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
            <i class="fas fa-eye mr-2"></i>
            Lihat Detail
        </a>
    </div>

    <!-- Map Section -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg border border-white/20">
        <div class="flex items-center space-x-3 mb-6">
            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center">
                <i class="fas fa-map text-white text-sm"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-900">Peta Lokasi Permohonan</h3>
        </div>

        <!-- Map Container -->
        <div class="relative">
            <div id="mapKu" style="width: 100%; height: 70vh; border-radius: 0.5rem; border: 1px solid #e5e7eb;"></div>
            
            <!-- Map Info Overlay -->
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm rounded-lg p-4 shadow-lg border border-gray-200">
                <div class="text-sm space-y-2">
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                        <span class="text-gray-700">Area Permohonan</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        <span class="text-gray-700">Lokasi Marker</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css" />

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Peta page initialized for UMK #{{ $model->id }}');
        
        // Initialize Map
        initMap();
        
        // Load KML file directly from berkas/id/kml folder
        @if(isset($model))
            loadKMLFromFolder();
        @endif
        
        // Staggered animation for cards
        const cards = document.querySelectorAll('.bg-white\\/80, .bg-gradient-to-br');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });

    // Initialize Leaflet Map (View Only)
    function initMap() {
        // Initialize map centered on Banyuwangi
        const map = L.map('mapKu').setView([-8.2191, 114.3691], 10);
        
        // Add multiple tile layers
        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        });
        
        const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '© Esri'
        });
        
        // Add base layers
        const baseLayers = {
            "OpenStreetMap": osmLayer,
            "Satellite": satelliteLayer
        };
        
        osmLayer.addTo(map);
        
        // Add layer control
        L.control.layers(baseLayers).addTo(map);

        // Store map reference globally
        window.kkprMap = map;
        window.kkprMarkers = [];
        window.kkprPolygon = null;
        
        console.log('Map initialized successfully');
    }

    // Load KML file directly from berkas/id/kml folder
    function loadKMLFromFolder() {
        setTimeout(function() {
            if(window.kkprMap) {
                // Try to load KML file first - using kkpr_non path for UMK
                const kmlPath = '{{ url("uploads/berkas/kkpr_non/" . $model->id . "/kml/kml.kml") }}';
                
                fetch(kmlPath)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('KML file not found');
                        }
                        return response.text();
                    })
                    .then(kmlText => {
                        console.log('Loading KML file from folder...');
                        
                        // Convert KML to GeoJSON and display
                        const geoJsonData = convertKMLToGeoJSONManual(kmlText);
                        console.log('KML converted to GeoJSON:', geoJsonData);
                        
                        if (geoJsonData && geoJsonData.features && geoJsonData.features.length > 0) {
                            // Create Leaflet layers from GeoJSON
                            const geoJsonLayer = L.geoJSON(geoJsonData, {
                                style: function(feature) {
                                    if (feature.geometry.type === 'LineString') {
                                        return { color: '#DC2626', weight: 4, opacity: 0.8 };
                                    } else {
                                        return { color: '#DC2626', weight: 4, fillColor: '#DC2626', fillOpacity: 0.3 };
                                    }
                                },
                                onEachFeature: function(feature, layer) {
                                    window.kkprPolygon = layer;
                                    let popupContent = `<strong>Geometry Type:</strong> ${feature.geometry.type}`;
                                    if (feature.properties && feature.properties.name) {
                                        popupContent += `<br><strong>Name:</strong> ${feature.properties.name}`;
                                    }
                                    popupContent += `<br><strong>UMK ID:</strong> {{ $model->id }}`;
                                    layer.bindPopup(popupContent);
                                }
                            });
                            
                            window.kkprMap.addLayer(geoJsonLayer);
                            if (geoJsonLayer.getBounds) {
                                window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                            }
                            console.log('KML loaded successfully from folder');
                        } else {
                            console.log('No valid geometry found in KML');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading KML from folder:', error);
                        // Try to load GeoJSON as fallback
                        loadExistingGeoJSONFromFolder();
                    });
            }
        }, 1000);
    }

    // Load GeoJSON file directly from berkas/id/kml folder as fallback
    function loadExistingGeoJSONFromFolder() {
        const geoJsonPath = '{{ url("uploads/berkas/kkpr_non/" . $model->id . "/kml/geojson.geojson") }}';
        
        fetch(geoJsonPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error('GeoJSON file not found');
                }
                return response.text();
            })
            .then(geoJsonText => {
                console.log('Loading GeoJSON file from folder...');
                const geoJsonData = JSON.parse(geoJsonText);
                
                const geoJsonLayer = L.geoJSON(geoJsonData, {
                    style: function(feature) {
                        return {
                            color: '#DC2626',
                            weight: 4,
                            fillColor: '#DC2626',
                            fillOpacity: 0.3
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        window.kkprPolygon = layer;
                        let popupContent = `<strong>Geometry Type:</strong> ${feature.geometry.type}`;
                        if (feature.properties && feature.properties.name) {
                            popupContent += `<br><strong>Name:</strong> ${feature.properties.name}`;
                        }
                        popupContent += `<br><strong>UMK ID:</strong> {{ $model->id }}`;
                        layer.bindPopup(popupContent);
                    }
                });
                
                window.kkprMap.addLayer(geoJsonLayer);
                if (geoJsonLayer.getBounds) {
                    window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                }
                console.log('GeoJSON loaded successfully from folder');
            })
            .catch(error => {
                console.error('Error loading GeoJSON from folder:', error);
            });
    }

    // Load existing coordinates from database
    function loadExistingCoordinates() {
        setTimeout(function() {
            if(window.kkprMap) {
                const coordinates = @json($model->kkpr_koordinat->where('jenis', 'UMK')->map(function($k) { return [$k->lati, $k->longi]; }));
                
                if(coordinates.length > 0) {
                    const latLngs = coordinates.map(coord => L.latLng(coord[0], coord[1]));
                    const polygon = L.polygon(latLngs, {
                        color: '#DC2626',
                        weight: 4,
                        fillColor: '#DC2626',
                        fillOpacity: 0.3
                    }).addTo(window.kkprMap);
                    
                    window.kkprPolygon = polygon;
                    window.kkprMap.fitBounds(polygon.getBounds());
                    
                    // Add popup
                    const popupContent = `
                        <div class="text-center">
                            <strong>Area UMK #{{ $model->id }}</strong><br>
                            <i>Koordinat dari Database</i><br>
                            <small>${coordinates.length} titik koordinat</small>
                        </div>
                    `;
                    polygon.bindPopup(popupContent);
                    
                    console.log('Existing coordinates loaded successfully');
                }
            }
        }, 1000);
    }

    // Load existing KML from GeoJSON
    function loadExistingKML() {
        const geoJsonPath = '{{ url("uploads/berkas/kkpr_non/" . $model->id . "/kml/" . ($model->f_geojson ?? "")) }}';
        
        fetch(geoJsonPath)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(geoJsonText => {
                console.log('Loading existing GeoJSON file...');
                const geoJsonData = JSON.parse(geoJsonText);
                
                const geoJsonLayer = L.geoJSON(geoJsonData, {
                    style: function(feature) {
                        return {
                            color: '#DC2626',
                            weight: 4,
                            fillColor: '#DC2626',
                            fillOpacity: 0.3
                        };
                    },
                    onEachFeature: function(feature, layer) {
                        window.kkprPolygon = layer;
                        
                        // Add popup with geometry info
                        let popupContent = `<strong>Geometry Type:</strong> ${feature.geometry.type}`;
                        if (feature.properties && feature.properties.name) {
                            popupContent += `<br><strong>Name:</strong> ${feature.properties.name}`;
                        }
                        popupContent += `<br><strong>UMK ID:</strong> {{ $model->id }}`;
                        layer.bindPopup(popupContent);
                    }
                });
                
                window.kkprMap.addLayer(geoJsonLayer);
                
                // Fit map to layer bounds
                if (geoJsonLayer.getBounds) {
                    window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                }
                
                console.log('Existing GeoJSON loaded successfully');
            })
            .catch(error => {
                console.error('Error loading existing GeoJSON:', error);
                console.log('Trying to load KML file instead...');
                loadExistingKMLFromKML();
            });
    }

    // Load existing KML file and convert to GeoJSON
    function loadExistingKMLFromKML() {
        @if(isset($model) && $model->f_kml)
            const kmlPath = '{{ asset("uploads/berkas/kkpr_non/".$model->id."/kml/".$model->f_kml) }}';
            
            fetch(kmlPath)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(kmlText => {
                    console.log('Loading existing KML file...');
                    
                    // Simple KML to GeoJSON conversion for basic polygons
                    const geoJsonData = convertKMLToGeoJSONManual(kmlText);
                    console.log('KML converted to GeoJSON:', geoJsonData);
                    
                    if (geoJsonData && geoJsonData.features && geoJsonData.features.length > 0) {
                        // Create Leaflet layers from GeoJSON
                        const geoJsonLayer = L.geoJSON(geoJsonData, {
                            style: function(feature) {
                                if (feature.geometry.type === 'LineString') {
                                    return { color: '#DC2626', weight: 4, opacity: 0.8 };
                                } else {
                                    return { color: '#DC2626', weight: 4, fillColor: '#DC2626', fillOpacity: 0.3 };
                                }
                            },
                            onEachFeature: function(feature, layer) {
                                window.kkprPolygon = layer;
                                let popupContent = `<strong>Geometry Type:</strong> ${feature.geometry.type}`;
                                if (feature.properties && feature.properties.name) {
                                    popupContent += `<br><strong>Name:</strong> ${feature.properties.name}`;
                                }
                                popupContent += `<br><strong>UMK ID:</strong> {{ $model->id }}`;
                                layer.bindPopup(popupContent);
                            }
                        });
                        
                        window.kkprMap.addLayer(geoJsonLayer);
                        if (geoJsonLayer.getBounds) {
                            window.kkprMap.fitBounds(geoJsonLayer.getBounds());
                        }
                        console.log('Existing KML loaded successfully');
                    } else {
                        console.log('No valid geometry found in KML');
                    }
                })
                .catch(error => {
                    console.error('Error loading existing KML:', error);
                });
        @else
            console.log('No KML file found for this UMK record');
        @endif
    }

    // Simple KML to GeoJSON conversion function
    function convertKMLToGeoJSONManual(kmlText) {
        try {
            const parser = new DOMParser();
            const kmlDoc = parser.parseFromString(kmlText, 'text/xml');
            
            const features = [];
            const polygons = kmlDoc.querySelectorAll('Polygon');
            const lines = kmlDoc.querySelectorAll('LineString');
            const points = kmlDoc.querySelectorAll('Point');
            
            // Process polygons
            polygons.forEach((polygon, index) => {
                const coords = polygon.querySelector('coordinates');
                if (coords && coords.textContent) {
                    const coordPairs = coords.textContent.trim().split(/\s+/);
                    const coordinates = coordPairs.map(pair => {
                        const [lng, lat, alt] = pair.split(',');
                        return [parseFloat(lng), parseFloat(lat)]; // GeoJSON format: [lng, lat]
                    }).filter(coord => !isNaN(coord[0]) && !isNaN(coord[1]));
                    
                    if (coordinates.length >= 3) {
                        features.push({
                            type: "Feature",
                            properties: { name: `Polygon ${index + 1}` },
                            geometry: {
                                type: "Polygon",
                                coordinates: [coordinates]
                            }
                        });
                    }
                }
            });
            
            // Process lines
            lines.forEach((line, index) => {
                const coords = line.querySelector('coordinates');
                if (coords && coords.textContent) {
                    const coordPairs = coords.textContent.trim().split(/\s+/);
                    const coordinates = coordPairs.map(pair => {
                        const [lng, lat, alt] = pair.split(',');
                        return [parseFloat(lng), parseFloat(lat)]; // GeoJSON format: [lng, lat]
                    }).filter(coord => !isNaN(coord[0]) && !isNaN(coord[1]));
                    
                    if (coordinates.length >= 2) {
                        features.push({
                            type: "Feature",
                            properties: { name: `Line ${index + 1}` },
                            geometry: {
                                type: "LineString",
                                coordinates: coordinates
                            }
                        });
                    }
                }
            });
            
            // Process points
            points.forEach((point, index) => {
                const coords = point.querySelector('coordinates');
                if (coords && coords.textContent) {
                    const [lng, lat, alt] = coords.textContent.trim().split(',');
                    const latNum = parseFloat(lat);
                    const lngNum = parseFloat(lng);
                    
                    if (!isNaN(latNum) && !isNaN(lngNum)) {
                        features.push({
                            type: "Feature",
                            properties: { name: `Point ${index + 1}` },
                            geometry: {
                                type: "Point",
                                coordinates: [lngNum, latNum]
                            }
                        });
                    }
                }
            });
            
            return {
                type: "FeatureCollection",
                features: features
            };
        } catch (error) {
            console.error('Error converting KML to GeoJSON:', error);
            return { type: "FeatureCollection", features: [] };
        }
    }
</script>
@endsection
