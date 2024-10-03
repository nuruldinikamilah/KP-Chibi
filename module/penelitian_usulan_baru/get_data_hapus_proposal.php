<!-- MEMBUAT FORM -->
<?php
if(($_POST['act'])=='hapus')
{
  $idx = $_POST['idx'];
  $judul = str_replace('_', ' ', $_POST['judul']);
  ?>
   <input type="hidden" id="idx" value="<?php echo $idx;?>">
   <input type="hidden" id="judul" value="<?php echo $judul;?>">
  <center><h5>Apakah Anda Akan Menghapus Data Proposal <span class="blink"><b><br><br><font color="red"><?php echo $judul;?> </span></font></b> ?</h5>
    <?php
}
  else
{
    echo "Terdapat Sedikit Masalah";
}
  ?>
