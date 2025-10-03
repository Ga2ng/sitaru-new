<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dokumen PDF')</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
            line-height: 1.5;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20mm;
        }
        .header {
            text-align: center;
            margin-bottom: 20mm;
        }
        .header img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .header h1 {
            font-size: 16pt;
            margin: 0;
            color: #185B3C;
        }
        .header p {
            font-size: 10pt;
            margin: 2px 0;
        }
        .content {
            margin-bottom: 20mm;
        }
        .footer {
            position: fixed;
            bottom: 20mm;
            left: 20mm;
            right: 20mm;
            text-align: center;
            font-size: 8pt;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 5mm;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            border: 1px solid #eee;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }
        .section-title {
            font-size: 12pt;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 10px;
            color: #185B3C;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: bold;
            color: #fff;
        }
        .badge-success { background-color: #28a745; }
        .badge-warning { background-color: #ffc107; color: #333; }
        .badge-info { background-color: #17a2b8; }
        .badge-danger { background-color: #dc3545; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ public_path('images/logo-sitaru.png') }}" alt="Logo SITARU">
            <h1>SISTEM INFORMASI TATA RUANG</h1>
            <p>Pemerintah Kabupaten Jombang</p>
            <p>Jl. Wahid Hasyim No.135, Jombang, Jawa Timur</p>
        </div>

        <div class="content">
            @yield('content')
        </div>

        <div class="footer">
            <p>Dokumen ini dibuat secara otomatis oleh Sistem Informasi Tata Ruang Kabupaten Jombang.</p>
            <p>&copy; {{ date('Y') }} SITARU. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
