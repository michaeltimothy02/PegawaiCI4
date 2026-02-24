<h2>Edit Departemen</h2>

<form action="/departments/<?= $department['id'] ?>" method="post">
    <input type="hidden" name="_method" value="PUT">

    <label>Nama Departemen</label><br>
    <input type="text" name="name" value="<?= $department['name'] ?>" required><br><br>

    <button type="submit">Update</button>
</form>

<a href="/departments">Kembali</a>