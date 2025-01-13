<?php
// echo $_SESSION['nik_user']; // User's NIP

if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
    $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
} else if (isset($_SESSION['nik_user']) && ($_SESSION['nik_user'] == '41277006134' || $_SESSION['nik_user'] == '412770002')) {
    $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
}

// Execute the query
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
            }

            tr.alternate {
                background-color: #ffffff;
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

            .cross-icon {
                color: red;
                font-weight: bold;
                text-align: center;
            }

            .check-icon {
                color: green;
                font-weight: bold;
                text-align: center;
            }

            .disabled {
                background-color: #d3d3d3;
                cursor: not-allowed;
            }
        </style>

<?php
if ($_SESSION['nik_user'] == '41277006134' || $_SESSION['nik_user'] == '412770002') { ?>
    <h2>Antrian Verifikasi</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kaprodi</th>
            <th>Dekan</th>
            <th>Lihat Proposal</th>
            <th>Lihat Pengesahan</th>
            <th></th>
        </tr>
        <?php
        $index = 1;
        while ($row = mysqli_fetch_array($sql)) {
            if ($_SESSION['nik_user'] == '41277006134' && is_null($row['tanda_tangan_kaprodi'])) {
                // For NIK 41277006134: Only show if tanda_tangan_kaprodi is NULL
                $kaprodi_signature = 'Belum Diverifikasi';
                $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><a class='button' name="cover_dokumen" href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['cover_dokumen']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='button' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Verifikasi</a>
                    <a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Tidak Verifikasi</a></td>
                </tr>
            <?php } elseif ($_SESSION['nik_user'] == '412770002' && is_null($row['tanda_tangan_dekan'])) {
                // For NIK 412770002: Only show if tanda_tangan_dekan is not NULL
                $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                $dekan_signature = 'Belum Diverifikasi' ;
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><a class='button' name="cover_dokumen" href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['cover_dokumen']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='button' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Verifikasi</a>
                    <a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Tidak Verifikasi</a></td>
                </tr>
            <?php }
        } ?>
    </table>

    <h2>Riwayat Verifikasi</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Kaprodi</th>
            <th>Dekan</th>
            <th>Waktu Tanda Tangan</th>
            <th>Lihat Pengesahan</th>
        </tr>
        <?php
        // Reset result pointer for history table
        mysqli_data_seek($sql, 0); 
        $index = 1;
        while ($row = mysqli_fetch_array($sql)) {
            if ($_SESSION['nik_user'] == '41277006134' && !is_null($row['tanda_tangan_kaprodi'])) {
                // For NIK 41277006134: Show in history if tanda_tangan_kaprodi is not NULL
                $kaprodi_signature = 'Telah Diverifkasi';
                $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><?php echo $row['waktu_tanda_tangan_kaprodi']; ?></td>
                    <td><a class='button' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                </tr>
            <?php } elseif ($_SESSION['nik_user'] == '412770002' && !is_null($row['tanda_tangan_dekan'])) {
                // For NIK 412770002: Show in history if tanda_tangan_dekan is not NULL
                $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                $dekan_signature = 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><?php echo $row['waktu_tanda_tangan_dekan']; ?></td>
                    <td><a class='button' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                </tr>
            <?php }
        } ?>
    </table>
<?php } else if ($_SESSION['nik_user'] == '41277006052'){ ?>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Documents</th>
            <th>Kaprodi Signature</th>
            <th>Dekan Signature</th>
            <th>Download</th>
        </tr>
        <?php
        $index = 1;
        while ($row = mysqli_fetch_array($sql)) {
            $file_path = "dokumen_bukti_verifikasi/pdf/" . $row['dokumen_lembar_pengesahan'];
            $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
            $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';

            $button_label = 'Download';
            $button_class = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? 'button' : 'button disabled';
            $button_action = ($kaprodi_signature === 'Telah Diverifikasi' && $dekan_signature === 'Telah Diverifikasi') ? "href='$file_path'" : '';
            ?>
            <tr>
                <td><?php echo $index++; ?></td>
                <td><?php echo $row['judul_penelitian']; ?> </td>
                <td><?php echo $row['dokumen_lembar_pengesahan']; ?> </td>
                <td><?php echo $kaprodi_signature; ?></td>
                <td><?php echo $dekan_signature; ?></td>
                <td><a class='<?php echo $button_class; ?>' <?php echo $button_action; ?>><?php echo $button_label; ?></a></td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>


    <?php } else {
        echo "<p>Belum Ada Records</p>";
    }
} else {
    // Handle query error
    echo "<p>Error: " . mysqli_error($server1) . "</p>";
}
?>
