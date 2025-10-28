<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class MapController extends Controller
{
    /**
     * Menggabungkan semua GeoJSON dari UMK dan KKPR menjadi satu FeatureCollection.
     */
    public function combined(): JsonResponse
    {
        $collections = [];

        $roots = [
            'kkpr' => public_path('uploads/berkas/kkpr'),
            'umk'  => public_path('uploads/berkas/umk'),
        ];

        foreach ($roots as $jenis => $root) {
            if (!is_dir($root)) {
                continue;
            }

            // Cari file .../{id}/kml/geojson.geojson
            $pattern = $root . DIRECTORY_SEPARATOR . '*'. DIRECTORY_SEPARATOR . 'kml' . DIRECTORY_SEPARATOR . 'geojson.geojson';
            $paths = glob($pattern, GLOB_NOSORT);

            foreach ($paths as $path) {
                try {
                    $raw = file_get_contents($path);
                    if ($raw === false) {
                        continue;
                    }
                    $json = json_decode($raw, true);
                    if (!is_array($json)) {
                        continue;
                    }

                    // Normalisasi ke FeatureCollection
                    if (($json['type'] ?? null) === 'FeatureCollection' && isset($json['features']) && is_array($json['features'])) {
                        $features = $json['features'];
                    } elseif (($json['type'] ?? null) === 'Feature') {
                        $features = [$json];
                    } else {
                        continue;
                    }

                    // Tambahkan properti penanda jenis dan idFolder ke setiap feature
                    $idFolder = basename(dirname(dirname($path))); // .../{id}/kml/geojson.geojson
                    foreach ($features as &$feature) {
                        if (!isset($feature['properties']) || !is_array($feature['properties'])) {
                            $feature['properties'] = [];
                        }
                        $feature['properties']['jenis'] = $jenis; // kkpr | umk
                        $feature['properties']['idFolder'] = $idFolder;
                    }
                    unset($feature);

                    $collections[] = $features;
                } catch (\Throwable $e) {
                    // Lewati file bermasalah
                    continue;
                }
            }
        }

        $allFeatures = [];
        foreach ($collections as $featList) {
            foreach ($featList as $f) {
                $allFeatures[] = $f;
            }
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $allFeatures,
        ]);
    }

    /**
     * Summary semua GeoJSON KKPR menjadi satu file kkpr.geojson di public/mapdata/newgeo/
     */
    public function summaryKkpr(): JsonResponse
    {
        $targetDir = public_path('mapdata/newgeo');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $kkprDir = public_path('uploads/berkas/kkpr');
        $allFeatures = [];

        if (is_dir($kkprDir)) {
            $pattern = $kkprDir . DIRECTORY_SEPARATOR . '*'. DIRECTORY_SEPARATOR . 'kml' . DIRECTORY_SEPARATOR . 'geojson.geojson';
            $paths = glob($pattern, GLOB_NOSORT);

            foreach ($paths as $path) {
                try {
                    $raw = file_get_contents($path);
                    if ($raw === false) {
                        continue;
                    }
                    $json = json_decode($raw, true);
                    if (!is_array($json)) {
                        continue;
                    }

                    // Normalisasi ke FeatureCollection
                    if (($json['type'] ?? null) === 'FeatureCollection' && isset($json['features']) && is_array($json['features'])) {
                        $features = $json['features'];
                    } elseif (($json['type'] ?? null) === 'Feature') {
                        $features = [$json];
                    } else {
                        continue;
                    }

                    // Tambahkan properti penanda idFolder ke setiap feature
                    $idFolder = basename(dirname(dirname($path))); // .../{id}/kml/geojson.geojson
                    foreach ($features as &$feature) {
                        if (!isset($feature['properties']) || !is_array($feature['properties'])) {
                            $feature['properties'] = [];
                        }
                        $feature['properties']['idFolder'] = $idFolder;
                        $feature['properties']['jenis'] = 'kkpr';
                    }
                    unset($feature);

                    $allFeatures = array_merge($allFeatures, $features);
                } catch (\Throwable $e) {
                    // Lewati file bermasalah
                    continue;
                }
            }
        }

        $featureCollection = [
            'type' => 'FeatureCollection',
            'features' => $allFeatures,
        ];

        $targetFile = $targetDir . DIRECTORY_SEPARATOR . 'kkpr.geojson';
        $result = file_put_contents($targetFile, json_encode($featureCollection, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => $result !== false,
            'message' => $result !== false ? 'KKPR GeoJSON berhasil di-summary' : 'Gagal menyimpan file KKPR',
            'file_path' => 'mapdata/newgeo/kkpr.geojson',
            'features_count' => count($allFeatures),
        ]);
    }

    /**
     * Summary semua GeoJSON UMK menjadi satu file umk.geojson di public/mapdata/newgeo/
     */
    public function summaryUmk(): JsonResponse
    {
        $targetDir = public_path('mapdata/newgeo');
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $umkDir = public_path('uploads/berkas/umk');
        $allFeatures = [];

        if (is_dir($umkDir)) {
            $pattern = $umkDir . DIRECTORY_SEPARATOR . '*'. DIRECTORY_SEPARATOR . 'kml' . DIRECTORY_SEPARATOR . 'geojson.geojson';
            $paths = glob($pattern, GLOB_NOSORT);

            foreach ($paths as $path) {
                try {
                    $raw = file_get_contents($path);
                    if ($raw === false) {
                        continue;
                    }
                    $json = json_decode($raw, true);
                    if (!is_array($json)) {
                        continue;
                    }

                    // Normalisasi ke FeatureCollection
                    if (($json['type'] ?? null) === 'FeatureCollection' && isset($json['features']) && is_array($json['features'])) {
                        $features = $json['features'];
                    } elseif (($json['type'] ?? null) === 'Feature') {
                        $features = [$json];
                    } else {
                        continue;
                    }

                    // Tambahkan properti penanda idFolder ke setiap feature
                    $idFolder = basename(dirname(dirname($path))); // .../{id}/kml/geojson.geojson
                    foreach ($features as &$feature) {
                        if (!isset($feature['properties']) || !is_array($feature['properties'])) {
                            $feature['properties'] = [];
                        }
                        $feature['properties']['idFolder'] = $idFolder;
                        $feature['properties']['jenis'] = 'umk';
                    }
                    unset($feature);

                    $allFeatures = array_merge($allFeatures, $features);
                } catch (\Throwable $e) {
                    // Lewati file bermasalah
                    continue;
                }
            }
        }

        $featureCollection = [
            'type' => 'FeatureCollection',
            'features' => $allFeatures,
        ];

        $targetFile = $targetDir . DIRECTORY_SEPARATOR . 'umk.geojson';
        $result = file_put_contents($targetFile, json_encode($featureCollection, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => $result !== false,
            'message' => $result !== false ? 'UMK GeoJSON berhasil di-summary' : 'Gagal menyimpan file UMK',
            'file_path' => 'mapdata/newgeo/umk.geojson',
            'features_count' => count($allFeatures),
        ]);
    }

    /**
     * Refresh data map - summary kedua file KKPR dan UMK sekaligus
     */
    public function refreshDataMap(): JsonResponse
    {
        $kkprResult = $this->summaryKkpr();
        $umkResult = $this->summaryUmk();

        $kkprData = $kkprResult->getData(true);
        $umkData = $umkResult->getData(true);

        return response()->json([
            'success' => $kkprData['success'] && $umkData['success'],
            'message' => 'Refresh data map selesai',
            'kkpr' => $kkprData,
            'umk' => $umkData,
            'total_features' => ($kkprData['features_count'] ?? 0) + ($umkData['features_count'] ?? 0),
        ]);
    }
}


