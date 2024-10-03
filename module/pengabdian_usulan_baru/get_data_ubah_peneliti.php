<?php
session_start();


if($_POST['kata_kunci'])
{
  /*
  //------------------mode offline dosen dan mahasiswa
  //cek dulu dosennya
    $url = "../../data.json";
    $json = file_get_contents($url);
    $koyim = (array)json_decode($json, true);
    $found = false;

    foreach($koyim as $data) 
    {
        //login untuk dosen
         if ($data['KARYAWAN']['nip']==$_POST['kata_kunci'])
         {
          $nama=str_replace(' ','_',$data['KARYAWAN']['nama']);
             echo 'ditemukan'."|".$data['KARYAWAN']['nip']."|".$nama."|Dosen";
             $found = true;
          }

    }
    //end cek dosen
    //jika tidak ditemukan cek mahasiswanya
    if (!$found) 
    {
      $url = "../../data_mahasiswa.json";
      $json = file_get_contents($url);
      $koyim = (array)json_decode($json, true);
      $found = false;

      foreach($koyim as $data) 
      {
           if ($data['MAHASISWA']['nim']==$_POST['kata_kunci'])
           {
          $nama=str_replace(' ','_',$data['MAHASISWA']['nama']);
               echo 'ditemukan'."|".$data['MAHASISWA']['nim']."|".$nama."|Mahasiswa";
               $found = true;
            }
      }
      
    }

    if (!$found) 
    {
      echo 'tidak_ditemukan'."|".$_POST['kata_kunci'];
    }
    //end cek
    //-----------------------------------------end mode offline dosen
    */
  

     //----------------------------- ----------mode online dosen 
     //--> konfigurasi ada di konfig db
     
     //1. cek dulu dosennya
    $url = "https://api.unikom.ac.id/auth/karyawan?nip=".$_POST['kata_kunci']."&pass=PASSWORDNYA&test";
    //https://api.unikom.ac.id/auth/karyawan?nip=41277006052&pass=PASSWORDNYA&test --> untuk tes
    $json = json_decode(file_get_contents($url), true);
    $status = $json["STATUS"];
    $found = false;

    if ($status=='OK')
    {
        echo 'ditemukan'."|".$json["KARYAWAN"]["nip"]."|".$json["KARYAWAN"]["nama_dan_gelar"]."|Dosen";
        $found = true;
    }
    //end cek dosen

    //2. cek mahasiswa
    $url = "https://api.unikom.ac.id/auth/mahasiswa?nim=".$_POST['kata_kunci']."&pass=abc&semester=20191&test";
    //https://api.unikom.ac.id/auth/mahasiswa?nim=10104104&pass=abc&semester=20191&test
    $json = json_decode(file_get_contents($url), true);
    $status = $json["STATUS"];

    if ($status=='OK')
    {
       echo 'ditemukan'."|".$json['MAHASISWA']['NIM']."|".$json['MAHASISWA']['NAMA']."|Mahasiswa";
        $found = true;
    }
     //--------------------------------------------------------------------end mode online dosen --> konfigurasi ada di konfig db
     
    //end cek mahasiswa


    if (!$found) 
    {
      echo 'tidak_ditemukan'."|".$_POST['kata_kunci'];
    }
   //----------------------------- ----------End mode online dosen 
}
?>