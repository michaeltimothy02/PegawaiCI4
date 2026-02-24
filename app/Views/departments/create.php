<h2>Tambah Departemen</h2>

<form action="/departments" method="post">
    <?= csrf_field() ?>
    <label>Nama Departemen</label><br>
    <input type="text" name="department_name" required><br><br>

    <button type="submit">Simpan</button>
</form>

<a href="/departments">Kembali</a>