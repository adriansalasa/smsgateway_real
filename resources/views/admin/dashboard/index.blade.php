@extends('layouts.admin-master')



@section('title')

Dashboard

@endsection



@section('content')
<style type="text/css">
	#container {
		min-width: 310px;
		max-width: 800px;
		height: 400px;
		margin: 0 auto;
	}
</style>
<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
<script src="{{asset('chart/code/highcharts.js')}}"></script>
<script src="{{asset('chart/code/modules/series-label.js')}}"></script>
<script src="{{asset('chart/code/modules/exporting.js')}}"></script>
<script src="{{asset('chart/code/modules/export-data.js')}}"></script>

  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

<section class="section">

  <div class="section-header">

    <h1>Dashboard</h1>

  </div>



  <div class="section-body">
    <div class="row">
        <div class="col-md-4 col-lg-4"> 
          <a class="text-decoration-none">
            <div class="card bg-primary text-white">
              <div class="card-body ml-2 mr-2 ballance-icon">
                <h4>Rp. {{number_format(Auth::user()->credit)}}</h4>
                <span>Ballance</span>
              </div>
            </div>
          </a>
        </div>
        <!-- <div class="col-md-4 col-lg-4">
          <a href="{{ route('admin.phonebook') }}" class="text-decoration-none">
            <div class="card bg-secondary text-white">
              <div class="card-body ml-2 mr-2 pb-icon">
                <h4>{{$pb}}</h4>
                <span>Phonebook</span>
              </div>
            </div>
          </a>
        </div> -->
         @if(Auth::user()->uid == '1')
            <div class="col-md-4 col-lg-4">
              <a href="{{ route('admin.notification') }}" class="text-decoration-none">
                <div class="card bg-warning text-white">
                  <div class="card-body ml-2 mr-2 bell-icon">
                    <h4>{{$notif}}</h4>
                    <span>New Notification</span>
                  </div>
                </div>
              </a>
            </div>
        @else
            <div class="col-md-4 col-lg-4">
              <a href="{{ route('admin.phonebook') }}" class="text-decoration-none">
                <div class="card bg-secondary text-white">
                  <div class="card-body ml-2 mr-2 pb-icon">
                    <h4>{{$pb}}</h4>
                    <span>Phonebook</span>
                  </div>
                </div>
              </a>
            </div>
        @endif
        <div class="col-md-4 col-lg-4">
          <a href="{{ route('admin.inbox') }}" class="text-decoration-none">
            <div class="card bg-info">
              <div class="card-body ml-2 mr-2 inbox-icon">
                <h4>{{$inbox}}</h4>
                <span>Inbox</span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-lg-4">
          <a href="{{ route('admin.outbox') }}" class="text-decoration-none">
            <div class="card bg-success">
              <div class="card-body ml-2 mr-2 sent-icon">
                <h4>{{$outbox}}</h4>
                <span>Sent</span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-lg-4">
          <a href="{{ route('admin.outbox') }}" class="text-decoration-none">
            <div class="card bg-warning">
              <div class="card-body ml-2 mr-2 queue-icon">
                <h4>{{$queue}}</h4>
                <span>Queue SMS</span>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-4 col-lg-4">
          <a href="{{ route('admin.outbox') }}" class="text-decoration-none">
            <div class="card bg-danger">
              <div class="card-body ml-2 mr-2 failed-icon">
                <h4>{{$failed}}</h4>
                <span>Failed</span>
              </div>
            </div>
          </a>
        </div>
    </div>

  	<div id="container" style="width:100%; height:400px;"></div>
  </div>

</section>
<!-- @foreach($tgl_inbox as $item)
	{{$item->month}} {{$item->year}}
@endforeach -->
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Message Reports {{$tahun}}'
        },
        xAxis: {
            categories: [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Desember']
        },
        yAxis: {
            title: {
                text: 'Jumlah Pesan'
            }
        },
        series: [{
            name: 'Inbox',
            data: [{!!$b1!!}, {!!$b2!!}, {!!$b3!!}, {!!$b4!!}, {!!$b5!!}, {!!$b6!!}, {!!$b7!!}, {!!$b8!!}, {!!$b9!!}, {!!$b10!!}, {!!$b11!!}, {!!$b12!!}]
        }
        , {
            name: 'Outbox',
            data: [{!!$bo1!!}, {!!$bo2!!}, {!!$bo3!!}, {!!$bo4!!}, {!!$bo5!!}, {!!$bo6!!}, {!!$bo7!!}, {!!$bo8!!}, {!!$bo9!!}, {!!$bo10!!}, {!!$bo11!!}, {!!$bo12!!}]
        }
        ]
    });
});
</script>
@endsection

