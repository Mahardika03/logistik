@extends('layouts.app-admin')

@section('main-content')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- File export -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Shipment</h4>
                    <h6 class="card-subtitle">Shipment, is important data that is used to determine the delivery status that occurs at the time of delivery</h6>
                    <div class="text-right">
                        <a href="#" class="btn btn-info my-2" id="addShipment">Add Shipment</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tableShipment" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Shipment ID</th>
                                    <th>Start Location</th>
                                    <th>End Location</th>
                                    <th>Start Date Expected</th>
                                    <th>End Date Expected</th>
                                    <th>Start Date Actual</th>
                                    <th>End Date Actual</th>
                                    <th>Other Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Shipment ID</th>
                                    <th>Start Location</th>
                                    <th>End Location</th>
                                    <th>Start Date Expected</th>
                                    <th>End Date Expected</th>
                                    <th>Start Date Actual</th>
                                    <th>End Date Actual</th>
                                    <th>Other Details</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Center modal content -->
    <div class="modal fade" id="modalShipment" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formAddShipment" method="POST">
                        <input type="hidden" name="shipment_id" id="shipment_id">
                        <div class="form-group">
                            <select class="form-control" name="start_location_id" id="start_location_id">
                                <option value="" disabled selected>Choose start location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->location_id }}">{{ $location->location_detail }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="end_location_id" id="end_location_id">
                                <option value="" disabled selected>Choose end location</option>
                                @foreach ($locations as $location)
                                    <option value="{{ $location->location_id }}">{{ $location->location_detail }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Start Date Expected" id="start_date_expected" name="start_date_expected">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="End Date Expected" id="end_date_expected" name="end_date_expected">
                        </div>
                        <div class="form-group">
                            <div id="product_section" class=" m-t-20"></div>        
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control my-2 product_id" id="product_id" name="product_id[]">
                                        <option value="" disabled selected>Choose product</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="number" class="form-control my-2 quantity" placeholder="Quantity" id="quantity" name="quantity[]">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success my-2" type="button" onclick="add_form_product();"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="other_details" id="other_details" cols="30" rows="10"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" id="submitButton" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
@endsection

@section('script')
    <script src="{{ asset('js/shipment.js') }}"></script>

    <!--below script must be in blade file because it will be used to fetch value from product variable-->
    <script>
        var product = 1;

        function add_form_product(){

            product++;
            var objTo = document.getElementById('product_section')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "removeclass" + product);
            var rdiv = 'removeclass' + product;
            divtest.innerHTML = '<div id="product_section" class=" m-t-20"></div><div class="row"><div class="col-6 my-2"><select class="form-control product_id" id="product_id" name="product_id[]"><option value="" disabled selected>Choose product</option>@foreach ($products as $product)<option value="{{ $product->product_id }}">{{ $product->product_name }}</option>@endforeach</select></div><div class="col-4 my-2"><input type="number" class="form-control quantity" placeholder="Quantity" id="quantity" name="quantity[]"></div><div class="col-2 my-2"><button class="btn btn-danger" type="button" onclick="remove_education_fields(' + product + ');;"><i class="fa fa-minus"></i></button></div></div>';

            objTo.appendChild(divtest)
        }


        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
            product--;
        }
    </script>
@endsection