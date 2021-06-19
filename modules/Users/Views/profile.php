<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url();?>dist/select2/css/select2.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>dist/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('page_header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/users')?>">Users</a></li>
            <li class="breadcrumb-item active"><?= esc($title)?></li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

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
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                        src="<?= base_url()?>/uploads/profile_pic/<?= esc($user['profile_pic'])?>"
                        alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= esc($user['first_name'])?> <?= esc($user['last_name'])?></h3>
                <p class="text-muted text-center"><?= esc($user['role_name'])?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Birthdate</b> 
                        <a class="float-right">
                          <?php
                            $date = date_create(esc($user['birthdate']));
                            echo esc(date_format($date, 'F d, Y'));
                          ?>
                        </a>
                    </li>
                    <li class="list-group-item">
                      <b>Gender</b> <a class="float-right"> <?= esc($user['gender'])?> </a>
                    </li>
                    <li class="list-group-item">
                      <b>Status</b>
                      <a class="float-right">
                        <?= $user['status'] == 'a' ? 'Active': ''?>
                        <?= $user['status'] == 'i' ? 'Inactive': ''?>
                        <?= $user['status'] == 'v' ? 'Not verified': ''?>
                      </a>
                    </li>
                </ul>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <!-- User details -->
        <div class="card">
            <div class="card-header">
              User details
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="mb-2">
                <b>Username</b> <a class="float-right"><?= esc($user['username'])?></a> <br>
              </div>
              <div class="mb-2">
                <b>Contact Number</b> <a class="float-right"><?= esc($user['contact_number'])?></a> <br>
              </div>
              <div class="mb-2">
                <b>Email</b> <a class="float-right"><?= esc($user['email'])?></a> <br>
              </div>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card">
            <div class="card-header">
                Files uploaded
            </div><!-- /.card-header -->
            <div class="card-body">
                <table class="table ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">File</th>
                            <th scope="col">Date uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $ctr = 1?>
                        <?php if(empty($files)): ?>
                        <tr>
                            <td colspan="4" class="text-center">No files uploaded by user</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach($files as $file): ?>
                                <tr>
                                <td><?=esc($ctr)?></td>
                                <td><a href="<?= base_url('uploads/files')?>/<?=esc($file['name'])?>" class="card-link" target="_blank" rel="noopener noreferrer"><?= esc($file['name'])?></a></td>
                                <td>
                                    <?php
                                    $date = date_create(esc($file['uploaded_at']));
                                    echo date_format($date, 'F d, Y H:i');
                                    ?>
                                </td>
                                </tr>
                                <?php $ctr++?>            
                            <?php endforeach;?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<!-- Select2 -->
<script src="<?= base_url();?>/dist/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    // $('.select2bs4').select2({
    //   theme: 'bootstrap4',
    // })
  })
</script>

<script>
// BS4 tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // DataTables
  $(function () {
    $('#users').DataTable({
      "responsive": true,
      "autoWidth": false,
      });
  });
</script>

<!-- SweetAlert JS -->
<script src="<?= base_url();?>/js/sweetalert.min.js"></script>
<script src="<?= base_url();?>/js/sweetalert2.all.min.js"></script>
<!-- SweetAlert2 -->
<script type="text/javascript">

  $(document).ready(function ()
  {
    $('.status').on('change', function() {
      var $form = $(this).closest('form');
      $form.submit();
    });

    $('.del').click(function (e)
    {
      e.preventDefault();
      var id = $(this).val();
      console.log(id);

      Swal.fire({
        icon: 'question',
        title: 'Delete?',
        text: 'Are you sure to delete user?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })/*swal2*/.then((result) =>
      {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed)
        {
          window.location = 'users/delete/' + id;
        }
        else if (result.isDenied)
        {
          Swal.fire('Changes are not saved', '', 'info')
        }
      })//then
    });
  });
</script>
<?= $this->endSection() ?>
    