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
				<h4 class="panel-title">Form Pengajuan Anggota Peneliti Tahun <?php echo date("Y");?></h4>
			</div>

			<form action="module/penelitian_usulan_baru/frm_langkah_tiga_anggota_peneliti_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_anggota_peneliti();">
				<?php
				//Jika Pernah Mengisi
				$idx=my_simple_crypt($_GET['idx'], 'd' );
				$sql=mysqli_query($server1,"select * from pengajuan_anggota_penelitian where idx_penelitian=".$idx);
				
				$jumlah=mysqli_num_rows($sql);
				echo "<input type='hidden' name='idx' value='".$_GET['idx']."'>";


				$sql_mahasiswa=mysqli_query($server1,"SELECT * FROM pengajuan_anggota_penelitian WHERE idx_penelitian=".$idx." AND keterangan='Mahasiswa'");
				$jumlah_mahasiswa=mysqli_num_rows($sql_mahasiswa);
				echo "<input type='hidden' id='jml_mhs' value='$jumlah_mahasiswa' name='jml_mhs'>";


				$sql_pengajuan=mysqli_query($server1,"select * from pengajuan_penelitian where idx_penelitian=".$idx);
				$data=mysqli_fetch_array($sql_pengajuan);
				//cek jika sudah divalidasi
				if ((isset($data['validasi_proposal_pengguna']))||(isset($data['nilai_keseluruhan_proposal'])))
				{
					$var_disabled="disabled";
				}
				else
				{
					$var_disabled="";
				}

				echo "<input type='hidden' id='skema' value='".$data['skema']."'>";
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
				<input type="hidden" id="klik_cari_append" value='0' name="klik_cari_append">
				
				<!-- count banyak data sebelumnya -->


				<div class="table-responsive">	
					<table class="table table-striped table-bordered text-center  width="200">
						<thead>
							<tr>
								<td class="text-left align-text-bottom col-md-2" style="width: 20%">
									<label for=""><b>Masukan NIP Anggota Peneliti</b></label>
								</td>
								<td class="text-left" style="width: 20%"><input id="kata_kunci"  name="" size="60" readonly></td>
								<td class="text-left"><a href="#" id="cari_peneliti" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-dosen-ditemukan">Cari Dosen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
							</tr>
							<tr>
								<td class="text-left align-text-bottom col-md-2" style="width: 20%">
									<label for=""><b>Masukan NIM Anggota Peneliti</b></label>
								</td>
								<td class="text-left" style="width: 20%"><input id="kata_kunci_mhs"  name="" size="60" readonly></td>
								<td class="text-left"><a href="#" id="cari_peneliti_mhs" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-mhs-ditemukan">Cari Mahasiswa</a></td>
							</tr>
						</table>



						<table class="table table-hover table-bordered text-center">
							<thead>
								<tr>
									<th style="width: 2%">No</th>
									<th style="width: 20%;">NIP/NIM</th>
									<th style="width: 30%;">Nama Peneliti</th>
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
										$idx_anggota_peneliti=my_simple_crypt($r['idx_anggota_peneliti'], 'e' );
										?>
											<tr id=tr<?php echo $idx_anggota_peneliti;?>>
												<td><?php echo $no;?></td>
												<td class="text-left"><input type="hidden" id="nip_anggota_peneliti_<?php echo $no;?>" value="<?php echo $r['nip_anggota']?>"><?php echo $r['nip_anggota'];?></b></td>
												<td class="text-left"><?php echo $r['nama_peneliti'];?></b></td>
												<td class="text-left">
													<?php echo $r['status_peneliti'];?><input type="hidden" id="status_peneliti_<?php echo $no;?>" value="<?php echo $r['status_peneliti']?>">
												</td>
												<td class="text-left"><?php echo $r['keterangan'];?></b></td>
												<?php
												$nama_peneliti = str_replace(' ', '_', $r['nama_peneliti']);
												//jika nip tidak sama dengan maka tampilkan hapus
												if ($_SESSION['nik_user']!=$r['nip_anggota'])
												{
												?>
												
												<td class="text-left"><button type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#ubah-anggota-peneliti" id=<?php echo "ubah|".$idx_anggota_peneliti."|".$nama_peneliti?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>Ubah</button></td>

												<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5" data-toggle="modal" data-target="#hapus-modal-peneliti"     id=<?php echo "hapus|".$idx_anggota_peneliti."|".$nama_peneliti."|".$r['keterangan']?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>HAPUS</button></td>


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
												<option value="0">Pilih Status Peneliti</option>     
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
					<center><button class="btn btn-info m-r-5 m-b-5" type="submit" <?php echo $var_disabled;?>>SIMPAN DATA PENELITI</button>
						</form>
					<!-- end col-12 -->
					</div>
					<!-- end row -->


