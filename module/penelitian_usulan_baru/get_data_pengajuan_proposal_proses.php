<?php
	if ($_POST['idx'])
	{
		include "../../config/koneksi.php";
        include "../../lib/enkripsi_decrpt.php";
        include "../../lib/send_email.php";

        $idx = my_simple_crypt($_POST['idx'], 'd' );
  		   $result=mysqli_query($server1,"UPDATE `pengajuan_penelitian` SET `validasi_proposal_pengguna` = 'y' , `tgl_validasi_proposal_pengguna` = now() WHERE `idx_penelitian` = '".$idx."' ");

		echo "sukses|".$_POST['idx'];
	}
	else
	{
		echo "error|".mysqli_error();
	}

	
?>