<?php
	session_start();

	//Defines the name of the export file "codelution-export.xls"
		include "../../lib/enkripsi_decrpt.php";
		include "../../config/koneksi.php";
		include "../../config/tanggal.php";

		$sekarang = date('d-m-Y');
		if (isset($_GET['key']))
		{
			$kd_dosen = my_simple_crypt($_GET['key'], 'd' );
			$dosen = str_replace([',', '.', ' '], '', $kd_dosen);
		}
		
		$tahun_dec = my_simple_crypt($_GET['t'], 'd' );
		$smt_dec = my_simple_crypt($_GET['s'], 'd' );
		
		$tahun_dec_plus_1=$tahun_dec+1;

if (isset($_GET['download_kk']))
{
	header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=Proposal KK".$_GET['download_kk']."-TGL-".$sekarang.".xls");
    //header("Content-Disposition: attachment; filename=data_siswa.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

   
    $sql=mysqli_query($server1,"select * from ref_keilmuan where kd_keilmuan='".$_GET['download_kk']."'");
	$r=mysqli_fetch_array($sql);

	?>
	<center>
	<table border="0">
		  <?php
		  	 if ($_GET['download_kk']=='all')
    {
    	?>
    	 <tr>
			<th align="center" colspan="8">DAFTAR MAHASISWA Seluruhnya</b></font></th>
		  </tr>
    	<?php
    }
    else
    {
    	?>
    	 <tr>
			<th align="center" colspan="8">DAFTAR MAHASISWA KK-<?php echo $r['kd_keilmuan'];?></b></font></th>
		  </tr>
    	<?php
    }
		  ?>
		 
		  <tr>  
			<th align="center" colspan="8"><font color="#000000"><b>SEMESTER <?php echo $smt_dec; ?> TAHUN AJARAN <?php echo "$tahun_dec-$tahun_dec_plus_1"; ?> 	
		  </b></font></th>
		  </tr>
		  <tr>  
			<th align="center" colspan="8"><font color="#000000"><b>KELOMPOK KEILMUAN <?php echo $r['kd_keilmuan'];?> </b></font></th>
		  </tr>
		   <tr>  
			<th align="center" colspan="8"><font color="#000000"><b><?php echo $r['nama_keilmuan'];?> </b></font></th>
		  </tr>
		</table>
		<br>
	</center>
	<table border="80" width=100%>
			<tr>
										<th>NO</th>
										<th>NIM</th>
										<th>NAMA</th>
                                        <th colspan="3">JUDUL</th>
                                        <th>KK</th>
                                        <th>JENIS</th>
                                        <th>STATUS</th>
                                        <th>NAMA DOSEN</th>
                                        
										
			</tr>
			<?php	
			//query get data
			if ($_GET['download_kk']=='all')
			    {
			    	$sql_1=mysqli_query($server1,"SELECT 
										 *, b.nama as nama_dosen 
										FROM 
										 proposal_tahap_final a
										INNER JOIN
										 ref_dosen b
										INNER JOIN
										 ref_keilmuan c
										INNER JOIN
										 ref_tema d
										ON a.`KODEPEMBIMBING` = b.`kddosen` AND
										   a.`KELOMPOKKEILMUAN` = c.`kd_keilmuan` AND
										   a.`TEMA` = d.`kd_tema`
										   where  a.TAHUN='".$_SESSION['tahun_aktif']."' and a.SMT='".$_SESSION['semester_aktif']."'
										ORDER BY a.jenis desc,a.nim asc");
			    }
			    else
			    {
			    	$sql_1=mysqli_query($server1,"SELECT 
										 *, b.nama as nama_dosen 
										FROM 
										 proposal_tahap_final a
										INNER JOIN
										 ref_dosen b
										INNER JOIN
										 ref_keilmuan c
										INNER JOIN
										 ref_tema d
										ON a.`KODEPEMBIMBING` = b.`kddosen` AND
										   a.`KELOMPOKKEILMUAN` = c.`kd_keilmuan` AND
										   a.`TEMA` = d.`kd_tema`
										   where a.KELOMPOKKEILMUAN='$_GET[download_kk]' and a.TAHUN='".$_SESSION['tahun_aktif']."' and a.SMT='".$_SESSION['semester_aktif']."'
										ORDER BY a.jenis desc,a.nim asc");
			    }

			$no = 1;
			while($data = mysqli_fetch_array($sql_1)){
				if ($data['JENIS']=='B')
				{
					$jenis='Baru';
				}
				else if ($data['JENIS']=='P')
				{
					$jenis='Perpanjangan';
				}
				else
				{
					$jenis='KHUSUS';
				}

				echo '
				<tr>
					<td style=mso-number-format:\@; valign=top>'.$no.'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['NIM'].'</font></td>
					<td style=mso-number-format:\@; valign=top>'.$data['NAMA'].'</td>
					<td colspan=3 valign=top>'.$data['JUDUL'].'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['KELOMPOKKEILMUAN'].'</td>
					<td style=mso-number-format:\@; valign=top>'.$jenis.'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['STATUS'].'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['nama_dosen'].'</td>
				</tr>
				';
				$no++;
			}
			?>
		</table>
<?php
}
else
{
	header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=Proposal ".$dosen."-TGL-".$sekarang.".xls");
    //header("Content-Disposition: attachment; filename=data_siswa.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $sql=mysqli_query($server1,"SELECT 
										 *, b.nama as nama_dosen 
										FROM 
										 proposal_tahap_final a
										INNER JOIN
										 ref_dosen b
										INNER JOIN
										 ref_keilmuan c
										INNER JOIN
										 ref_tema d
										ON a.`KODEPEMBIMBING` = b.`kddosen` AND
										   a.`KELOMPOKKEILMUAN` = c.`kd_keilmuan` AND
										   a.`TEMA` = d.`kd_tema`
										where b.kddosen='$kd_dosen'
										ORDER BY a.nim ASC");
		$r=mysqli_fetch_array($sql);

?>
   <center>
	<table border="0">
		  <tr>
			<th align="center" colspan="8">DAFTAR MAHASISWA BIMBINGAN SKRIPSI</b></font></th>
		  </tr>
		  <tr>  
			<th align="center" colspan="8"><font color="#000000"><b>SEMESTER <?php echo $smt_dec; ?> TAHUN AJARAN <?php echo "$tahun_dec-$tahun_dec_plus_1"; ?> 	
		  </b></font></th>
		  </tr>
		  <tr>  
			<th align="center" colspan="8"><font color="#000000"><b>KELOMPOK KEILMUAN <?php echo $r['kd_keilmuan'];?> </b></font></th>
		  </tr>
		   <tr>  
			<th align="center" colspan="8"><font color="#000000"><b><?php echo $r['nama_keilmuan'];?> </b></font></th>
		  </tr>
		  <tr>  
			<th align="center" colspan="8"><font color="#000000"><b>DOSEN : <?php echo $r['nama'];?></b></font></th>
		  </tr>
		</table>
		<br>
	</center>
Berikut Kami Lampirkan Daftar Mahasiswa Proposal :
<table border="80" width=100%>
			<tr>
										<th>NO</th>
										<th>NIM</th>
										<th>NAMA</th>
                                        <th colspan="3">JUDUL</th>
                                        <th>KK</th>
                                        <th>JENIS</th>
                                        <th>SESI</th>
										
			</tr>
			<?php	
			//query get data
			$sql_1=mysqli_query($server1,"SELECT 
										 *, b.nama as nama_dosen 
										FROM 
										 proposal_tahap_final a
										INNER JOIN
										 ref_dosen b
										INNER JOIN
										 ref_keilmuan c
										INNER JOIN
										 ref_tema d
										ON a.`KODEPEMBIMBING` = b.`kddosen` AND
										   a.`KELOMPOKKEILMUAN` = c.`kd_keilmuan` AND
										   a.`TEMA` = d.`kd_tema`
										   where b.kddosen='$kd_dosen' and a.TAHUN='".$_SESSION['tahun_aktif']."' and a.STATUS='diterima' and a.SMT='".$_SESSION['semester_aktif']."'
										ORDER BY a.jenis desc,a.nim asc");
			$no = 1;
			while($data = mysqli_fetch_array($sql_1)){
				if ($data['JENIS']=='B')
				{
					$jenis='Baru';
				}
				else
				{
					$jenis='Perpanjangan';
				}

				echo '
				<tr>
					<td style=mso-number-format:\@; valign=top>'.$no.'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['NIM'].'</font></td>
					<td style=mso-number-format:\@; valign=top>'.$data['NAMA'].'</td>
					<td colspan=3 valign=top>'.$data['JUDUL'].'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['KELOMPOKKEILMUAN'].'</td>
					<td style=mso-number-format:\@; valign=top>'.$jenis.'</td>
					<td style=mso-number-format:\@; valign=top>'.$data['SESI'].'</td>
				</tr>
				';
				$no++;
			}
			?>
		</table>

Lingkari Nomor Dengan Jenis Proposal Baru, Jika Anda Akan Menerima  Mahasiswa Untuk Dibimbing TAHUN AJARAN <?php echo "$tahun_dec-$tahun_dec_plus_1"; ?> SEMESTER <?php echo $smt_dec; }?> 
   