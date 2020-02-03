@extends('layouts.index')
@section('content')

@section('header')
 <!-- bootstrap-daterangepicker -->
 <link href="{{ URL::asset('') }}plugins/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="{{ URL::asset('') }}plugins/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Ion.RangeSlider -->
    <link href="{{ URL::asset('') }}plugins/vendors/normalize-css/normalize.css" rel="stylesheet">
    <link href="{{ URL::asset('') }}plugins/vendors/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="{{ URL::asset('') }}plugins/vendors/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet">
    <!-- Bootstrap Colorpicker -->
    <link href="{{ URL::asset('') }}plugins/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="{{ URL::asset('') }}plugins/vendors/cropper/dist/cropper.min.css" rel="stylesheet">
<style>
@keyframes spinner {
  to {transform: rotate(360deg);}
}
 
.spinner:before {
  content: '';
  box-sizing: border-box;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 20px;
  height: 20px;
  margin-top: -10px;
  margin-left: -10px;
  border-radius: 50%;
  border: 2px solid #ccc;
  border-top-color: #333;
  animation: spinner .6s linear infinite;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    color: white !important;
    border: 1px solid #2980B9!important;
    background-color: #2980B9!important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2980B9), color-stop(100%, #2980B9))!important;
    background: -webkit-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -moz-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -ms-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -o-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: linear-gradient(to bottom, #2980B9 0%, #2980B9 100%)!important;
}

.current {
    color: white !important;
    border: 1px solid #2980B9!important;
    background-color: #2980B9!important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2980B9), color-stop(100%, #2980B9))!important;
    background: -webkit-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -moz-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -ms-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: -o-linear-gradient(top, #2980B9 0%, #2980B9 100%)!important;
    background: linear-gradient(to bottom, #2980B9 0%, #2980B9 100%)!important;
}


</style>
@endsection
  <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                <h2>Form Pengecekan Di tanggal ke 1</h2>
                    <div class ="first">
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link test form1"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    </div>
                    <div class ="second hidden">
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link refresh form2"><i class="fa fa-chevron-down"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    </div>
                <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br />
                <form id="signupForm" data-parsley-validate class="form-horizontal form-label-left signupForm">

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Ke 1<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control tanggal" id="tanggal" name="tanggal" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal Ke 2<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control tanggal2" id="tanggal2" name="tanggal2" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <button type="submit" class="btn btn-success submit">Submit</button>
                    </div>
                    <div hidden>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    </div>
                </div>
                    <div class="ln_solid"></div>
                </form>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                <div class="x_title">
                    <h2 class="basic"></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    <li><a class="generateExcel"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a></li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <select id='searchBycolor'>
                                <option value=''>-- Filter Warna--</option>
                                <option value='h' class="boldoption">Hijau </option>
                                <option value='b'>Biru</option>
                                <option value='m'>Merah</option>
                                <option value='g'>Abu abu</option>
                                <option value='K'>Kuning</option>
                        </select>
                    <table class="table listTable1">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Pemegang Sekuritas</th>
                        <th>Status Rek</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    </table>

                </div>
                </div>
            </div>
        </div>
        <!-- Extra large modal -->
<button type="button" class="btn btn-primary triggerCLick" data-toggle="modal" data-target=".bd-example-modal-xl" hidden>Extra large modal</button>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content testingModal">
    
    </div>
  </div>
</div>
    </div>


  <!-- /page content -->    

      <!--end-main-container-part-->
@section('js')
  <!-- bootstrap-daterangepicker -->
  <script src="{{ URL::asset('') }}plugins/vendors/moment/min/moment.min.js"></script>
    <script src="{{ URL::asset('') }}plugins/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="{{ URL::asset('') }}plugins/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Ion.RangeSlider -->
    <script src="{{ URL::asset('') }}plugins/vendors/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap Colorpicker -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  var urlGetshow1 = "{{url('/admin/investor-compore-index-ajax')}}";
  var urlAjaxShow = "{{url('/admin/investor-show-index-ajax')}}";
  var urlSaveInvestor ="{{url(route('investor.create'))}}";
  var urlGenerateExcel = "{{url('/admin/investor-generate-excel')}}";
  $('.refresh').on('click',function () {
    location.reload();
    });
    $('.generateExcel').on('click',function () {
        var tanggal = $(".tanggal").val();
        var tanggal2 = $(".tanggal2").val();
        if ((tanggal != "") & (tanggal2 != "") & (tanggal != tanggal2)) {
            window.location.href = urlGenerateExcel+"?tanggal="+tanggal+"&tanggal2="+tanggal2;
        }
    });
    // var table = $('#users').DataTable();
   var testing =  $('.submit').on('click',function () {
       var tanggal = $(".tanggal").val();
       var tanggal2 = $(".tanggal2").val();
       $('#searchBycolor').change(function(){
        listTable1.draw();
        });
            if ((tanggal != "") & (tanggal2 != "") & (tanggal != tanggal2)) {
                $('.basic').html('<h2>'+tanggal+'</h2>');
                var listTable1 = $('.listTable1').DataTable( {
                        "processing": true,
                        "bFilter": true,
                        "bInfo": false,
                        "bLengthChange": true,
                        "serverSide": true,
                        "lengthMenu": [ 50,100,500,1000,5000],
                        'language': {
                            'loadingRecords': '&nbsp;',
                            'processing': '<div class="spinner"></div>'
                        },       
                        "ajax": {
                            "url": urlGetshow1+"?tanggal="+tanggal+"&tanggal2="+tanggal2,
                            "type": "GET",
                            'data': function(data){
                                // Read values
                                var color = $('#searchBycolor').val();

                                // Append to data
                                data.searchByColor = color;
                            }
                        },
                        "fnRowCallback": function( nRow, Data, iDisplayIndex, iDisplayIndexFull ) {
                            if ( Data['status_jumlah'] == "h" )
                            {
                                $('td', nRow).css('background-color', '#00FF7F');
                                $('td', nRow).css('color', 'black');
                            }
                            else if ( Data['status_jumlah'] == "k" )
                            {
                                $('td', nRow).css('background-color', '#FFD700');
                                $('td', nRow).css('color', 'black');
                            }else if ( Data['status_jumlah'] == "b" ) {
                                $('td', nRow).css('background-color', '#00BFFF');
                                $('td', nRow).css('color', 'white');
                            }else if ( Data['status_jumlah'] == "m" ) {
                                $('td', nRow).css('background-color', '#F95C5C');
                                $('td', nRow).css('color', 'white');
                            }
                        },
                        "columns": [
                            { "data": "no" },
                            { "data": "nama_investor" },
                            { "data": "nama_pemegang_rekening" },
                            { "data": "status_rekening" },
                            { "data": "jumlah" },
                            { "render": function (data, type, row, meta) {
                                var show = $('<a><button>')
                                            .attr('class', "btn bg-blue-grey waves-effect edit-menu")
                                            .attr('onclick', "showProcess('"+row.id+"')")
                                            .text('Show')
                                            .wrap('<div></div>')
                                            .parent()
                                        .html();
                                return show ;
                                    }
                            },
                        ],
                });
                $(".test").trigger("click");
                $( ".first" ).addClass( "hidden" );
                $( ".second" ).removeClass( "hidden" );	
            }else {
                swal("Get fails!","periksa kembali isi form anda !!!", "error")
            }
        
        return false;
    });
 $(".modal").on('hide.bs.modal', function(){
    $( ".removeRow" ).remove();
  });
//this date picker
$('#tanggal').datetimepicker();
//this date picker
$('#tanggal2').datetimepicker();
  //show Detail data by id
  function showProcess(id){
        $.ajax({
        url: urlAjaxShow+"/"+id,
        context: document.body
        }).done(function(data) {
           $('.testingModal').append(data)
           $( ".triggerCLick" ).trigger( "click" );
        });
    }
</script>
@endsection
@stop
 