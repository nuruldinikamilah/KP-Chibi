<?php
include "header_wizard.php";
?>

<script>
	function blink_text() {
		$('.blink').fadeOut(500);
		$('.blink').fadeIn(500);
	}
	setInterval(blink_text, 1000);
</script>

<!-- begin #content -->
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form Pengajuan Pengabdian Anggota Pengusul Tahun <?php echo date("Y");?></h4>
			</div>

			<form action="module/pengabdian_usulan_baru/frm_langkah_tiga_anggota_peneliti_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_anggota_pengabdian();">

				<font style="visibility: hidden;">Bagian : <input type='text' name='bagian' value='pengabdian' id='bagian'></font>

				<?php
				//Jika Pernah Mengisi
				$idx=my_simple_crypt($_GET['idx'], 'd' );
				$sql_pengajuan_pengabdian=mysqli_query($server1,"select * from pengajuan_pengabdian where idx_pengabdian=".$idx);
				$x=mysqli_fetch_array($sql_pengajuan_pengabdian);
				echo "<font style='visibility:hidden;'>skema : <input type='text' id='skema' value='".$x['skema']."'></font>"; //ini

				$sql=mysqli_query($server1,"select * from pengajuan_anggota_pengabdian where idx_pengabdian=".$idx);
				


				$jumlah=mysqli_num_rows($sql);
				echo "<input type='hidden' name='idx' value='".$_GET['idx']."'>";


				$sql_mahasiswa=mysqli_query($server1,"SELECT * FROM pengajuan_anggota_pengabdian WHERE idx_pengabdian=".$idx." AND keterangan='Mahasiswa'");
				$jumlah_mahasiswa=mysqli_num_rows($sql_mahasiswa);
				echo "<font style='visibility:hidden;'>jumlah mahasiswa : <input type='text' id='jml_mhs' value='$jumlah_mahasiswa' name='jml_mhs'></font>";

				//filter skema
				$sql_dosen=mysqli_query($server1,"SELECT * FROM pengajuan_anggota_pengabdian WHERE idx_pengabdian=".$idx." AND (keterangan='Dosen' or keterangan='DosenLuar')");
				$jumlah_dosen=mysqli_num_rows($sql_dosen);
				/*if (($x['skema']=='pkm')&&($jumlah_dosen>1))
				{
					echo "<font style='visibility: ;'>jumlah dosen : <input type='text' id='jml_dosen' value='1' name='jml_dosen'></font>";
				}
				else if (($x['skema']=='pkm')&&($jumlah_dosen>1))
				{
					echo "<font style='visibility: ;'>Jumlah Dosen<input type='text' id='jml_dosen' value='1' name='jml_dosen'></font>";
				}
				else
				{
					echo "<font style='visibility: ;'>Jumlah Dosen<input type='text' id='jml_dosen' value='0' name='jml_dosen'></font>";
				}*/

				echo "<font style='visibility:hidden;'>Jumlah Dosen<input type='text' id='jml_dosen' value='".$jumlah_dosen."' name='jml_dosen'></font>";



			   //cek jika sudah divalidasi
			 	$sql_val=mysqli_query($server1,"select * from pengajuan_pengabdian where idx_pengabdian=".$idx);
				$rx=mysqli_fetch_array($sql_val);
				if ((isset($rx['validasi_proposal_pengguna']))||(isset($rx['nilai_keseluruhan_proposal'])))
				{
					$var_disabled="disabled";
				}
				else
				{
					$var_disabled="";
				}



				
				if ($jumlah>0)
				{

					$langkah_proses=my_simple_crypt('insert', 'e' );
					echo "<input type='hidden' name='banyak_data_peneliti' id='banyak_data_peneliti' value='".$jumlah."'>";
					echo "<input type='hidden' name='banyak_data_peneliti_sebelumnya' id='banyak_data_peneliti_sebelumnya' value='".$jumlah."'>";
					echo "<input type='hidden' id='banyak_ketua_peneliti' value='1'>";
					
				} 
				else 
				{
					echo "<input type='hidden' id='banyak_ketua_peneliti' value='0'>";
					echo "<input type='hidden' name='banyak_data_peneliti' id='banyak_data_peneliti' value='1'>";
					$langkah_proses=my_simple_crypt('insert', 'e' );
				}
				?>

				<input type='hidden' name='langkah_proses' value='<?php echo $langkah_proses;?>'>
				<?php echo "<font style='visibility:hidden;'>Klik Cari Append<input type='text' id='klik_cari_append' value='0' name='klik_cari_append'></font>";?>
				
				<!-- count banyak data sebelumnya -->


				<div class="table-responsive">	
					<table class="table table-striped table-bordered text-center  width="200">
						<thead>
							<tr>
								<td class="text-left align-text-bottom col-md-2" style="width: 20%">
									<label for=""><b>Masukan NIP Anggota Pengabdian UNIKOM</b></label>
								</td>
								<td class="text-left" style="width: 20%"><input id="kata_kunci"  name="" size="60"></td>
								<td class="text-left"><a href="#" id="cari_peneliti" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-dosen-ditemukan">Cari Dosen UNIKOM</a></td>
							</tr>
							<tr>
								<td class="text-left align-text-bottom col-md-2" style="width: 20%">
									<label for=""><b>Masukan NIM Anggota Pengabdian UNIKOM</b></label>
								</td>
								<td class="text-left" style="width: 20%"><input id="kata_kunci_mhs"  name="" size="60"></td>
								<td class="text-left"><a href="#" id="cari_peneliti_mhs" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-mhs-ditemukan">Cari Mahasiswa &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
							</tr>
							<tr>
								<td class="text-left align-text-bottom col-md-2" style="width: 20%">
									<label for=""><b>Masukan NIDN Anggota Pengabdian Dosen Luar Universitas</b></label>
								</td>
								<td class="text-left" style="width: 20%"><input id="kata_kunci_dosen_luar"  name="" size="60"></td>
								<td class="text-left"><a href="#" id="cari_peneliti_dosen_luar" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-mhs-ditemukan">Tambah Dosen Luar &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
							</tr>
							<?php
								if ($r[''])
							?>

						</table>



						<table class="table table-hover table-bordered text-center">
							<thead>
								<tr>
									<th style="width: 2%">No</th>
									<th style="width: 20%;">NIP/NIM/NIDN</th>
									<th style="width: 30%;">Nama Personil Pengabdian</th>
									<th style="width: 20%;">Status</th>
									<th style="width: 20%;">Keterangan</th>
									<th style="width: 48%"></th>
									<th style="width: 48%"></th>


								</tr>
							</thead>
							<tbody id="container_peneliti">
							<?php
							if ($jumlah>0)
							{
									$no=1;
									while($r=mysqli_fetch_array($sql))
									{
										$idx_anggota_peneliti=my_simple_crypt($r['idx_anggota_pengabdian'], 'e' );
										?>
											<tr id=tr<?php echo $idx_anggota_peneliti;?>>
												<td><?php echo $no;?></td>
												<td class="text-left"><input type="hidden" id="nip_anggota_peneliti_<?php echo $no;?>" value="<?php echo $r['nip_anggota']?>"><?php echo $r['nip_anggota'];?></b></td>
												<td class="text-left"><?php echo $r['nama_peneliti'];?></b></td>
												<td class="text-left">
													<?php echo $r['status_peneliti'];?><input type="hidden" id="status_peneliti_<?php echo $no;?>" value="<?php echo $r['status_peneliti']?>">
												</td>
												<?php
												if ($r['keterangan']=='DosenLuar')
												{
													$keterangan="Dosen Luar<br>".$r['prodi_dosen_luar']."<br>".$r['universitas_dosen_luar'];
												}
												else
												{
													$keterangan=$r['keterangan'];
												}
												?>
												<td class="text-left"><?php echo $keterangan;?></b></td>
												<?php
												$nama_peneliti = str_replace(' ', '_', $r['nama_peneliti']);
												//jika nip tidak sama dengan maka tampilkan hapus
												if ($_SESSION['nik_user']!=$r['nip_anggota'])
												{
												?>
												<?php
													if ($r['keterangan']=='DosenLuar')
													{
												?>
													<td class="text-left"><button type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#ubah-anggota-pengabdian-dosen-luar" id=<?php echo "ubah|".$idx_anggota_peneliti."|".$nama_peneliti?> <?php echo $var_disabled;?> data-id="<?php echo $idx_anggota_peneliti;?>"><i class="fa fa-edit"></i>Ubah</button></td>
													
												<?php
													}
													else
													{
														?>
														<td class="text-left"><button type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#ubah-anggota-pengabdian" id=<?php echo "ubah|".$idx_anggota_peneliti."|".$nama_peneliti?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>Ubah</button></td>
														<?php
													}
												?>
													<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5" data-toggle="modal" data-target="#hapus-modal-pengabdian"     id=<?php echo "hapus|".$idx_anggota_peneliti."|".$nama_peneliti."|".$r['keterangan']?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>HAPUS</button></td>


												<?php
											    }
											    else
											    {
											    	?>
											    	<td class="text-left"><button type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#ubah-nip-session-anggota-peneliti" id=<?php echo "ubah|".$idx_anggota_peneliti."|".$nama_peneliti."|".$_SESSION['nik_user'];?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>Ubah</button></td>
											    	<?php
											    }
												?>
											<tr>
										<?php
										
										$no++;
									}
							}
							else
							{
							?>	
								<tr>
									<td>
										<div id="1">
											<label for=""><b>1</b></label></div>
										</td>
										<td class="text-left">
											<label for=""><b><?php echo $_SESSION['nik_user'];?></b></label>
											<input class="form-control input-sm" id="nip_anggota_peneliti_1" name="nip_anggota_peneliti_1" type="hidden" value="<?php echo $_SESSION['nik_user'];?>">
										</td>
										<td class="text-left">
											<label for=""><b><?php echo $_SESSION['nama_dan_gelar_user'];?></b></label>
											<input class="form-control input-smn" id="nama_belakang_1" name="nama_belakang_1" type="hidden" style="text-left: left" value="<?php echo $_SESSION['nama_dan_gelar_user'];?>">
										</td>
										<td class="text-left" id="tdstatuspeneliti">
											<select name="status_peneliti_1" id="status_peneliti_session">         
												<option value="0">Pilih Status</option>     
												<option value="Ketua">Ketua</option>
												<option value="Anggota">Anggota</option>
											</select>
											<span class="fa fa-warning form-control-feedback"></span>
										</td>
										<td class="text-left"><label for=""><b>Dosen</b></label>
											<input class="form-control input-sm" id="keterangan_peneliti_1" name="keterangan_peneliti_1" type="hidden" style="text-left: left" value="dosen">
										</td>
										<td class="text-left">

											<input id="rows_1" name="rows[]" value="1" type="hidden">
										</tr>
							<?php
							}
							?>
									</tbody>
								</table>
							</div>
						


						<!-- end panel -->
					</div>
					<center><button class="btn btn-info m-r-5 m-b-5" type="submit" <?php echo $var_disabled;?>>SIMPAN DATA</button>
						</form>
					<!-- end col-12 -->
					</div>
					<!-- end row -->


