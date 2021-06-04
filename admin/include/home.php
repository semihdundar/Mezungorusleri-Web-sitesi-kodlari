<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hoşgeldiniz</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Hoşgeldiniz</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 <?php
				$buguntekil=0;
				$buguncogul=0;
				$geneltekil=0;
				$genelcogul=0;
				$buguntekilSorgu=$VT->VeriGetir("ziyaretciler","WHERE tarih=?",array(date("Y-m-d")),"ORDER BY ID ASC");
				if($buguntekilSorgu!=false)
				{
					$buguntekil=count($buguntekilSorgu);
					for($x=0;$x<count($buguntekilSorgu);$x++){$buguncogul+=$buguntekilSorgu[$x]["cogul"];}
				}
				$geneltekilSorgu=$VT->VeriGetir("ziyaretciler","","","ORDER BY ID ASC");
				if($geneltekilSorgu!=false)
				{
					$geneltekil=count($geneltekilSorgu);
					for($x=0;$x<count($geneltekilSorgu);$x++){$genelcogul+=$geneltekilSorgu[$x]["cogul"];}
				}
				?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?=$buguntekil?></h3>

                <p>Bugün Tekil Ziyaretçiniz</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?=$buguncogul?></h3>

                <p>Bugün Çoğul Ziyaretçiniz</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?=$geneltekil?></h3>

                <p>Toplam Tekil Ziyaretçiniz</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?=$genelcogul?></h3>

                <p>Toplam Çoğul Ziyaretçiniz</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
          <div class="col-md-5">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Genel Tarayıcı İstatistiği</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>

         
          
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
                $trycilr=$VT->VeriGetir("ziyarettarayici","WHERE ID<>?",array(5),"ORDER BY ID ASC");
                
                ?><?php if($trycilr!=false && $trycilr[0]["ziyaret"]){$crom=$trycilr[0]["ziyaret"];}else{$crom=0;}?>
                <?php if($trycilr!=false && $trycilr[2]["ziyaret"]){$mozilla=$trycilr[2]["ziyaret"];}else{$mozilla=0;}?>
                <?php if($trycilr!=false && $trycilr[1]["ziyaret"]){$internet=$trycilr[1]["ziyaret"];}else{$internet=0;}?>
                <?php if($trycilr!=false && $trycilr[3]["ziyaret"]){$diger=$trycilr[3]["ziyaret"];}else{$diger=0;}?>
  <script type="text/javascript">
    $(function () {

     


    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Diğer', 
      ],
      datasets: [
        {
          data: [<?=$crom?>,<?=$internet?>,<?=$mozilla?>,<?=$diger?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })


    });

  </script>