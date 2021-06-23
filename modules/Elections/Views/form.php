<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url()?>/dist/adminlte/plugins/daterangepicker/daterangepicker.css">

<?= $this->endSection() ?>

<?= $this->section('page_header');?>
<div class="row mb-2">
    <div class="col-sm-6">
            <h1><?= esc($title)?></h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('admin/elections')?>">Elections</a></li>
            <li class="breadcrumb-item active"><?= esc($title)?></li>
        </ol>
    </div>
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

<form action="<?= base_url('admin/elections')?>/<?= $edit ? 'edit/'.esc($link): 'add'?>" method="post" enctype="multipart/form-data">

<div class="card card-light">
    <div class="card-body">
        <div class="form-group">
            <label for="title">Election Title</label>
            <input type="text" class="form-control <?=isset($errors['title']) ? 'is-invalid': ''?>" id="title" placeholder="Election Title" name="title">
            <?php if(isset($errors['title'])):?>
                <div class="invalid-feedback">
                    <?=esc($errors['title'])?>
                </div>
            <?php endif;?>
        </div>
        <div class="form-group">
            <label for="title">Start and End Date</label>
            <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <input type="text" class="form-control float-right <?=isset($errors['start_date']) ? 'is-invalid': ''?>  <?=isset($errors['end_date']) ? 'is-invalid': ''?>" id="reservation">
                <?php if(isset($errors['start_date']) && !isset($errors['end_date'])):?>
                  <div class="invalid-feedback">
                      <?=esc($errors['start_date'])?>
                  </div>
                <?php endif;?>
                <?php if(isset($errors['end_date']) && !isset($errors['start_date'])):?>
                  <div class="invalid-feedback">
                      <?=esc($errors['end_date'])?>
                  </div>
                <?php endif;?>
                <?php if(isset($errors['end_date']) && isset($errors['start_date'])):?>
                  <div class="invalid-feedback">
                      Start and end date is invalid
                  </div>
                <?php endif;?>
            </div>
            <input type="hidden" name="start_date" id="start_date">
            <input type="hidden" name="end_date" id="end_date">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="float-end btn btn-primary btn-sm" >Submit</button>
    </div>
</div>
</form>

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<!-- InputMask -->
<script src="<?= base_url();?>/dist/adminlte/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();?>/dist/adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?= base_url();?>/dist/adminlte/plugins/daterangepicker/daterangepicker.js"></script>
<script>
  $(function () {
    $('#reservation').daterangepicker({
      autoUpdateInput: false,
      locale: {
        format: 'MMM DD,YYYY',
        cancelLabel: 'Clear'
      }
    }, function(start, end, label) {
        document.getElementById('start_date').value = start.format('YYYY-MM-DD');
        document.getElementById('end_date').value = end.format('YYYY-MM-DD');
    });

    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MMM DD,YYYY') + ' - ' + picker.endDate.format('MMM DD,YYYY'));
    });

    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
  })
</script>
<?= $this->endSection();?>