<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berkas UMK - {{ $model->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .center {
            text-align: center;
        }

        .justify {
            text-align: justify;
        }

        .title {
            font-size: 16pt;
            font-weight: bold;
            margin: 20px 0;
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

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
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
            width: 25%;
        }

        .colon-col {
            width: 2%;
        }

        .value-col {
            width: 69%;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .signature-left {
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }

        .signature-right {
            width: 50%;
            vertical-align: top;
            padding-left: 20px;
        }

        .signature-block {
            text-align: center;
        }

        .signature-name {
            font-weight: bold;
            font-size: 12pt;
        }

        .dotted-line {
            border-bottom: 1px dotted #333;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .bold-underline {
            text-decoration: underline;
            font-weight: bold;
        }

        .strikethrough {
            text-decoration: line-through;
        }

        .page_break {
            page-break-before: always;
        }

        .map-container {
            margin: 10px 0;
        }

        .map-caption {
            text-align: center;
            font-size: 9pt;
            margin-top: 5px;
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
            <td style="width: 35%; padding: 3px; border: 1px dotted #333;">645 / /429.115 / 2025</td>
            <td style="width: 51%; padding: 3px; border: 1px dotted #333; text-align: right;"><strong>Banyuwangi, Oktober 2025</strong></td>
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

    <div style="margin: 10px 0; font-size: 10pt;">
        <strong>Yth. Sdr. {{ strtoupper($model->user->name) }}<br>Di Banyuwangi</strong>
    </div>

    <div class="justify" style="margin: 10px 0; font-size: 10pt;">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan hormat disampaikan hasil penilaian kesesuaian rencana penggunaan lahan an. <strong>{{ strtoupper($model->user->name) }}</strong> terhadap peraturan rencana tata ruang dengan rincian sebagai berikut:
    </div>

    <!-- Section 1: Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK -->
    <div class="section-title" style="font-size: 10pt; margin: 8px 0;">1. Persetujuan Kegiatan Pemanfaatan Ruang Bagi UMK dengan rincian informasi sebagai berikut:</div>
    
    <table class="info-table">
        <tr>
            <td class="label-col">a.</td>
            <td class="field-col">Nama Pelaku Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ strtoupper($model->user->name) }}</td>
        </tr>
        <tr>
            <td class="label-col">b.</td>
            <td class="field-col">Alamat Pelaku Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->alamat_pemohon ?? 'Jl. Contoh No. 123' }}</td>
        </tr>
        <tr>
            <td class="label-col">c.</td>
            <td class="field-col">Nomor Telepon</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->no_telp ?? '081234567890' }}</td>
        </tr>
        <tr>
            <td class="label-col">d.</td>
            <td class="field-col">Nama Kegiatan Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->nama_kegiatan ?? 'Usaha Mikro Kecil' }}</td>
        </tr>
        <tr>
            <td class="label-col">e.</td>
            <td class="field-col">Alamat Lokasi Kegiatan</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->alamat_lokasi ?? 'Jl. Lokasi Kegiatan No. 456' }}</td>
        </tr>
        <tr>
            <td class="label-col">f.</td>
            <td class="field-col">Luas Lahan yang Dimohon</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->luas_dimohon ?? '474' }} m² pada Sertifikat Hak Milik Nomor {{ $model->no_sertifikat ?? '1308' }} Tahun {{ $model->thn_sertifikat ?? '2000' }} pada status sebidang tanah perumahan</td>
        </tr>
    </table>

    <!-- Section 2: Dinyatakan terhadap rencana tata ruang -->
    <div class="section-title" style="page-break-inside: avoid;">2. Dinyatakan terhadap rencana tata ruang <span class="bold-underline">Sesuai Bersyarat</span> / <span class="strikethrough">Sesuai Sebagian</span> / <span class="strikethrough">Tidak Sesuai</span> dengan ketentuan:</div>
    
    <table style="width: 100%; page-break-inside: avoid;">
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <table class="info-table">
                    <tr>
                        <td class="label-col">a.</td>
                        <td class="field-col">Lokasi Rencana Tata Ruang</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">SBWP VI.A Blok VI.A.1</td>
                    </tr>
                    <tr>
                        <td class="label-col">b.</td>
                        <td class="field-col">Peruntukan Rencana Tata Ruang</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">Perdagangan dan Jasa Skala Kota (K-1)</td>
                    </tr>
                    <tr>
                        <td class="label-col">c.</td>
                        <td class="field-col">Kode KBLI</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kkpr_kbli->first()->kode_kbli ?? '86903' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">d.</td>
                        <td class="field-col">Judul KBLI</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kkpr_kbli->first()->judul_kbli ?? 'Aktivitas Pelayanan Penunjang Kesehatan' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">e.</td>
                        <td class="field-col">Luas Lahan Maksimal</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">500 m²</td>
                    </tr>
                    <tr>
                        <td class="label-col">f.</td>
                        <td class="field-col">Koefisien Dasar Bangunan (KDB)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">Maksimal 60%</td>
                    </tr>
                    <tr>
                        <td class="label-col">g.</td>
                        <td class="field-col">Koefisien Lantai Bangunan (KLB)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">Maksimal 1,5</td>
                    </tr>
                    <tr>
                        <td class="label-col">h.</td>
                        <td class="field-col">Garis Sempadan Bangunan (GSB)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">Minimal 3 meter</td>
                    </tr>
                    <tr>
                        <td class="label-col">i.</td>
                        <td class="field-col">Tinggi Bangunan Maksimal</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->tinggi_bangunan ?? '20' }} meter</td>
                    </tr>
                </table>
            </td>
            <td style="width: 40%; vertical-align: top; padding-left: 20px;">
                <!-- Map Section -->
                <div class="map-container">
                    @if($fotoPetaBase64)
                        <div style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9; text-align: center;">
                            <img src="{{ $fotoPetaBase64 }}" 
                                 alt="Peta Lokasi Permohonan" 
                                 style="max-width: 100%; max-height: 400px; border: 1px solid #ddd;">
                        </div>
                    @else
                        <div style="border: 1px solid #ccc; padding: 10px; background-color: #f9f9f9; min-height: 200px;">
                            <div style="text-align: center; color: #666; font-size: 10pt;">
                                [PETA LOKASI PERMOHONAN]<br>
                                <small>Peta tidak tersedia</small>
                            </div>
                        </div>
                    @endif
                    <div class="map-caption">
                        <strong>Peta Lokasi Permohonan terhadap arahan pemanfaatan ruang yang di setujui</strong>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <!-- Section 3: Dengan mempertimbangkan -->
    <div class="section-title">3. Dengan mempertimbangkan:</div>
    
    <div class="consideration-list" style="font-size: 9pt;">
        <div style="margin: 5px 0;">
            <strong>a. Peraturan Bupati Banyuwangi Nomor 55 Tahun 2024 tentang Rencana Detail Tata Ruang Wilayah Perencanaan Genteng Tahun 2024-2044</strong>
        </div>
        <div style="margin: 5px 0;">
            <strong>b. Surat Keputusan Menteri Agraria Dan Tata Ruang/ Kepala Badan Pertanahan Nasional Nomor 1589/SK-Hk.02.01/XII/2021 Tentang Penetapan Peta Lahan Sawah Yang Dilindungi Pada Kabupaten/Kota</strong>
        </div>
        <div style="margin: 5px 0;">
            <strong>c. Ketentuan penggunaan lahan untuk kegiatan Kode KBLI {{ $model->kkpr_kbli->first()->kode_kbli ?? '86903' }} pada zona perdagangan dan jasa skala kota (K-1):</strong>
            <ol style="margin: 5px 0; padding-left: 20px; font-size: 8pt;">
                <li>Berkoordinasi dengan instansi teknis terkait dengan Persetujuan Teknis Analisis mengenai Dampak Lalu Lintas sesuai dengan kekewenangan dan ketentuan yang berlaku</li>
                <li>Mendapatkan rekomendasi garis sempadan sungai/saluran dari instansi teknis terkait sesuai dengan ketentuan</li>
                <li>Wajib mendapatkan rekomendasi/izin dari instansi terkait sesuai dengan ketentuan peraturan yang berlaku</li>
                <li>Tampak bangunan depan mengikuti kearifan lokal Kabupaten Banyuwangi</li>
                <li>Wajib mencukupi dan menyediakan parkir kendaraan, kebutuhan aksesibilitas, kebutuhan ruang loading, unloading dan/atau tempat penampungan barang didalam kavling/persil di dalam kavling/persil</li>
            </ol>
        </div>
        <div style="margin: 5px 0;">
            <strong>d. Keterangan lain yang dianggap perlu:</strong>
            <ol style="margin: 5px 0; padding-left: 20px; font-size: 8pt;">
                <li>Surat ini hanya menunjukan informasi peruntukan rencana penggunaan ruang yang diperbolehkan sesuai dengan rencana umum/rinci tata ruang dan bukan menyatakan bukti kepemilikan hak atas tanah.</li>
                <li>Surat ini dianggap tidak berlaku apabila di kemudian hari terjadi sengketa atas tanah, kepemilikan, dan keterangan yang diajukan dalam permohonan ini ternyata tidak benar ataupun dipalsukan di kemudian hari.</li>
            </ol>
        </div>
    </div>

    <!-- Signature Section -->
    <table class="signature-table" style="font-size: 9pt;">
        <tr>
            <td class="signature-left">
                <div class="signature-block">
                    <div><strong>Mengetahui,</strong></div>
                    <div style="text-align: center; margin: 10px 0;">
                        <strong>Plt. KEPALA DINAS PEKERJAAN UMUM CIPTA KARYA PERUMAHAN DAN PERMUKIMAN KABUPATEN BANYUWANGI</strong>
                    </div>
                    <div style="margin: 15px 0;">
                        <div class="dotted-line" style="margin-bottom: 5px;">
                            <strong>Reni Carica Ratriyani</strong><br>
                            NIP. 19900110 201502 2 002
                        </div>
                        <div><strong>Pemeriksa Teknis</strong></div>
                    </div>
                    <div style="margin: 15px 0;">
                        <div class="dotted-line" style="margin-bottom: 5px;">
                            <strong>Ir. BAYU HADIYANTO, ST, M.Si</strong><br>
                            NIP. 19751004 200312 1 004
                        </div>
                        <div><strong>Pemeriksa Kepala Bidang Penataan Ruang</strong></div>
                    </div>
                </div>
            </td>
            <td class="signature-right">
                <div class="signature-block">
                    <div class="dotted-line" style="margin-bottom: 5px;">
                        <div class="signature-name">SUYANTO WASPO TONDO WICAKSONO</div>
                        <div>Pembina Utama Muda</div>
                        <div>NIP. 19700421 198903 1 001</div>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <div class="footer-info" style="font-size: 9pt;">
        <div>Diterbitkan Tanggal: {{ date('d F Y') }}</div>
        <div style="margin-top: 10px;">Dicetak Tanggal: {{ date('d F Y') }}</div>
    </div>

</body>
</html>
