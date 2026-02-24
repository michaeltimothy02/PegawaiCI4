<h2>Profil Saya</h2>

<?php if (session()->getFlashdata('success')): ?>
    <div style="background:#e0ffe0; padding:10px; margin-bottom:15px; border:1px solid green;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<table border="1" cellpadding="10">
    <tr>
        <td><strong>Foto</strong></td>
<td>
    <?php if ($employee['photo']): ?>
        <img src="<?= base_url('uploads/photos/' . $employee['photo']) ?>" width="100">
    <?php else: ?>
        -
    <?php endif; ?>
</td>
    </tr>
    <tr>
        <td><strong>NIP</strong></td>
        <td><?= $employee['nip'] ?></td>
    </tr>
    <tr>
        <td><strong>Nama</strong></td>
        <td><?= $employee['name'] ?></td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td><?= $employee['email'] ?></td>
    </tr>
    <tr>
        <td><strong>Departemen</strong></td>
        <td><?= $employee['department_name'] ?></td>
    </tr>
    <tr>
        <td><strong>Jabatan</strong></td>
        <td><?= $employee['position_name'] ?></td>
    </tr>
    <tr>
        <td><strong>Gaji</strong></td>
        <td>Rp <?= number_format($employee['salary'], 0, ',', '.') ?></td>
    </tr>
</table>

<br>
<a href="/profile/edit">Edit Profil</a>