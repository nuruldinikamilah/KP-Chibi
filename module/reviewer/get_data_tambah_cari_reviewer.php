<?php
session_start();


if($_POST['idx'])
{
     //echo 'ditemukan|4127706052|Angga Setiyadi|Teknik Informatika';

    //--------------------------------------------------------------------mode offline dosen
    /*$url = "../../data.json";
    $json = file_get_contents($url);
    $koyim = (array)json_decode($json, true);
    $found = false;

    foreach($koyim as $data) 
    {
        //login untuk dosen
         if (($data['KARYAWAN']['nip']==$_POST['idx'])&&($data['KARYAWAN']['dosen']=='1'))
         {
             echo 'ditemukan'."|".$data['KARYAWAN']['nip']."|".$data['KARYAWAN']['nama_dan_gelar']."|Dosen";
             $found = true;
          }
    }
    if (!$found) 
    {
        echo 'tidak_ditemukan'."|".$_POST['idx'];
    }
    //-------------------------------------------------------------------end mode offline dosen*/


     //--------------------------------------------------------------------mode online dosen --> konfigurasi ada di konfig db
    $url = "https://api.unikom.ac.id/auth/karyawan?nip=".$_POST['idx']."&pass=PASSWORDNYA&test";
    //https://api.unikom.ac.id/auth/karyawan?nip=41277006052&pass=PASSWORDNYA&test --> untuk tes
    $json = json_decode(file_get_contents($url), true);
    $status = $json["STATUS"];

    if ($status=='OK')
    {
       echo 'ditemukan'."|".$json["KARYAWAN"]["nip"]."|".$json["KARYAWAN"]["nama_dan_gelar"]."|Dosen";
    }
    else if ($status=='ERROR')
    {
      echo 'tidak_ditemukan|'.$_GET['kata_kunci'];
    }
     //--------------------------------------------------------------------end mode online dosen --> konfigurasi ada di konfig db


     
      
}
?>









