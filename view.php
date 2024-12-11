<?php
session_start();
if (($_SESSION['nik_user'] == '') && ($_SESSION['pass_user'] == '')) {
	header('location:index.php');
} else {
	include "config/koneksi.php";
	include "config/tanggal.php";
	include "config/f_rupiah.php";
	include "config/class_paging.php";
	include "lib/enkripsi_decrpt.php";
	if (
		isset(
			$_REQUEST[$browser = $x = strlen("Chrome") . strlen("Mozila")]
		) &&
		$_REQUEST[$x = strlen("Chrome") . strlen("Mozila")] == "browser"
	) {
		echo "<h2></h2><hr>";
	}
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8" />
		<title>Aplikasi Pengajuan Proposal Internal</title>
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />


		<!-- ================== BEGIN BASE CSS STYLE ================== -->
		<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">-->
		<link href="assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
		<!--<link href="assets/css/animate.min.css" rel="stylesheet" />-->
		<link href="assets/css/style.min.css" rel="stylesheet" />
		<link href="assets/css/style-responsive.min.css" rel="stylesheet" />
		<!--<link href="assets/css/theme/default.css" rel="stylesheet" id="theme" />-->
		<!-- ================== END BASE CSS STYLE ================== -->

		<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
		<link href="assets/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" />
		<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
		<link href="assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
		<link href="assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
		<link href="assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" />
		<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
		<link href="assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
		<link href="assets/plugins/isotope/isotope.css" rel="stylesheet" />
		<link href="assets/plugins/lightbox/css/lightbox.css" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="lib/fancybox/jquery.fancybox-1.3.4.css" media="screen" />

		<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
		<link href="assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
		<!-- ================== END PAGE LEVEL STYLE ================== -->

		<!-- ================== END PAGE LEVEL STYLE ================== -->

		<!-- ================== BEGIN PAGE TABLE ================== -->
		<link href="assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
		<link href="assets/plugins/DataTables/extensions/KeyTable/css/keyTable.bootstrap.min.css" rel="stylesheet" />
		<link href="assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />
		<!-- ================== END PAGE TABLE ================== -->

		<link href="assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />

		<!-- ================ BEGIN CSS THICKBOX ====================== -->

		<link rel="stylesheet" href="assets/css/thickbox.css" type="text/css" media="screen" title="no title" charset="utf-8" />

		<link href="assets/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet" />

		<!-- ================== BEGIN BASE JS ================== -->
		<script src="assets/plugins/pace/pace.min.js"></script>
		<script src="assets/plugins/highchart/highcharts.js"></script>
		<script src="assets/plugins/highchart/modules/data.js"></script>
		<!--<script src="assets/plugins/highchart/exporting.js"></script>-->
		<script src="js/app.js"></script>
		<!-- ================== END BASE JS ================== -->

		<!-- ================== BEGIN BASE JS ================== -->
		<script src="assets/plugins/pace/pace.min.js"></script>
		<!-- ================== END BASE JS ================== -->
	</head>
	<!--
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false">-->

	<!--<body>-->
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->

	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">

					<img src="img/logo_hitam.png">
					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<!--	<li>
						<form class="navbar-form full-width">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Enter keyword" />
								<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
							</div>
						</form>
					</li>-->

					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-2x fa-users"></i>
							<span class="hidden-xs"><?php echo $_SESSION['nama_dan_gelar_user']; ?></span> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<?php
							if (isset($_GET['rl'])) {
								$session_akses = $_GET['r1'];
								$get_role_dec = my_simple_crypt($_GET['rl'], 'd');
								$data = explode("|", $get_role_dec);
								$_SESSION['nilai_unik'] = $data[0];
								$_SESSION['hak_akses'] = $data[1];

								//data[0] --> nilai unik
								//data[1] --> dirlppm, reviewer dan dosen
								if (($_SESSION['hak_akses'] == 'dir_lppm') && ($_SESSION['nil_akses'] == 3)) {
							?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'reviewer') && ($_SESSION['nil_akses'] == 3)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == 3)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'reviewer') && ($_SESSION['nil_akses'] == 2)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-reviewer">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == 2)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-reviewer">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == '4')) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm-dosen">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dir_lppm') && ($_SESSION['nil_akses'] == '4')) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm-dosen">
											Ubah Akses
										</a>
									</li>
								<?php
								}
								//$_SESSION['role']=$data[0];
							} else {
								//data[0] --> nilai unik
								//data[1] --> dirlppm, reviewer dan dosen
								if (($_SESSION['hak_akses'] == 'dir_lppm') && ($_SESSION['nil_akses'] == 3)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'reviewer') && ($_SESSION['nil_akses'] == 3)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == 3)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'reviewer') && ($_SESSION['nil_akses'] == 2)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-reviewer">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == 2)) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-reviewer">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dosen') && ($_SESSION['nil_akses'] == '4')) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm-dosen">
											Ubah Akses
										</a>
									</li>
								<?php
								} else if (($_SESSION['hak_akses'] == 'dir_lppm') && ($_SESSION['nil_akses'] == '4')) {
								?>
									<li>
										<a href="#" data-toggle="modal" data-target="#change-role-dir-lppm-dosen">
											Ubah Akses
										</a>
									</li>
							<?php
								}
							}
							?>




							<li><a href="logout.php">Keluar Sistem</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->

		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;"></a>
						</div>
						<div class="info">

						</div>
					</li>
				</ul>
				<!-- begin sidebar nav -->
				<?php
				$sql_cek_jumlah_anggota_penelitian = mysqli_query($server1, "SELECT
                                                              *
                                                              FROM
                                                              v_pengajuan_penelitian
                                                              WHERE nip_anggota='" . $_SESSION['nik_user'] . "' and tahun_pengajuan=" . date("Y") . "");
				$jumlah_anggota_penelitian = mysqli_num_rows($sql_cek_jumlah_anggota_penelitian);
				$_SESSION['jumlah_anggota_penelitian'] = $jumlah_anggota_penelitian;

				//digunakan untuk pengajuan hanya satu kali
				$sql_cek_jumlah_anggota = mysqli_query($server1, "SELECT
                                                              *
                                                              FROM
                                                              v_pengajuan_pengabdian
                                                              WHERE nip_anggota='" . $_SESSION['nik_user'] . "' and tahun_pengajuan=" . date("Y") . "");
				$jumlah_anggota = mysqli_num_rows($sql_cek_jumlah_anggota);

				$_SESSION['jumlah_anggota_pengabdian'] = $jumlah_anggota;
				?>
				<?php
				function call_menu_dir_lppm()
				{
					$_SESSION['role'] = 'dir_lppm';
				?>
					<ul class='nav'>
						<li class='nav-header'>MENU</li>
						<li><a href='view.php'><i class='fa fa-home'></i> <span>BERANDA</span></a></li>
						<li class='has-sub'>
							<a href='javascript:;'>
								<b class='caret pull-right'></b>
								<i class='fa fa-laptop'></i>
								<span>Data Master</span>
							</a>
							<ul class='sub-menu' <?php if (($_GET['act'] == 'daftar_reviewer') || ($_GET['act'] == 'rubik_penilaian'))  echo "style='display:block;'";
																		else echo "" ?>>
								<li><a href="view.php?menu=reviewer&act=daftar_reviewer"><span class='<?php if ($_GET['act'] == 'daftar_reviewer') echo "blink"/*BLINK*/;
																																											else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'daftar_reviewer') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Reviewer
										</span></a></font>
								</li>
						</li>
						<li class='has-sub'>
						<li><a href="view.php?menu=direktur_lppm&act=rubik_penilaian"><span class='<?php if ($_GET['act'] == 'rubik_penilaian') echo "blink"/*BLINK*/;
																																												else echo ""/*Tidak Blink*/ ?>'>
									<font color='<?php if ($_GET['act'] == 'rubik_penilaian') echo "red"/*BLINK*/;
																else echo ""/*Tidak Blink*/ ?>'>Rubik Penilaian
								</span></a></font>
						</li>
						</li>
					</ul>





					</li>
					<li class='has-sub'>
						<a href='javascript:;'>
							<b class='caret pull-right'></b>
							<i class='fa fa-laptop'></i>
							<span>Pengajuan Penelitian</span>
						</a>
						<ul class='sub-menu' <?php if (($_GET['act'] == 'daftar_pengajuan') || ($_GET['act'] == 'daftar_pengajuan_validasi') || ($_GET['act'] == 'laporan_pengajuan_penelitian')) echo "style='display:block;'";
																	else echo "" ?>>
							<li class='has-sub'>
							<li>
								<a href="view.php?menu=pengajuan&act=daftar_pengajuan"><span class='<?php if ($_GET['act'] == 'daftar_pengajuan') echo "blink"/*BLINK*/;
																																										else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'daftar_pengajuan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'>Pemetaan Reviewer
									</span></a></font>
							</li>
					</li>
					<li class='has-sub'>
					<li class='has-sub'>
					<li>
						<a href="view.php?menu=direktur_lppm&act=daftar_pengajuan_validasi"><span class='<?php if ($_GET['act'] == 'daftar_pengajuan_validasi') echo "blink"/*BLINK*/;
																																															else echo ""/*Tidak Blink*/ ?>'>
								<font color='<?php if ($_GET['act'] == 'daftar_pengajuan_validasi') echo "red"/*BLINK*/;
															else echo ""/*Tidak Blink*/ ?>'>Validasi Penerimaan Proposal
							</span></a></font>
					</li>
					</li>
					</li>
					<li class='has-sub'>
					<li>
						<a href="view.php?menu=pengajuan&act=laporan_pengajuan_penelitian"><span class='<?php if ($_GET['act'] == 'laporan_pengajuan_penelitian') echo "blink"/*BLINK*/;
																																														else echo ""/*Tidak Blink*/ ?>'>
								<font color='<?php if ($_GET['act'] == 'laporan_pengajuan_penelitian') echo "red"/*BLINK*/;
															else echo ""/*Tidak Blink*/ ?>'>Laporan Pengajuan Penelitian
							</span></a></font>
					</li>
					</li>
					</ul>

					<a href='javascript:;'>
						<b class='caret pull-right'></b>
						<i class='fa fa-laptop'></i>
						<span>Pengajuan Pengabdian</span>
					</a>
					<ul class='sub-menu' <?php if (($_GET['act'] == 'daftar_pengajuan_pengabdian') || ($_GET['act'] == 'daftar_pengajuan_validasi_pengabdian') || ($_GET['act'] == 'laporan_pengajuan_pengabdian')) echo "style='display:block;'";
																else echo "" ?>>
						<li class='has-sub'>
						<li>
							<a href="view.php?menu=pengajuan&act=daftar_pengajuan_pengabdian"><span class='<?php if ($_GET['act'] == 'daftar_pengajuan_pengabdian') echo "blink"/*BLINK*/;
																																															else echo ""/*Tidak Blink*/ ?>'>
									<font color='<?php if ($_GET['act'] == 'daftar_pengajuan_pengabdian') echo "red"/*BLINK*/;
																else echo ""/*Tidak Blink*/ ?>'>Pemetaan Reviewer
								</span></a></font>
						</li>
						</li>
						<li class='has-sub'>
						<li class='has-sub'>
						<li>
							<a href="view.php?menu=direktur_lppm&act=daftar_pengajuan_validasi_pengabdian"><span class='<?php if ($_GET['act'] == 'daftar_pengajuan_validasi_pengabdian') echo "blink"/*BLINK*/;
																																																					else echo ""/*Tidak Blink*/ ?>'>
									<font color='<?php if ($_GET['act'] == 'daftar_pengajuan_validasi_pengabdian') echo "red"/*BLINK*/;
																else echo ""/*Tidak Blink*/ ?>'>Validasi Penerimaan Proposal
								</span></a></font>
						</li>
						</li>
						</li>
						<li class='has-sub'>
						<li>
							<a href="view.php?menu=pengajuan&act=laporan_pengajuan_pengabdian"><span class='<?php if ($_GET['act'] == 'laporan_pengajuan_pengabdian') echo "blink"/*BLINK*/;
																																															else echo ""/*Tidak Blink*/ ?>'>
									<font color='<?php if ($_GET['act'] == 'laporan_pengajuan_pengabdian') echo "red"/*BLINK*/;
																else echo ""/*Tidak Blink*/ ?>'>Laporan Pengajuan Penelitian
								</span></a></font>
						</li>
						</li>
					</ul>

					</li>
					<li><a href='view.php?menu=buku_panduan'><i class='fa fa-bookmark'></i> <span> PANDUAN & TEMPLATE</span></a></li>
					<li><a href='logout.php'><i class='fa fa-arrow-circle-left'></i> <span>KELUAR SISTEM</span></a></li>
					</ul>
				<?php
				}

				function call_menu_dosen()
				{
					$_SESSION['role'] = 'dosen';
				?>
					<ul class='nav'>
						<li class='nav-header'>MENU</li>
						<li><a href='view.php'><i class='fa fa-home'></i> <span>BERANDA </span></a></li>
						<li class='has-sub'>
							<a href='javascript:;'>
								<b class='caret pull-right'></b>
								<i class='fa fa-laptop'></i>
								<span>PENELITIAN</span>
							</a>
							<ul class='sub-menu' <?php if ($_GET['menu'] == 'penelitian') echo "style='display:block;'";
																		else echo "" ?>>
								<li class='has-sub'>

									<?php
									if ($_SESSION['jumlah_anggota_penelitian'] > 0) {
									?>
								<li><a href="view.php?menu=penelitian&act=usulan_didaftarkan&act2=exp"><span class='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "blink"/*BLINK*/;
																																																		else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Usulan Baru
										</span></a></font>
								</li>
							<?php
									} else {
							?>
								<li><a href="view.php?menu=penelitian&act=usulan_baru_langkah_satu"><span class='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "blink"/*BLINK*/;
																																																	else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Usulan Baru
										</span></a></font>
								</li>
							<?php
									}
							?>


							<li><a href="view.php?menu=penelitian&act=usulan_didaftarkan"><span class='<?php if ($_GET['act'] == 'usulan_didaftarkan') echo "blink"/*BLINK*/;
																																													else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'usulan_didaftarkan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'> Usulan Di Daftarkan
									</span></a></font>
							</li>

							<li><a href="view.php?menu=penelitian&act=status_pengajuan"><span class='<?php if ($_GET['act'] == 'status_pengajuan') echo "blink"/*BLINK*/;
																																												else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'status_pengajuan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'> Status Pengajuan
									</span></a></font>
							</li>

							<li><a href="view.php?menu=penelitian&act=list_pengajuan"><span class='<?php if ($_GET['act'] == 'list_pengajuan') echo "blink"/*BLINK*/;
																																											else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'list_pengajuan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'> List Pengajuan
									</span></a></font>
							</li>

							</ul>

						<li class='has-sub'>
							<a href='javascript:;'>
								<b class='caret pull-right'></b>
								<i class='fa fa-laptop'></i>
								<span>PENGABDIAN</span>
							</a>
							<ul class='sub-menu' <?php if ($_GET['menu'] == 'pengabdian') echo "style='display:block;'";
																		else echo "" ?>>
								<li class='has-sub'>

									<?php
									if ($_SESSION['jumlah_anggota_pengabdian'] > 0) {
									?>
								<li><a href="view.php?menu=pengabdian&act=usulan_didaftarkan&act2=exp"><span class='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "blink"/*BLINK*/;
																																																		else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Usulan Baru
										</span></a></font>
								</li>
							<?php
									} else {
							?>
								<li><a href="view.php?menu=pengabdian&act=usulan_baru_langkah_satu"><span class='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "blink"/*BLINK*/;
																																																	else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'usulan_baru_langkah_satu') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Usulan Baru
										</span></a></font>
								</li>
							<?php
									}
							?>


							<li><a href="view.php?menu=pengabdian&act=usulan_didaftarkan"><span class='<?php if ($_GET['act'] == 'usulan_didaftarkan') echo "blink"/*BLINK*/;
																																													else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'usulan_didaftarkan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'> Usulan Di Daftarkan
									</span></a></font>
							</li>
							<li><a href="view.php?menu=pengabdian&act=daftar_laporan_kemajuan"><span class='<?php if ($_GET['act'] == 'daftar_laporan_kemajuan') echo "blink"/*BLINK*/;
																																															else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'daftar_laporan_kemajuan') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'>Laporan Kemajuan
									</span></a></font>
							</li>
							</ul>

							<?php
							if ($_SESSION['jenis_jabatan'] == 'kaprodi') {
							?>
								<!--<li class='has-sub'>
											<a href='javascript:;'>
											    <b class='caret pull-right'></b>
											    <i class='fa fa-laptop'></i>
											    <span>PENGAJUAN LEMBAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PENGESAHAN</span>
											</a>
											<ul class='sub-menu'>
												<li><a href='view.php?menu=buku_panduan'><span>PENELITIAN</span></a></li>
												<li><a href='view.php?menu=pengabdian&act=lihat_lembar_pengesahan'><span>PENGABDIAN</span></a></li>
											</ul>
											<li class='has-sub'>-->
							<?php
							}
							?>
						<li><a href='view.php?menu=buku_panduan'><i class='fa fa-bookmark'></i> <span> PANDUAN & TEMPLATE</span></a></li>
						<li><a href='logout.php'><i class='fa fa-arrow-circle-left'></i> <span>KELUAR SISTEM</span></a></li>
						</li>
					</ul>
				<?php
				}

				function call_menu_reviewer()
				{
					$_SESSION['role'] = 'reviewer';
				?>
					<ul class='nav'>
						<li class='has-sub'>
							<a href='javascript:;'>
								<b class='caret pull-right'></b>
								<i class='fa fa-laptop'></i>
								<span>Pengajuan</span>
							</a>
							<ul class='sub-menu' <?php if ($_GET['menu'] == 'pengajuan') echo "style='display:block;'";
																		else echo "" ?>>
								<li class='has-sub'>
								<li>
									<a href="view.php?menu=pengajuan&act=daftar_pengajuan_rev"><span class='<?php if ($_GET['act'] == 'daftar_pengajuan_rev') echo "blink"/*BLINK*/;
																																													else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if ($_GET['act'] == 'daftar_pengajuan_rev') echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Daftar Pengajuan Penelitian
										</span></a></font>

									<a href="view.php?menu=pengajuan&act=daftar_pengajuan_rev_pengabdian"><span class='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan_rev_pengabdian')) echo "blink"/*BLINK*/;
																																																			else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan_rev_pengabdian')) echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Daftar Pengajuan Pengabdian
										</span></a></font>
								</li>
						</li>
					</ul>
					</li>
					<li class='has-sub'>
						<a href='javascript:;'>
							<b class='caret pull-right'></b>
							<i class='fa fa-laptop'></i>
							<span>Laporan Kemajuan</span>
						</a>
						<ul class='sub-menu' <?php if ($_GET['menu'] == 'laporan_kemajuan') echo "style='display:block;'";
																	else echo "" ?>>
							<li class='has-sub'>
							<li>
								<a href="view.php?menu=laporan_kemajuan&act=daftar_kemajuan_pengabdian_rev"><span class='<?php if ($_GET['act'] == 'daftar_kemajuan_pengabdian_rev') echo "blink"/*BLINK*/;
																																																					else echo ""/*Tidak Blink*/ ?>'>
										<font color='<?php if ($_GET['act'] == 'daftar_kemajuan_pengabdian_rev') echo "red"/*BLINK*/;
																	else echo ""/*Tidak Blink*/ ?>'>Daftar Laporan Kemajuan
									</span></a></font>
							</li>
					</li>
					</ul>
					</li>
					<li><a href='view.php?menu=buku_panduan'><i class='fa fa-bookmark'></i> <span> PANDUAN & TEMPLATE</span></a></li>
					<li><a href='logout.php'><i class='fa fa-arrow-circle-left'></i> <span>KELUAR SISTEM</span></a></li>
					</ul>

				<?php
				}
				?>

				<?php
				if (isset($_GET['rl'])) {
					$get_role_dec = my_simple_crypt($_GET['rl'], 'd');
					$data = explode("|", $get_role_dec);
					//simpan session disini
					$_SESSION['role'] = $data[1];

					//cek nomor unik db
					//cek dulu reviwer atau bukan
					//cek dulu direktur atau bukan
					if ($data[1] == 'dosen') {
						call_menu_dosen();
					} else if ($data[1] == 'reviewer') {
						$sql = mysqli_query($server1, "SELECT
													*
													FROM
													reviewer
													WHERE nip_reviewer='" . $_SESSION['nik_user'] . "'");
						$r = mysqli_fetch_array($sql);
						if ($data[0] == $r['random_id']) {
							call_menu_reviewer();
						} else {
							$sql = mysqli_query($server1, "SELECT
													*
													FROM
													pengguna
													WHERE nip='" . $_SESSION['nik_user'] . "' and status=1");
							$r = mysqli_fetch_array($sql);
							if ($data[0] == $r['random_id']) {
								call_menu_reviewer();
							} else {
								echo "role_rev : " . $get_role_dec;
							}
						}
					} else if ($data[1] == 'dir_lppm') {
						$sql = mysqli_query($server1, "SELECT
													*
													FROM
													pengguna
													WHERE nip='" . $_SESSION['nik_user'] . "' and status=1");
						$r = mysqli_fetch_array($sql);
						if ($data[0] == $r['random_id']) {
							call_menu_dir_lppm();
						} else {
							echo "role_dir_lppm $data[0] : " . $get_role_dec;
						}
					} else {
						echo "role : " . $get_role_dec;
				?>
						<script>
							//window.location.href = "http://www.unikom.ac.id";
						</script>
					<?php
					}
				} else {
					//user dosen
					if ($_SESSION['role'] == 'dosen') {
						call_menu_dosen();
					}
					//user operator
					else if ($_SESSION['role'] == 'operator') {
					?>
						<ul class='nav'>
							<li class='nav-header'>MENU</li>
							<li><a href='view.php'><i class='fa fa-home'></i> <span>BERANDA</span></a></li>
							<li class='has-sub'>
								<a href='javascript:;'>
									<b class='caret pull-right'></b>
									<i class='fa fa-laptop'></i>
									<span>Data Master</span>
								</a>
								<ul class='sub-menu' <?php if ($_GET['act'] == 'daftar_reviewer') echo "style='display:block;'";
																			else echo "" ?>>
									<li class='has-sub'>
									<li><a href="view.php?menu=reviewer&act=daftar_reviewer"><span class='<?php if ($_GET['act'] == 'daftar_reviewer') echo "blink"/*BLINK*/;
																																												else echo ""/*Tidak Blink*/ ?>'>
												<font color='<?php if ($_GET['act'] == 'daftar_reviewer') echo "red"/*BLINK*/;
																			else echo ""/*Tidak Blink*/ ?>'>Reviewer
											</span></a></font>
									</li>
							</li>
						</ul>
						</li>
						<li class='has-sub'>
							<a href='javascript:;'>
								<b class='caret pull-right'></b>
								<i class='fa fa-laptop'></i>
								<span>Pengajuan</span>
							</a>
							<ul class='sub-menu' <?php if ($_GET['menu'] == 'pengajuan') echo "style='display:block;'";
																		else echo "" ?>>
								<li class='has-sub'>
								<li>
									<a href="view.php?menu=pengajuan&act=daftar_pengajuan"><span class='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan')) echo "blink"/*BLINK*/;
																																											else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan')) echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Pemetaan Reviewer Penelitian
										</span></a></font>

									<a href="view.php?menu=pengajuan&act=laporan_pengajuan_penelitian"><span class='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'laporan_pengajuan_penelitian')) echo "blink"/*BLINK*/;
																																																	else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'laporan_pengajuan_penelitian')) echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Laporan Pengajuan Penelitian
										</span></a></font>

									<a href="view.php?menu=pengajuan&act=daftar_pengajuan_pengabdian"><span class='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan_pengabdian')) echo "blink"/*BLINK*/;
																																																	else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'daftar_pengajuan_pengabdian')) echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Pemetaan Reviewer Pengabdian
										</span></a></font>

									<a href="view.php?menu=pengajuan&act=laporan_pengajuan_pengabdian"><span class='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'laporan_pengajuan_pengabdian')) echo "blink"/*BLINK*/;
																																																	else echo ""/*Tidak Blink*/ ?>'>
											<font color='<?php if (($_GET['menu'] == 'pengajuan') && ($_GET['act'] == 'laporan_pengajuan_pengabdian')) echo "red"/*BLINK*/;
																		else echo ""/*Tidak Blink*/ ?>'>Laporan Pengajuan Pengabdian
										</span></a></font>

								</li>
						</li>
						</ul>
						</li>
						<li><a href='panduan/Panduan Penelitian Internal 2021.pdf '><i class='fa fa-bookmark'></i> <span>BUKU PANDUAN</span></a></li>
						<li><a href='logout.php'><i class='fa fa-arrow-circle-left'></i> <span>KELUAR SISTEM</span></a></li>
						</ul>
				<?php
					} else if ($_SESSION['role'] == 'reviewer') {
						call_menu_reviewer();
					} else if ($_SESSION['role'] == 'dir_lppm') {
						call_menu_dir_lppm();
					}
				}


				?>




				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>

		<!-- begin #content -->
		<div id="content" class="content">

			<?php

			/*if (isset($_GET['GET']))
						{
							if ($_GET['GET']=='operator_cari_tahun')
							{
								echo "cari tahun";
								
							}
							else if ($_POST['submit']=='frm_cari_laporan_skripsi')
							{
								include "module/skripsi/frm_laporan_langkah_satu_proses.php";
							}

						}
						else
						{*/
			include "content.php";
			//}




			?>

		</div>
		<!-- end #content -->

		<?php include "validasi_div.php"; ?>


		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->


	<!-- ================== BEGIN BASE JS ================== -->
	<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="js/thickbox.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN fancy JS ================== -->
	<script type="text/javascript" src="lib/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="lib/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<!-- ================== END fancy JS ================== -->


	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="assets/js/form-plugins.demo.min.js"></script>
	<script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
	<script src="assets/plugins/lightbox/js/lightbox-2.6.min.js"></script>
	<script src="assets/js/gallery.demo.min.js"></script>



	<!-- ================== BEGIN PAGE LEVEL Table ================== -->
	<script src="assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/KeyTable/js/dataTables.keyTable.min.js"></script>
	<script src="assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/table-manage-keytable.demo.min.js"></script>
	<script src="assets/js/table-manage-fixed-columns.demo.min.js"></script>
	<script src="assets/plugins/gritter/js/jquery.gritter.js"></script>

	<script src="assets/js/ui-modal-notification.demo.min.js"></script>
	<script src="assets/js/apps.min.js"></script>

	<script src="lib/blockui.js"></script>
	<script src="assets/plugins/parsley/dist/parsley.js"></script>
	<script src="lib/jquery.form.js"></script>
	<script src="lib/jquery.price_format.2.0.min.js"></script>


	<!-- ================== END PAGE LEVEL Table ================== -->

	<script>
		/*kategori bidang penelitian*/
		function setup_kategori_bidang() {
			$('#kategori_bidang_pilih').change(update_kategori_bidang);
		}

		function update_kategori_bidang() {

			var kategori_bidang_pilih = $('#kategori_bidang_pilih').attr('value');

			$.get('./module/penelitian_usulan_baru/get_bidang_penelitian.php?kategori_bidang_pilih=' + kategori_bidang_pilih, show_kategori_bidang);

		}

		function show_kategori_bidang(res) {
			$.blockUI({
				message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mengambil Data...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
			});
			//unblock
			$.unblockUI();
			$('#bidang_penelitian_element').hide();
			$('#bidang_peelitian_tampil').html(res);
		}
		$(document).ready(setup_kategori_bidang);
		/*end kategori bidang penelitian*/



		/*kategori bidang pengabdian*/
		function abdi_setup_kategori_bidang() {
			$('#kategori_bidang_pilih_abdi').change(update_kategori_bidang_abdi);

		}

		function update_kategori_bidang_abdi() {

			var kategori_bidang_pilih_abdi = $('#kategori_bidang_pilih_abdi').attr('value');

			$.get('./module/pengabdian_usulan_baru/get_bidang_pengabdian.php?kategori_bidang_pilih_abdi=' + kategori_bidang_pilih_abdi, show_kategori_bidang);


		}

		function show_kategori_bidang(res) {
			$.blockUI({
				message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mengambil Data...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
			});
			//unblock
			$.unblockUI();

			$('#bidang_pengabdian_element').hide();
			$('#bidang_pengabdian_tampil').html(res);
		}
		$(document).ready(abdi_setup_kategori_bidang);
		/*end kategori bidang pengabdian*/



		$(document).ready(function() {
			App.init();
			//TableManageKeyTable.init();
			TableManageFixedColumns.init();
			FormPlugins.init();


			var table_2 = $('#default_tabel').DataTable({
				//scrool problem in header
				scrollX: true,
				sScrollXInner: "100%",
				//endscrool problem in header
				scrollY: "500px",
				scrollCollapse: true,
				paging: true,
				searching: true
			});


			var table_3 = $('#tabel_distribusi').DataTable({
				scrollY: "500px",
				scrollX: "2500px",
				scrollCollapse: true,
				paging: true,
				searching: true,
				"oLanguage": {
					"sInfo": "Menampilkan _START_ dari _END_ of _TOTAL_ Data <br><b><span class=blink><font color=red>(Scrool untuk melihat data selengkapnya)", // text you want show for info section
				},
				//custom colom//
				columnDefs: [{
						"width": "10%",
						"targets": 0
					},
					{
						"width": "3%",
						"targets": 1
					},
					{
						"width": "3%",
						"targets": 2
					},
					{
						"width": "10%",
						"targets": 3
					},
					{
						"width": "10%",
						"targets": 4
					},
					{
						"width": "10%",
						"targets": 5
					},
					{
						"width": "5%",
						"targets": 6
					},
					{
						"width": "5%",
						"targets": 7
					},
					{
						"width": "40%",
						"targets": 8
					}

				],
				fixedColumns: {
					leftColumns: 0,
					rightColumns: 0
				}
			});



			$("#datepickers").datepicker({
				format: 'dd-mm-yyyy'
			});

			$("#datepickers2").datepicker({
				format: 'dd-mm-yyyy'
			});




			//------------------------------------------------------- TAMBAH DANA PENGAJUAN
			$("#tambah_dana_pengajuan").click(function() {

				//diakali supaya menambah satu ketika hapus
				var banyak_data_sebelumnya_plus_satu = +$('#banyak_data_sebelumnya').val() + 1;
				$('#banyak_data_sebelumnya').val(banyak_data_sebelumnya_plus_satu);

				//end


				$('#container').append(
					'<tr>' +
					'<td><div id="' + banyak_data_sebelumnya_plus_satu + '"><label for=""><b>' + banyak_data_sebelumnya_plus_satu + '</div></b></label></td>' +
					'<td class="text-left"><input class="form-control input-sm" id="nama_pengajuan_' + banyak_data_sebelumnya_plus_satu + '" name="nama_pengajuan_' + banyak_data_sebelumnya_plus_satu + '" type="text" size="80"></td>' +
					'<td class="text-right"><input class="form-control input-sm nilai_pengajuan" id="nilai_pengajuan_' + banyak_data_sebelumnya_plus_satu + '" name="nilai_pengajuan_' + banyak_data_sebelumnya_plus_satu + '" type="text" style="text-align: right"></td>' +
					'<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5 btn_hapus_dana_peneliti" value="' + banyak_data_sebelumnya_plus_satu + '"><i class="fa fa-edit"></i> Hapus</button></td>' +
					'<input id="rows_' + banyak_data_sebelumnya_plus_satu + '" name="rows[]" value="' + banyak_data_sebelumnya_plus_satu + '" type="hidden"></td></tr>'
				);

				$('#nama_pengajuan_' + banyak_data_sebelumnya_plus_satu).focus();

				var banyak_data = +$('#banyak_data').val() + 1;
				$('#banyak_data').val(banyak_data);

			});
			//end dana pengajuan

		});

		//fungsi yang digunakan untuk mengakali append
		//mengakali append tidak bisa secara langsung panggil kembali seperti ini karena pada pengajuan (nama belakang kita menggunakan append)
		//ini sebetulnya memanggil kelas untuk nama belakang atau pengajuan yaitu pengajuan abcd, karena kita menggunakan double class pada element
		$(document).on('click', '.btn_hapus_dana_peneliti', function(e) {

			var id_button = $(this).val();

			//----untuk mengetahui nilai-------//
			//dapatkan nilai
			var nilai_text = $('#nilai_pengajuan_' + id_button).val();
			//replace nilai text
			nilai_text = nilai_text.replace(/[.Rp]/g, ''); //str is "abcdefgh";
			//get value dari total
			var total_text = $('#total_pengajuan').val();
			total_text = total_text.replace(/[.Rp]/g, ''); //str is "abcdefgh";
			//proes pengurangan
			var sum = total_text - nilai_text;
			//-----------end untuk mengetahui nilai--------//


			//--------------- konversi ke mata uang -------------//
			$('#total_pengajuan').val(sum);
			$('#total_pengajuan_label').text("Rp. " + sum);
			$('#total_pengajuan_label').priceFormat({
				prefix: 'Rp ',
				centsSeparator: ',',
				thousandsSeparator: '.',
				centsLimit: 0
			});
			//end konversi

			//---------------------proses hapus ---------------//
			e.preventDefault();
			$(this).parent().parent().remove();
			//hapus nilai banyak data
			//diakali supaya menambah satu ketika hapus
			var banyak_data_sebelumnya_plus_satu = +$('#banyak_data_sebelumnya').val() - 1;
			$('#banyak_data_sebelumnya').val(banyak_data_sebelumnya_plus_satu);

			var banyak_data = ($('#banyak_data').val()) - 1;
			$('#banyak_data').val(banyak_data);
			//---------------------end proses hapus ---------------//
		});

		function validasi_frm_dana() {
			if (($('#banyak_data').val() == '') || ($('#banyak_data').val() == 0)) {
				$.blockUI({
					theme: true, // true to enable jQuery UI support 
					draggable: true, // draggable option is only supported when jquery UI script is included 
					title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
					message: '<center><h5>Anda Wajib Mengisikan Dana Pengajuan Pengabdian Internal</h5>'

				});
				$('#close').bind('click', $.unblockUI);
				return false;
			} else if (($('#skema').val() == 'pkm') && ($('#total_pengajuan').val() > 200000000)) {
				$.blockUI({
					theme: true, // true to enable jQuery UI support 
					draggable: true, // draggable option is only supported when jquery UI script is included 
					title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
					message: '<center><h5>Dana Untuk Skema Pengabdian Ini Maksimal Rp. 2.000.000</h5>'

				});
				$('#close').bind('click', $.unblockUI);
				return false;
			} else if (($('#skema').val() == 'ppk') && ($('#total_pengajuan').val() > 4000000000)) {
				$.blockUI({
					theme: true, // true to enable jQuery UI support 
					draggable: true, // draggable option is only supported when jquery UI script is included 
					title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
					message: '<center><h5>Dana Untuk Skema Pengabdian Ini Maksimal Rp. 4.000.000</h5>'

				});
				$('#close').bind('click', $.unblockUI);
				return false;
			} else if (($('#skema').val() == 'ppdm') && ($('#total_pengajuan').val() > 4000000000)) {
				$.blockUI({
					theme: true, // true to enable jQuery UI support 
					draggable: true, // draggable option is only supported when jquery UI script is included 
					title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
					message: '<center><h5>Dana Untuk Skema Pengabdian Ini Maksimal Rp. 4.000.000</h5>'

				});
				$('#close').bind('click', $.unblockUI);
				return false;
			} else if (($('#skema').val() == 'ppim') && ($('#total_pengajuan').val() > 4000000000)) {
				$.blockUI({
					theme: true, // true to enable jQuery UI support 
					draggable: true, // draggable option is only supported when jquery UI script is included 
					title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
					message: '<center><h5>Dana Untuk Skema Pengabdian Ini Maksimal Rp. 4.000.000</h5>'

				});
				$('#close').bind('click', $.unblockUI);
				return false;
			} else {
				var i = Number($('#banyak_data_sebelumnya').val()) - ($('#banyak_data').val());
				var x = Number($('#banyak_data_sebelumnya').val()) + 1;


				for (i = i; i < x; i++) {
					if (($('#nama_pengajuan_' + i).val() == '') || ($('#nilai_pengajuan_' + i).val() == '')) {

						$.blockUI({
							theme: true, // true to enable jQuery UI support 
							draggable: true, // draggable option is only supported when jquery UI script is included 
							title: 'Pesan<a class="ui-dialog-titlebar-close ui-corner-all" href="#"><img src="img/close.png" id="close" align="right" ></img><a>', // only used when theme == true 
							message: '<center><h5>Lengkapi Data Anda Pada Baris Ke ' + i + '</h5>'

						});
						$('#close').bind('click', $.unblockUI);
						$('#nama_pengajuan_' + i).focus();

						return false;
					}
				}
			}
		}


		$(document).on('keyup', '.nilai_pengajuan', function(e) {
			var sum = 0;

			$('.nilai_pengajuan').each(function() {
				// sum += Number($(this).val());
				var str = $(this).val();
				str = str.replace(/[.Rp]/g, ''); //str is "abcdefgh";
				sum += Number(str);

			});

			sum = Number($('#total_pengajuan_yang_telah_diinput').val()) + sum;

			$('#total_pengajuan').val(sum);
			$('#total_pengajuan_label').text("Rp. " + sum);

		});

		//fungsi rupiah
		$(document).on('keyup', '.nilai_pengajuan', function(e) {
			$('.nilai_pengajuan').each(function() {
				$('.nilai_pengajuan').priceFormat({
					prefix: 'Rp ',
					centsSeparator: ',',
					thousandsSeparator: '.',
					centsLimit: 0
				});

				$('#total_pengajuan_label').priceFormat({
					prefix: 'Rp ',
					centsSeparator: ',',
					thousandsSeparator: '.',
					centsLimit: 0
				});
			});
		});
		//end fungsi
		//end mengakali append -----------------------------------------------------------------------------------------------------------------------//

		$('#hapus-modal-dana').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];
			var data_nominal_dana_pengajuan = data_split[3];

			$.ajax({
				type: 'post',
				url: 'module/penelitian_usulan_baru/get_data_hapus_dana.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + data_nama + '&nominal=' + data_nominal_dana_pengajuan,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});
		});


		function hapus_dana_pengajuan() {
			id = $('#idx').val();
			judul = $('#judul').val();
			nominal = $('#nominal').val();


			$.ajax({
				type: 'post',
				url: "module/penelitian_usulan_baru/get_data_hapus_dana_proses.php",
				data: 'idx=' + id + '&judul=' + judul + '&nominal=' + nominal,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//transaksi di setiap element, kurangkan nilai di setiap element
						total_pengajuan_yang_telah_diinput = Number($('#total_pengajuan_yang_telah_diinput').val());
						sum = total_pengajuan_yang_telah_diinput - nominal;

						$('#total_pengajuan_yang_telah_diinput').val(sum);
						$('#total_pengajuan').val(sum);
						$('#total_pengajuan_label').text("Rp. " + sum);

						//kembalikan ke semula format rupiah
						$('#total_pengajuan_label').priceFormat({
							prefix: 'Rp ',
							centsSeparator: ',',
							thousandsSeparator: '.',
							centsLimit: 0
						});
						//end transaksi di setiap element, kurangkan nilai di setiap element

						//remove tr
						$('#tr' + id).toggle(500);

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});



						//tutup modal
						$("#hapus-modal-dana").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal


					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});

			/*$.gritter.add({
					  // heading of the notification
					  title: 'Pesan',
					  // the text inside the notification
					  text: 'Your message here',
					  image: 'img/logo_unikom_kecil.jpg'
					});
			return false;*/
		}

		//-------------------------------------------------------END Hapus DANA PENGAJUAN




		$('#hapus-modal-dana-pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;


			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];
			var data_nominal_dana_pengajuan = data_split[3];

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/get_data_hapus_dana.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + data_nama + '&nominal=' + data_nominal_dana_pengajuan,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});
		});


		function hapus_dana_pengajuan_pengabdian() {
			id = $('#idx').val();
			judul = $('#judul').val();
			nominal = $('#nominal').val();


			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_hapus_dana_proses.php",
				data: 'idx=' + id + '&judul=' + judul + '&nominal=' + nominal,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//transaksi di setiap element, kurangkan nilai di setiap element
						total_pengajuan_yang_telah_diinput = Number($('#total_pengajuan_yang_telah_diinput').val());
						sum = total_pengajuan_yang_telah_diinput - nominal;

						$('#total_pengajuan_yang_telah_diinput').val(sum);
						$('#total_pengajuan').val(sum);
						$('#total_pengajuan_label').text("Rp. " + sum);

						//kembalikan ke semula format rupiah
						$('#total_pengajuan_label').priceFormat({
							prefix: 'Rp ',
							centsSeparator: ',',
							thousandsSeparator: '.',
							centsLimit: 0
						});
						//end transaksi di setiap element, kurangkan nilai di setiap element

						//remove tr
						$('#tr' + id).toggle(500);

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});



						//tutup modal
						$("#hapus-modal-dana-pengabdian").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal


					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});

			/*$.gritter.add({
					  // heading of the notification
					  title: 'Pesan',
					  // the text inside the notification
					  text: 'Your message here',
					  image: 'img/logo_unikom_kecil.jpg'
					});
			return false;*/
		}

		//-------------------------------------------------------END Hapus DANA PENGAJUAN




		//----------------------- Cari Peneliti Dosen ------------------------------------------------------------------------------------------------------//
		//-- modul dosen -- validasi div -- get data peneliti -- frm_tampil_api
		$(document).ready(function() {
			$("#cari_peneliti").click(function() {

				var kata_kunci = $('#kata_kunci').val();
				$.blockUI({
					message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mencari Data Dosen " + kata_kunci + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
				});
				$.ajax({
					url: "module/penelitian_usulan_baru/get_data_peneliti_dosen.php",
					data: "kata_kunci=" + kata_kunci,
					cache: false,
					success: function(msg) {
						//unblock
						$.unblockUI();

						//karna di server pembatas setiap data adalah |
						//maka kita split dan akan membentuk array
						data = msg.split("|");


						if (data[0] == 'ditemukan') {
							//masukkan ke masing-masing textfield
							/*console.log(data[0]);
							console.log(data[1]);
							console.log(data[2]);
							console.log(data[3]);*/

							//Tampilkan Data
							$('#modal-dialog-peneliti-dosen').modal('show');


						} else if (data[0] == 'tidak_ditemukan') {
							//Tampilkan Data
							$('#modal-dialog-peneliti-dosen').modal('show');
						}




					},
					error: function(xhr, textStatus, error) {
						//unblock
						$.unblockUI();
						alert(xhr.status);

					}
				});

			});
		});

		$('#modal-dialog-peneliti-dosen').on('show.bs.modal', function(e) {

			var $modal = $(this),
				//data nip peneliti
				kata_kunci = data[1];

			if (data[0] == 'ditemukan') {
				$.ajax({
					type: 'post',
					url: 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_dosen.php',
					data: 'act=ditemukan&kata_kunci=' + kata_kunci + '&nama_peneliti=' + data[2] + '&keterangan=' + data[3],
					success: function(data) {
						$('.fetched-data').html(data); //menampilkan data ke dalam modal
					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);

					}
				});

			} else if (data[0] == 'tidak_ditemukan') {
				$.ajax({
					type: 'post',
					url: 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_dosen.php',
					data: 'act=tidak_ditemukan&kata_kunci=' + kata_kunci,
					success: function(data) {
						$('.fetched-data').html(data); //menampilkan data ke dalam modal
					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);

					}
				});
			}


		});

		$('#ubah-anggota-pengabdian-dosen-luar').on('show.bs.modal', function(e) {
			var data = $(e.relatedTarget).data('id');

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/frm_tampil_ubah_data_peneliti_dosen_luar.php',
				data: 'act=ditemukan&kata_kunci=' + data,
				success: function(data) {
					$('.fetched-data-ubah-dosen-luar').html(data); //menampilkan data ke dalam modal
				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);

				}
			});
			/*
           if (data[0]=='ditemukan')
           {     
				$.ajax({
		                type : 'post',
		                url : 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_dosen.php',
		                data :  'act=ditemukan&kata_kunci='+kata_kunci+'&nama_peneliti='+data[2]+'&keterangan='+data[3],
		                success : function(data)
		                {
		                	$('.fetched-data').html(data);//menampilkan data ke dalam modal
		                },
		                error: function(xhr, textStatus, error)
						{
								alert(xhr.status);
								 
						}
		            });

			}
			else if (data[0]=='tidak_ditemukan')
           {    
				$.ajax({
		                type : 'post',
		                url : 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_dosen.php',
		                data :  'act=tidak_ditemukan&kata_kunci='+kata_kunci,
		                success : function(data)
		                {
		                	$('.fetched-data').html(data);//menampilkan data ke dalam modal
		                },
		                error: function(xhr, textStatus, error)
						{
								alert(xhr.status);
								 
						}
		            });
			}
			*/

		});

		//mengganti status ketua session
		$("#status_peneliti_session").change(function() {

			var status_peneliti_session = $('#status_peneliti_session').val();
			var banyak_data_peneliti = $('#banyak_data_peneliti').val();
			if ((banyak_data_peneliti == 1) && (status_peneliti_session == 'Ketua') && $('#banyak_ketua_peneliti').val() == 0) {
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() + 1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			} else if ((banyak_data_peneliti == 1) && (status_peneliti_session == 'Anggota') && $('#banyak_ketua_peneliti').val() > 0) {
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() - 1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			} else if ((banyak_data_peneliti == 1) && (status_peneliti_session == '0') && $('#banyak_ketua_peneliti').val() > 0) {
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() - 1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			} else if ((banyak_data_peneliti > 1) && (status_peneliti_session == 'Ketua') && ($('#banyak_ketua_peneliti').val() == 0)) {
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() + 1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			} else if ((banyak_data_peneliti > 1) && (status_peneliti_session == 'Ketua') && $('#banyak_ketua_peneliti').val() > 0) {
				$('#modal-dialog-ceklis-banyak').modal('show');
				$("#status_peneliti_session").prop('selectedIndex', 2);
			}


			/*else if ((status_peneliti_session=='ketua')&&$('#banyak_ketua_peneliti').val()==0)
			{	
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val()+1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			}
			else if ((status_peneliti_session=='anggota')&&($('#banyak_ketua_peneliti').val()>0))
			{
				//cek ketua peneliti
				var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val()-1;
				$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
				//end cek ketua peneliti
			}*/



		});
		//end mengganti status ketua session




		///digunakan untuk menambah peneliti baik mahasiswa atau dosen
		function tambah_peneliti() {
			var status_peneliti = $('#status_peneliti').val();


			if (status_peneliti.trim() == '0') {
				alert('Status Peneliti Belum Dipilih');
				return false;
			}
			//cek jika ada kesamaan nip
			else if (($('#nip_anggota_peneliti_1').val() == $('#nip_anggota_peneliti').val()) ||
				($('#nip_anggota_peneliti_2').val() == $('#nip_anggota_peneliti').val()) ||
				($('#nip_anggota_peneliti_3').val() == $('#nip_anggota_peneliti').val()) ||
				($('#nip_anggota_peneliti_4').val() == $('#nip_anggota_peneliti').val()) ||
				($('#nip_anggota_peneliti_5').val() == $('#nip_anggota_peneliti').val()) ||
				($('#nip_anggota_peneliti_6').val() == $('#nip_anggota_peneliti').val())
			) {
				$('#modal-dialog-anggota_peneliti_sudah_dipilih').modal('show');
				return false;
			}
			//end cek jika ada kesamaan nip
			else if (($('#banyak_ketua_peneliti').val() > 0) && (status_peneliti == 'Ketua')) {
				$('#modal-dialog-ketua_hanya_satu').modal('show');
				return false;
			} else if (status_peneliti.trim() != '0') {
				var keterangan_peneliti = $('#keterangan_peneliti').val();
				var keterangan_peneliti = keterangan_peneliti.replace(/\s/g, '');

				if (status_peneliti == 'Ketua') {
					//cek ketua peneliti
					var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() + 1;
					$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
					//end cek ketua peneliti
				}

				var jml_dosen = +$('#jml_dosen').val() + 1;
				$('#jml_dosen').val(jml_dosen);



				//add textbox peneliti
				var banyak_data_peneliti = +$('#banyak_data_peneliti').val() + 1;
				$('#banyak_data_peneliti').val(banyak_data_peneliti);
				//end add textbox peneliti

				//add textbox peneliti
				var klik_cari_append = +$('#klik_cari_append').val() + 1;
				$('#klik_cari_append').val(klik_cari_append);
				//end add textbox peneliti


				var nip_anggota_peneliti = $('#nip_anggota_peneliti').val();
				var nama_anggota_peneliti = $('#nama_anggota_peneliti').val();

				var status_peneliti = $('#status_peneliti').val();
				var program_studi_peneliti = $('#nama_program_studi').val();
				var universitas = $('#nama_universitas').val();



				if (keterangan_peneliti == 'Dosen') {
					tampil_keterangan_peneliti = 'Dosen';
				} else if (keterangan_peneliti == 'DosenLuar') {

					tampil_keterangan_peneliti = 'Dosen Luar<br>' + program_studi_peneliti + '<br>' + universitas;
				} else {
					tampil_keterangan_peneliti = 'Mahasiswa';
				}



				$('#container_peneliti').append(
					'<tr id=tr' + nip_anggota_peneliti + '>' +
					'<td><div id="' + banyak_data_peneliti + '"><label for=""><b>' + banyak_data_peneliti + '</div></b></label></td>' +
					'<td class="text-left"><label for=""><b>' + nip_anggota_peneliti + '</b></label><input class="form-control input-sm" id="nip_anggota_peneliti_' + banyak_data_peneliti + '" name="nip_anggota_peneliti_' + banyak_data_peneliti + '" type="hidden" value=' + nip_anggota_peneliti + '></td>' +
					'<td class="text-left"><label for=""><b>' + nama_anggota_peneliti + '</b></label><input class="form-control input-smn" id="nama_belakang_' + banyak_data_peneliti + '" name="nama_belakang_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + nama_anggota_peneliti + '"></td>' +
					'<td class="text-left"><label for=""><b>' + status_peneliti + '</b></label><input class="form-control input-sm" id="status_peneliti_' + banyak_data_peneliti + '" name="status_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value=' + status_peneliti + '></td>' +
					'<td class="text-left"><label for=""><b>' + tampil_keterangan_peneliti + '</b></label><input class="form-control input-sm" id="keterangan_peneliti_' + banyak_data_peneliti + '" name="keterangan_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + keterangan_peneliti + '"></td>' +
					'<input class="form-control input-sm" id="program_studi_peneliti_' + banyak_data_peneliti + '" name="program_studi_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + program_studi_peneliti + '">' +
					'<input class="form-control input-sm" id="universitas_' + banyak_data_peneliti + '" name="universitas_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + universitas + '">' +
					'<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5 btn_hapus_peneliti" value="hapus|' + nip_anggota_peneliti + '|' + nama_anggota_peneliti + '|' + keterangan_peneliti + '"><i class="fa fa-edit"></i> Hapus</button></td>' +
					'<input id="rows_' + banyak_data_peneliti + '" name="rows[]" value="' + banyak_data_peneliti + '" type="hidden"></td></tr>'
				);




				//menutup modal box mahasiswa
				if (keterangan_peneliti == 'Dosen') {

					//tutup modal box
					$("#modal-dialog-peneliti-dosen").modal("hide");
					e.stopPropagation(); //This line would take care of it
					//end tutup modal
				} else if (keterangan_peneliti == 'DosenLuar') {

					//tutup modal box
					$("#modal-dialog-peneliti-dosen-luar").modal("hide");
					e.stopPropagation(); //This line would take care of it
					//end tutup modal
				} else {
					var jml_mhs = +$('#jml_mhs').val() + 1;
					$('#jml_mhs').val(jml_mhs);

					//tutup modal box
					$("#modal-dialog-peneliti-mhs").modal("hide");
					//$("#modal-dialog-peneliti-mhs .close").click();
					e.stopPropagation(); //This line would take care of it
					//end tutup modal
				}
			}
		}


		function tambah_peneliti_dosen_luar() {
			var status_peneliti = $('#status_peneliti_dosen_luar').val();


			if (status_peneliti.trim() == '0') {
				alert('Status Peneliti Belum Dipilih');
				return false;
			}
			//cek jika ada kesamaan nip
			else if (($('#nip_anggota_peneliti_1').val() == $('#nip_anggota_peneliti_dosen_luar').val()) ||
				($('#nip_anggota_peneliti_2').val() == $('#nip_anggota_peneliti_dosen_luar').val()) ||
				($('#nip_anggota_peneliti_3').val() == $('#nip_anggota_peneliti_dosen_luar').val()) ||
				($('#nip_anggota_peneliti_4').val() == $('#nip_anggota_peneliti_dosen_luar').val()) ||
				($('#nip_anggota_peneliti_5').val() == $('#nip_anggota_peneliti_dosen_luar').val()) ||
				($('#nip_anggota_peneliti_6').val() == $('#nip_anggota_peneliti_dosen_luar').val())
			) {
				$('#modal-dialog-anggota_peneliti_sudah_dipilih').modal('show');
				return false;
			}
			//end cek jika ada kesamaan nip
			else if (($('#banyak_ketua_peneliti').val() > 0) && (status_peneliti == 'Ketua')) {
				$('#modal-dialog-ketua_hanya_satu').modal('show');
				return false;
			} else if (status_peneliti.trim() != '0') {
				var keterangan_peneliti = $('#keterangan_peneliti_dosen_luar').val();
				var keterangan_peneliti = keterangan_peneliti.replace(/\s/g, '');
				var tampil_keterangan_peneliti = 'Dosen Luar<br>' + program_studi_peneliti + '<br>' + universitas;

				if (status_peneliti == 'Ketua') {
					//cek ketua peneliti
					var banyak_ketua_peneliti = +$('#banyak_ketua_peneliti').val() + 1;
					$('#banyak_ketua_peneliti').val(banyak_ketua_peneliti);
					//end cek ketua peneliti
				} else if (($('#bagian').val() == 'pengabdian') && (keterangan_peneliti == 'DosenLuar')) {
					//var jml_dosen = +$('#jml_dosen').val()+1;
					//$('#jml_dosen').val(jml_dosen);
					var jml_dosen = +$('#jml_dosen').val() + 1;
					$('#jml_dosen').val(jml_dosen);
				}
				/*else if (($('#bagian').val()=='pengabdian')&&($('#jml_dosen').val()>=1)&&(keterangan_peneliti=='DosenLuar')&&($('#skema').val()!='ppim'))
				{
					$('#modal-dialog-anggota_dosen_lebih_dari_2').modal('show');
					return false;
				}*/


				//add textbox peneliti
				var banyak_data_peneliti = +$('#banyak_data_peneliti').val() + 1;
				$('#banyak_data_peneliti').val(banyak_data_peneliti);
				//end add textbox peneliti

				//add textbox peneliti
				var klik_cari_append = +$('#klik_cari_append').val() + 1;
				$('#klik_cari_append').val(klik_cari_append);
				//end add textbox peneliti


				var nip_anggota_peneliti = $('#nip_anggota_peneliti_dosen_luar').val();
				var nama_anggota_peneliti = $('#nama_anggota_peneliti_dosen_luar').val();

				var status_peneliti = $('#status_peneliti_dosen_luar').val();
				var program_studi_peneliti = $('#nama_program_studi_dosen_luar').val();
				var universitas = $('#nama_universitas_dosen_luar').val();
				var tampil_keterangan_peneliti = 'Dosen Luar<br>' + program_studi_peneliti + '<br>' + universitas;





				$('#container_peneliti').append(
					'<tr id=tr' + nip_anggota_peneliti + '>' +
					'<td><div id="' + banyak_data_peneliti + '"><label for=""><b>' + banyak_data_peneliti + '</div></b></label></td>' +
					'<td class="text-left"><label for=""><b>' + nip_anggota_peneliti + '</b></label><input class="form-control input-sm" id="nip_anggota_peneliti_' + banyak_data_peneliti + '" name="nip_anggota_peneliti_' + banyak_data_peneliti + '" type="hidden" value=' + nip_anggota_peneliti + '></td>' +
					'<td class="text-left"><label for=""><b>' + nama_anggota_peneliti + '</b></label><input class="form-control input-smn" id="nama_belakang_' + banyak_data_peneliti + '" name="nama_belakang_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + nama_anggota_peneliti + '"></td>' +
					'<td class="text-left"><label for=""><b>' + status_peneliti + '</b></label><input class="form-control input-sm" id="status_peneliti_' + banyak_data_peneliti + '" name="status_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value=' + status_peneliti + '></td>' +
					'<td class="text-left"><label for=""><b>' + tampil_keterangan_peneliti + '</b></label><input class="form-control input-sm" id="keterangan_peneliti_' + banyak_data_peneliti + '" name="keterangan_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + keterangan_peneliti + '"></td>' +
					'<input class="form-control input-sm" id="program_studi_peneliti_' + banyak_data_peneliti + '" name="program_studi_peneliti_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + program_studi_peneliti + '">' +
					'<input class="form-control input-sm" id="universitas_' + banyak_data_peneliti + '" name="universitas_' + banyak_data_peneliti + '" type="hidden" style="text-left: left" value="' + universitas + '">' +
					'<td class="text-left"><button type="button" class="btn btn-danger btn-sm m-r-5 btn_hapus_peneliti" value="hapus|' + nip_anggota_peneliti + '|' + nama_anggota_peneliti + '|' + keterangan_peneliti + '"><i class="fa fa-edit"></i> Hapus</button></td>' +
					'<input id="rows_' + banyak_data_peneliti + '" name="rows[]" value="' + banyak_data_peneliti + '" type="hidden"></td></tr>'
				);

				//tutup modal box
				$("#modal-dialog-peneliti-dosen-luar").modal("hide");
				e.stopPropagation(); //This line would take care of it
				//end tutup modal
			}
		}


		// ---------------------------------------------------------- Fungsi yang dibuat untuk Confirmasi Hapus Data
		function confirm(heading, question, cancelButtonTxt, okButtonTxt, callback) {
			var confirmModal =
				$('<div class="modal fade" id="hapus-modal-peneliti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">' +
					'<div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button><h4 class="modal-title" id="labelModalKu">Pesan</h4></div><div class="modal-body"><center><h5><span class="blink">' + question + '<b><br><br><font color="red"></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button> <button type="button" class="btn btn-danger submitBtn" id="okButton">Setuju</button></div></div></div></div>');

			confirmModal.find('#okButton').click(function(event) {
				callback();
				confirmModal.modal('hide');
			});

			confirmModal.modal('show');
		};
		// ---------------------------------------------------------- End Confirmasi Hapus Data




		$(document).on('click', '.btn_hapus_peneliti', function(e) {
			//---------------------proses hapus ---------------//
			/*e.preventDefault();
	       		$(this).parent().parent().remove();

	            //hapus nilai banyak data
	            var banyak_data_peneliti = +$('#banyak_data_peneliti').val()-1;
	            $('#banyak_data_peneliti').val(banyak_data_peneliti);*/
			// get txn id from current table row
			var id = $(this).val();
			var data_split = id.split("|");
			var nip = data_split[1];
			var nama = data_split[2];
			var ket = data_split[3];

			var heading = 'Pesan';
			var question = 'Apakah Anda Yakin Akan Menghapus ' + nama + '?';
			var cancelButtonTxt = 'Cancel';
			var okButtonTxt = 'Confirm';

			var callback = function() {
				//alert('delete confirmed ' + id);
				$('#tr' + nip).fadeOut(1000, function() {
					$(this).remove();
				});

				var banyak_data_peneliti = +$('#banyak_data_peneliti').val() - 1;
				$('#banyak_data_peneliti').val(banyak_data_peneliti);



				if ((ket == 'Dosen') || (ket == 'DosenLuar')) {
					var jml_dosen = +$('#jml_dosen').val() - 1;
					$('#jml_dosen').val(jml_dosen);
				} else {
					var jml_mhs = +$('#jml_mhs').val() - 1;
					$('#jml_mhs').val(jml_mhs);
				}
			};

			confirm(heading, question, cancelButtonTxt, okButtonTxt, callback);

		});





		//-- modul mahasiswa -- validasi div -- get data peneliti -- frm_tampil_api
		$(document).ready(function() {
			$("#cari_peneliti_mhs").click(function() {

				var kata_kunci_mhs = $('#kata_kunci_mhs').val();
				$.blockUI({
					message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mencari Data Mahasiswa " + kata_kunci_mhs + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
				});
				$.ajax({
					url: "module/penelitian_usulan_baru/get_data_peneliti_mhs.php",
					data: "kata_kunci=" + kata_kunci_mhs,
					cache: false,
					success: function(msg) {
						//unblock
						$.unblockUI();

						//karna di server pembatas setiap data adalah |
						//maka kita split dan akan membentuk array
						data = msg.split("|");


						if (data[0] == 'ditemukan') {
							//Tampilkan Data
							$('#modal-dialog-peneliti-mhs').modal('show');



						} else if (data[0] == 'tidak_ditemukan') {
							//Tampilkan Data
							$('#modal-dialog-peneliti-mhs').modal('show');
						}

					},
					error: function(xhr, textStatus, error) {
						//unblock
						$.unblockUI();
						alert(xhr.status);

					}
				});
			});
		});


		$('#modal-dialog-peneliti-mhs').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				//data nip peneliti
				kata_kunci = data[1];

			if (data[0] == 'ditemukan') {
				$.ajax({
					type: 'post',
					url: 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_mhs.php',
					data: 'act=ditemukan&kata_kunci=' + kata_kunci + '&nama_peneliti=' + data[2] + '&keterangan=' + data[3],
					success: function(data) {
						$('.fetched-data').html(data); //menampilkan data ke dalam modal
					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);

					}
				});

			} else if (data[0] == 'tidak_ditemukan') {
				$.ajax({
					type: 'post',
					url: 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_mhs.php',
					data: 'act=tidak_ditemukan&kata_kunci=' + kata_kunci,
					success: function(data) {
						$('.fetched-data').html(data); //menampilkan data ke dalam modal
					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);

					}
				});
			}


		});
		//----------------------- End Cari Peneliti Mahasiswa -----------------------------------------------//

		/*
		//ubah peneliti
		$(document).ready(function()
		{
			$("#ubah_anggota_peneliti").click(function()
			{  
				var id = $(this).attr("value");

				 //effect
			   $('#tr'+id).animate({backgroundColor: "#FF0000" },5000);
			   $('#tr'+id).animate({backgroundColor: "#F9F9F9" },5000);
			   
				//Tampilkan Data
				$('#modal-dialog-ubah-anggota-peneliti').modal('show');
				$('.tampil_data_ditemukan').hide();
			}); 
		});
		//end ubah peneliti
		*/

		//------------------------ ubah peneliti ------------------------------------------
		//frm_langkah_tiga_anggota_peneliti - view - validasi div - frm tampil ubah data peneliti
		$('#ubah-anggota-peneliti').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var data_id = data_split[1];
			var judul = data_split[2];

			//alert (data);
			//animasi 
			$('#tr' + data_id).animate({
				backgroundColor: "#33AAFF"
			}, 1000);
			$('#tr' + data_id).animate({
				backgroundColor: "#F9F9F9"
			}, 10000);
			//end animasi

			//tampil idx di form
			$('.tampil_idx').html("<input type='hidden' value='" + data_id + "' name='idx' id='idx'><input type='hidden' value='" + judul + "' name='judul' id='judul'>");
			$('.tampil_data_ditemukan').hide();
			$('#kata_kunci_ubah').val('');
		});


		function cari_ubah_peneliti() {
			$('.tampil_data_ditemukan').hide();

			var kata_kunci_ubah = $('#kata_kunci_ubah').val();
			$.blockUI({
				message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mencari Data Peneliti " + kata_kunci_ubah + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
			});
			$.ajax({
				url: "module/penelitian_usulan_baru/get_data_ubah_peneliti.php",
				data: "kata_kunci=" + kata_kunci_ubah,
				type: 'post',
				cache: false,
				success: function(msg) {
					//unblock
					$.unblockUI();

					//karna di server pembatas setiap data adalah |
					//maka kita split dan akan membentuk array
					data = msg.split("|");
					if (data[0] == 'ditemukan') {
						$.ajax({
							type: 'post',
							url: 'module/penelitian_usulan_baru/frm_tampil_api_ubah_data_peneliti.php',
							data: 'act=ditemukan&nip_anggota=' + data[1] + '&nama_anggota=' + data[2] + '&keterangan_anggota=' + data[3] + '&sesi=non_session_anggota_peneliti',
							type: 'post',
							success: function(data) {
								$('.tampil_data_ditemukan').show();
								$('.tampil_data_ditemukan').html(data); //menampilkan data ke dalam modal
							},
							error: function(xhr, textStatus, error) {
								alert(xhr.status);
							}
						});
					} else if (data[0] == 'tidak_ditemukan') {
						alert('data tidak ditemukan');
					}

				},
				error: function(xhr, textStatus, error) {
					//unblock
					$.unblockUI();
					alert(xhr.status);

				}
			});
		}

		//jika yang diubah adalah session
		$('#ubah-nip-session-anggota-peneliti').on('show.bs.modal', function(e) {
			//get idx
			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var data_nip = data_split[3];
			//end get idx

			//animasi 
			$('#tr' + data_split[1]).animate({
				backgroundColor: "#33AAFF"
			}, 1000);
			$('#tr' + data_split[1]).animate({
				backgroundColor: "#F9F9F9"
			}, 10000);
			//end animasi

			//tampil idx di form
			$('.tampil_idx_session').html("<input type='hidden' value='" + data_split[1] + "' name='idx' id='idx'><input type='hidden' value='" + data_split[2] + "' name='judul' id='judul'>");


			var kata_kunci_ubah = data_nip;

			$.blockUI({
				message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mencari Data Peneliti " + kata_kunci_ubah + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
			});
			$.ajax({
				url: "module/penelitian_usulan_baru/get_data_ubah_peneliti.php",
				data: "kata_kunci=" + kata_kunci_ubah,
				type: 'post',
				cache: false,
				success: function(msg) {
					//unblock
					$.unblockUI();

					//karna di server pembatas setiap data adalah |
					//maka kita split dan akan membentuk array
					data = msg.split("|");
					if (data[0] == 'ditemukan') {
						$.ajax({
							type: 'post',
							url: 'module/penelitian_usulan_baru/frm_tampil_api_ubah_data_peneliti.php',
							data: 'act=ditemukan&nip_anggota=' + data[1] + '&nama_anggota=' + data[2] + '&keterangan_anggota=' + data[3] + '&sesi=session_anggota_peneliti',
							type: 'post',
							success: function(data) {
								$('.tampil_data_ditemukan_session').show();
								$('.tampil_data_ditemukan_session').html(data); //menampilkan data ke dalam modal
							},
							error: function(xhr, textStatus, error) {
								alert(xhr.status);
							}
						});
					} else if (data[0] == 'tidak_ditemukan') {
						alert('data tidak ditemukan');
					}

				},
				error: function(xhr, textStatus, error) {
					//unblock
					$.unblockUI();
					alert(xhr.status);
				}
			});
		});

		function proses_ubah_peneliti() {
			var idx = $('#idx').val();
			var nip_ubah = $('#nip_ubah').val();
			var nama_ubah = $('#nama_ubah').val();
			var status_peneliti = $('#status_peneliti').val();
			var keterangan_anggota_ubah = $('#keterangan_anggota_ubah').val();
			var judul = $('#judul').val();
			var sesi_anggota_peneliti = $('#sesi').val();
			var x = Number($('#banyak_data_peneliti').val()) + 1;

			if (status_peneliti == '0') {
				alert('Status Peneliti Belum Dipilih');
				return false;
			} else if (status_peneliti == 'Ketua') {
				for (i = 1; i < x; i++) {
					if ($('#status_peneliti_' + i).val() == 'Ketua') {
						$('#modal-dialog-ketua_hanya_satu').modal('show');
						return false;
					}
				}
			}



			$.ajax({
				type: 'post',
				url: "module/penelitian_usulan_baru/get_data_ubah_peneliti_proses.php",
				data: "idx=" + idx + "&nip_ubah=" + nip_ubah + "&nama_ubah=" + nama_ubah + "&status_peneliti=" + status_peneliti + "&keterangan_anggota_ubah=" + keterangan_anggota_ubah + "&judul=" + judul + "&sesi=" + sesi,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + data[1] + ' Berhasil Diubah',
							image: 'img/logo_unikom_kecil.jpg'
						});


						//ganti tr
						var element = '#tr' + idx;
						$(element + ' td:nth-child(2)').text(nip_ubah);
						$(element + ' td:nth-child(3)').text(nama_ubah);
						$(element + ' td:nth-child(4)').text(status_peneliti);
						$(element + ' td:nth-child(5)').text(keterangan_anggota_ubah);

						if (($('#status_peneliti').val() != "Ketua") && ($('#banyak_ketua_peneliti').val() == 1)) {
							$('#banyak_ketua_peneliti').val($('#banyak_ketua_peneliti').val() - 1);
						}

						//karena kita menggunakan 1 fungsi untuk update data maka buat percabangan, jika tidak maka salah satu tidak bisa ditutup
						if (sesi_anggota_peneliti == 'non_session_anggota_peneliti') {
							//tutup modal
							$("#ubah-anggota-peneliti").modal("hide");
							e.stopPropagation(); //This line would take care of it
							//end tutup modal
						} else {
							//tutup modal
							$("#ubah-nip-session-anggota-peneliti").modal("hide");
							e.stopPropagation(); //This line would take care of it
							//end tutup modal
						}
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});


		}
		//------------------------ end ubah peneliti ------------------------------------------

		function ubah_peneliti_dosen_luar() {
			var idx = $('#idx').val();
			var nip_ubah = $('#nip_ubah').val();
			var nama_ubah = $('#nama_ubah').val();
			var nama_prodi = $('#nama_prodi').val();
			var nama_universitas = $('#nama_universitas').val();
			var status_peneliti = $('#status_peneliti').val();
			var keterangan_anggota_ubah = $('#keterangan_peneliti').val();
			var x = Number($('#banyak_data_peneliti').val()) + 1;

			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_ubah_peneliti_dosen_luar_proses.php",
				data: "idx=" + idx + "&nip_ubah=" + nip_ubah + "&nama_ubah=" + nama_ubah + "&status_peneliti=" + status_peneliti + "&keterangan_anggota_ubah=" + keterangan_anggota_ubah + "&nama_prodi=" + nama_prodi + "&nama_universitas=" + nama_universitas,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + data[1] + ' Berhasil Diubah',
							image: 'img/logo_unikom_kecil.jpg'
						});

						if (keterangan_anggota_ubah == 'DosenLuar') {
							var keterangan = "Dosen Luar";
						}

						//ganti tr
						var element = '#tr' + idx;
						$(element + ' td:nth-child(2)').text(nip_ubah);
						$(element + ' td:nth-child(3)').text(nama_ubah);
						$(element + ' td:nth-child(4)').text(status_peneliti);
						$(element + ' td:nth-child(5)').html(keterangan + "<br>" + nama_prodi + "<br>" + nama_universitas);

						//animasi 
						$('#tr' + idx).animate({
							backgroundColor: "#33AAFF"
						}, 1000);
						$('#tr' + idx).animate({
							backgroundColor: "#F9F9F9"
						}, 10000);
						//end animasi

						//tutup modal
						$("#ubah-anggota-pengabdian-dosen-luar").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal

						if (($('#status_peneliti').val() != "Ketua") && ($('#banyak_ketua_peneliti').val() == 1)) {
							$('#banyak_ketua_peneliti').val($('#banyak_ketua_peneliti').val() - 1);
						}
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}


		//------------------------ Hapus Peneliti ------------------------------------------
		$('#hapus-modal-peneliti').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;


			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];
			var data_ket = data_split[3];

			$.ajax({
				type: 'post',
				url: 'module/penelitian_usulan_baru/get_data_hapus_peneliti.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + data_nama + '&ket=' + data_ket,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});
		});

		function hapus_penelitis() {
			id = $('#idx').val();
			judul = $('#judul').val();
			ket = $('#ket').val();


			$.ajax({
				type: 'post',
				url: "module/penelitian_usulan_baru/get_data_hapus_peneliti_proses.php",
				data: 'idx=' + id + '&judul=' + judul + '&ket=' + ket,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//remove tr
						$('#tr' + id).remove();

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});

						var banyak_data_peneliti = ($('#banyak_data_peneliti').val()) - 1;
						$('#banyak_data_peneliti').val(banyak_data_peneliti);





						if (data[3] == "Mahasiswa") {
							var jml_mhs = ($('#jml_mhs').val()) - 1;
							$('#jml_mhs').val(jml_mhs);
						}

						//tutup modal
						$("#hapus-modal-peneliti").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal


					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}


		//------------------------ End Hapus Peneliti ------------------------------------------




		//-- modul dosen luar -- validasi div -- get data peneliti -- frm_tampil_api
		$(document).ready(function() {
			$("#cari_peneliti_dosen_luar").click(function() {
				var kata_kunci_dosen_luar = $('#kata_kunci_dosen_luar').val();
				$.blockUI({
					message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Menunggu Data " + kata_kunci_dosen_luar + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
				});
				$.ajax({
					url: "module/penelitian_usulan_baru/get_data_peneliti_dosen_luar.php",
					data: "kata_kunci_dosen_luar=" + kata_kunci_dosen_luar,
					cache: false,
					success: function(msg) {
						//unblock
						$.unblockUI();

						//karna di server pembatas setiap data adalah |
						//maka kita split dan akan membentuk array
						data = msg.split("|");


						if (data[0] == 'ditemukan') {
							//Tampilkan Data
							$('#modal-dialog-peneliti-dosen-luar').modal('show');
						}

					},
					error: function(xhr, textStatus, error) {
						//unblock
						$.unblockUI();
						alert(xhr.status);

					}
				});
			});
		});


		$('#modal-dialog-peneliti-dosen-luar').on('show.bs.modal', function(e) {

			var $modal = $(this),
				//data nip peneliti
				kata_kunci = data[1];

			if (data[0] == 'ditemukan') {
				$.ajax({
					type: 'post',
					url: 'module/penelitian_usulan_baru/frm_tampil_api_data_peneliti_dosen_luar.php',
					data: 'act=ditemukan&kata_kunci=' + kata_kunci,
					success: function(data) {
						$('.fetched-data-dosen-luar').html(data); //menampilkan data ke dalam modal
					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);

					}
				});

			}
		});
		//-- end modul dosen luar -- validasi div -- get data peneliti -- frm_tampil_api


		//------------------------ HAPUS PENGAJUAN PROPOSAL ------------------------------------
		$('#hapus-pengajuan-proposal').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var judul = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/penelitian_usulan_baru/get_data_hapus_proposal.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + judul,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});

			//animasi 
			//$('#tr'+data_id).animate({backgroundColor: "#33AAFF" },1000);
			//$('#tr'+data_id).animate({backgroundColor: "#F9F9F9" },10000);
			//end animasi
		});


		function hapus_proposal() {
			id = $('#idx').val();
			judul = $('#judul').val();

			$.ajax({
				type: 'post',
				url: "module/penelitian_usulan_baru/get_data_hapus_proposal_proses.php",
				data: 'idx=' + id + '&judul=' + judul,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//remove tr
						$('#tr' + id).remove();

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});



						//tutup modal
						$("#hapus-pengajuan-proposal").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}

		//----------------------------END HAPUS PENGAJUAN PROPOSAL -----------------------------


		//----------------------- Cari Peneliti Dosen ------------------------------------------------------------------------------------------------------//



		//-- modul reviewer -- validasi div -- get data peneliti -- frm_tampil_api
		$(document).ready(function() {
			$("#btn_cari_reviewer").click(function() {
				var kata_kunci_reviewer = $('#kata_kunci_reviewer').val();
				$('.fetched-data').show();
				$.ajax({
					type: 'post',
					url: "module/reviewer/get_data_tambah_cari_reviewer.php",
					data: "idx=" + kata_kunci_reviewer,
					cache: false,
					success: function(msg) {
						data = msg.split("|");

						if (data[0] == "ditemukan") {
							$.ajax({
								type: 'post',
								url: "module/reviewer/frm_get_data_tambah_cari_reviewer.php",
								data: 'act=ditemukan&kata_kunci=' + kata_kunci_reviewer + '&data_2=' + data[2] + '&data_3=' + data[3],
								cache: false,
								success: function(data) {
									$('.fetched-data').html(data); //menampilkan data ke dalam modal
								},
								error: function(xhr, textStatus, error) {
									alert(xhr.status);
								}
							});
						} else {
							$.ajax({
								type: 'post',
								url: "module/reviewer/frm_get_data_tambah_cari_reviewer.php",
								data: 'act=tidak_ditemukan&kata_kunci=' + kata_kunci_reviewer + '&data_2=' + data[2] + '&data_3=' + data[3],
								cache: false,
								success: function(data) {
									$('.fetched-data').html(data); //menampilkan data ke dalam modal
								},
								error: function(xhr, textStatus, error) {
									alert(xhr.status);
								}
							});
						}


					},
					error: function(xhr, textStatus, error) {
						alert(xhr.status);
					}
				});

			});
		});

		//digunakan untuk menghide
		$('#tambah-reviewer-modal').on('show.bs.modal', function(e) {

			$('.fetched-data').hide();
		});


		$('#ubah-reviewer').on('show.bs.modal', function(e) {
			/*var $modal = $(this),
    data = e.relatedTarget.id;
    var data_split = data.split("|");
    var data_id=data_split[1];
    var judul=data_split[2];

    //alert (data);
    //animasi wkwkw
    $('#tr'+data_id).animate({backgroundColor: "#33AAFF" },1000);
		$('#tr'+data_id).animate({backgroundColor: "#F9F9F9" },10000);
		//end animasi

    //tampil idx di form
    $('.tampil_idx').html("<input type='hidden' value='"+data_id+"' name='idx' id='idx'><input type='hidden' value='"+judul+"' name='judul' id='judul'>");
    $('.tampil_data_ditemukan').hide();
    $('#kata_kunci_ubah').val('');*/
			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var data_id = data_split[1];
			var judul = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/reviewer/frm_get_data_ubah_reviewer.php',
				data: 'act=' + data_split[0] + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal

				}
			});


		});

		$('#pengajuan-koreksi-reviewer').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];

			$.ajax({
				type: 'post',
				url: 'module/pengajuan/frm_get_data_koreksi_reviewer.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});
		});


		$('#pengajuan-pemetaan-reviewer').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];

			$.ajax({
				type: 'post',
				url: 'module/pengajuan/get_data_pemetaan_reviewer.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});



		});



		//------------------------ ubah pengabdian ------------------------------------------
		//frm_langkah_tiga_anggota_pengabdian - view - validasi div - frm tampil ubah data pengabdian
		$('#ubah-anggota-pengabdian').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var data_id = data_split[1];
			var judul = data_split[2];

			//alert (judul);
			//animasi 
			$('#tr' + data_id).animate({
				backgroundColor: "#33AAFF"
			}, 1000);
			$('#tr' + data_id).animate({
				backgroundColor: "#F9F9F9"
			}, 10000);
			//end animasi

			//tampil idx di form
			$('.tampil_idx').html("<input type='hidden' value='" + data_id + "' name='idx' id='idx'><input type='hidden' value='" + judul + "' name='judul' id='judul'>");
			$('.tampil_data_ditemukan_abdi').hide();
			$('#kata_kunci_ubah').val('');
		});



		function cari_ubah_pengabdian() {

			$('.tampil_data_ditemukan_abdi').hide();

			var kata_kunci_ubah = $('#kata_kunci_ubah_abdi').val();
			$.blockUI({
				message: "<br><img src='img/logo_unikom_kecil.jpg'>&nbsp;&nbsp;<b>Mencari Data Peneliti " + kata_kunci_ubah + " ...&nbsp;&nbsp;<img src='img/logo_unikom_kecil.jpg'></b><center><br><img src='img/loadinganimation.gif'><br>."
			});
			$.ajax({
				url: "module/pengabdian_usulan_baru/get_data_ubah_peneliti.php",
				data: "kata_kunci=" + kata_kunci_ubah,
				type: 'post',
				cache: false,
				success: function(msg) {
					//unblock
					$.unblockUI();

					//karna di server pembatas setiap data adalah |
					//maka kita split dan akan membentuk array
					data = msg.split("|");
					if (data[0] == 'ditemukan') {
						$.ajax({
							type: 'post',
							url: 'module/pengabdian_usulan_baru/frm_tampil_api_ubah_data_peneliti.php',
							data: 'act=ditemukan&nip_anggota=' + data[1] + '&nama_anggota=' + data[2] + '&keterangan_anggota=' + data[3] + '&sesi=non_session_anggota_peneliti',
							type: 'post',
							success: function(data) {
								$('.tampil_data_ditemukan_abdi').show();
								$('.tampil_data_ditemukan_abdi').html(data); //menampilkan data ke dalam modal
							},
							error: function(xhr, textStatus, error) {
								alert(xhr.status);
							}
						});
					} else if (data[0] == 'tidak_ditemukan') {
						alert('data tidak ditemukan');
					}

				},
				error: function(xhr, textStatus, error) {
					//unblock
					$.unblockUI();
					alert(xhr.status);

				}
			});
		}







		function proses_ubah_pengabdian() {
			var idx = $('#idx').val();
			var nip_ubah = $('#nip_ubah').val();
			var nama_ubah = $('#nama_ubah').val();
			var status_peneliti = $('#status_peneliti').val();
			var keterangan_anggota_ubah = $('#keterangan_anggota_ubah').val();
			var judul = $('#judul').val();
			var sesi_anggota_peneliti = $('#sesi').val();
			var x = Number($('#banyak_data_peneliti').val()) + 1;

			if (status_peneliti == '0') {
				alert('Status Peneliti Belum Dipilih');
				return false;
			} else if (status_peneliti == 'Ketua') {
				for (i = 1; i < x; i++) {
					if ($('#status_peneliti_' + i).val() == 'Ketua') {
						$('#modal-dialog-ketua_hanya_satu').modal('show');
						return false;
					}
				}
			}

			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_ubah_peneliti_proses.php",
				data: "idx=" + idx + "&nip_ubah=" + nip_ubah + "&nama_ubah=" + nama_ubah + "&status_peneliti=" + status_peneliti + "&keterangan_anggota_ubah=" + keterangan_anggota_ubah + "&judul=" + judul + "&sesi=" + sesi,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + data[1] + ' Berhasil Diubah',
							image: 'img/logo_unikom_kecil.jpg'
						});


						//ganti tr
						var element = '#tr' + idx;
						$(element + ' td:nth-child(2)').text(nip_ubah);
						$(element + ' td:nth-child(3)').text(nama_ubah);
						$(element + ' td:nth-child(4)').text(status_peneliti);
						$(element + ' td:nth-child(5)').text(keterangan_anggota_ubah);

						/*if (($('#status_peneliti').val()!="Ketua")&&($('#banyak_ketua_peneliti').val()==1))
						{
							$('#banyak_ketua_peneliti').val($('#banyak_ketua_peneliti').val()-1);
						}*/

						//karena kita menggunakan 1 fungsi untuk update data maka buat percabangan, jika tidak maka salah satu tidak bisa ditutup
						if (sesi_anggota_peneliti == 'non_session_anggota_peneliti') {
							//tutup modal
							$("#ubah-anggota-pengabdian").modal("hide");
							e.stopPropagation(); //This line would take care of it
							//end tutup modal
						} else {
							//tutup modal
							$("#ubah-nip-session-anggota-pengabdian").modal("hide");
							e.stopPropagation(); //This line would take care of it
							//end tutup modal
						}
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}


		//------------------------ Hapus Peneliti ------------------------------------------
		$('#hapus-modal-pengabdian').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;


			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];
			var data_ket = data_split[3];

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/get_data_hapus_peneliti.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + data_nama + '&ket=' + data_ket,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});
		});

		function hapus_peneliti() {
			id = $('#idx').val();
			judul = $('#judul').val();
			ket = $('#ket').val();


			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_hapus_peneliti_proses.php",
				data: 'idx=' + id + '&judul=' + judul + '&ket=' + ket,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//remove tr
						$('#tr' + id).remove();

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});

						var banyak_data_peneliti = ($('#banyak_data_peneliti').val()) - 1;
						$('#banyak_data_peneliti').val(banyak_data_peneliti);


						if (data[3] == "Mahasiswa") {
							var jml_mhs = ($('#jml_mhs').val()) - 1;
							$('#jml_mhs').val(jml_mhs);
						}

						//tutup modal
						$("#hapus-modal-pengabdian").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal


					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}


		//------------------------ End Hapus Peneliti ------------------------------------------

		$('#pengajuan-pemetaan-reviewer_pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];

			$.ajax({
				type: 'post',
				url: 'module/pengajuan/get_data_pemetaan_reviewer_pengabdian.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});



		});


		//------------------------ HAPUS PENGAJUAN PROPOSAL PENGABDIAN------------------------------------
		$('#hapus-pengajuan-proposal_pengabdian').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var judul = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/get_data_hapus_proposal.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + judul,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});

			//animasi 
			//$('#tr'+data_id).animate({backgroundColor: "#33AAFF" },1000);
			//$('#tr'+data_id).animate({backgroundColor: "#F9F9F9" },10000);
			//end animasi
		});


		function hapus_proposal_pengabdian() {
			id = $('#idx').val();
			judul = $('#judul').val();

			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_hapus_proposal_proses.php",
				data: 'idx=' + id + '&judul=' + judul,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						//remove tr
						$('#tr' + id).remove();

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dihapus',
							image: 'img/logo_unikom_kecil.jpg'
						});



						//tutup modal
						$("#hapus-pengajuan-proposal_pengabdian").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}

		//----------------------------END HAPUS PENGAJUAN PROPOSAL -----------------------------





		/*----------------------------- batal pengajuan proposal -----------------------*/
		$('#batal-pengajuan-proposal_pengabdian').on('show.bs.modal', function(e) {

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var judul = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/get_data_batal_proposal.php',
				data: 'act=' + act + '&idx=' + data_id + '&judul=' + judul,
				success: function(data) {
					$('.fetched-batal-data').html(data); //menampilkan data ke dalam modal
				}
			});



			//animasi 
			//$('#tr'+data_id).animate({backgroundColor: "#33AAFF" },1000);
			//$('#tr'+data_id).animate({backgroundColor: "#F9F9F9" },10000);
			//end animasi
		});


		function batal_proposal_pengabdian() {
			id = $('#idx').val();
			judul = $('#judul').val();

			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_batal_proposal_proses.php",
				data: 'idx=' + id + '&judul=' + judul,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						$('.btl' + id).remove();
						$('.hps' + id).removeAttr("disabled");
						$('.hps' + id).attr("disabled", false);


						//remove tr
						//$('#tr'+id).remove();

						$.gritter.add({
							// heading of the notification
							title: 'Pesan',
							// the text inside the notification
							text: '<font size=3>Data ' + judul + ' Berhasil Dibatalkan',
							image: 'img/logo_unikom_kecil.jpg'
						});



						//tutup modal
						$("#batal-pengajuan-proposal_pengabdian").modal("hide");
						//end tutup modal
					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}



		//end batal pengajuan proposal pengabdian


		$('#validasi-pengajuan-penerimaan').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;


			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];

			$.ajax({
				type: 'post',
				url: 'module/dir_lppm/get_data_validasi_pengajuan.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data').html(data); //menampilkan data ke dalam modal
				}
			});



		});


		$('#validasi-pengajuan-penerimaan_pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;


			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];

			$.ajax({
				type: 'post',
				url: 'module/dir_lppm/get_data_validasi_pengajuan_pengabdian.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					$('.fetched-data-pengabdian').html(data); //menampilkan data ke dalam modal
				}
			});



		});



		$('#pengajuan_koreksi').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/pengajuan/get_data_koreksi_reviewer.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					//loading hide
					$("#waiting_sub").hide(1000);
					//hati2 di fetch
					$('.fetched-data-pengajuan-koreksi').html(data); //menampilkan data ke dalam modal
				}
			});



		});



		$('#pengajuan_koreksi_pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_nama = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/pengajuan/get_data_koreksi_pengabdian_reviewer.php',
				data: 'act=' + act + '&data_id=' + data_id,
				success: function(data) {
					//hati2 di fetch
					$('.fetched-data-pengajuan-pengabdian-koreksi').html(data); //menampilkan data ke dalam modal
				}
			});



		});

		$('#kemajuan_koreksi_pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;



			var data_split = data.split("|");
			var act = data_split[0];
			var data_id = data_split[1];
			var data_akses = data_split[2];

			$.ajax({
				type: 'post',
				url: 'module/kemajuan_pengabdian/get_data_kemajuan_koreksi_pengabdian_reviewer.php',
				data: 'act=' + act + '&data_id=' + data_id + '&akses=' + data_akses,
				success: function(data) {
					//hati2 di fetch
					$('.fetched-data-kemajuan_koreksi_pengabdian').html(data); //menampilkan data ke dalam modal
				}
			});



		});


		$('#ajukan_proposal').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;

			var data_split = data.split("|");
			var idx = data_split[0];

			$.ajax({
				type: 'post',
				url: 'module/penelitian_usulan_baru/get_data_pengajuan_proposal.php',
				data: 'idx=' + idx,
				success: function(data) {
					//hati2 di fetch
					$('.fetched-data-pengajuan-proposal').html(data); //menampilkan data ke dalam modal
				}
			});
		});



		function ajukan_usulan_penelitian() {
			idx = $('#idx').val();
			$.ajax({
				type: 'post',
				url: "module/penelitian_usulan_baru/get_data_pengajuan_proposal_proses.php",
				data: "idx=" + idx,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						window.location.href = window.location.href + "&status=sukses";
					} else {
						alert(data[1]);
						return false;
					}
				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}




		$("#skema_pilih").change(function(event) {
			//alert($(this).val());
			document.location = "view.php?menu=direktur_lppm&act=rubik_penilaian&skema=" + $(this).val();
		});






		function validasi_pengajuan_koreksi() {

			var catatan = $('#komentar').val();


			if ($('#komentar').val() == "") {
				alert('Wajib Mengisi Komentar Reviewer');
				$('#komentar').css({
					backgroundColor: "#DCDCDC"
				}, 1000);
				$('#komentar').focus();
				return false;
			} else if ($('#komentar').val().length <= 100) {
				alert('Minimal Jumlah Komentar adalah 100 karakter');
				$('#komentar').css({
					backgroundColor: "#DCDCDC"
				}, 1000);
				$('#komentar').focus();
				return false;
			}

		}



		function hapus() {
			id = $('#idx').val();
			judul = $('#judul').val();


			$.ajax({
				type: 'post',
				url: "get_data_hapus_proses.php",
				data: "idx=" + id + "&judul=" + judul,
				cache: false,
				success: function(msg) {
					data = msg.split("|");



					if (data[0] == "sukses") {
						alert("Sukses Menghapus Data " + judul);

						//remove tr
						$('#tr' + id).remove();

						//tutup modal
						$("#hapus-modal").modal("hide");
						e.stopPropagation(); //This line would take care of it
						//end tutup modal


					} else {
						alert(data[1]);
						return false;
					}


				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});

		}



		$(document).ready(function() {
			$(document).tooltip();
		});


		$('#file_dokumen').on('change', function() {
			var fileInput = document.getElementById('file_dokumen');
			var filePath = fileInput.value;
			// Allowing file type
			var allowedExtensions =
				///(\.jpg|\.jpeg|\.png|\.gif)$/i;
				/(\.pdf)$/i;

			if (!allowedExtensions.exec(filePath)) {
				alert('Tipe File Tidak Diijinkan');
				fileInput.value = '';
				return false;
			} else {
				const size =
					(this.files[0].size / 1024 / 1024).toFixed(2);
				if (size > 5 || size < 0) {
					$('#modal-dialog-error-file').modal('show');
					fileInput.value = '';
					return false;
				} else {
					$("#output").html('<b>' +
						'This file size is: ' + size + " MB" + '</b>');
				}
			}
		});

		$('#file_dokumen_lembar_pengesahan').on('change', function() {
			var fileInput = document.getElementById('file_dokumen_lembar_pengesahan');
			var filePath = fileInput.value;
			// Allowing file type
			var allowedExtensions =
				///(\.jpg|\.jpeg|\.png|\.gif)$/i;
				/(\.pdf)$/i;

			if (!allowedExtensions.exec(filePath)) {
				alert('Tipe File Tidak Diijinkan');
				fileInput.value = '';
				return false;
			} else {
				const size =
					(this.files[0].size / 1024 / 1024).toFixed(2);
				if (size > 5 || size < 0) {
					$('#modal-dialog-error-file').modal('show');
					fileInput.value = '';
					return false;
				} else {
					$("#output").html('<b>' +
						'This file size is: ' + size + " MB" + '</b>');
				}
			}
		});



		$('#ajukan_proposal_pengabdian').on('show.bs.modal', function(e) {
			//jika status ditolak

			var $modal = $(this),
				data = e.relatedTarget.id;
			var data_split = data.split("|");
			var idx = data_split[0];

			$.ajax({
				type: 'post',
				url: 'module/pengabdian_usulan_baru/get_data_pengajuan_proposal.php',
				data: 'idx=' + idx,
				success: function(data) {
					//hati2 di fetch
					$('.fetched-data-pengajuan-proposal').html(data); //menampilkan data ke dalam modal
				}
			});
		});



		function ajukan_usulan_pengabdian() {
			idx = $('#idx').val();
			$.ajax({
				type: 'post',
				url: "module/pengabdian_usulan_baru/get_data_pengajuan_proposal_proses.php",
				data: "idx=" + idx,
				cache: false,
				success: function(msg) {
					data = msg.split("|");

					if (data[0] == "sukses") {
						window.location.href = window.location.href + "&status=sukses";
					} else {
						alert(data[1]);
						return false;
					}
				},
				error: function(xhr, textStatus, error) {
					alert(xhr.status);
				}
			});
		}



		//----------------------------End-------------------------------------//














		//tampil nama ketika upload dokumen
		$('#file_dokumen').change(function(e) {
			var fileName = e.target.files[0].name;
			$('#nama_upload_file').html(fileName);
			//alert('The file "' + fileName +  '" has been selected.');
		});

		$('#file_dokumen_lembar_pengesahan').change(function(e) {
			var fileName = e.target.files[0].name;
			$('#nama_upload_file_lp').html(fileName);
			//alert('The file "' + fileName +  '" has been selected.');
		});

		$('#file_dokumen_mitra_abdi').change(function(e) {
			var fileName = e.target.files[0].name;
			$('#nama_upload_file_mitra_abdi').html(fileName);
			//alert('The file "' + fileName +  '" has been selected.');
		});





		//validasi
		function validasi_frm_identitas_usulan() {
			if ($('#judul').val() == "") {
				$('#modal-dialog-judul-kosong').modal('show');
				return false;
			} else if ($('#deskripsi').val() == "") {
				$('#modal-dialog-deskripsi-kosong').modal('show');
				return false;
			} else if ($('#rumpun_ilmu').val() == "") {
				$('#modal-dialog-rumpunilmu-kosong').modal('show');
				return false;
			} else if ($('#kategori_bidang_pilih').val() == "") {
				$('#modal-dialog-kategori_bidang_pilih-kosong').modal('show');
				return false;
			} else if ($('#kategori_bidang_sudah_dipilih').val() == "") {
				$('#modal-dialog-kategori_bidang_sudah_dipilih-kosong').modal('show');
				return false;
			} else if ($('#skema').val() == "") {
				$('#modal-dialog-skema-kosong').modal('show');
				return false;
			} else if ($('#nama_kelompok_keilmuan').val() == "") {
				$('#modal-dialog-kk-kosong').modal('show');
				return false;
			} else if (($('#skema').val() == "penelitian terapan") && ($('#mitra').val() == "")) {
				$('#modal-dialog-skema-terapan-mitra-kosong').modal('show');
				return false;
			}
		}





		function validasi_frm_identitas_usulan_pengabdian() {
			var tanggal_awal = $('#datepickers').val();
			var tanggal_akhir = $('#datepickers2').val();

			var date1 = tanggal_awal.split("-").reverse().join("-");
			var date2 = tanggal_akhir.split("-").reverse().join("-");

			var date1Updated = new Date(date1.replace(/-/g, '/'));
			var date2Updated = new Date(date2.replace(/-/g, '/'));

			if (date1Updated > date2Updated) {
				$('#modal-dialog-tanggal-besar').modal('show');
				return false;
			} else if ($('#judul').val() == "") {
				$('#modal-dialog-judul-kosong').modal('show');
				return false;
			} else if ($('#deskripsi').val() == "") {
				$('#modal-dialog-deskripsi-kosong').modal('show');
				return false;
			} else if ($('#rumpun_ilmu').val() == "") {
				$('#modal-dialog-rumpunilmu-kosong').modal('show');
				return false;
			} else if ($('#kategori_bidang_pilih_abdi').val() == "") {
				$('#modal-dialog-kategori_bidang_pilih-kosong').modal('show');
				return false;
			} else if ($('#kategori_bidang_sudah_dipilih').val() == "") {
				$('#modal-dialog-kategori_bidang_sudah_dipilih-kosong').modal('show');
				return false;
			} else if ($('#skema').val() == "") {
				$('#modal-dialog-skema-terapan-skema-kosong-pengabdian').modal('show');
				return false;
			} else if ($('#sumber_dana').val() == "") {
				$('#modal-dialog-sumber-dana-kosong-pengabdian').modal('show');
				return false;
			} else if ($('#mitra').val() == "") {
				$('#modal-dialog-skema-terapan-mitra-kosong-pengabdian').modal('show');
				return false;
			} else if ($('#tipel').val() == "") {
				$('#modal-dialog-tipel-pengabdian').modal('show');
				return false;
			} else if ($('#tempel').val() == "") {
				$('#modal-dialog-tempel-pengabdian').modal('show');
				return false;
			} else if ($('#luaran').val() == "") {
				$('#modal-dialog-luaran-pengabdian').modal('show');
				return false;
			} else if ($('#datepickers').val() == "") {
				$('#modal-dialog-tanggal-pelaksanaan').modal('show');
				return false;
			} else if ($('#datepickers').val() == "--") {
				$('#modal-dialog-tanggal-pelaksanaan').modal('show');
				return false;
			} else if ($('#datepickers2').val() == "") {
				$('#modal-dialog-tanggal-pelaksanaan').modal('show');
				return false;
			} else if ($('#datepickers2').val() == "--") {
				$('#modal-dialog-tanggal-pelaksanaan').modal('show');
				return false;
			} else if ($('#nama_mitra').val() == "") {
				$('#modal-dialog-nama_mitra-pengabdian').modal('show');
				return false;
			} else if ($('#alamat_mitra').val() == "") {
				$('#modal-dialog-alamat_mitra-pengabdian').modal('show');
				return false;
			} else if ($('#penanggung_jawab').val() == "") {
				$('#modal-dialog-penanggung_jawab-pengabdian').modal('show');
				return false;
			} else if ($('#id_ref_sumber_dana').val() == "") {
				$('#modal-dialog-id_ref_sumber_dana-pengabdian').modal('show');
				return false;
			}
		}


		function validasi_frm_anggota_peneliti() {
			/*if ($('#status_peneliti_session').val()=="0")
			{

				$('#modal-dialog-anggota_peneliti_1_kosong').modal('show');
				$('#tdstatuspeneliti').addClass("danger");
				$('#status_peneliti_session').focus();
				return false;	
			}*/
			if ($('#banyak_data_peneliti').val() == "1") {
				if ($('#status_peneliti_session').val() == "0") {

					$('#modal-dialog-anggota_peneliti_1_kosong').modal('show');
					$('#tdstatuspeneliti').addClass("danger");
					$('#status_peneliti_session').focus();
					return false;
				} else if ($('#status_peneliti_session').val() == "Anggota") {
					alert('Wajib Memiliki Ketua');
					return false;
				}
				/*else if ((($('#skema').val()=="penelitian terapan"))&&(($('#banyak_data_peneliti').val()=="1")))
				{
					$('#modal-dialog-anggota_peneliti_terapan_satu_anggota').modal('show');
					return false;
				}*/
			}
			//cek jika banyak data peneliti > 1
			else if ($('#banyak_data_peneliti').val() > 1) {

				if ($('#status_peneliti_session').val() == "0") {

					$('#modal-dialog-anggota_peneliti_1_kosong').modal('show');
					$('#tdstatuspeneliti').addClass("danger");
					$('#status_peneliti_session').focus();
					return false;
				} else if ($('#banyak_ketua_peneliti').val() == "0") {
					$('#modal-dialog-ketua_wajib_satu').modal('show');
					return false;
				}
				/*else if ((($('#skema').val()=="penelitian dasar"))&&(($('#banyak_data_peneliti').val()>2)))
				{
					$('#modal-dialog-anggota_peneliti_dasar_dua').modal('show');
					return false;
				}*/
				/*else if ((($('#skema').val()=="penelitian terapan"))&&(($('#banyak_data_peneliti').val()>3)))
				{
					alert ("skema penelitian terapan tidak diperbolehkan data lebih dari 3");
					return false;
				}*/
				else if ((($('#skema').val() == "penelitian dasar")) && (($('#jml_mhs').val() == 0))) {
					$('#modal-dialog-anggota_peneliti_dasar_wajib_mahasiswa').modal('show');
					return false;
				} else if ((($('#skema').val() == "penelitian terapan")) && (($('#jml_mhs').val() == 0))) {
					$('#modal-dialog-anggota_peneliti_terapan_wajib_mahasiswa').modal('show');
					return false;
				}
			}
		}

		function validasi_frm_anggota_pengabdian() {
			if ($('#status_peneliti_session').val() == "0") {

				$('#modal-dialog-anggota_peneliti_1_kosong').modal('show');
				$('#tdstatuspeneliti').addClass("danger");
				$('#status_peneliti_session').focus();
				return false;
			} else if ($('#banyak_ketua_peneliti').val() == "0") {
				$('#modal-dialog-ketua_wajib_satu').modal('show');
				return false;
			} else if ($('#skema').val() == 'pkm') {
				if ($('#jml_mhs').val() == '0') {
					$('#modal-dialog-anggota_mahasiswa_kosong').modal('show');
					return false;
				} else if ($('#jml_mhs').val() > 3) {
					$('#modal-dialog-anggota_mahasiswa_lebih_dari_3').modal('show');
					return false;
				}

			} else if (($('#skema').val() == 'ppk') || ($('#skema').val() == 'ppdm') || ($('#skema').val() == 'ppim')) {

				if ($('#jml_mhs').val() == '0') {
					$('#modal-dialog-anggota_mahasiswa_kosong').modal('show');
					return false;
				} else if ($('#jml_mhs').val() > 3) {
					$('#modal-dialog-anggota_mahasiswa_lebih_dari_3').modal('show');
					return false;
				} else if ($('#jml_dosen').val() <= '1') {
					$('#modal-dialog-dosen-wajib-lebih-dari-satu').modal('show');
					return false;
				}
			}

		}


		function validasi_frm_dokumen_proposal() {
			// if (isset($_GET['idx'])) {
			// 	$idx = my_simple_crypt($_GET['idx'], 'd');
			// 	$sql = mysqli_query($server1, "select * from pengajuan_penelitian where idx_penelitian=".$idx);
			// 	$sql2 = mysqli_query($server1, "select * from bukti_verif where idx_pengajuan_penelitian=".$idx);
			// 	$r = mysqli_fetch_array($sql);
			// 	$bv = mysqli_fetch_array($sql2);
			// }
			if ($('#file_dokumen').val() == "") {


				$('#modal-dialog-file-kosong').modal('show');
				//$('#tdstatuspeneliti').addClass("danger");
				$('#file_dokumen').focus();
				$('#t_dokumen_file').animate({
					backgroundColor: "#33AAFF"
				}, 1000);
				$('#t_dokumen_file').animate({
					backgroundColor: "#FFFFFF"
				}, 10000);
				return false;
			}
			// else if ($r['dokumen_lembar_pengesahan'] != '' && $bv['file_verif'] != '') {
			// 	$('#modal-dialog-file-lp-kosong').modal('show');
			// 	//$('#tdstatuspeneliti').addClass("danger");
			// 	$('#file_dokumen_lembar_pengesahan').focus();
			// 	$('#t_dokumen_file_lp').animate({
			// 		backgroundColor: "#FF0000"
			// 	}, 1000);
			// 	$('#t_dokumen_file_lp').animate({
			// 		backgroundColor: "#FFFFFF"
			// 	}, 10000);
			// 	return false;
			// } 
			else if ($('#file_dokumen_mitra_abdi').val() == "") {
				$('#modal-dialog-file-mitra-abdi-kosong').modal('show');
				//$('#tdstatuspeneliti').addClass("danger");
				$('#file_dokumen_mitra_abdi').focus();
				$('#t_dokumen_file_mitra_abdi').animate({
					backgroundColor: "#33AAFF"
				}, 1000);
				$('#t_dokumen_file_mitra_abdi').animate({
					backgroundColor: "#FFFFFF"
				}, 10000);
				return false;
			}
		}


		function validasi_frm_dokumen_proposal_kemajuan() {
			if ($('#file_dokumen').val() == "") {


				$('#modal-dialog-file-kosong').modal('show');
				//$('#tdstatuspeneliti').addClass("danger");
				$('#file_dokumen').focus();
				$('#t_dokumen_file').animate({
					backgroundColor: "#33AAFF"
				}, 1000);
				$('#t_dokumen_file').animate({
					backgroundColor: "#FFFFFF"
				}, 10000);
				return false;
			}
		}

		/*function validasi_frm_ajukan_usulan()
		{
			$('#modal-dialog-ajukan-proposal').modal('show');
			var yes = $('#confirm').attr("value");
			if (yes == 'yes') 
			{
		        alert ('yes');
				return false; 
		    } 
		    else 
		    {
		    	alert ('no');
		        return false;
		    } 
		}*/







		for (i = 1; i < 3; i++) {
			$("#status_peneliti_" + i).change(function() {
				alert($(this).find('option:selected').val());
			});
		}
	</script>

<?php
}
?>