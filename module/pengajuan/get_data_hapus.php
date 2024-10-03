<!-- MEMBUAT FORM -->
<?php
if(($_POST['act'])=='hapus')
{
    ?>
    <center>
      <input type="hidden" id="idx" value="<?php echo $_POST['id'];?>">
      <input type="hidden" id="judul" value="<?php echo str_replace('_',' ',$_POST['nama'])?>">
      

      Apakah Anda Yakin Akan Menghapus <?php echo str_replace('_',' ',$_POST['nama'])?> ?</label>
      
      <?php
  }
  else
  {
    echo "Terdapat Sedikit Masalah";
}
?>
