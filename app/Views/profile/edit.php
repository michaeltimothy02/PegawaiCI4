<h2>Edit Profil</h2>

<?php if (!empty($errors)): ?>
    <div style="background:#ffe0e0; padding:10px; margin-bottom:15px; border:1px solid red;">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="/profile/update" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <label>NIP</label><br>
    <input type="text" name="nip" value="<?= $employee['nip'] ?>" required><br><br>

    <label>Nama</label><br>
    <input type="text" name="name" value="<?= $employee['name'] ?>" required><br><br>

    <label>Departemen</label><br>
    <select name="department_id" id="department_id" required onchange="loadPositions(this.value)">
        <option value="">-- Pilih Departemen --</option>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>" <?= $dept['id'] == $employee['department_id'] ? 'selected' : '' ?>>
                <?= $dept['department_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Gaji</label><br>
    <input type="number" name="salary" value="<?= $employee['salary'] ?>" required><br><br>

    <label>Foto</label><br>
    <?php if ($employee['photo']): ?>
        <img src="/uploads/photos/<?= $employee['photo'] ?>" width="80"><br>
    <?php endif; ?>
    <input type="file" name="photo" accept="image/*"><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="/profile">Kembali</a>

<script>
function loadPositions(departmentId) {
    const select = document.getElementById('position_id');
    select.innerHTML = '<option value="">Loading...</option>';

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