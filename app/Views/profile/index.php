<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .profile-wrap {
        max-width: 680px;
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

    /* ── Header ── */
    .profile-header { margin-bottom: 28px; }

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

    .profile-header h2 {
        font-size: 1.3rem;
        font-weight: 500;
        letter-spacing: -0.02em;
        margin-bottom: 5px;
    }

    .profile-header .sub {
        font-size: 0.82rem;
        color: #999;
        font-weight: 300;
    }

    /* ── Alert ── */
    .alert-success-box {
        font-size: 0.8rem;
        color: #1a7a4a;
        background: #f0faf4;
        border: 1px solid #b6e3cc;
        padding: 10px 12px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .success-icon {
        width: 16px; height: 16px;
        background: #1a7a4a;
        color: #fff;
        border-radius: 50%;
        font-size: 0.65rem;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    /* ── Card ── */
    .profile-body {
        background: #fff;
        border: 1px solid #e2e2e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
        position: relative;
    }

    .profile-body::before {
        content: '';
        position: absolute;
        top: 0; left: 24px; right: 24px;
        height: 2px;
        background: #111;
        border-radius: 0 0 2px 2px;
    }

    /* ── Top section ── */
    .profile-top {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 32px 28px 24px;
        border-bottom: 1px solid #f0f0ee;
    }

    .profile-photo {
        width: 68px; height: 68px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #e2e2e0;
        flex-shrink: 0;
    }

    .profile-name h3 {
        font-size: 1.05rem;
        font-weight: 500;
        margin-bottom: 3px;
    }

    .profile-name .role {
        font-size: 0.8rem;
        color: #999;
        font-weight: 300;
    }

    /* ── Fields ── */
    .profile-fields { padding: 0; }

    .field-row {
        display: flex;
        align-items: baseline;
        padding: 12px 28px;
        border-bottom: 1px solid #f5f5f3;
        gap: 16px;
    }

    .field-row:last-child { border-bottom: none; }

    .field-key {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.68rem;
        color: #aaa;
        width: 130px;
        flex-shrink: 0;
        letter-spacing: 0.06em;
    }

    .field-val {
        font-size: 0.88rem;
        color: #111;
    }

    .badge-salary {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 0.78rem;
        background: #f5f5f3;
        border: 1px solid #e2e2e0;
        padding: 2px 8px;
        border-radius: 3px;
        color: #2a7a4a;
    }

    /* ── Actions ── */
    .profile-actions {
        display: flex;
        gap: 10px;
        padding: 20px 28px;
        border-top: 1px solid #f0f0ee;
    }

    .btn-edit {
        padding: 9px 18px;
        background: #111;
        color: #f5f5f3;
        border: none;
        border-radius: 5px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.15s;
        display: flex; align-items: center; gap: 6px;
    }

    .btn-edit svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;
        transition: transform 0.2s;
    }

    .btn-edit:hover { background: #2a2a2a; color: #f5f5f3; }
    .btn-edit:hover svg { transform: translateX(2px); }

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

<div class="profile-wrap">
    <div class="profile-header">
        <div class="brand">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <span class="brand-label">PORTAL PEGAWAI</span>
        </div>
        <h2>Profil Saya</h2>
        <p class="sub">Informasi data pegawai terdaftar</p>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert-success-box">
        <span class="success-icon">✓</span>
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <div class="profile-body">
        <?php
            $fotoPath = (isset($employee['photo']) && $employee['photo']) ? $employee['photo'] : 'default.png';
        ?>

        <div class="profile-top">
            <img src="<?= base_url('uploads/photos/' . $fotoPath) ?>"
                 class="profile-photo" alt="Foto Pegawai">
            <div class="profile-name">
                <h3><?= $employee['name'] ?? session()->get('name') ?></h3>
                <p class="role"><?= $employee['position_name'] ?? '-' ?> &mdash; <?= $employee['department_name'] ?? '-' ?></p>
            </div>
        </div>

        <div class="profile-fields">
            <div class="field-row">
                <span class="field-key">nip</span>
                <span class="field-val"><?= $employee['nip'] ?? '-' ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">email</span>
                <span class="field-val"><?= $employee['email'] ?? session()->get('email') ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">jenis kelamin</span>
                <span class="field-val"><?= (isset($employee['gender']) && $employee['gender'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">no. telepon</span>
                <span class="field-val"><?= $employee['phone'] ?? '-' ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">departemen</span>
                <span class="field-val"><?= $employee['department_name'] ?? '-' ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">jabatan</span>
                <span class="field-val"><?= $employee['position_name'] ?? '-' ?></span>
            </div>
            <div class="field-row">
                <span class="field-key">gaji</span>
                <span class="field-val">
                    <span class="badge-salary">Rp <?= number_format($employee['salary'] ?? 0, 0, ',', '.') ?></span>
                </span>
            </div>
            <div class="field-row">
                <span class="field-key">alamat</span>
                <span class="field-val"><?= $employee['address'] ?? '-' ?></span>
            </div>
        </div>

        <div class="profile-actions">
            <a href="/profile/edit" class="btn-edit">
                Edit Profil
                <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
            <a href="/dashboard" class="btn-back">Kembali</a>

            <a href="<?= base_url('logout'); ?>" 
               class="btn-back" 
               style="color: #dc3545; border-color: #f5c2c7;"
               onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                Logout
            </a>
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>