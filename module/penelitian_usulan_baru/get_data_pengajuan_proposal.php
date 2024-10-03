<?php
if ($_POST['idx'])
{
	?>
		<input class="form-control" type="hidden" value="<?php echo $_POST['idx']?>" id="idx">
		<table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Tekan Tombol Ajukan Usulan Jika Bapak dan Ibu Sudah Yakin Bahwa Data Yang Diisi Sudah Benar dan Tidak Akan Ada Pengubahan Data<b><br><hr>Tekan Tombol Tutup Jika Bapak dan Ibu Akan Mengubah Data Di Lain Waktu</b></h5> </center>
                            </td>
                        </tr>
                    </table>
	<?php
}
?>