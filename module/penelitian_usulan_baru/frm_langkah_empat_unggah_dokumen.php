<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>

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
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'error_ukuran') {
?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-error-ukuran').modal('show');
                // alert ('tes');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'sukses_tambah') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-sukses-tambah').modal('show');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'sukses_ubah') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-sukses-ubah').modal('show');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'gagal_db') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-gagal-db').modal('show');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'gagal') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-gagal-db').modal('show');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'gagal_ekstensi') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-gagal-ekstensi').modal('show');
            });
        </script>
    <?php
    } else if ($_GET['status'] == 'berhasil_capture') {
    ?>
        <script>
            $(document).ready(function() {
                $('#modal-dialog-berhasil-capture').modal('show');
            });
            var filePath = 'dokumen_bukti_verifikasi/pdf/<?php echo $_GET['file1']; ?>';
            var filePath2 = 'dokumen_bukti_verifikasi/pdf/<?php echo $_GET['file2']; ?>';
            var fileInput = document.getElementById('file_dokumen_lembar_pengesahan');
            // Get file from file path and then put in file input
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

<style>
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .form-group input[type="file"] {
        width: 100%;
        padding: 5px;
        border: solid 1px black;
    }

    .btn-action button {
        border-radius: 5px;
        padding: 10px;
        border: none;
        cursor: pointer;
        margin-bottom: 10px
    }

    canvas {
        border-radius: 8px;
        border: solid 1px black;
    }

    video {
        border-radius: 8px;
        width: 20%;
        height: auto;
        margin: auto;
        margin-bottom: 10px;
    }
</style>
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
                <h4 class="panel-title">Form Unggah Dokumen Proposal <?php echo date("Y"); ?></h4>
            </div>

            <br>


            <form action="module/penelitian_usulan_baru/frm_langkah_empat_unggah_dokumen_proses.php" method="post" name="frm" class="form-inline" onsubmit="return validasi_frm_dokumen_proposal();" enctype="multipart/form-data">

                <input type='hidden' name='idx' value='<?php echo $_GET['idx']; ?>'>
                <div class="table-responsive">
                    <?php
                    $langkah_satu_proses = my_simple_crypt('insert', 'e');

                    //Jika Pernah Mengisi
                    if (isset($_GET['idx'])) {
                        $idx = my_simple_crypt($_GET['idx'], 'd');
                        $sql = mysqli_query($server1, "select * from pengajuan_penelitian where idx_penelitian=" . $idx);
                        $sql2 = mysqli_query($server1, "select * from bukti_verif where idx_pengajuan_penelitian=" . $idx);
                        $r = mysqli_fetch_array($sql);
                        $bv = mysqli_fetch_array($sql2);
                        if ($r['dokumen_proposal'] != '') {
                            $langkah_proses = my_simple_crypt('update', 'e');
                            echo "<input type='hidden' name='idx' value='" . $_GET['idx'] . "'>";
                            $kata = "Ubah";
                            echo "<input type='hidden' value='$r[dokumen_proposal]' name='nama_dokumen_sebelumnya'>";
                            echo "<input type='hidden' value='$r[dokumen_lembar_pengesahan]' name='nama_lp_sebelumnya'>";
                            echo "<input type='hidden' value='$r[dokumen_lembar_mitra]' name='nama_mitra_sebelumnya'>";
                            echo "<input type='hidden' value='$bv[file_verif]' name='bukti_verif_sebelumnya'>";
                        } else {
                            $langkah_proses = my_simple_crypt('insert', 'e');
                            $kata = "Tambah";
                        }
                    }

                    ?>
                    <input type='hidden' name='langkah_proses' value='<?php echo $langkah_proses; ?>'>
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
                            if ($r['dokumen_proposal'] != '') {
                            ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br><a href="<?php echo "dokumen_upload/" . $r['dokumen_proposal']; ?>" download>Download File Proposal</a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                            <tr id=t_dokumen_file_lp>
                                <td class="text-left align-text-bottom col-md-2 align-middle" style="width: 40%">
                                    <label for=""><b>Masukan File Dokumen Cover dan <br> Halaman pengesahan Yang Telah Ditandatangani
                                            <br>
                                            <a href="<?php echo "module/penelitian_usulan_baru/lembar_pengesahan.php?idx=" . $_GET['idx']; ?>" download>Download Lembar Pengesahan</a>
                                </td>
                                <td class="text-left align-text-bottom col-md-2" style="width: 60%;">
                                    <span class="btn btn-danger fileinput-button btn-xs m-r-5">
                                        <i class="fa fa-plus"></i>
                                        <?php
                                        // Jika sudah di tanda tangni
                                        if ($r['dokumen_lembar_pengesahan'] != '' && $bv['file_verif'] != '') {
                                            echo '
                                            <span>Ubah File</span>
                                            <input type="file" name="file_lp" id="file_dokumen_lembar_pengesahan" />
                                        ';
                                        } else {
                                            echo "
                                            <span>Tambah File</span>
                                            <input type='file' name='file_lp' id='file_dokumen_lembar_pengesahan' />
                                            ";
                                        }
                                        ?>

                                    </span>
                                    <!-- Tombol Baru -->
                                    <?php
                                    if (isset($_GET['idx'])) {
                                        $link_1 = "idx=" . $_GET['idx'];
                                    ?>
                                        <a class="hidden-phone hidden" href="view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan&<?php echo $link_1; ?>">
                                        <?php
                                    }
                                        ?>
                                        <!-- <button type="button" class="btn btn-primary btn-xs m-r-5" onclick="window.location.href='module/penelitian_usulan_baru/frm_langkah_empat_tanda_tangan.php';"> -->
                                        <i class="fa fa-plus"></i>
                                        Tanda Tangan
                                        </a>
                                        <!-- </button> -->
                                        <label id="nama_upload_file_lp"></label>

                                        <div id="div-tanda-tangan"></div>
                                </td>
                            </tr>
                            <?php
                            if ($r['dokumen_lembar_pengesahan'] != '' && $bv['file_verif'] != '') {
                            ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br>
                                        <a href="<?php echo "dokumen_bukti_verifikasi/pdf/" . $r['dokumen_lembar_pengesahan']; ?>" download>Download File Lembar Pengesahan Yang Sudah Ditandatangani</a>
                                        <a href="<?php echo "dokumen_bukti_verifikasi/pdf/" . $bv['file_verif']; ?>" download>Download File Bukti Pengesahan </a>
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
                            if ($r['dokumen_lembar_mitra'] != '') {
                            ?>
                                <tr>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                    </td>
                                    <td class="text-left align-text-bottom col-md-2 align-middle">
                                        <br><a href="<?php echo "dokumen_upload_mitra_penelitian/" . $r['dokumen_lembar_mitra']; ?>" download>Download File kesediaan mitra</a>

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
                $sql_val = mysqli_query($server1, "select * from pengajuan_penelitian where idx_penelitian=" . $idx);
                $rx = mysqli_fetch_array($sql_val);
                if ((isset($rx['validasi_proposal_pengguna'])) || (isset($rx['nilai_keseluruhan_proposal']))) {
                    $var_disabled = "disabled";
                } else {
                    $var_disabled = "";
                }
                ?>
                <center><button class="btn btn-info m-r-5 m-b-5" type="submit" name="upload" value="Upload" <?php echo $var_disabled; ?>>SIMPAN DATA DOKUMEN PROPOSAL</button><br>
        </div>



        <!-- end panel -->
    </div>

    </form>
    <!-- end col-12 -->
</div>
<div class="modal fade" id="modal-dialog-show-ttd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel">Verifikasi</h5>
            </div>
            <div class="p-10">
                <div style="display: flex; gap: 20px; flex-direction: column;">
                    <div style="display: flex; justify-content: center; flex-direction: column;">
                        <video id="video" autoplay style="width: 210px; height: 160px; border: 1px solid #ccc; border-radius: 8px;"></video>

                        <div style="display: flex; justify-content:center; flex-direction: column; align-items: center; gap: 20px;">
                            <canvas id="editCanvas" class="border" width="400" height="600"></canvas>
                            <div>
                            </div>
                            <div>
                                <div style="display: flex; justify-content: center;">
                                    <form action="module/penelitian_usulan_baru/frm_langkah_empat_tanda_tangan_proses.php" method="POST" enctype="multipart/form-data" id="pdfForm">
                                        <input type="file" class="hidden" name="pdf_file" id="file_dokumen_lp_modal" />
                                        <input type='hidden' name='idx' value='<?php echo $_GET['idx'] ?>'>
                                        <input type="hidden" name="image" id="imageData">
                                        <input type="hidden" name="date" id="dateData">
                                        <input type="hidden" name="positionX" id="positionX">
                                        <input type="hidden" name="positionY" id="positionY">
                                        <input type="hidden" name="imageWidth" id="imageWidth">
                                        <input type="hidden" name="imageHeight" id="imageHeight">
                                        <div class="btn-action" style="display: flex; flex-direction: column; gap: 10px;">
                                            <button id="capture" type="submit" name="submit_button" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <div>
                                            <?php
                                            if (isset($_GET['file1'])) {
                                                $pdfName1 = $_GET['file1'];
                                                $pdfName2 = $_GET['file2'];
                                                echo "<a href='" . $pdfName1 . "' target='module/penelitian_usulan_baru/frm_langkah_empat_unggah_dokumen.php'>Download PDF with Webcam Image</a><br>";
                                                echo "<a href='" . $pdfName2 . "'target='_blank'>Download PDF with Uploaded Image</a><br>";
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <script>
            function handleClick() {
                $('#modal-dialog-show-ttd').modal('show');
            }
        </script>

        <script>
            var video = document.getElementById('video');
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(err) {
                    alert("Error accessing camera: " + err);
                });

            document.getElementById('capture').addEventListener('click', function() {
                var canvas = document.createElement('canvas');
                canvas.width = 640;
                canvas.height = 480;
                var context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                var imageData = canvas.toDataURL('image/png');
                document.getElementById('imageData').value = imageData;
                document.getElementById('dateData').value = new Date().toLocaleString();
                document.getElementById('pdfForm').submit();
            });

            var canvas = new fabric.Canvas('editCanvas');

            // Function to fit the uploaded image into the canvas
            function fitImageIntoCanvas(imgElement) {
                // Create a Fabric image from the uploaded image element
                fabric.Image.fromURL(imgElement.src, function(img) {
                    // Get canvas dimensions
                    var canvasWidth = canvas.width;
                    var canvasHeight = canvas.height;

                    // Get image dimensions
                    var imgWidth = img.width;
                    var imgHeight = img.height;

                    // Calculate scale factors for width and height
                    var scaleWidth = canvasWidth / imgWidth;
                    var scaleHeight = canvasHeight / imgHeight;

                    // Choose the smaller scale factor to fit the image
                    var scaleFactor = Math.min(scaleWidth, scaleHeight);

                    // Scale the image proportionally
                    img.scale(scaleFactor);

                    // Center the image on the canvas
                    img.set({
                        left: (canvasWidth - img.getScaledWidth()) / 2,
                        top: (canvasHeight - img.getScaledHeight()) / 2,
                        selectable: false,
                        evented: false
                    });

                    // Add the image to the canvas
                    canvas.add(img);
                });
            }

            document.getElementById('file_dokumen_lembar_pengesahan').addEventListener('change', function(e) {
                var file = e.target.files[0];
                var fileInput = document.getElementById('file_dokumen_lembar_pengesahan');
                var fileInputModal = document.getElementById('file_dokumen_lp_modal');

                // Create a new FileList object by copying files from fileInput
                var dataTransfer = new DataTransfer();
                for (var i = 0; i < fileInput.files.length; i++) {
                    dataTransfer.items.add(fileInput.files[i]);
                }

                // Assign the new FileList object to the file input field
                fileInputModal.files = dataTransfer.files;

                var_div_ttd = document.getElementById('div-tanda-tangan');
                var_div_ttd.innerHTML = "<button type='button' onclick='handleClick()'>Verifikasi</button>";

                var reader = new FileReader();
                reader.onload = function() {
                    var typedArray = new Uint8Array(this.result);
                    pdfjsLib.getDocument(typedArray).promise.then(function(pdf) {
                        pdf.getPage(1).then(function(page) {
                            var viewport = page.getViewport({
                                scale: 1.33
                            });
                            var pdfCanvas = document.createElement('canvas');
                            pdfCanvas.width = viewport.width;
                            pdfCanvas.height = viewport.height;
                            var pdfContext = pdfCanvas.getContext('2d');
                            page.render({
                                canvasContext: pdfContext,
                                viewport: viewport
                            }).promise.then(function() {
                                var imgElement = new Image();
                                imgElement.src = pdfCanvas.toDataURL();
                                imgElement.onload = function() {
                                    var imgInstance = new fabric.Image(
                                        fitImageIntoCanvas(imgElement), {
                                            left: 0,
                                            top: 0,
                                            selectable: false
                                        });
                                    canvas.add(imgInstance);
                                    canvas.renderAll();
                                };
                            });
                        });
                    });
                };
                reader.readAsArrayBuffer(file);
            });

            document.getElementById('imageUpload').addEventListener('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onload = function() {
                    var imgElement = new Image();
                    imgElement.src = this.result;
                    imgElement.onload = function() {
                        var imgInstance = new fabric.Image(imgElement, {
                            left: 50,
                            top: 50,
                            scaleX: 0.4,
                            scaleY: 0.4,
                            hasControls: true, // Show resize/scale handles
                            lockRotation: true, // Prevent rotation if needed
                            cornerSize: 10, // Size of control corners
                            transparentCorners: false, // Visible corner controls
                        });
                        canvas.add(imgInstance);
                        canvas.renderAll();

                        // Dynamically log position and size changes
                        function updateImageData() {
                            var positionX = imgInstance.left;
                            var positionY = imgInstance.top;
                            var imageWidth = imgInstance.width * imgInstance.scaleX;
                            var imageHeight = imgInstance.height * imgInstance.scaleY;

                            console.log('Position X:', positionX);
                            console.log('Position Y:', positionY);
                            console.log('Image Width:', imageWidth);
                            console.log('Image Height:', imageHeight);

                            // Update hidden fields
                            document.getElementById('positionX').value = positionX;
                            document.getElementById('positionY').value = positionY;
                            document.getElementById('imageWidth').value = imageWidth;
                            document.getElementById('imageHeight').value = imageHeight;
                        }

                        // Listen to image move/scale events and log updated values
                        imgInstance.on('moving', updateImageData);
                        imgInstance.on('scaling', updateImageData);
                        imgInstance.on('scaled', updateImageData); // Ensure scaling updates are logged

                        // Initial log
                        updateImageData();
                    };
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('deleteImage').addEventListener('click', function() {
                // Hapus data gambar dari input tersembunyi
                document.getElementById('imageData').value = '';

                // Jika ada gambar yang ditampilkan di canvas, hapus gambar tersebut
                canvas.remove(canvas.getActiveObject());

                alert("Are you sure you want to delete the image?");
            });
        </script>