<?php include_once '../Koneksi.php'; ?>
<?php if (!empty($_SESSION['user'])): ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - User</title>
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
                        <h1 class="mt-4">Dashboard User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard User</li>
                        </ol>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalStruk">
                            Cetak Struk
                        </button>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Tiket</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Pesawat</th>
                                                <th>Keberangkatan</th>
                                                <th>Tujuan</th>
                                                <th>Maskapai</th>
                                                <th>Class</th>
                                                <th>Waktu Keberangkatan</th>
                                                <th>Harga</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <?php 
                                        $tiket = $koneksi->select_tiket(); 
                                        $no=1; ?>
                                        <tbody>
                                            <?php foreach ($tiket as $key): ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $key['kode_pesawat']; ?></td>
                                                <td><?= $key['keberangkatan']; ?></td>
                                                <td><?= $key['tujuan']; ?></td>
                                                <td><?= $key['maskapai']; ?></td>
                                                <td><?= $key['class']; ?></td>
                                                <td><?= date('d/m/Y',strtotime($key['tanggal_keberangkatan'])).' '.$key['waktu_keberangkatan']; ?></td>
                                                <td><?= "Rp.".number_format($key['harga']).",00"; ?></td>
                                                <td>
                                                    <?php 
                                                    $result = $koneksi->cek_pemesanan_username($_SESSION['user']);
                                                    $row = $result->fetch_assoc();
                                                     ?>
                                                    <?php if ($key['status']=="Tersedia"): ?>
                                                        <a href="../koneksi.php?book_tiket=<?= $key['id'] ?>" class="badge badge-success" onclick="return confirm('Anda yakin ingin memesan Tiket?');">Book</a>
                                                    <?php elseif($row > 0): ?>
                                                        <a class="badge badge-danger" href="../koneksi.php?cancel_tiket=<?= $key['id'] ?>">Cancel</a>
                                                    <?php else: ?>
                                                        <button class="badge badge-secondary" disabled>Booked</button>
                                                    <?php endif ?>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </main>
                <!-- Modal -->
                <div class="modal fade" id="modalStruk" tabindex="-1" aria-labelledby="strukModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="strukModal">Cetak Struk Pemesanan Tiket</h5>
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
                                <?php $pemesanan = $koneksi->pilih_pemesanan($_SESSION['user']) ?>
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
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        
    </body>
</html>
<?php else: ?>
    <?php header('location: login.php'); ?>
<?php endif ?>
