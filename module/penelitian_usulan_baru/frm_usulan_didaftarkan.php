<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>

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
               <h5>Dosen Hanya Di Izinkan Mengajukan Usulan Satu Kali Sebagai Ketua Atau Anggota</h5>
               <h5>Tahun Pengajuan : <?php echo date("Y");?></h5></center>
                <span class="close" data-dismiss="alert">&times;</span></center>
              </div>
                    </div>
                  </div>
    <?php
  }
?>

<?php
if(isset($_GET['status'])) 
{
    
   if ($_GET['status']=='sukses')
    {
                            ?>
                           <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-sukses-menilai-reviewer').modal('show');
                                    });
                            </script>
                            <?php
    }
   else if ($_GET['status']=='gagal')
   {
                            ?>
                           <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-gagal-db').modal('show');
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
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>

                <h4 class="panel-title">Usulan Penelitian Di Daftarkan</h4>
            </div>
            <div class="panel-body">
      
          
                <table id="tabel_distribusi" class="table table-striped table-bordered">
                    <thead>
                    <tr><th>&nbsp;</th><th width="8%">Tahun Pengajuan</th><th width="15%">Judul</th><th>Personil Penelitian</th><th>Penelitian</th><th>Dana</th><th>File Proposal</th><th>Status Proposal</th><th>Catatan Reviewer</th><th>Verifikasi Kaprodi</th><th>Verifikasi Dekan</th></tr>
                    </thead>
                    <tbody>
                         <?php
                     $sql_data_master=mysqli_query($server1,"SELECT 
                                                              *,
                                                              b.`nama` AS nama_rumpun_ilmu,
                                                              c.`nama` AS nama_kategori_penelitian,
                                                              d.`nama` AS nama_bidang_penelitian 
                                                            FROM
                                                              `pengajuan_anggota_penelitian` e 
                                                              INNER JOIN pengajuan_penelitian a 
                                                              INNER JOIN ref_kelompok_bidang b 
                                                              INNER JOIN `ref_bidang_penelitian_simlitabmas` c 
                                                              INNER JOIN `ref_kategori_bidang_penelitian_simlitabmas` d 
                                                                ON a.`idx_penelitian` = e.`idx_penelitian` 
                                                                AND a.`id_ref_kelompok_bidang` = b.`id` 
                                                                AND a.`id_ref_bidang_penelitian` = c.`kode_bidang_penelitian_simlitabmas` 
                                                                AND a.`id_ref_kategori_bidang` = d.`kode_kategori_bidang_penelitian_simlitabmas` WHERE e.`nip_anggota`='".$_SESSION['nik_user']."' ORDER BY e.`idx_penelitian` DESC");
                    
                     $jumlah=mysqli_num_rows($sql_data_master);
                     if ($jumlah == 0)
                     {
                       $sql_data_master=mysqli_query($server1,"SELECT 
                                                              *,
                                                              b.`nama` AS nama_rumpun_ilmu,
                                                              c.`nama` AS nama_kategori_penelitian,
                                                              d.`nama` AS nama_bidang_penelitian 
                                                            FROM
                                                               pengajuan_penelitian a 
                                                              INNER JOIN ref_kelompok_bidang b 
                                                              INNER JOIN `ref_bidang_penelitian_simlitabmas` c 
                                                              INNER JOIN `ref_kategori_bidang_penelitian_simlitabmas` d 
                                                                ON a.`id_ref_kelompok_bidang` = b.`id` 
                                                                AND a.`id_ref_bidang_penelitian` = c.`kode_bidang_penelitian_simlitabmas` 
                                                                AND a.`id_ref_kategori_bidang` = d.`kode_kategori_bidang_penelitian_simlitabmas` WHERE a.`nip_pengisi`='".$_SESSION['nik_user']."'");
                     }
                     else
                     {
                      $sql_data_master=mysqli_query($server1,"SELECT
                                                              *
                                                              FROM
                                                              v_pengajuan_penelitian
                                                              WHERE nip_anggota='".$_SESSION['nik_user']."' order by idx_penelitian desc");
                     }
                      

                     $no=1;
                     while($r=mysqli_fetch_array($sql_data_master))
                     {
                        $idx_enc=my_simple_crypt($r['idx_penelitian'], 'e' );
                        ?>
                       <tr id=tr<?php echo $idx_enc;?>>
                          <td> 
                            <a href="<?php echo "view.php?menu=penelitian&act=usulan_baru_langkah_satu&idx=".$idx_enc;?>" class="btn btn-primary btn-sm m-r-5"><i class="fa fa-edit"></i>&nbsp;Ubah
                              </a>
                            <?php
                            if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
                              $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
                            } else if (isset($_SESSION['nik_user']) && ($_SESSION['nik_user'] == '41277006134' || $_SESSION['nik_user'] == '412770002')) {
                                $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
                            }
                            
                            // Execute the query
                            $sql = mysqli_query($server1, $query);
                            $index = 1;
                            while ($row = mysqli_fetch_array($sql)) {
                                $file_path = "dokumen_bukti_verifikasi/pdf/" . $row['dokumen_lembar_pengesahan'];
                                $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                                $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
  
                                $button_label = 'Download';
                                $button_class = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? 'button' : 'button disabled';
                                $button_action = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? "href='$file_path'" : '';
                                ?>
                                <a class="btn btn-primary btn-sm m-r-5" <?php echo $button_action; ?>><?php echo $button_label; ?></a>
                            <?php } ?>

                              <?php
                                //cek jika sudah divalidasi
                                if ((isset($r['validasi_proposal_pengguna']))||(isset($r['nilai_keseluruhan_proposal'])))
                                {
                                    ?>
                                     <a href="#"  class="btn btn-danger btn-sm m-r-5" disabled>&nbsp;<i class="fa fa-ban"></i>Hapus</a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                     <a href="#"  class="btn btn-danger btn-sm m-r-5" data-toggle="modal" data-target="#hapus-pengajuan-proposal" <?php echo $var_disabled;?> id=<?php echo "hapus|".$idx_enc."|".$judul_penelitian;?>>&nbsp;<i class="fa fa-ban"></i>Hapus</a>
                                    <?php
                                }
                              ?>
                            </td>
                          <td><?php echo $r['tahun_pengajuan'];?></td>
                          <td><?php echo $r['judul_penelitian'];?></td>
                           <!--Tampil Anggota Peneliti-->
                            <td>
                                <?php
                                    $sql_anggota=mysqli_query($server1,"select * from pengajuan_anggota_penelitian where idx_penelitian=".$r['idx_penelitian']." order by status_peneliti desc");
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

                          <td>
                            <?php
                                    $sql_dana=mysqli_query($server1,"SELECT
                                                            *,SUM(nominal_dana_pengajuan) AS jumlah_pengajuan
                                                            FROM
                                                            `pengajuan_dana_penelitian` 
                                                            WHERE `idx_penelitian` = ".$r['idx_penelitian']."
                                                            GROUP BY `idx_penelitian`");
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
                          <td>
                            <?php
                                 if ($r['dokumen_proposal']!='')
                                {
                                  ?>
                                  <b><a href="<?php echo "dokumen_upload/".$r['dokumen_proposal'];?>" download>File Berhasil Diupload</a></span>
                                  <?php
                                    $form_proposal=1;
                                }
                                else
                                {
                                  ?>
                                  <span class="blink"><font color="red"><b>File Belum Diupload</b></blink></span>
                                <?php
                                   $form_proposal=0;
                                }
                                ?>
                          </td>
                          <td>
                            <?php
                              $judul_penelitian = str_replace(' ', '_', $r['judul_penelitian']);
                            ?>
                            <?php
                               if ($r['status_pengajuan']!='')
                              {
                                ?>
                                <span class="text-bold"><?php echo ucfirst($r['status_pengajuan']);?></span>
                                <?php
                              }
                              else if (($form_peneliti==0)|| ($form_dana==0) || ($form_proposal==0) || ($r['validasi_proposal_pengguna']!='y'))
                              {
                                ?>
                                  <span class="blink"><font color="red"><b>Belum Lengkap</b></blink></span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <span class="blink"><font color="red"><b>Diajukan</b></blink></span>
                              <?php
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                                if (isset($r['catatan_reviewer']))
                                {
                                   echo $r['catatan_reviewer'];
                                }
                                else
                                {
                                   ?>
                                   <span class="blink"><font color="red"><b>Diajukan</b></blink></span>
                                   <?php
                                }
                            ?>
                          </td>
                          <?php
                          if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
                            $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
                          } else if (isset($_SESSION['nik_user']) && ($_SESSION['nik_user'] == '41277006134' || $_SESSION['nik_user'] == '412770002')) {
                              $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
                          }
                          
                          // Execute the query
                          $sql = mysqli_query($server1, $query);
                          $index = 1;
                          while ($row = mysqli_fetch_array($sql)) {
                              $file_path = "dokumen_bukti_verifikasi/pdf/" . $row['dokumen_lembar_pengesahan'];
                              $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                              $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';

                              $button_label = 'Download';
                              $button_class = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? 'button' : 'button disabled';
                              $button_action = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? "href='$file_path'" : '';
                              ?>
                                  <td><?php echo $kaprodi_signature; ?></td>
                                  <td><?php echo $dekan_signature; ?></td>
                          <?php } ?>
                          </tr>
                        <?php
                        $no++;
                     }
                        ?>
            </tbody>
          </table>
          <hr />
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->

