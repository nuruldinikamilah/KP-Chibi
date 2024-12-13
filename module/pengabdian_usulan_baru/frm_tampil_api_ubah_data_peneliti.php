<?php
if ($_POST['act']=='ditemukan')
{

    $nip=$_POST['nip_anggota'];
    $nama=str_replace('_',' ',$_POST['nama_anggota']);
    $keterangan_anggota=$_POST['keterangan_anggota'];
    $sesi=$_POST['sesi'];
    ?>
    <input type="hidden" id="sesi" value="<?php echo $sesi;?>">
    <table class="table table-condensed table-striped table-bordered text-center">
        <tbody>
            <tr>
                <td colspan="2"><b>Data Peneliti Ditemukan</b></td>
            </tr>
            <tr>
                <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                 <label for=""><b>Nip/Nim Anggota Peneliti</b></label>
             </td>
             <td class="text-left" style="width: 20%">
                <label for=""><b><?php echo $nip;?></b></label>
                <input type="hidden" id="nip_ubah" value="<?php echo $nip;?>">
            </td>
        </tr>
        <tr>
            <td class="text-left align-text-bottom col-md-2" style="width: 20%">
             <label for=""><b>Nama Anggota Peneliti</b></label>
         </td>
         <td class="text-left" style="width: 20%">
            <label for=""><b><?php echo $nama;?></b></label>
            <input type="hidden" id="nama_ubah" value="<?php echo $nama;?>">
        </td>
    </tr>
    <tr>
            <td class="text-left align-text-bottom col-md-2" style="width: 20%">
                 <label for=""><b>Status Anggota Peneliti</b></label>
            </td>
        <td class="text-left" style="width: 20%">
            <?php
            if ($keterangan_anggota=='Dosen')
            {
                ?>
                 <select name="status_peneliti" id="status_peneliti">         
                            <option value="0">Pilih Status Peneliti</option>     
                            <option value="Ketua">Ketua Peneliti</option>
                            <option value="Anggota">Anggota Peneliti</option>
                        </select>
                <?php
            }
            else
            {
                ?>
                    <label for=""><b>Anggota</b></label>
                    <input type="hidden" name="status_peneliti" value="Anggota" id="status_peneliti">
                <?php
            }
            ?> 
        </td>
         
    </tr>
     <tr>
            <td class="text-left align-text-bottom col-md-2" style="width: 20%">
             <label for=""><b>Keterangan Peneliti</b></label>
         </td>
         <td class="text-left" style="width: 20%">
            <label for=""><b><?php  echo $keterangan_anggota; ?></b></label>
            <input type="hidden" id="keterangan_anggota_ubah" value="<?php echo $keterangan_anggota;?>">
        </td>
         
    </tr>
</td>
</tr>

</tbody>
</table>

<hr>
<center><button type="button" class="btn btn-primary submitBtn" onclick="proses_ubah_pengabdian()">Ubah Data</button>
    <?php
}      
?>


