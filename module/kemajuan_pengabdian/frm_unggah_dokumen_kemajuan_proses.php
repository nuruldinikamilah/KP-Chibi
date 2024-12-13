<?php
	session_start();
    include "../../config/koneksi.php";
    include "../../lib/enkripsi_decrpt.php";
    include "../../lib/send_email.php";

    if ($_SESSION['nik_user']=='')
    {
            header('location:../../index.php');
    }
	else if($_POST['upload'])
	{
		    //kemajuan
			$ekstensi_diperbolehkan	= array('pdf');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$dirUpload="../../dokumen_upload_kemajuan_pengabdian/";
			$newfilename = uniqid() . "-" . time().".".$ekstensi; // 5dab1961e93a7-1571494241
			$filename_and_directory = $dirUpload.$newfilename;


			

			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)
			{
				//if($ukuran < 1044070) //maks 1 mega
		    	if($ukuran < 3044070) //maks 3 mega
		    	{
		    		//proses upload
					move_uploaded_file($file_tmp, $dirUpload.$newfilename);		

					//jika berhasil upload 
		    		if (file_exists($filename_and_directory))
		    		{
		    			$filename= $dirUpload. $newfilename;
						$handle = fopen($filename, "r");
						$contents = fread($handle, filesize($filename));
						fclose($handle);

						
							//UPDATE `48_simlibtamas`.`pengajuan_penelitian` SET `dokumen_proposal` = 'x' WHERE `idx_penelitian` = '62'; 
						    //echo "<p>File exist</p>";
			    			$id=my_simple_crypt($_POST['idx'], 'd' );
			    			$langkah_proses=my_simple_crypt($_POST['langkah_proses'], 'd' );
			    			
			    			if ($langkah_proses=='insert')
			    			{
			    				$kata="Menambah Data";
			    				$redirect = "sukses_tambah";

			    				 //insert ke pengajuan_penilaian_untuk_laporan_kemajuan
						            $tampil=mysqli_query($server1,"SELECT
						                                                                                          *
						                                                                                          FROM
						                                                                                          ref_rubik where nama_skema='pengabdian_kemajuan'");

						             while($w = mysqli_fetch_array($tampil))
						             {
						                   $result = mysqli_query($server1,"INSERT INTO `penilaian_rubik_pengabdian` (`idx_rubik`, `idx_pengabdian`  ) 
						                      VALUES ('".$w['idx_rubik']."', '".$id."');  ");
						             }
						             //end //insert ke pengajuan_penilaian_untuk_laporan_kemajuan
			    			}
			    			else //langkah_proses update
			    			{
			    				$kata="Mengubah Data";
			    				$redirect="sukses_ubah";
			    				$hapus=$dirUpload."$_POST[nama_dokumen_sebelumnya]";
			    				//unlink("test.txt");
			    				if (file_exists($hapus))
			    				{
			    					unlink($hapus);
			    				}

			    				

			    			}
			    			//tidak perlu insert karena hanya menggunakan 1 tabel
				            $result = mysqli_query($server1,"UPDATE `pengajuan_pengabdian` SET `dokumen_laporan_kemajuan` = '".$newfilename."',`tgl_upload_dokumen_laporan_kemajuan` = now() WHERE `idx_pengabdian` = '".$id."'");


				             



				            if($result)
				            {
				                //REDIRECT
				                header('location:../../view.php?menu=pengabdian&act=unggah_dokumen_kemajuan&idx='.$_POST['idx'].'&status='.$redirect);
				            }
				            else
				            {
				                //REDIRECT
				            	header('location:../../view.php?menu=pengabdian&act=unggah_dokumen_kemajuan&idx='.$_POST['idx'].'&status=gagal&kode='.mysqli_error($server1));
				                //header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_dua&status=gagal&kode='.mysqli_error($server1));
				            } 
		    		}
		    		else
					{
					    //REDIRECT
			            	header('location:../../view.php?menu=pengabdian&act=unggah_dokumen_kemajuan&idx='.$_POST['idx'].'&status=gagal_db&kode=Gagal Upload Data, Cek Server dan Hubungi Administrator !!');
					}
		    	}
			}
		else
		{
			//REDIRECT
	         header('location:../../view.php?menu=pengabdian&act=unggah_dokumen_kemajuan&idx='.$_POST['idx'].'&status=gagal_ekstensi&jenis='.$ekstensi);
	    }
	}
	?>