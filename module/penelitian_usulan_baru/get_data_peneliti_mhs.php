<?php
session_start();


if($_GET['kata_kunci'])
{
  /*
  //--------------------------------------------------------------------mode offline dosen
   $url = "../../data_mahasiswa.json";
    $json = file_get_contents($url);
    $koyim = (array)json_decode($json, true);
    $found = false;

    foreach($koyim as $data) 
    {
        //login untuk dosen
         if ($data['MAHASISWA']['nim']==$_GET['kata_kunci'])
         {
             echo 'ditemukan'."|".$data['MAHASISWA']['nim']."|".$data['MAHASISWA']['nama']."|Mahasiswa";
             $found = true;
          }
    }
    if (!$found) 
    {
        echo 'tidak_ditemukan'."|".$_GET['kata_kunci'];
    }
    //-------------------------------------------------------------------end mode offline dosen
  */
  

   //--------------------------------------------------------------------mode online dosen --> konfigurasi ada di konfig db
   $url = "https://api.unikom.ac.id/auth/mahasiswa?nim=".$_GET['kata_kunci']."&pass=abc&semester=20191&test";
    //https://api.unikom.ac.id/auth/mahasiswa?nim=10104104&pass=abc&semester=20191&test
    $json = json_decode(file_get_contents($url), true);
    $status = $json["STATUS"];

    if ($status=='OK')
    {
       echo 'ditemukan'."|".$json['MAHASISWA']['NIM']."|".$json['MAHASISWA']['NAMA']."|Mahasiswa";
    }
    else if ($status=='ERROR')
    {
      echo 'tidak_ditemukan|'.$_GET['kata_kunci'];
    }
     //--------------------------------------------------------------------end mode online dosen --> konfigurasi ada di konfig db
}
?>









