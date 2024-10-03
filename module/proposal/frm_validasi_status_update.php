<?php
session_start();
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";

  if ($_SESSION['nik_user']=='')
  {
	header('location:../../index.php');
  }
  else 
  {
		for ($x = 1; $x <= $_POST['jumlah_data_pengajuan']; $x++) 
		{
			if(isset($_POST['status_'.$x]))
			{
				 $result = mysqli_query($server1,"UPDATE `proposal_tahap_final` SET KODEPEMBIMBING = '".$_POST['nip_pilih_'.$x]."', `STATUS` = '".$_POST['status_'.$x]."' , `TGLUPDATEKOORDINATOR` = now() WHERE `kd_pro_thp_final` = '".$_POST['idx_'.$x]."'");
				//echo $x."|".$_POST['status_'.$x]."|".$_POST['nip_pilih_'.$x]."|".$_POST['idx_'.$x]."<br>";
				//dapatkan nilai akhir
				$jumlah=$x;
				$belum_ada_status=$_POST['jumlah_data_pengajuan']-$jumlah;
			} 

		}	
		if($result)
		{
			//REDIRECT
			header('location:../../view.php?menu=proposal&act=validasi_status&status=sukses_ubah&jumlah_data='.$jumlah.'&belum_ada_status='.$belum_ada_status);
		}
		else
		{
			//REDIRECT
			header('location:../../view.php?menu=proposal&act=lihat_data_tahap_final&status=gagal&kode='.mysql_error());
		
		}

  }
?>