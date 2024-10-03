<form action="" method="get"  data-parsley-validate="true" name="demo-form">
			<!-- begin row -->
			<div class="row">
			    <!-- begin col-6 -->
			    <div class="col-md-2">
			        <!-- begin panel -->
                     <div class="panel panel-inverse" data-sortable-id="ui-widget-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h5 class="panel-title">Pencarian</h5>
                        </div>
						
                       <div class="panel-body">
                            <div data-scrollbar="true" data-height="100px">
								

								<?php
									/*$sql=mysql_query("SELECT 
														 `lokasi_kabupaten_kota`.`id_kab_kot`,
														 `lokasi_kabupaten_kota`.`nama_kab_kot`
														FROM 
														wirausahawan
														INNER JOIN
														`lokasi_kabupaten_kota`
														ON `wirausahawan`.`id_kab_kot_2` = `lokasi_kabupaten_kota`.`id_kab_kot`
														GROUP BY `lokasi_kabupaten_kota`.`id_kab_kot`
														ORDER BY `lokasi_kabupaten_kota`.`nama_kab_kot` ASC");
									$no=1;
									while($r=mysql_fetch_array($sql))
									{
										?>
											<div class="checkbox">
											  <label>
											  <?php 
											  	echo "<input type='checkbox' 
												      id='mincheck' name='pilihan[]' data-parsley-mincheck='1' value='$r[id_kab_kot]' required >";
													  echo "$r[nama_kab_kot]";
											  ?>
											   </label>
											</div>
										<?php
										$no++;
									}*/
								?>
								<!-- untuk yang belum mengisi data-->
								<div class="checkbox">
								<label>
								<input type='checkbox' 
												      id='mincheck' name='pilihan[]' data-parsley-mincheck='1' value='peserta belum mengisi' required >Peserta Belum Mengisi Data
								</label>
								</div>
								<!-- end untuk belum mengisi data-->
							</div>
							</div>
                    </div>
					
					  <div class="panel panel-inverse" data-sortable-id="ui-widget-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            </div>
                            <h4 class="panel-title">Tahun</h4>
                        </div>
                         <div class="panel-body">
                           <?php
						 	/*echo "<select name='tahun' class='form-control' id='select-required' data-parsley-required='true'>";
								$tampil=mysql_query("SELECT * FROM `wirausahawan`
														GROUP BY `tahun_angkatan`
														ORDER BY `tahun_angkatan` ASC");
								echo "<option value='' selected>- Pilih Tahun -</option>";
								
								while($w=mysql_fetch_array($tampil))
								{
									echo "<option value=$w[tahun_angkatan]>$w[tahun_angkatan]</option>";        
								}
								 echo "</select>";*/
								?>
                        </div>
                    </div>
                    <!-- end panel -->
					
					<input type="submit" name="submit" Value="Cari Wilayah" class="btn btn-primary  btn-block"/>	
					</form>
					
					
					
                    <!-- end panel -->
			    </div>
			    <!-- end col-6 -->
				
				
			    <!-- begin col-6 -->
			    <div class="col-md-10">
			        <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-widget-14">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Grafik Peserta W.U.B Perkabupaten Kota</h4>
                        </div>
                        <div class="panel-body">
                           <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


		<?php
		if(isset($_GET['submit']))
		{
				
				 $pilihan=$_GET['pilihan'];
 
				 foreach($pilihan as $key=>$value)
				 {
				 	$query[] = "id_kab_kot_2="."'".$value."'"; // store in array
				 	

				 	  $isi = "SELECT
									  *
									FROM 
									  v_jmlh_peserta_kab_kot_detail
									WHERE (" . implode(' OR ', $query).")
									and tahun_angkatan='$_GET[tahun]'
									GROUP BY `id_kab_kot_2`";

				 }
				 //echo "$isi";
				$sql_grafik=mysql_query($isi);
				$sql_table=mysql_query($isi);
		}
		else
		{
			
			
			$sql_grafik=mysqli_query($server1,"SELECT
										*,COUNT(*) AS jumlah
										FROM
										proposal_tahap_final a
										INNER JOIN
										ref_tema b
										ON a.`TEMA` = b.`kd_tema`
										GROUP BY kd_tema");
			
			$sql_table=mysqli_query($server1,"SELECT
										*,COUNT(*) AS jumlah
										FROM
										proposal_tahap_final a
										INNER JOIN
										ref_tema b
										ON a.`TEMA` = b.`kd_tema`
										GROUP BY kd_tema");
		}
		$jumlah_isi_info_anggaran=mysqli_num_rows($sql_table);
		echo "<input type='hidden' id='jumlah_isi_info_anggaran' value='$jumlah_isi_info_anggaran'/>";
		?>
		<!--<table id="datatable" class="table table-bordered">-->
		<!-- HIDE TABLE UNTUK GRAFIK HIGHCHART-->
		<table id="datatable" style="display: none">
			<thead>
				<tr>
					<th>Nama Kabupaten Kota</th>
					<th>Peserta WUB</th>
					
				</tr>
			</thead>
			<tbody>
			   <?php
			   		
			   		while($r = mysqli_fetch_array($sql_grafik))
					{	
							?>
						<tr>
							<th>aaa</th>
							<td>2</td>
						</tr>
						<?php
					}
			   ?>
			</tbody>
		</table>
		<!-- END HIDE -->
		
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Nama Kabupaten Kota</th>
					<th>Banyak Peserta</th>
				</tr>
			</thead>
			<tbody>
			   <?php
			   		$i=1;
			   		while($w = mysqli_fetch_array($sql_table))
					{
							?>
						<tr>
							<th>aa</th>
							<th>2</th>
							<th><?php //echo "<a class='btn btn-danger' btn-block href='?popup=1&idx=$w[id_kecamatan]&thn=$w[tahun_pelaksaana]&jum=$w[jumlah_anggaran_kecamatan]&kec=$w[nama_kecamatan]' id=iframe_pop_up_anggaran$i>Detail</a>"; ?>
							</th>
							
						</tr>
						<?php
						$i++;
					}
			   ?>
			</tbody>
		</table>
		
		<?php 
			

			if (isset($_GET['tahun']))
			{
				$tahun=$_GET[tahun];	
			}
			else
			{
				$tahun=date('Y');
			}
		?>
		
		<script type="text/javascript">
		
		
		
		
		Highcharts.chart('container', {
			data: {
				table: 'datatable'
			},
			chart: {
				type: 'column'
			},
			title: {
				text: 'Grafik Peserta W.U.B Kabupaten Kota Tahun <?php echo $tahun;?>'
			},
			yAxis: {
				allowDecimals: false,
				title: {
					text: 'Peserta W.U.B'
				}
			},
			credits: {
				  enabled: false
			  },
			<!--Untuk warna yang berbeda-beda-->
			plotOptions: {
				series: {
					colorByPoint: true
				}
			},
			tooltip: {
				formatter: function () {
					return '<b>' + this.series.name + '</b><br/>' +
						this.point.y + ' ' + this.point.name.toLowerCase();
										}
			}
		});
				</script>
						   
						 
                        </div>
                    </div>
                    <!-- end panel -->
			        
			    </div>
			    <!-- end col-6 -->
			</div>
			<!-- end row -->
			
			   

