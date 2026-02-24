<h2>Tambah Jabatan</h2>

<form action="/positions" method="post">
    <label>Nama Jabatan</label><br>
    <input type="text" name="name" required><br><br>

    <label>Departemen</label><br>
    <select name="department_id" required>
        <option value="">-- Pilih Departemen --</option>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>">
                 <?= $dept['department_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="/positions">Kembali</a>