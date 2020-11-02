
  <!-- page content -->
      <div class="row removeRow">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Detail Data<small>Investor</small></h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable" class="table table-striped table-bordered listTable">
                <thead>
                
                <?php 
                    foreach($data as $key => $value) {   
                    $replace = str_replace('_', ' ', $key);
                    if ($replace != 'id' && $replace != "created at" && $replace != "id master" && $replace != "tanggal" && $replace != "nomor rekening" && $replace != "nomor ktp" && $replace != "npwp" && $replace != "passport" && $replace != "kewarganegaraan" && $replace != "tingkat pajak corp" && $replace != "tingkat pajak mtn" && $replace != "kode pemegang rekening" && $replace != "status rekening" && $replace != "status balance" && $replace != "nomor sid" && $replace != "tingkat pajak equi" ){
                    $replace = ucfirst($replace);
                ?>
                  <tr>
                    <td><?php echo $replace; ?></td>
                    <td><?php echo $value; ?></td>
                  </tr>
                  <?php   }}?>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

@section('js')
 
<script>
  var listTable = $('.listTable').DataTable({
        "processing": false,
        "bFilter": false,
        "bInfo": false,
        "bLengthChange": false,
        "serverSide": false,
        "paging":   false,
        "ordering": false,
        "info":     false
  });
</script>
@endsection
 