<?php
header("Content-Type: application/json");
include "../../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true);
    $idx = intval($input['idx']);

    $query = "UPDATE pengajuan_penelitian SET status_pengajuan = 'ditolak' WHERE idx_penelitian = $idx";

    if (mysqli_query($server1, $query)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($server1)]);
    }
    exit;
}
