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
                            <h4 class="panel-title">Form Identitas Usulan Pengabdian Tahun <?php echo date("Y");?></h4>
                        </div>
                        

                         <form action="module/pengabdian_usulan_baru/frm_langkah_satu_identitas_usulan_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_identitas_usulan_pengabdian();">

                       
                        
					   <div class="table-responsive">
					   	<?php
							$langkah_satu_proses=my_simple_crypt('insert', 'e' );

							//Jika Pernah Mengisi
							if (isset($_GET['idx']))
							{
								$idx=my_simple_crypt($_GET['idx'], 'd' );
						        $sql=mysqli_query($server1,"select * from pengajuan_pengabdian where idx_pengabdian=".$idx);
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
							           <label for=""><b>Judul Pengabdian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="50" rows="3" name="judul" id="judul"><?php if (isset($_GET['idx']))echo $r['judul_pengabdian'];?></textarea></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Deskripsi Pengabdian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="80" rows="5" name="deskripsi" id="deskripsi"><?php if (isset($_GET['idx']))echo $r['dekripsi_pengabdian'];?></textarea></th>
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
							           <label for=""><b>Bidang Kategori Pengabdian</b></label>
							         </td>
							           <td class="text-left">
							           <select  id='kategori_bidang_pilih_abdi'  class="form-control" name="bidang_kategori">
		                                      <option value="">-----Pilih Kategori Bidang Pengabdian-----</option>
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
							      <tr id='bidang_pengabdian_element'>
							      <td class="text-left align-middle col-md-2">
				                         <label for=""><b>Bidang Pengabdian</b></label>
				                       </td>
				                       <td class="text-left">
				                       	<select  id='kategori_bidang_pilih'  class="form-control" name="bidang_penelitian">
				                       		 <option value="">-----Pilih Bidang Pengabdian-----</option>
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
							       <tr id='bidang_pengabdian_tampil'>
							    </thead>
							     <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Skema Pengabdian</b></label>
							         </td>
							           <td class="text-left">
		                                      <?php
												  echo "<select name='skema_penelitian' id='skema' class='form-control'>";
												      if ($r['skema']=='pkm')
													  {
														echo "<option value='pkm' selected>Program Kemitraan Masyarakat (PKM)</option>";
														echo "<option value='ppk'>Program Pengembangan Kewirausahaan (PPK)</option>";
														echo "<option value='ppdm'>Program Pengembangan Desa Mitra (PPDM)</option>";
														echo "<option value='ppim'>Program Penerapan Iptek Kepada Masyarakat (PPIM)</option>";
													  }
													  else if  ($r['skema']=='ppk')
													  {
														echo "<option value='pkm'>Program Kemitraan Masyarakat (PKM)</option>";
														echo "<option value='ppk' selected>Program Pengembangan Kewirausahaan (PPK)</option>";
														echo "<option value='ppdm'>Program Pengembangan Desa Mitra (PPDM)</option>";
														echo "<option value='ppim'>Program Penerapan Iptek Kepada Masyarakat (PPIM)</option>";
													  }
													  else if  ($r['skema']=='ppdm')
													  {
														echo "<option value='pkm'>Program Kemitraan Masyarakat (PKM)</option>";
														echo "<option value='ppk'>Program Pengembangan Kewirausahaan (PPK)</option>";
														echo "<option value='ppdm' selected>Program Pengembangan Desa Mitra (PPDM)</option>";
														echo "<option value='ppim'>Program Penerapan Iptek Kepada Masyarakat (PPIM)</option>";
													  }
													  else if  ($r['skema']=='ppim')
													  {
															echo "<option value='pkm'>Program Kemitraan Masyarakat (PKM)</option>";
														echo "<option value='ppk'>Program Pengembangan Kewirausahaan (PPK)</option>";
														echo "<option value='ppdm'>Program Pengembangan Desa Mitra (PPDM)</option>";
														echo "<option value='ppim'>Program Penerapan Iptek Kepada Masyarakat (PPIM)</option>";
													  }
													  else
													  {
													  	echo "<option value='' selected>--Pilih Skema--</option>";
													   	echo "<option value='pkm'>Program Kemitraan Masyarakat (PKM)</option>";
														echo "<option value='ppk'>Program Pengembangan Kewirausahaan (PPK)</option>";
														echo "<option value='ppdm'>Program Pengembangan Desa Mitra (PPDM)</option>";
														echo "<option value='ppim'>Program Penerapan Iptek Kepada Masyarakat (PPIM)</option>";
													  }
													echo "</select>";  
												?>
		                                </td>
		                           </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Tingkat Penyelenggaraan</b></label>
							         </td>
							         <td class="text-left">
							         		 <?php
												  echo "<select name='tipel' id='tingkat_penyelenggaraan' class='form-control'>";
												      if ($r['tingkat_penyelenggaraan']=='lokal')
													  {
														echo "<option value='lokal' selected>Lokal</option>";
														echo "<option value='nasional'>Nasional</option>";
														echo "<option value='internasional'>Internasional</option>";
													  }
													  else if  ($r['tingkat_penyelenggaraan']=='nasional')
													  {
														echo "<option value='lokal'>Lokal</option>";
														echo "<option value='nasional' selected>Nasional</option>";
														echo "<option value='internasional'>Internasional</option>";
													  }
													  else if  ($r['tingkat_penyelenggaraan']=='internasional')
													  {
														echo "<option value='lokal'>Lokal</option>";
														echo "<option value='nasional'>Nasional</option>";
														echo "<option value='internasional' selected>Internasional</option>";
													  }
													  else
													  {
													  	echo "<option value='' selected>--Pilih Tingkat Penyelenggaraan--</option>";
													    echo "<option value='lokal'>Lokal</option>";
														echo "<option value='nasional'>Nasional</option>";
														echo "<option value='internasional'>Internasional</option>";
													  }
													echo "</select>";  
												?>
							         </th>
							      </tr>
							       <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Tanggal Pelaksanaan</b></label>
							         </td>
							         <td class="text-left"><input type="text" name="tgl_mulai" class="form-control" id="datepickers" size="20" value="<?php echo tgl_indo($r['tgl_awal_pelaksanaan']);?>"></th>&nbsp;S/D&nbsp;<input type="text" name="tgl_akhir" class="form-control" id="datepickers2" value="<?php echo tgl_indo($r['tgl_akhir_pelaksanaan']);?>" size="20"></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Tempat Pelaksanaan</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="tempel" size="40" id="tipel" value="<?php if (isset($_GET['idx']))echo $r['tempat_pelaksanaan'];?>"></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Luaran Yang Dihasilkan</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="luaran" size="40" id="luaran" value="<?php if (isset($_GET['idx']))echo $r['luaran'];?>"></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Mitra</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="mitra" size="40" id="mitra" value="<?php if (isset($_GET['idx']))echo $r['mitra'];?>"></th>
							      </tr>
							       <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Nama Mitra</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="nama_mitra" size="40" id="nama_mitra" value="<?php if (isset($_GET['idx']))echo $r['nama_mitra'];?>"></th>
							      </tr>
							       <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Alamat</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="80" rows="5" name="alamat_mitra" id="alamat_mitra"><?php if (isset($_GET['idx']))echo $r['alamat_mitra'];?></textarea></th>
							      </tr>
							       <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Penanggung Jawab</b></label>
							         </td>
							         <td class="text-left"><input class="form-control input-sm" type="text" name="penanggung_jawab" size="40" id="penanggung_jawab" value="<?php if (isset($_GET['idx']))echo $r['penanggung_jawab'];?>"></th>
							      </tr>
							       <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Sumber Dana</b></label>
							         </td>
							           <td class="text-left">
		                                  <?php
		                                  	 echo "<select name='id_ref_sumber_dana' id='sumber_dana' class='form-control'>";
												      /*if ($r['id_ref_sumber_dana']=='mandiri')
													  {
														echo "<option value='mandiri' selected>Mandiri</option>";
														echo "<option value='dpnm'>DPNM</option>";
														echo "<option value='luar_negeri'>Luar Negeri</option>";
														echo "<option value='pemda'>PemDa</option>";
													  }
													  else if  ($r['id_ref_sumber_dana']=='dpnm')
													  {
														echo "<option value='mandiri'>Mandiri</option>";
														echo "<option value='dpnm' selected>DPNM</option>";
														echo "<option value='luar_negeri'>Luar Negeri</option>";
														echo "<option value='pemda'>PemDa</option>";
													  }
													  else if  ($r['id_ref_sumber_dana']=='luar_negeri')
													  {
														echo "<option value='mandiri'>Mandiri</option>";
														echo "<option value='dpnm'>DPNM</option>";
														echo "<option value='luar_negeri' selected>Luar Negeri</option>";
														echo "<option value='pemda'>PemDa</option>";
													  }
													  else if  ($r['id_ref_sumber_dana']=='pemda')
													  {
														echo "<option value='mandiri'>Mandiri</option>";
														echo "<option value='dpnm'>DPNM</option>";
														echo "<option value='luar_negeri'>Luar Negeri</option>";
														echo "<option value='pemda' selected>PemDa</option>";
													  }
													  else
													  {
													  	echo "<option value='' selected>--Pilih Sumber Dana--</option>";
													   	echo "<option value='mandiri'>Mandiri</option>";
														echo "<option value='dpnm'>DPNM</option>";
														echo "<option value='luar_negeri'>Luar Negeri</option>";
														echo "<option value='pemda'>PemDa</option>";
													  }
													echo "</select>";*/
													if ($r['id_ref_sumber_dana']=='internal_PT')
													{
														echo "<option value='internal_PT' selected>Internal PT</option>";
														echo "<option value='pemda'>PEMDA</option>";
														echo "<option value='csr'>CSR</option>";
														echo "<option value='lainnya_dalam_negeri'>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri'>Lainnya Luar Negeri</option>";
													}
													else if ($r['id_ref_sumber_dana']=='pemda')
													{
														echo "<option value='internal_PT'>Internal PT</option>";
														echo "<option value='pemda' selected>PEMDA</option>";
														echo "<option value='csr'>CSR</option>";
														echo "<option value='lainnya_dalam_negeri'>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri'>Lainnya Luar Negeri</option>";
													}
													else if ($r['id_ref_sumber_dana']=='csr')
													{
														echo "<option value='internal_PT'>Internal PT</option>";
														echo "<option value='pemda'>PEMDA</option>";
														echo "<option value='csr' selected>CSR</option>";
														echo "<option value='lainnya_dalam_negeri'>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri'>Lainnya Luar Negeri</option>";
													}
													else if ($r['id_ref_sumber_dana']=='lainnya_dalam_negeri')
													{
														echo "<option value='internal_PT'>Internal PT</option>";
														echo "<option value='pemda'>PEMDA</option>";
														echo "<option value='csr'>CSR</option>";
														echo "<option value='lainnya_dalam_negeri' selected>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri'>Lainnya Luar Negeri</option>";
													}
													else if ($r['id_ref_sumber_dana']=='lainnya_luar_negeri')
													{
														echo "<option value='internal_PT'>Internal PT</option>";
														echo "<option value='pemda'>PEMDA</option>";
														echo "<option value='csr'>CSR</option>";
														echo "<option value='lainnya_dalam_negeri'>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri' selected>Lainnya Luar Negeri</option>";
													}
													else 
													{
														echo "<option value='' selected>--Pilih Sumber Dana--</option>";
														echo "<option value='internal_PT'>Internal PT</option>";
														echo "<option value='pemda'>PEMDA</option>";
														echo "<option value='csr'>CSR</option>";
														echo "<option value='lainnya_dalam_negeri'>Lainnya Dalam Negeri</option>";
														echo "<option value='lainnya_luar_negeri'>Lainnya Luar Negeri</option>";
													}
													echo "</select>";

		                                  ?>
                 					 </td>
                                  </th>
							      </tr>
                        </table>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
                <center><button class="btn btn-info m-r-5 m-b-5" type="submit" <?php echo $var_disabled; ?>>SIMPAN DATA</button>
            </div>
            <!-- end row -->
			
