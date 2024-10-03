<?php
include "../../config/koneksi.php";

    if ($_POST['act']=='ditemukan')
    {
        ?>
        <form action="module/reviewer/frm_tambah_reviewer_proses.php" method="post">
                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>NIP </b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b>
                            <?php echo $_POST['kata_kunci'];?>
                            <input type='hidden' id='nip_calon_reviewer' value='<?php echo $_POST['kata_kunci'];?>' name='nip_calon_reviewer'>
                        </b></label>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nama </b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b><?php echo $_POST['data_2'];?></b></label>
                        <input type='hidden' id='nama_calon_reviewer' value='<?php echo $_POST['data_2'];?>' name='nama_calon_reviewer'> 
                    </td>
                 </tr>
                 <tr>
                    <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Kategori Bidang </b></label>
                     </td>
                      <td class="text-left" style="width: 20%">
                        <label for=""><b>
                       <?php
                     $sql=mysqli_query($server1,"select * from ref_kategori_bidang_penelitian_simlitabmas");
                     $no=1;
                     while($r=mysqli_fetch_array($sql))
                     {
                        echo "
                                    <input type='checkbox' name='pilihan[]' value='".$r['kode_kategori_bidang_penelitian_simlitabmas']."'>&nbsp;".$r['nama'].
                                    "<br>
                                  ";
                       ?>
                        <?php
                     }
                        ?>
                    </td>
                    </label>
                 </tr>

             </tbody>
            </table>


            <!-- Modal Footer -->
                    <div class="modal-footer"><center>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit"  name="submit">Tambah Reviewer</button>
                    </div>
            </form>
        <?php
    }
    else if ($_POST['act']=='tidak_ditemukan')
    {
            ?>
                <center><h5>Data Calon Reviewer : <?php echo $_POST['kata_kunci'];?> Tidak Ditemukan</h5></center>
            <?php
    }
?>


