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
                            <h4 class="panel-title">Form Identitas Usulan Tahun <?php echo date("Y");?></h4>
                        </div>
                        

                         <form action="module/penelitian_usulan_baru/frm_langkah_satu_identitas_usulan_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_identitas_usulan();">

                       
                        
					   <div class="table-responsive">
					   	<?php
							$langkah_satu_proses=my_simple_crypt('insert', 'e' );

							//Jika Pernah Mengisi
							if (isset($_GET['idx']))
							{
								$idx=my_simple_crypt($_GET['idx'], 'd' );
						        $sql=mysqli_query($server1,"select * from pengajuan_penelitian where idx_penelitian=".$idx);
						        $r=mysqli_fetch_array($sql);
						        $langkah_satu_proses=my_simple_crypt('update', 'e' );
						        echo "<input type='hidden' name='idx' value='".$_GET['idx']."'>";

						        	//cek jika sudah divalidasi
									if ((isset($r['validasi_proposal_pengguna']))||(isset($r['nilai_keseluruhan_proposal'])))
									{
										$var_disabled="disabled";
									}
									else
									{
										$var_disabled="";
									}
							} 
							else 
							{
								$langkah_satu_proses=my_simple_crypt('insert', 'e' );
							}



						?>
                        <input type='hidden' name='langkah_satu_proses' value='<?php echo $langkah_satu_proses;?>'>
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                 <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Judul Penelitian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="50" rows="3" name="judul" id="judul"><?php if (isset($_GET['idx']))echo $r['judul_penelitian'];?></textarea></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Deskripsi Penelitian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="80" rows="5" name="deskripsi" id="deskripsi"><?php if (isset($_GET['idx']))echo $r['dekripsi_penelitian'];?></textarea></th>
							      </tr>
							     <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Rumpun Ilmu</b></label>
							         </td>
							           <td class="text-left">
		                                   <select  id='rumpun_ilmu'  class="form-control input-sm" name="rumpun_ilmu">
		                                      <option value="">--------------------Pilih Rumpun Ilmu--------------------</option>
		                                     <?php
		                                     $tampil_kel_bidang_sql=mysqli_query($server1,"SELECT * FROM ref_kelompok_bidang order by nama");
		                                     /*while($rs = mysqli_fetch_array($sql))
		                                     {
		                                                           //$str=my_simple_crypt( $rs[kd_keilmuan], 'e' );

		                                     	echo "<option value='$rs[id]'>$rs[nama]</option>";*/

		                                     	while($w = mysqli_fetch_array($tampil_kel_bidang_sql))
		                                     	{
					                               //jika pernah mengisi
		                                     		if ($r['id_ref_kelompok_bidang']==$w['id'])
		                                     		{
		                                     			echo "<option value=$w[id] selected>$w[nama]</option>";
		                                     		}
		                                     		else
		                                     		{

		                                     			echo "<option value=$w[id]>$w[nama]</option>";
		                                     		}

		                                     	}
		                                     echo "</select></td>";
		                                    ?>
		                                    </select>
                 					 </td>
                                  </th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Bidang Kategori Penelitian</b></label>
							         </td>
							           <td class="text-left">
							           <select  id='kategori_bidang_pilih'  class="form-control" name="bidang_kategori">
		                                      <option value="">-----Pilih Kategori Bidang Penelitian-----</option>
		                                     <?php
				                       		$tampil_kat_bidang_pilih_sql=mysqli_query($server1,"SELECT
																						*
																						FROM
																						`ref_kategori_bidang_penelitian_simlitabmas` order by nama asc");
				                       		while($w = mysqli_fetch_array($tampil_kat_bidang_pilih_sql))
				                       		{
					                               //jika pernah mengisi
				                       			if ($r['id_ref_kategori_bidang']==$w['kode_kategori_bidang_penelitian_simlitabmas'])
				                       			{
				                       				echo "<option value=$w[kode_kategori_bidang_penelitian_simlitabmas] selected>$w[nama]</option>";
				                       			}
				                       			else
				                       			{

				                       				echo "<option value=$w[kode_kategori_bidang_penelitian_simlitabmas]>$w[nama]</option>";
				                       			}
				                       			
				                       		}
				                       		?>
		                                    </select>
                 					 </td>
                                  </th>
							      </tr>
							      <tr id='bidang_penelitian_element'>
							      <td class="text-left align-middle col-md-2">
				                         <label for=""><b>Bidang Penelitian</b></label>
				                       </td>
				                       <td class="text-left">
				                       	<select  id='kategori_bidang_pilih'  class="form-control" name="bidang_penelitian">
				                       		 <option value="">-----Pilih Bidang Penelitian-----</option>
				                       		<?php 
				                       		$tampil_kategori_bidang_pilih_sql=mysqli_query($server1,"SELECT
																*
																FROM
																`ref_bidang_penelitian_simlitabmas` order by nama asc");
				                       		while($w = mysqli_fetch_array($tampil_kategori_bidang_pilih_sql))
				                       		{
					                               //jika pernah mengisi
				                       			if ($r['id_ref_bidang_penelitian']==$w['kode_bidang_penelitian_simlitabmas'])
				                       			{
				                       				echo "<option value=$w[kode_bidang_penelitian_simlitabmas] selected>$w[nama]</option>";
				                       			}
				                       			else
				                       			{

				                       				echo "<option value=$w[kode_bidang_penelitian_simlitabmas]>$w[nama]</option>";
				                       			}
				                       		}
				                       		?>
				                       	</select>
				                  </td>
				              </tr>
							       <tr id='bidang_peelitian_tampil'>
							    </thead>
							     <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Skema Penelitian</b></label>
							         </td>
							           <td class="text-left">
		                                      <?php
												  echo "<select name='skema_penelitian' id='skema' class='form-control'>";
												      if ($r['skema']=='penelitian dasar')
													  {
														echo "<option value='penelitian dasar' selected>Penelitian Dasar</option>";
														echo "<option value='penelitian terapan'>Penelitian Terapan</option>";
														echo "<option value='penelitian kerjasama pt'>Penelitian Kerjasama PT</option>";
														echo "<option value='penelitian kompetisi'>Penelitian Kompetisi</option>";
													  }
													  else if  ($r['skema']=='penelitian terapan')
													  {
														echo "<option value='penelitian dasar'>Penelitian Dasar</option>";
														echo "<option value='penelitian terapan' selected>Penelitian Terapan</option>";
														echo "<option value='penelitian kerjasama pt'>Penelitian Kerjasama PT</option>";
														echo "<option value='penelitian kompetisi'>Penelitian Kompetisi</option>";
													  }
													  else if  ($r['skema']=='penelitian kerjasama pt')
													  {
														echo "<option value='penelitian dasar'>Penelitian Dasar</option>";
														echo "<option value='penelitian terapan'>Penelitian Terapan</option>";
														echo "<option value='penelitian kerjasama pt' selected>Penelitian Kerjasama PT</option>";
														echo "<option value='penelitian kompetisi'>Penelitian Kompetisi</option>";
													  }
													  else if  ($r['skema']=='penelitian kompetisi')
													  {
														echo "<option value='penelitian dasar'>Penelitian Dasar</option>";
														echo "<option value='penelitian terapan'>Penelitian Terapan</option>";
														echo "<option value='penelitian kerjasama pt'>Penelitian Kerjasama PT</option>";
														echo "<option value='penelitian kompetisi' selected>Penelitian Kompetisi</option>";
													  }
													  else
													  {
													  	echo "<option value=''>--Pilih Skema--</option>";
													    echo "<option value='penelitian dasar'>Penelitian Dasar</option>";
														echo "<option value='penelitian terapan'>Penelitian Terapan</option>";
														echo "<option value='penelitian kerjasama pt'>Penelitian Kerjasama PT</option>";
														echo "<option value='penelitian kompetisi'>Penelitian Kompetisi</option>";
													  }
													echo "</select>";  
												?>
		                                </td>
		                           </tr>
		                           <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Kelompok Penelitian</b></label>
							         </td>
							           <td class="text-left">
		                                      <?php
												  echo "<select name='kelompok_penelitian' id='kelompok_penelitian' class='form-control'>";
												      if ($r['nama_kelompok_penelitian']=='teknologi informasi dan komunikasi')
													  {
														echo "<option value='teknologi informasi dan komunikasi' selected>Teknologi Informasi dan Komunikasi</option>";
														echo "<option value='rekayasa'>Rekayasa</option>";
														echo "<option value='sosial humaniora'>Sosial Humaniora</option>";
														echo "<option value='seni dan desain'>Seni dan Desain</option>";
													  }
													  else if  ($r['nama_kelompok_penelitian']=='rekayasa')
													  {
														echo "<option value='teknologi informasi dan komunikasi'>Teknologi Informasi dan Komunikasi</option>";
														echo "<option value='rekayasa' selected>Rekayasa</option>";
														echo "<option value='sosial humaniora'>Sosial Humaniora</option>";
														echo "<option value='seni dan desain'>Seni dan Desain</option>";
													  }
													  else if  ($r['nama_kelompok_penelitian']=='sosial humaniora')
													  {
														echo "<option value='teknologi informasi dan komunikasi'>Teknologi Informasi dan Komunikasi</option>";
														echo "<option value='rekayasa'>Rekayasa</option>";
														echo "<option value='sosial humaniora' selected>Sosial Humaniora</option>";
														echo "<option value='seni dan desain'>Seni dan Desain</option>";
													  }
													  else if  ($r['nama_kelompok_penelitian']=='seni dan desain')
													  {
														 echo "<option value='teknologi informasi dan komunikasi'>Teknologi Informasi dan Komunikasi</option>";
														echo "<option value='rekayasa'>Rekayasa</option>";
														echo "<option value='sosial humaniora'>Sosial Humaniora</option>";
														echo "<option value='seni dan desain' selected>Seni dan Desain</option>";
													  }
													  else
													  {
													  	echo "<option value=''>--Pilih Kelompok Penelitian--</option>";
													    echo "<option value='teknologi informasi dan komunikasi'>Teknologi Informasi dan Komunikasi</option>";
														echo "<option value='rekayasa'>Rekayasa</option>";
														echo "<option value='sosial humaniora'>Sosial Humaniora</option>";
														echo "<option value='seni dan desain'>Seni dan Desain</option>";
													  }
													echo "</select>";  
												?>
		                                </td>
		                           </tr>
		                            <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Tanggal Pelaksanaan</b></label>
							         </td>
							         <td class="text-left"><input type="text" name="tgl_mulai" class="form-control" id="datepickers" size="20" value="<?php echo tgl_indo($r['tgl_awal_pelaksanaan']);?>"></th>&nbsp;S/D&nbsp;<input type="text" name="tgl_akhir" class="form-control" id="datepickers2" value="<?php echo tgl_indo($r['tgl_akhir_pelaksanaan']);?>" size="20"></th>
							      </tr>
		                           <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Kelompok Keilmuan Program Studi</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="nama_kelompok_keilmuan" size="40" id="nama_kelompok_keilmuan" value="<?php if (isset($_GET['idx']))echo $r['nama_kelompok_keilmuan'];?>">
							      </tr>
		                           <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Mitra</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="mitra" size="40" id="mitra" value="<?php if (isset($_GET['idx']))echo $r['mitra'];?>"></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Luaran Yang Dihasilkan</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="luaran" size="40" id="luaran" value="<?php if (isset($_GET['idx']))echo $r['luaran'];?>"></th>
							      </tr>
                        </table>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
                <center><button class="btn btn-info m-r-5 m-b-5" type="submit" <?php echo $var_disabled; ?>>SIMPAN DATA</button>
            </div>
            <!-- end row -->
			
