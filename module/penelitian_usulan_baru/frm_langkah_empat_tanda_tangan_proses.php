<?php
require  __DIR__  . '/vendor/phpqrcode/qrlib.php'; // Include PHP QR Code library
require  __DIR__  . '/vendor/setasign/fpdf/fpdf.php'; // Include FPDF library
require  __DIR__  . '/vendor/setasign/fpdi/src/autoload.php'; // Include FPDI for importing existing PDF
include "../../config/koneksi.php";
session_start();

use setasign\Fpdi\Fpdi; // Use FPDI for PDF manipulation
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   // Debugging input
//   // echo "<pre>";
//   // print_r($_POST);
//   // echo "</pre>";
//   // exit; // Hentikan eksekusi untuk memastikan data diterima dengan benar
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Get image data and date from form
  $imageData = $_POST['image'];
  $date = $_POST['date'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve JavaScript values passed through the form
    $positionX = $_POST['positionX']; // X position
    $positionY = $_POST['positionY']; // Y position
    $imageWidth = $_POST['imageWidth']; // Image width
    $imageHeight = $_POST['imageHeight']; // Image height


    $positionX_mm = $positionX / 3.78;
    $positionY_mm = $positionY / 3.78;
    $imageWidth_mm = $imageWidth / 3.78;
    $imageHeight_mm = $imageHeight / 3.78;
  }

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
  $webcame_name = 'Bukti_verifikasi_webcam_' . time() . '.pdf';
  $pdfName1 = '../../dokumen_bukti_verifikasi/pdf/' . $webcame_name;
  $pdf1->Output('F', $pdfName1);



  // Create a new FPDI instance for the uploaded PDF
  $pdf2 = new Fpdi();
  $pdf2->AddPage();
  $pdf2->SetAutoPageBreak(false);  // Disable automatic page breaks
  $pdf2->SetMargins(0, 0, 0);  // Disable margins to match Fabric.js
  // Load the uploaded PDF and use it as the background
  if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] == UPLOAD_ERR_OK) {
    $pdfPath = $_FILES['pdf_file']['tmp_name'];
    $pageCount = $pdf2->setSourceFile($pdfPath);
    $templateId = $pdf2->importPage(1);
    $pdf2->useTemplate($templateId, 0, 0, 210, 297); // Adjust width and height for A4 size
  } else {
    die("Error uploading PDF.");
  }

  // Convert pixels to centimeters for PDF
  $positionX_cm = ($positionX / 96 * 25.4)*1.28;
  $positionY_cm = ($positionY / 96 * 25.4)*1.28;
  $imageWidth_cm = ($imageWidth / 96 * 25.4)*1.28;
  $imageHeight_cm = ($imageHeight / 96 * 25.4)*1.28;


  // Add the uploaded image to the PDF based on the user-defined position and size
  // if ($uploadPath) {
  //   $pdf2->Image($uploadPath, $positionX_cm, $positionY_cm, $imageWidth_cm, $imageHeight_cm);
  // }

  // Add the captured date to the PDF
  $pdf2->SetFont('Arial', 'B', 16); // Set font: Arial, Bold, 16pt
  // $pdf2->Text(10, 115, 'Captured on: ' . $date);

  // Save the PDF for the uploaded image
  $pdf_nm = 'Lampiran Tanda Tangan' . time() . '.pdf';
  $pdfName2 = '../../dokumen_bukti_verifikasi/pdf/' . $pdf_nm;
  $pdf2->Output('F', $pdfName2);

  $pdf3 = new FPDI();
  $pdf3->AddPage();

  $pdfPath = $pdfName2;
  $pageCount = $pdf3->setSourceFile($pdfPath);
  $templateId = $pdf3->importPage(1);
  $pdf3->useTemplate($templateId, 0, 0, 210, 297); // Adjust width and height for A4 size

  $qrCodePath = '../../dokumen_bukti_verifikasi/qr_code/qr_code_' . time() . '.png';
  $pdfUrl = 'http://localhost/Kerja%20Praktek/KP-Chibi/dokumen_bukti_verifikasi/pdf/' . $webcame_name; // Change to the actual URL or path where the image will be hosted
  QRcode::png($pdfUrl, $qrCodePath);
  if ($_SESSION['nik_user'] == '41277006052') {
    $pdf3->Image($qrCodePath, 420 / 3.78, 625 / 3.78, 50 / 3.78, 50 / 3.78);
  } elseif ($_SESSION['nik_user'] == '41277006134') {
    $pdf3->Image($qrCodePath, 100 / 3.78, 625 / 3.78, 50 / 3.78, 50 / 3.78);
  }

  $pdf3->Output('F', $pdfName2);

  $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/kp-chibi/';
  $pdfUrl1 = $baseUrl . 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName1);
  $pdfUrl2 = $baseUrl . 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName2);

  $idx = $_POST['idx'];
  if($pdfName1 && $pdfName2){
    header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx='.$idx.'&file1='.urlencode($pdfUrl1).'&file2='.urlencode($pdfUrl2).'&status=berhasil_capture');
  }

  // Check if the form was submitted
  if (isset($_POST['submit_button'])) {
    
    $nip = $_SESSION['nik_user']; // User's NIP

    // Determine which column to insert into based on NIP
    if ($nip == '41277006052') {
        $column = 'tanda_tangan_pengaju';
    } elseif ($nip == '41277006134') {
        $column = 'tanda_tangan_dekan';
    } else {
        $column = ''; // Handle other cases as necessary
    }

    // If we have a valid column, proceed with the query
    if (!empty($column)) {
        $query = "INSERT INTO pengajuan_penelitian WHERE ($column) VALUES('$pdf_nm')";
        $query_verif = "INSERT INTO bukti_verif(file_verif) VALUES('$webcame_name')";

        // Run the queries
        $result = mysqli_query($server1, $query);
        $result_verif = mysqli_query($server1, $query_verif);

        // Check the results and output success or error messages
        if ($result) {
            echo "Data inserted successfully for $column.";
        } else {
            echo "Error inserting tanda_tangan: " . mysqli_error($server1);
        }

        if ($result_verif) {
            echo "Verification data inserted successfully.";
        } else {
            echo "Error inserting bukti_verif: " . mysqli_error($server1);
        }
    } else {
        echo "Invalid user NIP.";
    }
}


  // $result = mysqli_query($server1,"insert into tanda_tangan_penelitian(tanda_tangan_pengaju) values('$pdfUrl1')");
  // Display success messages
  // echo "PDF with webcam image saved successfully!<br>";
  // echo "<a href='" . $pdfName1 . "'>Download PDF with Webcam Image</a><br>";

  // echo "PDF with uploaded image saved successfully!<br>";
  // echo "<a href='" . $pdfName2 . "'>Download PDF with Uploaded Image</a><br>";

  // echo "
  //   <script>
  //       var idx = '{$_POST['idx']}'; // Mengambil idx dari POST
  //       var pdfUrl = '{$pdfUrl1}';
  //       var form = document.createElement('form');
  //       form.method = 'POST';
  //       form.action = 'path_to_file1.php'; 

  //       // Menambahkan input tersembunyi untuk idx dan file URL
  //       var idxInput = document.createElement('input');
  //       idxInput.type = 'hidden';
  //       idxInput.name = 'idx';
  //       idxInput.value = idx;
  //       form.appendChild(idxInput);

  //       var fileInput = document.createElement('input');
  //       fileInput.type = 'hidden';
  //       fileInput.name = 'file';
  //       fileInput.value = pdfUrl;
  //       form.appendChild(fileInput);

  //       document.body.appendChild(form);
  //       form.submit();
  //   </script>
// ";
}
?>