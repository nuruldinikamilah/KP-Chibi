<?php
// echo  $_SESSION['nik_user']; // User's NIP

// Check if the session ID is 41277006052
if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006052') {
  // Prepare the SQL query to check if columns a, b, and c are NULL
  $query = "SELECT * FROM tanda_tangan_penelitian WHERE tanda_tangan_pengaju IS NOT NULL AND tanda_tangan_dekan IS NULL AND tanda_tangan_kaprodi IS NULL";
  $verif_path = 'http://localhost/KP-Chibi/dokumen_bukti_verifikasi/pdf/';

    // Execute the query
    $result = mysqli_query($server1, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Display the results in an HTML table
            echo "<table border='1'>";
            echo "<tr><th>No</th><th>Documents</th><th>Verifikasi</tr>"; // Add headers for your table columns

            // Fetch the results as an associative array and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['idx_dok_tanda_tangan']) . "</td>"; // Assuming there's an 'id' column
                echo "<td>" . htmlspecialchars($row['tanda_tangan_pengaju']) . "</td>";
                echo "<td><a class='hidden-phone' href='view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan'>Verifikasi</a></td>";
                // echo "<td><a href='" . $verif_path  . htmlspecialchars($row['tanda_tangan_pengaju']) . "' target='_blank'><button type='button'>Open File</button></a></td>";
                // echo "<td><a href='" . $verif_path  . htmlspecialchars($row['tanda_tangan_pengaju']) . "' target='_blank'><button type='button'>Open File</button></a></td>";
            }

            echo "</table>";
        } else {
            echo "No records found where columns A, B, and C are NULL.";
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($server1);
    }
} else if (isset($_SESSION['nik_user']) && $_SESSION['nik_user'] == '41277006134') {
      // Prepare the SQL query to check if columns a, b, and c are NULL
    $query = "SELECT * FROM tanda_tangan_penelitian WHERE tanda_tangan_pengaju IS NOT NULL AND tanda_tangan_kaprodi IS NULL AND tanda_tangan_dekan IS NULL";
    $verif_path = 'http://localhost/KP-Chibi/dokumen_bukti_verifikasi/pdf/';

    // Execute the query
    $result = mysqli_query($server1, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any results
        if (mysqli_num_rows($result) > 0) {
            // Display the results in an HTML table
            echo "<table border='1'>";
            echo "<tr><th>No</th><th>Documents</th><th>Verifikasi</tr>"; // Add headers for your table columns
            // Fetch the results as an associative array and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['idx_dok_tanda_tangan']) . "</td>"; // Assuming there's an 'id' column
                echo "<td>" . htmlspecialchars($row['tanda_tangan_kaprodi']) . "</td>";
                echo "<td><a class='hidden-phone' href='view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan'>Verifikasi</a></td>";
                // echo "<td><a href='" . $verif_path  . htmlspecialchars($row['tanda_tangan_pengaju']) . "' target='_blank'><button type='button'>Open File</button></a></td>";
                // echo "<td><a href='" . $verif_path  . htmlspecialchars($row['tanda_tangan_pengaju']) . "' target='_blank'><button type='button'>Open File</button></a></td>";
            }

            echo "</table>";
        } else {
            echo "<h1>No records found!</h1>";
        }
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($server1);
    }
}

?>