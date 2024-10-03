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
	 $result=mysqli_query($server1,"INSERT INTO `reviewer` 
			               (`nip_reviewer`, `nama_reviewer`, `status`) 
						  VALUES 
						   ('".$_POST['nip_calon_reviewer']."', '".$_POST['nama_calon_reviewer']."', '1')");


	 foreach($pilihan as $key=>$value)
	 {
	 	$query[] = mysqli_query($server1,"insert into reviewer_kat_bid_penelitian (`nip_reviewer`, `kode_kategori_bidang_penelitian_simlitabmas`) VALUES ('".$_POST['nip_calon_reviewer']."', '".$value."')"); // store in array
			 	
		$content = "" . implode(' ;<br> ', $query);
	 }
	 

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