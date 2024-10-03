<?php
    include "lib/enkripsi_decrpt.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="login_conf/js/jquery.min.js"></script>
    <script src="login_conf/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEM PENGAJUAN DP3M INTERNAL</title>
    <link rel="stylesheet" type="text/css" href="login_conf/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="login_conf/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="login_conf/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="login_conf/css/iofrm-theme5.css">
</head>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
    <div class="form-body">
        <div class="website-logo">
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="login_conf/images/logo_unikom.png" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <form name="login" method="POST" action="login_checked.php" id="f">
                    <div class="form-items">
                        <h3>SISTEM DP3M INTERNAL</h3>
                        <p>UNIVERSITAS KOMPUTER INDONESIA</p>
                        <div class="page-links">
                            <a>Login Sistem</a>
                        </div>
                            <?php
                            if (isset($_GET['st']))
                            {
                             $st = my_simple_crypt( $_GET['st'], 'd' );
                            
                            ?>
                                <div class="alert bg-maroon text-white" role="alert" style="background-color:red">
                                 <center><?php echo $st; ?></center>
                                </div>
                            <?php
                            }
                            ?>
                            <input class="form-control" type="text" name="nip" placeholder="Masukan NIP Anda" required>
                            <input class="form-control" type="password" name="pass" placeholder="Password Anda Di siakad" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">MASUK</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <!-- #modal-dialog -->
                            <div class="modal fade" id="modal-dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Pesan</h4>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        </div>
                                        <div class="modal-body">
                                            <center>Permasalahan Teknis Terkait Sistem DP3M Internal Dapat Menghubungi Kontak Sebagai Berikut<br><br>
                                                <b>angga.setiyadi@email.unikom.ac.id</b>
                                            </center><hr>
                                             <center> Penerimaan Usulan Pengabdian Internal UNIKOM Tahun Akademik 2023/2024  Akan Dilaksanakan Tanggal <font color='red'><b><br>27 April 2024 - 25 Mei 2024</b></font></center><br>
                                             <div class="text-right">
                                                <p>Ketua Divisi, <br>SIM DP3M, AKREDITASI & IT POLICY</p>
                                            </div>
                                        </div>
                                       <hr>


                                        <!--<center><a href='panduan/092. Penerimaan Usulan Penelitian Internal 2023.pdf'>Pengumuman Pembukaan dan Penerimaan Proposal Penelitian Internal 2023/2024</a></center>-->
                                       <div class="modal-footer">
                                                    <center><a href="javascript:;" class="btn btn-sm btn-success" data-dismiss="modal">Tutup</a></center>
                                                </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #modal-without-animation -->

<script>
        $(document).ready(function() {
            
             //$('#modal-dialog').modal('show');
        });
    </script>
</body>
</html>

