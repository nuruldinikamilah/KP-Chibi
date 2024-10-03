<!-- begin #content -->
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form Langkah Pengisian</h4>
			</div>
			<?php
		                    // jika langkah 1 maka active
			if ($_GET['act']=='usulan_baru_langkah_satu')
			{
				$active_satu='active';
			}
			else
			{
				$active_satu=''; 
			}

		                    // jika langkah 2 maka active
			if ($_GET['act']=='usulan_baru_langkah_dua')
			{
				$active_dua='active';
			}
			else
			{
				$active_dua=''; 
			}

		                     // jika langkah 3 maka active
			if ($_GET['act']=='usulan_baru_langkah_tiga')
			{
				$active_tiga='active';
			}
			else
			{
				$active_tiga=''; 
			}

		    // jika langkah 4 maka active
			if ($_GET['act']=='usulan_baru_langkah_empat')
			{
				$active_empat='active';
			}
			else
			{
				$active_empat=''; 
			}

			// jika langkah 5 maka active
			if ($_GET['act']=='usulan_baru_langkah_lima')
			{
				$active_lima='active';
			}
			else
			{
				$active_lima=''; 
			}

			?>



			<div class="panel-body">			
				<ol class="bwizard-steps clearfix clickable" role="tablist">
					<li class="<?php echo $active_satu;?>" role="tab" style="z-index: 2;" aria-selected="true">
						<span class="label badge-inverse">1</span>
						<?php
						if (isset($_GET['idx']))
						{
							$link_1="idx=".$_GET['idx'];
						}
						?>
						<a class="hidden-" href="view.php?menu=pengabdian&act=usulan_baru_langkah_satu&<?php echo $link_1;?>">
							<font color="#000000">
								1. Identitas Usulan
							</a>
						</font>
							 <small>-</small>
											




					<li class="<?php echo $active_dua;?>" role="tab" style="z-index: 2;" aria-selected="true">
					<span class="label badge-inverse">2</span>
					<?php
						if (isset($_GET['idx']))
						{
							$link_1="idx=".$_GET['idx'];
							?>
								<a class="hidden-phone" href="view.php?menu=pengabdian&act=usulan_baru_langkah_dua&<?php echo $link_1;?>">
							<?php
						}
						?>
						<font color="#000000">2. Pengajuan Dana pengabdian</a>
							 <small>-</small>
						
					

						
					<li class="<?php echo $active_tiga;?>" role="tab" style="z-index: 2;" aria-selected="true">
					<span class="label badge-inverse">3</span>
					<?php
					if (isset($_GET['idx']))
					{
						$link_1="idx=".$_GET['idx'];
						?>
						<a class="hidden-phone" href="view.php?menu=pengabdian&act=usulan_baru_langkah_tiga&<?php echo $link_1;?>">
						<?php
					}
					?>
					<font color="#000000">3. Anggota Pengabdian</a>
							 <small>-</small>
						



					<li class="<?php echo $active_empat;?>" role="tab" style="z-index: 2;" aria-selected="true">
					<span class="label badge-inverse">4</span>
					<?php
					if (isset($_GET['idx']))
					{
						$link_1="idx=".$_GET['idx'];
						?>
						<a class="hidden-phone" href="view.php?menu=pengabdian&act=usulan_baru_langkah_empat&<?php echo $link_1;?>">
						<?php
					}
					?>
					<font color="#000000">
							4. Unggah Dokumen</a>
							<small>-</small>
						</a>
					</font>


					<li class="<?php echo $active_lima;?>" role="tab" style="z-index: 2;" aria-selected="true">
					<span class="label badge-inverse">5</span>
					<?php
					if (isset($_GET['idx']))
					{
						$link_1="idx=".$_GET['idx'];
						?>
						<a class="hidden-phone" href="view.php?menu=pengabdian&act=usulan_baru_langkah_lima&<?php echo $link_1;?>">
						<?php
					}
					?>
					<font color="#000000">
							5. Ajukan Usulan</a>
							<small>-</small>
						</a>
					</font>



					<!-- end panel -->
				</div>
				<!-- end col-12 -->
			</div>
			<!-- end row -->

