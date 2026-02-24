<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500&family=IBM+Plex+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
    .edit-wrap {
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
    .edit-header { margin-bottom: 28px; }

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

    .edit-header h2 {
        font-size: 1.3rem;
        font-weight: 500;
        letter-spacing: -0.02em;
        margin-bottom: 5px;
    }

    .edit-header .sub {
        font-size: 0.82rem;
        color: #999;
        font-weight: 300;
    }

    /* ── Error box ── */
    .error-box {
        font-size: 0.8rem;
        color: #b94040;
        background: #fdf5f5;
        border: 1px solid #edc8c8;
        padding: 12px 14px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: flex;
        gap: 10px;
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
        margin-top: 1px;
    }

    .error-list { list-style: none; display: flex; flex-direction: column; gap: 4px; }
    .error-list li::before { content: '— '; color: #d08080; }

    /* ── Card ── */
    .edit-body {
        background: #fff;
        border: 1px solid #e2e2e0;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.06), 0 1px 4px rgba(0,0,0,0.04);
        position: relative;
    }

    .edit-body::before {
        content: '';
        position: absolute;
        top: 0; left: 24px; right: 24px;
        height: 2px;
        background: #111;
        border-radius: 0 0 2px 2px;
    }

    /* ── Photo section ── */
    .photo-section {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 28px 28px 24px;
        border-bottom: 1px solid #f0f0ee;
    }

    .photo-preview {
        width: 68px; height: 68px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #e2e2e0;
        flex-shrink: 0;
    }

    .photo-placeholder {
        width: 68px; height: 68px;
        border-radius: 50%;
        background: #f5f5f3;
        border: 1px dashed #d0d0ce;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .photo-placeholder svg {
        width: 22px; height: 22px;
        stroke: #ccc; fill: none;
        stroke-width: 1.5; stroke-linecap: round; stroke-linejoin: round;
    }

    .photo-info h4 {
        font-size: 0.88rem;
        font-weight: 500;
        margin-bottom: 4px;
    }

    .photo-info p {
        font-size: 0.76rem;
        color: #aaa;
        margin-bottom: 10px;
    }

    .btn-upload {
        display: inline-block;
        padding: 6px 14px;
        background: #f5f5f3;
        border: 1px solid #e2e2e0;
        border-radius: 4px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.78rem;
        color: #555;
        cursor: pointer;
        transition: border-color 0.15s, color 0.15s;
    }

    .btn-upload:hover { border-color: #aaa; color: #111; }

    input[type="file"] { display: none; }

    /* ── Form fields ── */
    .form-fields { padding: 8px 0; }

    .form-row {
        display: flex;
        align-items: center;
        padding: 10px 28px;
        border-bottom: 1px solid #f5f5f3;
        gap: 16px;
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

    .form-row input,
    .form-row select {
        flex: 1;
        padding: 8px 10px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.88rem;
        color: #111;
        background: #fafaf9;
        border: 1px solid #e2e2e0;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.15s, box-shadow 0.15s, background 0.15s;
        appearance: none;
    }

    .form-row input:focus,
    .form-row select:focus {
        border-color: #111;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(17,17,17,0.06);
    }

    .form-row input::placeholder { color: #ccc; }

    .select-wrap {
        flex: 1;
        position: relative;
    }

    .select-wrap select { width: 100%; padding-right: 28px; }

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

    .field-readonly {
        flex: 1;
        padding: 8px 10px;
        background: #f5f5f3;
        border: 1px solid #e2e2e0;
        border-radius: 5px;
        font-family: 'IBM Plex Sans', sans-serif;
        font-size: 0.88rem;
        color: #999;
        cursor: not-allowed;
    }

    /* ── Actions ── */
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
        transition: background 0.15s;
        display: flex; align-items: center; gap: 6px;
    }

    .btn-save svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round;
        transition: transform 0.2s;
    }

    .btn-save:hover { background: #2a2a2a; }
    .btn-save:hover svg { transform: translateX(2px); }
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

<div class="edit-wrap">
    <div class="edit-header">
        <div class="brand">
            <div class="brand-mark">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
            </div>
            <span class="brand-label">PORTAL PEGAWAI</span>
        </div>
        <h2>Edit Profil</h2>
        <p class="sub">Perbarui informasi data pegawai Anda</p>
    </div>

    <?php if (!empty($errors)): ?>
    <div class="error-box">
        <span class="error-icon">!</span>
        <ul class="error-list">
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="edit-body">
        <form action="/profile/update" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Photo -->
            <div class="photo-section">
                <?php if (!empty($employee['photo'])): ?>
                    <img src="/uploads/photos/<?= $employee['photo'] ?>" class="photo-preview" id="photoPreview" alt="Foto">
                <?php else: ?>
                    <div class="photo-placeholder" id="photoPlaceholder">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <img src="" class="photo-preview" id="photoPreview" alt="Foto" style="display:none;">
                <?php endif; ?>
                <div class="photo-info">
                    <h4>Foto Profil</h4>
                    <p>JPG atau PNG, maks. 2MB</p>
                    <label for="photoInput" class="btn-upload">Ganti Foto</label>
                    <input type="file" id="photoInput" name="photo" accept="image/*">
                </div>
            </div>

            <!-- Fields -->
            <div class="form-fields">
                <div class="form-row">
                    <label for="nip">nip</label>
                    <input type="text" id="nip" name="nip" value="<?= $employee['nip'] ?>" placeholder="Nomor Induk Pegawai" required>
                </div>
                <div class="form-row">
                    <label for="name">nama</label>
                    <input type="text" id="name" name="name" value="<?= $employee['name'] ?>" placeholder="Nama lengkap" required>
                </div>
                <div class="form-row">
                    <label for="department_id">departemen</label>
                    <div class="select-wrap">
                        <select id="department_id" name="department_id" required onchange="loadPositions(this.value)">
                            <option value="">— Pilih Departemen —</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>" <?= $dept['id'] == $employee['department_id'] ? 'selected' : '' ?>>
                                    <?= $dept['department_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <label>jabatan</label>
                    <div class="field-readonly"><?= esc($employee['position_name'] ?? '-') ?></div>
                </div>
                <div class="form-row">
                    <label for="salary">gaji</label>
                    <input type="number" id="salary" name="salary" value="<?= $employee['salary'] ?>" placeholder="0" required>
                </div>
            </div>

            <!-- Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    Simpan
                    <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                </button>
                <a href="/profile" class="btn-back">Kembali</a>
            </div>

        </form>
    </div>
</div>

<script>
// Photo preview
document.getElementById('photoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('photoPreview');
        const placeholder = document.getElementById('photoPlaceholder');
        preview.src = e.target.result;
        preview.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

// Load positions
function loadPositions(departmentId) {
    const select = document.getElementById('position_id');
    select.innerHTML = '<option value="">Loading...</option>';
    fetch(`/api/positions/${departmentId}`)
        .then(res => res.json())
        .then(data => {
            select.innerHTML = '<option value="">— Pilih Jabatan —</option>';
            data.forEach(pos => {
                const selected = pos.id == <?= $employee['position_id'] ?? 'null' ?> ? 'selected' : '';
                select.innerHTML += `<option value="${pos.id}" ${selected}>${pos.position_name}</option>`;
            });
        });
}

// Load positions on page ready if department already selected
window.addEventListener('DOMContentLoaded', () => {
    const deptId = document.getElementById('department_id').value;
    if (deptId) loadPositions(deptId);
});
</script>

<?= $this->endSection() ?>