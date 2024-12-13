<!-- MEMBUAT FORM -->
<?php
if(($_POST['act'])=='batal')
{
  $idx = $_POST['idx'];
  $judul = str_replace('_', ' ', $_POST['judul']);
  ?>
   <input type="hidden" id="idx" value="<?php echo $idx;?>">
   <input type="hidden" id="judul" value="<?php echo $judul;?>">
  <center><h5>Apakah Anda Akan Membatalkan Pengajuan Data Proposal Pengabdian <span class="blink"><b><br><br><font color="red"><?php echo $judul;?> </span></font></b> ?</h5>
    <?php
}
  else
{
    echo "Terdapat Sedikit Masalah";
}
  ?>
