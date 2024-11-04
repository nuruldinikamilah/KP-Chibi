<?php
// echo $_SESSION['nik_user']; // User's NIP

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
            echo "<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        font-size: 1em;
                        font-family: Arial, sans-serif;
                    }
                    table, th, td {
                        border: 1px solid #dddddd;
                        padding: 8px;
                    }
                    th {
                        background-color: #f2f2f2;
                        text-align: left;
                    }
                    tr {
                        background-color: #f9f9f9; /* Warna untuk semua baris */
                    }
                    tr.alternate {
                        background-color: #ffffff; /* Warna alternatif jika ingin digunakan */
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
                </style>";

            // Display the results in an HTML table
            echo "<table>";
            echo "<tr><th>No</th><th>Documents</th><th>Verifikasi</th></tr>"; // Add headers for your table columns

            // Fetch the results as an associative array and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['idx_dok_tanda_tangan']) . "</td>"; // Assuming there's an 'id' column
                echo "<td>" . htmlspecialchars($row['tanda_tangan_pengaju']) . "</td>";
                echo "<td><a class='button' href='view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan'>Verifikasi</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No records found where columns A, B, and C are NULL.</p>";
        }
    } else {
        // Handle query error
        echo "<p>Error: " . mysqli_error($server1) . "</p>";
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
            echo "<style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin: 20px 0;
                        font-size: 1em;
                        font-family: Arial, sans-serif;
                    }
                    table, th, td {
                        border: 1px solid #dddddd;
                        padding: 8px;
                    }
                    th {
                        background-color: #f2f2f2;
                        text-align: left;
                    }
                    tr {
                        background-color: #f9f9f9; /* Warna untuk semua baris */
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
                </style>";

            // Display the results in an HTML table
            echo "<table>";
            echo "<tr><th>No</th><th>Documents</th><th>Verifikasi</th></tr>";

            // Fetch the results as an associative array and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['idx_dok_tanda_tangan']) . "</td>"; // Assuming there's an 'id' column
                echo "<td>" . htmlspecialchars($row['tanda_tangan_kaprodi']) . "</td>";
                echo "<td><a class='button' href='view.php?menu=penelitian&act=usulan_baru_langkah_empat_tanda_tangan'>Verifikasi</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<h1>No records found!</h1>";
        }
    } else {
        // Handle query error
        echo "<p>Error: " . mysqli_error($server1) . "</p>";
    }
}
?>
