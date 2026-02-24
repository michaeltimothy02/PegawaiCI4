<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Pegawai</h2>
    <a href="/employees/new" class="btn btn-primary">Tambah Pegawai</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>NIP</th>
            <th>Nama</th>
            <th>Departemen</th>
            <th>Jabatan</th>
            <th>Gaji</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= $employee['nip'] ?></td>
            <td><?= $employee['name'] ?></td>
            <td><?= $employee['department_name'] ?></td>
            <td><?= $employee['position_name'] ?></td>
            <td>Rp <?= number_format($employee['salary'], 0, ',', '.') ?></td>
            <td>
                <?php if ($employee['photo']): ?>
                    <img src="/uploads/photos/<?= $employee['photo'] ?>" width="50" class="rounded">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>
            <td>
                <a href="/employees/<?= $employee['id'] ?>/edit" class="btn btn-sm btn-warning">Edit</a>

                <?php if (session()->get('role') === 'admin'): ?>
                    <form action="/employees/<?= $employee['id'] ?>" method="post" style="display:inline">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>