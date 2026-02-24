<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Tambah Pegawai</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/employees" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="card p-4 shadow-sm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required placeholder="Nama lengkap pegawai">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email (Untuk Login)</label>
                    <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required placeholder="contoh: budi@mail.com">
                    <small class="text-muted">*Password default: 12345</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">NIP</label>
                    <input type="text" name="nip" class="form-control" value="<?= old('nip') ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="department_id" id="department_id" class="form-select" required onchange="loadPositions(this.value)">
                        <option value="">-- Pilih Departemen --</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['id'] ?>"><?= $dept['department_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jabatan (Position)</label>
                    <select name="position_id" id="position_id" class="form-select" required>
                        <option value="">-- Pilih Departemen Dulu --</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Pilih Gender --</option>
                        <option value="L" <?= old('gender') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="P" <?= old('gender') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">No. Telepon</label>
                    <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Gaji</label>
                <input type="number" name="salary" class="form-control" value="<?= old('salary') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="address" class="form-control" rows="3" required><?= old('address') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Pegawai</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>

            <div class="mt-3">
                <a href="/employees" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Data Pegawai</button>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function loadPositions(departmentId) {
    const select = document.getElementById('position_id');
    select.innerHTML = '<option value="">Loading...</option>';

    if (!departmentId) {
        select.innerHTML = '<option value="">-- Pilih Departemen Dulu --</option>';
        return;
    }

    fetch(`/api/positions/${departmentId}`)
        .then(res => res.json())
        .then(data => {
            select.innerHTML = '<option value="">-- Pilih Jabatan --</option>';
            data.forEach(pos => {
                select.innerHTML += `<option value="${pos.id}">${pos.position_name}</option>`;
            });
        })
        .catch(err => {
            console.error('Error:', err);
            select.innerHTML = '<option value="">Gagal memuat data</option>';
        });
}
</script>
<?= $this->endSection() ?>