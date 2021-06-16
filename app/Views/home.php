<?= $this->extend('temp') ?>

<?= $this->section('styles') ?>
    <link rel="stylesheet" href="<?= base_url();?>/css/home.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-custom">
      <a class="navbar-brand" href="#">FEA</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <?php if($isLoggedIn == TRUE): ?>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?= base_url();?>/dashboard">Dashboard</a>
          </li> -->
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/users">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/announcements">Announcements</a>
            </li>
          <?php endif ?>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <?php if($isLoggedIn != TRUE): ?>
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
            Welcome back! <?= $username?>
          </span>
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url();?>/logout">logout</a>
            </li>
          </ul>
        <?php endif ?>
        </div>
      </div>
    </nav>
    <!-- end navbars -->

<div class="container-fluid">

</div>
    <div id="carousel" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?=base_url();?>\img\first.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        
        <!-- <div class="carousel-item">
          <img src="<?=base_url();?>\img\second.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="<?=base_url();?>\img\third.svg" alt="Los Angeles" width="100%" height="400">
          <div class="carousel-caption">
            <h3>Lorem Ipsum</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
        </div> -->
      </div>
      <a class="carousel-control-prev" href="#carousel" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </a>
      <a class="carousel-control-next" href="#carousel" data-slide="next">
        <span class="carousel-control-next-icon"></span>
      </a>
    </div>
    <!-- end carousels -->

    <div class="container-fluid" style="margin-top: 15px;">
      <div class="row">
        <div class="col announces">
          <h3 id="announceHead">Announcements</h3>
          <hr style="border-top: 5px solid white;">
          
          <!-- annoucement 1 -->
          <!-- <div class="card flex-row" style="margin-bottom: 5px;">
               <div class="card-header border-0">
                   <img src="<?= base_url();?>/img/300x200.gif" alt="" style="width: 300px; height: 200px;">
               </div>
               <div class="card-block px-2">
                 <h5 style="margin-top: 3px;">Title</h5>
                 <p>Posted in: date</p>
                 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               </div>
           </div> -->
        </div>
        <div class="col-4">
          <!-- embed video here -->
        </div>
      </div>
    </div>

<?= $this->endSection() ?>