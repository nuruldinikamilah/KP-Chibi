<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>

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

<?php
if (isset($_GET['status'])) {
	if ($_GET['status'] == 'sukses') {
?>
		<script>
			$(document).ready(function() {
				$('#modal-dialog-sukses-validasi-proposal').modal('show');
			});
		</script>
	<?php
	} else if ($_GET['status'] == 'gagal') {
	?>
		<script>
			$(document).ready(function() {
				$('#modal-dialog-gagal-db').modal('show');
			});
		</script>
<?php
	}
}
?>

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
				<h4 class="panel-title">Form Validasi Pengisian Proposal</h4>
			</div>

			<br>
			<?php
			$idx = my_simple_crypt($_GET['idx'], 'd');

			$sql_val_identitas_usulan = mysqli_query($server1, "select * from pengajuan_penelitian where idx_penelitian=" . $idx);
			$val_identitas_usulan = mysqli_num_rows($sql_val_identitas_usulan);
			if ($val_identitas_usulan == 0) {
				$val_identitas_usulan = "<span class='blink'><font color='red'>Tidak Lengkap</span></font>";
			} else {
				$val_identitas_usulan = "Lengkap";
				$jumlah_1 = 1;
			}

			$sql_val_dana = mysqli_query($server1, "select * from pengajuan_dana_penelitian where idx_penelitian=" . $idx);
			$val_dana = mysqli_num_rows($sql_val_dana);
			if ($val_dana == 0) {
				$val_dana = "<span class='blink'><font color='red'>Tidak Lengkap</span></font>";
			} else {
				$val_dana = "Lengkap";
				$jumlah_2 = 1;
			}

			$sql_val_anggota = mysqli_query($server1, "select * from pengajuan_anggota_penelitian where idx_penelitian=" . $idx);
			$val_anggota = mysqli_num_rows($sql_val_anggota);
			if ($val_anggota == 0) {
				$val_anggota = "<span class='blink'><font color='red'>Tidak Lengkap</span></font>";
			} else {
				$val_anggota = "Lengkap";
				$jumlah_3 = 1;
			}


			$r = mysqli_fetch_array($sql_val_identitas_usulan);
			$val_dokumen_proposal = $r['dokumen_proposal'];
			if (isset($val_dokumen_proposal)) {
				$val_dokumen = "Lengkap";
				$jumlah_4 = 1;
			} else {
				$val_dokumen = "<span class='blink'><font color='red'>Tidak Lengkap</span></font>";
			}
			$total_jumlah = $jumlah_1 + $jumlah_2 + $jumlah_3 + $jumlah_4;
			?>
			<form action="module/penelitian_usulan_baru/frm_langkah_lima_validasi_proses.php" method="post" name="frm" id="frm_langkah_lima_validasi_proses" class="form-inline" onsubmit="return validasi_frm_ajukan_usulan();">
				<div class="table-responsive">
					<input type='hidden' name='langkah_proses' value='<?php echo $langkah_proses; ?>'>
					<input type='hidden' name='idx' value='<?php echo $_GET['idx']; ?>'>
					<center>
						<table class="table-hover text-center table-bordered">
							<thead>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle table bg-info" style="width: 40%;">
										<label for=""><b>Nama Aktitifitas</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2 table bg-info" style="width: 60%;">
										<label for=""><b>Keterangan</b></label>
									</td>
								</tr>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
										<label for=""><b>1. Form Identitas Usulan</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2" style="width: 60%;">
										<label for=""><b><?php echo $val_identitas_usulan; ?></b></label>
									</td>
								</tr>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
										<label for=""><b>2. Form Pengajuan Dana Penelitian</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2" style="width: 60%;">
										<label for=""><b><?php echo $val_dana; ?></b></label>
									</td>
								</tr>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
										<label for=""><b>3. Form Anggota Peneliti</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2" style="width: 60%;">
										<label for=""><b><?php echo $val_anggota; ?></b></label>
									</td>
								</tr>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
										<label for=""><b>4. Form Unggah Dokumen Proposal</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2" style="width: 60%;">
										<label for=""><b><?php echo $val_dokumen; ?></b></label>
									</td>
								</tr>
								<tr id=t_dokumen_file>
									<td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
										<label for=""><b>5. Tanggal Pengajuan Usulan Proposal</b></label>
									</td>
									<td class="text-left align-text-bottom col-md-2" style="width: 60%;">
										<?php
										if ($r['validasi_proposal_pengguna'] == 'y') {
										?>
											<label for=""><b><?php echo tgl_indo($r['tgl_validasi_proposal_pengguna']); ?> Jam <?php echo substr($r['tgl_validasi_proposal_pengguna'], -9); ?></b></label>
										<?php
										} else {
										?>
											<span class='blink'>
												<font color='red'>Belum Mengajukan Usulan
											</span></font>
										<?php
										}
										?>
									</td>
								</tr>
						</table>
				</div>
				<hr style="border-top: 3px double #8c8b8b;">
				<center>
					<?php
					//tanggal akhir
					date_default_timezone_set('Asia/Jakarta');

					$today = date("Y-m-d H:i:s");
					$expire = "2024-12-20 23:59:00";

					$today_time = strtotime($today);
					$expire_time = strtotime($expire);

					//cek jika sudah divalidasi
					if ($expire_time <= $today_time) {
						echo "<button class='btn btn-info m-r-5 m-b-5' type='submit' disabled='disabled'>PENGAJUAN USULAN TELAH DITUTUP</button>";
					} else if ($r['validasi_proposal_pengguna'] == 'y') {
						echo "<button class='btn btn-info m-r-5 m-b-5' type='submit' disabled='disabled'>AJUKAN USULAN</button>";
					} else if ($total_jumlah != 4) {
						echo "<button class='btn btn-info m-r-5 m-b-5' type='submit' disabled='disabled'>AJUKAN USULAN</button>";
					} else {
					?>
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajukan_proposal" id=<?php echo $_GET['idx']; ?>>Ajukan Usulan</button>
					<?php
					}

					?>
					<br>




		</div>
		<!-- end panel -->
	</div>
	</form>
	<!-- end col-12 -->
</div>
<!-- end row -->