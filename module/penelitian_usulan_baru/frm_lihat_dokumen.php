<head>
  <title>PDF with Image Editing</title>
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
      width: 40%;
      height: auto;
      margin:auto;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <div class="panel panel-inverse">
    <div class="panel-heading">
      <div class="panel-heading-btn">
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
      </div>
      <h4 class="panel-title">Tambah File dan Tanda Tangan <?php echo date("Y"); ?></h4>
    </div>

    <br>

    <div class="container">
      <div style="display: flex; gap: 20px;">
        <div>
          <canvas id="editCanvas" class="border" width="600" height="900"></canvas>
        </div>
        <div>
          <div style="display: flex; justify-content: center; flex-direction: column;">
            <video id="video" autoplay></video>
            <form  action="module/penelitian_usulan_baru/frm_verifikasi_tanda_tangan_proses.php" method="POST" enctype="multipart/form-data" id="pdfForm">
              <input type="hidden" name="pdf_file" id="pdfUpload" accept="application/pdf" value="<?php echo $_GET['file']; ?>" required>
              <input type="text" class="hidden" name="idx" value="<?php echo $_GET['idx']; ?>">
              <input type="hidden" name="image" id="imageData">
              <input type="hidden" name="date" id="dateData">
              <input type="hidden" name="positionX" id="positionX">
              <input type="hidden" name="positionY" id="positionY">
              <input type="hidden" name="imageWidth" id="imageWidth">
              <input type="hidden" name="imageHeight" id="imageHeight">
              <div class="btn-action" style="display: flex; flex-direction: column; gap: 10px;">
                <button id="capture" type="button" name="submit_button" class="btn btn-primary" onclick="history.back()">Kembali</button>
              </div>
              <a href="" target="_blank"></a>
              <div>
                <?php
                  if(isset($_GET['file'])) 
                  {
                    $pdfName = $_GET['file'];
                    // echo "<a href='dokumen_bukti_verifikasi/pdf/" . $pdfName . "'target='_blank'>Download PDF with Uploaded Image</a><br>";
                  }
                ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
  <script>
document.addEventListener("DOMContentLoaded", function () {
  var canvas = new fabric.Canvas('editCanvas');
  
  // Load the image or PDF as an image into the canvas
  var filePath = 'dokumen_bukti_verifikasi/pdf/<?php echo $_GET['file']; ?>';
  
  // Check if the file is a PDF or an image based on its extension
  if (filePath.endsWith('.pdf')) {
    // Load PDF as image
    pdfjsLib.getDocument(filePath).promise.then(function (pdf) {
      pdf.getPage(1).then(function (page) {
        var viewport = page.getViewport({ scale: 1.5 });
        var pdfCanvas = document.createElement('canvas');
        pdfCanvas.width = viewport.width;
        pdfCanvas.height = viewport.height;
        var context = pdfCanvas.getContext('2d');
        
        page.render({
          canvasContext: context,
          viewport: viewport
        }).promise.then(function () {
          fabric.Image.fromURL(pdfCanvas.toDataURL(), function (img) {
            fitImageIntoCanvas(img);
          });
        });
      });
    });
  } else {
    // Load image directly
    fabric.Image.fromURL(filePath, function (img) {
      fitImageIntoCanvas(img);
    });
  }

  function fitImageIntoCanvas(img) {
    // Scale and center the image in the canvas
    var scaleWidth = canvas.width / img.width;
    var scaleHeight = canvas.height / img.height;
    var scaleFactor = Math.min(scaleWidth, scaleHeight);
    
    img.scale(scaleFactor);
    img.set({
      left: (canvas.width - img.getScaledWidth()) / 2,
      top: (canvas.height - img.getScaledHeight()) / 2,
      selectable: true
    });
    
    canvas.add(img);
    canvas.renderAll();
  }
});
    // // Function to fit the uploaded image into the canvas
    // function fitImageIntoCanvas(imgElement) {
    //   // Create a Fabric image from the uploaded image element
    //   fabric.Image.fromURL(imgElement.src, function (img) {
    //     // Get canvas dimensions
    //     var canvasWidth = canvas.width;
    //     var canvasHeight = canvas.height;

    //     // Get image dimensions
    //     var imgWidth = img.width;
    //     var imgHeight = img.height;

    //     // Calculate scale factors for width and height
    //     var scaleWidth = canvasWidth / imgWidth;
    //     var scaleHeight = canvasHeight / imgHeight;

    //     // Choose the smaller scale factor to fit the image
    //     var scaleFactor = Math.min(scaleWidth, scaleHeight);

    //     // Scale the image proportionally
    //     img.scale(scaleFactor);

    //     // Center the image on the canvas
    //     img.set({
    //       left: (canvasWidth - img.getScaledWidth()) / 2,
    //       top: (canvasHeight - img.getScaledHeight()) / 2,
    //       selectable: false,  
    //       evented: false      
    //     });

    //     // Add the image to the canvas
    //     canvas.add(img);
    //     canvas.renderAll();
    //   });
    // }
    
    document.getElementById('pdfUpload').addEventListener('change', function(e) {
      var file = e.target.files[0];
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
            hasControls: true,  // Show resize/scale handles
            lockRotation: true, // Prevent rotation if needed
            cornerSize: 10,     // Size of control corners
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

</body>