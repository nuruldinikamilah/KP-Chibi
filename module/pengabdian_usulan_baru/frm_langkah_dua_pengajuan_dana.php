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
				<h4 class="panel-title">Form Pengajuan Dana pengabdian Tahun <?php echo date("Y");?></h4>
			</div>

			 <form action="module/pengabdian_usulan_baru/frm_langkah_dua_pengajuan_dana_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_dana();">
			 	<?php
				//Jika Pernah Mengisi
			 	$idx=my_simple_crypt($_GET['idx'], 'd' );
			 	$sql=mysqli_query($server1,"select * from pengajuan_dana_pengabdian where idx_pengabdian=".$idx);
			 	
			 	$jumlah=mysqli_num_rows($sql);
			 	echo "<input type='hidden' name='idx' value='".$_GET['idx']."'>";


			 	//cek jika sudah divalidasi
			 	$sql_val=mysqli_query($server1,"select * from pengajuan_pengabdian where idx_pengabdian=".$idx);
				$rx=mysqli_fetch_array($sql_val);
				echo "<input type='hidden' name='skema' value='".$rx['skema']."' id='skema'>";
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
			 	} 
			 	else 
			 	{
			 		$langkah_proses=my_simple_crypt('insert', 'e' );
			 	}
			 	?>

			 	 <input type='hidden' name='langkah_proses' value='<?php echo $langkah_proses;?>'>
			 	 <!-- count banyak data sebelumnya -->
			 	 <input type="hidden" id="banyak_data_sebelumnya" value="<?php echo $jumlah;?>">
			 	 <!-- count banyak data yang diinput -->
				 <input type="hidden" id="banyak_data"> 
				 

				<div class="table-responsive">
					<table class="table-condensed table-striped table-bordered text-center">
						<thead>
							<tr>
								<th colspan="4" class="text-left"><button type="button" class="btn btn-danger" id="tambah_dana_pengajuan"><i class="fa fa-file"></i>&nbsp;Klik Untuk Menambah Dana Pengajuan</button></th>
							</tr>


						</table>

						<table class="table table-hover table-bordered text-center">
							<thead>
								<tr>
									<th style="width: 2%">No</th>
									<th style="width: 60%;">Nama Dana Pengajuan</th>
									<th style="width: 30%;text-align: right;">Nominal Dana Pengajuan</th>
									<th style="width: 8%"></th>

								</tr>
							</thead>
							<tbody id="container">
								<?php
									$no=1;
									$total_pengajuan_yang_telah_diinput = 0;
									while($r=mysqli_fetch_array($sql))
									{
										$idx_dana=my_simple_crypt($r['idx_dana'], 'e' );
										?>
											<tr id=tr<?php echo $idx_dana;?>>
												<td><b><?php echo $no;?></b></td>
												<td class="text-left"><?php echo $r['nama_dana'];?></b></td>
												<td class="text-right"><?php echo "Rp. ".rupiah($r['nominal_dana_pengajuan']);?></b></td>

												<!-- replace string supaya tidak masalah di alertnya jika ada spasi -->
												<?php

												$nama_dana = str_replace(' ', '_', $r['nama_dana']);
												?>
												

												
												<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5" data-toggle="modal" data-target="#hapus-modal-dana-pengabdian"     id=<?php echo "hapus|".$idx_dana."|".$nama_dana."|".$r['nominal_dana_pengajuan'];?> <?php echo $var_disabled;?>><i class="fa fa-edit"></i>Hapus</button></td>
											<tr>
										<?php
										$total_pengajuan_yang_telah_diinput += $r['nominal_dana_pengajuan'];
										$no++;
									}
								?>
								<!--data akan tampil disini untuk append -->
								
							</tbody>
							<tr id="total_dana_pengajuan">
								<th colspan="2" class="text-right"><label><b><font color='red'>Total Dana Pengajuan</font></label></b</th>
									<th class="text-right">
										<span class="blink"><label><b><font color='red' id="total_pengajuan_label">Rp. <?php echo rupiah($total_pengajuan_yang_telah_diinput); ?></font></label></b></span>
										<!-- total_pengajuan_yang_telah_diinput -->
										 <input type="hidden" id="total_pengajuan_yang_telah_diinput" value=<?php echo $total_pengajuan_yang_telah_diinput;?>> 
										<input type="hidden" id="total_pengajuan">
									</th>
								</tr>
							</table>
						</div>
					<!-- end panel -->
				</div>
				<!-- end col-12 -->
				<center><button class="btn btn-info m-r-5 m-b-5" type="submit" <?php echo $var_disabled;?>>SIMPAN DATA PENGAJUAN DANA</button>
				</div>
				</form>
				<!-- end row -->