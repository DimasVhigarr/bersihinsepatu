<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat Penyelesaian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background: #f8f9ff;
            padding: 50px;
        }
        .certificate {
            background: white;
            border: 8px solid #4F46E5;
            border-radius: 12px;
            padding: 40px 20px;
            max-width: 900px;
            margin: 0 auto;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .certificate img.logo {
            height: 80px;
            margin-bottom: 10px;
        }
        .certificate h1 {
            font-size: 36px;
            color: #4F46E5;
            margin-bottom: 10px;
        }
        .certificate p {
            font-size: 16px;
            color: #444;
            margin: 10px 0;
        }
        .certificate .name {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0;
            color: #111;
        }
        .certificate .organization {
            font-weight: bold;
            font-size: 18px;
            color: #4F46E5;
            margin-top: 10px;
        }
        .signature-block {
    margin-top: 60px;
    text-align: center;
}

.signature-line {
    border-bottom: 1px solid #333;
    width: 150px;
    margin: 0 auto 5px auto; /* center the line */
}

        .signature-block p {
            font-size: 14px;
            margin: 2px 0;
            color: #444;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ public_path('images/logo.jpg') }}" class="logo" alt="Logo">
        
        <p style="font-size: 14px; color: #555;">
            No. Sertifikat: <strong>{{ $kodeUnik }}</strong>
        </p>

        <h1 style="margin-top: -5px;">SERTIFIKAT PENYELESAIAN</h1>

        <p>Dengan bangga diberikan kepada:</p>
        <div class="name">{{ $user->name }}</div>

        <p>Atas partisipasi dan penyelesaian seluruh pelatihan yang diselenggarakan oleh:</p>
        <div class="organization">Bersihin.Sepatu</div>

        <div class="signature-block">
            <img src="{{ public_path('images/ttd.jpg') }}" alt="Tanda Tangan" style="height: 130px; margin-bottom: 5px;">
            <div class="signature-line"></div>
            <p><strong>Direktur</strong></p>
            <p>Bersihin.Sepatu</p>
        </div>

        <div class="footer">
            Sertifikat ini merupakan bukti resmi bahwa peserta telah menyelesaikan semua pelatihan yang diwajibkan oleh Penyelenggara.
        </div>
        
        <div class="footer">
            Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>
        
    </div>
</body>
</html>
