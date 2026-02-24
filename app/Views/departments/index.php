<h2>Daftar Departemen</h2>

<a href="/departments/new">Tambah Departemen</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php foreach ($departments as $dept): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $dept['department_name'] ?></td>
        <td>
            <a href="/departments/edit/<?= $dept['id'] ?>">Edit</a>
            
            <form action="/departments/<?= $dept['id'] ?>" method="post" style="display:inline;">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>