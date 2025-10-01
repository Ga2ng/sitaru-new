@extends('layouts.app')

@section('title', 'Peta Persebaran')
@section('subtitle', 'Visualisasi peta wilayah dan persebaran data')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#185B3C] via-[#0F3D26] to-[#185B3C] rounded-xl p-6 text-white">
        <div class="absolute inset-0 bg-black/10"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">Peta Persebaran</h1>
                    <p class="text-sm text-white/90 mb-4">Visualisasi peta wilayah dan persebaran data KKPR & UMK</p>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span class="text-xs">Sistem Aktif</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-map text-xs"></i>
                            <span class="text-xs">Interactive Map</span>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-map-marked-alt text-3xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-12 -translate-x-12"></div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-yellow-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-store text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-yellow-600">{{ $umk->count() }}</p>
                        <p class="text-xs text-gray-500">Lokasi</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">UMK (Persetujuan Bagi UMK)</h3>
                <div class="flex items-center text-xs text-yellow-600">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <span>Dengan data geolokasi</span>
                </div>
            </div>
        </div>
        
        <div class="group relative overflow-hidden bg-white/80 backdrop-blur-sm rounded-xl p-4 shadow-lg border border-white/20 hover:shadow-xl transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-green-500/5 to-transparent"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-file-alt text-white text-sm"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-2xl font-bold text-green-600">{{ $kkpr->count() }}</p>
                        <p class="text-xs text-gray-500">Lokasi</p>
                    </div>
                </div>
                <h3 class="text-sm font-semibold text-gray-900 mb-1">KKPR Non Berusaha</h3>
                <div class="flex items-center text-xs text-green-600">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    <span>Dengan data geolokasi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Container -->
    <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 overflow-hidden">
        <!-- Map Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-gradient-to-br from-[#185B3C] to-[#0F3D26] rounded-lg flex items-center justify-center">
                        <i class="fas fa-map text-white text-sm"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Peta Interaktif</h3>
                        <p class="text-sm text-gray-600">Klik pada area untuk melihat informasi detail</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="resetMapView()" class="flex items-center px-3 py-2 text-sm text-gray-600 hover:text-gray-900 hover:bg-white/80 rounded-lg transition-colors">
                        <i class="fas fa-redo mr-1 text-xs"></i>
                        Reset View
                    </button>
                </div>
            </div>
        </div>

        <!-- Map Content -->
        <div class="p-6">
            <div id="map" class="w-full rounded-xl border border-gray-200 shadow-inner" style="height: 70vh; min-height: 500px;"></div>
        </div>

        <!-- Map Legend -->
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-t border-gray-200">
            <h4 class="text-sm font-bold text-gray-900 mb-3">Legenda:</h4>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-yellow-500 rounded"></div>
                    <span class="text-xs text-gray-700">UMK</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-green-500 rounded"></div>
                    <span class="text-xs text-gray-700">KKPR Non Berusaha</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-purple-300 rounded"></div>
                    <span class="text-xs text-gray-700">Batas Kecamatan</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 bg-blue-300 rounded"></div>
                    <span class="text-xs text-gray-700">Pola Ruang</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                <i class="fas fa-info-circle text-blue-600 text-sm"></i>
            </div>
            <div>
                <h4 class="font-bold text-blue-900 mb-1">Tips Menggunakan Peta:</h4>
                <ul class="text-sm text-blue-700 space-y-1">
                    <li>• Gunakan kontrol layer di pojok kanan atas untuk mengubah basemap dan layer</li>
                    <li>• Klik pada area berwarna untuk melihat informasi detail</li>
                    <li>• Gunakan mouse scroll untuk zoom in/out</li>
                    <li>• Gunakan search box untuk mencari lokasi spesifik</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.3.2/dist/geosearch.css" />

<style>
    .info2 {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        width: 190px;
    }

    .info2 h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .leaflet-control-layers {
        max-height: 500px;
        overflow-y: auto;
    }

    .leaflet-popup-content {
        margin: 10px;
    }

    .leaflet-popup-content table {
        width: 100%;
        font-size: 12px;
    }

    .leaflet-popup-content table td {
        padding: 4px;
    }
</style>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="{{ url('/') }}/plugins/leaflet/layer/tile/Bing.js"></script>
<script src="https://unpkg.com/leaflet.vectorgrid@latest/dist/Leaflet.VectorGrid.bundled.js"></script>
<script src="https://unpkg.com/leaflet-geosearch@3.3.2/dist/geosearch.umd.js"></script>

<!-- GeoJSON Data -->
<script type="text/javascript" src="{{ url('/') }}/mapdata/R2.js"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/BATAS_KECAMATAN.js') }}"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/POLA_RUANG_BWI.js') }}"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/POLA_RUANG_KETAPANG.js') }}"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/LAND_USE.js') }}"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/LSD_BANYUWANGI.js') }}"></script>
<script type="text/javascript" src="{{ asset('mapdata/newgeo/RDTR_GLAGAH_GIRI.js') }}"></script>

<script type="text/javascript">
    var map = L.map('map').setView([-8.218079, 114.3290605], 13.6);
    map.setMaxZoom(22);
    
    var apiKey = 'AhvKoRFjoR5zfR1MPp51Tr745VT1OMnLgK5fv6QQ92_cgmq0RWnMSoThs1tL4hXC';
    var opacity = 1;

    var defaults = {
        key: apiKey,
        detectRetina: true
    };

    var baseLayers = {};
    ['Aerial', 'AerialWithLabels', 'RoadOnDemand'].forEach(function(imagerySet) {
        baseLayers[imagerySet] = L.bingLayer(L.extend({
            imagerySet: imagerySet
        }, defaults));
    });

    // Feature Groups
    var batas_kecamatan = L.featureGroup().addTo(map);
    var polru_bwi = L.featureGroup();
    var polru_ktpg = L.featureGroup();
    var land_use = L.featureGroup();
    var lsd = L.featureGroup();
    var rdtr = L.featureGroup();
    var myUmk = L.featureGroup().addTo(map);
    var myKkpr = L.featureGroup().addTo(map);

    // ======== KECAMATAN ===========
    var highlightKec;
    var clearHighlightKec = function() {
        if (highlightKec) {
            vectorKec.resetFeatureStyle(highlightKec);
        }
        highlightKec = null;
    };
    var vectorKec = L.vectorGrid.slicer(mykecamatan, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                return {
                    fillColor: '#d58df0',
                    fillOpacity: 0.5,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.Kecamatan;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightKec();
        highlightKec = properties.Kecamatan;
        var style = {
            fillColor: '#d58df0',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            opacity: 0.2,
            weight: 2,
        };
        map.closePopup();
        vectorKec.setFeatureStyle(properties.Kecamatan, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <td><strong>Kecamatan</strong></td>
                                <td>${properties.Kecamatan}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightKec();
        highlightKec = properties.Kecamatan;
        var style = {
            fillColor: '#d58df0',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            weight: 2,
        };
        vectorKec.setFeatureStyle(properties.Kecamatan, style);
        L.DomEvent.stopPropagation(e);
    });
    batas_kecamatan.addLayer(vectorKec);
    map.on('click', clearHighlightKec);

    // ======= BWI ==========
    var highlightBwi;
    var clearHighlightBwi = function() {
        if (highlightBwi) {
            vectorBwi.resetFeatureStyle(highlightBwi);
        }
        highlightBwi = null;
    };
    var vectorBwi = L.vectorGrid.slicer(my_polru_bwi, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                var p = properties.KODE_BARU;
                return {
                    fillColor: p == 'I-1' ? '#009900' :
                               p == 'I-4' ? '#666600' :
                               p == 'Jalan' ? '#990000' :
                               p == 'K-1' ? '#CC3300' :
                               p == 'K-3' ? '#FFCC00' :
                               p == 'KH-1' ? '#0033FF' :
                               p == 'KH-4' ? '#00CCCC' :
                               p == 'KT-1' ? '#666699' :
                               p == 'KT-2' ? '#993366' :
                               p == 'PL-1' ? '#CC0099' :
                               p == 'PL-3' ? '#CC66CC' :
                               p == 'PS-1' ? '#CCCCFF' :
                               p == 'PS-2' ? '#CCFFFF' :
                               p == 'R-2' ? '#6699CC' :
                               p == 'R-3' ? '#66CCCC' :
                               p == 'R-4' ? '#66FFCC' :
                               p == 'RTH-1' ? '#9933CC' :
                               p == 'RTH-2' ? '#9966CC' :
                               p == 'RTH-3' ? '#99CCCC' :
                               p == 'RTH-4' ? '#CC00CC' :
                               p == 'SC' ? '#CC0099' :
                               p == 'SPU 2-2' ? '#663399' :
                               p == 'SPU-1' ? '#CC9933' :
                               p == 'SPU-2' ? '#CCCC33' :
                               p == 'SPU-3' ? '#CCFF33' :
                               p == 'SPU-4' ? '#FF0033' :
                               p == 'SPU-5' ? '#FF3333' :
                               p == 'SPU-6' ? '#FF6633' :
                               p == 'Sungai' ? '#660033' : '#FFFFCC',
                    fillOpacity: 0.5,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.KODE_BARU;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightBwi();
        highlightBwi = properties.KODE_BARU;
        var p = properties.KODE_BARU;
        var style = {
            fillColor: p == 'I-1' ? '#009900' :
                       p == 'I-4' ? '#666600' :
                       p == 'Jalan' ? '#990000' :
                       p == 'K-1' ? '#CC3300' :
                       p == 'K-3' ? '#FFCC00' :
                       p == 'KH-1' ? '#0033FF' :
                       p == 'KH-4' ? '#00CCCC' :
                       p == 'KT-1' ? '#666699' :
                       p == 'KT-2' ? '#993366' :
                       p == 'PL-1' ? '#CC0099' :
                       p == 'PL-3' ? '#CC66CC' :
                       p == 'PS-1' ? '#CCCCFF' :
                       p == 'PS-2' ? '#CCFFFF' :
                       p == 'R-2' ? '#6699CC' :
                       p == 'R-3' ? '#66CCCC' :
                       p == 'R-4' ? '#66FFCC' :
                       p == 'RTH-1' ? '#9933CC' :
                       p == 'RTH-2' ? '#9966CC' :
                       p == 'RTH-3' ? '#99CCCC' :
                       p == 'RTH-4' ? '#CC00CC' :
                       p == 'SC' ? '#CC0099' :
                       p == 'SPU 2-2' ? '#663399' :
                       p == 'SPU-1' ? '#CC9933' :
                       p == 'SPU-2' ? '#CCCC33' :
                       p == 'SPU-3' ? '#CCFF33' :
                       p == 'SPU-4' ? '#FF0033' :
                       p == 'SPU-5' ? '#FF3333' :
                       p == 'SPU-6' ? '#FF6633' :
                       p == 'Sungai' ? '#660033' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            opacity: 0.2,
            weight: 2,
        };
        map.closePopup();
        vectorBwi.setFeatureStyle(properties.KODE_BARU, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <th>ZONA BARU</th>
                                <td>${properties.ZONA_BARU}</td>
                            </tr>
                            <tr>
                                <th>KODE</th>
                                <td>${properties.KODE_BARU}</td>
                            </tr>
                            <tr>
                                <th>LABEL</th>
                                <td>${properties.LABEL}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightBwi();
        highlightBwi = properties.KODE_BARU;
        var p = properties.KODE_BARU;
        var style = {
            fillColor: p == 'I-1' ? '#009900' :
                       p == 'I-4' ? '#666600' :
                       p == 'Jalan' ? '#990000' :
                       p == 'K-1' ? '#CC3300' :
                       p == 'K-3' ? '#FFCC00' :
                       p == 'KH-1' ? '#0033FF' :
                       p == 'KH-4' ? '#00CCCC' :
                       p == 'KT-1' ? '#666699' :
                       p == 'KT-2' ? '#993366' :
                       p == 'PL-1' ? '#CC0099' :
                       p == 'PL-3' ? '#CC66CC' :
                       p == 'PS-1' ? '#CCCCFF' :
                       p == 'PS-2' ? '#CCFFFF' :
                       p == 'R-2' ? '#6699CC' :
                       p == 'R-3' ? '#66CCCC' :
                       p == 'R-4' ? '#66FFCC' :
                       p == 'RTH-1' ? '#9933CC' :
                       p == 'RTH-2' ? '#9966CC' :
                       p == 'RTH-3' ? '#99CCCC' :
                       p == 'RTH-4' ? '#CC00CC' :
                       p == 'SC' ? '#CC0099' :
                       p == 'SPU 2-2' ? '#663399' :
                       p == 'SPU-1' ? '#CC9933' :
                       p == 'SPU-2' ? '#CCCC33' :
                       p == 'SPU-3' ? '#CCFF33' :
                       p == 'SPU-4' ? '#FF0033' :
                       p == 'SPU-5' ? '#FF3333' :
                       p == 'SPU-6' ? '#FF6633' :
                       p == 'Sungai' ? '#660033' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            weight: 2,
        };
        vectorBwi.setFeatureStyle(properties.KODE_BARU, style);
        L.DomEvent.stopPropagation(e);
    });
    polru_bwi.addLayer(vectorBwi);
    map.on('click', clearHighlightBwi);

    // ============ Ketapang ==================
    var highlightKtpg;
    var clearHighlightKtpg = function() {
        if (highlightKtpg) {
            vectorKtpg.resetFeatureStyle(highlightKtpg);
        }
        highlightKtpg = null;
    };
    var vectorKtpg = L.vectorGrid.slicer(my_ketapang, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                var p = properties.kode;
                return {
                    fillColor: p == 'I-5' ? '#009900' :
                               p == 'I-6' ? '#666600' :
                               p == 'I-7' ? '#990000' :
                               p == 'K-4' ? '#CC3300' :
                               p == 'K-5' ? '#FFCC00' :
                               p == 'K-6' ? '#0033FF' :
                               p == 'KH-1' ? '#0033FF' :
                               p == 'KH-2' ? '#00FA9A' :
                               p == 'KH-3' ? '#66CDAA' :
                               p == 'KH-4' ? '#00CCCC' :
                               p == 'KH-5' ? '#AFEEEE' :
                               p == 'KH-6' ? '#CD853F' :
                               p == 'PL-1' ? '#CC0099' :
                               p == 'PL-4' ? '#9370DB' :
                               p == 'PS-1' ? '#CCCCFF' :
                               p == 'PS-2' ? '#CCFFFF' :
                               p == 'R-2' ? '#6699CC' :
                               p == 'R-3' ? '#66CCCC' :
                               p == 'R-4' ? '#66FFCC' :
                               p == 'RTH-1' ? '#9933CC' :
                               p == 'RTH-2' ? '#9966CC' :
                               p == 'RTH-3' ? '#99CCCC' :
                               p == 'RTH-4' ? '#CC00CC' :
                               p == 'SPU-1' ? '#CC9933' :
                               p == 'SPU-2' ? '#CCCC33' :
                               p == 'SPU-7' ? '#FFFF00' :
                               p == 'SPU-8' ? '#FF8C00' :
                               p == 'SPU-9' ? '#FF1493' : '#FFFFCC',
                    fillOpacity: 0.5,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.luas;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightKtpg();
        highlightKtpg = properties.luas;
        var p = properties.kode;
        var style = {
            fillColor: p == 'I-5' ? '#009900' :
                       p == 'I-6' ? '#666600' :
                       p == 'I-7' ? '#990000' :
                       p == 'K-4' ? '#CC3300' :
                       p == 'K-5' ? '#FFCC00' :
                       p == 'K-6' ? '#0033FF' :
                       p == 'KH-1' ? '#0033FF' :
                       p == 'KH-2' ? '#00FA9A' :
                       p == 'KH-3' ? '#66CDAA' :
                       p == 'KH-4' ? '#00CCCC' :
                       p == 'KH-5' ? '#AFEEEE' :
                       p == 'KH-6' ? '#CD853F' :
                       p == 'PL-1' ? '#CC0099' :
                       p == 'PL-4' ? '#9370DB' :
                       p == 'PS-1' ? '#CCCCFF' :
                       p == 'PS-2' ? '#CCFFFF' :
                       p == 'R-2' ? '#6699CC' :
                       p == 'R-3' ? '#66CCCC' :
                       p == 'R-4' ? '#66FFCC' :
                       p == 'RTH-1' ? '#9933CC' :
                       p == 'RTH-2' ? '#9966CC' :
                       p == 'RTH-3' ? '#99CCCC' :
                       p == 'RTH-4' ? '#CC00CC' :
                       p == 'SPU-1' ? '#CC9933' :
                       p == 'SPU-2' ? '#CCCC33' :
                       p == 'SPU-7' ? '#FFFF00' :
                       p == 'SPU-8' ? '#FF8C00' :
                       p == 'SPU-9' ? '#FF1493' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            opacity: 0.2,
            weight: 1,
        };
        map.closePopup();
        vectorKtpg.setFeatureStyle(properties.luas, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <th>RENCANA</th>
                                <td>${properties.rencana}</td>
                            </tr>
                            <tr>
                                <th>LUAS</th>
                                <td>${properties.luas}</td>
                            </tr>
                            <tr>
                                <th>KODE</th>
                                <td>${properties.kode}</td>
                            </tr>
                            <tr>
                                <th>BLOK</th>
                                <td>${properties.BLOK}</td>
                            </tr>
                            <tr>
                                <th>SUB BLOK</th>
                                <td>${properties.sub_blok}</td>
                            </tr>
                            <tr>
                                <th>PRIORITAS</th>
                                <td>${properties.Prioritas}</td>
                            </tr>
                            <tr>
                                <th>KAWASAN</th>
                                <td>${properties.Kawasan}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightKtpg();
        highlightKtpg = properties.luas;
        var p = properties.kode;
        var style = {
            fillColor: p == 'I-5' ? '#009900' :
                       p == 'I-6' ? '#666600' :
                       p == 'I-7' ? '#990000' :
                       p == 'K-4' ? '#CC3300' :
                       p == 'K-5' ? '#FFCC00' :
                       p == 'K-6' ? '#0033FF' :
                       p == 'KH-1' ? '#0033FF' :
                       p == 'KH-2' ? '#00FA9A' :
                       p == 'KH-3' ? '#66CDAA' :
                       p == 'KH-4' ? '#00CCCC' :
                       p == 'KH-5' ? '#AFEEEE' :
                       p == 'KH-6' ? '#CD853F' :
                       p == 'PL-1' ? '#CC0099' :
                       p == 'PL-4' ? '#9370DB' :
                       p == 'PS-1' ? '#CCCCFF' :
                       p == 'PS-2' ? '#CCFFFF' :
                       p == 'R-2' ? '#6699CC' :
                       p == 'R-3' ? '#66CCCC' :
                       p == 'R-4' ? '#66FFCC' :
                       p == 'RTH-1' ? '#9933CC' :
                       p == 'RTH-2' ? '#9966CC' :
                       p == 'RTH-3' ? '#99CCCC' :
                       p == 'RTH-4' ? '#CC00CC' :
                       p == 'SPU-1' ? '#CC9933' :
                       p == 'SPU-2' ? '#CCCC33' :
                       p == 'SPU-7' ? '#FFFF00' :
                       p == 'SPU-8' ? '#FF8C00' :
                       p == 'SPU-9' ? '#FF1493' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            weight: 1,
        };
        vectorKtpg.setFeatureStyle(properties.luas, style);
        L.DomEvent.stopPropagation(e);
    });
    polru_ktpg.addLayer(vectorKtpg);
    map.on('click', clearHighlightKtpg);

    //==================== Landuse =====================
    var highlightLanduse;
    var clearHighlightLanduse = function() {
        if (highlightLanduse) {
            vectorLanduse.resetFeatureStyle(highlightLanduse);
        }
        highlightLanduse = null;
    };
    var vectorLanduse = L.vectorGrid.slicer(my_landus, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                var p = properties.LAYER;
                return {
                    fillColor: p == 'LU perkebunan' ? '#6699CC' :
                               p == 'LU tanah ladang' ? '#66CCCC' :
                               p == 'LU semak belukar' ? '#66FFCC' :
                               p == 'LU tanah rawa' ? '#9933CC' :
                               p == 'LU sawah irigasi' ? '#9966CC' :
                               p == 'LU hutan lindung' ? '#99CCCC' :
                               p == 'LU padang rumput' ? '#CC00CC' :
                               p == 'LU hutan produksi' ? '#CC9933' :
                               p == 'LU pasir laut' ? '#CCCC33' :
                               p == 'LU sawah tadah hujan' ? '#FFFF00' :
                               p == 'LU tambak' ? '#FF8C00' :
                               p == 'LU danau' ? '#FF1493' :
                               p == 'LU tanggul pasir' ? '#CC0099' :
                               p == 'LU permukiman' ? '#9370DB' :
                               p == 'LU hutan konservasi' ? '#CCCCFF' :
                               p == 'LU perairan payau' ? '#CCFFFF' : '#FFFFCC',
                    fillOpacity: 0.8,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.Luas;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightLanduse();
        highlightLanduse = properties.Luas;
        var p = properties.LAYER;
        var style = {
            fillColor: p == 'LU perkebunan' ? '#6699CC' :
                       p == 'LU tanah ladang' ? '#66CCCC' :
                       p == 'LU semak belukar' ? '#66FFCC' :
                       p == 'LU tanah rawa' ? '#9933CC' :
                       p == 'LU sawah irigasi' ? '#9966CC' :
                       p == 'LU hutan lindung' ? '#99CCCC' :
                       p == 'LU padang rumput' ? '#CC00CC' :
                       p == 'LU hutan produksi' ? '#CC9933' :
                       p == 'LU pasir laut' ? '#CCCC33' :
                       p == 'LU sawah tadah hujan' ? '#FFFF00' :
                       p == 'LU tambak' ? '#FF8C00' :
                       p == 'LU danau' ? '#FF1493' :
                       p == 'LU tanggul pasir' ? '#CC0099' :
                       p == 'LU permukiman' ? '#9370DB' :
                       p == 'LU hutan konservasi' ? '#CCCCFF' :
                       p == 'LU perairan payau' ? '#CCFFFF' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'red',
            opacity: 0.2,
            weight: 1,
        };
        map.closePopup();
        vectorLanduse.setFeatureStyle(properties.Luas, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <th>LAYER</th>
                                <td>${properties.LAYER}</td>
                            </tr>
                            <tr>
                                <th>LUAS</th>
                                <td>${properties.Luas}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightLanduse();
        highlightLanduse = properties.Luas;
        var p = properties.LAYER;
        var style = {
            fillColor: p == 'LU perkebunan' ? '#6699CC' :
                       p == 'LU tanah ladang' ? '#66CCCC' :
                       p == 'LU semak belukar' ? '#66FFCC' :
                       p == 'LU tanah rawa' ? '#9933CC' :
                       p == 'LU sawah irigasi' ? '#9966CC' :
                       p == 'LU hutan lindung' ? '#99CCCC' :
                       p == 'LU padang rumput' ? '#CC00CC' :
                       p == 'LU hutan produksi' ? '#CC9933' :
                       p == 'LU pasir laut' ? '#CCCC33' :
                       p == 'LU sawah tadah hujan' ? '#FFFF00' :
                       p == 'LU tambak' ? '#FF8C00' :
                       p == 'LU danau' ? '#FF1493' :
                       p == 'LU tanggul pasir' ? '#CC0099' :
                       p == 'LU permukiman' ? '#9370DB' :
                       p == 'LU hutan konservasi' ? '#CCCCFF' :
                       p == 'LU perairan payau' ? '#CCFFFF' : '#FFFFCC',
            fillOpacity: 0.5,
            stroke: true,
            fill: true,
            color: 'red',
            weight: 1,
        };
        vectorLanduse.setFeatureStyle(properties.Luas, style);
        L.DomEvent.stopPropagation(e);
    });
    land_use.addLayer(vectorLanduse);
    map.on('click', clearHighlightLanduse);

    //========================= LSD ===============================
    var highlightLsd;
    var clearHighlightLSD = function() {
        if (highlightLsd) {
            vectorLsd.resetFeatureStyle(highlightLsd);
        }
        highlightLsd = null;
    };
    var vectorLsd = L.vectorGrid.slicer(mylsd, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                var p = properties.LSD;
                return {
                    fillColor: p == 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan' ? '#13a126' :
                               p == 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan' ? '#b6fc60' : '#d9faf4',
                    fillOpacity: 0.5,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.LUAS;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightLSD();
        highlightLsd = properties.LUAS;
        var p = properties.LSD;
        var style = {
            fillColor: p == 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan' ? '#13a126' :
                       p == 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan' ? '#b6fc60' : '#d9faf4',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'green',
            opacity: 0.2,
            weight: 1,
        };
        map.closePopup();
        vectorLsd.setFeatureStyle(properties.LUAS, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <th>LSD</th>
                                <td>${properties.LSD}</td>
                            </tr>
                            <tr>
                                <th>HUTAN</th>
                                <td>${properties.HUTAN}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightLSD();
        highlightLsd = properties.LUAS;
        var p = properties.LSD;
        var style = {
            fillColor: p == 'Lahan Sawah yang Dilindungi di Dalam Kawasan Hutan' ? '#13a126' :
                       p == 'Lahan Sawah yang Dilindungi di Luar Kawasan Hutan' ? '#b6fc60' : '#d9faf4',
            fillOpacity: 0.5,
            stroke: true,
            fill: true,
            color: 'green',
            weight: 1,
        };
        vectorLsd.setFeatureStyle(properties.LUAS, style);
        L.DomEvent.stopPropagation(e);
    });
    lsd.addLayer(vectorLsd);
    map.on('click', clearHighlightLSD);

    //========================= RDTR ===============================
    var highlightRdtr;
    var clearHighlightRDTR = function() {
        if (highlightRdtr) {
            vectorRdtr.resetFeatureStyle(highlightRdtr);
        }
        highlightRdtr = null;
    };
    var vectorRdtr = L.vectorGrid.slicer(myrdtr, {
        rendererFactory: L.svg.tile,
        vectorTileLayerStyles: {
            sliced: function(properties, zoom) {
                var p = properties.NAMOBJ;
                return {
                    fillColor: p == 'Badan Air' ? '#6699CC' :
                               p == 'Badan Jalan' ? '#66CCCC' :
                               p == 'Cagar Budaya' ? '#66FFCC' :
                               p == 'Hutan Lindung' ? '#9933CC' :
                               p == 'Hutan Produksi Tetap' ? '#9966CC' :
                               p == 'Kawasan Peruntukan Industri' ? '#99CCCC' :
                               p == 'Pariwisata' ? '#CC00CC' :
                               p == 'Pemakaman' ? '#CC9933' :
                               p == 'Perdagangan dan Jasa Skala SWP' ? '#CCCC33' :
                               p == 'Perdagangan dan Jasa Skala WP' ? '#FFFF00' :
                               p == 'Pergudangan' ? '#FF8C00' :
                               p == 'Perkantoran' ? '#FF1493' :
                               p == 'Perkebunan' ? '#CC0099' :
                               p == 'Perlindungan Setempat' ? '#9370DB' :
                               p == 'Pertahanan dan Keamanan' ? '#CCCCFF' :
                               p == 'Perumahan Kepadatan Rendah' ? '#00FFFF' :
                               p == 'Perumahan Kepadatan Sedang' ? '#008080' :
                               p == 'Peternakan' ? '#0000FF' :
                               p == 'SPU Skala Kecamatan' ? '#800080' :
                               p == 'SPU Skala Kelurahan' ? '#008000' :
                               p == 'Taman Kecamatan' ? '#000080' :
                               p == 'Taman Kelurahan' ? '#808000' :
                               p == 'Taman Kota' ? '#00FF00' :
                               p == 'Taman RT' ? '#FF00FF' :
                               p == 'Taman RW' ? '#800000' :
                               p == 'Tanaman Pangan' ? '#CCFFFF' : '#FFFFCC',
                    fillOpacity: 0.5,
                    stroke: true,
                    fill: true,
                    color: 'black',
                    opacity: 0.2,
                    weight: 0,
                }
            }
        },
        maxZoom: 22,
        interactive: true,
        getFeatureId: function(f) {
            return f.properties.OBJECTID;
        },
    }).on('mouseover', function(e) {
        var properties = e.layer.properties;
        clearHighlightRDTR();
        highlightRdtr = properties.OBJECTID;
        var p = properties.NAMOBJ;
        var style = {
            fillColor: p == 'Badan Air' ? '#6699CC' :
                       p == 'Badan Jalan' ? '#66CCCC' :
                       p == 'Cagar Budaya' ? '#66FFCC' :
                       p == 'Hutan Lindung' ? '#9933CC' :
                       p == 'Hutan Produksi Tetap' ? '#9966CC' :
                       p == 'Kawasan Peruntukan Industri' ? '#99CCCC' :
                       p == 'Pariwisata' ? '#CC00CC' :
                       p == 'Pemakaman' ? '#CC9933' :
                       p == 'Perdagangan dan Jasa Skala SWP' ? '#CCCC33' :
                       p == 'Perdagangan dan Jasa Skala WP' ? '#FFFF00' :
                       p == 'Pergudangan' ? '#FF8C00' :
                       p == 'Perkantoran' ? '#FF1493' :
                       p == 'Perkebunan' ? '#CC0099' :
                       p == 'Perlindungan Setempat' ? '#9370DB' :
                       p == 'Pertahanan dan Keamanan' ? '#CCCCFF' :
                       p == 'Perumahan Kepadatan Rendah' ? '#00FFFF' :
                       p == 'Perumahan Kepadatan Sedang' ? '#008080' :
                       p == 'Peternakan' ? '#0000FF' :
                       p == 'SPU Skala Kecamatan' ? '#800080' :
                       p == 'SPU Skala Kelurahan' ? '#008000' :
                       p == 'Taman Kecamatan' ? '#000080' :
                       p == 'Taman Kelurahan' ? '#808000' :
                       p == 'Taman Kota' ? '#00FF00' :
                       p == 'Taman RT' ? '#FF00FF' :
                       p == 'Taman RW' ? '#800000' :
                       p == 'Tanaman Pangan' ? '#CCFFFF' : '#FFFFCC',
            fillOpacity: 0.8,
            stroke: true,
            fill: true,
            color: 'green',
            opacity: 0.2,
            weight: 1,
        };
        map.closePopup();
        vectorRdtr.setFeatureStyle(properties.OBJECTID, style);
    }).on('click', function(e) {
        var properties = e.layer.properties;
        var stringe = `<table class="table table-bordered border-primary">
                            <tr>
                                <th>Nama Objek</th>
                                <td>${properties.NAMOBJ}</td>
                            </tr>
                        </table>`;
        L.popup()
            .setContent(stringe)
            .setLatLng(e.latlng)
            .openOn(map);
        clearHighlightRDTR();
        highlightRdtr = properties.OBJECTID;
        var p = properties.NAMOBJ;
        var style = {
            fillColor: p == 'Badan Air' ? '#6699CC' :
                       p == 'Badan Jalan' ? '#66CCCC' :
                       p == 'Cagar Budaya' ? '#66FFCC' :
                       p == 'Hutan Lindung' ? '#9933CC' :
                       p == 'Hutan Produksi Tetap' ? '#9966CC' :
                       p == 'Kawasan Peruntukan Industri' ? '#99CCCC' :
                       p == 'Pariwisata' ? '#CC00CC' :
                       p == 'Pemakaman' ? '#CC9933' :
                       p == 'Perdagangan dan Jasa Skala SWP' ? '#CCCC33' :
                       p == 'Perdagangan dan Jasa Skala WP' ? '#FFFF00' :
                       p == 'Pergudangan' ? '#FF8C00' :
                       p == 'Perkantoran' ? '#FF1493' :
                       p == 'Perkebunan' ? '#CC0099' :
                       p == 'Perlindungan Setempat' ? '#9370DB' :
                       p == 'Pertahanan dan Keamanan' ? '#CCCCFF' :
                       p == 'Perumahan Kepadatan Rendah' ? '#00FFFF' :
                       p == 'Perumahan Kepadatan Sedang' ? '#008080' :
                       p == 'Peternakan' ? '#0000FF' :
                       p == 'SPU Skala Kecamatan' ? '#800080' :
                       p == 'SPU Skala Kelurahan' ? '#008000' :
                       p == 'Taman Kecamatan' ? '#000080' :
                       p == 'Taman Kelurahan' ? '#808000' :
                       p == 'Taman Kota' ? '#00FF00' :
                       p == 'Taman RT' ? '#FF00FF' :
                       p == 'Taman RW' ? '#800000' :
                       p == 'Tanaman Pangan' ? '#CCFFFF' : '#FFFFCC',
            fillOpacity: 0.5,
            stroke: true,
            fill: true,
            color: 'green',
            weight: 1,
        };
        vectorRdtr.setFeatureStyle(properties.OBJECTID, style);
        L.DomEvent.stopPropagation(e);
    });
    rdtr.addLayer(vectorRdtr);
    map.on('click', clearHighlightRDTR);

    // UMK & KKPR GeoJSON
    var StyleUmk = {
        "color": "#ffff00",
        "weight": 2,
        "opacity": 0.65
    };

    @foreach ($umk as $um)
        @if($um->f_geojson != null)
            $.ajax({
                beforeSend: function(xhr) {
                    if (xhr && xhr.overrideMimeType) {
                        xhr.overrideMimeType('application/json;charset=utf-8');
                    }
                },
                dataType: "json",
                url: "{{ asset('uploads/berkas/umk/'.$um->id.'/kml/'.$um->f_geojson) }}",
                success: function(data) {
                    var geo_umk = L.geoJson(JSON.parse(data), {
                        onEachFeature: function(feature, layer) {
                            var stringe = `<table class="table table-sm">
                                            <tr>
                                                <td><strong>Pemohon</strong></td>
                                                <td>{{ $um->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="{{ route($umk_path . '.show', $um->id) }}" class="btn btn-sm btn-success w-100">
                                                        <i class="fa fa-info"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>`;
                            layer.bindPopup(stringe);
                            myUmk.addLayer(layer);
                        },
                        style: StyleUmk
                    }).addTo(map);
                }
            });
        @endif
    @endforeach

    var StyleKkpr = {
        "color": "#42f583",
        "weight": 2,
        "opacity": 0.65
    };

    @foreach ($kkpr as $kr)
        @if($kr->f_geojson != null)
            $.ajax({
                beforeSend: function(xhr) {
                    if (xhr && xhr.overrideMimeType) {
                        xhr.overrideMimeType('application/json;charset=utf-8');
                    }
                },
                dataType: "json",
                url: "{{ asset('uploads/berkas/kkpr/'.$kr->id.'/kml/'.$kr->f_geojson) }}",
                success: function(data) {
                    var geo_kkpr = L.geoJson(JSON.parse(data), {
                        onEachFeature: function(feature, layer) {
                            var stringe = `<table class="table table-sm">
                                            <tr>
                                                <td><strong>Pemohon</strong></td>
                                                <td>{{ $kr->user->name }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <a href="{{ route($kkpr_path . '.show', $kr->id) }}" class="btn btn-sm btn-success w-100">
                                                        <i class="fa fa-info"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>`;
                            layer.bindPopup(stringe);
                            myKkpr.addLayer(layer);
                        },
                        style: StyleKkpr
                    }).addTo(map);
                }
            });
        @endif
    @endforeach

    // Search Control
    const search = new GeoSearch.GeoSearchControl({
        provider: new GeoSearch.OpenStreetMapProvider(),
        style: 'bar',
        showMarker: false,
        searchLabel: 'Alamat, Jalan, Kabupaten, Kota, Negara',
    });
    map.addControl(search);

    // Layers Control
    map.attributionControl.setPrefix('');
    baseLayers['AerialWithLabels'].addTo(map);
    L.control.layers(
        baseLayers, {
            'Batas Kecamatan': batas_kecamatan,
            'Pola Ruang BWI': polru_bwi,
            'Pola Ruang Ketapang': polru_ktpg,
            'Land Use': land_use,
            'LSD': lsd,
            'RDTR GLAGAH-GIRI': rdtr,
            'UMK': myUmk,
            'KKPR': myKkpr,
        }, {
            collapsed: false
        }
    ).addTo(map);

    function resetMapView() {
        map.setView([-8.218079, 114.3290605], 13.6);
    }

    $(document).ready(function() {
        map.invalidateSize(true);
        
        // Animate cards
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
</script>
@endsection

