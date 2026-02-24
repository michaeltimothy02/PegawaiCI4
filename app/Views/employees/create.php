<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

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

    <div class="mb-3">
        <label class="form-label">NIP</label>
        <input type="text" name="nip" class="form-control" value="<?= old('nip') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Departemen</label>
        <select name="department_id" id="department_id" class="form-select" required onchange="loadPositions(this.value)">
            <option value="">-- Pilih Departemen --</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>"><?= $dept['department_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Jabatan</label>
        <select name="position_id" id="position_id" class="form-select" required>
            <option value="">-- Pilih Departemen Dulu --</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Gaji</label>
        <input type="number" name="salary" class="form-control" value="<?= old('salary') ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
    </div>

    <a href="/employees" class="btn btn-secondary">Kembali</a>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

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
        });
}
</script>
<?= $this->endSection() ?>