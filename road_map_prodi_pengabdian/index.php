<?php
    //10 --> komputerisasi akuntansi
	//12 --> manajemen
    //11 --> s1 akuntansi
	//13 --> d3 akuntansi
    //17 --> ilmu pemerintahan
    //18 --> ilmu komunikasi
    //20 --> Desain Interior
	//21 --> Desain Grafis
    //37 --> sastra inggris
    //38 --> sastra jepang
    //43 --> Hubungan Internasional
    

?>
<?php
	/*if (isset($_GET['id']))
	{
		?>
			 <embed src="../road_map_prodi_pengabdian/<?php echo $_GET['id'];?>.pdf" type="application/pdf" frameborder="0" width="100%" height="700px">
		<?php
	}
	else
	{
		echo "test";
	}*/
	$filenya="../road_map_prodi_pengabdian/".$_GET['id'].".pdf";
	
	if(file_exists($filenya))
	{
 		?>
			 <embed src="../road_map_prodi_pengabdian/<?php echo $_GET['id'];?>.pdf" type="application/pdf" frameborder="0" width="100%" height="700px">
		<?php
	}
	else
	{
 		?>
 		<center><h3>Gagal Menampilkan Data<hr></h3><h1>Program Studi <br> <?php echo ucwords($_GET['nm_prodi']); ?> <br> Belum Mengumpulkan Roadmap Pengabdian</h1></center><hr>
 		<?php
	}
?>




