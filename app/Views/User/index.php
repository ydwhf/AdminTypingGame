<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3>Data Akun Siswa</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Tabel Akun</h4>
                    <button class="btn btn-primary" onclick="showCreateUserModal()">
                        <i class="fas fa-plus"></i> Tambah Akun Siswa
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="userTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Level Unlocked</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($user as $item) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($item['name']) ?? '-' ?></td>
                                        <td>
                                            <?= esc($item['username'] ?? '-') ?>
                                        </td>
                                        <td><?= esc($item['role']) ?></td>
                                        <td>
                                            <span class="badge bg-primary"><?= esc($item['level_unlocked']) ?></span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" onclick="editUser(<?= $item['id_user'] ?>)">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteUser(<?= $item['id_user'] ?>)">
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

<!-- Modal Create User -->
<div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Akun Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('/user/create') ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">Pilih Role</option>
                            <option value="guru">Guru</option>
                            <option value="murid">Murid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Akun Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editUserForm" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="edit_username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password (kosongkan jika tidak diubah)</label>
                        <input type="password" class="form-control" id="edit_password" name="password">
                    </div>
                    <div class="mb-3">
                        <label for="edit_unlocked" class="form-label">Level Unlocked</label>
                        <select name="level_unlocked" id="edit_unlocked" class="form-select" required>
                            <option value="">Pilih Level</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select name="role" id="edit_role" class="form-select" required>
                            <option value="">Pilih Role</option>
                            <option value="guru">Guru</option>
                            <option value="murid">Murid</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= session()->getFlashdata('error') ?>'
            });
        }
    </script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




<?php if (session()->getFlashdata('error')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: '<?= session()->getFlashdata('error') ?>'
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        $('#userTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            },
            pageLength: 10,
            order: [
                [0, 'asc']
            ],
            columnDefs: [{
                orderable: false,
                targets: 5
            }]
        });
    });

    // FIX: nama fungsi HARUS deleteUser karena tombol manggil itu
    function deleteUser(id) {
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
                window.location.href = '<?= base_url('user/delete/') ?>' + id;
            }
        });
    }

    function editUser(id) {
        $('#editUserForm').attr('action', '<?= base_url("user/update/") ?>' + id);

        $.ajax({
            url: '<?= base_url("user/get/") ?>' + id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#edit_name').val(data.name);
                $('#edit_username').val(data.username);
                $('#editUserModal').modal('show');
            },
            error: function() {
                Swal.fire('Error', 'Gagal mengambil data user!', 'error');
            }
        });
    }

    function showCreateUserModal() {
        $('#createUserModal').modal('show');
    }
</script>

<?= $this->endSection() ?>