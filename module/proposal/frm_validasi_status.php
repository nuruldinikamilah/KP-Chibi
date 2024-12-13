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
                            
                            <h4 class="panel-title">Lihat Data Proposal Tahap Final Tahun <?php echo $_SESSION['tahun_aktif']; ?> Semester <?php echo $_SESSION['semester_aktif']?></h4>
                        </div>
                        
                        <form action="module/proposal/frm_validasi_status_update.php" method="post"  name="proposal" class="form-inline" onsubmit="return validasi_proposal();">
                        <?php

                                        $sql=mysqli_query($server1,"SELECT
                                                                    *, `proposal_tahap_final`.`STATUS` AS status_proposal, ref_dosen.nama AS nama_dosen
                                                                    FROM `proposal_tahap_final`
                                                                    INNER JOIN
                                                                    ref_dosen
                                                                    INNER JOIN
                                                                    ref_tema
                                                                    ON `proposal_tahap_final`.`KODEPEMBIMBING` = ref_dosen.`kddosen` AND
                                                                     `proposal_tahap_final`.`TEMA` = ref_tema.`kd_tema`
                                                                     WHERE proposal_tahap_final.TAHUN='".$_SESSION['tahun_aktif']."' and proposal_tahap_final.SMT='".$_SESSION['semester_aktif']."'order by proposal_tahap_final.nim");
                                        $jumlah=mysqli_num_rows($sql);
                        ?>
                        <input type="hidden" name="jumlah_data_pengajuan" value="<?php echo $jumlah;?>" id="jumlah_data_pengajuan">
                        <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status Proposal</th>
                                         <th>Calon Pembimbing Pilihan</th>
                                        <th>Tahun</th>
                                        <th>Semester</th>
                                        <th>File Proposal</th>
                                        <th>File Review</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Kelompok Keilmuan</th>
                                        <th>Tema</th>
                                        <th>Jenis Proposal</th>
                                        <th>Tahapan Proposal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    
                                        $no=1;
                                        while($r=mysqli_fetch_array($sql))
                                        {
                                            $str=my_simple_crypt( $r['kd_pro_thp_final'], 'e' );
                                            $status=$r['status_proposal'];

                                            ?>
                                                <!--<tr class="odd gradeX">-->
                                                <tr class='<?php if($no%2==0) echo"odd gradeX"/*warna genap*/; else echo"even gradeC"/*warna ganjil*/?>'> 
                                              <!--<a data-toggle="modal" id="1" data-target="#edit-modal">Edit 1</a>-->
                                                     <td><?php echo $no;?></td>
                                                      <input type="hidden" value="<?php echo $r['kd_pro_thp_final']?>" name="idx_<?php echo $no?>">
                                                   <td><input type="radio" name="status_<?php echo $no;?>" value="diterima" id="radio-<?php echo $no;?>"<?php if($status=="diterima"){?> checked="true" <?php } ?>>Diterima
                                                    <input type="radio" name="status_<?php echo $no;?>" value="ditolak" id="radio-<?php echo $no;?>"<?php if($status=="ditolak"){?> checked="true" <?php } ?>>Ditolak
                                                </td>
                                                 <td><?php echo $r['nip'].'  | '.$r['nama_dosen'];?></td>
                                                  <input type="hidden" value="<?php echo $r['kddosen']?>" name="<?php echo "nip_pilih_".$no; ?>">
                                                 
                                                <td><?php echo $r['TAHUN'];?></td>
                                                <td><?php echo $r['SMT'];?></td>
                                                <td>
<span class="blink"><font color="red">
    <input type="button" class="btn btn-danger btn-xs m-r-5" value="Cek File" onclick="window.open('<?php echo $r['FILE_PROPOSAL'];?>','popUpWindow','height=800,width=800,resizable=no,scrollbars=yes,status=yes');"></font></span></td>
                                                    <td>
<span class="blink"><font color="red">
    <input type="button" class="btn btn-danger btn-xs m-r-5" value="Cek File" onclick="window.open('<?php echo $r['FILE_REVIEW'];?>','popUpWindow','height=800,width=800,resizable=no,scrollbars=yes,status=yes');"></font></span></td>
                                                    <td><?php echo $r['NIM'];?></td>
                                                    <td><?php echo $r['NAMA'];?></td>
                                                    <td><?php echo $r['JUDUL'];?></td>
                                                   
                                                    <td><?php echo $r['KELOMPOKKEILMUAN'];?></td>
                                                    <td><?php echo $r['nama_tema'];?></td>
                                                    <?php
                                                    if ($r['JENIS']=='B')
                                                        {
                                                            $jenis = "Baru";
                                                        }
                                                        else 
                                                        {
                                                            $jenis = 'Perpanjangan';
                                                        }
                                                    ?>
                                                    <td><?php echo $jenis;?></td>
                                                    <?php
                                                        if (isset($r['status_proposal'])or(is_null($r['status_proposal'])))
                                                        {
                                                            $status_proposal = "Tahap Review";
                                                        }
                                                        else 
                                                        {
                                                            $status_proposal = $r['status_proposal'];;
                                                        }
                                                    ?>
                                                     <td><span class="blink"><font color="red"><b><?php echo $status_proposal;?></b></font></td>
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

         








