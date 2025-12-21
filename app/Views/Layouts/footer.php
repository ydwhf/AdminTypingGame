<script src="<?= base_url('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendors/apexcharts/apexcharts.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/dashboard.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    $(document).ready(function() {
        $('#skorTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/id.json'
            },
            pageLength: 10,
            order: [
                [0, 'asc']
            ], // Urutkan berdasarkan tanggal terbaru
            columnDefs: [{
                    orderable: false,
                    targets: 5
                } // Kolom aksi tidak bisa diurutkan
            ]
        });
    });
</script>
</body>

</html>