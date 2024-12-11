<?php
session_start();
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";
include "../../lib/send_email.php";

$id = my_simple_crypt($_POST['idx'], 'd');
$sql = mysqli_query($server1, "select * from pengajuan_penelitian where idx_penelitian=" . $id);
$sql2 = mysqli_query($server1, "select * from bukti_verif where idx_pengajuan_penelitian=" . $id);
$r = mysqli_fetch_array($sql);
$bv = mysqli_fetch_array($sql2);

if ($_SESSION['nik_user'] == '') {
	header('location:../../index.php');
} else if ($_POST['upload']) {
	if ($r['dokumen_lembar_pengesahan'] == '' && $bv['file_verif'] == '') {
		header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx=' . $_POST['idx'] . '&status=gagal&kode=' . "Dokumen belum di tanda tangani oleh verifikator");
		return;
	}
	//proposal
	$ekstensi_diperbolehkan	= array('pdf');
	$nama = $_FILES['file']['name'];
	$x = explode('.', $nama);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$dirUpload = "../../dokumen_upload/";
	$newfilename = uniqid() . "-" . time() . "." . $ekstensi; // 5dab1961e93a7-1571494241
	$filename_and_directory = $dirUpload . $newfilename;


	//lembar pengesahan
	// $ekstensi_diperbolehkan	= array('pdf');
	// $nama_lp = $_FILES['file_lp']['name'];
	// $x = explode('.', $nama_lp);
	// $ekstensi = strtolower(end($x));
	// $ukuran	= $_FILES['file_lp']['size'];
	// $file_tmp_lp = $_FILES['file_lp']['tmp_name'];
	// $dirUpload_lp = "../../dokumen_upload_lp_penelitian/";
	// $newfilename_lp = "lpa-" . uniqid() . "-" . time() . "." . $ekstensi; // 5dab1961e93a7-1571494241
	// $filename_and_directory_lp = $dirUpload_lp . $newfilename;


	//mitra
	$ekstensi_diperbolehkan	= array('pdf');
	$nama_mitra = $_FILES['file_mitra_abdi']['name'];
	$x = explode('.', $nama_mitra);
	$ekstensi = strtolower(end($x));
	$ukuran	= $_FILES['file_mitra_abdi']['size'];
	$file_tmp_mitra = $_FILES['file_mitra_abdi']['tmp_name'];
	$dirUpload_mitra = "../../dokumen_upload_mitra_penelitian/";
	if ($_FILES['file_mitra_abdi']['name'] == '') {
		$newfilename_mitra = '';
	} else {

		$newfilename_mitra = "mitra-" . uniqid() . "-" . time() . "." . $ekstensi; // 5dab1961e93a7-1571494241
	}
	$filename_and_directory_mitra = $dirUpload_mitra . $newfilename;





	//if($ukuran < 1044070) //maks 1 mega
	if ($ukuran < 5044070) //maks 5 mega
	{
		//proses upload
		move_uploaded_file($file_tmp, $dirUpload . $newfilename);
		// move_uploaded_file($file_tmp_lp, $dirUpload_lp . $newfilename_lp);
		move_uploaded_file($file_tmp_mitra, $dirUpload_mitra . $newfilename_mitra);

		//jika berhasil upload 
		if (file_exists($filename_and_directory)) {
			$filename = $dirUpload . $newfilename;
			$handle = fopen($filename, "r");
			$contents = fread($handle, filesize($filename));
			fclose($handle);


			//UPDATE `48_simlibtamas`.`pengajuan_penelitian` SET `dokumen_proposal` = 'x' WHERE `idx_penelitian` = '62'; 
			//echo "<p>File exist</p>";
			$langkah_proses = my_simple_crypt($_POST['langkah_proses'], 'd');

			if ($langkah_proses == 'insert') {
				$kata = "Menambah Data";
				$redirect = "sukses_tambah";
			} else //langkah_proses update
			{
				$kata = "Mengubah Data";
				$redirect = "sukses_ubah";
				$hapus = $dirUpload . "$_POST[nama_dokumen_sebelumnya]";
				//unlink("test.txt");
				if (file_exists($hapus)) {
					unlink($hapus);
				}

				$hapus_lp = $dirUpload_lp . "$_POST[nama_lp_sebelumnya]";
				//unlink("test.txt");
				if (file_exists($hapus_lp)) {
					unlink($hapus_lp);
				}


				$hapus_mitra = $dirUpload_mitra . "$_POST[nama_mitra_sebelumnya]";
				//unlink("test.txt");
				if (file_exists($hapus_mitra)) {
					unlink($hapus_mitra);
				}
			}
			//tidak perlu insert karena hanya menggunakan 1 tabel
			// $result = mysqli_query($server1, "UPDATE `pengajuan_penelitian` SET `dokumen_proposal` = '" . $newfilename . "',`dokumen_lembar_pengesahan` = '" . $newfilename_lp . "',`dokumen_lembar_mitra` = '" . $newfilename_mitra . "' WHERE `idx_penelitian` = '" . $id . "'");
			$result = mysqli_query($server1, "UPDATE `pengajuan_penelitian` SET `dokumen_proposal` = '" . $newfilename . "',`dokumen_lembar_mitra` = '" . $newfilename_mitra . "' WHERE `idx_penelitian` = '" . $id . "'");
			if ($result) {
				//REDIRECT
				header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_lima&idx=' . $_POST['idx'] . '&status=' . $redirect);
			} else {
				//REDIRECT
				header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx=' . $_POST['idx'] . '&status=gagal&kode=' . mysqli_error($server1));
				//header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
			}
		} else {
			//REDIRECT
			header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx=' . $_POST['idx'] . '&status=gagal_db&kode=Gagal Upload Data, Cek Server dan Hubungi Administrator !!');
		}
	}
}
