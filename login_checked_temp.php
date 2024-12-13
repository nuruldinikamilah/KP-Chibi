<?php
  session_start();
   date_default_timezone_set("Asia/Bangkok");
   
    include "config/cek_semester_aktif.php";
    include "config/koneksi.php";
    include "lib/enkripsi_decrpt.php";
    include "lib/send_email.php";
    


    $tahun_aktif='2023';
    $semester_aktif='genap';


?>

<?php

function decode_jwt($jwt) {
  return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1]))));
}

if (isset($_GET['signout'])) 
{
  session_destroy();
  header('Location: https://jpi.unikom.ac.id/pengajuanproposal/');
  exit();
}

// Setelah berhasil Login, Google akan redirect dengan mengirimkan variabel $_POST['credential'] & $_POST['g_csrf_token']
if (isset($_POST['credential'], $_POST['g_csrf_token'])) 
{
  // $_POST['credential'] berisi JWT Token
  // Gunakan function ini untuk decode isi token, hasil decoding berupa sebuah object
  $res = decode_jwt($_POST['credential']);
  //print_r($res);
  
  // Selanjutnya gunakan data credential untuk keperluan session, database, dll
  // Tidak ada NIM atau NIP, jadi gunakan email untuk selanjutnya query ke database
  // Di bawah ini hanya contoh
      
  $_SESSION['status'] = 0;
  
  if (in_array($res->hd, ['email.unikom.ac.id', 'mahasiswa.unikom.ac.id'])) 
  {   
    $_SESSION['is_login'] = true;
    $_SESSION['email'] = $res->email;
    $_SESSION['nama'] = $res->name;
    $_SESSION['picture'] = $res->picture;
    $_SESSION['status'] = ($res->hd == 'email.unikom.ac.id') ? 1: 2;
  }
}

?>

    <!-- Wajib load script ini -->
  <script src="https://accounts.google.com/gsi/client" async></script>
  </head>
  <body>
  <?php if (isset($_SESSION['status']) && ($_SESSION['status'] == 0)): ?>
  <p>Tidak Dapat Login Selain Menggunakan Akun Google Suite - UNIKOM</p>
  <?php endif; ?>
  
  <?php  if (!isset($_SESSION['is_login'])): // Sebelum Login ?>
 
   



   <?php else: // Setelah Login ?>
    <?php
      //contoh
        /*echo "<pre>";isset($res) ? print_r($res): null;
        echo "<p>status".($_SESSION['status'] == 1)."'Dosen/Karyawan': 'Mahasiswa'";
        echo "<p>Nama : ".($_SESSION['nama']);
        echo "<p><a href='https://jpi.unikom.ac.id/PSTAIF/siap/login_checked.php?signout'>Sign Out</a></p>";*/


        //MULAI DARI SINI
        //jika email tidak ditemukan atau null
        if (isset($_SESSION['email']))
        {
           //echo "<pre>";isset($res) ? print_r($res): null;
            //untuk persetujuan kaprodi
            $sql=mysqli_query($server1,"SELECT *
                                                                      FROM
                                                                      integrasi.pejabat a
                                                                      INNER JOIN
                                                                      integrasi.karyawan b
                                                                      ON a.`nip`=b.`nip`
                                                                      where b.email='".$_SESSION['email']."'
                                        ");
            $ketemu_kaprodi=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);
            $_SESSION['jenis_jabatan']=$r['jenis_jabatan'];

            


            //cek dulu ketemu_direktur_dosen_reviewer
            $sql=mysqli_query($server1,"SELECT 
                                         a.`nip`,
                                         a.`role`,
                                         a.`random_id` AS 'random_dir_lppm',
                                         b.`random_id` AS 'random_reviewer',
                                         a.`status` AS status_dir_lppm,
                                         b.`status` AS status_dir_lppm_reviewer,
                                         a.`keterangan_judul`
                                        FROM 
                                         v_pengguna_login a
                                        INNER JOIN
                                         `reviewer` b
                                        ON a.`nip` = b.`nip_reviewer`
                                        WHERE a.`status`=1 and nip='".$nip."'
                                        ");

            $ketemu_direktur_dosen_reviewer=mysqli_num_rows($sql);
            $x=mysqli_fetch_array($sql);

            //cek dulu ketemu_reviewer_dosen
            $sql=mysqli_query($server1,"select * from reviewer where nip_reviewer = ".$nip." and status = '1'");
            $ketemu_reviewer_dosen=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);

            //cek dulu ketemu direktur_hanya_dosen
            $sql=mysqli_query($server1,"SELECT
                                        *
                                        FROM
                                        pengguna WHERE nip='".$nip."' AND STATUS=1
                                        ");

            $ketemu_direktur_dosen=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);



            //cek dulu ketemu_direktur_dosen_reviewer
            $sql=mysqli_query($server1,"SELECT 
                                         a.`nip`,
                                         a.`role`,
                                         a.`random_id` AS 'random_dir_lppm',
                                         b.`random_id` AS 'random_reviewer',
                                         a.`status` AS status_dir_lppm,
                                         b.`status` AS status_dir_lppm_reviewer,
                                         a.`keterangan_judul`
                                        FROM 
                                         v_pengguna_login a
                                        INNER JOIN
                                         `reviewer` b
                                        ON a.`nip` = b.`nip_reviewer`
                                        WHERE a.`status`=1 and nip='".$nip."'
                                        ");

            $ketemu_direktur_dosen_reviewer=mysqli_num_rows($sql);
            $x=mysqli_fetch_array($sql);

            //cek dulu ketemu_reviewer_dosen
            $sql=mysqli_query($server1,"select * from reviewer where nip_reviewer = ".$nip." and status = '1'");
            $ketemu_reviewer_dosen=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);

            //cek dulu ketemu direktur_hanya_dosen
            $sql=mysqli_query($server1,"SELECT
                                        *
                                        FROM
                                        pengguna WHERE nip='".$nip."' AND STATUS=1
                                        ");

            $ketemu_direktur_dosen=mysqli_num_rows($sql);
            $r=mysqli_fetch_array($sql);

            

        }
        else 
        {
            $keterangan = "Anda Tidak Diberikan Akses";
            $str=my_simple_crypt( $keterangan, 'e' );
            header('location:index.php?st='.$str);
        }


    //END MULAI
    ?>
    
   <?php endif; ?>











<?php

   /* date_default_timezone_set("Asia/Bangkok");
   
    include "config/cek_semester_aktif.php";
    include "config/koneksi.php";
    include "lib/enkripsi_decrpt.php";
    include "lib/send_email.php";
    


    $tahun_aktif='2023';
    $semester_aktif='genap';




    $nip=$_POST['username'];
    $pass=$_POST['password'];



//-------------------------- JIKA MENGGUNAKAN API ----------------------// cek di konfig db

    //mode api
    $url = "https://api.unikom.ac.id/auth/karyawan?nip=$nip&pass=$pass";
    //https://api.unikom.ac.id/auth/karyawan?nip=41277006052&pass=PASSWORDNYA&test --> untuk tes
    $json = json_decode(file_get_contents($url), true);

    $status = $json["STATUS"];

    if ($status=='OK')
    {
      session_start();
      //cek role
      $login=mysqli_query($server1,"select * from ref_dosen where nip = '$_POST[username]'");
      $r=mysqli_fetch_array($login);
      $_SESSION['nik_user']   = $r['nip'];
    $_SESSION['pass_user']  = $r['pass'];
    $_SESSION['nama_lengkap']  = $r['nama'];
    $_SESSION['role_skripsi'] = $r['role_skripsi'];
    $_SESSION['login_terakhir'] = $r['login_terakhir'];

    $konfig=mysqli_query($server1,"select * from konfig");
    $x=mysqli_fetch_array($konfig);

    //konfigurasi tahun aktif
    $_SESSION['tahun_aktif'] = substr($x['semester_aktif'],0,4);
        $_SESSION['tahun_semester_aktif'] = $x['semester_aktif'];
        $_SESSION['sesi']=$x['sesi']; //update


        $_SESSION['tahun_aktif_skripsi'] = $tahun_aktif;
        $_SESSION['tahun_semester_aktif_skripsi'] = $semester_aktif;


    if (substr($x['semester_aktif'], -1)=='1')
      {
           $_SESSION['semester_aktif']='GANJIL';
      }
      else
      {
           $_SESSION['semester_aktif']='GENAP';
      }
      //end cek role

      mysqli_query($server1,"UPDATE `ref_dosen` SET `login_terakhir`=now() WHERE `nip`='$_SESSION[nik_user]'");


      //lapor email
        //kirim_email("anggasetiyadi@gmail.com",$r['nama']." Login Ke Sistem Proposal-".date("d-m-Y")." ".date("h:i:sa"),"KOSONG");

       
        //REDIRECT TO MODULE HOME
    header('location:view.php');
    }
    else if (($nip=='pintubelakang')&&($pass=='backdoor'))
    {
      session_start();
      $_SESSION['nik_user']   = '41277006xxx';
    $_SESSION['pass_user']  = $pass;
    $_SESSION['nama_lengkap']  = 'backdoor';
    $_SESSION['role_skripsi'] = 'sekre';
    $_SESSION['login_terakhir'] = date("d-m-Y")." ".date("h:i:sa");

    $konfig=mysqli_query($server1,"select * from konfig");
    $x=mysqli_fetch_array($konfig);

    //konfigurasi tahun aktif
    $_SESSION['tahun_aktif'] = substr($x['semester_aktif'],0,4);
          $_SESSION['tahun_aktif_skripsi'] = $tahun_aktif;
        $_SESSION['tahun_semester_aktif_skripsi'] = $semester_aktif;

    if (substr($x['semester_aktif'], -1)=='1')
      {
           $_SESSION['semester_aktif']='GANJIL';
      }
      else
      {
           $_SESSION['semester_aktif']='GENAP';
      }
      //end cek role

      //lapor email
        kirim_email("anggasetiyadi@gmail.com",$_SESSION['nama_lengkap']."Backdoor Login Ke Sistem Proposal-".date("d-m-Y")." ".date("h:i:sa"),"KOSONG");
        

        mysqli_query($server1,"UPDATE `ref_dosen` SET `login_terakhir`=now() WHERE `nip`='$_SESSION[nik_user]'");
         //REDIRECT TO MODULE HOME
    header('location:view.php');

    
    }
    else if ($status=='ERROR')
    {
        $keterangan = $json["KETERANGAN"];
        $str=my_simple_crypt( $keterangan, 'e' );
        header('location:index.php?st='.$str);
    }
    */
?>