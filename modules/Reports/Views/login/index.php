<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-dark"><?= esc($title)?></h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url();?>">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
            <li class="breadcrumb-item active">Login</li>
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

<form action="<?= base_url('admin/reports/login')?>" method="post">
  <button type="submit" class="btn btn-primary">Generate PDF</button>
</form>

<div class="card">
  <div class="card-body">
    <table class="table table-hover" id="login_report">
        <thead class="thead-light">
            <tr>
              <th scope="col" style="width: 10%">#</th>
              <th scope="col">Name</th>
              <th scope="col">Username</th>
              <th scope="col">Role Name</th>
              <th scope="col">Login Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $ctr = 1?>
            <?php foreach($logins as $login):?>
              <tr>
                <td><?= esc($ctr)?></td>
                <td><?= esc($login['first_name'])?> <?= esc($login['last_name'])?></td>
                <td><?= esc($login['username'])?></td>
                <td><?= esc($login['role_name'])?></td>
                <td><?= esc($login['login_date'])?></td>
              </tr>
              <?php $ctr++?>
            <?php endforeach?>
        </tbody>
    </table>
  </div>
</div>
<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>
  // DataTables
  $(function () {
    $('#login_report').DataTable({
        "responsive": true,
        "autoWidth": false,
      });
  });
</script>

<?= $this->endSection() ?>
