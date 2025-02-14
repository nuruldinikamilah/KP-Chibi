<?php
require  __DIR__  . '/vendor/phpqrcode/qrlib.php'; // Include PHP QR Code library
require  __DIR__  . '/vendor/setasign/fpdf/fpdf.php'; // Include FPDF library
require  __DIR__  . '/vendor/setasign/fpdi/src/autoload.php'; // Include FPDI for importing existing PDF
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";

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
  $days = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
  $months = ['January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'];
  
  $timestamp = strtotime($date);
  $day = $days[date('l', $timestamp)];
  $month = $months[date('F', $timestamp)];
  $date = $day . ', ' . date('j', $timestamp) . ' ' . $month . ' ' . date('Y', $timestamp) . ' ' . date('H:i:s', $timestamp);

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

  $pdf1 = new FPDF();
  $pdf1->AddPage();
  $pdf1->SetFont('Arial', 'B', 12); // Set font: Arial, Bold, 16pt
  $pdf1->Text(10, 10, 'Nama Dokumen: ' . $_POST['judul_penelitian']);
  $pdf1->Text(10, 20, 'Nama Verifikator: '. $_POST['nama_user']);
  $pdf1->Text(10, 30, 'Tanggal Verifikasi: ' . $date);
  if($_SESSION["role"]=="dosen"){
      $pdf1->Text(10, 40, 'Diverifikasi Oleh: Dosen');
    }else if($_SESSION["role"]=="kaprodi"){
        $pdf1->Text(10, 40, 'Diverifikasi Oleh: Kaprodi');
    }else if($_SESSION["role"]=="dekan"){
        $pdf1->Text(10, 40, 'Diverifikasi Oleh: Dekan');
    }
    $pdf1->Text(10, 50, 'Bukti Verifikasi: ');
    $pdf1->Image($webcamImageName, 10, 60, 100, 75);

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
  $positionX_cm = ($positionX / 96 * 25.4) * 1.28;
  $positionY_cm = ($positionY / 96 * 25.4) * 1.28;
  $imageWidth_cm = ($imageWidth / 96 * 25.4) * 1.28;
  $imageHeight_cm = ($imageHeight / 96 * 25.4) * 1.28;


  // Add the uploaded image to the PDF based on the user-defined position and size
  // if ($uploadPath) {
  //   $pdf2->Image($uploadPath, $positionX_cm, $positionY_cm, $imageWidth_cm, $imageHeight_cm);
  // }

  // Add the captured date to the PDF
  $pdf2->SetFont('Arial', 'B', 16); // Set font: Arial, Bold, 16pt
  // $pdf2->Text(10, 115, 'Captured on: ' . $date);

  // Save the PDF for the uploaded image
  $pdf_nm = 'Lampiran Tanda Tangan' . time() . '.pdf';
  // $pdf_nm = "lpa-" . uniqid() . "-" . time() . '.pdf'; // 5dab1961e93a7-1571494241
  $pdfName2 = '../../dokumen_bukti_verifikasi/pdf/' . $pdf_nm;
  $pdf2->Output('F', $pdfName2);

  $pdf3 = new FPDI();
  $pdf3->AddPage();

  $pdfPath = $pdfName2;
  $pageCount = $pdf3->setSourceFile($pdfPath);
  $templateId = $pdf3->importPage(1);
  $pdf3->useTemplate($templateId, 0, 0, 210, 297); // Adjust width and height for A4 size

  $qrCodePath = '../../dokumen_bukti_verifikasi/qr_code/qr_code_' . time() . '.png';
  $pdfUrl = 'http://localhost/Kerja%20Praktek/KP-Chibi-verif-qr/dokumen_bukti_verifikasi/pdf/' . $webcame_name; // Change to the actual URL or path where the image will be hosted
  QRcode::png($pdfUrl, $qrCodePath);
  if ($_SESSION['role'] == 'dosen') {
    $pdf3->Image($qrCodePath, 420 / 3.78, 625 / 3.78, 50 / 3.78, 50 / 3.78);
  }

  $pdf3->Output('F', $pdfName2);

  $baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/kp-chibi/';
  $pdfUrl1 = $baseUrl . 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName1);
  $pdfUrl2 = $baseUrl . 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName2);

  $idx=my_simple_crypt($_POST['idx'], 'd' );

  // If we have a valid column, proceed with the query
  
  $query_pdf = "UPDATE `pengajuan_penelitian` SET `dokumen_lembar_pengesahan` = '".$pdf_nm."', status_pengajuan = NULL WHERE `idx_penelitian` = '".$idx."'";  
  $result = mysqli_query($server1, $query_pdf);

  $query_queue = "UPDATE antrian_tanda_tangan SET status_pengajuan_persetujuan = '0' WHERE idx_penelitian = '$idx'";
  $result_queue = mysqli_query($server1, $query_queue);

  $query_check = "SELECT COUNT(*) AS count FROM bukti_verif WHERE idx_pengajuan_penelitian = '$idx'";
  $result_check = mysqli_query($server1, $query_check);
  
  if ($result_check) {
      $row = mysqli_fetch_assoc($result_check);
      if ($row['count'] > 0) {
          // If the record exists, update it
          $query_verif = "UPDATE bukti_verif SET file_verif = '$webcame_name' WHERE idx_pengajuan_penelitian = '$idx'";
          $result_verif = mysqli_query($server1, $query_verif);
      } else {
          // If the record does not exist, insert a new one
          $query_verif = "INSERT INTO bukti_verif (file_verif, idx_pengajuan_penelitian) VALUES ('$webcame_name', '$idx')";
          $result_verif = mysqli_query($server1, $query_verif);
      }
  } else {
      echo "Error checking record: " . mysqli_error($connection);
  }  

  
  // Check the results and output success or error messages
  if ($result &&  $result_verif) {
    header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx=' . $_POST['idx'] . '&status=berhasil_capture');
  } else {
    echo "Error inserting data " . mysqli_error($server1);
  }

}
