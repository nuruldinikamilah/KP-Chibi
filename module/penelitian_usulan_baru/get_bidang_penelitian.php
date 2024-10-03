<?php
  include "../../config/koneksi.php";
  include "../../lib/enkripsi_decrpt.php";
  if (isset($_REQUEST['kategori_bidang_pilih']))
  {
  ?>
                    <td class="text-left align-middle col-md-2">
                         <label for=""><b>Bidang Penelitian</b></label>
                       </td>
                  <td class="text-left">
                                       <select  id='kategori_bidang_sudah_dipilih'  class="form-control" name="bidang_penelitian">
                                          <option value="">-----Pilih Bidang Penelitian-----</option>
                                     <?php
                                               $sql=mysqli_query($server1,"SELECT * FROM ref_bidang_penelitian_simlitabmas where kode_kategori_bidang_penelitian_simlitabmas=".$_REQUEST['kategori_bidang_pilih']." ORDER BY nama ASC ");
                                                $no=1;
                                                      while($rs = mysqli_fetch_array($sql))
                                                       {
                                                           echo "<option value='$rs[kode_bidang_penelitian_simlitabmas]'>[$no] $rs[nama]</option>";
                                                           $no++;
                                                      }
                                                       echo "</select></td>";
                                    ?>
                                    </select>
                  </td>
  <?php

  }

?>