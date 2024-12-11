<?php
// echo $_SESSION['nik_user']; // User's NIP

if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
    $query = "SELECT * FROM pengajuan_penelitian";
} else if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006134') {
    $query = "SELECT * FROM pengajuan_penelitian";
} // Execute the query
$sql = mysqli_query($server1, $query);
// Check if the query was successful
if ($sql) {
    // Check if there are any results
    if (mysqli_num_rows($sql) > 0) { ?>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 1em;
                font-family: Arial, sans-serif;
            }

            table,
            th,
            td {
                border: 1px solid #dddddd;
                padding: 8px;
            }

            th {
                background-color: #f2f2f2;
                text-align: left;
            }

            tr {
                background-color: #f9f9f9;
                /* Warna untuk semua baris */
            }

            tr.alternate {
                background-color: #ffffff;
                /* Warna alternatif jika ingin digunakan */
            }

            a {
                text-decoration: none;
                color: #337ab7;
            }

            a:hover {
                color: #0056b3;
            }

            .button {
                background-color: #4CAF50;
                color: white;
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;
            }

            .button:hover {
                background-color: #45a049;
            }
        </style>

        <table>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Documents</th>
                <th>Verifikasi</th>
            </tr>
            <?php
            $index = 1;
            while ($row = mysqli_fetch_array($sql)) {
                $file_path = "dokumen_bukti_verifikasi/pdf/" . $row['dokumen_lembar_pengesahan']; ?>

                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $row['dokumen_lembar_pengesahan']; ?> </td>
                    <td><a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>'>Verifikasi</a></td>
                </tr>
            <?php } ?>

        </table>
<?php
    } else {
        echo "<p>No records found </p>";
    }
} else {
    // Handle query error
    echo "<p>Error: " . mysqli_error($server1) . "</p>";
}
?>