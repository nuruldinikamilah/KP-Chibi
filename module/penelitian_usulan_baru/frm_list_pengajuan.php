<?php
// echo $_SESSION['nik_user']; // User's NIP

if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
    $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian
LEFT JOIN antrian_tanda_tangan on pengajuan_penelitian.idx_penelitian = antrian_tanda_tangan.idx_penelitian";
} else if (isset($_SESSION['nik_user']) && ($_SESSION['role'] == 'kaprodi' || $_SESSION['role'] == 'dekan')) {
    $query = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian
LEFT JOIN antrian_tanda_tangan on pengajuan_penelitian.idx_penelitian = antrian_tanda_tangan.idx_penelitian";
}
// die;
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

            .button-tidak-verif {
                background-color:rgb(206, 0, 0);
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $idx = intval($_POST['idx_penelitian']);
    
    // Update the database
    $query = "UPDATE pengajuan_penelitian SET status_pengajuan = 'ditolak' WHERE idx_penelitian = '$idx'";
    $query_update_bukti = "UPDATE tanda_tangan_penelitian SET tanda_tangan_pengaju = NULL, tanda_tangan_kaprodi = NULL, tanda_tangan_dekan = NULL, waktu_tanda_tangan_kaprodi = NULL, waktu_tanda_tangan_dekan = NULL WHERE idx_penelitian = '$idx'";

    // Execute the queries
    $result = mysqli_query($server1, $query);
    $result_update_bukti = mysqli_query($server1, $query_update_bukti);

    // Check if both queries were successful
    if ($result && $result_update_bukti) {
        
    } else {
        // Handle the error case
        echo json_encode(["success" => false, "error" => mysqli_error($server1)]);
    }
}

// ob_end_flush(); // End output buffering and send all output to the browser
?>
<div id="confirmationModal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; background: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); text-align: center; font-family: Arial, sans-serif; max-width: 400px; width: 90%;">
  <p style="margin: 0 0 20px; font-size: 16px; color: #333333; line-height: 1.5;">
    Harap cek kembali dokumen penelitian dan dokumen pengesahan. Apakah Anda yakin ingin melanjutkan proses verifikasi?
  </p>
  <div style="display: flex; gap: 10px; justify-content: center;">
    <button id="confirmButton" style="background-color: #4CAF50; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
      Lanjutkan Verifikasi
    </button>
    <button id="cancelButton" style="background-color: #f44336; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;">
      Cek Kembali
    </button>
  </div>
</div>
<div id="modalBackdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: 999;"></div>

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
            <th>Aksi</th>
        </tr>
        <?php
        $index = 1;
        $query_ambil_antrian = "SELECT * FROM pengajuan_penelitian LEFT JOIN antrian_tanda_tangan ON pengajuan_penelitian.idx_penelitian = antrian_tanda_tangan.idx_penelitian";
        $sql_ambil_antrian = mysqli_query($server1, $query_ambil_antrian);
        while ($row = mysqli_fetch_array($sql_ambil_antrian)) {
            if ($_SESSION['role'] == 'kaprodi' && $row['dokumen_tanda_tangan_kaprodi'] === NULL && $row['status_pengajuan_persetujuan'] === "0") {
                // For NIK 41277006134: Only show if tanda_tangan_kaprodi is NULL
                $kaprodi_signature = 'Belum Diverifikasi';
                $dekan_signature = is_null($row['dokumen_tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><a class='btn btn-primary fileinput-button btn-xs m-r-5' name="cover_dokumen" href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['cover_dokumen']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='btn btn-primary fileinput-button btn-xs m-r-5' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td>
                    <a 
                        class="button" 
                        href="#" 
                        onclick="confirmNavigation(
                        'view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian']; ?>'
                        )"
                    >
                        Verifikasi
                    </a>    
                    <br>
                    <br>
                    <!-- <a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Verifikasi</a> -->
                    <form onsubmit="event.preventDefault(); showModalTidakVerif();">
                        <input type="hidden" name="idx_penelitian" value="<?php echo $row['idx_penelitian']; ?>">
                        <button type="submit" class="button-tidak-verif">Tidak Verifikasi</button>
                    </form>
                    <div id="confirmationModalTidakVerif" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; background: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); text-align: center; font-family: Arial, sans-serif; max-width: 400px; width: 90%;">
                        <p style="margin: 0 0 20px; font-size: 16px; color: #333333; line-height: 1.5;">
                            Anda memilih <strong>Tidak Verifikasi</strong>. Harap cek kembali dokumen penelitian dan dokumen pengesahan. Apakah Anda yakin ingin melanjutkan proses ini?
                        </p>
                        <label for="reasonTidakVerif" style="font-weight: bold; font-size: 16px;">Komentar</label>
                        
                        <!-- Add id="idx" to make it accessible in JavaScript -->
                        <input type="hidden" id="idx" name="idx_penelitian" value="<?php echo $row['idx_penelitian']; ?>">
                        <input type="hidden" name="roles" id="roles" value="kaprodi">
                        <textarea type="text" id="reasonTidakVerif" placeholder="Tambahkan Komentar" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;"></textarea>
                        
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <button id="confirmButton" style="background-color: #f44336; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;" onclick="submitFormTidakVerif();">
                                Ya, Tidak Verifikasi
                            </button>
                            <button id="cancelButton" style="background-color: #4CAF50; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;" onclick="closeModalTidakVerif();">
                                Batal
                            </button>
                        </div>
                    </div>


                    <!-- <a class='button-tidak-verif' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Tidak Verifikasi</a></td> -->
                </tr>
            <?php } elseif ($_SESSION['role'] == 'dekan' && $row['dokumen_tanda_tangan_kaprodi'] != NULL && $row['dokumen_tanda_tangan_dekan'] === NULL && $row['status_pengajuan_persetujuan'] === "0") {
                // For NIK 412770002: Only show if tanda_tangan_dekan is not NULL
                $kaprodi_signature = is_null($row['dokumen_tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                $dekan_signature = 'Belum Diverifikasi' ;
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $kaprodi_signature; ?></td>
                    <td><?php echo $dekan_signature; ?></td>
                    <td><a class='btn btn-primary fileinput-button btn-xs m-r-5' name="cover_dokumen" href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['cover_dokumen']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td><a class='btn btn-primary fileinput-button btn-xs m-r-5' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                    <td>
                    <a 
                        class="button" 
                        href="#" 
                        onclick="confirmNavigation(
                        'view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian']; ?>'
                        )"
                    >
                        Verifikasi
                    </a>
                    <br>
                    <br>
                    <form onsubmit="event.preventDefault(); showModalTidakVerif();">
                        <input type="hidden" name="idx_penelitian" value="<?php echo $row['idx_penelitian']; ?>">
                        <button type="submit" class="button-tidak-verif">Tidak Verifikasi</button>
                    </form>
                    <div id="confirmationModalTidakVerif" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; background: #ffffff; padding: 20px 30px; border-radius: 8px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2); text-align: center; font-family: Arial, sans-serif; max-width: 400px; width: 90%;">
                        <p style="margin: 0 0 20px; font-size: 16px; color: #333333; line-height: 1.5;">
                            Anda memilih <strong>Tidak Verifikasi</strong>. Harap cek kembali dokumen penelitian dan dokumen pengesahan. Apakah Anda yakin ingin melanjutkan proses ini?
                        </p>
                        <label for="reasonTidakVerif" style="font-weight: bold; font-size: 16px;">Komentar</label>
                        
                        <!-- Add id="idx" to make it accessible in JavaScript -->
                        <input type="hidden" id="idx" name="idx_penelitian" value="<?php echo $row['idx_penelitian']; ?>">
                        <input type="hidden" name="roles" id="roles" value="<?php echo $_SESSION['role']; ?>">
                        <textarea id="reasonTidakVerif" placeholder="Tambahkan Komentar" style="width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px;"></textarea>
                        
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <button id="confirmButton" style="background-color: #f44336; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;" onclick="submitFormTidakVerif();">
                                Ya, Tidak Verifikasi
                            </button>
                            <button id="cancelButton" style="background-color: #4CAF50; color: #ffffff; border: none; border-radius: 5px; padding: 10px 20px; font-size: 14px; cursor: pointer; transition: background-color 0.3s;" onclick="closeModalTidakVerif();">
                                Batal
                            </button>
                        </div>
                    </div>

                    <!-- <a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Verifikasi</a> -->
                    <!-- <a class='button' href='view.php?menu=penelitian&act=verifikasi_tanda_tangan&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Tidak Verifikasi</a></td> -->
                </tr>
            <?php }
        } ?>
    </table>

    <h2>Riwayat Verifikasi</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Waktu Verifikasi</th>
            <th>Status</th>
            <th>Lihat Pengesahan</th>
        </tr>
        <?php
        // Reset result pointer for history table
        // mysqli_data_seek($sql, 0); 
        $query_ambil_history = "SELECT * FROM pengajuan_penelitian LEFT JOIN tanda_tangan_penelitian ON pengajuan_penelitian.idx_penelitian = tanda_tangan_penelitian.idx_penelitian";
        $ambil_history = mysqli_query($server1, $query_ambil_history);
        $index = 1;
        while ($row = mysqli_fetch_array($ambil_history)) {
            if ($_SESSION['role'] == 'kaprodi' && isset($row['tanda_tangan_kaprodi'])) {
                // For NIK 41277006134: Show in history if tanda_tangan_kaprodi is not NULL
                $kaprodi_signature = 'Telah Diverifkasi';
                $dekan_signature = is_null($row['tanda_tangan_dekan']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $row['waktu_tanda_tangan_kaprodi']; ?></td>
                    <td><?php echo $row['status_pengajuan']; ?></td>
                    <td><a class='button' href='view.php?menu=penelitian&act=lihat_dokumen&file=<?php echo $row['dokumen_lembar_pengesahan']; ?>&idx=<?php echo $row['idx_penelitian'] ?>'>Lihat Dokumen</a>
                </tr>
            <?php } elseif ($_SESSION['role'] == 'dekan' && isset($row['tanda_tangan_dekan']))  {
                // For NIK 412770002: Show in history if tanda_tangan_dekan is not NULL
                $kaprodi_signature = is_null($row['tanda_tangan_kaprodi']) ? 'Belum Diverifikasi' : 'Telah Diverifikasi';
                $dekan_signature = 'Telah Diverifikasi';
                ?>
                <tr>
                    <td><?php echo $index++; ?></td>
                    <td><?php echo $row['judul_penelitian']; ?> </td>
                    <td><?php echo $row['waktu_tanda_tangan_dekan']; ?></td>
                    <td><?php echo $row['status_pengajuan']; ?></td>
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
<script>
  let navigationUrl = ""; // To store the URL for navigation

  // Function to display the modal
  function confirmNavigation(url) {
    navigationUrl = url; // Store the target URL
    document.getElementById('confirmationModal').style.display = 'block';
    document.getElementById('modalBackdrop').style.display = 'block';
  }

  // Confirm button click handler
  document.getElementById('confirmButton').addEventListener('click', function () {
    window.location.href = navigationUrl; // Navigate to the stored URL
  });

  // Cancel button click handler
  document.getElementById('cancelButton').addEventListener('click', function () {
    document.getElementById('confirmationModal').style.display = 'none';
    document.getElementById('modalBackdrop').style.display = 'none';
  });

  function showModalTidakVerif() {
    document.getElementById('confirmationModalTidakVerif').style.display = 'block';
    document.getElementById('modalBackdropTidakVerif').style.display = 'block';
  }

  function submitFormTidakVerif() {
    console.log("Button clicked!"); // Debugging: Check if function is triggered
    
    let reason = document.getElementById("reasonTidakVerif").value.trim();
    let idxElement = document.getElementById("idx"); // Now this exists
    let roles = document.getElementById("roles").value;

    if (!idxElement) {
        alert("Error: ID not found.");
        return;
    }

    let idx = idxElement.value;

    if (reason === "") {
        alert("Silakan tambahkan komentar sebelum melanjutkan.");
        return;
    }

    console.log("Submitting request with:", { reason, idx, roles });

    fetch("module/penelitian_usulan_baru/frm_list_pengajuan_proses.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "reason=" + encodeURIComponent(reason) + "&idx=" + encodeURIComponent(idx) + "&roles=" + encodeURIComponent(roles)
    })
    
    .then(response => response.json())
    .then(data => {
        console.log("Server response:", data);
        if (data.success) {
            alert("Pengajuan telah ditolak dan catatan telah diperbarui.");
            closeModalTidakVerif();
        } else {
            alert("Terjadi kesalahan: " + data.message);
        }
    }).finally(() => {
        window.location.reload();
    });
    // window.location.reload();
    closeModalTidakVerif(); // Close the modal first
}


function closeModalTidakVerif() {
    document.getElementById("confirmationModalTidakVerif").style.display = "none";
    document.getElementById("modalBackdropTidakVerif").style.display = "none";
    console.log("Modal closed!");
}

</script>