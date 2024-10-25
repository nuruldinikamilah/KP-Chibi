<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>

<?php
include "header_wizard.php";
?>

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
    if ($_GET['status']=='error_ukuran')
    {
                                ?>
                                     <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-error-ukuran').modal('show');
                                       // alert ('tes');
                                    });
                                </script>
                                <?php
    }
    else if ($_GET['status']=='sukses_tambah')
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
  
    else if ($_GET['status']=='sukses_ubah')
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
   else if ($_GET['status']=='gagal_db')
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
   else if ($_GET['status']=='gagal_ekstensi')
   {
                            ?>
                           <script>
                                    $(document).ready(function() 
                                    {
                                        $('#modal-dialog-gagal-ekstensi').modal('show');
                                    });
                            </script>
                            <?php
   }
}
?>     

<div class="note note-info">
                        <h4>Pesan</h4>
                        <ul>
                            <li>File Proposal Yang Diupload Tidak Boleh Lebih Besar Dari 5 MB</li>
                            <li>File Proposal Yang Diupload Adalah File (<strong>PDF</strong>)</li>
                            
                        </ul>
                    </div>

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
                <h4 class="panel-title">Form Unggah Dokumen Proposal <?php echo date("Y");?></h4>
            </div>

            <br>
            

            <form action="module/penelitian_usulan_baru/frm_langkah_empat_unggah_dokumen_proses.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_frm_dokumen_proposal();" enctype="multipart/form-data">

                <input type='hidden' name='idx' value='<?php echo $_GET['idx'];?>'>
                <div class="table-responsive">
                    <?php
                            $langkah_satu_proses=my_simple_crypt('insert', 'e' );

                            //Jika Pernah Mengisi
                            if (isset($_GET['idx']))
                            {
                                $idx=my_simple_crypt($_GET['idx'], 'd' );
                                $sql=mysqli_query($server1,"select * from pengajuan_penelitian where idx_penelitian=".$idx);
                                $r=mysqli_fetch_array($sql);
                                if ($r['dokumen_proposal']!='')
                                {
                                    $langkah_proses=my_simple_crypt('update', 'e' );
                                    echo "<input type='hidden' name='idx' value='".$_GET['idx']."'>";
                                    $kata = "Ubah";
                                    echo "<input type='hidden' value='$r[dokumen_proposal]' name='nama_dokumen_sebelumnya'>";
                                    echo "<input type='hidden' value='$r[dokumen_lembar_pengesahan]' name='nama_lp_sebelumnya'>";
                                    echo "<input type='hidden' value='$r[dokumen_lembar_mitra]' name='nama_mitra_sebelumnya'>";
                                }
                                else 
                                {
                                    $langkah_proses=my_simple_crypt('insert', 'e' );
                                    $kata = "Tambah";
                                }
                            } 
                            
                        ?>
                    <input type='hidden' name='langkah_proses' value='<?php echo $langkah_proses;?>'>
                    <table class="table-hover text-center table-bordered">
                        <thead>
                            <tr id=t_dokumen_file>
                                <td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
                                   <label for=""><b>Masukan File Dokumen Proposal Penelitian 
                                        <br><a href="https://dp3m.unikom.ac.id/pengajuan/view.php?menu=buku_panduan">Download Template Usulan File Penelitian Internal</b></label></a>
                                </td>
                                <td class="text-left align-text-bottom col-md-2" style="width: 60%;">
                                <span class="btn btn-danger fileinput-button btn-xs m-r-5">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo $kata; ?> File</span>
                                    <input type="file" name="file" id="file_dokumen" accept="application/pdf" />
                                </span>
                                 <label id="nama_upload_file"></label>
                            </td>
                            </tr>
                            <?php
                            if ($r['dokumen_proposal']!='')
                            {
                                ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                     <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br><a href="<?php echo "dokumen_upload/".$r['dokumen_proposal'];?>" download>Download File Proposal</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                            <tr id=t_dokumen_file_lp>
                                <td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
                                    <label for=""><b>Masukan File Dokumen Cover dan <br> Halaman pengesahan Yang Telah Ditandatangani
                                    <br>
                                    <a href="<?php echo "module/penelitian_usulan_baru/lembar_pengesahan.php?idx=".$_GET['idx'];?>" download>Download Lembar Pengesahan</a>
                                </td>
                                <td class="text-left align-text-bottom col-md-2" style="width: 60%;">
                                <span class="btn btn-danger fileinput-button btn-xs m-r-5">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo $kata; ?> File</span>
                                    <input type="file" name="file_lp" id="file_dokumen_lembar_pengesahan" accept="application/pdf" />
                                </span>
                                <!-- Tombol Baru -->
                                 <?php
                                if (isset($_GET['idx']))
                                    {
                                        $link_1="idx=".$_GET['idx'];
                                        ?>
                                        <a class="hidden-phone" href="view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan&<?php echo $link_1;?>">
                                        <?php
                                    }
                                 ?>
                                <!-- <button type="button" class="btn btn-primary btn-xs m-r-5" onclick="window.location.href='module/penelitian_usulan_baru/frm_langkah_empat_tanda_tangan.php';"> -->
                                <i class="fa fa-plus"></i>
                                 Tanda Tangan 
                                </a>
                                 <!-- </button> -->
                                <label id="nama_upload_file_lp"></label>
                                 
                            </td>
                            </tr>
                            <?php
                            if ($r['dokumen_lembar_pengesahan']!='')
                            {
                                ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                     <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br><a href="<?php echo "dokumen_upload_lp_penelitian/".$r['dokumen_lembar_pengesahan'];?>" download>Download File Lembar Pengesahan Yang Sudah Ditandatangani</a>
                                        <?php
                                         if(isset($_GET['file1'])) 
                                         {
                                           $pdfName1 = $_GET['file1'];
                                           $pdfName2 = $_GET['file2'];
                                           echo "<a href='" . $pdfName1 . "' target='_blank'>Download PDF with Webcam Image</a><br>";
                                           echo "<a href='" . $pdfName2 . "'target='_blank'>Download PDF with Uploaded Image</a><br>";
                                         }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>


                            <tr id=t_dokumen_file_mitra_abdi>
                                <td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
                                    <label for=""><b>Masukan File Kesediaan Mitra</b><br>&nbsp;</label>
                                </td>
                                <td class="text-left align-text-bottom col-md-2" style="width: 60%;">
                                <span class="btn btn-danger fileinput-button btn-xs m-r-5">
                                    <i class="fa fa-plus"></i>
                                    <span><?php echo $kata; ?> File</span>
                                    <input type="file" name="file_mitra_abdi" id="file_dokumen_mitra_abdi" accept="application/pdf" />
                                </span>
                                 <label id="nama_upload_file_mitra_abdi"></label>
                            </td>
                            </tr>
                            <?php
                            if ($r['dokumen_lembar_mitra']!='')
                            {
                                ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                     <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br><a href="<?php echo "dokumen_upload_mitra_penelitian/".$r['dokumen_lembar_mitra'];?>" download>Download File kesediaan mitra</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>


                        </table>
                    </div>
                   <hr style="border-top: 3px double #8c8b8b;">
                    <?php
                         //cek jika sudah divalidasi
                        $sql_val=mysqli_query($server1,"select * from pengajuan_penelitian where idx_penelitian=".$idx);
                        $rx=mysqli_fetch_array($sql_val);
                        if ((isset($rx['validasi_proposal_pengguna']))||(isset($rx['nilai_keseluruhan_proposal'])))
                        {
                            $var_disabled="disabled";
                        }
                        else
                        {
                            $var_disabled="";
                        }
                    ?>
                <center><button class="btn btn-info m-r-5 m-b-5" type="submit" name="upload" value="Upload" <?php echo $var_disabled;?>>SIMPAN DATA DOKUMEN PROPOSAL</button><br>
            </div>
                        


            <!-- end panel -->
        </div>
        
        </form>
        <!-- end col-12 -->
    </div>
    <!-- end row -->


