<?php
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["reason"]) && isset($_POST["idx"]) && isset($_POST["roles"])) {
    $id = $_POST["idx"];
    $reason = trim($_POST["reason"]);
    $roles = $_POST["roles"];

    $nip = $_SESSION['nik_user']; // User's NIP
    // $pdf_nm = $_POST['dokumen_penelitian'];

    $days = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
    ];
    $months = [
        'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret', 'April' => 'April', 
        'May' => 'Mei', 'June' => 'Juni', 'July' => 'Juli', 'August' => 'Agustus', 
        'September' => 'September', 'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember'
    ];
    
    date_default_timezone_set('Asia/Jakarta'); // Set timezone to Indonesia
    
    $timestamp = time(); // Get current timestamp
    $day = $days[date('l', $timestamp)]; // Get day name in Indonesian
    $month = $months[date('F', $timestamp)]; // Get month name in Indonesian
    
    $date = "$day, " . date('j', $timestamp) . " $month " . date('Y', $timestamp) . " " . date('H:i:s', $timestamp);

    // Fetch the existing data
    
    if ($roles === "dekan") {
        $updateQuery = "UPDATE pengajuan_penelitian SET status_pengajuan = 'ditolak', catatan_dekan = ? WHERE idx_penelitian = ?";
    } else if ($roles === "kaprodi") {
        $updateQuery = "UPDATE pengajuan_penelitian SET status_pengajuan = 'ditolak', catatan_kaprodi = ? WHERE idx_penelitian = ?";
    }
    
    // Prepare and execute update query
    $stmt = mysqli_prepare($server1, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $reason, $id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal memperbarui data update pengajuan penelitian."]);
    }
    mysqli_stmt_close($stmt);
    
    $query = "SELECT dokumen_lembar_pengesahan FROM pengajuan_penelitian WHERE idx_penelitian = ?";
    $stmt = mysqli_prepare($server1, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $pdf_nm = $row['dokumen_lembar_pengesahan']; // Assign the fetched value
    }

    // Prepare the query to check if idx_penelitian exists in the table
    $checkQuery = "SELECT * FROM tanda_tangan_penelitian WHERE idx_penelitian = ?";
    $stmt = mysqli_prepare($server1, $checkQuery);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($roles === "dekan") {
        $insertQuery = "INSERT INTO tanda_tangan_penelitian (idx_penelitian, status_pengajuan, tanda_tangan_dekan, waktu_tanda_tangan_dekan) 
                        VALUES (?, 'ditolak', ?, ?)";
    } else if ($roles === "kaprodi") {
        $insertQuery = "INSERT INTO tanda_tangan_penelitian (idx_penelitian, status_pengajuan, tanda_tangan_kaprodi, waktu_tanda_tangan_kaprodi) 
                        VALUES (?, 'ditolak', ?, ?)";
    }
    
    // Prepare and execute the insert query
    $stmt = mysqli_prepare($server1, $insertQuery);
    mysqli_stmt_bind_param($stmt, "iss", $id, $pdf_nm, $date);
    // }

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Gagal memperbarui data delete pengajuan penelitian: " . mysqli_error($server1)]);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(["success" => false, "message" => "Permintaan tidak valid."]);
}
$queue_update = "UPDATE antrian_tanda_tangan 
                 SET dokumen_tanda_tangan_dekan = NULL, 
                     dokumen_tanda_tangan_kaprodi = NULL, 
                     status_pengajuan_persetujuan = '1' 
                 WHERE idx_penelitian = ?";
$stmt = mysqli_prepare($server1, $queue_update);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
?>
