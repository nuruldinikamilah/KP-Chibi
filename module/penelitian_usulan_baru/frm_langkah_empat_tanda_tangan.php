<head>
  <title>PDF with Image Editing</title>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f6f9; 
      color: #333; 
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #555;
    }

    .form-group input[type="file"] {
      display: block;
      width: 100%;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ddd;
      border-radius: 5px;
      background-color: #ffffff;
      color: #333;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-action button {
      border-radius: 5px;
      padding: 12px 15px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      background-color: #007bff; 
      color: #ffffff;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-action button:hover {
      background-color: #0056b3;
      transform: scale(1.02);
    }

    canvas {
      border-radius: 10px;
      border: 2px solid #ddd;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    video {
      border-radius: 10px;
      width: 80%; 
      height: auto;
      margin: auto;
      margin-bottom: 10px;
      display: block;
      border: 2px solid #ddd;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
      <h4 class="panel-title">Verifikasi dan Tambah File <?php echo date("Y"); ?></h4>
    </div>

    <br>

    <div class="container">
      <div style="display: flex; gap: 20px;">
        <div>
          <div style="display: flex; justify-content: center; flex-direction: column;">
            <video id="video" autoplay></video>
            <form action="module/penelitian_usulan_baru/frm_langkah_empat_tanda_tangan_proses.php" method="POST" enctype="multipart/form-data" id="pdfForm">
              <input type='hidden' name='idx' value='<?php echo $_GET['idx']; ?>'>
              <div class="form-group">
                <label for="pdfUpload">Tambah File:</label>
                <input type="file" name="pdf_file" id="pdfUpload" accept="application/pdf" required>
              </div>
              <input type="hidden" name="image" id="imageData">
              <input type="hidden" name="date" id="dateData">
              <input type="hidden" name="positionX" id="positionX">
              <input type="hidden" name="positionY" id="positionY">
              <input type="hidden" name="imageWidth" id="imageWidth">
              <input type="hidden" name="imageHeight" id="imageHeight">
              <div class="btn-action" style="display: flex; flex-direction: column; gap: 10px;">
                <button id="capture" type="submit" name="submit_button" class="btn btn-primary">Simpan</button>
              </div>
              <div class="download-links">
                <?php
                  if (isset($_GET['file1'])) {
                    $pdfName1 = $_GET['file1'];
                    $pdfName2 = $_GET['file2'];
                    echo "<a href='" . $pdfName1 . "' target='_blank'>Download PDF with Webcam Image</a>";
                    echo "<a href='" . $pdfName2 . "' target='_blank'>Download PDF with Uploaded Image</a>";
                  }
                ?>
              </div>
            </form>
          </div>
        </div>

        <div>
          <canvas id="editCanvas" class="border" width="600" height="900"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
  <script>
    var video = document.getElementById('video');
    navigator.mediaDevices.getUserMedia({
        video: true
      })
      .then(function (stream) {
        video.srcObject = stream;
      })
      .catch(function (err) {
        alert("Error accessing camera: " + err);
      });

    document.getElementById('capture').addEventListener('click', function () {
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

    function fitImageIntoCanvas(imgElement) {
      fabric.Image.fromURL(imgElement.src, function (img) {
        var canvasWidth = canvas.width;
        var canvasHeight = canvas.height;

        var imgWidth = img.width;
        var imgHeight = img.height;

        var scaleWidth = canvasWidth / imgWidth;
        var scaleHeight = canvasHeight / imgHeight;

        var scaleFactor = Math.min(scaleWidth, scaleHeight);

        img.scale(scaleFactor);

        img.set({
          left: (canvasWidth - img.getScaledWidth()) / 2,
          top: (canvasHeight - img.getScaledHeight()) / 2,
          selectable: false,
          evented: false
        });

        canvas.add(img);
      });
    }

    document.getElementById('pdfUpload').addEventListener('change', function (e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function () {
        var typedArray = new Uint8Array(this.result);
        pdfjsLib.getDocument(typedArray).promise.then(function (pdf) {
          pdf.getPage(1).then(function (page) {
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
            }).promise.then(function () {
              var imgElement = new Image();
              imgElement.src = pdfCanvas.toDataURL();
              imgElement.onload = function () {
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
  </script>
</body>
