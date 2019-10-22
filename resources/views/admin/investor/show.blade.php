
@extends('layouts.index')
@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Detail Data<small>Investor</small></h2>
              <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Settings 1</a>
                    </li>
                    <li><a href="#">Settings 2</a>
                    </li>
                  </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
              </ul>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <table id="datatable" class="table table-striped table-bordered listTable">
                <thead>
                
                <?php 
                    foreach($data as $key => $value) {   
                    $replace = str_replace('_', ' ', $key);
                    if ($replace != 'id' && $replace != "created at" && $replace != "id master"){
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

  </div>
    <!-- /page content -->    

    <!--end-main-container-part-->
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
@stop
 