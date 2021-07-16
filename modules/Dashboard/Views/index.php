<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= esc($title)?></h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div><!-- /.col -->
</div>

<?= $this->endSection();?>

<?= $this->section('content') ?>

<?php if(!empty(session()->getFlashdata('failMsg'))):?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('failMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>
<?php if(!empty(session()->getFlashdata('successMsg'))):?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->getFlashdata('successMsg');?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif;?>
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Total Users</span>
        <span class="info-box-number">
					<?= esc($userCount)?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-danger elevation-1"><i class="ion ion-document"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Files</span>
        <span class="info-box-number">
					<?= esc($fileCount)?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-success elevation-1"><i class="ion ion-document"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Active Elections</span>
        <span class="info-box-number">
					<?= esc($activeElections['count'])?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-comments"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Discussions</span>
        <span class="info-box-number">
					<?= esc($discussions)?>
        </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Elections Report</h5>
		<div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
	</div>
	<div class="card-body">
		<div class="row">
            <div class="col-md-2">
                <p class="text-center"><strong>List of active elections</strong></p>
                <ol>
                    <?php foreach($activeElections['list'] as $elections):?>
                        <li><?= esc($elections['title'])?></li>
                    <?php endforeach;?>
                </ol>
            </div>
		</div>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Files Report</h5>
		<div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
	</div>
	<div class="card-body">
		<div class="row">
			<!-- <div class="col-md-6">
				<p class="text-center">
					<strong>Monthly Files Report for <?= date('F')?></strong>
				</p>
			</div> -->
			<div class="col-md-12">
				<p class="text-center">
					<strong>File Categories</strong>
				</p>
                <!-- <div id="bar-chart"></div> -->
                <div id="donut-chart"></div>
			</div>
		</div>
	</div>
</div>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
   <script>
        var serries = JSON.parse(`<?php echo $fileCategories; ?>`);
        console.log(serries);
        var data = serries,
            config = {
            data: data,
            xkey: 'name',
            ykeys: ['count'],
            labels: ['Files uploaded'],
            fillOpacity: 0.6,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            horizontal: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red']
        };
        
        //for mories bar chart
        config.element = 'bar-chart';
        Morris.Bar(config);
        
        //for stacked bar chart
        config.element = 'stacked';
        config.stacked = true;
        Morris.Bar(config);
    </script>
    
    <script>
      var cat2 = JSON.parse(`<?php echo $fileCategories2; ?>`);  
      console.log(cat2);      
      Morris.Donut({
        element: 'donut-chart',
        data: cat2,
        colors: ['#863dc5', '#e17dd8', '#330b6a', '#856c7d', '#856c7d', '#7c1c73', '#3c2451'],
      });
    </script>
<?= $this->endSection() ?>
