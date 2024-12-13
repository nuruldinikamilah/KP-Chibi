
    <center>
        <table class="table-condensed table-striped table-bordered">
            <thead>
             <tr>
                 <td style="text-left align-middle col-md-2">
                   <label for=""><b>NIP</b></label>
               </td>
               <td class="text-left"><input class="form-control" type="text" value="<?php echo $_POST['id']?>" id="nip">
               </tr>
               <tr>
                 <td style="text-left align-middle col-md-2">
                   <label for=""><b>Nama</b></label>
               </td>
               <td class="text-left"><input class="form-control" type="text" value="<?php echo str_replace('_',' ',$_POST['nama'])?>" id="nama">
               </tr>
               <tr>
                   <td class="text-left align-middle col-md-2">
                    <label for=""><b>Hanya Contoh Untuk Center</b></label>
                 </td>
                 <td class="text-left"><textarea class="form-control" cols="50" rows="10" name="judul" id="judul">Tidak Perlu Diisi</textarea></th>
                 </tr>
             </table>
         