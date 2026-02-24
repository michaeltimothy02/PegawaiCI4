<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .page-wrap {
        max-width: 480px;
        margin: 48px auto;
        padding: 0 16px;
        font-family: 'IBM Plex Sans', sans-serif;
        color: #111;
        animation: up 0.5s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    @keyframes up {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .page-header { margin-bottom: 28px; }

    .brand {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
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

    .page-header h2 {
        font-size: 1.3rem;
        font-weight: 500;
        letter-spacing: -0.02em;
        margin-bottom: 5px;
    }

    .page-header .sub {
        font-size: 0.82rem;
        color: #999;
        font-weight: 300;
    }

    .form-card {
        background: #fff;
        border: 1px solid #e2e2e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
        position: relative;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0; left: 24px; right: 24px;
        height: 2px;
        background: #111;
        border-radius: 0 0 2px 2px;
    }

    .form-fields { padding: 8px 0; }

    .form-row {
        display: flex;
        align-items: center;
        padding: 14px 28px;
        gap: 16px;
        border-bottom: 1px solid #f5f5f3;
    }

    .form-row:last-child { border-bottom: none; }

    .form-row label {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.68rem;
        color: #aaa;
        width: 130px;
        flex-shrink: 0;
        letter-spacing: 0.06em;
        margin: 0;
    }

    .form-row input {
        flex: 1;
        padding: 8px 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.88rem;
        color: #111;
        background: #fafaf9;
        border: 1px solid #e2e2e0;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
    }

    .form-row input:focus {
        border-color: #111;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(17,17,17,0.06);
    }

    .form-row input::placeholder { color: #ccc; }

    .select-wrap {
        flex: 1;
        position: relative;
    }

    .select-wrap select {
        width: 100%;
        padding: 8px 28px 8px 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.88rem;
        color: #111;
        background: #fafaf9;
        border: 1px solid #e2e2e0;
        border-radius: 5px;
        outline: none;
        appearance: none;
        transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        cursor: pointer;
    }

    .select-wrap select:focus {
        border-color: #111;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(17,17,17,0.06);
    }

    .select-wrap::after {
        content: '';
        position: absolute;
        right: 10px; top: 50%;
        transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 5px solid #bbb;
        pointer-events: none;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        padding: 20px 28px;
        border-top: 1px solid #f0f0ee;
    }

    .btn-save {
        padding: 9px 18px;
        background: #111;
        color: #f5f5f3;
        border: none;
        border-radius: 5px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.15s, transform 0.1s;
        display: flex; align-items: center; gap: 6px;
    }

    .btn-save svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
    }

    .btn-save:hover { background: #2a2a2a; }
    .btn-save:active { transform: scale(0.99); }

    .btn-back {
        padding: 9px 18px;
        background: transparent;
        color: #888;
        border: 1px solid #e2e2e0;
        border-radius: 5px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.82rem;
        text-decoration: none;
        transition: border-color 0.15s, color 0.15s;
    }

    .btn-back:hover { border-color: #aaa; color: #555; }
</style>

<div class="page-wrap">
    <div class="page-header">
        <div class="brand">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <span class="brand-label">PORTAL PEGAWAI</span>
        </div>
        <h2>Tambah Jabatan</h2>
        <p class="sub">Tambahkan posisi baru ke dalam sistem</p>
    </div>

    <div class="form-card">
        <form action="/positions" method="post">
            <?= csrf_field() ?>

            <div class="form-fields">
                <div class="form-row">
                    <label for="position_name">nama jabatan</label>
                    <input type="text" id="position_name" name="position_name"
                           placeholder="Contoh: Staff Keuangan" required>
                </div>
                <div class="form-row">
                    <label for="department_id">departemen</label>
                    <div class="select-wrap">
                        <select id="department_id" name="department_id" required>
                            <option value="">— Pilih Departemen —</option>
                            <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['id'] ?>">
                                <?= esc($dept['department_name']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                    Simpan
                </button>
                <a href="/positions" class="btn-back">Kembali</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>