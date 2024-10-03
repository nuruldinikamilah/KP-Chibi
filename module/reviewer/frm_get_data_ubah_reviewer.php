<?php
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";

if ($_POST['act']=='ubah')
{
  $data_id = my_simple_crypt($_POST['data_id'], 'd' );
  $sql_get_data=mysqli_query($server1,"SELECT
                                            *,GROUP_CONCAT(c.`kode_kategori_bidang_penelitian_simlitabmas`) AS list_data
                                            FROM
                                            `reviewer` a
                                            INNER JOIN
                                             `reviewer_kat_bid_penelitian` b
                                            INNER JOIN
                                              `ref_kategori_bidang_penelitian_simlitabmas` c
                                             ON a.`nip_reviewer` = b.`nip_reviewer` AND
                                                b.`kode_kategori_bidang_penelitian_simlitabmas` = c.`kode_kategori_bidang_penelitian_simlitabmas`
                                             WHERE a.`nip_reviewer`= '".$data_id."'");
   $rs=mysqli_fetch_array($sql_get_data);
   $list_data=$rs['list_data'];
   $list_data=explode(',', $list_data);

  ?>
 <form action="module/reviewer/frm_get_data_ubah_reviewer_proses.php" method="post">
                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>NIP </b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b>
                            <?php echo $rs['nip_reviewer'];?>
                            <input type='hidden' id='nip_calon_reviewer' value='<?php echo $data_id;?>' name='nip_calon_reviewer'>
                        </b></label>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nama </b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b><?php echo $rs['nama_reviewer'];?></b></label>
                        <input type='hidden' id='nama_calon_reviewer' value='<?php echo $_POST['nama_reviewer'];?>' name='nama_calon_reviewer'> 
                    </td>
                 </tr>
                 
                 <tr>
                    <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Kategori Bidang Penelitian </b></label>
                     </td>
                      <td class="text-left" style="width: 20%">
                        <label for=""><b>
                       <?php
                      $sql=mysqli_query($server1,"select * from ref_kategori_bidang_penelitian_simlitabmas order by nama asc");
                     $no=1;
                     while($r=mysqli_fetch_array($sql))
                     {
                       
                        ?>
                        <input type="checkbox" name="pilihan[]" 
                        <?php if (in_array($r['kode_kategori_bidang_penelitian_simlitabmas'], $list_data)) 
                            {
                                echo "value='$r[kode_kategori_bidang_penelitian_simlitabmas]' checked";
                            }
                            else
                            {
                               echo "value='$r[kode_kategori_bidang_penelitian_simlitabmas]'";
                            }
                        ?>>
                        <?php echo $r['nama'];?><br>
                        <?php
                     }
                        ?>
                    </td>
                    </label>
                 </tr>
                  <tr>
                    <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Status Reviewer</b></label>
                     </td>
                      <td class="text-left" style="width: 20%">
                        <label for=""><b>
                      
                        <input type="checkbox" name="status" 
                        <?php if ($rs['status']=='1') 
                            {
                                echo "value='1' checked";
                            }
                            else
                            {
                               echo "value='0'";
                            }
                        ?>>
                        <?php
                            if ($rs['status']=='1')
                            {
                                $status_cap = 'Aktif';
                            } 
                            else
                            {
                                $status_cap = 'Tidak Aktif';
                            }
                            echo $status_cap;
                        ?><br>
                    </td>
                    </label>
                 </tr>
             </tbody>
            </table>


            <!-- Modal Footer -->
                    <div class="modal-footer"><center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit"  name="submit">Ubah Reviewer</button>
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


