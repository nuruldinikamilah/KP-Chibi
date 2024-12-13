<form action="" method="get" data-parsley-validate="true" name="demo-form">
      <!-- begin row -->
      <div class="row">
          <!-- begin col-6 -->
          <div class="col-md-0">
             
          
            <div class="panel panel-inverse" data-sortable-id="ui-widget-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                            </div>
                            <h4 class="panel-title">Tahun Pengajuan Proposal Penelitian</h4>
                        </div>
                         <div class="panel-body"><center>
                           <?php
              echo "<select name='tahun' class='form-control' id='select-required' data-parsley-required='true'>";
                $tampil=mysqli_query($server1,"SELECT * FROM `v_tahun`");
                echo "<option value='' selected>- Pilih Tahun -</option>";
                
                while($w=mysqli_fetch_array($tampil))
                {
                  ?>
                  <option value="<?php echo $w['tahun'];?>"><?php echo $w['tahun'];?></option>
                  <?php 
                }
                 echo "</select>";
                ?><br><input type="submit" name="submit" Value="Cari Tahun Pengajuan Proposal" class="btn btn-primary btn-sm m-r-5"/>
                        </div>
                    </div>
                    <!-- end panel -->
                    <input type="hidden" name="act" value="operator_cari_tahun">
          
          <center> </center>
          </form>
          
          
          
                    <!-- end panel -->
          </div>
          <!-- end col-6 -->
        
          <hr>
        
          <!-- begin col-6 -->
          <div class="col-md-12">
              <!-- begin panel -->
                    <div class="panel panel-inverse" data-sortable-id="ui-widget-14">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">&nbsp;</h4>
                        </div>
                        <div class="panel-body">
                           


    <?php
    if(isset($_GET['submit']))
    {

      $sql_table=mysqli_query($server1,"SELECT * FROM v_landing_page_op  where tahun=".$_GET['tahun']);
        ?>
         <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <table class="table table-bordered" border="1" id="datatable">
          <thead>
            <tr>
              <th>Tahun</th>
              <th>Total Pengajuan</th>
              <th>Total Dosen Upload</th>
              <th>Total Dosen Belum Upload</th>
              <th>Total Pemetaan Reviewer</th>
              <th>Total Status Diterima</th>
              <th>Total Status Ditolak</th>

            </tr>
          </tr>
          </thead>
          <tbody>
             <?php
                $i=1;
                while($r = mysqli_fetch_array($sql_table))
              {
                  ?>
                <tr>
                  <th><?php echo $r['tahun'];?></th>
                  <th><?php echo $r['total_pengajuan'];?></th>
                  <th><?php echo $r['total_dosen_upload'];?></th>
                  <th><?php echo $r['total_dosen_belum_upload'];?></th>
                  <th><?php echo $r['total_proposal_reviewer'];?></th>
                  <th><?php echo $r['total_status_pengajuan_diterima'];?></th>
                  <th><?php echo $r['total_status_pengajuan_ditolak'];?></th>
                </tr>
                <?php
                $i++;
              }
             ?>
          </tbody>
        </table>
      



        <!-- pengabdian -->
        <?php
         $sql_table_pengabdian=mysqli_query($server1,"SELECT * FROM v_landing_page_op_pengabdian  where tahun=".$_GET['tahun']);
        ?>
        <br><br>
          <div id="container_pengabdian" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          <table class="table table-bordered" border="1" id="datatable_pengabdian">
          <thead>
            <tr>
              <th>Tahun</th>
              <th>Total Pengajuan</th>
              <th>Total Dosen Upload</th>
              <th>Total Dosen Belum Upload</th>
              <th>Total Pemetaan Reviewer</th>
              <th>Total Status Diterima</th>
              <th>Total Status Ditolak</th>

            </tr>
          </tr>
          </thead>
          <tbody>
             <?php
                $i=1;
                while($r = mysqli_fetch_array($sql_table_pengabdian))
              {
                  ?>
                <tr>
                  <th><?php echo $r['tahun'];?></th>
                  <th><?php echo $r['total_pengajuan'];?></th>
                  <th><?php echo $r['total_dosen_upload'];?></th>
                  <th><?php echo $r['total_dosen_belum_upload'];?></th>
                  <th><?php echo $r['total_proposal_reviewer'];?></th>
                  <th><?php echo $r['total_status_pengajuan_diterima'];?></th>
                  <th><?php echo $r['total_status_pengajuan_ditolak'];?></th>
                </tr>
                <?php
                $i++;
              }
             ?>
          </tbody>
        </table>

      <script type="text/javascript">
    
    
    
    
        Highcharts.chart('container', {
          data: {
              table: 'datatable'
          },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Pemantauan Pengajuan Proposal Penelitian Tahun <?php echo $_GET['tahun'] ?>'
          },
          plotOptions: {
                      series: {
                          dataLabels: {
                              enabled: true,
                              color: '#000',
                              style: {fontWeight: 'bolder'},
                              formatter: function() {return this.series.name + ': ' + this.y},
                              inside: true,
                              rotation: 270
                          },
                          pointPadding: 0.1,
                          groupPadding: 0
                      }
                  },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: 'Jumlah'
              }
          },
          credits: {
                enabled: false
              },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + ' ' + this.series.name + '</b><br/>' +
                      this.point.y + ' Peserta';
              }
          }
      });

         Highcharts.chart('container_pengabdian', {
          data: {
              table: 'datatable_pengabdian'
          },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Pemantauan Pengajuan Proposal Pengabdian Tahun <?php echo $_GET['tahun'] ?>'
          },
          plotOptions: {
                      series: {
                          dataLabels: {
                              enabled: true,
                              color: '#000',
                              style: {fontWeight: 'bolder'},
                              formatter: function() {return this.series.name + ': ' + this.y},
                              inside: true,
                              rotation: 270
                          },
                          pointPadding: 0.1,
                          groupPadding: 0
                      }
                  },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: 'Jumlah'
              }
          },
          credits: {
                enabled: false
              },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + ' ' + this.series.name + '</b><br/>' +
                      this.point.y + ' Peserta';
              }
          }
      });
              </script>
        <?php
    }
    else
    {
      $sql_grafik=mysqli_query($server1,"SELECT * FROM v_landing_page_op where tahun=year(now())");
      $sql_table=mysqli_query($server1,"SELECT * FROM v_landing_page_op  where tahun=year(now())");
      ?>
      <!--<table id="datatable" class="table table-bordered">-->
    <!-- HIDE TABLE UNTUK GRAFIK HIGHCHART-->
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <table id="datatable" style="display: none">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Total Pengajuan</th>
          <th>Total Dosen Upload</th>
          <th>Total Dosen Belum Upload</th>
          <th>Total Pemetaan Reviewer</th>
          <th>Total Status Diterima</th>
          <th>Total Status Ditolak</th>

        </tr>
      </thead>
      <tbody>
         <?php
            
            while($r = mysqli_fetch_array($sql_grafik))
          { 
              ?>
            <tr>
              <th><?php echo $r['tahun'];?></th>
              <th><?php echo $r['total_pengajuan'];?></th>
              <th><?php echo $r['total_dosen_upload'];?></th>
              <th><?php echo $r['total_dosen_belum_upload'];?></th>
              <th><?php echo $r['total_proposal_reviewer'];?></th>
              <th><?php echo $r['total_status_pengajuan_diterima'];?></th>
              <th><?php echo $r['total_status_pengajuan_ditolak'];?></th>
            </tr>
            <?php
          }
         ?>
      </tbody>
    </table>
    <!-- END HIDE -->
    
    <table class="table table-bordered" border="1">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Total Pengajuan</th>
          <th>Total Dosen Upload</th>
          <th>Total Dosen Belum Upload</th>
          <th>Total Pemetaan Reviewer</th>
          <th>Total Status Diterima</th>
          <th>Total Status Ditolak</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $i=1;
            while($w = mysqli_fetch_array($sql_table))
          {
              ?>
            <tr>
              <th><?php echo $w['tahun'];?></th>
              <th><?php echo $w['total_pengajuan'];?></th>
              <th><?php echo $w['total_dosen_upload'];?></th>
              <th><?php echo $w['total_dosen_belum_upload'];?></th>
              <th><?php echo $w['total_proposal_reviewer'];?></th>
              <th><?php echo $w['total_status_pengajuan_diterima'];?></th>
              <th><?php echo $w['total_status_pengajuan_ditolak'];?></th>
            </tr>
            <?php
            $i++;
          }
         ?>
      </tbody>
    </table>
       
    <br><br>
    <?php
      $sql_grafik=mysqli_query($server1,"SELECT * FROM v_landing_page_op_pengabdian where tahun=year(now())");
      $sql_table=mysqli_query($server1,"SELECT * FROM v_landing_page_op_pengabdian  where tahun=year(now())");
      ?>
      <!--<table id="datatable" class="table table-bordered">-->
     <div id="container_pengabdian" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <!-- HIDE TABLE UNTUK GRAFIK HIGHCHART-->
    <table id="datatable_pengabdian" style="display: none">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Total Pengajuan</th>
          <th>Total Dosen Upload</th>
          <th>Total Dosen Belum Upload</th>
          <th>Total Pemetaan Reviewer</th>
          <th>Total Status Diterima</th>
          <th>Total Status Ditolak</th>

        </tr>
      </thead>
      <tbody>
         <?php
            
            while($r = mysqli_fetch_array($sql_grafik))
          { 
              ?>
            <tr>
              <th><?php echo $r['tahun'];?></th>
              <th><?php echo $r['total_pengajuan'];?></th>
              <th><?php echo $r['total_dosen_upload'];?></th>
              <th><?php echo $r['total_dosen_belum_upload'];?></th>
              <th><?php echo $r['total_proposal_reviewer'];?></th>
              <th><?php echo $r['total_status_pengajuan_diterima'];?></th>
              <th><?php echo $r['total_status_pengajuan_ditolak'];?></th>
            </tr>
            <?php
          }
         ?>
      </tbody>
    </table>
    <!-- END HIDE -->
    
    <table class="table table-bordered" border="1">
      <thead>
        <tr>
          <th>Tahun</th>
          <th>Total Pengajuan</th>
          <th>Total Dosen Upload</th>
          <th>Total Dosen Belum Upload</th>
          <th>Total Pemetaan Reviewer</th>
          <th>Total Status Diterima</th>
          <th>Total Status Ditolak</th>
        </tr>
      </thead>
      <tbody>
         <?php
            $i=1;
            while($w = mysqli_fetch_array($sql_table))
          {
              ?>
            <tr>
              <th><?php echo $w['tahun'];?></th>
              <th><?php echo $w['total_pengajuan'];?></th>
              <th><?php echo $w['total_dosen_upload'];?></th>
              <th><?php echo $w['total_dosen_belum_upload'];?></th>
              <th><?php echo $w['total_proposal_reviewer'];?></th>
              <th><?php echo $w['total_status_pengajuan_diterima'];?></th>
              <th><?php echo $w['total_status_pengajuan_ditolak'];?></th>
            </tr>
            <?php
            $i++;
          }
         ?>
      </tbody>
    </table>






  

    

      <script type="text/javascript">
    
    
    
    
        Highcharts.chart('container', {
          data: {
              table: 'datatable'
          },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Pemantauan Pengajuan Proposal Penelitian Tahun <?php echo date("Y"); ?>'
          },
          plotOptions: {
                      series: {
                          dataLabels: {
                              enabled: true,
                              color: '#000',
                              style: {fontWeight: 'bolder'},
                              formatter: function() {return this.series.name + ': ' + this.y},
                              inside: true,
                              rotation: 270
                          },
                          pointPadding: 0.1,
                          groupPadding: 0
                      }
                  },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: 'Jumlah'
              }
          },
          credits: {
                enabled: false
              },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + ' ' + this.series.name + '</b><br/>' +
                      this.point.y + ' Peserta';
              }
          }
      });


       Highcharts.chart('container_pengabdian', {
          data: {
              table: 'datatable_pengabdian'
          },
          chart: {
              type: 'column'
          },
          title: {
              text: 'Grafik Pemantauan Pengajuan Proposal Pengabdian Tahun <?php echo date("Y"); ?>'
          },
          plotOptions: {
                      series: {
                          dataLabels: {
                              enabled: true,
                              color: '#000',
                              style: {fontWeight: 'bolder'},
                              formatter: function() {return this.series.name + ': ' + this.y},
                              inside: true,
                              rotation: 270
                          },
                          pointPadding: 0.1,
                          groupPadding: 0
                      }
                  },
          yAxis: {
              allowDecimals: false,
              title: {
                  text: 'Jumlah'
              }
          },
          credits: {
                enabled: false
              },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.x + ' ' + this.series.name + '</b><br/>' +
                      this.point.y + ' Peserta';
              }
          }
      });
              </script>
                     
                   
                           
    <?php
    }
    ?>
    
    
    
    
    
      
         

