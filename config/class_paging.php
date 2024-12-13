<?php
class Paging
{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas)
{
if(empty($_GET[halaman])){
	$posisi=0;
	$_GET[halaman]=1;
}
else{
	$posisi = ($_GET[halaman]-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas)
{
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
function navHalaman($halaman_aktif, $jmlhalaman)
{
$link_halaman = "";

// Link First dan Previous
if ($halaman_aktif > 1)
{
$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&act=$_GET[act]&halaman=1><< Pertama</a></li>";
}

if (($halaman_aktif-1) > 0)
{
$previous = $halaman_aktif-1;
$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&act=$_GET[act]&halaman=$previous>< Sebelumnya</a></li>";
}

// Link halaman 1,2,3, ...
for ($i=1; $i<=$jmlhalaman; $i++)
{
if ($i == $halaman_aktif)
{
	// sip
$link_halaman .= "<li class='active'><a href='javascript:;'>$i</a></li>"; 
}
else
{
$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&act=$_GET[act]&halaman=$i>$i</a></li>";
}
$link_halaman .= " ";
}

// Link Next dan Last
if ($halaman_aktif < $jmlhalaman)
{
$next=$halaman_aktif+1;
$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&act=$_GET[act]&halaman=$next>Berikutnya ></a></li>";
}

if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0))
{
$link_halaman .= "<li><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&act=$_GET[act]&halaman=$jmlhalaman>Terakhir >></a></li>";
}
return $link_halaman;
}
}
?>
