<?php
session_start();
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";

  if ($_SESSION['nik_user']=='')
  {
	header('location:../../index.php');
  }
  else if(isset($_POST['submit'])) 
  {
		for ($x = 1; $x <= $_POST['jumlah_data_pengajuan']; $x++) 
		{
			
			$result = mysqli_query($server1,"UPDATE `proposal_tahap_final` SET KODEPEMBIMBING = '".$_POST['nip_pilih_'.$x]."', `TGL_UPDATE` = now(), NIP_UPDATE='".$_SESSION['nik_user']."' WHERE `kd_pro_thp_final` = '".$_POST['idx_'.$x]."'");
		    //echo $x."|".$_POST['nip_pilih_'.$x]."|".$_POST['idx_'.$x]."<br>";
		} 

		if($result)
		{
			//REDIRECT
			header('location:../../view.php?menu=proposal&act=distribusi_pembimbing&status=sukses_ubah');
		}
		else
		{
			//REDIRECT
			header('location:../../view.php?menu=proposal&act=distribusi_pembimbing&status=gagal&kode='.mysql_error());
		
		}	
  }
?>