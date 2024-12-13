<?php
		// The function header by sending raw excel
		header("Content-type: application/vnd-ms-excel");
		 
		// Defines the name of the export file "codelution-export.xls"
		date_default_timezone_set('Asia/Jakarta');
		$sekarang = date('d-m-Y');
		header("Content-Disposition: attachment; filename=Laporan Penelitian Internal-".$sekarang.".xls");
		
		include "../../config/koneksi.php";
		include "../../config/tanggal.php";
		
		 $sql_data_master=mysqli_query($server1,"SELECT
                                              a.idx_penelitian,
                                              a.judul_penelitian,
                                              a.dekripsi_penelitian,
                                              a.id_ref_kelompok_bidang,
                                              a.id_ref_kategori_bidang,
                                              a.id_ref_bidang_penelitian,
                                              a.nip_pengisi,
                                              a.nama_pengisi,
                                              a.email_pengisi,
                                              a.tahun_pengajuan,
                                              a.semester_pengajuan,
                                              a.status_pengajuan,
                                              a.dokumen_proposal,
                                               a.nilai_keseluruhan_proposal,
                                              a.tgl_insert,
                                              a.tgl_update,
                                              a.nip_reviewer,
                                              reviewer.nama_reviewer,
                                              a.skema,
                                              a.nip_pengisi_reviewer,
                                              b.nama AS nama_rumpun_ilmu,
                                              c.nama AS nama_kategori_penelitian,
                                              d.nama AS nama_bidang_penelitian,
                                              reviewer.nama_reviewer,
                                              e.`nama_peneliti`,
                                              e.`status_peneliti`,
                                              e.nip_anggota,
                                              a.catatan_reviewer
                                              FROM
                                              pengajuan_penelitian AS a
                                              INNER JOIN ref_kelompok_bidang AS b
                                              INNER JOIN ref_bidang_penelitian_simlitabmas AS c
                                              INNER JOIN ref_kategori_bidang_penelitian_simlitabmas AS d 
                                              INNER JOIN pengajuan_anggota_penelitian e
                                              ON a.id_ref_kelompok_bidang = b.id AND a.id_ref_bidang_penelitian = c.kode_bidang_penelitian_simlitabmas AND a.id_ref_kategori_bidang = d.kode_kategori_bidang_penelitian_simlitabmas AND e.`idx_penelitian` = a.`idx_penelitian`
                                              LEFT JOIN reviewer ON reviewer.nip_reviewer = a.nip_reviewer
                                              WHERE e.`status_peneliti`='Ketua'
                                                                   ");
		
		$sekarang = date('d-m-Y H:i:s');
		$tahun_sekarang = date('Y');
		?>
		<table>
		  <tr>
			<th align="left" colspan="9"><b>Tanggal Download &nbsp;</b></font><font color="#000000"><b>: &nbsp;<?php echo "$sekarang"; ?></b></font>      </td>    </th>
		  </tr>
		</table>
		
		
		<table border="0">
		  <tr>
			<th align="center" colspan="9">Laporan Pengajuan Penelitian Internal</b></font></th>
		  </tr>
		  <tr>  
			<th align="center" colspan="9"><font color="#000000"><b>Tahun <?php echo $tahun_sekarang; ?></b></font></th>
		  </tr>
		</table>
		
		
		<hr />
		<table border="80">
			<tr>
										<th width="2%">No.</th><th width="5%">Tahun Pengajuan</th><th>Judul</th><th>Skema</th><th>NIP Ketua</th><th>Nama Ketua</th><th>Nama Reviewer</th><th>Nilai Proposal</th><th width="40%">Catatan Reviewer</th>
                                    </tr>
			<?php	
			//query get data
			
			$no = 1;
			while($data = mysqli_fetch_assoc($sql_data_master))
			{
				 if (is_null($data['nilai_keseluruhan_proposal']) || is_null($data['catatan_reviewer']))
                  {
                   	$nilai=0;
	                   echo "<tr  bgcolor = 'red'>";
						echo "<td style='width:5%;vertical-align: top;' align='center'>".$no."</td>";
						echo "<td style='width:5%;vertical-align: top;' align='center'>".$data['tahun_pengajuan']."</td>";
						echo "<td style='width:15% ;vertical-align: top;'>".ucwords(strtolower($data['judul_penelitian']))."</td>";
						echo "<td style='width:7% ;vertical-align: top;'>".ucwords($data['skema'])."</td>";
						echo "<td style='width:5% ;vertical-align: top;'>".$data['nip_anggota']."</td>";
						echo "<td style='width:10% ;vertical-align: top;'>".ucwords($data['nama_peneliti'])."</td>";
						echo "<td style='width:5% ;vertical-align: top;'>".$data['nama_reviewer']."</td>";
						echo "<td style='width:5% ;vertical-align: top;' align='right'>".$nilai."</td>";
						echo "<td style='width:40%'>".$data['catatan_reviewer']."</td>";
					$no++;
					echo "</tr>";
                  }
                  else
                  {
                    	$nilai=$data['nilai_keseluruhan_proposal'];
                    	echo "<tr>";
							echo "<td style='width:5%;vertical-align: top;' align='center'>".$no."</td>";
							echo "<td style='width:5%;vertical-align: top;' align='center'>".$data['tahun_pengajuan']."</td>";
							echo "<td style='width:15% ;vertical-align: top;'>".ucwords(strtolower($data['judul_penelitian']))."</td>";
							echo "<td style='width:7% ;vertical-align: top;'>".ucwords($data['skema'])."</td>";
							echo "<td style='width:5% ;vertical-align: top;'>".$data['nip_anggota']."</td>";
							echo "<td style='width:10% ;vertical-align: top;'>".ucwords($data['nama_peneliti'])."</td>";
							echo "<td style='width:5% ;vertical-align: top;'>".$data['nama_reviewer']."</td>";
							echo "<td style='width:5% ;vertical-align: top;' align='right'>".$nilai."</td>";
							echo "<td style='width:40%'>".$data['catatan_reviewer']."</td>";
						$no++;
						echo "</tr>";
                  }
			}
			?>
		</table>