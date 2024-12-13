<?php
    date_default_timezone_set("Asia/Bangkok");
   
    include "config/cek_semester_aktif.php";
    include "config/koneksi.php";
    include "lib/enkripsi_decrpt.php";
    include "lib/send_email.php";
    

    $nip=urlencode($_POST['nip']);
    $pass=urlencode($_POST['pass']);

    //--------------------------------------------------------------------mode offline
    $url = "data.json";
    $json = file_get_contents($url);
    $koyim = (array)json_decode($json, true);
    $found = false;

    foreach($koyim as $data) 
    {
        //login untuk dosen
         if (($data['KARYAWAN']['nip']==$nip)&&($data['KARYAWAN']['pass']==$pass)&&($data['KARYAWAN']['dosen']=='1'))
         {
             
             
            //cek dulu reviwer atau bukan
            $sql=mysqli_query($server1,"select * from reviewer where nip_reviewer = ".$nip." and status = '1'");
            $ketemu=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);
            if ($ketemu > 0)
            {
                //jika statusnya adalah reviewer dan dosen
                //echo "dosen dan reviewer";
                //$found = true;
                session_start();
                $_SESSION['nik_user'] = $nip;
                $_SESSION['pass_user'] = $pass;
                $_SESSION['nama_user'] = $data['KARYAWAN']['nama'];
                $_SESSION['email_user']=$data['KARYAWAN']['email'];
                $_SESSION['nama_dan_gelar_user']=$data['KARYAWAN']['nama_dan_gelar'];
                
                //update reviewer untuk mendapatkan no id yang unik
                     $sql=mysqli_query($server1,"UPDATE `reviewer` SET `random_id` = FLOOR( RAND() * (20000-1000) + 100) WHERE `nip_reviewer` = '".$_SESSION['nik_user']."'");
                     $sql=mysqli_query($server1,"select * from reviewer where nip_reviewer = ".$nip." and status = '1'");
                     $r=mysqli_fetch_array($sql);
                 ?>
                 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                 <script>
                    $(document).ready(function(){
                       $('#myModal').modal({
                            backdrop: 'static',
                            keyboard: false  // to prevent closing with Esc button (if you want this too)
                        })
                    });
                </script>
                 <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php
                            $reviewer=my_simple_crypt($r['random_id']."|reviewer", 'e' );
                            $dosen=my_simple_crypt($r['random_id']."|dosen", 'e' );
                        ?>
                        <div class="modal-body">
                            <center><p>Anda adalah Reviewer dan Dosen Pengusul, Silahkan Memilih</p>
                                <hr>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $reviewer;?>" role="button">Login Sebagai Reviewer</a>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a>
                        </div>
                    </div>
                </div>
                
                 <?php
                 $found = true;
                 exit;
            }

            //cek dulu kaprodi atau bukan
            $sql = mysqli_query($server1, "SELECT * FROM kaprodi WHERE nip_kaprodi = '$nip' AND status = '1'");
            $ketemu = mysqli_num_rows($sql);

            if ($ketemu > 0) {
                //jika statusnya adalah reviewer dan dosen
                //echo "dosen dan reviewer";
                //$found = true;
                session_start();
                $_SESSION['nik_user'] = $nip;
                $_SESSION['pass_user'] = $pass;
                $_SESSION['nama_user'] = $data['KARYAWAN']['nama'];
                $_SESSION['email_user']=$data['KARYAWAN']['email'];
                $_SESSION['nama_dan_gelar_user']=$data['KARYAWAN']['nama_dan_gelar'];
                
                //update reviewer untuk mendapatkan no id yang unik
                     $sql=mysqli_query($server1,"UPDATE `kaprodi` SET `random_id` = FLOOR( RAND() * (20000-1000) + 100) WHERE `nip_kaprodi` = '".$_SESSION['nik_user']."'");
                     $sql=mysqli_query($server1,"select * from kaprodi where nip_kaprodi = ".$nip." and status = '1'");
                     $r=mysqli_fetch_array($sql);
                 ?>
                 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                 <script>
                    $(document).ready(function(){
                       $('#myModal').modal({
                            backdrop: 'static',
                            keyboard: false  // to prevent closing with Esc button (if you want this too)
                        })
                    });
                </script>
                 <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php
                            $kaprodi=my_simple_crypt($r['random_id']."|kaprodi", 'e' );
                            $dosen=my_simple_crypt($r['random_id']."|dosen", 'e' );
                        ?>
                        <div class="modal-body">
                            <center><p>Anda adalah Kaprodi dan Dosen Pengusul, Silahkan Memilih</p>
                                <hr>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $kaprodi;?>" role="button">Login Sebagai Kaprodi</a>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a>
                        </div>
                    </div>
                </div>
                
                 <?php
                 $found = true;
                 exit;
            }

            //cek dulu dekan atau bukan
            $sql = mysqli_query($server1, "SELECT * FROM dekan WHERE nip_dekan = '$nip' AND status = '1'");
            $ketemu = mysqli_num_rows($sql);

            if ($ketemu > 0) {
                //jika statusnya adalah reviewer dan dosen
                //echo "dosen dan reviewer";
                //$found = true;
                session_start();
                $_SESSION['nik_user'] = $nip;
                $_SESSION['pass_user'] = $pass;
                $_SESSION['nama_user'] = $data['KARYAWAN']['nama'];
                $_SESSION['email_user']=$data['KARYAWAN']['email'];
                $_SESSION['nama_dan_gelar_user']=$data['KARYAWAN']['nama_dan_gelar'];
                
                //update reviewer untuk mendapatkan no id yang unik
                     $sql=mysqli_query($server1,"UPDATE `dekan` SET `random_id` = FLOOR( RAND() * (20000-1000) + 100) WHERE `nip_dekan` = '".$_SESSION['nik_user']."'");
                     $sql=mysqli_query($server1,"select * from dekan where nip_dekan = ".$nip." and status = '1'");
                     $r=mysqli_fetch_array($sql);
                 ?>
                 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                 <script>
                    $(document).ready(function(){
                       $('#myModal').modal({
                            backdrop: 'static',
                            keyboard: false  // to prevent closing with Esc button (if you want this too)
                        })
                    });
                </script>
                 <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Pesan</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php
                            $dekan=my_simple_crypt($r['random_id']."|dekan", 'e' );
                            $dosen=my_simple_crypt($r['random_id']."|dosen", 'e' );
                        ?>
                        <div class="modal-body">
                            <center><p>Anda adalah Dekan dan Dosen Pengusul, Silahkan Memilih</p>
                                <hr>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dekan;?>" role="button">Login Sebagai Dekan</a>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a>
                        </div>
                    </div>
                </div>
                
                 <?php
                 $found = true;
                 exit;
            }
            //jika statusnya adalah dosen saja
            session_start();
            $_SESSION['nik_user'] = $nip;
            $_SESSION['pass_user'] = $pass;
            $_SESSION['nama_user'] = $data['KARYAWAN']['nama'];
            $_SESSION['email_user']=$data['KARYAWAN']['email'];
            $_SESSION['nama_dan_gelar_user']=$data['KARYAWAN']['nama_dan_gelar'];
            $_SESSION['role']='dosen';

            header('location:view.php');
            
            $found = true;
            exit;

          }

          //login untuk karyawan (tidak seluruh karyawan maka gunakan tabel pengguna)
          else  if (($data['KARYAWAN']['nip']==$nip)&&($data['KARYAWAN']['pass']==$pass)&&($data['KARYAWAN']['dosen']=='0'))
          {
            //echo "ini adalah karyawan";
            $sql=mysqli_query($server1,"select * from pengguna where nip = ".$nip." and status = '1'");
            $ketemu=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);

            //username 
            if ($ketemu > 0)
            {
                session_start();
                $_SESSION['nik_user'] = $nip;
                $_SESSION['pass_user'] = $pass;
                $_SESSION['nama_user'] = $data['KARYAWAN']['nama'];
                $_SESSION['email_user']=$data['KARYAWAN']['email'];
                $_SESSION['nama_dan_gelar_user']=$data['KARYAWAN']['nama_dan_gelar'];
                $_SESSION['role']=$r['role'];

                header('location:view.php');


                $found = true;
                
            }
          }
    }
    if (!$found) 
    {
        echo 'No match found';
    }
    //-------------------------------------------------------------------end mode offline