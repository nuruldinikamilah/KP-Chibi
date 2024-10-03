<script>
    function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 1000);
</script>

<?php
  if ($_GET['act2']=='exp')
  {
    ?><!-- begin row -->
      <div class="row">
          <!-- begin col-6 -->
          <div class="col-md-12">
                        <div class="panel-body">
              <div class="alert alert-danger fade in m-b-15">
               <center><h3><strong>PESAN!</strong></h3><hr>
               <h5>Dosen Hanya Di Izinkan Mengajukan Usulan Satu Kali Sebagai Ketua Atau Anggota</h5></center>
                <span class="close" data-dismiss="alert">&times;</span></center>
              </div>
                    </div>
                  </div>
    <?php
  }
?>



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
                <h4 class="panel-title">Usulan Pengabdian Di Daftarkan</h4>
            </div>
            

          <br><br>
          <!--<table class="table table-hover table-bordered text-center">-->
          <table class="table table-striped">
              <thead>
                <tr><th width="5%">No.</th><th width="8%">Tahun Pengajuan</th><th width="15%">Judul</th><th>Personil Pengabdian</th><th width="10%">Rumpun Pengabdian</th><th>Dana</th><th>File Proposal</th><th>Status Proposal</th><th>&nbsp;</th></tr>
                 </thead>
                    <tbody>
                        <?php
                     $sql_data_master=mysqli_query($server1,"SELECT 
                                                              *,
                                                              b.`nama` AS nama_rumpun_ilmu,
                                                              c.`nama` AS nama_kategori_penelitian,
                                                              d.`nama` AS nama_bidang_penelitian 
                                                            FROM
                                                              `pengajuan_anggota_pengabdian` e 
                                                              INNER JOIN pengajuan_pengabdian a 
                                                              INNER JOIN ref_kelompok_bidang b 
                                                              INNER JOIN `ref_bidang_penelitian_simlitabmas` c 
                                                              INNER JOIN `ref_kategori_bidang_penelitian_simlitabmas` d 
                                                                ON a.`idx_pengabdian` = e.`idx_pengabdian` 
                                                                AND a.`id_ref_kelompok_bidang` = b.`id` 
                                                                AND a.`id_ref_bidang_penelitian` = c.`kode_bidang_penelitian_simlitabmas` 
                                                                AND a.`id_ref_kategori_bidang` = d.`kode_kategori_bidang_penelitian_simlitabmas` WHERE e.`nip_anggota`='".$_SESSION['nik_user']."' ORDER BY e.`idx_pengabdian` DESC");
                    
                     $jumlah=mysqli_num_rows($sql_data_master);
                     if ($jumlah == 0)
                     {
                       $sql_data_master=mysqli_query($server1,"SELECT
                                                              *
                                                              FROM
                                                              v_pengajuan_pengabdian
                                                              WHERE nip_anggota='".$_SESSION['nik_user']."'");
                     }
                     else
                     {
                      $sql_data_master=mysqli_query($server1,"SELECT
                                                              *
                                                              FROM
                                                              v_pengajuan_pengabdian
                                                              WHERE nip_anggota='".$_SESSION['nik_user']."'");
                     }
                      

                     $no=1;
                     while($r=mysqli_fetch_array($sql_data_master))
                     {
                        $idx_enc=my_simple_crypt($r['idx_pengabdian'], 'e' );
                        ?>
                        <tr id=tr<?php echo $idx_enc;?>>
                            <td><?php echo $no;?></td>
                            <td><?php echo $r['tahun_pengajuan'];?></td>
                            <td><?php echo $r['judul_pengabdian'];?></td>
                             <!--Tampil Anggota Peneliti-->
                            <td>
                                <?php
                                    $sql_anggota=mysqli_query($server1,"select * from pengajuan_anggota_pengabdian where idx_pengabdian=".$r['idx_pengabdian']." order by status_peneliti desc");
                                        $jumlah_anggota=mysqli_num_rows($sql_anggota);
                                        if ($jumlah_anggota>0)
                                        {
                                             while($r_anggota=mysqli_fetch_array($sql_anggota))
                                             {
                                                ?>
                                                  <span class="text-primary"><?php echo $r_anggota['nama_peneliti'];?></span>
                                                  <br>Status: <?php echo $r_anggota['status_peneliti'];?><br><br>
                                                <?php
                                             }
                                              $form_peneliti=1;
                                        }
                                        else
                                        {
                                                ?>
                                                <span class="blink"><font color="red"><b>Form peneliti belum diisi</b></font></span>
                                                <?php
                                                $form_peneliti=0;
                                        }
                                ?>
                             </td>
                           <!--End Tampil Anggota Peneliti-->

                           <td>
                                Rumpun Ilmu: <span class="text-info"><?php echo $r['nama_rumpun_ilmu'];?></span><br>
                                <br>Bidang Kategori : <span class="text-info"><?php echo $r['nama_kategori_penelitian'];?></span><br>
                                <br>Bidang Penelitian : <span class="text-info"><?php echo $r['nama_bidang_penelitian'];?></span> <br><br>Skema Penelitian : <span class="text-info"><?php echo ucwords($r['skema']);?></span>
                            </td>
                            <td style="text-align: left">
                                <?php
                                    $sql_dana=mysqli_query($server1,"SELECT
                                                            *,SUM(nominal_dana_pengajuan) AS jumlah_pengajuan
                                                            FROM
                                                            `pengajuan_dana_pengabdian` 
                                                            WHERE `idx_pengabdian` = ".$r['idx_pengabdian']."
                                                            GROUP BY `idx_pengabdian`");
                                        $jumlah_dana=mysqli_num_rows($sql_dana);
                                        if ($jumlah_dana>0)
                                        {
                                             while($r_dana=mysqli_fetch_array($sql_dana))
                                             {
                                                ?>Rp. <?php echo rupiah($r_dana['jumlah_pengajuan']);?>
                                                <?php
                                             }
                                             $form_dana=1;
                                        }
                                        else
                                        {
                                               ?>
                                                <span class="blink"><font color="red"><b>Form pengajuan dana belum diisi</b></font></span>
                                                <?php
                                                 $form_dana=0;
                                        }
                                ?>
                            </td>
                              <?php
                                 if ($r['dokumen_proposal']!='')
                                {
                                  ?>
                                  <td><b><a href="<?php echo "dokumen_upload_pengabdian/".$r['dokumen_proposal'];?>" download>File Berhasil Diupload</a></span>
                                  <?php
                                    $form_proposal=1;
                                }
                                else
                                {
                                  ?>
                                  <td><span class="blink"><font color="red"><b>File Belum Diupload</b></blink></span>
                                  <?php
                                  $form_proposal=0;
                                }
                              ?>
                            <?php
                              
                              $judul_pengabdian = str_replace(' ', '_', $r['judul_pengabdian']);
                            ?>
                              <?php
                               if ($r['status_pengajuan']!='')
                              {
                                ?>
                                <td><span class="text-bold"><?php echo ucfirst($r['status_pengajuan']);?></span>
                                <?php
                              }
                              else if (($form_peneliti==0)|| ($form_dana==0) || ($form_proposal==0) || ($r['validasi_proposal_pengguna']!='y'))
                              {
                                ?>
                                  <td><span class="blink"><font color="red"><b>Belum Lengkap</b></blink></span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <td><span class="blink"><font color="red"><b>Diajukan</b></blink></span>
                                <?php
                              }
                            ?>  
                             <td>
                              <a href="<?php echo "view.php?menu=pengabdian&act=usulan_baru_langkah_satu&idx=".$idx_enc;?>" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-edit"></i>&nbsp;Ubah
                              </a>


                              <?php
                                //cek jika sudah divalidasi
                                if ((isset($r['validasi_proposal_pengguna']))||(isset($r['nilai_keseluruhan_proposal'])))
                                {
                                    ?>
                                     <a href="#"  class="hps<?php echo $idx_enc;?> btn btn-danger btn-sm m-r-5" disabled>&nbsp;<i class="fa fa-ban"></i>Hapus</a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                     <a href="#"  class="hps<?php echo $idx_enc;?> btn btn-danger btn-sm m-r-5" data-toggle="modal" data-target="#hapus-pengajuan-proposal_pengabdian" <?php echo $var_disabled;?> id=<?php echo "hapus|".$idx_enc."|".$judul_pengabdian;?>>&nbsp;<i class="fa fa-ban"></i>Hapus</a>
                                    <?php
                                }

                                ?>


                                <?php
                                //cek jika sudah divalidasi
                                if ((isset($r['validasi_proposal_pengguna']))||(isset($r['nilai_keseluruhan_proposal'])))
                                {
                                    ?>
                                     <a href="#"  class="btl<?php echo $idx_enc;?> btn btn-warning btn-sm m-r-5" disabled>&nbsp;<i class="fa fa-mail-reply"></i>&nbsp;Batalkan</a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="#"  class="btl<?php echo $idx_enc;?> btn btn-warning btn-sm m-r-5" data-toggle="modal" data-target="#batal-pengajuan-proposal_pengabdian" <?php echo $var_disabled;?> id=<?php echo "batal|".$idx_enc."|".$judul_pengabdian;?>>&nbsp;<i class="fa fa-mail-reply"></i>&nbsp;Batalkan</a>
                                    <?php
                                }

                                ?>

                             
                              </tr>
                        </tr>
                        <td colspan="7" class="info"></td>
                        <!--<td colspan="7" class="info">
                                <b>Dokumen Penugasan</b>: <span class="text-danger">Belum Diupload</span> / 
                                <b>Dokumen Capaian</b>: <span class="text-danger">Belum Diupload</span> / 
                                <b>Dokumen Makalah</b>: <span class="text-danger">Belum Diupload</span></td>-->
                        <?php
                        $no++;
                     }
                        ?>
                    </tbody>
            </table>
            <!-- end panel -->
        </div>
        
    </div>
    <!-- end row -->


