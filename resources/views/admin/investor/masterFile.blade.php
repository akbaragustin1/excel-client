
@extends('layouts.index')
@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Detail Data<small>Master Tabel</small></h2>
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
                    <tr>
                        <th>No</th>
                        <th>Nama File</th>
                        <th>tanggal</th>
                    </tr>
                </thead>
                <body>
                
                <?php 
                    $i = 1;
                    foreach($data as $key => $value) {  

                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value['file_name']; ?></td>
                    <td><?php echo $value['date']; ?></td>
                  </tr>
                  <?php  $i++; }?>
                </tbody>
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
        "bFilter": true,
        "bInfo": true,
        "bLengthChange": true,
        "serverSide": false,
        "paging":   true,
        "ordering": true,
        "info":     true,
  });
</script>
@endsection
@stop
 