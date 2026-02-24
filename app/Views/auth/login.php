<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pegawai</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #f2f2f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Sans', sans-serif;
            color: #111;
        }

        .card {
            width: 360px;
            animation: up 0.5s ease both;
        }

        @keyframes up {
            from { opacity: 0; transform: translateY(12px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .header {
            margin-bottom: 40px;
        }

        .dot {
            width: 8px; height: 8px;
            background: #111;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: 500;
            letter-spacing: -0.01em;
            color: #111;
            margin-bottom: 4px;
        }

        .sub {
            font-size: 0.82rem;
            color: #888;
            font-weight: 300;
        }

        .error-box {
            font-size: 0.8rem;
            color: #c0392b;
            background: #fff0ef;
            border: 1px solid #f5c6c2;
            padding: 10px 12px;
            margin-bottom: 24px;
            border-radius: 4px;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 0.72rem;
            font-family: 'IBM Plex Mono', monospace;
            color: #888;
            margin-bottom: 6px;
            letter-spacing: 0.04em;
        }

        input {
            width: 100%;
            padding: 10px 12px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 0.9rem;
            color: #111;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.15s;
        }

        input:focus {
            border-color: #111;
        }

        input::placeholder { color: #bbb; }

        button {
            width: 100%;
            margin-top: 8px;
            padding: 11px;
            background: #111;
            color: #f2f2f0;
            border: none;
            border-radius: 4px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        button:hover { opacity: 0.85; }
        button:active { opacity: 0.7; }

        .footer {
            margin-top: 28px;
            font-size: 0.75rem;
            color: #bbb;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="header">
        <div class="dot"></div>
        <h2>Login Pegawai</h2>
        <p class="sub">Masukkan kredensial Anda untuk melanjutkan</p>
    </div>

    <?php if (session()->getFlashdata('error')): ?>
    <div class="error-box">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <form action="/login" method="post">
        <div class="field">
            <label for="email">email</label>
            <input type="email" id="email" name="email" placeholder="nama@instansi.go.id" required>
        </div>

        <div class="field">
            <label for="password">password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>

        <button type="submit">Masuk</button>
    </form>

    <p class="footer">Hubungi admin jika ada kendala akses</p>
</div>

</body>
</html>