<script>
function blink_text() {
    $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
}
setInterval(blink_text, 1000);
</script>


<!-- pop up modal dialog tambah peneliti untuk dosen -->
<div class="modal fade" id="modal-dialog-peneliti-dosen" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                            <div class="fetched-data"></div>
                        </div>
                </div>
            </div>
</div>
<!-- end pop up -->



<!-- pop up modal dialog tambah peneliti untuk mahasiswa -->
<div class="modal fade" id="modal-dialog-peneliti-mhs" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                            <div class="fetched-data"></div>
                        </div>
                </div>
            </div>
</div>
<!-- end pop up -->


<!-- pop up modal dialog tambah peneliti untuk dosen luar -->
<div class="modal fade" id="modal-dialog-peneliti-dosen-luar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                            <div class="fetched-data-dosen-luar"></div>
                        </div>
                </div>
            </div>
</div>
<!-- end pop up -->


<!-- pop up modal-dialog-cari-ubah-anggota-peneliti ditemukan-->
<div class="modal fade" id="ubah-anggota-peneliti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table-condensed table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <div class='tampil_idx'></div>
                                            <td class="text-left align-text-bottom col-md-2" style="width: 40%">
                                                <label for=""><b>Masukan NIP/NIM Anggota Peneliti</b></label>
                                            </td>
                                            <td class="text-left" style="width: 20%"><input id="kata_kunci_ubah" class="form-control input-sm" value=""></td>
                                            <td class="text-left" style="width: 20%"><button type="button" class="btn btn-danger submitBtn" onclick="cari_ubah_peneliti()">Cari Peneliti</button></td>
                                        </tr>
                                    </table>
                            </div>
                            <hr>
                        <div class="tampil_data_ditemukan">
                            <!--data ubah dosen dan mahasiswa akan tampil disini -->

                            <!-- end data ubah dosen dan mahasiswa akan tampil disini -->
                        </div>
                    </div>
                </div>
            </div>
</div>
<!-- end pop up modal-dialog-cari-ubah-anggota-peneliti ditemukan-->


<!-- pop up modal-dialog-cari-ubah-anggota-pengabdian ditemukan-->
<div class="modal fade" id="ubah-anggota-pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table-condensed table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <div class='tampil_idx'></div>
                                            <td class="text-left align-text-bottom col-md-2" style="width: 40%">
                                                <label for=""><b>Masukan NIP/NIM Anggota Pengabdian</b></label>
                                            </td>
                                            <td class="text-left" style="width: 20%"><input id="kata_kunci_ubah_abdi" class="form-control input-sm" value=""></td>
                                            <td class="text-left" style="width: 20%"><button type="button" class="btn btn-danger submitBtn" onclick="cari_ubah_pengabdian()">Cari Anggota</button></td>
                                        </tr>
                                    </table>
                            </div>
                            <hr>
                        <div class="tampil_data_ditemukan_abdi">
                            <!--data ubah dosen dan mahasiswa akan tampil disini -->

                            <!-- end data ubah dosen dan mahasiswa akan tampil disini -->
                        </div>
                    </div>
                </div>
            </div>
</div>
<!-- end pop up modal-dialog-cari-ubah-anggota-pengabdian ditemukan-->


<!-- pop up modal-dialog-cari-ubah-anggota-peneliti ditemukan-->
<div class="modal fade" id="ubah-nip-session-anggota-peneliti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                    <div class='tampil_idx_session'></div>
                        <div class="tampil_data_ditemukan_session">
                            <!--data ubah dosen dan mahasiswa akan tampil disini -->

                            <!-- end data ubah dosen dan mahasiswa akan tampil disini -->
                        </div>
                    </div>
                </div>
            </div>
</div>
<!-- end pop up modal-dialog-cari-ubah-anggota-peneliti ditemukan-->

<!-- pop up modal-ubah pengabdian dosen-->
<div class="modal fade" id="ubah-anggota-pengabdian-dosen-luar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                    <div class="modal-body">
                
                        <div class="fetched-data-ubah-dosen-luar"></div>
                    </div>
                            <hr>
                      
                    </div>
                </div>
            </div>
</div>
<!-- pop up modal-ubah pengabdian dosen-->

<!-- pop up modal dialog hapus dana -->
<div class="modal fade" id="hapus-modal-peneliti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_penelitis()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus dana -->


<!-- pop up modal dialog hapus pengabdian -->
<div class="modal fade" id="hapus-modal-pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_peneliti()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus pengabdian -->


<!-- pop up ubah reviewer-->
<div class="modal fade" id="ubah-nip-session-anggota-peneliti" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Tutup</span>
                        </button>
                        <h4 class="modal-title" id="labelModalKu">Pesan</h4>
                    </div>

                   <div class="modal-body">
                    <div class='tampil_idx_session'></div>
                        <div class="tampil_data_ditemukan_session">
                            <!--data ubah dosen dan mahasiswa akan tampil disini -->

                            <!-- end data ubah dosen dan mahasiswa akan tampil disini -->
                        </div>
                    </div>
                </div>
            </div>
</div>
<!-- end pop up ubah reviewer-->

<!-- pop up modal dialog hapus peneliti -->
<div class="modal fade" id="ubah-reviewer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Ubah Data</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

           
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus peneliti -->



<!-- pop up modal dialog hapus dana -->
<div class="modal fade" id="hapus-modal-dana" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_dana_pengajuan()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus dana -->



<!-- pop up modal dialog hapus dana -->
<div class="modal fade" id="hapus-modal-dana-pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_dana_pengajuan_pengabdian()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus dana -->






<!-- Validasi Form Identitas Usulan -->
    <div class="modal fade" id="modal-dialog-judul-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Isikan Judul</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-dialog-deskripsi-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Isikan Deskripsi</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-rumpunilmu-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Pilih Rumpun Ilmu </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-kategori_bidang_pilih-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Pilih Bidang Kategori </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-kategori_bidang_pilih-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Pilih Bidang Kategori </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
     <div class="modal fade" id="modal-dialog-kategori_bidang_sudah_dipilih-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Pilih Bidang </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- End Validasi Form Identitas Usulan -->


<!-- VALIDASI Anggota Peneliti  -->
    <div class="modal fade" id="modal-dialog-ceklis-banyak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">BAHAYA !!</h4>
                </div>
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>
                                <img src="img/error.png">
                            </td>
                            <td width="80%">
                                <center><b><h5><span class="blink"><font color="red">Anda Sudah Memilih Ketua Sebelumnya !!</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                                        
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

   <div class="modal fade" id="modal-dialog-anggota_peneliti_sudah_dipilih">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Anggota Peneliti Sudah Ada, Silahkan Pilih Anggota Peneliti Lainnya</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-anggota_peneliti_1_kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Silahkan Isi status No 1</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-dialog-ketua_hanya_satu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Ketua Sudah Dipilih</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-dialog-ketua_wajib_satu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">1 Penelitian Wajib Mempunyai Ketua</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-anggota_peneliti_terapan_satu_anggota">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Penelitian Terapan Tidak Diperbolehkan Perorangan</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman Penelitian Internal Tahun 2022.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-anggota_peneliti_terapan_wajib_mahasiswa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Penelitian Terapan Berkelompok, Wajib Terdapat Mahasiswa</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Panduan Penelitian Internal 2021.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-anggota_peneliti_dasar_wajib_mahasiswa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Penelitian Dasar Berkelompok, Wajib Terdapat Mahasiswa</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Panduan Penelitian Internal 2021.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-anggota_peneliti_dasar_dua">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Penelitian Dasar Tidak Diperbolehkan Data Lebih Dari 2</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Panduan Penelitian Internal 2021.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!--END VALIDASI Anggota Peneliti  -->


<!-- validasi anggota pengabdian -->
<div class="modal fade" id="modal-dialog-anggota_mahasiswa_kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Pengabdian Kepada Masyarakat Internal Wajib Memiliki Minimal 1 Mahasiswa</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman_P2M.pdf";?>" download>Download File Panduan Pengabdian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- end validasi anggota pengabdian -->


<!-- validasi anggota pengabdian -->
<div class="modal fade" id="modal-dialog-anggota_mahasiswa_lebih_dari_3">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Pengajuan Anggota Pengusul untuk Mahasiswa Tidak Boleh Lebih Dari 3 Orang</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman_P2M.pdf";?>" download>Download File Panduan Pengabdian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- end validasi anggota pengabdian -->



<!-- validasi anggota pengabdian -->
<div class="modal fade" id="modal-dialog-dosen-wajib-lebih-dari-satu">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Pengabdian Yang Anda Ajukan, Wajib Memiliki Pengusul Dosen Lebih Dari Satu</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman_P2M.pdf";?>" download>Download File Panduan Pengabdian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- end validasi anggota pengabdian -->



<!-- validasi anggota pengabdian -->
<div class="modal fade" id="modal-dialog-anggota_pkm_wajib_mahasiswa">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Program Ini, Wajib Terdapat 1 anggota Dosen dan Wajib Terdapat Mahasiswa</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman_P2M.pdf";?>" download>Download File Panduan Pengabdian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- end validasi anggota pengabdian -->

<!-- validasi anggota pengabdian -->
<div class="modal fade" id="modal-dialog-anggota_dosen_lebih_dari_2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Peneliti Dosen Tidak Boleh Lebih Dari Dua Orang Untuk Skema ini</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Pedoman_P2M.pdf";?>" download>Download File Panduan Pengabdian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- end validasi anggota pengabdian -->

<div class="modal fade" id="modal-dialog-skema-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Penelitian Tidak Diperbolehkan Kosong</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Panduan Penelitian Internal 2021.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="modal-dialog-kk-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Kelompok Keilmuan Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="modal-dialog-sumber-dana-kosong-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Sumber Dana Tidak Diperbolehkan Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-dialog-skema-terapan-mitra-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Mitra Tidak Boleh Kosong Untuk Skema Penelitian Terapan</font></span></b><b></b></h5> 
                                    
                                    <br><a href="<?php echo "panduan/Panduan Penelitian Internal 2021.pdf ";?>" download>Download File Panduan Penelitian Internal</a>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>



<!-- VALIDASI FILE PROPOSAL -->
<div class="modal fade" id="modal-dialog-error-ukuran">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>File Proposal Yang Anda Unggah Terlalu Besar, <span class="blink"><font color="red"> <br><br>Maksimal 5 MB</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI FILE PROPOSAL -->


<!-- VALIDASI SUKSES Ubah -->
<div class="modal fade" id="modal-dialog-sukses-validasi-dirlppm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Memvalidasi Data Proposal </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES Ubah -->

<!-- VALIDASI SUKSES TAMBAH -->
<div class="modal fade" id="modal-dialog-sukses-tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Menambah Data</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES TAMBAH -->

<!-- VALIDASI SUKSES UBAH -->
<div class="modal fade" id="modal-dialog-sukses-ubah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Mengubah Data</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES UBAH -->


<!-- VALIDASI ERROR MYSQL -->
<div class="modal fade" id="modal-dialog-gagal-db">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Gagal Menyimpan Data<span class="blink"><font color="red"> <br><br>KODE ERROR : <?php echo $_GET['kode'];?></font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI ERROR MYSQL -->

<!-- VALIDASI ERROR EKSTENSI -->
<div class="modal fade" id="modal-dialog-gagal-ekstensi">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Gagal Menyimpan Data<span class="blink"><font color="red"> <br><br>Jenis File <?php echo $_GET['jenis'];?> Tidak Diperbolehkan</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI ERROR EKSTENSI -->

<!-- VALIDASI ERROR EKSTENSI -->
<div class="modal fade" id="modal-dialog-file-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Silahkan Masukan<span class="blink"><font color="red"> <br><br>File Anda !!!</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI ERROR EKSTENSI -->

<!-- VALIDASI ERROR EKSTENSI -->
<div class="modal fade" id="modal-dialog-file-lp-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Silahkan Masukan<span class="blink"><font color="red"> <br><br>File Lembar Pengesahan Anda !!!</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI ERROR EKSTENSI -->

<!-- VALIDASI ERROR EKSTENSI -->
<div class="modal fade" id="modal-dialog-file-mitra-abdi-kosong">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Silahkan Masukan<span class="blink"><font color="red"> <br><br>File Mitra Pengabdian!!!</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI ERROR EKSTENSI -->


<!-- pop up modal dialog hapus peneliti -->
<div class="modal fade" id="hapus-pengajuan-proposal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_proposal()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus peneliti -->

<!-- pop up modal dialog hapus peneliti -->
<div class="modal fade" id="hapus-pengajuan-proposal_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="hapus_proposal_pengabdian()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus peneliti -->



<!-- pop up modal dialog hapus peneliti -->
<div class="modal fade" id="batal-pengajuan-proposal_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
                
                <div class="fetched-batal-data"></div>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger submitBtn" onclick="batal_proposal_pengabdian()">Setuju</button>
            </div>
        </div>
    </div>
</div>
<!-- end pop up modal dialog hapus peneliti -->

<div class="modal fade" id="validasi-pengajuan-penerimaan" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Validasi Pengajuan Penerimaan Proposal</h4>
            </div>

            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>

          
        </div>
    </div>
</div>


<div class="modal fade" id="validasi-pengajuan-penerimaan_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Validasi Pengajuan Penerimaan Proposal</h4>
            </div>

            <div class="modal-body">
                <div class="fetched-data-pengabdian"></div>
            </div>

          
        </div>
    </div>
</div>

<div class="modal fade" id="pengajuan-pemetaan-reviewer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pemetaan Reviewer</h4>
            </div>

            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>

          
        </div>
    </div>
</div>


<div class="modal fade" id="pengajuan-pemetaan-reviewer_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pemetaan Reviewer Pengbdian</h4>
            </div>

            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>

          
        </div>
    </div>
</div>

<div class="modal fade" id="pengajuan-koreksi-reviewer" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true"> 
   <!--<div class="modal-dialog" style="width:1550px;">-->
    <div class="modal-dialog" style="width:90%; height:70%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Koreksi Pengajuan</h4>
            </div>

            <div class="modal-body">
                <div class="fetched-data"></div>
            </div>

          
        </div>
    </div>
</div>


<div class="modal fade" id="pengajuan_koreksi" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" >
    <div class="modal-dialog" style="width:90%; height:70%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Form Penilaian Pengajuan Proposal</h4>
                <center><img src="img/loadinganimation.gif" class="waiting_sub" id="waiting_sub"/></center>  
            </div>

            <div class="modal-body">
                <!-- hati2 fetch berpengaruh terhadap validasi nilai-->
                <div class="fetched-data-pengajuan-koreksi"></div>
            </div>

            
        </div>
    </div>
</div>

<div class="modal fade" id="pengajuan_koreksi_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" >
    <div class="modal-dialog" style="width:90%; height:70%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Form Penilaian</h4>
            </div>

            <div class="modal-body">
                <!-- hati2 fetch berpengaruh terhadap validasi nilai-->
                <div class="fetched-data-pengajuan-pengabdian-koreksi"></div>
            </div>

            
        </div>
    </div>
</div>

<div class="modal fade" id="kemajuan_koreksi_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" >
    <div class="modal-dialog" style="width:90%; height:70%;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Form Penilaian Koreksi Kemajuan Pengabdian Internal</h4>
            </div>

           <div class="modal-body">
                <!-- hati2 fetch berpengaruh terhadap validasi nilai-->
                <div class="fetched-data-kemajuan_koreksi_pengabdian"></div>
            </div>

            
        </div>
    </div>
</div>

<!-- VALIDASI SUKSES TAMBAH -->
<div class="modal fade" id="modal-dialog-sukses-ubah-rubik">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Mengubah Data <?php echo $_GET['skema_post'];?></font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES TAMBAH -->

<!-- VALIDASI SUKSES Mengubah Status -->
<div class="modal fade" id="modal-dialog-sukses-ubah-status">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Mengubah Status </font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES TAMBAH -->


<!-- VALIDASI SUKSES Mengubah Status -->
<div class="modal fade" id="modal-dialog-sukses-isi-reviewer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Mengisi Reviewer</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI SUKSES TAMBAH -->

<!-- VALIDASI File -->
<div class="modal fade" id="modal-dialog-error-file">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><span class="blink"><font color="red">File PDF Yang di Upload Tidak Boleh Lebih Besar Dari 5 MB</font></span></b><b></b></h5> </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>
<!-- END VALIDASI File-->

<div class="modal fade" id="change-role-reviewer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <?php
                        $reviewer=my_simple_crypt($_SESSION['random_id']."|reviewer", 'e' );
                        $dosen=my_simple_crypt($_SESSION['random_id']."|dosen", 'e' );
                    ?>
                <div class="modal-body">
                <center><p>
                    
                    <br><h5>Anda adalah Reviewer dan Dosen Pengusul, Silahkan Memilih</p>
                            <hr>
                            <a class="btn btn-primary" href="view.php?rl=<?php echo $reviewer;?>" role="button">Login Sebagai Reviewer</a>
                            <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a></h5>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal-dialog-sukses-validasi-proposal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Mengajukan Proposal</font></span>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

<!-- VALIDASI Ajukan File Proposal -->
<div class="modal fade" id="ajukan_proposal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">PESAN</h4>
            </div>

            <div class="modal-body">
                <!-- hati2 fetch berpengaruh terhadap validasi nilai-->
                <div class="fetched-data-pengajuan-proposal"></div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="ajukan_usulan_penelitian()">Ajukan Usulan</button>
            </div>
            
        </div>
    </div>
</div>
<!-- END VALIDASI Ajukan File Proposal -->



<!-- VALIDASI Ajukan File Proposal -->
<div class="modal fade" id="ajukan_proposal_pengabdian" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="static" >
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">PESAN</h4>
            </div>

            <div class="modal-body">
                <!-- hati2 fetch berpengaruh terhadap validasi nilai-->
                <div class="fetched-data-pengajuan-proposal"></div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary submitBtn" onclick="ajukan_usulan_pengabdian()">Ajukan Usulan</button>
            </div>
            
        </div>
    </div>
</div>
<!-- END VALIDASI Ajukan File Proposal -->

<div class="modal fade" id="modal-dialog-sukses-menilai-reviewer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5>Sukses<span class="blink"><font color="red"> <br><br>Menilai Proposal  </font></span>
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="change-role-dir-lppm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <?php
                        $dir_lppm=my_simple_crypt($_SESSION['random_id']."|dir_lppm", 'e' );
                        $reviewer=my_simple_crypt($_SESSION['random_id']."|reviewer", 'e' );
                        $dosen=my_simple_crypt($_SESSION['random_id']."|dosen", 'e' );
                    ?>
                <div class="modal-body">
                <center><p>
                    <br>Anda adalah Direktur DP3M, Reviewer dan Dosen Pengusul, Silahkan Memilih</p>
                                <hr>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dir_lppm;?>" role="button">Login Sebagai Direktur DP3M</a><br><br>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $reviewer;?>" role="button">Login Sebagai Reviewer</a>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="change-role-dir-lppm-dosen">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <?php
                        $dir_lppm=my_simple_crypt($_SESSION['random_id']."|dir_lppm", 'e' );
                        $reviewer=my_simple_crypt($_SESSION['random_id']."|reviewer", 'e' );
                        $dosen=my_simple_crypt($_SESSION['random_id']."|dosen", 'e' );
                    ?>
                <div class="modal-body">
                <center><p>
                    <br>Anda adalah Direktur DP3M Dan Dosen, Silahkan Memilih</p>
                                <hr>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dir_lppm;?>" role="button">Login Sebagai Direktur DP3M</a><br><br>
                                <a class="btn btn-primary" href="view.php?rl=<?php echo $dosen;?>" role="button">Login Sebagai Dosen</a>
                </div>
            </div>
        </div>
    </div>

    <!-- PENGABDIAN -->
     <div class="modal fade" id="modal-dialog-skema-terapan-mitra-kosong-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Mitra Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-dialog-skema-terapan-skema-kosong-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Skema Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-nama_mitra-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Nama Mitra Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-alamat_mitra-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Alamat Mitra Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-penanggung_jawab-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Penanggung Jawab Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-id_ref_sumber_dana-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Sumber Dana Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-tipel-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Tingkat Penyelenggara Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

     <div class="modal fade" id="modal-dialog-tanggal-pelaksanaan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Tanggal Awal Pelaksanaan <br><br>dan <br><br>Tanggal Akhir Pelaksanaan <br><br>Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-tanggal-besar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">PESAN</h4>
                    </div>
                    <div class="modal-body">
                    <table>
                            <tr>
                                <td>
                                    <img src="img/logo_unikom.jpg">
                                </td>
                                <td width="100%" align="center">
                                    <center><b><h5><span class="blink"><font color="red">Tanggal Awal Pelaksanaan <br><br>Tidak Boleh Lebih Besar Dari <br><br>Tanggal Akhir Pelaksanaan</font></span></b><b></b></h5> 
                                    </center>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                      <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="modal-dialog-tempel-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Tempat Pelaksanaan Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-dialog-luaran-pengabdian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">PESAN</h4>
                </div>
                <div class="modal-body">
                <table>
                        <tr>
                            <td>
                                <img src="img/logo_unikom.jpg">
                            </td>
                            <td width="100%" align="center">
                                <center><b><h5><span class="blink"><font color="red">Luaran Yang Dihasilkan Tidak Boleh Kosong</font></span></b><b></b></h5> 
                                </center>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                  <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Tutup</a>
                </div>
            </div>
        </div>
    </div>

    <!-- END PENGABDIAN -->


<!-- end new div insert here -->
<div class="modal fade" id="tambah-reviewer-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"  data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Tutup</span>
                </button>
                <h4 class="modal-title" id="labelModalKu">Pesan</h4>
            </div>

            <div class="modal-body">
              <table class="table-condensed table-striped table-bordered">
                <thead>
                  <tr>
                    <td class="text-left align-text-bottom col-md-2" style="width: 40%">
                      <label for=""><b>Masukan NIP Calon Reviewer</b></label>
                    </td>
                    <td class="text-left" style="width: 40%"><input id="kata_kunci_reviewer" class="form-control input-sm" name="" size="60" value=""></td>
                    <td class="text-left"><a href="#" id="btn_cari_reviewer" class="btn btn-sm btn-danger">Cari Reviewer &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
                  </tr>
                  <tr></tr>
                </table>
           

            <br>
            <div class="fetched-data"></div>

           
        </div>
    </div>
</div>



