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
            <td class="value-col">{{ $model->atas_nama ?? 'PT BISMILLAH BERKAH ABADI' }}</td>
        </tr>
        <tr>
            <td class="label-col">b.</td>
            <td class="field-col">Nama Penanggung jawab</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ strtoupper($model->user->name) }}</td>
        </tr>
        <tr>
            <td class="label-col">c.</td>
            <td class="field-col">NIB</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->no_nib ?? '1109250010578' }}</td>
        </tr>
        <tr>
            <td class="label-col">d.</td>
            <td class="field-col">Diterbitkan tanggal</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->tgl_terbit ?? '11 September 2025' }}</td>
        </tr>
        <tr>
            <td class="label-col">e.</td>
            <td class="field-col">Kode KBLI</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->kkpr_kbli->first()->kode_kbli ?? '86903' }}</td>
        </tr>
        <tr>
            <td class="label-col">f.</td>
            <td class="field-col">Jenis KBLI</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->kkpr_kbli->first()->judul_kbli ?? 'Aktivitas Pelayanan Penunjang Kesehatan' }}</td>
        </tr>
        <tr>
            <td class="label-col">g.</td>
            <td class="field-col">Lokasi Usaha</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $kel->NAMA_KEL ?? 'Setail' }}, Kecamatan {{ $kec->NAMA_KEC ?? 'Genteng' }}</td>
        </tr>
        <tr>
            <td class="label-col">h.</td>
            <td class="field-col">Penggunaan Lahan saat ini</td>
            <td class="colon-col">:</td>
            <td class="value-col">Lahan terdapat bangunan lama</td>
        </tr>
        <tr>
            <td class="label-col">i.</td>
            <td class="field-col">Luas tanah yang dimohon</td>
            <td class="colon-col">:</td>
            <td class="value-col">{{ $model->luas_dimohon ?? '474' }} m² pada Sertifikat Hak Milik Nomor {{ $model->no_sertifikat ?? '1308' }} Tahun {{ $model->thn_sertifikat ?? '2000' }} pada status sebidang tanah perumahan</td>
        </tr>
    </table>

    <!-- Section 2: Dinyatakan terhadap rencana tata ruang -->
    <div class="section-title">2. Dinyatakan terhadap rencana tata ruang <span class="bold-underline">Sesuai Bersyarat</span> / <span class="strikethrough">Sesuai Sebagian</span> / <span class="strikethrough">Tidak Sesuai</span> dengan ketentuan:</div>
    
    <table style="width: 100%;">
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
                        <td class="field-col">Rencana Pemanfataan Ruang</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">Perdagangan dan Jasa Skala Kota (K-1)</td>
                    </tr>
                    <tr>
                        <td class="label-col">c.</td>
                        <td class="field-col">Status Lahan Sawah Dilindungi</td>
                        <td class="colon-col">:</td>
                        <td class="value-col"><span class="bold-underline">Berada</span> / <span class="strikethrough">Tidak Berada</span></td>
                    </tr>
                    <tr>
                        <td class="label-col">d.</td>
                        <td class="field-col">KDB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kdb ?? '60' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">e.</td>
                        <td class="field-col">KLB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->klb ?? '2.4' }}</td>
                    </tr>
                    <tr>
                        <td class="label-col">f.</td>
                        <td class="field-col">KDH (min)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->kdh ?? '15' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">g.</td>
                        <td class="field-col">KTB (maks)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->ktb ?? '60' }}%</td>
                    </tr>
                    <tr>
                        <td class="label-col">h.</td>
                        <td class="field-col">Garis Sempadan Bangunan (min)</td>
                        <td class="colon-col">:</td>
                        <td class="value-col">{{ $model->gsb ?? '10' }} meter (jalan kolektor primer)</td>
                    </tr>
                    <tr>
                        <td class="label-col">i.</td>
                        <td class="field-col">Tinggi Bangunan (maks)</td>
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
    
    <div class="consideration-list">
        <div style="margin: 10px 0;">
            <strong>a. Peraturan Bupati Banyuwangi Nomor 55 Tahun 2024 tentang Rencana Detail Tata Ruang Wilayah Perencanaan Genteng Tahun 2024-2044</strong>
        </div>
        <div style="margin: 10px 0;">
            <strong>b. Surat Keputusan Menteri Agraria Dan Tata Ruang/ Kepala Badan Pertanahan Nasional Nomor 1589/SK-Hk.02.01/XII/2021 Tentang Penetapan Peta Lahan Sawah Yang Dilindungi Pada Kabupaten/Kota</strong>
        </div>
        <div style="margin: 10px 0;">
            <strong>c. Ketentuan penggunaan lahan untuk kegiatan Kode KBLI {{ $model->kkpr_kbli->first()->kode_kbli ?? '86903' }} pada zona perdagangan dan jasa skala kota (K-1):</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li>Berkoordinasi dengan instansi teknis terkait dengan Persetujuan Teknis Analisis mengenai Dampak Lalu Lintas sesuai dengan kekewenangan dan ketentuan yang berlaku</li>
                <li>Mendapatkan rekomendasi garis sempadan sungai/saluran dari instansi teknis terkait sesuai dengan ketentuan</li>
                <li>Wajib mendapatkan rekomendasi/izin dari instansi terkait sesuai dengan ketentuan peraturan yang berlaku</li>
                <li>Tampak bangunan depan mengikuti kearifan lokal Kabupaten Banyuwangi</li>
                <li>Wajib mencukupi dan menyediakan parkir kendaraan, kebutuhan aksesibilitas, kebutuhan ruang loading, unloading dan/atau tempat penampungan barang didalam kavling/persil di dalam kavling/persil</li>
            </ol>
        </div>
        <div style="margin: 10px 0;">
            <strong>d. Keterangan lain yang dianggap perlu:</strong>
            <ol style="margin: 10px 0; padding-left: 20px;">
                <li>Surat ini hanya menunjukan informasi peruntukan rencana penggunaan ruang yang diperbolehkan sesuai dengan rencana umum/rinci tata ruang dan bukan menyatakan bukti kepemilikan hak atas tanah.</li>
                <li>Surat ini dianggap tidak berlaku apabila di kemudian hari terjadi sengketa atas tanah, kepemilikan, dan keterangan yang diajukan dalam permohonan ini ternyata tidak benar ataupun dipalsukan di kemudian hari.</li>
            </ol>
        </div>
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

    <div class="footer-info">
        <div>Diterbitkan Tanggal: {{ date('d F Y') }}</div>
        <div style="margin-top: 20px;">Dicetak Tanggal: {{ date('d F Y') }}</div>
    </div>


</body>
</html>
