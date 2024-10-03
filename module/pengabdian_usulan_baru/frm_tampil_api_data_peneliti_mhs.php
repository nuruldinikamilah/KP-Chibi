<?php
    if ($_POST['act']=='ditemukan')
    {
        ?>

                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>NIM Anggota Peneliti</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b>
                            <?php echo $_POST['kata_kunci'];?>
                            <input type='hidden' id='nip_anggota_peneliti' value='<?php echo $_POST['kata_kunci'];?>'>    
                        </b></label>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nama Anggota Peneliti</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b><?php echo $_POST['nama_peneliti'];?></b></label>
                        <input type='hidden' id='nama_anggota_peneliti' value='<?php echo $_POST['nama_peneliti'];?>'> 
                    </td>
                 </tr>
                 <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Status Peneliti</b></label>
                     </td>
                    <td class="text-left" style="width: 20%">
                         <label for=""><b>Anggota</b></label>
                        <label for=""><input type='hidden' id='status_peneliti' value='Anggota' readonly> </label>
                        
                    </td>
                 </tr>
                 <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Keterangan Peneliti</b></label>
                     </td>
                      <td class="text-left" style="width: 20%">
                        <label for=""><b><?php echo $_POST['keterangan'];?></b></label>
                        <input type='hidden' id='keterangan_peneliti' value='<?php echo $_POST['keterangan'];?>'> 
                    </td>
                 </tr>
             </tbody>
            </table>
            <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary submitBtn" onclick="tambah_peneliti()">Tambah Peneliti</button>
                    </div>
        <?php
    }
    else if ($_POST['act']=='tidak_ditemukan')
    {
            ?>
                <center><h5>Data Peneliti Mahasiswa : <?php echo $_POST['kata_kunci'];?> Tidak Ditemukan</h5></center>
            <?php
    }
?>


