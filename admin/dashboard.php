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
        <title>Dashboard - Admin</title>
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
                        <h1 class="mt-4">Dashboard Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard Admin</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Tiket</div>
                            <div class="card-body">
                                <button type="button" class="btn btn-primary mb-3 tombolTambahData" data-toggle="modal" data-target="#formModal">
                                    Tambah data Tiket
                                </button>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Maskapai</th>
                                                <th>Class</th>
                                                <th>Keberangkatan</th>
                                                <th>Tujuan</th>
                                                <th>Jadwal Keberangkatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No.</th>
                                                <th>Maskapai</th>
                                                <th>Class</th>
                                                <th>Keberangkatan</th>
                                                <th>Tujuan</th>
                                                <th>Jadwal Keberangkatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                        <?php 
                                        $tiket = $koneksi->select_tiket(); 
                                        $no=1; 
                                        ?>
                                        <tbody>
                                            <?php foreach ($tiket as $key): ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $key['maskapai']; ?></td>
                                                    <td><?= $key['class']; ?></td>
                                                    <td><?= $key['keberangkatan']; ?></td>
                                                    <td><?= $key['tujuan']; ?></td>
                                                    <td><?= date('d/m/Y', strtotime($key['tanggal_keberangkatan']))
                                                    .' '.date('H:i:s', strtotime($key['waktu_keberangkatan'])); ?></td>
                                                    <td>
                                                        <a href="../Koneksi.php?update_tiket" data-toggle="modal" data-target="#formModal" class="badge badge-primary ml-1 tampilModalUbah" data-id="<?=$key['id']?>">Detail</a>
                                                        <a href="../Koneksi.php?delete_tiket=<?=$key['id'] ?>" class="badge badge-danger ml-1" onclick="return confirm('Anda yakin?');">Hapus</a>
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
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="judulModal">Detail data Tiket</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../Koneksi.php?insert_tiket" method="post">
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode_tiket">Kode Tiket</label>
                                <input type="text" class="form-control" id="kode_tiket" name="kode_tiket">
                            </div>
                            <div class="form-group">
                                <label for="kode_pesawat">Kode Pesawat</label>
                                <input type="text" class="form-control" id="kode_pesawat" name="kode_pesawat">
                            </div>
                            <div class="form-group">
                                <label for="maskapai">Nama Maskapai</label>
                                <input type="text" class="form-control" id="maskapai" name="maskapai">
                            </div>
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input type="text" class="form-control" id="class" name="class">
                            </div>
                            <div class="form-group">
                                <label for="keberangkatan">Keberangkatan</label>
                                <input type="text" class="form-control" id="keberangkatan" name="keberangkatan">
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <input type="text" class="form-control" id="tujuan" name="tujuan">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_keberangkatan">Tanggal Keberangkatan</label>
                                <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan">
                            </div>
                            <div class="form-group">
                                <label for="waktu_keberangkatan">Waktu Keberangkatan</label>
                                <input type="time" class="form-control" id="waktu_keberangkatan" name="waktu_keberangkatan">
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="harga" name="harga">
                            </div>            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary" name="submit">Ubah Data</button>
                        </div>
                    </form>
                </div>
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
        <script type="text/javascript">
            $(function() {
                $('.tombolTambahData').on('click', function(){
                    $('#judulModal').html('Tambah Data Tiket');
                    $('.modal-footer button[type=submit]').html('Tambah Data');
                    $('.modal-content form')[0].reset();
                    $('.modal-content form').attr('action', '../Koneksi.php?insert_tiket');
                });

                $('.tampilModalUbah').on('click', function() {
                    $('#judulModal').html('Detail Data Tiket');
                    $('.modal-footer button[type=submit]').html('Ubah Data');
                    $('.modal-content form').attr('action', '../Koneksi.php?update_tiket');
                    const id = $(this).data('id');
                    jQuery.ajax({
                        url: '../Koneksi.php?getUpdate_Tiket',
                        data: {id : id},
                        method: 'post',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            $('#id').val(data.id);
                            $('#kode_tiket').val(data.kode_tiket);
                            $('#kode_pesawat').val(data.kode_pesawat);
                            $('#maskapai').val(data.maskapai);
                            $('#class').val(data.class);
                            $('#keberangkatan').val(data.keberangkatan);
                            $('#tujuan').val(data.tujuan);
                            $('#tanggal_keberangkatan').val(data.tanggal_keberangkatan);
                            $('#waktu_keberangkatan').val(data.waktu_keberangkatan);
                            $('#harga').val(data.harga);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
<?php else: ?>
    <?php header('location: login.php'); ?>
<?php endif ?>
