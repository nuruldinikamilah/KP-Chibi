<?php
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";
include "../../config/f_rupiah.php";  

if ($_POST['act']=='pemetaan_reviewer')
{
  $data_id = my_simple_crypt($_POST['data_id'], 'd' );
  $sql_get_data=mysqli_query($server1,"SELECT
                                                                *,
                                                                  b.`nama` AS nama_rumpun_ilmu,
                                                                  c.`nama` AS nama_kategori_penelitian,
                                                                  d.`nama` AS nama_bidang_penelitian
                                                                FROM 
                                                                   pengajuan_penelitian a
                                                                INNER JOIN
                                                                   `ref_kelompok_bidang` b
                                                                INNER JOIN
                                                                   `ref_bidang_penelitian_simlitabmas` c
                                                                INNER JOIN
                                                                    `ref_kategori_bidang_penelitian_simlitabmas` d
                                                                ON a.`id_ref_kelompok_bidang` = b.`id` AND
                                                                   a.`id_ref_bidang_penelitian` = c.`kode_bidang_penelitian_simlitabmas` AND
                                                                   a.`id_ref_kategori_bidang` = d.`kode_kategori_bidang_penelitian_simlitabmas`
                                             WHERE `idx_penelitian`= '".$data_id."'");
   $rs=mysqli_fetch_array($sql_get_data);

  ?>
 <form action="module/pengajuan/frm_get_data_pemetaan_reviewer_submit.php" method="post">
  <input type="hidden" value="<?php echo $data_id;?>" name="idx_penelitian">
                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Tahun Pengajuan</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                       <b>
                            <?php echo $rs['tahun_pengajuan'];?>
                            
                        </b>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Judul</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                       <b>
                            <?php echo $rs['judul_penelitian'];?>
                            
                        </b>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Personil Penelitian</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <b>
                           <?php
                                    $sql_anggota=mysqli_query($server1,"select * from pengajuan_anggota_penelitian where idx_penelitian=".$data_id." order by status_peneliti desc");
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
                                        }
                                        else
                                        {
                                                ?>
                                                <span class="blink"><font color="red"><b>Tahapan peneliti belum diisi</b></font></span>
                                                <?php
                                        }
                                ?>
                        </b>
                    </td>
                 </tr>
                 <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Rumpun Penelitian</b></label>
                        </td>
                        <td class="text-left" style="width: 20%">
                             <b>Rumpun Ilmu : </b><span class="text-info"><?php echo $rs['nama_rumpun_ilmu'];?></span><br>
                                <br>
                                <b>Bidang Kategori : </b><span class="text-info"><?php echo $rs['nama_kategori_penelitian'];?></span><br>
                                <br>
                                <b>Bidang Penelitian : </b><span class="text-info"><?php echo $rs['nama_bidang_penelitian'];?></span>
                            </td>
                  </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Dana Pengajuan</b></label>
                        </td>
                        <td style="text-align: left">
                                <?php
                                    $sql_dana=mysqli_query($server1,"SELECT
                                                            *,SUM(nominal_dana_pengajuan) AS jumlah_pengajuan
                                                            FROM
                                                            `pengajuan_dana_penelitian` 
                                                            WHERE `idx_penelitian` = ".$data_id."
                                                            GROUP BY `idx_penelitian`");
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
                  </tr>
                   <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>File Proposal</b></label>
                        </td>
                        <td style="text-align: left">
                               <a href="<?php echo "dokumen_upload/".$rs['dokumen_proposal'];?>" download type="application/pdf">Download File Proposal</a>
                        </td>
                  </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Pilih Reviewer</b></label>
                        </td>
                        <td style="text-align: left">
                        <input type="hidden" name="nip_reviewer_lama" value="<?php 
                         if (isset($rs['nip_reviewer'])){echo $rs['nip_reviewer'];}
                        ?>
                        ">
                              <?php
                              if ($rs['nip_reviewer']!='')
                              {
                                 echo "<select name='nip_pilih' class='form-control'>";
                                    $tampil=mysqli_query($server1,"SELECT * FROM reviewer where status='1' order by nama_reviewer asc");
                                    while($w = mysqli_fetch_array($tampil))

                                    {

                                      if ($rs['nip_reviewer']==$w['nip_reviewer'])
                                      {

                                        echo "<option value=$w[nip_reviewer] selected>$w[nama_reviewer]</option>";

                                      }
                                      else

                                      {
                                        echo "<option value=$w[nip_reviewer]>$w[nama_reviewer]</option>";

                                      }
                                    }
                                     echo "</select>"; 
                              }
                              else
                              {
                                      echo "<select name='nip_pilih' class='form-control'>";
                                     echo "<option value=''>-Pilih Reviewer-</option>";
                                    $tampil=mysqli_query($server1,"SELECT * FROM reviewer where status='1' order by nama_reviewer asc");
                                    while($w = mysqli_fetch_array($tampil))
                                    {
                                        echo "<option value=$w[nip_reviewer]>$w[nama_reviewer]</option>";
                                    }
                                     echo "</select>";
                                }
                                  ?>
                        </td>

                  </tr>
                </tbody>
            </table>
            <!-- Modal Footer -->
                    <div class="modal-footer"><center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit"  name="submit">Simpan</button>
                    </div>
  </form>

  <?php
}
else
{
        ?>
            <center><h5>Hayo Mau Ngapain</h5></center>
        <?php
}
?>


