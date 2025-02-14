<?php
require  __DIR__  . '/vendor/phpqrcode/qrlib.php'; // Include PHP QR Code library
require  __DIR__  . '/vendor/setasign/fpdf/fpdf.php'; // Include FPDF library
require  __DIR__  . '/vendor/setasign/fpdi/src/autoload.php'; // Include FPDI for importing existing PDF
include "../../config/koneksi.php";
session_start();

use setasign\Fpdi\Fpdi; // Use FPDI for PDF manipulation


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $idx = $_POST['idx'];
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

  // Create a new PDF document for the webcam image
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

  if (isset($_POST['pdf_file']) && file_exists('../../dokumen_bukti_verifikasi/pdf/' . $_POST['pdf_file'])) {
    $pdfPath = '../../dokumen_bukti_verifikasi/pdf/' . $_POST['pdf_file'];
    $pageCount = $pdf2->setSourceFile($pdfPath);
    $templateId = $pdf2->importPage(1);
    $pdf2->useTemplate($templateId, 0, 0, 210, 297); // Adjust width and height for A4 size
  } else {
      die("Error: PDF file not found.");
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
  $pdfUrl = 'http://localhost/Kerja%20Praktek/KP-Chibi-verif-qr/dokumen_bukti_verifikasi/pdf/' . $webcame_name; // Change to the actual URL or path where the image will be hosted
  QRcode::png($pdfUrl, $qrCodePath);
  
  if ($_SESSION['role'] == 'kaprodi') { // Pa han han
    $pdf3->Image($qrCodePath, 100 / 3.78, 625 / 3.78, 50 / 3.78, 50 / 3.78);
    $pdf3->SetFont('Times','',12);
    $pdf3->Text(59 / 3.78, 690 / 3.78, $_SESSION['nama_dan_gelar_user']);
    $pdf3->Text(59 / 3.78, 709 / 3.78, $_SESSION['nik_user']);
  } else if($_SESSION['role'] == 'dekan'){ // Pak dekan
    $pdf3->Image($qrCodePath, 355 / 3.78, 855 / 3.78, 50 / 3.78, 50 / 3.78);
    $pdf3->SetFont('Times','',12);
    $pdf3->Text(278 / 3.78, 920 / 3.78, $_SESSION['nama_dan_gelar_user']);
    $pdf3->Text(278 / 3.78, 939 / 3.78, $_SESSION['nik_user']);
  }
  else if($_SESSION['role'] == 'dosen'){
    $pdf3->Image($qrCodePath, 420 / 3.78, 625 / 3.78, 50 / 3.78, 50 / 3.78);
  }

  $pdf3->Output('F', $pdfName2);

  $pdfUrl1 = 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName1);
  $pdfUrl2 = 'dokumen_bukti_verifikasi/pdf/' . basename($pdfName2);

  // if($pdfName1 && $pdfName2){
  //   header('location:../../view.php?menu=penelitian&act=usulan_baru_langkah_empat&idx='.$idx.'&file1='.urlencode($pdfUrl1).'&file2='.urlencode($pdfUrl2).'&status=berhasil_capture');
  // }

  // Check if the form was submitted
  if (isset($_POST['submit_button'])) {
    
    $nip = $_SESSION['nik_user']; // User's NIP

    // Determine which column to insert into based on NIP
    } if ($_SESSION['nik_user'] == '41277006134') { // Pa han han
        $column = 'tanda_tangan_kaprodi';
        $time_col = "waktu_tanda_tangan_kaprodi";
    } else if($_SESSION['nik_user'] == '412770002'){
        $column = 'tanda_tangan_dekan';
        $time_col = "waktu_tanda_tangan_dekan";
    } else if($_SESSION['nik_user'] == '41277006052'){
        $column = 'tanda_tangan_pengaju'; // Handle other cases as necessary
    }
  }

    if ($_SESSION['role'] == 'kaprodi') { // Pa han han
      $query_update_antrian = "UPDATE antrian_tanda_tangan SET dokumen_tanda_tangan_kaprodi = '$pdf_nm' WHERE idx_penelitian = '$idx'";
    } else if($_SESSION['role'] == 'dekan'){ 
      $query_update_antrian = "UPDATE antrian_tanda_tangan SET dokumen_tanda_tangan_dekan = '$pdf_nm' WHERE idx_penelitian = '$idx'";
    }// Pak dekan
    // If we have a valid column, proceed with the query
    if (!empty($column)) {
        $ttd_penelitian_check = mysqli_query($server1, "SELECT * FROM tanda_tangan_penelitian WHERE idx_penelitian = '$idx'");
        $ttd_penelitian = mysqli_fetch_array($ttd_penelitian_check);
        $query = "INSERT INTO tanda_tangan_penelitian (idx_penelitian, $column, $time_col, status_pengajuan) 
                  VALUES ('$idx', '$pdf_nm', '$date', 'disetujui')";

        $query_update_penelitian = "UPDATE pengajuan_penelitian SET dokumen_lembar_pengesahan = '$pdf_nm' WHERE idx_penelitian = '$idx'";
        $query_verif = "INSERT INTO bukti_verifikasi(file_verif) VALUES('$webcame_name')";

        // Run the queries
        $result = mysqli_query($server1, $query);
        $result_query_update_antrian = mysqli_query($server1, $query_update_antrian);
        $result_update_penelitian = mysqli_query($server1, $query_update_penelitian);
        $result_verif = mysqli_query($server1, $query_verif);

        // Check the results and output success or error messages
        if ($result) {
            // echo "Data inserted successfully for $column.";
        } else {
            echo "Error inserting tanda_tangan: " . mysqli_error($server1);
        }

        if ($result_update_penelitian) {
            // echo "Update data inserted successfully.";
        } else {
            echo "Error update penelitian: " . mysqli_error($server1);
        }

        if ($result_verif) {
            // echo "Verification data inserted successfully.";
        } else {
            echo "Error inserting bukti_verif: " . mysqli_error($server1);
        }
        echo '<script type="text/javascript">
        alert("Berhasil");
        setTimeout(function() {
            window.location.href = "../../view.php?menu=penelitian&act=list_pengajuan";
        }, 100); // Redirect after 100 milliseconds
      </script>';
    } else {
        echo "Invalid user NIP.";
    }
?>