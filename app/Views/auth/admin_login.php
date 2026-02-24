<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            background: #efefed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Sans', sans-serif;
            color: #111;
        }

        .card {
            width: 380px;
            background: #fff;
            border: 1px solid #e2e2e0;
            border-radius: 8px;
            padding: 40px 36px 32px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
            animation: up 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
            position: relative;
        }

        @keyframes up {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0; left: 24px; right: 24px;
            height: 2px;
            background: #111;
            border-radius: 0 0 2px 2px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 28px;
        }

        .brand-mark {
            width: 28px; height: 28px;
            background: #111;
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }

        .brand-mark svg {
            width: 14px; height: 14px;
            stroke: #fff; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        }

        .brand-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.7rem;
            color: #aaa;
            letter-spacing: 0.08em;
        }

        /* Admin badge */
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f5f5f3;
            border: 1px solid #e2e2e0;
            border-radius: 4px;
            padding: 3px 8px;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.65rem;
            color: #888;
            letter-spacing: 0.06em;
            margin-bottom: 16px;
        }

        .admin-badge span {
            width: 6px; height: 6px;
            background: #111;
            border-radius: 50%;
            display: inline-block;
        }

        h2 {
            font-size: 1.3rem;
            font-weight: 500;
            letter-spacing: -0.02em;
            margin-bottom: 5px;
        }

        .sub {
            font-size: 0.82rem;
            color: #999;
            font-weight: 300;
            margin-bottom: 32px;
        }

        .error-box {
            font-size: 0.8rem;
            color: #b94040;
            background: #fdf5f5;
            border: 1px solid #edc8c8;
            padding: 10px 12px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-icon {
            width: 16px; height: 16px;
            background: #b94040;
            color: #fff;
            border-radius: 50%;
            font-size: 0.65rem;
            font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .field { margin-bottom: 16px; }

        label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.68rem;
            color: #aaa;
            margin-bottom: 7px;
            letter-spacing: 0.06em;
        }

        .input-wrap { position: relative; }

        .input-wrap .icon {
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            width: 14px; height: 14px;
            stroke: #ccc; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
            pointer-events: none;
        }

        input {
            width: 100%;
            padding: 10px 12px 10px 34px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 0.88rem;
            color: #111;
            background: #fafaf9;
            border: 1px solid #e2e2e0;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        }

        input:focus {
            border-color: #111;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(17,17,17,0.06);
        }

        input::placeholder { color: #ccc; }

        .btn-submit {
            width: 100%;
            margin-top: 8px;
            padding: 11px;
            background: #111;
            color: #f5f5f3;
            border: none;
            border-radius: 5px;
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s, transform 0.1s;
            display: flex; align-items: center; justify-content: center; gap: 6px;
        }

        .btn-submit .arrow {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
            transition: transform 0.2s;
        }

        .btn-submit:hover { background: #2a2a2a; }
        .btn-submit:hover .arrow { transform: translateX(3px); }
        .btn-submit:active { transform: scale(0.99); }

        .divider { height: 1px; background: #f0f0ee; margin: 24px 0 16px; }

        .footer { font-size: 0.74rem; color: #bbb; text-align: center; }
    </style>
</head>
<body>

<div class="card">
    <div class="brand">
        <div class="brand-mark">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        </div>
        <span class="brand-label">PORTAL PEGAWAI</span>
    </div>

    <div class="admin-badge"><span></span> AKSES ADMIN</div>

    <h2>Admin Login</h2>
    <p class="sub">Khusus untuk administrator sistem</p>

    <?php if(session()->getFlashdata('error')): ?>
    <div class="error-box">
        <span class="error-icon">!</span>
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>

    <form action="/admin/login" method="post">
        <div class="field">
            <label for="email">email</label>
            <div class="input-wrap">
                <input type="email" id="email" name="email" placeholder="admin@instansi.go.id" required>
                <svg class="icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
            </div>
        </div>

        <div class="field">
            <label for="password">password</label>
            <div class="input-wrap">
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                <svg class="icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            Masuk sebagai Admin
            <svg class="arrow" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
    </form>

    <div class="divider"></div>
    <p class="footer">Bukan admin? <a href="/login" style="color:#888; text-decoration:none; border-bottom: 1px solid #ddd;">Login sebagai pegawai</a></p>
</div>

</body>
</html>