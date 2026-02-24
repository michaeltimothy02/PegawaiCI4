<h2>Daftar Jabatan</h2>

<a href="/positions/new">Tambah Jabatan</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Departemen</th>
        <th>Aksi</th>
    </tr>

    <?php $no = 1; ?>
    <?php foreach ($positions as $pos): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $pos['name'] ?></td>
        <td><?= $pos['position_name'] ?></td>
        <td>
            <a href="/positions/edit/<?= $pos['id'] ?>">Edit</a>

            <form action="/positions/<?= $pos['id'] ?>" method="post" style="display:inline;">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>