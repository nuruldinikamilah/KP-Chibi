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
<!-- begin row -->
            <div class="row">
                <!-- begin col-10 -->
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
                            
                            <h4 class="panel-title">Lihat Data Laporan Skripsi Tahun <?php echo $_POST['tahun'] ?> Semester <?php echo $_POST['semester'];?></h4>
                        </div>
                        
                        <form action="module/proposal/frm_validasi_status_update.php" method="post"  name="proposal" class="form-inline" onsubmit="return validasi_proposal();">
                        <?php

                                        $sql=mysqli_query($server1,"select * from v_laporan_skripsi_all limit 100");
                                        $jumlah=mysqli_num_rows($sql);
                        ?>
                        <input type="hidden" name="jumlah_data_pengajuan" value="<?php echo $jumlah;?>" id="jumlah_data_pengajuan">
                        <div class="panel-body">
                            <table id="tabel_laporan" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                         <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    
                                        $no=1;
                                        while($r=mysqli_fetch_array($sql))
                                        {
                                         ?>         
                                                    <td><?php echo $no;;?></td>
                                                    <td><?php echo $r['NIM'];?></td>
                                                    <td><?php echo $r['NAMA'];?></td>
                                                    <td><?php echo $r['JUDUL'];?></td>
                                                    <td><?php echo $r['nip_anggota_penguji_1'];?></td>
                                                    <td><?php echo $r['kd_anggota_penguji_1'];?></td>
                                                    <td><?php echo $r['nama_anggota_penguji_1'];?></td>
                                                    <td><?php echo $r['nip_ketua_penguji'];?></td>
                                                    <td><?php echo $r['kd_ketua_penguji'];?></td>
                                                    <td><?php echo $r['nama_ketua_penguji'];?></td>
                                                    <td><?php echo $r['nip_anggota_penguji_3'];?></td>
                                                    <td><?php echo $r['kd_anggota_penguji_3'];?></td>
                                                    <td><?php echo $r['nama_anggota_penguji_3'];?></td>
                                                    </tr>
                                            <?php
                                            $no++;
                                        }
                                   ?>
                                </tbody>
                                </tbody>
                                </table>
                                <hr />
                                <center><input type="submit" name="submit" Value="Simpan Data" class="btn btn-primary m-r-5 m-b-5">
                              </div>
                              </div>
                    <!-- end panel -->  
            </div>
            <!-- end row -->

         








