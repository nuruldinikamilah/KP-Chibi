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

                <h4 class="panel-title">Daftar Pengajuan Proposal Pengabdian Internal Tahun <?php echo date("Y"); ?>&nbsp; Reviewer <?php echo $_SESSION['nama_user']; ?></h4>
            </div>
            <div class="panel-body">
      
          
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                       <tr><th width="5%">No.</th><th width="10%">Tahun Pengajuan</th><th width="20%">Judul</th><th>Rumpun Pengabdian</th><th>Dana Pengajuan</th><th>Status Pengajuan</th><th>Skema Pengabdian</th><th>Nilai Proposal</th><th>&nbsp;</th></tr>
                    </thead>
                    <tbody>
                       <?php
                     $sql_data_master=mysqli_query($server1,"SELECT
                                              a.idx_pengabdian,
                                              a.judul_pengabdian,
                                              a.dekripsi_pengabdian,
                                              a.id_ref_kelompok_bidang,
                                              a.id_ref_kategori_bidang,
                                              a.id_ref_bidang_penelitian,
                                              a.nip_pengisi,
                                              a.nama_pengisi,
                                              a.email_pengisi,
                                              a.tahun_pengajuan,
                                              a.semester_pengajuan,
                                              a.status_pengajuan,
                                              a.dokumen_proposal,
                                              a.tgl_insert,
                                              a.tgl_update,
                                              a.nip_reviewer,
                                              a.skema,
                                              a.nilai_keseluruhan_proposal,
                                              a.nip_pengisi_reviewer,
                                              b.nama AS nama_rumpun_ilmu,
                                              c.nama AS nama_kategori_penelitian,
                                              d.nama AS nama_bidang_penelitian,
                                              reviewer.nama_reviewer
                                              FROM
                                              pengajuan_pengabdian AS a
                                              INNER JOIN ref_kelompok_bidang AS b
                                              INNER JOIN ref_bidang_penelitian_simlitabmas AS c
                                              INNER JOIN ref_kategori_bidang_penelitian_simlitabmas AS d ON a.id_ref_kelompok_bidang = b.id AND a.id_ref_bidang_penelitian = c.kode_bidang_penelitian_simlitabmas AND a.id_ref_kategori_bidang = d.kode_kategori_bidang_penelitian_simlitabmas
                                              LEFT JOIN reviewer ON reviewer.nip_reviewer = a.nip_reviewer where
                                              a.`nip_reviewer` = '".$_SESSION['nik_user']."' 
                                               ORDER BY idx_pengabdian DESC
                                                                   ");
                     $no=1;
                     while($r=mysqli_fetch_array($sql_data_master))
                     {
                        $idx_enc=my_simple_crypt($r['idx_pengabdian'], 'e' );
                        ?>
                        <tr id=tr<?php echo $idx_enc;?>>
                            <td><?php echo $no;?></td>
                            <td><?php echo $r['tahun_pengajuan'];?></td>
                            <td><?php echo $r['judul_pengabdian'];?></td>
                            

                           <td>
                                Rumpun Ilmu: <span class="text-info"><?php echo $r['nama_rumpun_ilmu'];?></span><br>
                                <br>Bidang Kategori : <span class="text-info"><?php echo $r['nama_kategori_penelitian'];?></span><br>
                                <br>Bidang Penelitian <span class="text-info"><?php echo $r['nama_bidang_penelitian'];?></span><br><br>Skema Penelitian : <span class="text-info"><?php echo ucwords($r['skema']);?></span>
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
                                        }
                                        else
                                        {
                                               ?>
                                                <span class="blink"><font color="red"><b>Tahapan pengajuan dana belum diisi</b></font></span>
                                                <?php
                                        }
                                ?>
                            </td>
                            <?php
                               if ($r['status_pengajuan']!='')
                              {
                                ?>
                                <td><span class="text-bold"><?php echo ucfirst($r['status_pengajuan']);?></span>
                                <?php
                              }
                              else
                              {
                                ?>
                                <td><span class="blink"><font color="red"><b>Reviewer Belum Mengisi</b></blink></span>
                                <?php
                              }
                            ?>
                               
                            </td>
                            <td><?php echo ucwords($r['skema']);?></td>
                            </td>
                            <?php
                               if ($r['nilai_keseluruhan_proposal']!='')
                              {
                                ?>
                                <td><span class="text-bold"><?php echo $r['nilai_keseluruhan_proposal'];?></span>
                                <?php
                              }
                              else
                              {
                                  ?>
                                  <td><span class="blink"><font color="red"><b>Reviewer Belum Menilai</b></blink></span>
                                  <?php
                              }
                            ?>
                               
                            </td>
                            <?php
                              $judul_penelitian = str_replace(' ', '_', $r['judul_pengabdian']);
                            ?>
                             <td>
                                <button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="modal" data-target="#pengajuan_koreksi_pengabdian"  id=<?php echo "pengajuan_koreksi_pengabdian|".$idx_enc?>><i class="fa fa-external-link"></i></button> 
                        </tr>
                        <td colspan="10" class="info"></td>
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
          <hr />
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-10 -->
</div>
<!-- end row -->

