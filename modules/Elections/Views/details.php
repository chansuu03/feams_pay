<?= $this->extend('adminlte') ?>

<?= $this->section('styles') ?>

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

<!-- Main content -->
<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h4>
          <?= esc($election['title'])?>
          <small class="float-right">Vote dates: <?= esc($election['start_date'])?> - <?= esc($election['end_date'])?></small>
        </h4>
      </div>
      <!-- /.col -->
    </div>

    <div class="row">
        <!-- Positions -->
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-handshake"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Positions</span>
                <span class="info-box-number"><?= esc($positionCount)?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- Candidates -->
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Candidates</span>
                <span class="info-box-number"><?= esc($candidateCount)?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- Total Votes -->
        <div class="col-md-4">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-vote-yea"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Votes</span>
                <span class="info-box-number"><?= esc($voteCount)?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <div class="row">
      <!-- Candidate List -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-text-width"></i>
              Candidate List
            </h3>
          </div>
          <div class="card-body">
            <ol>
              <?php foreach($positions as $position):?>
                <li><?= esc($position['name'])?></li>
                <ol>
                  <?php foreach($candidates as $candidate):?>
                    <?php $voteCounts = 0;?>
                    <?php if($candidate['position_id'] == $position['id']):?>
                      <?php foreach($perCandiCount as $voteCount) {
                          if(($voteCount['position_id'] && $voteCount['candidate_id']) == ($candidate['position_id'] && $candidate['id'])) {
                            $voteCounts++;
                          }
                        }?>
                      <li><?= $candidate['first_name']?> <?= $candidate['last_name']?> - <?= esc($voteCounts)?></li>
                    <?php endif;?>
                  <?php endforeach;?>
                </ol>
              <?php endforeach;?>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- this row will not appear when printing -->
    <div class="row no-print">
      <div class="col-12">
        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
          <i class="fas fa-download"></i> Generate PDF
        </button>
      </div>
    </div>
</div>
            <!-- /.invoice -->

<?= $this->endSection();?>

<?= $this->section('scripts') ?>

<script>
// BS4 tooltips
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
  // DataTables
  $(function () {
    $('#election_details').DataTable({
        "responsive": true,
        "autoWidth": false,
      });
  });
</script>
<?= $this->endSection();?>