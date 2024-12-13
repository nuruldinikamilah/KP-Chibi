<!--penting -->
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
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
                            
                            <h4 class="panel-title">Cetak Kartu Bimbingan Tahun <?php echo $_SESSION['tahun_aktif']; ?> Semester <?php echo $_SESSION['semester_aktif']?></h4>
                        </div>
                        
                        <form action="module/proposal/frm_cetak_kartu_bimbingan_cetak.php" method="post"  name="proposal" class="form-inline" onsubmit="return validasi_cetak();">
                        <?php

                                        $sql=mysqli_query($server1,"SELECT
                                                                    *, ref_dosen.nama as nama_dosen from proposal_tahap_final INNER JOIN ref_dosen
                                                                        ON `proposal_tahap_final`.`KODEPEMBIMBING` = `ref_dosen`.`kddosen`  where proposal_tahap_final.TAHUN='".$_SESSION['tahun_aktif']."' and proposal_tahap_final.STATUS='diterima' and proposal_tahap_final.SMT='".$_SESSION['semester_aktif']."'");
                                        $jumlah=mysqli_num_rows($sql);
                        ?>
                        <div class="panel-body">
                            <table id="default_tabel" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="anchor-from"/></th>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Jenis Proposal</th>
                                        <th>Status</th>
                                        <th>Nama Pembimbing</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    
                                        $no=1;
                                        while($r=mysqli_fetch_array($sql))
                                        {
                                            $str=my_simple_crypt( $r['kd_pro_thp_final'], 'e' );
                                           

                                            ?>
                                                <!--<tr class="odd gradeX">-->
                                                <tr class='<?php if($no%2==0) echo"odd gradeX"/*warna genap*/; else echo"even gradeC"/*warna ganjil*/?>'> 
                                              <!--<a data-toggle="modal" id="1" data-target="#edit-modal">Edit 1</a>-->
                                                     <td><input type="checkbox" name="pilihan[]" value="<?php echo $r['kd_pro_thp_final'];?>" class="checkall"> </td>
                                                     <td><?php echo $no;?></td>
                                                      
                                                    <td><?php echo $r['NIM'];?></td>
                                                    <td><?php echo $r['NAMA'];?></td>
                                                    <td><?php echo $r['JUDUL'];?></td>
                                                   
                                                    
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
                                                    
                                                     <td><span class="blink"><font color="red"><b><?php echo $r['STATUS'];?></b></font></td>
                                                          <td><?php echo $r['nama_dosen'];?></td>
                                                    </tr>
                                            <?php
                                            $no++;
                                        }
                                   ?>
                                </tbody>
                                </tbody>
                                </table>
                                <hr />
                                <center><input type="submit" name="submit" Value="Cetak Kartu" class="btn btn-primary m-r-5 m-b-5">
                              </div>
                              </div>
                    <!-- end panel -->  
            </div>
            <!-- end row -->









