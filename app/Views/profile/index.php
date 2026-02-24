<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Profil Saya</h2>
        </div>
        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4 text-center mb-4">
                    <?php 
                        $fotoPath = (isset($employee['photo']) && $employee['photo']) ? $employee['photo'] : 'default.png';
                    ?>
                    <img src="<?= base_url('uploads/photos/' . $fotoPath) ?>" 
                         class="img-thumbnail rounded shadow-sm" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>

                <div class="col-md-8">
                    <table class="table table-striped">
                        <tr>
                            <th width="30%">NIP</th>
                            <td><?= $employee['nip'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?= $employee['name'] ?? session()->get('name') ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $employee['email'] ?? session()->get('email') ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?= (isset($employee['gender']) && $employee['gender'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td><?= $employee['phone'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Departemen</th>
                            <td><?= $employee['department_name'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td><?= $employee['position_name'] ?? '-' ?></td>
                        </tr>
                        <tr>
                            <th>Gaji</th>
                            <td><span class="badge bg-success">Rp <?= number_format($employee['salary'] ?? 0, 0, ',', '.') ?></span></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?= $employee['address'] ?? '-' ?></td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <a href="/profile/edit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit Profil
                        </a>
                        <a href="/dashboard" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>