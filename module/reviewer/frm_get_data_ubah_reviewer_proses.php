<?php
 session_start();
 include "../../config/koneksi.php";
 include "../../lib/enkripsi_decrpt.php";
 include "../../lib/send_email.php";


 if(isset($_POST['submit'])) 
 {
 	$pilihan=$_POST['pilihan'];
	if (is_array($pilihan) || is_object($pilihan))
	{
	 $result=mysqli_query($server1,"delete from reviewer_kat_bid_penelitian where nip_reviewer =".$_POST['nip_calon_reviewer']);


	 foreach($pilihan as $key=>$value)
	 {
	 	$query[] = mysqli_query($server1,"insert into reviewer_kat_bid_penelitian (`nip_reviewer`, `kode_kategori_bidang_penelitian_simlitabmas`) VALUES ('".$_POST['nip_calon_reviewer']."', '".$value."')"); // store in array
			 	
		//$content = "" . implode(' ;<br> ', $query);
	 }
	 


	 //update status
	 if (isset($_POST['status']))
	 {
	 	$status_cap='1';
	 }
	 else
	 {
	   $status_cap='0';
	 }
		$result=mysqli_query($server1,"UPDATE `reviewer` SET `status` = '".$status_cap."' WHERE `nip_reviewer` = '".$_POST['nip_calon_reviewer']."'");
	//end update status


	   if($result)
       {
         //REDIRECT
        header('location:../../view.php?menu=reviewer&act=daftar_reviewer&idx='.$_POST['idx'].'&status=sukses_tambah');
       }
       else
       {
       //REDIRECT
        header('location:../../view.php?menu=reviewer&act=daftar_reviewer&status=gagal&kode='.mysqli_error($server1));
       }   
	}
 }

 ?>