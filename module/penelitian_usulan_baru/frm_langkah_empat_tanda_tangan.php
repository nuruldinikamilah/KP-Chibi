<?php
require __DIR__ . '/vendor/phpqrcode/qrlib.php'; // Include PHP QR Code library
require __DIR__ . '/vendor/setasign/fpdf/fpdf.php'; // Include FPDF library
require __DIR__ . '/vendor/setasign/fpdi/src/autoload.php'; // Include FPDI for importing existing PDF

use setasign\Fpdi\Fpdi; // Use FPDI for PDF manipulation

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if an image is uploaded
    $uploadPath = '';
    if (isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] == UPLOAD_ERR_OK) {
        $uploadPath = '../../dokumen_bukti_verifikasi/gambar/uploaded_image_' . time() . '.png';
        move_uploaded_file($_FILES['uploaded_image']['tmp_name'], $uploadPath);
    } else {
        die("Error uploading image.");
    }

    // Get image data and date from form
    $imageData = $_POST['image'];
    $date = $_POST['date'];
    $positionX = $_POST['positionX'];
    $positionY = $_POST['positionY'];
    $imageWidth = $_POST['imageWidth'];
    $imageHeight = $_POST['imageHeight'];

    // Remove 'data:image/png;base64,' from the image data
    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);
    $decodedImage = base64_decode($imageData);

    // Save webcam image
    $webcamImageName = '../../dokumen_bukti_verifikasi/gambar/gambar_' . time() . '.png';
    file_put_contents($webcamImageName, $decodedImage);

    // Create a new PDF document for the webcam image
    $pdf1 = new FPDF();
    $pdf1->AddPage();
    $pdf1->Image($webcamImageName, 10, 30, 100, 75);
    $pdf1->SetFont('Arial', 'B', 16); // Set font: Arial, Bold, 16pt
    $pdf1->Text(10, 115, 'Captured on: ' . $date);
    // Save the PDF for webcam image
    $pdfName1 = '../../dokumen_bukti_verifikasi/pdf/Bukti_verifikasi_webcam_' . time() . '.pdf';
    $pdf1->Output('F', $pdfName1);

    // Create a new FPDI instance for the uploaded PDF
    $pdf2 = new Fpdi();
    $pdf2->AddPage();
    
    // Load the uploaded PDF and use it as the background
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
        $pdfPath = $_FILES['pdf_file']['tmp_name'];
        $pageCount = $pdf2->setSourceFile($pdfPath);
        $templateId = $pdf2->importPage(1);
        $pdf2->useTemplate($templateId, 0, 0, 210, 297); // Adjust width and height for A4 size
    } else {
        die("Error uploading PDF.");
    }

    // Convert pixels to millimeters for PDF
    $positionX_mm = $positionX / 3.78;
    $positionY_mm = $positionY / 3.78;
    $imageWidth_mm = $imageWidth / 3.78;
    $imageHeight_mm = $imageHeight / 3.78;

    // Add the uploaded image to the PDF based on the user-defined position and size
    if ($uploadPath) {
        $pdf2->Image($uploadPath, $positionX_mm, $positionY_mm, $imageWidth_mm, $imageHeight_mm);
    }

    // Add the captured date to the PDF
    $pdf2->SetFont('Arial', 'B', 16); // Set font: Arial, Bold, 16pt
    $pdf2->Text(10, 115, 'Captured on: ' . $date);

    // Save the PDF for the uploaded image
    $pdfName2 = '../../dokumen_bukti_verifikasi/pdf/Bukti_verifikasi_uploaded_' . time() . '.pdf';
    $pdf2->Output('F', $pdfName2);

    // Display success messages
    echo "PDF with webcam image saved successfully!<br>";
    echo "<a href='" . $pdfName1 . "'>Download PDF with Webcam Image</a><br>";
    
    echo "PDF with uploaded image saved successfully!<br>";
    echo "<a href='" . $pdfName2 . "'>Download PDF with Uploaded Image</a><br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDF with Image Editing</title>
  <style>
    body {
      display: flex;
      min-height: 100vh;
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      display: flex;
      flex-direction: row;
      align-items: flex-start;
      justify-content: center;
      width: 100%;
      padding: 20px;
    }

    .left, .right {
      width: 45%;
      max-width: 600px;
      margin: 10px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }

    .container-left {
      margin-right: 20px;
      padding:20px;
      
    }
    

    h1, h2 {
      text-align: center;
      font-size: 1.6rem;
      margin-bottom: 20px;
    }

    .left h2, .right h2 {
      background-color: black;
      color: white;
      padding: 10px;
      border-radius: 5px;
    }

    video {
      border-radius: 8px;
      width: 50%;
      height: auto;
      margin:auto;
      margin-bottom: 10px;
    }

    canvas {
      border-radius: 8px;
      width: auto;
      height: auto;
    }

    .form-group {
      margin-bottom: 15px;
      width: 100%;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input, button {
      width: 100%;
      box-sizing: border-box;
      padding: 8px;
      font-size: 14px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    button {
      background-color: #5bc0de;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #5bc0de;
    }

    #editCanvas {
      border: 1px solid #ccc;
      margin-top: 10px;
    }
    .container-fluid {
      background-color: #333;
      padding:10px;
    }
    .navbar-brand {
      color: white;
    }

  </style>
</head>
<body>  
    <div class="left"> 
      <div class="container-fluid">
        <a class="navbar-brand" >Upload and Edit Document</a>
      </div>

    <div class="container-left">
      <video id="video" autoplay></video>
      <form action="" method="POST" enctype="multipart/form-data" id="pdfForm">
        <div class="form-group">
          <label for="pdfUpload">Upload PDF:</label>
          <input type="file" name="pdf_file" id="pdfUpload" accept="application/pdf" required>
        </div>
        <div class="form-group">
          <label for="imageUpload">Upload Image (Tanda Tangan):</label>
          <input type="file" name="uploaded_image" id="imageUpload" accept="image/*">
        </div>
        <input type="hidden" name="image" id="imageData">
        <input type="hidden" name="date" id="dateData">
        <input type="hidden" name="positionX" id="positionX">
        <input type="hidden" name="positionY" id="positionY">
        <input type="hidden" name="imageWidth" id="imageWidth">
        <input type="hidden" name="imageHeight" id="imageHeight">
        <button id="capture">Capture Image & Save PDF</button>
      </form>
    </div>
  </div>

    <!-- Right section for preview -->
    <div class="right"> 
      <div class="container-fluid">
        <a class="navbar-brand" >Document Preview</a>
      </div>
      <canvas id="editCanvas" width="1000" height="700"></canvas>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.5.207/pdf.min.js"></script>
  <script>
    var video = document.getElementById('video');
    navigator.mediaDevices.getUserMedia({ video: true })
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

    document.getElementById('pdfUpload').addEventListener('change', function (e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function () {
        var typedArray = new Uint8Array(this.result);
        pdfjsLib.getDocument(typedArray).promise.then(function (pdf) {
          pdf.getPage(1).then(function (page) {
            var viewport = page.getViewport({ scale: 1.2 });
            var pdfCanvas = document.createElement('canvas');
            pdfCanvas.width = viewport.width;
            pdfCanvas.height = viewport.height;
            var pdfContext = pdfCanvas.getContext('2d');
            page.render({ canvasContext: pdfContext, viewport: viewport }).promise.then(function () {
              var imgElement = new Image();
              imgElement.src = pdfCanvas.toDataURL();
              imgElement.onload = function () {
                var imgInstance = new fabric.Image(imgElement, {
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

    document.getElementById('imageUpload').addEventListener('change', function (e) {
      var file = e.target.files[0];
      var reader = new FileReader();
      reader.onload = function () {
        var imgElement = new Image();
        imgElement.src = this.result;
        imgElement.onload = function () {
          var imgInstance = new fabric.Image(imgElement, {
            left: 50,
            top: 50,
            scaleX: 0.4,
            scaleY: 0.4
          });
          canvas.add(imgInstance);
          canvas.renderAll();

          document.getElementById('positionX').value = imgInstance.left;
          document.getElementById('positionY').value = imgInstance.top;
          document.getElementById('imageWidth').value = imgInstance.width * imgInstance.scaleX;
          document.getElementById('imageHeight').value = imgInstance.height * imgInstance.scaleY;
        };
      };
      reader.readAsDataURL(file);
    });
  </script>
</body>
</html>


