<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
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
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>