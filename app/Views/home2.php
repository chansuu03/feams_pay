<?= $this->extend('temp') ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url();?>/css/home.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand" href="#">FEAMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Profile <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0">
        <?php if(session()->get('isLoggedIn') != TRUE): ?>
        <span class="navbar-text" style="margin-right: 5px;">
          Already have an account?
        </span>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url();?>/login">Login</a>
          </li>
        </ul>
      <?php else: ?>
        <span class="navbar-text" style="margin-right: 5px;">
          Welcome back! <?=$user['username']?>
        </span>
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url();?>/logout">logout</a>
          </li>
        </ul>
      <?php endif ?>
    </div>
</nav>
<!-- end navbars -->

<div id="carousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" style="height: 340px;">
      <img class="d-block w-100" src="<?= base_url()?>/uploads/sliders/1623864490_d58120b02cd4203684d9.png" alt="First slide">
          <div class="carousel-caption d-none d-md-block">
            <h5>FEAMS</h5>
            <p>Welcome to FEAMS</p>
          </div>
    </div>
    <?php foreach($sliders as $slider):?>
        <div class="carousel-item" style="height: 340px;">
          <img class="img-responsive rounded" src="<?= base_url()?>/uploads/sliders/<?= esc($slider['image'])?>" alt="Second slide" style=" object-fit: cover;">
          <div class="carousel-caption d-none d-md-block">
            <h5><?= esc($slider['title'])?></h5>
            <?= esc($slider['description'], 'raw')?>
          </div>
        </div>
    <?php endforeach;?>
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<div class="container-fluid" style="margin-top: 15px;">
  <div class="row">
    <div class="col announces">
      <h3 id="announceHead">Announcements</h3>
      <hr style="border-top: 5px solid white;">    
      <?php foreach($announces as $announce):?>
        <!-- annoucement 1 -->
        <div class="card flex-row" style="margin-bottom: 5px;">
            <div class="card-header border-0">
                <img src="<?= base_url();?>/uploads/announcements/<?= esc($announce['image'], 'raw')?>" alt="" style="width: 300px; height: 200px;">
            </div>
            <div class="card-block px-2">
                <h5 style="margin-top: 3px;"><?= esc($announce['title'], 'raw')?></h5>
                <p>Posted in: <?= esc($announce['created_at'], 'raw')?></p>
                <?= esc($announce['description'], 'raw')?>
            </div>
        </div>
      <?php endforeach;?>
    </div>
    <div class="col-4">
        <!-- embed video here -->
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?php if(!empty(session()->getFlashdata('sweetalertfail'))):?>
	<!-- SweetAlert JS -->
	<script src="<?= base_url();?>/js/sweetalert.min.js"></script>
	<script src="<?= base_url();?>/js/sweetalert2.all.min.js"></script>
	<script>
		window.onload = function() {

			Swal.fire({
				icon: 'error',
				title: 'Error',
				text: 'There\'s an error accessing the page, please try again',
				confirmButtonColor: '#3085d6',
				confirmButtonText: 'Okay'
			})/*swal2*/.then((result) =>
			{
				/* Read more about isConfirmed, isDenied below */
				if (result.isConfirmed)
				{
					Swal.close()
				}
			})//then
		};
	</script>
<?php endif;?>
<?= $this->endSection() ?>