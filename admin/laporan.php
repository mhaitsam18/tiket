<?php include_once '../Koneksi.php'; ?>
<?php if (!empty($_SESSION['admin'])): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Laporan - Admin</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/bootstrap.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include_once 'sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Laporan Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Laporan Admin</li>
                        </ol>
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#cetakLaporan">
                            Cetak Laporan
                        </button>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Laporan</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Username</th>
                                                <th>Kode Tiket</th>
                                                <th>Waktu Pemesanan</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $total = 0;
                                        $pemesanan = $koneksi->select_pemesanan(); 
                                        $no=1; 
                                        ?>
                                        <tbody>
                                            <?php foreach ($pemesanan as $key): ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $key['username']; ?></td>
                                                    <td><?= $key['kode_tiket']; ?></td>
                                                    <td><?= $key['tanggal_pemesanan']; ?></td>
                                                    <td><?= 'Rp. '.number_format($key['harga']).',00'; ?></td>
                                                </tr>
                                                <?php $total += $key['harga']; ?>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">Total</th>
                                                <th><?= 'Rp. '.number_format($total).',00' ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <!-- Modal -->
                <div class="modal fade" id="cetakLaporan" tabindex="-1" aria-labelledby="labelLaporan" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="labelLaporan">Cetak Laporan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6>Kode Tiket</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6>Harga Tiket</h6>
                                    </div>
                                </div>
                                <?php $total = 0; ?>
                                <?php $pemesanan = $koneksi->select_pemesanan() ?>
                                <?php foreach ($pemesanan as $key): ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <?= $key['kode_tiket'] ?>
                                        </div>
                                        <div class="col-lg-6">
                                            <?= 'Rp. '.number_format($key['harga']).'.00' ?>
                                        </div>
                                    </div>
                                    <?php $total += $key['harga']; ?>
                                <?php endforeach ?>
                                <br>
                                <hr>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6>Total :</h6>
                                    </div>
                                    <div class="col-lg-6">
                                        <h6><?= 'Rp. '.number_format($total).'.00' ?></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="button" class="btn btn-primary">Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Tiket 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
    </body>
</html>
<?php else: ?>
    <?php header('location: login.php'); ?>
<?php endif ?>
