<?php
 //Define relative path from this script to mPDF
 $nama_file='Surat Jalan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','mpdf60/');
//define("_JPGRAPH_PATH", '../mpdf60/graph_cache/src/');

//define("_JPGRAPH_PATH", '../jpgraph/src/'); 
 
include(_MPDF_PATH . "mpdf.php");
//include(_MPDF_PATH . "graph.php");

//include(_MPDF_PATH . "graph_cache/src/");

$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
 
//Beginning Buffer to save PHP variables and HTML tags
//Memulai proses untuk menyimpan variabel php dan html
ob_start();
 
?>
<!-- mulai pdf -->
<!doctype html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <table>
            <tr>
                <th><img src="android.png" width="40px"></th>
                <th><h1>HARVIACODE</h1></th>
            </tr>
        </table>
        <p style="text-align: justify">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
            when an unknown printer took a galley of type and scrambled it to make a 
            type specimen book. It has survived not only five centuries, but also the 
            leap into electronic typesetting, remaining essentially unchanged. It was 
            popularised in the 1960s with the release of Letraset sheets containing 
            Lorem Ipsum passages, and more recently with desktop publishing software 
            like Aldus PageMaker including versions of Lorem Ipsum.
        </p>
</body>
</html>
 
<!-- akhir pdf -->

<?php
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf
 
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>