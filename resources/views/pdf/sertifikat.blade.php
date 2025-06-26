<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            padding: 40px;
        }
        .certificate {
            border: 5px solid #4F46E5;
            padding: 50px;
            border-radius: 10px;
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            font-size: 32px;
            color: #4F46E5;
            margin-bottom: 10px;
        }
        .name {
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <h1>Sertifikat Penyelesaian</h1>
        <p>Diberikan kepada:</p>
        <div class="name">{{ $user->name }}</div>
        <p>Karena telah menyelesaikan seluruh pelatihan di</p>
        <p><strong>Bersihin.Sepatu</strong></p>
        <p class="footer">Dicetak pada: {{ now()->format('d F Y') }}</p>
    </div>
</body>
</html>
