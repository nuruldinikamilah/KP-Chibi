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
		$tgl_mulai = date('Y-m-d', strtotime($_POST['tgl_mulai']));
    	$tgl_akhir = date('Y-m-d', strtotime($_POST['tgl_akhir']));

    	$jam_mulai = $_POST['jam_mulai'];
    	$jam_akhir = $_POST['jam_akhir'];
    	


    	$tgl_insert_mulai = $tgl_mulai." ".$jam_mulai;
    	$tgl_insert_akhir = $tgl_akhir." ".$jam_akhir;
    	$tahun=$_POST['tahun'];
    	if ($_POST['semester']=='ganjil')
    	{
    		$semester='1';
    	}
    	else
    	{
    		$semester='2';
    	}
    	$tahun_insert= $tahun.''.$semester;


    	$result = mysqli_query($server1,"UPDATE `konfig` SET `semester_aktif` = '".$tahun_insert."' , `tgl_pembukaan` = '".$tgl_insert_mulai."' , `tgl_penutupan` = '".$tgl_insert_akhir."'");
    	

    	if($result)
		{
			//REDIRECT
			header('location:../../view.php?menu=konfig&act=proposal&status=sukses_ubah');
		}
		else
		{
			//REDIRECT
			header('location:../../view.php?menu=konfig&act=proposal&status=gagal&kode='.mysql_error());
		
		}	

  }
?>