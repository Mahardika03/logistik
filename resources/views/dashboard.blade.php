@extends('layouts.app-admin')

@section('main-content')
<div class="container-fluid">
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex flex-wrap">
                                <div>
                                    <h3 class="card-title">Shipment Overview</h3>
                                    <h6 class="card-subtitle">Completed and Failed</h6>
                                </div>
                                <div class="ml-auto">
                                    <ul class="list-inline">
                                        <li class="list-inline-item px-2">
                                            <h6 class="text-success"><i
                                                    class="fa fa-circle font-10 mr-2 "></i>Completed</h6>
                                        </li>
                                        <li class="list-inline-item px-2">
                                            <h6 class="text-info"><i
                                                    class="fa fa-circle font-10 mr-2"></i>Failed</h6>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="amp-pxl" style="height: 360px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Status Shipment</h3>
                    <h6 class="card-subtitle">Different status shipment</h6>
                    <div id="visitor" style="height:290px; width:100%;"></div>
                </div>
                <div class="card-body text-center border-top">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item px-2">
                            <h6 class="text-info"><i class="fa fa-circle font-10 mr-2 "></i>Completed</h6>
                        </li>
                        <li class="list-inline-item px-2">
                            <h6 class=" text-success"><i class="fa fa-circle font-10 mr-2"></i>Failed</h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Row -->
    <!-- Row -->
    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="ti-pie-chart"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">Bandwidth usage</h3>
                            <h6 class="card-subtitle text-white op-5" id="purple"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap">50 GB</h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 align-self-center">
                            <div class="usage chartist-chart" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card bg-success">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mr-3 align-self-center">
                            <h1 class="text-white"><i class="icon-cloud-download"></i></h1>
                        </div>
                        <div>
                            <h3 class="card-title text-white">Shipment count</h3>
                            <h6 class="card-subtitle text-white op-5" id="green"></h6>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-4 align-self-center">
                            <h2 class="font-weight-light text-white text-nowrap text-truncate">35487</h2>
                        </div>
                        <div class="col-8 pb-3 pt-2 text-right">
                            <div class="spark-count" style="height:65px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <img class="rounded-top" src="{{ url('material-pro/src/assets/images/background/weatherbg.jpg') }}"
                    alt="Card image cap">
                <div class="card-img-overlay" style="height:110px;">
                    <div class="d-flex align-items-center">
                        <h3 class="card-title text-white mb-0 d-inline-block">Indonesia</h3>
                        <div class="ml-auto">
                            <small class="card-text text-white font-weight-light" id="today"></small>
                        </div>
                    </div>
                </div>
                <div class="p-3 weather-small">
                    <div class="row">
                        <div class="col-8 border-right align-self-center">
                            <div class="d-flex">
                                <div class="display-6 text-info"><i class="wi wi-day-storm-showers"></i></div>
                                <div class="ml-3">
                                    <h2 class="font-weight-light text-info mb-0" id="hours"></h2>
                                    <small>Happy Programming Day</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-center">
                            <h1 class="font-weight-light mb-0">25<sup>0</sup></h1>
                            <small>Tonight</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection