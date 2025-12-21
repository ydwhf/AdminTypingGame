<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Skor Siswa</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tabel Skor</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="skorTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Level</th>
                                    <th>Skor</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($skor as $item) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($item['name']) ?></td>
                                        <td>
                                            <span class="badge bg-primary"><?= esc($item['level_name']) ?></span>
                                        </td>
                                        <td><strong><?= number_format($item['score'], 0, ',', '.') ?></strong></td>
                                        <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="deleteScore(<?= $item['id_score'] ?>)">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: <?= json_encode(session()->getFlashdata('error')) ?>
            });
        });
    </script>
<?php endif; ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: <?= json_encode(session()->getFlashdata('success')) ?>
            });
        });
    </script>
<?php endif; ?>

<script>
    function deleteScore(id) {
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data ini tidak bisa dikembalikan setelah dihapus.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url('score/delete/') ?>' + id;
            }
        });
    }
</script>

<?= $this->endSection() ?>