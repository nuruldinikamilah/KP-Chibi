<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>

<script>
  function blink_text() {
    $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
  }
  setInterval(blink_text, 1000);
</script>


<?php
if(isset($_GET['status'])) 
{
    
   if ($_GET['status']=='sukses')
    {
                            ?>
                           <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-sukses-ubah-rubik').modal('show');
                                    });
                            </script>
                            <?php
    }
   else if ($_GET['status']=='gagal')
   {
                            ?>
                           <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-gagal-db').modal('show');
                                    });
                            </script>
                            <?php
   }
  
}
?>     

<?php
    if (isset($_SESSION['role_rubik']))
    {
?>
            <!-- begin row -->
            <div class="row">
                <!-- begin col-10 -->
                <div class="col-md-12">
                   
            <!-- begin row -->
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-5">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Pemilihan Skema Penelitian</h4>
                        </div>
                        <div class="panel-body">
                             <table>
                                            <thead>
                                                <tr>
                                                    <th width="5%">
                                                        Pilih Skema
                                                    </th>
                                                    <th width="35%">
                                                        <?php
                                                        echo "<select id='skema_pilih' name='skema' class='form-control' id='select-required' data-parsley-required='true'>";
                                                            $tampil=mysqli_query($server1,"select * from ref_rubik group by nama_skema");
                                                            echo "<option value='' selected>- Pilih Skema -</option>";
                                                            
                                                            while($w=mysqli_fetch_array($tampil))
                                                            {
                                                                $nama_skema = ucwords(str_replace('_', ' ', $w['nama_skema']));
                                                                echo "<option value=$w[nama_skema]>.".$nama_skema."</option>";        
                                                            }
                                                             echo "</select>";
                                                        ?>
                                                    </th>
                                                </tr>
                                            </thead>
                            </table>


            			      
                        </div>
                    </div>
                    <!-- end panel -->
            	   
            	   
            	   
            	   <form action="module/dir_lppm/frm_rubik_penilaian_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_identitas_usulan();">
            	    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <?php
                                if (isset($_GET['skema']))
                                {
                                    if ($_GET['skema']=='penelitian_terapan')
                                    {
                                        $skema = 'Penelitian Terapan';
                                        $skema_table = 'penelitian_terapan';
                                    }
                                    else if ($_GET['skema']=='penelitian_dasar')
                                    {
                                        $skema = 'Penelitian Dasar';
                                        $skema_table = 'penelitian_dasar';
                                    }
                                }
                                else
                                {
                                    $skema = 'Penelitian Dasar';
                                    $skema_table = 'penelitian_dasar';
                                }

                            ?>
                            <h4 class="panel-title">Rubik Penilaian Skema <?php echo $skema; ?></h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            // cari dan tampilkan data ke AutoComplete
                            $tampil=mysqli_query($server1,"SELECT * FROM ref_rubik where nama_skema='".$skema_table."'");
                            $jumlah_data=mysqli_num_rows($tampil);
                            ?>
                             <input type="hidden" value="<?php echo $skema;?>" name="nama_skema">
                             <input type="hidden" value="<?php echo $skema_table;?>" name="skema_db">
                             <input type="hidden" value="<?php echo $jumlah_data;?>" name="jumlah_data">
                            <table id="example" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Pertanyaan</th>
                                                    <th width="5%">Skala</th>
                                                    <th width="5%">Bobot (%)</th>
                                                    <th width="30%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no=1;
                                                     while($w = mysqli_fetch_array($tampil))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $no; ?><input type="hidden" name="idx_<?php echo $no;?>" value="<?php echo $w['idx_rubik'];?>"></td>
                                                            <td><?php echo $w['pertanyaan']; ?></td>
                                                             <td><?php echo $w['skala']; ?></td>
                                                            <td><input type="text" size="5" value="<?php echo $w['bobot'];?>" name="<?php echo "data_".$no;?>"></td>
                                                        </tr>
                                                        <?php
                                                        $no++;
                                                    }
                                                ?>
                                            </tbody>
                                         </table>
            					       <hr />
                                       <!-- Modal Footer -->
                                <div class="modal-footer"><center>
                                    <center><button class="btn btn-info m-r-5 m-b-5" type="submit" name="submit">SIMPAN DATA</button>
                                </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->
            </div>
            <!-- end row -->
<?php
}
else
{
    ?>
    <h1>HAYO MAU NGAPAIN !!</h1>
    <?php
}
?>