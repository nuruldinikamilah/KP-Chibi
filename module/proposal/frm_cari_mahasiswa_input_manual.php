<!--penting -->
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>



<?php
if(isset($_GET['status'])) 
{
    if ($_GET['status']=='gagal')
        {
                                    ?>
                                         <script>
                                        $(document).ready(function() 
                                        {
                                            $('#modal-dialog-mysql-error').modal('show');
                                        });
                                    </script>
                                    <?php
        }
        else if ($_GET['status']=='sukses')
        {
                                ?>
                                <script>
                                        $(document).ready(function() 
                                        {
                                            $('#modal-dialog-sukses-tambah').modal('show');
                                        });
                                </script>
                                <?php
            }
        else if ($_GET['status']=='ubah')
        {
                                ?>
                                <script>
                                        $(document).ready(function() 
                                        {
                                            $('#modal-dialog-sukses-ubah').modal('show');
                                        });
                                </script>
                                <?php
            }

}
    
?> 
<!-- begin #content -->
            
            <!-- begin row -->
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
                            <h4 class="panel-title">Form Pendaftaran Mahasiswa Proposal</h4>
                        </div>
                        <div class="panel-body">
                            
                                <br />
                                
                                 <!-- begin panel -->
                        
                        <div class="panel-body panel-form">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="langkah_satu"  >
                                <div>
                                        <fieldset>
                                                <div class="form-group">
                                                    <input type="hidden" value="frm_cari_mahasiswa_input_manual" name="submit">
                                                    <input type="hidden" value="langkah_satu_cari_mahasiswa" name="act">
                                                    <label for=""><b>Masukan NIM Mahasiswa</b></label>
                                                    <input id="" class="form-control" placeholder="Masukan NIM Mahasiswa" name="kata_kunci" size="60">
                                                    <br><label for=""><b>Pilih Jenis Proposal</b></label>
                                                    <select name="jenis" class="form-control">
                                                       <option value="" value="" selected >-PILIH JENIS-</option>
                                                        <option value="B">BARU</option>
                                                        <option value="P">PERPANJANGAN</option>
                                                        <option value="K">KHUSUS</option>
                                                      </select>
                                                </div>
                                    </fieldset>
                        </div>
                    </div>
                    <!-- end panel -->
                                    <hr />
                                     <center><button class="btn btn-info m-r-5 m-b-5" type="submit">CARI DATA</button>
                        </div>
                        </form>
                  
 <!-- end panel -->
                </div>
                <!-- end col-12 -->
<?php
    /*if (((isset($_GET['kata_kunci']))&&($_SESSION['nik_user']=='4127050105x')&&($_GET['act']=='langkah_satu_cari_mahasiswa')) || ((isset($_GET['kata_kunci']))&&($_SESSION['role_skripsi']=='sekre')&&($_GET['act']=='langkah_satu_cari_mahasiswa')) || ((isset($_GET['kata_kunci']))&&($_SESSION['nik_user']=='41277006052')&&($_GET['act']=='langkah_satu_cari_mahasiswa')))
    {
         $nim=$_GET['kata_kunci'];

    }*/
  if (((isset($_POST['kata_kunci']))&&($_SESSION['nik_user']=='4127050105x')&&($_POST['act']=='langkah_satu_cari_mahasiswa')) || ((isset($_POST['kata_kunci']))&&($_SESSION['role_skripsi']=='sekre')&&($_POST['act']=='langkah_satu_cari_mahasiswa')) || ((isset($_POST['kata_kunci']))&&($_SESSION['nik_user']=='41277006052')&&($_POST['act']=='langkah_satu_cari_mahasiswa')))
        {
         $nim=$_POST['kata_kunci'];
         $pass="abcd";
         $semester_aktif=$_SESSION['tahun_semester_aktif'];
         
         //--------------------------------------------HATI HATI DISINI UNTUK MODE ONLINE DAN OFFLINE -------------------------------------//
         //tester true online : nim = 10110257,95157447 atau 10116903, nadiamenteng12, 10115180, android321
        //https://api.unikom.ac.id/auth/mahasiswa?nim=10110257&pass=95157447&semester=20191
        
        //tester tes offline : nim = 10116551
        //tester tes 10115249
        //https://api.unikom.ac.id/auth/mahasiswa?nim=10116551&pass=abc&semester=20191&test

         //offline mode
        //$url = 'data.json';
        //end offline mode

         //online mode
         $url = "https://api.unikom.ac.id/auth/mahasiswa?nim=$nim&pass=$pass&semester=$semester_aktif&test";
        //--------------------------------------------end HATI HATI DISINI UNTUK MODE ONLINE DAN OFFLINE -------------------------------------//

         $json = json_decode(file_get_contents($url), true);

         $status = $json["STATUS"];

         if (($status=='OK')&&($_POST['jenis']=='B')||($status=='OK')&&($_POST['jenis']=='K'))
         {
               ?>
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">PENGISIAN DATA</h4>
                        </div>
                       
                        <form action="module/proposal/frm_cari_mahasiswa_input_manual_proses.php" method="post"  name="proposal" class="form-inline">
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                </tr>
                                <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>NIM</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                       <input type="text" name="nim" class="form-control" size="50" id="nim" readonly value='<?php echo $json['MAHASISWA']['NIM']?>'> 
                                  </th>
                                </tr>
                                <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>Nama</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                       <input type="text" name="nama" class="form-control" size="50" id="nim" readonly value='<?php echo $json['MAHASISWA']['NAMA']?>'> 
                                  </th>
                                <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>Email</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                       <input type="text" name="email" class="form-control" size="50" id="nim" readonly value='<?php echo $json['MAHASISWA']['EMAIL']?>'> 
                                  </th>
                                </tr>
                                <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>Masukan Judul</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                       <textarea class="form-control" rows="2" cols="150"  
                          name="judul" data-parsley-required='true' id="judul_tahap_dua"></textarea>
                                  </th>
                                </tr>
                                 <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>Pilih Keilmuan</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                   <select  id='keilmuan_pilih'  class="form-control" name="keilmuan">
                                      <option value="">-Pilih Keilmuan-</option>
                                     <?php
                                               $sql=mysqli_query($server1,"SELECT * FROM ref_keilmuan order by kd_keilmuan");
                                                      while($rs = mysqli_fetch_array($sql))
                                                       {
                                                           $str=my_simple_crypt( $rs[kd_keilmuan], 'e' );
                                                           
                                                           echo "<option value='$str'>[$rs[kd_keilmuan]] $rs[nama_keilmuan]</option>";
                                                      }
                                                       echo "</select></td>";
                                    ?>
                                    </select>
                  </th>
                                  </th>
                                </tr>
                                

                                 <tr id='tema_tampil'>
                                 <!--<tr id='dosen_tampil'>-->
                                
                               <tr>
                                   <th colspan="2" class="text-left col-md-2"><label for=""><b>Jenis Skripsi</b></label></th>
                                   <th colspan="2" class="text-left col-md-2">
                                       <input type="text" name="jenis" class="form-control" size="50" id="jenis" readonly value='<?php echo $_POST['jenis'];?>'> 
                                  </th>
                                </tr>
                            <th colspan="4" class="text-center">  <center>
                                      <button class="btn btn-info m-r-5 m-b-5" type="submit">SIMPAN</button></th>
                               </thead>
                               </table>

              </div>
              <!-- end panel -->
               <?php
         }
         else if (($status=='OK')&&($_POST['jenis']=='P'))
         {
            echo "sabar dulu y sedang dibuat";
         }
        
         else if ($status=='ERROR')
         {
                $ket=$json['KETERANGAN'];
                echo "$ket<br>";
                echo "tidak ditemukan";
                
         }
    }
    
?>
 
            </div>
            <!-- end row -->
        