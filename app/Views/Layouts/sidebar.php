<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <!-- <a href="#"><img src="<?= base_url('assets/images/logo/logo.png') ?>" alt="Logo" srcset=""></a> -->
                    <i class="fas fa-user-circle"></i>
                    <span><?= ucfirst(session('username')) ?></span>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item <?= (isset($active) && $active == 'dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('/dashboard') ?>" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item <?= (isset($active) && $active == 'skor') ? 'active' : '' ?>">
                    <a href="<?= base_url('skorSiswa') ?>" class='sidebar-link'>
                        <i class="bi bi-bar-chart"></i>
                        <span>Skor Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item <?= (isset($active) && $active == 'kelola_siswa') ? 'active' : '' ?>">
                    <a href="<?= base_url('kelolaSiswa') ?>" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Kelola Siswa</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Logout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Apakah anda yakin untuk keluar?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
            </div>

        </div>
    </div>
</div>