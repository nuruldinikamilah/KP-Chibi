<?php
  include "../../config/koneksi.php";
  include "../../lib/enkripsi_decrpt.php";

  if (isset($_REQUEST['keilmuan_pilih']))
  {
     $decrypted = my_simple_crypt( $_REQUEST['keilmuan_pilih'], 'd' );
  ?>
                  <th colspan="2" class="text-left col-md-2"><label for=""><b>Pilih Tema</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                   <select  id='tema'  class="form-control" name="tema">
                                      <option value="">-Pilih Tema-</option>
                                     <?php

                                               $sql=mysqli_query($server1,"SELECT * FROM ref_tema WHERE kd_keilmuan='".$decrypted."' ORDER BY nama_tema ASC ");
                                                  $no=1;
                                                      while($rs = mysqli_fetch_array($sql))
                                                       {
                                                           echo "<option value='$rs[kd_tema]'>[$no] $rs[nama_tema]</option>";
                                                       $no++;
                                                       }
                                                       echo "</select></td>";
                                    ?>
                                    </select>
                  </th>
  <?php

  }

?>