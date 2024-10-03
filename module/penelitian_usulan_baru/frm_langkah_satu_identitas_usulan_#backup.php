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
                            <h4 class="panel-title">Pengajuan Baru Penelitian Internal Tahun Ajaran ....</h4>
                        </div>
                        

                         <form action="module/wirausaha/frm_peserta_tambah_proses.php" method="post"  name="ubah_wub" class="form-inline" onsubmit="return validasi_frm_ubah_wub();">

                       
                        
					   <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                <!--<tr>
                                    <td class="text-left align-middle col-md-2">
							           <label for=""><b>Judul</b></label>
							         </td>
                                    <th class="text-left"><input id="" class="form-control" name="no_ktp" size="60"></th>
                                </tr>-->
                                 <tr>
                                    <th colspan="2" class="text-center" bgcolor="#BEBEBE">Form Identitas Usulan</th>
                                </tr>
                                 <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Judul Penelitian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="50" rows="3" name="judul" id="judul"></textarea></th>
							      </tr>
							      <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Deskripsi Penelitian</b></label>
							         </td>
							         <td class="text-left"><textarea class="form-control" cols="80" rows="5" name="deskripsi" id="deskripsi"></textarea></th>
							      </tr>
							     <tr>
							         <td class="text-left align-middle col-md-2">
							           <label for=""><b>Rumpun Ilmu</b></label>
							         </td>
							           <td class="text-left">
		                                   <select  id='rumpun_ilmu'  class="form-control" name="rumpun_ilmu">
		                                      <option value="">-----Pilih Rumpun Ilmu-----</option>
		                                     <?php
		                                               $sql=mysqli_query($server1,"SELECT * FROM ref_kelompok_bidang order by nama");
		                                                      while($rs = mysqli_fetch_array($sql))
		                                                       {
		                                                           //$str=my_simple_crypt( $rs[kd_keilmuan], 'e' );
		                                                           
		                                                           echo "<option value='$rs[id]'>$rs[nama]</option>";
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
		                                   <select  id='kategori_bidang_pilih'  class="form-control" name="bidang_penelitian">
		                                      <option value="">-----Pilih Kategori Bidang Penelitian-----</option>
		                                     <?php
		                                               $sql=mysqli_query($server1,"SELECT * FROM ref_kategori_bidang_penelitian_simlitabmas order by nama");
		                                                      while($rs = mysqli_fetch_array($sql))
		                                                       {
		                                                           //$str=my_simple_crypt( $rs[kd_keilmuan], 'e' );
		                                                           
		                                                           echo "<option value='$rs[kode_kategori_bidang_penelitian_simlitabmas]'>$rs[nama]</option>";
		                                                      }
		                                                       echo "</select></td>";
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
				                                    </select>
				                  </td>
				              </tr>
							       <tr id='bidang_peelitian_tampil'>
							    </thead>
                        </table>
                         <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
							   <tr>
                                    <th colspan="4" class="text-center" bgcolor="#BEBEBE">Form Pengajuan Dana Penelitian</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-left"><button type="button" class="btn btn-danger" id="tambah_dana_pengajuan"><i class="fa fa-file"></i>&nbsp;Klik Untuk Menambah Dana Pengajuan</button></th>
                                </tr>

                            
                           </table>
                           <input type="text" id="banyak_data">
                           <table class="table table-condensed table-striped table-bordered text-center">
									<thead>
										<tr>
											<th style="width: 2%">No</th>
											<th style="width: 60%;">Nama Dana Pengajuan</th>
											<th style="width: 30%;text-align: right;">Nominal Dana Pengajuan</th>
											<th style="width: 8%"></th>
										
										</tr>
									</thead>
									<tbody id="container">
									
									</tbody>
									<tr id="total_dana_pengajuan">
										<th colspan="2" class="text-right"><label><b><font color='red'>Total Dana Pengajuan</font></label></b</th>
										<th class="text-right">
											<span class="blink"><label><b><font color='red' id="total_pengajuan_label">Rp. 0</font></label></b></span>
											<input type="hidden" id="total_pengajuan">
										</th>
									</tr>
								</table>
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
							   <tr>
                                    <th colspan="4" class="text-center" bgcolor="#BEBEBE">Form Pengajuan Anggota Peneliti</th>
                                </tr>
                                <tr>
                                	<td class="text-left align-text-bottom col-md-2" style="width: 20%">
							           <label for=""><b>Masukan NIP Anggota Peneliti</b></label>
							         </td>
                                    <td class="text-left" style="width: 20%"><input id="kata_kunci" class="form-control input-sm" name="" size="60" value="41277006005"></td>
                                    <td class="text-left"><a href="#" id="cari_peneliti" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-dosen-ditemukan">Cari Dosen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
                                </tr>
                                 <tr>
                                	<td class="text-left align-text-bottom col-md-2" style="width: 20%">
							           <label for=""><b>Masukan NIM Anggota Peneliti</b></label>
							         </td>
                                    <td class="text-left" style="width: 20%"><input id="kata_kunci_mhs" class="form-control input-sm" name="" size="60" value="10110111"></td>
                                    <td class="text-left"><a href="#" id="cari_peneliti_mhs" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-dialog-peneliti-mhs-ditemukan">Cari Mahasiswa</a></td>
                                </tr>
                           </table>


                           <input type="text" id="banyak_data_peneliti" value='1'>
                           <input type="text" id="banyak_ketua_peneliti" value='0'>
                           <table class="table table-condensed table-striped table-bordered text-center">
									<thead>
										<tr>
											<th style="width: 2%">No</th>
											<th style="width: 20%;">NIP/NIM</th>
											<th style="width: 30%;">Nama Peneliti</th>
											<th style="width: 20%;">Status</th>
											<th style="width: 20%;">Keterangan</th>
											<th style="width: 48%"></th>
										
										</tr>
									</thead>
									<tbody id="container_peneliti">
									<tr>
										<td>
											<div id="1">
												<label for=""><b>1</b></label></div>
										</td>
										<td class="text-left">
											<label for=""><b><?php echo $_SESSION['nip_user'];?></b></label>
											<input class="form-control input-sm" id="nip_anggota_peneliti_1" name="nip_anggota_peneliti_1" type="hidden" value="<?php echo $_SESSION['nik_user'];?>">
										</td>
										<td class="text-left">
											<label for=""><b><?php echo $_SESSION['nama_dan_gelar_user'];?></b></label>
											<input class="form-control input-smn" id="nama_belakang_1" name="nama_belakang_1" type="hidden" style="text-left: left">
										</td>
										<td class="text-left">
											<select name="status_peneliti_1" id="status_peneliti_session">         
					                            <option value="0">Pilih Status Peneliti</option>     
					                            <option value="Ketua">Ketua</option>
					                            <option value="Anggota">Anggota</option>
					                        </select>
										</td>
										<td class="text-left"><label for=""><b>Dosen</b></label>
											<input class="form-control input-sm" id="keterangan_peneliti_1" name="keterangan_peneliti_1" type="hidden" style="text-left: left" value="dosen">
										</td>
										<td class="text-left">
											
											<input id="rows_1" name="rows[]" value="1" type="hidden">
										</tr>
									</tbody>
								</table>
                    </div>
						</form>
						

                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
                <center><button class="btn btn-info m-r-5 m-b-5" type="submit">SIMPAN DATA</button>
            </div>
            <!-- end row -->
			
