<?php
 session_start();
 include "../../config/koneksi.php";
 include "../../lib/enkripsi_decrpt.php";
 include "../../lib/send_email.php";

 
 if(isset($_POST['submit'])) 
 {
	for ($x = 1; $x <= $_POST['jumlah_data']; $x++) 
	{
		$idx_nilai=$_POST['idx_nilai_'.$x];
		$y=$x-1;
		$data_nilai=$_POST['answer_'.$y];
		$data_nilai=explode("|", $data_nilai);

        $result = mysqli_query($server1,"UPDATE `penilaian_rubik_pengabdian` SET `nip_reviewer` = '".$_SESSION['nik_user']."' , `skala_pilih` = '".$data_nilai[1]."' , `nilai_rubik` = '".$data_nilai[0]."' , `tgl_isi` = now() WHERE `idx_penilaian` = '".$idx_nilai."'");



       
	}

	  $idx_pengabdian=my_simple_crypt($_POST['idx_pengabdian'], 'd' );
	  $result = mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET `nilai_keseluruhan_proposal` = '".$_POST['hasil_akhir']."', catatan_reviewer = '".$_POST['komentar']."', status_pengajuan='diperiksa' WHERE `idx_pengabdian` = '".$idx_pengabdian."'");

	 if($result)
        {
            //REDIRECT
            header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan_rev_pengabdian&status=sukses');
        }
        else
        {
            //REDIRECT
            header('location:../../view.php?menu=pengajuan&act=daftar_pengajuan_rev_pengabdian&status=gagal&kode='.mysqli_error());
        
        }
 }
 ?>