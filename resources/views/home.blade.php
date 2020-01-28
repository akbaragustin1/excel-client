@extends('layouts.index')
@section('content')
   <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count"><?php echo $data;?></div>
                  <h3>Data</h3>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                <div class="icon"><i class="fa fa-user"></i></div>
                  <div class="count"> <?php echo $user;?></div>
                  <h3>User</h3>
              
                </div>
              </div>
              <a href="<?php echo url('/admin/master/file'); ?>"><div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-file"></i></div>
                  <div class="count"> <?php echo $file;?></div>
                  <h3>File</h3>
                </div>
              </div></a>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">1</div>
                  <h3>New Sign ups</h3>
                </div>
              </div>
            </div>              
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Activities Graph On <?php echo $month;?></h3>
                  </div>
                    <!-- <div class="col-md-6">
                      <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                        <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                        <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                      </div>
                    </div> -->
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- <div id="chart_plot_01" class="demo-placeholder"></div> -->
                   <div><canvas id="canvas"></canvas></div>         
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
          <br />

          


                <!-- Start to do list -->
                
                        
                <!-- end of weather widget -->
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->    

<!--end-main-container-part-->
@section('js')
<script src="{{ URL::asset('') }}plugins/vendors/Chart.js/dist/Chart.bundle.js"></script>
<script>
       var urlGetshow1 = "{{url('/admin/investor-graph')}}";
        $.ajax({
        type: 'GET', //THIS NEEDS TO BE GET
        url: urlGetshow1,
        dataType: 'json',
        success: function (data) {
          var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
          var randomScalingFactor = function() {
              return Math.round(Math.random() * 50 * (Math.random() > 0.5 ? 1 : 1)) + 50;
          };
          var randomColorFactor = function() {
              return Math.round(Math.random() * 255);
          };
          var randomColor = function(opacity) {
              return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
          };
          var config = {
            type: 'line',
            data: {
                labels: [1, 2, 3, 4, 5, 6, 7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31],
                datasets: [{
                    label: "My First dataset",
                    data: data.data,
                    fill: true,
                    borderDash: [1, 10],
                }]
            },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:"Chart.js Line Chart - X-Axis Filter"
                },
                scales: {
                    xAxes: [{
                        display: true,
                        ticks: {
                            userCallback: function(dataLabel, index) {
                                return index % 2 === 0 ? dataLabel : '';
                            }
                        }
                    }],
                    yAxes: [{
                        display: true,
                        beginAtZero: false
                    }]
                }
            }
        };

        $.each(config.data.datasets, function(i, dataset) {
            dataset.borderColor = 'green';
            dataset.backgroundColor = '#D1F7E2';
            dataset.pointBorderColor = '#3F43CB';
            dataset.pointBackgroundColor = 'purple';
            dataset.pointBorderWidth = 1;
        });
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myLine = new Chart(ctx, config);
        },error:function(){ 
             console.log(data);
        }
    });
    </script>
@endsection
@stop
 


<!-- 
<div style="width:75%;">
      
    </div>
    <br>
    <br>
    <button id="randomizeData">Randomize Data</button>
    <button id="addDataset">Add Dataset</button>
    <button id="removeDataset">Remove Dataset</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
   -->