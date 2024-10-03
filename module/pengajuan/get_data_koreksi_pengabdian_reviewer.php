<style>
.intro {
  font-size: 150%;
  color: red;
}
</style>
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script>
  function blink_text() {
    $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
  }
  setInterval(blink_text, 1000);
</script>

<script>
   $(document).ready(function()
   {
      $('input[type=radio][name=answer_0]').change(function() 
        {
          var str = $(this).val();
          str = str.split('|');
          $('#pilihan_0').val(str[0]);
        });

         $('input[type=radio][name=answer_1]').change(function() 
        {
           var str = $(this).val();
          str = str.split('|');
          $('#pilihan_1').val(str[0]);
        });

         $('input[type=radio][name=answer_2]').change(function() 
        {
           var str = $(this).val();
          str = str.split('|');
          $('#pilihan_2').val(str[0]);
        });

          $('input[type=radio][name=answer_3]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_3').val(str[0]);
        });

          $('input[type=radio][name=answer_4]').change(function() 
        {
           var str = $(this).val();
          str = str.split('|');
          $('#pilihan_4').val(str[0]);
        });

          $('input[type=radio][name=answer_5]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_5').val(str[0]);
        });

          $('input[type=radio][name=answer_6]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_6').val(str[0]);
        });

          $('input[type=radio][name=answer_7]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_7').val(str[0]);
        });

          $('input[type=radio][name=answer_8]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_8').val(str[0]);
        });

          $('input[type=radio][name=answer_9]').change(function() 
        {
            var str = $(this).val();
          str = str.split('|');
          $('#pilihan_9').val(str[0]);
        });

         //jumlahkan seluruhnya
         $('input[type="radio"]').change(function()
         {
            if ($('input:radio[name=answer_0]').is(':checked')) 
            { 
              var pilihan_0 = parseFloat($('#pilihan_0').val());
            }
            else
            {
               var pilihan_0 = 0;
            }

            if ($('input:radio[name=answer_1]').is(':checked')) 
            { 
              var pilihan_1 = parseFloat($('#pilihan_1').val());
            }
            else
            {
               var pilihan_1 = 0;
            }

            if ($('input:radio[name=answer_2]').is(':checked')) 
            { 
              var pilihan_2 = parseFloat($('#pilihan_2').val());
            }
            else
            {
               var pilihan_2 = 0;
            }

            if ($('input:radio[name=answer_3]').is(':checked')) 
            { 
              var pilihan_3 = parseFloat($('#pilihan_3').val());
            }
            else
            {
               var pilihan_3 = 0;
            }

             if ($('input:radio[name=answer_4]').is(':checked')) 
            { 
              var pilihan_4 = parseFloat($('#pilihan_4').val());
            }
            else
            {
               var pilihan_4 = 0;
            }

            if ($('input:radio[name=answer_5]').is(':checked')) 
            { 
              var pilihan_5 = parseFloat($('#pilihan_5').val());
            }
            else
            {
               var pilihan_5 = 0;
            }

             if ($('input:radio[name=answer_6]').is(':checked')) 
            { 
              var pilihan_6 = parseFloat($('#pilihan_6').val());
            }
            else
            {
               var pilihan_6 = 0;
            }

            if ($('input:radio[name=answer_7]').is(':checked')) 
            { 
              var pilihan_7 = parseFloat($('#pilihan_7').val());
            }
            else
            {
               var pilihan_7 = 0;
            }

            if ($('input:radio[name=answer_8]').is(':checked')) 
            { 
              var pilihan_8 = parseFloat($('#pilihan_8').val());
            }
            else
            {
               var pilihan_8 = 0;
            }

            if ($('input:radio[name=answer_9]').is(':checked')) 
            { 
              var pilihan_9 = parseFloat($('#pilihan_9').val());
            }
            else
            {
               var pilihan_9 = 0;
            }

           hasil_akhir = (pilihan_0+pilihan_1+pilihan_2+pilihan_3+pilihan_4+pilihan_5+pilihan_6+pilihan_7+pilihan_8+pilihan_9);
           var nilai_akhir = hasil_akhir.toFixed(2);
           $('#hasil_akhir').val(nilai_akhir);
        });

         //simpan hasil akhir
          //hasil_akhir = parseFloat($('#pilihan_0').val())+parseFloat($('#pilihan_1').val())+parseFloat($('#pilihan_2').val())+parseFloat($('#pilihan_3').val())+parseFloat($('#pilihan_4').val())+parseFloat($('#pilihan_5').val())+parseFloat($('#pilihan_6').val())+parseFloat($('#pilihan_7').val())+parseFloat($('#pilihan_8').val());
          //var nilai_akhir = hasil_akhir.toFixed(2);
          //$('#hasil_akhir').val(hasil_akhir);
});

</script>

<?php
include "../../config/koneksi.php";
include "../../lib/enkripsi_decrpt.php";
include "../../config/f_rupiah.php";  

if ($_POST['act']=='pengajuan_koreksi_pengabdian')
{
  $data_id = my_simple_crypt($_POST['data_id'], 'd' );
                            $sql_get_data=mysqli_query($server1,"SELECT 
                            *,
                            b.`nama` AS nama_rumpun_ilmu,
                            c.`nama` AS nama_kategori_penelitian,
                            d.`nama` AS nama_bidang_penelitian,
                            f.`kode_bagian`,
                            g.`nama` AS prodi_pengusul
                          FROM
                            lppm2020.pengajuan_pengabdian a 
                            INNER JOIN lppm2020.`ref_kelompok_bidang` b 
                            INNER JOIN lppm2020.`ref_bidang_penelitian_simlitabmas` c 
                            INNER JOIN lppm2020.`ref_kategori_bidang_penelitian_simlitabmas` d 
                            INNER JOIN integrasi.`karyawan_bagian` f
                            INNER JOIN integrasi.`ref_bagian` g
                              ON a.`id_ref_kelompok_bidang` = b.`id` 
                              AND a.`id_ref_bidang_penelitian` = c.`kode_bidang_penelitian_simlitabmas` 
                              AND a.`id_ref_kategori_bidang` = d.`kode_kategori_bidang_penelitian_simlitabmas` 
                              AND a.`nip_pengisi` = f.`nip`
                              AND f.`kode_bagian` = g.`kode_bagian`
                                             WHERE `idx_pengabdian`= '".$data_id."'");
   $rs=mysqli_fetch_array($sql_get_data);

  ?>



 <form action="module/pengajuan/get_data_koreksi_reviewer_pengabdian_submit.php" method="post"  name="frm" class="form-inline" onsubmit="return validasi_pengajuan_koreksi();">
  <input type="hidden" value="<?php echo $_POST['data_id'];?>" name="idx_pengabdian">
  <input type="hidden" value="<?php echo my_simple_crypt($rs['judul'], 'e' );?>" name="judul"> 
                <table class="table table-condensed table-striped table-bordered text-center">
                <tbody>
                    <tr>
                        <td class="width:100%" colspan="5">
                          <?php $skema = $rs['skema']?>
                          <center><b>Form Penilaian Pengajuan Proposal Pengabdian<?php echo strtoupper($rs['skema']);?></b></center>
                       </td>
                    </td>
                   <td class="width:60%">
                      <center><b>File Pengajuan Proposal Pengabdian</b></center>
                    </td>
                 </tr>
            <tr>
                <th style="width:2%">No</th>
                <th style="width:20%">Aspek Yang Dinilai</th>
                <th style="width:10%">Nilai</th>
                <th style="width:2%">Bobot</th>
                <th style="width:10%">Keterangan</th>
                <th rowspan="10">
                  <?php
                        if ($rs['dokumen_proposal']!='')
                        {
                          ?>
                          <embed src="<?php echo "dokumen_upload_pengabdian/".$rs['dokumen_proposal'];?>" type="application/pdf" frameborder="0" width="100%" height="700px">
                            <!--<div class="embed-responsive embed-responsive-16by9">
                              <iframe class="embed-responsive-item" src="<?php //echo "dokumen_upload/".$rs['dokumen_proposal'];?>"  width="704" height="504">
                              </iframe>
                            </div>-->
                            <br><br>
                             <label for="" id="tdcatatan"><b>Komentar Reviewer</b></label><br>
                           <textarea class="form-control" cols="120" rows="6" name="komentar" id="komentar"><?php echo $rs['catatan_reviewer'];?></textarea>
                          <?php
                        }
                        else
                        {
                          ?>
                          <center><span class="blink"><font color="red"><b>Dosen Belum Mengupload Proposal</span></b></font></center>
                          <?php
                        }
                      ?>

                </th>
            </tr>

            <?php
              //tampil kuesioner
              $data_skema='pengabdian';

              $sql_get_data_kuesioner=mysqli_query($server1,"SELECT 
                                                             * 
                                                            FROM 
                                                             ref_rubik
                                                            INNER JOIN
                                                             `penilaian_rubik_pengabdian`
                                                            ON `ref_rubik`.`idx_rubik` = `penilaian_rubik_pengabdian`.`idx_rubik`
                                                            WHERE `ref_rubik`.`nama_skema`='".$data_skema."' AND `idx_pengabdian`='".$data_id."' 
                                                            ORDER BY ref_rubik.idx_rubik" );
              


            $jumlah_data=mysqli_num_rows($sql_get_data_kuesioner);
            while($w = mysqli_fetch_array($sql_get_data_kuesioner))
            {
              $idx_penilaian[]=$w['idx_penilaian'];
              $data_pertanyaan[] = $w['pertanyaan'];
              $data_bobot[] = 1;
              $skala_pilih[] = $w['skala_pilih'];
              $nilai_rubik[]=$w['nilai_rubik'];
              $skala[]=$w['skala_pilih'];
            }
            ?>
            <input type="hidden" value="<?php echo $jumlah_data;?>" name="jumlah_data">
               <tr>
                   <td>1</td>
                   <input type="hidden" name="idx_nilai_1" value="<?php echo $idx_penilaian[0];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[0];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[4]="";
                      $title[3]="";
                      $title[2]="";
                    ?>
                    5<input type="radio" name="answer_0" value="<?php echo 5*$data_bobot[0]."|5";?>" <?php if($skala[0]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_0" value="<?php echo 4*$data_bobot[0]."|4";?>" <?php if($skala[0]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[4];?>">
                    3<input type="radio" name="answer_0" value="<?php echo 3*$data_bobot[0]."|3";?>"<?php if($skala[0]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_0" value="<?php echo 2*$data_bobot[0]."|2";?>"<?php if($skala[0]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[2];?>">
                    1<input type="radio" name="answer_0" value="<?php echo 1*$data_bobot[0]."|1";?>"<?php if($skala[0]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[2];?>">
                  </td>
                    <td> <input type="text" name="pilihan_0" value="<?php echo $nilai_rubik[0];?>" id="pilihan_0" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                <tr>
                    <td>2</td>
                    <input type="hidden" name="idx_nilai_2" value="<?php echo $idx_penilaian[1];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[1];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_1" value="<?php echo 10*$data_bobot[1]."|5";?>" <?php if($skala[1]=='5'){ echo "checked=checked";}  ?>   title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_1" value="<?php echo 8*$data_bobot[1]."|4";?>" <?php if($skala[1]=='4'){ echo "checked=checked";}  ?>   title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_1" value="<?php echo 6*$data_bobot[1]."|3";?>" <?php if($skala[1]=='3'){ echo "checked=checked";}  ?>   title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_1" value="<?php echo 4*$data_bobot[1]."|2";?>" <?php if($skala[1]=='2'){ echo "checked=checked";}  ?>   title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_1" value="<?php echo 2*$data_bobot[1]."|1";?>" <?php if($skala[1]=='1'){ echo "checked=checked";}  ?>   title="<?php echo $title[3];?>">
                  </td>
                    <td> <input type="text" name="pilihan_1" value="<?php echo $nilai_rubik[1];?>" id="pilihan_1" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                  <tr>
                    <td>3</td>
                     <input type="hidden" name="idx_nilai_3" value="<?php echo $idx_penilaian[2];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[2];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_2" value="<?php echo 10*$data_bobot[2]."|5";?>" <?php if($skala[2]=='5'){ echo "checked=checked";}  ?>  title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_2" value="<?php echo 8*$data_bobot[2]."|4";?>" <?php if($skala[2]=='4'){ echo "checked=checked";}  ?>  title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_2" value="<?php echo 6*$data_bobot[2]."|3";?>" <?php if($skala[2]=='3'){ echo "checked=checked";}  ?>  title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_2" value="<?php echo 4*$data_bobot[2]."|2";?>" <?php if($skala[2]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_2" value="<?php echo 2*$data_bobot[2]."|1";?>" <?php if($skala[2]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                  </td>
                    <td> <input type="text" name="pilihan_2" value="<?php echo $nilai_rubik[2];?>" id="pilihan_2" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                 <tr>
                    <td>4</td>
                     <input type="hidden" name="idx_nilai_4" value="<?php echo $idx_penilaian[3];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[3];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_3" value="<?php echo 15*$data_bobot[3]."|5";?>" <?php if($skala[3]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_3" value="<?php echo 12*$data_bobot[3]."|4";?>" <?php if($skala[3]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_3" value="<?php echo 9*$data_bobot[3]."|3";?>" <?php if($skala[3]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_3" value="<?php echo 6*$data_bobot[3]."|2";?>" <?php if($skala[3]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_3" value="<?php echo 3*$data_bobot[3]."|1";?>"<?php if($skala[3]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                  </td>
                    <td> <input type="text" name="pilihan_3" value="<?php echo $nilai_rubik[3];?>" id="pilihan_3" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                 <tr>
                    <td>5</td>
                     <input type="hidden" name="idx_nilai_5" value="<?php echo $idx_penilaian[4];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[4];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[4]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_4" value="<?php echo 15*$data_bobot[4]."|5";?>" <?php if($skala[4]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_4" value="<?php echo 12*$data_bobot[4]."|4";?>" <?php if($skala[4]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[4];?>">
                    3<input type="radio" name="answer_4" value="<?php echo 9*$data_bobot[4]."|3";?>" <?php if($skala[4]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_4" value="<?php echo 6*$data_bobot[4]."|2";?>" <?php if($skala[4]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_4" value="<?php echo 3*$data_bobot[4]."|1";?>"<?php if($skala[4]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                  </td>
                    </td>
                    <td> <input type="text" name="pilihan_4" value="<?php echo $nilai_rubik[4];?>" id="pilihan_4" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                 <tr>
                    <td>6</td>
                     <input type="hidden" name="idx_nilai_6" value="<?php echo $idx_penilaian[5];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[5];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_5" value="<?php echo 5*$data_bobot[5]."|5";?>"  <?php if($skala[5]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_5" value="<?php echo 4*$data_bobot[5]."|4";?>"  <?php if($skala[5]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_5" value="<?php echo 3*$data_bobot[5]."|3";?>"  <?php if($skala[5]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_5" value="<?php echo 2*$data_bobot[5]."|2";?>"  <?php if($skala[5]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_5" value="<?php echo 1*$data_bobot[5]."|1";?>"  <?php if($skala[5]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                  </td>
                    <td> <input type="text" name="pilihan_5" value="<?php echo $nilai_rubik[5];?>" id="pilihan_5" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                 <tr>
                    <td>7</td>
                     <input type="hidden" name="idx_nilai_7" value="<?php echo $idx_penilaian[6];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[6];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                      $title[1]="";
                    ?>

                    5<input type="radio" name="answer_6" value="<?php echo 5*$data_bobot[6]."|5";?>" <?php if($skala[6]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_6" value="<?php echo 4*$data_bobot[6]."|4";?>" <?php if($skala[6]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_6" value="<?php echo 3*$data_bobot[6]."|3";?>" <?php if($skala[6]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_6" value="<?php echo 2*$data_bobot[6]."|2";?>" <?php if($skala[6]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_6" value="<?php echo 1*$data_bobot[6]."|1";?>"<?php if($skala[6]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[1];?>">
                  </td>
                    <td> <input type="text" name="pilihan_6" value="<?php echo $nilai_rubik[6];?>" id="pilihan_6" size="3" readonly></td>
                   <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                 </tr>
                  <tr>
                    <td>8</td>
                     <input type="hidden" name="idx_nilai_8" value="<?php echo $idx_penilaian[7];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[7];?></td>
                    <td class="text-left">
                    <?php
                      $title[5]="";
                      $title[3]="";
                      $title[1]="";
                    ?>
                    5<input type="radio" name="answer_7" value="<?php echo 10*$data_bobot[7]."|5";?>" <?php if($skala[7]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_7" value="<?php echo 8*$data_bobot[7]."|4";?>" <?php if($skala[7]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_7" value="<?php echo 6*$data_bobot[7]."|3";?>" <?php if($skala[7]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_7" value="<?php echo 4*$data_bobot[7]."|2";?>" <?php if($skala[7]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_7" value="<?php echo 2*$data_bobot[7]."|1";?>"<?php if($skala[7]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[1];?>">
                  </td>
                    <td> <input type="text" name="pilihan_7" value="<?php echo $nilai_rubik[7];?>" id="pilihan_7" size="3" readonly></td>
                     <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                  </tr>
                   <tr>
                    <td>9</td>
                     <input type="hidden" name="idx_nilai_9" value="<?php echo $idx_penilaian[8];?>">
                   <td class="text-left"><?php echo $data_pertanyaan[8];?></td>
                    <td class="text-left">
                     
                    5<input type="radio" name="answer_8" value="<?php echo 5*$data_bobot[8]."|5";?>" <?php if($skala[8]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_8" value="<?php echo 4*$data_bobot[8]."|4";?>" <?php if($skala[8]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_8" value="<?php echo 3*$data_bobot[8]."|3";?>" <?php if($skala[8]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_8" value="<?php echo 2*$data_bobot[8]."|2";?>" <?php if($skala[8]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_8" value="<?php echo 1*$data_bobot[8]."|1";?>"<?php if($skala[8]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[1];?>">
                  </td>
                    <td> <input type="text" name="pilihan_8" value="<?php echo $nilai_rubik[8];?>" id="pilihan_8" size="3" readonly></td>
                    <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                  </tr>
                  <tr>
                    <td>10</td>
                     <input type="hidden" name="idx_nilai_10" value="<?php echo $idx_penilaian[9];?>">
                    <td class="text-left"><?php echo $data_pertanyaan[9];?> <blink><span class="blink"><font color="red">
                    <?php
                    $kode_bagian=$rs['kode_bagian'];
                  ?>
                  <b><br>
                  
                 <a href="#" style="color:#FF0000;" 
                    target="popup" 
                    onclick="window.open('http:jpi.unikom.ac.id/pengajuanproposal/road_map_prodi_pengabdian/index.php?id=<?php //echo $kode_bagian;
                    echo $rs['kode_bagian'];?>&<?php echo "nm_prodi=".$rs['prodi_pengusul'];?>','popup',`width=800,height=700=${window.outerHeight/2 - 300},left=${window.outerWidth/2 - 300}`); return false;">
                      Klik Untuk Melihat RoadMap Program Studi Pengusul</b></font></span></blink></td></a>
                    <td class="text-left">
                     <?php
                      $title[5]="";
                      $title[3]="";
                    ?>
                    5<input type="radio" name="answer_9" value="<?php echo 20*$data_bobot[9]."|5";?>" <?php if($skala[9]=='5'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    4<input type="radio" name="answer_9" value="<?php echo 16*$data_bobot[9]."|4";?>" <?php if($skala[9]=='4'){ echo "checked=checked";}  ?> title="<?php echo $title[5];?>">
                    3<input type="radio" name="answer_9" value="<?php echo 12*$data_bobot[9]."|3";?>" <?php if($skala[9]=='3'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    2<input type="radio" name="answer_9" value="<?php echo 8*$data_bobot[9]."|2";?>" <?php if($skala[9]=='2'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                    1<input type="radio" name="answer_9" value="<?php echo 4*$data_bobot[9]."|1";?>"<?php if($skala[9]=='1'){ echo "checked=checked";}  ?> title="<?php echo $title[3];?>">
                  </td>
                    <td> <input type="text" name="pilihan_9" value="<?php echo $nilai_rubik[9];?>" id="pilihan_9" size="3" readonly></td>
                   <td class="text-left">1 = sangat kurang<br>2 = kurang <br>3 = cukup <br>4 = baik <br>5 = sangat baik</td>
                  </tr>
                  
                  <tr>
                    <td colspan="3"><b>Hasil Akhir</b></td>
                   
                    <td> <input type="text" name="hasil_akhir"  id="hasil_akhir" size="3" value="<?php echo $rs['nilai_keseluruhan_proposal'];?>" readonly></td>
                    <td></td>
                  </tr>
            </table>     

  <hr>
    <div class="modal-footer">
      <center><center><button class="btn btn-info m-r-5 m-b-5" type="submit" name="submit">SIMPAN DATA</button>
    </div>
      </form>
  <?php
}
else
{
        ?>
            <center><h5>Hayo Mau Ngapain</h5></center>
        <?php
}
?>



