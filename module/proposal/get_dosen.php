<?php
  include "../../config/koneksi.php";
  include "../../lib/enkripsi_decrpt.php";
  if (isset($_REQUEST['keilmuan_pilih']))
  {
    $decrypted = my_simple_crypt( $_REQUEST['keilmuan_pilih'], 'd' );
  ?>
                  <th colspan="2" class="text-left col-md-2"><label for=""><b>Pilih Calon Pembimbing</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                   <select  id='dosenpembimbing'  class="form-control" name="dosenpembimbing">
                                      <option value="">-Pilih Calon Pembimbing-</option>
                                     <?php
                                               $sql=mysqli_query($server1,"SELECT * FROM ref_dosen WHERE status=1 ORDER BY nama ASC ");
                                                $no=1;
                                                      while($rs = mysqli_fetch_array($sql))
                                                       {
                                                           echo "<option value='$rs[kddosen]'>[$no] $rs[nama]</option>";
                                                           $no++;
                                                      }
                                                       echo "</select></td>";
                                    ?>
                                    </select>
                  </th>
  <?php

  }

?>