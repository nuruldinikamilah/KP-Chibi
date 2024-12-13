<script>
    function blink_text() {
        $('.blink').fadeOut(500);
        $('.blink').fadeIn(500);
    }
    setInterval(blink_text, 1000);
</script>
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Data Reviewer Penelitian Internal Tahun <?php  echo date("Y"); ?></h4>
            </div>
            
            <div class="panel-body">
            <table class="table-condensed table-striped ">
                <thead>
                  <tr>
                    <td class="text-left"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tambah-reviewer-modal"  name="tambah_reviewer"   id="tambah_reviewer">Tambah Data Reviewer</button></td>
                  </tr>
                  <tr></tr>
                </table>
                <hr>
             

          <!--<table class="table table-hover table-bordered text-center">-->
          <table class="table table-striped">
              <thead>
                <tr><th width="5%">No.</th><th width="20%">Nama Reviewer</th><th width="30%">Nama Kategori Bidang Penelitian</th><th>Status Reviewer</th><th>&nbsp;</th></tr>
                 </thead>
                    <tbody>
                        <?php
                     $sql_data_master=mysqli_query($server1,"SELECT
                                                               *
                                                              FROM
                                                               reviewer
                                                                   ");
                     $no=1;
                     while($r=mysqli_fetch_array($sql_data_master))
                     {
                        $idx_enc=my_simple_crypt($r['nip_reviewer'], 'e' );
                        ?>
                        <tr id=tr<?php echo $idx_enc;?>>
                            <td><?php echo $no;?></td>
                            <td><?php echo $r['nama_reviewer'];?></td>
                             <!--Tampil Bidang-->
                            <td>
                                <?php
                                    $sql_bidang=mysqli_query($server1,"SELECT
                                                        *
                                                        FROM
                                                        `reviewer_kat_bid_penelitian` a
                                                        INNER JOIN
                                                        `ref_kategori_bidang_penelitian_simlitabmas` b
                                                        ON a.`kode_kategori_bidang_penelitian_simlitabmas` = b.`kode_kategori_bidang_penelitian_simlitabmas`
                                                        WHERE a.`nip_reviewer`='".$r['nip_reviewer']."' ORDER BY b.`nama`");
                                        $jumlah_bidang=mysqli_num_rows($sql_bidang);
                                         
                                        if ($jumlah_bidang>0)
                                        {
                                          $nos=1;
                                             while($r_bidang=mysqli_fetch_array($sql_bidang))
                                             {
                                                ?>
                                                  <span><?php echo $nos .". ".$r_bidang['nama'];?></span>
                                                  <br>
                                                <?php
                                              $nos++;
                                             }
                                        }
                                        else
                                        {
                                                ?>
                                                <span class="blink"><font color="red"><b>Tahapan peneliti belum diisi</b></font></span>
                                                <?php
                                        }
                                ?>
                             </td>
                           <!--End Tampil Anggota Peneliti-->

                           <td>
                               <?php
                                  if ($r['status']=='1')
                                  {
                                       echo "<span>Aktif</span>";
                                  }
                                  else
                                  {
                                       echo "<span>Tidak Aktif</span>";
                                  }
                               ?> 
                            </td>
                           
                            <?php
                              
                              //$judul_penelitian = str_replace(' ', '_', $r['judul_penelitian']);
                            ?>
                             <td class="text-left"><button type="button" class="btn btn-primary btn-sm m-r-5" data-toggle="modal" data-target="#ubah-reviewer" id=<?php echo "ubah|".$idx_enc."|".$r['nama_reviewer']?>><i class="fa fa-edit"></i>Ubah</button></td>
                             
                              </tr>
                        </tr>
                        <td colspan="7" class="info"></td>
                        <?php
                        $no++;
                     }
                        ?>
                    </tbody>
            </table>
             </div> 
        </div>
        
    </div>
    <!-- end row -->


