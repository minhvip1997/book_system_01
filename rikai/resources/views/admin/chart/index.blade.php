@extends('admin.layout.index')
@section('content1')
<div class="row">
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body2">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-right">
            <p class="mb-0 text-right">{{__('message.total-revenue')}}</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{langTotalCurency($data['total'])}}{{langTypeOfCurency()}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body2">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-right">
            <p class="mb-0 text-right">{{__('message.order-done')}}</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$data['ordersdone']}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body2">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-right">
            <p class="mb-0 text-right">{{__('message.number-of-orders')}}</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$data['orders']}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body2">
        <div class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
          <div class="float-right">
            <p class="mb-0 text-right">{{__('message.Users')}}</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">{{$data['users']}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="d-flex align-items-center pt-20 pb-20">
  <span class="dot-indicator bg-primary"></span>
  <a class="btn btn-primary" href="{{route('chart.export')}}">{{__('message.export')}}</a>
<<<<<<< HEAD
<<<<<<< HEAD
  <span class="dot-indicator bg-primary"></span>
  <a class="btn btn-danger" href="{{route('chart.exportorder')}}">{{__('message.exportorder')}}</a>
=======
>>>>>>> f00af71 (create multiple level category)
=======
  <span class="dot-indicator bg-primary"></span>
  <a class="btn btn-danger" href="{{route('chart.exportorder')}}">{{__('message.export')}}</a>
>>>>>>> 3d0566b (hide negative review and comment)
</div>
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body2">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
          <h2 class="card-title mb-0">{{__('message.analysis')}}</h2>
        </div>
        <div id="chart-container">
        </div>
      </div>
    </div>
  </div>
</div>
@include('admin.chart.chart')
@endsection