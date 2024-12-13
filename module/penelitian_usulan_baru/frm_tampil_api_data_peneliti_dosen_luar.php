<?php
    if ($_POST['act']=='ditemukan')
    {
        ?>

                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>NIDN Anggota </b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <label for=""><b>
                            <?php echo $_POST['kata_kunci'];?>
                            <input type='hidden' id='nip_anggota_peneliti_dosen_luar' value='<?php echo $_POST['kata_kunci'];?>'>    
                        </b></label>
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nama Anggota</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <input type='text' id='nama_anggota_peneliti_dosen_luar'> 
                    </td>
                 </tr>
                   <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Program Studi</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <input type='text' id='nama_program_studi_dosen_luar' size='30'> 
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Nama Universitas</b></label>
                     </td>
                     <td class="text-left" style="width: 20%">
                        <input type='text' id='nama_universitas_dosen_luar' size='30'> 
                    </td>
                 </tr>
                 <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Status </b></label>
                     </td>
                    <td class="text-left" style="width: 20%">
                         <label for=""><b>Anggota</b></label>
                        <label for=""><input type='hidden' id='status_peneliti_dosen_luar' value='Anggota' readonly> </label>
                        
                    </td>
                 </tr>
                  <tr>
                        <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                         <label for=""><b>Keterangan Peneliti</b></label>
                     </td>
                      <td class="text-left" style="width: 20%">
                        <label for=""><b><?php echo "Dosen Luar";?></b></label>
                        <input type='hidden' id='keterangan_peneliti_dosen_luar' value='Dosen Luar'> 
                    </td>
                 </tr>
             </tbody>
            </table>
            <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary submitBtn" onclick="tambah_peneliti_dosen_luar()">Tambah Peneliti</button>
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


