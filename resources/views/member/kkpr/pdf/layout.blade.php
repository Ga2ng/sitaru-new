<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dokumen KKPR')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }
        
        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm;
            background: #fff;
            position: relative;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #185B3C;
            padding-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #185B3C;
            margin-bottom: 10px;
        }
        
        .header h2 {
            font-size: 18px;
            color: #0F3D26;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 14px;
            color: #666;
        }
        
        .document-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .document-info h3 {
            color: #185B3C;
            font-size: 16px;
            margin-bottom: 15px;
            border-bottom: 2px solid #DAAF49;
            padding-bottom: 5px;
        }
        
        .info-grid {
            display: table;
            width: 100%;
        }
        
        .info-row {
            display: table-row;
        }
        
        .info-label {
            display: table-cell;
            width: 30%;
            font-weight: bold;
            color: #555;
            padding: 8px 0;
            vertical-align: top;
        }
        
        .info-value {
            display: table-cell;
            width: 70%;
            padding: 8px 0;
            color: #333;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            background: linear-gradient(135deg, #185B3C, #0F3D26);
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            border-radius: 6px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .data-table th {
            background: #f8f9fa;
            color: #185B3C;
            font-weight: bold;
            padding: 12px 8px;
            text-align: left;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        .data-table td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
            font-size: 11px;
        }
        
        .data-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-pengajuan {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .status-proses {
            background: #fff3e0;
            color: #f57c00;
        }
        
        .status-selesai {
            background: #e8f5e8;
            color: #388e3c;
        }
        
        .status-revisi {
            background: #ffebee;
            color: #d32f2f;
        }
        
        .footer {
            position: absolute;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        .signature-section {
            margin-top: 40px;
            display: table;
            width: 100%;
        }
        
        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 20px;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            width: 200px;
            margin: 0 auto 10px;
            height: 40px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .font-bold {
            font-weight: bold;
        }
        
        .text-sm {
            font-size: 10px;
        }
        
        .text-lg {
            font-size: 14px;
        }
        
        .mb-4 {
            margin-bottom: 16px;
        }
        
        .mt-4 {
            margin-top: 16px;
        }
        
        .p-4 {
            padding: 16px;
        }
        
        .border {
            border: 1px solid #dee2e6;
        }
        
        .rounded {
            border-radius: 4px;
        }
        
        .bg-gray-50 {
            background: #f8f9fa;
        }
        
        .text-gray-600 {
            color: #6c757d;
        }
        
        .text-green-600 {
            color: #28a745;
        }
        
        .text-red-600 {
            color: #dc3545;
        }
        
        .text-blue-600 {
            color: #007bff;
        }
        
        .text-orange-600 {
            color: #fd7e14;
        }
        
        .w-full {
            width: 100%;
        }
        
        .h-8 {
            height: 32px;
        }
        
        .flex {
            display: flex;
        }
        
        .items-center {
            align-items: center;
        }
        
        .justify-between {
            justify-content: space-between;
        }
        
        .space-x-4 > * + * {
            margin-left: 16px;
        }
        
        .grid {
            display: table;
            width: 100%;
        }
        
        .grid-cols-2 {
            display: table-row;
        }
        
        .col-span-1 {
            display: table-cell;
            width: 50%;
            padding: 8px;
            vertical-align: top;
        }
        
        .col-span-2 {
            display: table-cell;
            width: 100%;
            padding: 8px;
            vertical-align: top;
        }
        
        .no-break {
            page-break-inside: avoid;
        }
        
        .break-inside-avoid {
            page-break-inside: avoid;
        }
        
        @media print {
            .page {
                margin: 0;
                padding: 15mm;
            }
            
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <h1>SISTEM INFORMASI TATA RUANG</h1>
            <h2>SITARU</h2>
            <p>Pemerintah Kabupaten Banyuwangi</p>
        </div>
        
        <!-- Document Info -->
        <div class="document-info">
            <h3>INFORMASI DOKUMEN</h3>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Jenis Dokumen:</div>
                    <div class="info-value">@yield('document_type', 'Permohonan Persetujuan UMK')</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nomor Dokumen:</div>
                    <div class="info-value">@yield('document_number', '-')</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Cetak:</div>
                    <div class="info-value">{{ date('d F Y, H:i') }} WIB</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">@yield('document_status', 'Draft')</div>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="content">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak secara otomatis dari Sistem Informasi Tata Ruang (SITARU) Kabupaten Banyuwangi</p>
            <p>Untuk informasi lebih lanjut, hubungi: (0333) 123456 | sitaru@banyuwangikab.go.id</p>
        </div>
    </div>
</body>
</html>
