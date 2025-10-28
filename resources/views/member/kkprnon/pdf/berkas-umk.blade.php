<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BERKAS UMK</title>
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
            <td style="width: 12%; padding: 3px; border: 1px dotted #333;"><strong>Nomor</strong></td>
            <td style="width: 2%; padding: 3px; border: 1px dotted #333;">:</td>
            <td style="width: 35%; padding: 3px; border: 1px dotted #333;">{{ $model->no_sk ?? '-' }}</td>
            <td style="width: 51%; padding: 3px; border: 1px dotted #333; text-align: right;"><strong>Banyuwangi, {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('d F Y') }}</strong></td>
        </tr>
        <tr>
            <td style="padding: 3px; border: 1px dotted #333;"><strong>Tanggal</strong></td>
            <td style="padding: 3px; border: 1px dotted #333;">:</td>
            <td style="padding: 3px; border: 1px dotted #333;">{{ $model->tanggal_sk ? \Carbon\Carbon::parse($model->tanggal_sk)->locale('id')->translatedFormat('d F Y') : '-' }}</td>
            <td style="padding: 3px; border: 1px dotted #333;"></td>
        </tr>
        <tr>
            <td style="padding: 3px; border: 1px dotted #333;"><strong>Sifat</strong></td>
            <td style="padding: 3px; border: 1px dotted #333;">:</td>
            <td style="padding: 3px; border: 1px dotted #333;">Penting</td>
            <td style="padding: 3px; border: 1px dotted #333;"></td>
        </tr>
        <tr>
            <td style="padding: 3px; border: 1px dotted #333;"><strong>Lampiran</strong></td>
            <td style="padding: 3px; border: 1px dotted #333;">:</td>
            <td style="padding: 3px; border: 1px dotted #333;">1 (satu) berkas</td>
            <td style="padding: 3px; border: 1px dotted #333;"></td>
        </tr>
        <tr>
            <td style="padding: 3px; border: 1px dotted #333;"><strong>Perihal</strong></td>
            <td style="padding: 3px; border: 1px dotted #333;">:</td>
            <td colspan="2" style="padding: 3px; border: 1px dotted #333;">Hasil Validasi Pernyataan Mandiri Kegiatan Berusaha Bagi UMK Terhadap Kesesuaian Rencana Tata Ruang</td>
        </tr>
    </table>

    <div style="margin: 20px 0;">
        <strong>Yth. Sdr. {{ strtoupper($model->user->name) }}<br>Di Banyuwangi</strong>
    </div>

    <div class="justify" style="margin: 20px 0;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan hormat disampaikan hasil penilaian kesesuaian rencana penggunaan lahan an. <strong>{{ strtoupper($model->user->name) }}</strong> terhadap peraturan rencana tata ruang dengan rincian sebagai berikut:
    </div>

    <!-- Section 1: Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK -->
    <div class="section-title">1. Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK dengan rincian informasi sebagai berikut:</div>
    
    <table class="info-table">
        <tr>
            <td class="label-col">a.</td>
            <td class="field-col">Nama Pelaku Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ strtoupper($model->user->name ?? '-') }}</td>
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
        <div style="margin: 10px 0;">
            <strong>a. Peraturan Bupati Banyuwangi Nomor 55 Tahun 2024 tentang Rencana Detail Tata Ruang Wilayah Perencanaan Genteng Tahun 2024-2044</strong>
        </div>
        <div style="margin: 10px 0;">
            <strong>b. Surat Keputusan Menteri Agraria Dan Tata Ruang/ Kepala Badan Pertanahan Nasional Nomor 1589/SK-Hk.02.01/XII/2021 Tentang Penetapan Peta Lahan Sawah Yang Dilindungi Pada Kabupaten/Kota</strong>
        </div>
        @php
            // Decode JSON data for pertimbangan and ketentuan_lain
            $pertimbangan = [];
            $ketentuan_lain = [];
            
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
        @endphp

        @if(!empty($pertimbangan))
        <div style="margin: 10px 0;">
            <strong>c. Ketentuan penggunaan lahan untuk kegiatan Kode KBLI {{ $model->kkpr_kbli && $model->kkpr_kbli->count() > 0 ? $model->kkpr_kbli->first()->kode_kbli : '-' }} pada {{ $model->rencana_manfaat ?? '-' }}:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                @foreach($pertimbangan as $index => $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
        @endif

        @if(!empty($ketentuan_lain))
        <div style="margin: 10px 0;">
            <strong>d. Keterangan lain yang dianggap perlu:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                @foreach($ketentuan_lain as $index => $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ol>
        </div>
        @endif
    </div>

    <!-- Signature Section -->
    <table class="signature-table">
        <tr>
            <td class="signature-left">
                <div class="signature-block">
                    <div><strong>Mengetahui,</strong></div>
                    <div style="text-align: center; margin: 20px 0;">
                        <strong>Plt. KEPALA DINAS PEKERJAAN UMUM CIPTA KARYA PERUMAHAN DAN PERMUKIMAN KABUPATEN BANYUWANGI</strong>
                    </div>
                    <div style="margin: 30px 0;">
                        <div class="dotted-line" style="margin-bottom: 10px;">
                            <strong>Reni Carica Ratriyani</strong><br>
                            NIP. 19900110 201502 2 002
                        </div>
                        <div><strong>Pemeriksa Teknis</strong></div>
                    </div>
                    <div style="margin: 30px 0;">
                        <div class="dotted-line" style="margin-bottom: 10px;">
                            <strong>Ir. BAYU HADIYANTO, ST, M.Si</strong><br>
                            NIP. 19751004 200312 1 004
                        </div>
                        <div><strong>Pemeriksa Kepala Bidang Penataan Ruang</strong></div>
                    </div>
                </div>
            </td>
            <td class="signature-right">
                <div class="signature-block">
                    <div class="dotted-line" style="margin-bottom: 10px;">
                        <div class="signature-name">SUYANTO WASPO TONDO WICAKSONO</div>
                        <div>Pembina Utama Muda</div>
                        <div>NIP. 19700421 198903 1 001</div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    {{-- <div class="footer-info" style="font-size: 9pt;">
        <div>Diterbitkan Tanggal: {{ date('d F Y') }}</div>
        <div style="margin-top: 10px;">Dicetak Tanggal: {{ date('d F Y') }}</div>
    </div> --}}

</body>
</html>
