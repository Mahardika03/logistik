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
                    <h4 class="card-title">Location</h4>
                    <h6 class="card-subtitle">location, is important data that is used to determine the delivery status that occurs at the time of delivery</h6>
                    <div class="text-right">
                        <a href="#" class="btn btn-info my-2" id="addLocation">Add Location</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tableLocation" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Location ID</th>
                                    <th>Address</th>
                                    <th>Location Type</th>
                                    <th>Location Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Location ID</th>
                                    <th>Address</th>
                                    <th>Location Type</th>
                                    <th>Location Detail</th>
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
    <div class="modal fade" id="modalLocation" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formAddLocation" method="POST">
                        <input type="hidden" name="location_id" id="location_id">
                        <div class="form-group">
                            <select class="form-control" name="address_id" id="address_id">
                                    <option value="" disabled selected>Select address</option>
                                @foreach ($addresses as $address)
                                    <option value="{{ $address->address_id }}">{{ $address->address_detail }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="location_type_code" id="location_type_code">
                                <option value="" disabled selected>Select location type</option>
                                @foreach ($locationTypes as $locationType)
                                    <option value="{{ $locationType->location_type_code }}">{{ $locationType->location_type_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="location_detail" id="location_detail" cols="30" rows="10"></textarea>
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
    <script src="{{ asset('js/location.js') }}"></script>
@endsection