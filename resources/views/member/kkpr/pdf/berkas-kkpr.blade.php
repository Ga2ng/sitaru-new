<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BERKAS KKPR</title>
    <style type="text/css">
        body { 
            width:100% !important;
            margin:0 !important;
            padding:0 !important;
            line-height: 1.4; 
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif; 
            color: #000; 
            background: none; 
            font-size: 11pt; 
        }

        table, th, td { 
            vertical-align: top; 
            border-collapse: collapse;
        }

        table{
            width:100%;
        }

        .page_break { 
            page-break-before: always; 
        }

        .header-table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-table td {
            border: 1px solid black;
            padding: 5px;
        }

        .info-table {
            width: 100%;
            margin-bottom: 5px;
            font-size: 9pt;
        }

        .info-table td {
            padding: 1px 0;
        }

        .label-col {
            width: 4%;
        }

        .field-col {
            width: 45%;
        }

        .colon-col {
            width: 2%;
        }

        .value-col {
            width: 49%;
        }

        .map-container {
            text-align: center;
            margin: 20px 0;
        }

        .map-caption {
            font-size: 10pt;
            margin-top: 10px;
        }

        .signature-table {
            width: 100%;
            margin-top: 30px;
        }

        .signature-left {
            width: 60%;
        }

        .signature-right {
            width: 40%;
            text-align: right;
        }

        .signature-block {
            margin-bottom: 20px;
        }

        .signature-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            min-height: 20px;
        }

        .bold-underline {
            font-weight: bold;
            text-decoration: underline;
        }

        .strikethrough {
            text-decoration: line-through;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .right {
            text-align: right;
        }

        .left {
            text-align: left;
        }

        .logo {
            width: 120px;
            height: auto;
        }

        .title {
            font-weight: bold;
            font-size: 12pt;
        }

        .subtitle {
            font-weight: bold;
            font-size: 11pt;
        }

        .section-title {
            font-weight: bold;
            margin: 8px 0 5px 0;
            font-size: 10pt;
        }

        .requirement-list {
            margin: 10px 0;
        }

        .requirement-list li {
            margin-bottom: 5px;
            text-align: justify;
        }

        .consideration-list {
            margin: 10px 0;
        }

        .consideration-list li {
            margin-bottom: 5px;
            text-align: justify;
        }

        .footer-info {
            margin-top: 30px;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    @php
        $prop = \DB::table('setup_prop')->where('NO_PROP', 35)->first();
        $kab = \DB::table('setup_kab')->where('NO_PROP', 35)->where('NO_KAB', $model->kabupaten_id)->first();
        $kec = \DB::table('setup_kec')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->first();
        $kel = \DB::table('setup_kel_fix')->where('NO_PROP', 35)->where('NO_KAB', 10)->where('NO_KEC', $model->NO_KEC)->where('NO_KEL', $model->NO_KEL)->first();
        
        // Parse pemeriksa_teknis
        $pemeriksa_teknis = [];
        if (!empty($model->pemeriksa_teknis)) {
            if (is_string($model->pemeriksa_teknis)) {
                $decoded = json_decode($model->pemeriksa_teknis, true);
                $pemeriksa_teknis = is_array($decoded) ? $decoded : [];
            } elseif (is_array($model->pemeriksa_teknis)) {
                $pemeriksa_teknis = $model->pemeriksa_teknis;
            }
        }
    @endphp

    <!-- Header Section -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <td style="width: 15%; vertical-align: top; padding-right: 15px;">
                @if($logoBase64)
                    <img src="{{ $logoBase64 }}" alt="Logo Banyuwangi" style="width: 80px; height: auto;">
                @endif
            </td>
            <td style="width: 85%; vertical-align: top;">
                <div style="text-align: center; line-height: 1.2;">
                    <div style="font-size: 13pt; font-weight: bold; margin-bottom: 3px;">PEMERINTAH KABUPATEN BANYUWANGI</div>
                    <div style="font-size: 12pt; font-weight: bold; margin-bottom: 3px;">DINAS PEKERJAAN UMUM</div>
                    <div style="font-size: 12pt; font-weight: bold; margin-bottom: 3px;">CIPTA KARYA PERUMAHAN DAN PERMUKIMAN</div>
                    <div style="font-size: 10pt; margin-bottom: 3px;">Jl. HOS Cokroaminoto No. 101 Telp. (0333) 421695 Fax. (0333) 410445</div>
                    <div style="font-size: 12pt; font-weight: bold;">BANYUWANGI</div>
                </div>
            </td>
        </tr>
    </table>
    
    <!-- Separator Lines -->
    <div style="border-top: 2px solid #333; margin: 5px 0;"></div>
    <div style="border-top: 1px solid #333; margin: 2px 0;"></div>
    
    <!-- Document Header Table -->
    <table style="width: 100%; border-collapse: collapse; margin: 10px 0; font-size: 9pt;">
        <tr>
            <td style="width: 12%; padding: 3px;"><strong>Nomor</strong></td>
            <td style="width: 2%; padding: 3px;">:</td>
            <td style="width: 35%; padding: 3px;">{{ $model->no_sk ?? '-' }}</td>
            <td style="width: 51%; padding: 3px; text-align: right;"><strong>Banyuwangi, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</strong></td>
        </tr>
        <tr>
            <td style="padding: 3px;"><strong>Tanggal</strong></td>
            <td style="padding: 3px;">:</td>
            <td style="padding: 3px;">{{ $model->tanggal_sk ? \Carbon\Carbon::parse($model->tanggal_sk)->locale('id')->translatedFormat('d F Y') : '-' }}</td>
            <td style="padding: 3px;"></td>
        </tr>
        <tr>
            <td style="padding: 3px;"><strong>Sifat</strong></td>
            <td style="padding: 3px;">:</td>
            <td style="padding: 3px;">Penting</td>
            <td style="padding: 3px;"></td>
        </tr>
        <tr>
            <td style="padding: 3px;"><strong>Lampiran</strong></td>
            <td style="padding: 3px;">:</td>
            <td style="padding: 3px;">1 (satu) berkas</td>
            <td style="padding: 3px;"></td>
        </tr>
        <tr>
            <td style="padding: 3px;"><strong>Perihal</strong></td>
            <td style="padding: 3px;">:</td>
            <td colspan="2" style="padding: 3px;">Hasil Validasi Pernyataan Mandiri Kegiatan Berusaha Bagi UMK Terhadap Kesesuaian Rencana Tata Ruang</td>
        </tr>
    </table>

    <div style="margin: 20px 0;">
        <strong>Yth. Sdr. {{ strtoupper($model->user && $model->user->name ? $model->user->name : ($model->atas_nama ?? 'Pemohon')) }}<br>Di Banyuwangi</strong>
    </div>

    <div class="justify" style="margin: 20px 0;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan hormat disampaikan hasil penilaian kesesuaian rencana penggunaan lahan an. <strong>{{ strtoupper($model->user && $model->user->name ? $model->user->name : ($model->atas_nama ?? 'Pemohon')) }}</strong> terhadap peraturan rencana tata ruang dengan rincian sebagai berikut:
    </div>

    <!-- Section 1: Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK -->
    <div class="section-title">1. Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK dengan rincian informasi sebagai berikut:</div>
    
    <table class="info-table">
        <tr>
            <td class="label-col">a.</td>
            <td class="field-col">Nama Pelaku Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ strtoupper($model->user && $model->user->name ? $model->user->name : ($model->atas_nama ?? '-')) }}</td>
        </tr>
        <tr>
            <td class="label-col">b.</td>
            <td class="field-col">Nama Penanggung jawab</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ strtoupper($model->atas_nama ?? '-') }}</td>
        </tr>
        <tr>
            <td class="label-col">c.</td>
            <td class="field-col">NIB</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->no_nib ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">d.</td>
            <td class="field-col">Diterbitkan tanggal</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->tgl_terbit ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">e.</td>
            <td class="field-col">Kode KBLI</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->kkpr_kbli && $model->kkpr_kbli->count() > 0 ? $model->kkpr_kbli->first()->kode_kbli : '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">f.</td>
            <td class="field-col">Jenis KBLI</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->kkpr_kbli && $model->kkpr_kbli->count() > 0 ? $model->kkpr_kbli->first()->judul_kbli : '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">g.</td>
            <td class="field-col">Lokasi Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $kel ? $kel->NAMA_KEL : 'Setail' }}, Kecamatan {{ $kec ? $kec->NAMA_KEC : '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">h.</td>
            <td class="field-col">Penggunaan Lahan saat ini</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->status_penggunaan_tanah ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">i.</td>
            <td class="field-col">Luas tanah yang dimohon</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->luas_dimohon ?? '-' }} m² pada Sertifikat Hak Milik Nomor {{ $model->no_sertifikat ?? '1308' }} Tahun {{ $model->thn_sertifikat ?? '2000' }} pada status sebidang tanah perumahan</td>
        </tr>
    </table>

    <!-- Section 2: Dinyatakan terhadap rencana tata ruang -->
    <div class="section-title" style="page-break-inside: avoid;">2. Dinyatakan terhadap rencana tata ruang 
        @if($model->status_rencana == 'disetujui_seluruhnya')
            <span class="bold-underline">Disetujui Seluruhnya</span>
        @elseif($model->status_rencana == 'disetujui_sebagian')
            <span class="bold-underline">Disetujui Sebagian</span>
        @else
            <span class="bold-underline">Disetujui Seluruhnya</span>
        @endif
        dengan ketentuan:</div>
    
    @if($model->status_rencana == 'disetujui_sebagian' && $model->luas_disetujui)
    <div style="margin-bottom: 10px; font-size: 12px;">
        <strong>Luas Lahan yang Disetujui:</strong> {{ $model->luas_disetujui }} m²
    </div>
    @endif
    
    <table style="width: 100%; page-break-inside: avoid;">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <table class="info-table">
                    <tr>
                        <td class="label-col">a.</td>
                        <td class="field-col">Lokasi Rencana Tata Ruang</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->lokasi_rencana ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">b.</td>
                        <td class="field-col">Rencana Pemanfataan Ruang</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->rencana_manfaat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">c.</td>
                        <td class="field-col">Status Lahan Sawah Dilindungi</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">
                            @if($model->status_lsd == 'Berada')
                                <span class="bold-underline">Berada</span> / <span class="strikethrough">Tidak Berada</span>
                            @elseif($model->status_lsd == 'Tidak Berada')
                                <span class="strikethrough">Berada</span> / <span class="bold-underline">Tidak Berada</span>
                            @else
                                <span class="bold-underline">Berada</span> / <span class="strikethrough">Tidak Berada</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label-col">d.</td>
                        <td class="field-col">KDB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kdb ?? '-' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">e.</td>
                        <td class="field-col">KLB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->klb ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">f.</td>
                        <td class="field-col">KDH (min)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kdh ?? '-' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">g.</td>
                        <td class="field-col">KTB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->ktb ?? '-' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">h.</td>
                        <td class="field-col">Garis Sempadan Bangunan (min)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->gsb ?? '-' }} meter (jalan kolektor primer)</td>
                    </tr>
                    <tr>
                        <td class="label-col">i.</td>
                        <td class="field-col">Tinggi Bangunan (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->tinggi_bangunan ?? '-' }} meter</td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; vertical-align: top; padding-left: 20px;">
                <!-- Map Section -->
                <div class="map-container">
                    @if($fotoPetaBase64)
                        <div style="border: 1px solid #ccc; padding: 5px; background-color: #f9f9f9; text-align: center;">
                            <img src="{{ $fotoPetaBase64 }}" 
                                 alt="Peta Lokasi Permohonan" 
                                 style="max-width: 100%; max-height: 150px; width: auto; height: auto; border: 1px solid #ddd; object-fit: contain;">
                        </div>
                    @else
                        <div style="border: 1px solid #ccc; padding: 5px; background-color: #f9f9f9; min-height: 100px;">
                            <div style="text-align: center; color: #666; font-size: 8pt;">
                                [PETA LOKASI PERMOHONAN]<br>
                                <small>Peta tidak tersedia</small>
                            </div>
                        </div>
                    @endif
                    <div class="map-caption" style="font-size: 8pt; margin-top: 5px;">
                        <strong>Peta Lokasi Permohonan terhadap arahan pemanfaatan ruang yang di setujui</strong>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Section 3: Dengan mempertimbangkan -->
    <div class="section-title">3. Dengan mempertimbangkan:</div>
    
    <div class="consideration-list">
        @php
            // Decode JSON data for pertimbangan, ketentuan_lain, dan keterangan_lain
            $pertimbangan = [];
            $ketentuan_lain = [];
            $keterangan_lain = [];
            
            if (!empty($model->pertimbangan)) {
                if (is_string($model->pertimbangan)) {
                    $decoded = json_decode($model->pertimbangan, true);
                    $pertimbangan = is_array($decoded) ? $decoded : [];
                } elseif (is_array($model->pertimbangan)) {
                    $pertimbangan = $model->pertimbangan;
                } else {
                    $pertimbangan = [];
                }
            }
            
            if (!empty($model->ketentuan_lain)) {
                if (is_string($model->ketentuan_lain)) {
                    $decoded = json_decode($model->ketentuan_lain, true);
                    $ketentuan_lain = is_array($decoded) ? $decoded : [];
                } elseif (is_array($model->ketentuan_lain)) {
                    $ketentuan_lain = $model->ketentuan_lain;
                } else {
                    $ketentuan_lain = [];
                }
            }
            
            if (!empty($model->keterangan_lain)) {
                if (is_string($model->keterangan_lain)) {
                    $decoded = json_decode($model->keterangan_lain, true);
                    $keterangan_lain = is_array($decoded) ? $decoded : [];
                } elseif (is_array($model->keterangan_lain)) {
                    $keterangan_lain = $model->keterangan_lain;
                } else {
                    $keterangan_lain = [];
                }
            }
            
            // Calculate alphabet starting from 'a' for pertimbangan
            $letterIndex = 0; // Starting index for 'a' (a=0)
        @endphp

        @if(!empty($pertimbangan))
        @foreach($pertimbangan as $index => $item)
        @php
            $letter = chr(97 + $letterIndex); // Convert to lowercase letter (a=97)
            $letterIndex++;
        @endphp
        <div style="margin: 10px 0;">
            <strong>{{ $letter }}. {{ $item }}</strong>
        </div>
        @endforeach
        @endif

        @if(!empty($ketentuan_lain))
        @php
            $letter = chr(97 + $letterIndex);
            $letterIndex++;
        @endphp
        <div style="margin: 10px 0;">
            <strong>{{ $letter }}. Ketentuan penggunaan lahan untuk kegiatan Kode KBLI {{ $model->kkpr_kbli && $model->kkpr_kbli->count() > 0 ? $model->kkpr_kbli->first()->kode_kbli : '-' }} pada {{ $model->rencana_manfaat ?? '-' }}:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                @foreach($ketentuan_lain as $index => $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
        @endif

        @if(!empty($keterangan_lain))
        @php
            $letter = chr(97 + $letterIndex);
        @endphp
        <div style="margin: 10px 0;">
            <strong>{{ $letter }}. Keterangan lain yang dianggap perlu:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                @foreach($keterangan_lain as $index => $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
        @endif
    </div>

    <!-- Signature Section -->
    <table class="signature-table" style="font-size: 9pt;">
        <tr>
            <td class="signature-left" style="vertical-align: top;">
                <div>
                    <div><strong>Mengetahui,</strong></div>
                    
                    @if(count($pemeriksa_teknis) > 0)
                        @foreach($pemeriksa_teknis as $index => $pemeriksa)
                            <div style="margin: 15px 0;">
                                <div style="margin-bottom: 10px;">
                                    @if(is_numeric($pemeriksa))
                                        @php $userPemeriksa = \App\Models\User::find($pemeriksa); @endphp
                                        @if($userPemeriksa)
                                            <strong>{{ strtoupper($userPemeriksa->name) }}</strong>
                                            @if($userPemeriksa->nip)
                                                <br>NIP. {{ $userPemeriksa->nip }}
                                            @endif
                                        @endif
                                    @else
                                        <strong>{{ strtoupper($pemeriksa) }}</strong>
                                    @endif
                                </div>
                                <div style="border-bottom: 1px dotted #000; min-height: 40px; max-width: 250px;"></div>
                                <div style="margin-top: 5px;"><strong>Pemeriksa Teknis</strong></div>
                            </div>
                        @endforeach
                    @else
                        <div style="margin: 15px 0;">
                            <div style="margin-bottom: 10px;"></div>
                            <div style="border-bottom: 1px dotted #000; min-height: 40px; max-width: 250px;"></div>
                            <div style="margin-top: 5px;"><strong>Pemeriksa Teknis</strong></div>
                        </div>
                    @endif
                    
                    <div style="margin: 15px 0;">
                        <div style="margin-bottom: 10px;">
                            <strong>Ir. BAYU HADIYANTO, ST, M.Si</strong><br>
                            NIP. 19751004 200312 1 004
                        </div>
                        <div style="border-bottom: 1px dotted #000; min-height: 40px; max-width: 250px;"></div>
                        <div style="margin-top: 5px;"><strong>Pemeriksa</strong></div>
                        <div style="margin-top: 2px;"><strong>Kepala Bidang Penataan Ruang</strong></div>
                    </div>
                </div>
            </td>
            <td class="signature-right" style="vertical-align: top;">
                <div>
                    <div><strong>Mengetahui,</strong></div>
                    <div style="text-align: center; margin: 10px 0;">
                        <strong>Plt. KEPALA DINAS PEKERJAAN UMUM CIPTA KARYA PERUMAHAN DAN PERMUKIMAN KABUPATEN BANYUWANGI</strong>
                    </div>
                    <div style="margin: 15px 0;">
                        <div style="margin-bottom: 10px;">
                            <div class="signature-name">SUYANTO WASPO TONDO WICAKSONO</div>
                            <div>Pembina Utama Muda</div>
                            <div>NIP. 19700421 198903 1 001</div>
                        </div>
                        <div style="border-bottom: 1px dotted #000; min-height: 40px; max-width: 250px;"></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    {{-- <div class="footer-info">
        <div>Diterbitkan Tanggal: {{ date('d F Y') }}</div>
        <div style="margin-top: 20px;">Dicetak Tanggal: {{ date('d F Y') }}</div>
    </div> --}}


</body>
</html>
