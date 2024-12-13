<?php
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";
include "../../config/f_rupiah.php";  

if ($_POST['act']=='validasi_reviewer')
{
  $data_id = my_simple_crypt($_POST['data_id'], 'd' );
  $sql_get_data=mysqli_query($server1,"SELECT
                                              a.idx_penelitian,
                                              a.judul_penelitian,
                                              a.dekripsi_penelitian,
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
                                               a.nilai_keseluruhan_proposal,
                                              a.tgl_insert,
                                              a.tgl_update,
                                              a.nip_reviewer,
                                              a.skema,
                                              a.nip_pengisi_reviewer,
                                              a.catatan_reviewer,
                                              a.status_pengajuan,
                                              b.nama AS nama_rumpun_ilmu,
                                              c.nama AS nama_kategori_penelitian,
                                              d.nama AS nama_bidang_penelitian,
                                              reviewer.nama_reviewer
                                              FROM
                                              pengajuan_penelitian AS a
                                              INNER JOIN ref_kelompok_bidang AS b
                                              INNER JOIN ref_bidang_penelitian_simlitabmas AS c
                                              INNER JOIN ref_kategori_bidang_penelitian_simlitabmas AS d ON a.id_ref_kelompok_bidang = b.id AND a.id_ref_bidang_penelitian = c.kode_bidang_penelitian_simlitabmas AND a.id_ref_kategori_bidang = d.kode_kategori_bidang_penelitian_simlitabmas
                                              LEFT JOIN reviewer ON reviewer.nip_reviewer = a.nip_reviewer
                                             WHERE a.`idx_penelitian`= '".$data_id."'  ORDER BY a.`status_pengajuan`, a.`idx_penelitian` DESC");
   $rs=mysqli_fetch_array($sql_get_data);

  ?>
 <form action="module/dir_lppm/get_data_validasi_pengajuan_submit.php" method="post">
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
                         <label for=""><b>Nama Reviewer</b></label>
                        </td>
                        <td style="text-align: left">
                               <span class="text-primary"><?php echo $rs['nama_reviewer'];?></span>
                        </td>
                  </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Skema Penelitian</b></label>
                        </td>
                        <td style="text-align: left">
                               <span class="text-primary"><?php echo ucwords($rs['skema']);?></span>
                        </td>
                  </tr>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nilai Proposal</b></label>
                        </td>
                        <td style="text-align: left">
                          <?php
                             if ($rs['nilai_keseluruhan_proposal']!='')
                             {
                                ?>
                                  <span class="text-primary"><?php echo $rs['nilai_keseluruhan_proposal'];?></span>
                                <?php
                             }
                             else
                            {
                              ?>
                               <span class="blink"><font color="red"><b>Reviewer Belum Menilai</b></blink></span>
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
                         <label for=""><b>Komentar Reviewer</b></label>
                        </td>
                        <td style="text-align: left">
                               <textarea class="form-control" cols="80" rows="5" name="catatan" id="catatan" readonly="readonly"><?php echo $rs['catatan_reviewer']?></textarea>
                        </td>
                  </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Pilih Status Proposal</b></label>
                        </td>
                        <td style="text-align: left" id="tdpengajuan">
                        <input type="hidden" name="status_pengajuan_pilih" id="status_pengajuan_pilih" value="<?php 
                         if (isset($rs['status_pengajuan'])){echo $rs['status_pengajuan'];}
                        ?>
                        ">
                              <?php
                              if ($rs['status_pengajuan']!='')
                              {
                                    echo "<select name='status_pengajuan_pilih' class='form-control'>";
                                    if ($rs['status_pengajuan']=='diterima')
                                    {
                                      echo "<option value='diterima' selected>Diterima</option>";
                                      echo "<option value='ditolak'>Ditolak</option>";
                                    }
                                    else if  ($rs['status_pengajuan']=='ditolak')
                                    {
                                      echo "<option value='diterima'>Diterima</option>";
                                      echo "<option value='ditolak' selected>Ditolak</option>";
                                    }
                                    else if  ($rs['status_pengajuan']=='diperiksa')
                                    {
                                      echo "<option value='diterima' selected>Diterima</option>";
                                      echo "<option value='ditolak'>Ditolak</option>";
                                    }
                                  echo "</select>";  
                              }
                              else
                              {
                                ?>
                               <span class="blink"><font color="red"><b>Reviewer Belum Menilai</b></blink></span>
                               <?php
                              }
                              ?>
                        </td>
                  </tr>
                </tbody>
            </table>
            <!-- Modal Footer -->
                    <div class="modal-footer"><center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <?php
                           if ($rs['nilai_keseluruhan_proposal']!='')
                          {
                            ?>
                              <button class="btn btn-primary" type="submit"  name="submit">Simpan</button>
                            <?php
                          }
                          else
                          {
                              ?>
                              <button class="btn btn-danger" type="submit"  name="submit" disabled>Simpan</button>
                            <?php
                          }
                        ?>



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


