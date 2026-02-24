<h2>Edit Jabatan</h2>

<form action="/positions/<?= $position['id'] ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">

    <label>Nama Jabatan</label><br>
    <input type="text" name="position_name" value="<?= $position['position_name'] ?>" required><br><br>

    <label>Departemen</label><br>
    <select name="department_id" required>
        <?php foreach ($departments as $dept): ?>
            <option value="<?= $dept['id'] ?>"
                <?= $dept['id'] == $position['department_id'] ? 'selected' : '' ?>>
                <?= $dept['department_name'] ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Update</button>
</form>

<a href="/positions">Kembali</a>