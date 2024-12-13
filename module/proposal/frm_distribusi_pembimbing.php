<!--penting -->

<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>



<script>

function blink_text() {

    $('.blink').fadeOut(500);

    $('.blink').fadeIn(500);

}

setInterval(blink_text, 1000);

</script>



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
                                            $('#modal-dialog-distribusi-sukses').modal('show');
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

                   

<!-- begin row -->

            <div class="row">

                <!-- begin col-12 -->

                <div class="col-12">

                     <!-- begin panel -->

                    <div class="panel panel-inverse" data-sortable-id="form-stuff-5">

                        <div class="panel-heading">

                            <div class="panel-heading-btn">

                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>

                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>

                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>

                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>

                            </div>

                            <h4 class="panel-title">Cetak Calon Pembimbing</h4>

                        </div>

                        <div class="panel-body">

                        <?php

                            $sql=mysqli_query($server1,"SELECT

                                                ref_dosen.`nip`,`ref_dosen`.`nama`, `proposal_tahap_final`.`TAHUN`,`proposal_tahap_final`.`KODEPEMBIMBING`, `proposal_tahap_final`.`SMT`,COUNT(*) AS total_pengajuan

                                            FROM

                                                `proposal_tahap_final`

                                            INNER JOIN

                                                ref_dosen

                                            ON `proposal_tahap_final`.`KODEPEMBIMBING` = `ref_dosen`.`kddosen`

                                            where proposal_tahap_final.TAHUN='".$_SESSION['tahun_aktif']."' and proposal_tahap_final.STATUS='diterima' and proposal_tahap_final.SMT='".$_SESSION['semester_aktif']."'

                                            GROUP BY `KODEPEMBIMBING`, `TAHUN`, SMT ORDER BY COUNT(*) DESC");

                                        $no=1;



                        ?>



                        <table id="default_tabel" class="table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>Download File</th>

                                        <th>Nama Calon Pembimbing</th>

                                        <th>Jumlah Mahasiswa Pengajuan</th>

                                        <th>Tahun</th>

                                        <th>Semester</th>

                                    </tr>

                                </thead>

                                <tbody>

                                   <?php

                                        $counter = 0;

                                        while($r=mysqli_fetch_array($sql))

                                        {

                                            $str=my_simple_crypt( $r['KODEPEMBIMBING'], 'e' );

                                            $tahun=my_simple_crypt($_SESSION['tahun_aktif'], 'e' );

                                            $s=my_simple_crypt($_SESSION['semester_aktif'], 'e' );

                                            ?>

                                            <tr>

                                                <td><a class="btn btn-danger  btn-block" href="./module/proposal/download_pengajuan_final.php?key=<?php echo $str; ?>&t=<?php echo $tahun;?>&s=<?php echo $s;?>">Download File</a></td>

                                                 <td><?php echo $r['nama'];?></td>

                                                 <td><span class="badge badge-primary"><?php echo $r['total_pengajuan']; ?></span></td>

                                                 <td><?php echo $r['TAHUN'];?></td>

                                                <td><?php echo ucwords($r['SMT']);?></td>

                                                

                                            </tr>

                                            <?php

                                            $counter += $r['total_pengajuan'];; //values to be summed up

                                        }

                                        echo "<b>Total Mahasiswa Pengajuan : $counter Mahasiswa</b><br><br>";

                                    ?>

                                   

                                </tbody>

                            </table>

                          

                        </div>

                    </div>

                    <!-- end panel -->

                   

                   

                      </div>

                    <!-- end panel -->  

                </div>

                <!-- end col-10 -->

            





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

                            

                            <h4 class="panel-title">Distribusi Calon Pembimbing <?php echo $_SESSION['tahun_aktif']; ?> Semester <?php echo $_SESSION['semester_aktif']?></h4>

                        </div>

                        

                        <form action="module/proposal/frm_distribusi_pembimbing_update.php" method="post"  name="proposal" class="form-inline" onsubmit="return validasi_distribusi_proposal();">

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

                                                                     WHERE proposal_tahap_final.TAHUN='".$_SESSION['tahun_aktif']."' and proposal_tahap_final.SMT='".$_SESSION['semester_aktif']."' and proposal_tahap_final.STATUS='diterima' order by proposal_tahap_final.nim ");

                                        $jumlah=mysqli_num_rows($sql);

                        ?>

                        <input type="hidden" name="jumlah_data_pengajuan" value="<?php echo $jumlah;?>" id="jumlah_data_pengajuan">

                        <div class="panel-body">

                            <table id="tabel_distribusi" class="table table-striped table-bordered">

                                <thead>

                                    <tr>

                                        <th>No</th>

                                        <th>NIM</th>

                                        <th>Nama Mahasiswa</th>

                                        <th>Judul</th>

                                        <th>Kelompok Keilmuan</th>

                                        <th>Calon Pembimbing Pilihan</th>

                                        <th>Calon Pembimbing Usulan</th>

                                        <th>Tema</th>

                                        <th>Jenis Proposal</th>

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

                                                     <td><?php echo $no;?></td>

                                                      <input type="hidden" value="<?php echo $r['kd_pro_thp_final']?>" name="idx_<?php echo $no?>">

                                                        <td><?php echo $r['NIM'];?></td>

                                                        <td><?php echo $r['NAMA'];?></td>

                                                        <td><?php echo $r['JUDUL'];?></td>

                                                        <td><?php echo $r['KELOMPOKKEILMUAN'];?></td>

                                                        <td><?php echo $r['nip'].' <br>'.$r['nama_dosen'];?></td>

                                                 <?php

                                                    echo "<td><select name='nip_pilih_$no' class='form-control'>";

                                                        $tampil=mysqli_query($server1,"SELECT * FROM ref_dosen where jabatan='dosen' order by nama asc");

                                                        while($w = mysqli_fetch_array($tampil))

                                                        {

                                                          if ($r['kddosen']==$w['kddosen'])

                                                          {

                                                            echo "<option value=$w[kddosen] selected>$w[nama]</option>";

                                                          }

                                                          else

                                                          {

                                                            echo "<option value=$w[kddosen]>$w[nama]</option>";

                                                          }

                                                        }

                                                         echo "</select></td>";

                                                    ?>

                                               

                                                    

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

</div>

            <!-- end row -->