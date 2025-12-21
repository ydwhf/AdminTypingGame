   <?= $this->extend('layouts/main') ?>
   <?= $this->section('content') ?>

   <div class="page-heading">
       <h3>Dashboard</h3>
   </div>
   <div class="page-content">
       <section class="row">
           <div class="col-12 col-lg-9">
               <div class="row">
                   <div class="col-6 col-lg-3 col-md-6">
                       <div class="card">
                           <div class="card-body px-3 py-4-5">
                               <div class="d-flex align-items-center stats-wrapper">
                                   <div class="stats-icon purple">
                                       <i class="iconly-boldProfile"></i>
                                   </div>
                                   <div class="stats-content">
                                       <h6 class="text-muted mb-1">Total Siswa</h6>
                                       <h4 class="mb-0 fw-bold"><?= $totalUsers ?></h4>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-6 col-lg-3 col-md-6">
                       <div class="card">
                           <div class="card-body px-3 py-4-5">
                               <div class="d-flex align-items-center stats-wrapper">
                                   <div class="stats-icon blue">
                                       <i class="fas fa-file-alt"></i>
                                   </div>
                                   <div class="stats-content">
                                       <h6 class="text-muted mb-1">Total Soal</h6>
                                       <h4 class="mb-0 fw-bold">30</h4>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-6 col-lg-3 col-md-6">
                       <div class="card">
                           <div class="card-body px-3 py-4-5">
                               <div class="d-flex align-items-center stats-wrapper">
                                   <div class="stats-icon green">
                                       <i class="fas fa-layer-group"></i>
                                   </div>
                                   <div class="stats-content">
                                       <h6 class="text-muted mb-1">Total Level</h6>
                                       <h4 class="mb-0 fw-bold"><?= $totalLevel ?></h4>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-6 col-lg-3 col-md-6">
                       <div class="card">
                           <div class="card-body px-3 py-4-5">
                               <div class="d-flex align-items-center stats-wrapper">
                                   <div class="stats-icon red">
                                       <i class="iconly-boldBookmark"></i>
                                   </div>
                                   <div class="stats-content">
                                       <h6 class="text-muted mb-1">Total Tes</h6>
                                       <h4 class="mb-0 fw-bold"><?= $totalBermain ?></h4>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                               <h4>Perkembangan Skor Siswa</h4>
                               <small>Rata-rata skor per hari</small>
                           </div>
                           <div class="card-body">
                               <canvas id="scoreChart" height="100"></canvas>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="row mb-3">
                   <div class="col-md-4">
                       <label class="form-label fw-bold">Filter Siswa</label>
                       <select id="filterUser" class="form-select">
                           <option value="">-- Pilih Siswa --</option>
                           <?php foreach ($dataUsers as $user) : ?>
                               <option value="<?= $user['id_user']; ?>">
                                   <?= esc($user['name']); ?>
                               </option>
                           <?php endforeach; ?>
                       </select>
                   </div>
               </div>

               <div class="row">
                   <div class="col-12">
                       <div class="card">
                           <div class="card-header">
                               <h4>Progress Skor Siswa (Per Main)</h4>
                               <small>Riwayat skor setiap kali siswa bermain</small>
                           </div>
                           <div class="card-body">
                               <canvas id="progressChart" height="120"></canvas>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="col-12 col-lg-3">
               <div class="card">
                   <div class="card-body py-4 px-5">
                       <div class="d-flex align-items-center">
                           <div class="avatar avatar-xl">
                               <img src="assets/images/faces/2.jpg" alt="Face 1">
                           </div>
                           <div class="ms-3 name">
                               <h5 class="font-bold"><?= ucfirst(session('name')) ?></h5>
                               <h6 class="text-muted mb-0">@<?= session('username') ?></h6>
                           </div>
                       </div>
                   </div>
               </div>

               <?php if (!empty($leaderboard)) : ?>
                   <?php foreach ($leaderboard as $levelName => $players) : ?>

                       <div class="card mb-4">
                           <div class="card-header">
                               <h4>🏆 Leaderboard <?= esc($levelName) ?></h4>
                           </div>

                           <div class="card-content pb-4">

                               <?php
                                $medal = ['🥇', '🥈', '🥉'];
                                ?>

                               <?php foreach ($players as $index => $row) : ?>
                                   <div class="recent-message d-flex px-4 py-3 align-items-center <?= $index === 0 ? 'bg-light-primary' : '' ?>">

                                       <div class="avatar avatar-lg">
                                           <img src="<?= base_url('assets/images/faces/' . ($index + 1) . '.jpg') ?>">
                                       </div>

                                       <div class="name ms-4">
                                           <h5 class="mb-1">
                                               <?= $medal[$index] ?> <?= esc($row['name']) ?>
                                           </h5>

                                           <h6 class="text-muted mb-0">
                                               Skor: <?= esc($row['best_score']) ?>
                                           </h6>
                                       </div>

                                   </div>
                               <?php endforeach ?>

                           </div>
                       </div>

                   <?php endforeach ?>
               <?php else : ?>
                   <div class="alert alert-info">
                       Belum ada data leaderboard.
                   </div>
               <?php endif ?>
           </div>
       </section>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

   <script>
       const labels = <?= json_encode($labels) ?>;
       const scores = <?= json_encode($scores) ?>;

       const ctx = document.getElementById('scoreChart').getContext('2d');

       new Chart(ctx, {
           type: 'line',
           data: {
               labels: labels,
               datasets: [{
                   label: 'Rata-rata Skor',
                   data: scores,
                   borderWidth: 2,
                   tension: 0.4,
                   fill: true
               }]
           },
           options: {
               scales: {
                   y: {
                       beginAtZero: true,
                       max: 100
                   }
               }
           }
       });
   </script>
   <script>
       const ctxProgress = document.getElementById('progressChart').getContext('2d');

       const progressChart = new Chart(ctxProgress, {
           type: 'line',
           data: {
               labels: [], // awal kosong
               datasets: [{
                   label: 'Skor',
                   data: [],
                   borderWidth: 2,
                   tension: 0.4,
                   fill: false
               }]
           },
           options: {
               responsive: true,
               scales: {
                   y: {
                       beginAtZero: true
                   }
               }
           }
       });
   </script>

   <script>
       document.getElementById('filterUser').addEventListener('change', function() {
           const idUser = this.value;

           if (!idUser) return;

           fetch(`<?= base_url('dashboard/progress'); ?>/${idUser}`)
               .then(res => res.json())
               .then(data => {
                   progressChart.data.labels = data.labels;
                   progressChart.data.datasets[0].data = data.scores;
                   progressChart.update();
               });
       });
   </script>

   <?= $this->endSection() ?>