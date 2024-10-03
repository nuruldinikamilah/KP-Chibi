<script>
function blink_text() {
    $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
}
setInterval(blink_text, 1000);
</script>


<!--penting -->
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>



<?php
if(isset($_GET['status'])) 
{
    if ($_GET['status']=='gagal')
        {
                                    ?>
                                         <script>
                                        $(document).ready(function() 
                                        {
                                            $('#modal-dialog-mysql-error').modal('show');
                                        });
                                    </script>
                                    <?php
        }
        else if ($_GET['status']=='sukses_ubah')
        {
                                ?>
                                <script>
                                        $(document).ready(function() 
                                        {
                                            $('#modal-dialog-validasi-sukses').modal('show');
                                        });
                                </script>
                                <?php
            }

}
    
?>  

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
                            <h4 class="panel-title">Data Konfigurasi Aplikasi Saat Ini</h4>
                        </div>
                        

                         <!--<form action="module/pengaturan/frm_pengaturan_ubah_proses.php" method="post"  name="ubah_wub" class="form-inline" onsubmit="return validasi_frm_ubah_wub();">-->
                           <form action="module/pengaturan/frm_pengaturan_ubah_proses.php" method="post" enctype='multipart/form-data' class='form-inline'>

                       
                        
					   
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                <?php
                                  $sql=mysqli_query($server1,"SELECT 
                                                     *
                                    from konfig
                                                  ");
                                  $r=mysqli_fetch_array($sql);
                                ?>
                               
                                
                                     <!-- begin panel -->
			                       

			                              <table class="table table-bordered">
			                                </thead>
			                                <tbody>
			                                    <tr>
			                                        <th width="25%"> Tahun Ajaran</td>
			                                        <td>
			                                        	<?php echo substr($r['semester_aktif'],0,4);?>
			                                          </td>
			                                    </tr>
			                                    <tr>
			                                    	<th width="25%">Semester</td>
			                                    	<td>
			                                       <?php
			                                       		if (substr($r['semester_aktif'], -1)=='1')
														    {
														        $semester='GANJIL';
														    }
														    else
														    {
														         $semester='GENAP';
														    }
														 echo $semester;
			                                       ?>
			                                        </td>
			                                    </tr>
			                                    <tr>
			                                    	<th width="25%">Tanggal & Jam Pembukaan Proposal</td>
			                                    	<td>
			                                    		<?php
			                                    			$time = date('G:i:s', strtotime($r['tgl_pembukaan']));
			                                    		?>
			                                       		<?php echo tgl_indo($r['tgl_pembukaan']);?> / <?php echo $time; ?>
			                                        </td>
			                                    </tr>
			                                     <tr>
			                                    	<th width="25%">Tanggal & Jam Penutupan Proposal</td>
			                                    	<td>
			                                    		<?php
			                                    			$time = date('G:i:s', strtotime($r['tgl_penutupan']));
			                                    		?>
			                                       		<?php echo tgl_indo($r['tgl_penutupan']);?> / <?php echo $time; ?>
			                                        </td>
			                                    </tr>
			                                </tbody>
			                            </table>
			                    </div>
			                    <!-- end panel -->
                               
                            </thead>
                        </table>
                    </div>
						</form>
						
        							
                  
                <!-- end col-12 -->
            </div>
            <!-- end row -->





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
                            <h4 class="panel-title">Perubahan Data Konfigurasi Aplikasi</h4>
                        </div>
                        

                         
                           <form action="module/proposal/frm_pengaturan_ubah_proses.php" method="post" enctype='multipart/form-data' class='form-inline'>

                       
                        
					   
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                     <!-- begin panel -->
			                       

			                              <table class="table table-bordered">
			                                </thead>
			                                <tbody>
			                                    <tr>
			                                        <th width="5%">Pilih Tahun Ajaran</td>
			                                        <td width="30%" colspan="3"><select name="tahun" class="form-control">
			                                              <?php 
			                                                $awal=date('Y')-2;
			                                                $akhir=date('Y')+1;
			                                                 for($i = $awal ; $i < $akhir; $i++)
			                                                 {
			                                                    echo "<option>$i</option>";
			                                                 }
			                                              ?>
			                                              </select>
			                                          </td>
			                                          
			                                    </tr>
			                                    <tr>
			                                        <th>Pilih Semester</td>
			                                       <td width="30%" colspan="3">
			                                          <select name="semester" class="form-control">
			                                                        <option value="ganjil">Ganjil</option>
			                                                        <option value="genap">Genap</option>
			                                          </select>
			                                      

			                                    </tr>
			                                    <tr>
			                                        <th>Tanggal Pembukaan Proposal</td>
			                                        <td>
			                                          <input type="text" name="tgl_mulai" class="form-control" id="datepickers" size="20">
			                                            <span class="glyphicon glyphicon-calendar"></span>
				                                           
			                                        </td> 
			                                        <th width="7%">
			                                        	Jam Pembukaan Proposal
			                                        </th>
			                                        <td>
			                                        	 <input type="text" name="jam_mulai" class="form-control" id="datetimepickertime" size="20">
				                                                <span class="glyphicon glyphicon-time"></span>
				                                            
			                                        </td>

			                                    </tr>
			                                     <tr>
			                                        <th>Tanggal Penutupan Proposal</td>
			                                        <td>
			                                         <input type="text" name="tgl_akhir" class="form-control" id="datepickers2" size="20">
			                                           <span class="glyphicon glyphicon-calendar"></span>
			                                        </td> 
			                                        <th width="7%">
			                                        	Jam Penutupan Proposal
			                                        </th>
			                                        <td>
			                                        	<input type="text" name="jam_akhir" class="form-control" id="datetimepickertime2" size="20">
                                              				  <span class="glyphicon glyphicon-time"></span>
			                                        </td>

			                                    </tr>
			                                </tbody>
			                            </table>
			                    </div>
			                    <!-- end panel -->
                               
                            </thead>
                        </table>
                        <center><input type="submit" name="submit" Value="Simpan Data" class="btn btn-primary m-r-5 m-b-5">
                    </div>
						</form>
						
        							
                  
                <!-- end col-12 -->
            </div>
            <!-- end row -->



            
			
		
			
		