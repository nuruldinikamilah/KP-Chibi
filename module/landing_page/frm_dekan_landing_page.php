<div class="row">
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
                            <h4 class="panel-title">Selamat Datang <?php echo $_SESSION['nama_user'];?></h4>
                        </div>
                       

             <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="text-left col-md-2"><label for=""><b>Nama Pengguna </b></label></th>
                                    <th class="text-left col-md-2"><label for=""><b><?php echo $_SESSION['nama_dan_gelar_user'];?></b></label></th></th>
                                </tr>
                                 <tr>
                                    <th class="text-left col-md-2"><label for=""><b>Email Pengguna</b></label></th>
                                    <th class="text-left col-md-2"><label for=""><b><?php echo $_SESSION['email_user'];?></b></label></th></th>
                                </tr>
                                <tr>
                                    <th class="text-left col-md-2"><label for=""><b>Hak Akses</b></label></th>
                                    <th class="text-left col-md-2"><label for=""><b>Dekan</b></label></th></th>
                                </tr>
                                <?php
                                if ($_SESSION['nik_user']=='dewa')
                                {
                                  $path_foto = "img/dewa.png";
                                }
                                else
                                {
                                  $path_foto = substr($_SESSION['path_foto'], 0, -2);
                                  $path_foto = $path_foto."200";
                                }
                                ?>
                                 <tr>
                                    <th colspan="2" class="text-center"><img src="<?php echo  $path_foto; ?>"></th>
                                </tr>
                                 <!--<tr>
                                    <th colspan="2" class="text-center"><</th>
                                </tr>-->
                         </thead>
                         </table>
            
                      
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
      
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
                            <h4 class="panel-title">Dokumentasi Penggunaan Sistem Pengajuan DP3M Universitas Komputer Indonesia</h4>
                        </div>
                       

             <div class="table-responsive">
                        <table>
                            <thead>
                                 <tr>
                                    <th class="text-left col-md-2">
                                      <br>
                                      <center><h5><b>Video Simulasi Mengusulkan Penelitian Internal</h5></b><hr>
                                       <video id="video2" width="640" height="280" poster="module/landing_page/gambar_video.png" controls>
                                          <source src="module/landing_page/simulasi_pengusulan_penelitian.mp4" type="video/mp4">
                                      </video>
                                    </th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>  

                                    <th class="text-left col-md-2">
                                      <br>
                                      <center><h5><b>Video Simulasi Melaporkan Kemajuan Pengabdian</h5></b><hr>
                                       <video id="video2" width="640" height="280" poster="module/landing_page/gambar_video.png" controls>
                                          <source src="module/landing_page/laporan_kemajuan_dosen.mp4" type="video/mp4">
                                      </video>
                                    </th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>
                                    <th class="text-left col-md-2"><label for=""><b></b></label></th></th>  
                                </tr>
                         </thead>
                         </table>
                    <!-- end panel -->
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->


</div>