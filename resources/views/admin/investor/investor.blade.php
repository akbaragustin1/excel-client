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
    .modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
      }

      /* When the body has the loading class, we turn
        the scrollbar off with overflow:hidden */
      body.loading .modal {
          overflow: hidden;   
      }

      /* Anytime the body has the loading class, our
        modal element will be visible */
      body.loading .modal {
          display: block;
      }</style>
@endsection
  <!-- page content -->
  <div class="right_col" role="main">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Form Design</h2>
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
              <br />
              <form id="signupForm" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tanggal <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class='input-group date' id='datetimepicker6'>
                        <input type='text' class="form-control" id="tanggal" name="tanggal" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">File <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" id="file" name="file" required="required" onchange="ValidateSingleInput(this);">
                  </div>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="hidden" name="id" class="id" value ="" id="id">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="_token">
                    <button class="btn btn-primary" type="button">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
        <br />

      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Default Example <small>Investor</small></h2>
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
                    <th>Nama Investor</th>
                    <th>Nomor KTP</th>
                    <th>NPWP</th>
                    <th>Kewarganegaraan</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

  </div>

  <div class="modal"><!-- Place at bottom of page --></div>
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
  var urlAjaxShow = "{{url('/admin/investor-index')}}";
  var urlSaveInvestor ="{{url(route('investor.create'))}}";
  var listTable = $('.listTable').DataTable( {
        "processing": false,
        "bFilter": true,
        "bInfo": false,
        "bLengthChange": false,
        "serverSide": true,
        "ajax": {
             "url": urlAjaxShow,
             "type": "GET"
         },
         "columns": [
            { "data": "no" },
            { "data": "nama_investor" },
            { "data": "nomor_ktp" },
            { "data": "npwp" },
            { "data": "kewarganegaraan" },
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
        ]
  });
//this date picker
$('#tanggal').datetimepicker();
 //this is validation jquery
  $('#signupForm').validate({
          //condition form validate
          rules:{
              tanggal :"required",
            },
          //this is if form valid
          messages: {
              tanggal :{
                  required : "Please enter your date",
              },
          },
          errorClass: "help-inline",
          errorElement: "span",
          highlight:function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
          },
      submitHandler: function(form) {
        $body = $("body");
        $body.addClass("loading");
          //thi is get data form
          var formData = new FormData();
          formData.append('file', $('#file')[0].files[0]);
          formData.append('tanggal', $('#tanggal').val());
          formData.append('id', $('#id').val());
          formData.append('_token', $('#_token').val());
        
        
          //this is sent data to controller with ajax
          $.ajax({
              type: "POST",
              url: urlSaveInvestor,
              dataType : 'json',
              data: formData,
              processData: false,  // tell jQuery not to process the data
              contentType: false,  // tell jQuery not to set contentType
              success: function(retval) {
                $body.removeClass("loading");
                      // if sent save success then swall alert and reload page
                      if (retval.status == true){
                          $('#reset').trigger('click');
                          swal(retval.messages, "You clicked the button!", "success").then((willDelete) => {
                              if (willDelete) {
                                location.reload();
                              } else {
                                location.reload();
                              }
                            });  
                      // this is save fails then swall alert error
                      }else if(retval.status == false){
                          swal("Save fails!",retval.messages, "error")
                      }
              }
          });
      }
  });

  var _validFileExtensions = [".xls", ".xlsx"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                swal("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "))
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
</script>
@endsection
@stop
 