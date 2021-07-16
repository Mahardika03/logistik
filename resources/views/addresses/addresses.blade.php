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
                    <h4 class="card-title">Addresses</h4>
                    <h6 class="card-subtitle">address, is important data that is used to determine the delivery status that occurs at the time of delivery</h6>
                    <div class="text-right">
                        <a href="#" class="btn btn-info my-2" id="addAddress">Add address</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tableAddress" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Address ID</th>
                                    <th>Address Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Address ID</th>
                                    <th>Address Detail</th>
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
    <div class="modal fade" id="modalAddress" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formAddress" method="POST">
                        <input type="hidden" name="address_id" id="address_id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="address_detail" placeholder="Enter address" name="address_detail">
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
    <script src="{{ asset('js/address.js') }}"></script>
@endsection