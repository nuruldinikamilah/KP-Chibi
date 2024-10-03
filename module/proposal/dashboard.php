
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			       

			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-12">
			        <!-- begin panel -->
                     <div class="panel panel-inverse" data-sortable-id="ui-widget-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h5 class="panel-title">MONITORING PROPOSAL TAHUN <?php echo  $_SESSION['tahun_aktif'];?> SEMESTER <?php echo $_SESSION['semester_aktif'];?></h5>
                        </div>
						
                       <div class="panel-body">
                            <div data-scrollbar="true" data-height="350px">
<?php
$sql_a_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='A' AND `status`='diterima' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS` ");
$jumlah_a_diterima=mysqli_fetch_array($sql_a_diterima);


$sql_a_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='A' AND `status`='ditolak' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS` ");
$jumlah_a_ditolak=mysqli_fetch_array($sql_a_ditolak);

$sql_b_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='B' AND `status`='diterima' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_b_diterima=mysqli_fetch_array($sql_b_diterima);

$sql_b_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='B' AND `status`='ditolak' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_b_ditolak=mysqli_fetch_array($sql_b_ditolak);

$sql_c_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='C' AND `status`='diterima' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_c_diterima=mysqli_fetch_array($sql_c_diterima);

$sql_c_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='C' AND `status`='ditolak' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_c_ditolak=mysqli_fetch_array($sql_c_ditolak);

$sql_d_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='D' AND `status`='diterima' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_d_diterima=mysqli_fetch_array($sql_d_diterima);

$sql_d_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='D' AND `status`='ditolak' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_d_ditolak=mysqli_fetch_array($sql_d_ditolak);

$sql_e_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='E' AND `status`='diterima' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_e_diterima=mysqli_fetch_array($sql_e_diterima);

$sql_e_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."' AND `KELOMPOKKEILMUAN`='E' AND `status`='ditolak' 
										GROUP BY `KELOMPOKKEILMUAN`, `TAHUN`, `SMT`, `STATUS`");
$jumlah_e_ditolak=mysqli_fetch_array($sql_e_ditolak);

								 $tahun=my_simple_crypt($_SESSION['tahun_aktif'], 'e' ); 
								 $s=my_simple_crypt($_SESSION['semester_aktif'], 'e' );


$sql_total_diterima=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."'  AND `status`='diterima'
										GROUP BY  `TAHUN`, `SMT`, `STATUS`");
$jumlah_total_diterima=mysqli_fetch_array($sql_total_diterima);

$sql_total_ditolak=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."'  AND `status`='ditolak' 
										GROUP BY  `TAHUN`, `SMT`, `STATUS`");
$jumlah_total_ditolak=mysqli_fetch_array($sql_total_ditolak);

								 $tahun=my_simple_crypt($_SESSION['tahun_aktif'], 'e' ); 
								 $s=my_simple_crypt($_SESSION['semester_aktif'], 'e' );




$sql_total_diterima_perpanjangan=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."'  AND `status`='diterima' and jenis='p' 
										GROUP BY  `TAHUN`, `SMT`, `STATUS`");
$jumlah_total_diterima_perpanjangan=mysqli_fetch_array($sql_total_diterima_perpanjangan);

$sql_total_diterima_baru=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."'  AND `status`='diterima' and jenis='b' 
										GROUP BY  `TAHUN`, `SMT`, `STATUS`");
$jumlah_total_diterima_baru=mysqli_fetch_array($sql_total_diterima_baru);

$sql_total_diterima_khusus=mysqli_query($server1,"SELECT
										tahun, smt, `status`, `KELOMPOKKEILMUAN`, COUNT(STATUS) AS jumlah
										FROM
										`proposal_tahap_final`
										WHERE tahun=".$_SESSION['tahun_aktif']." AND smt='".$_SESSION['semester_aktif']."'  AND `status`='diterima' and jenis='k' 
										GROUP BY  `TAHUN`, `SMT`, `STATUS`");
$jumlah_total_diterima_khusus=mysqli_fetch_array($sql_total_diterima_khusus);



?>
<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>KEILMUAN A</h4><br>
							Diterima : <?php echo "\t".$jumlah_a_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_a_ditolak['jumlah'];?> Mahasiswa 
						</div>
						<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=A&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-blue">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>KEILMUAN B</h4><br>
							Diterima : <?php echo "\t".$jumlah_b_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_b_ditolak['jumlah'];?> Mahasiswa 
						</div>
						<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=B&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>KEILMUAN C</h4><br>
							Diterima : <?php echo "\t".$jumlah_c_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_c_ditolak['jumlah'];?> Mahasiswa 
						</div>
							<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=C&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>KEILMUAN D</h4><br>
							Diterima : <?php echo "\t".$jumlah_d_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_d_ditolak['jumlah'];?> Mahasiswa 
						</div>
							<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=D&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-black">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>KEILMUAN E</h4><br>
							Diterima : <?php echo "\t".$jumlah_e_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_e_ditolak['jumlah'];?> Mahasiswa 
						</div>
							<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=E&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->

				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<?php
								$total_pendaftar=$jumlah_total_diterima['jumlah']+$jumlah_total_ditolak['jumlah'];
							?>
							<h4>Total : <?php echo  $total_pendaftar;?>  Mahasiswa</h4><br>
							Diterima : <?php echo "\t".$jumlah_total_diterima['jumlah'];?> Mahasiswa<br> Ditolak : <?php echo "\t".$jumlah_total_ditolak['jumlah'];?> Mahasiswa 
						</div>
							<div class="stats-link">

							<a href="./module/proposal/download_pengajuan_final.php?download_kk=all&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->

				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-4">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							
							<h4>Detail Proposal Diterima</h4><br>
							Perpanjangan : <?php echo "\t".$jumlah_total_diterima_perpanjangan['jumlah']?> Baru : <?php echo "\t".$jumlah_total_diterima_baru['jumlah'];?> Mahasiswa <br>Khusus : <?php echo "\t".$jumlah_total_diterima_khusus['jumlah'];?> Mahasiswa 
						</div>
							<div class="stats-link">
							<a href="./module/proposal/download_pengajuan_final.php?download_kk=all&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File <i class="fa fa-arrow-circle-o-right"></i></a>
						</div>
					</div>
				</div>
				<!-- end col-3 -->



	</div>
</div>
</div>