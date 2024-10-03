<!-- MEMBUAT FORM -->
<?php
if(($_POST['act'])=='hapus')
{
  $idx = $_POST['idx'];
  $judul = str_replace('_', ' ', $_POST['judul']);
  $nominal = $_POST['nominal'];
  ?>
   <input type="hidden" id="idx" value="<?php echo $idx;?>">
   <input type="hidden" id="judul" value="<?php echo $judul;?>">
   <input type="hidden" id="nominal" value="<?php echo $nominal;?>">
  <center><h5>Apakah Anda Akan Menghapus Dana Pengajuan <span class="blink"><b><br><br><font color="red"><?php echo $judul;?> </span></font>?</h5>
    <?php
  }
  else
  {
    echo "Terdapat Sedikit Masalah";
  }
  ?>
