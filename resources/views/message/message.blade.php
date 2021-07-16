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
                    <h4 class="card-title">Message</h4>
                    <h6 class="card-subtitle">message, is important data that is used to determine the delivery status that occurs at the time of delivery</h6>
                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-info my-2" id="addMessage">Add Message</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tableMessage" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Message ID</th>
                                    <th>Message Type</th>
                                    <th>Shipment ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Message ID</th>
                                    <th>Message Type</th>
                                    <th>Shipment ID</th>
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
    <div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formAddMessage" method="POST">
                        <input type="hidden" name="message_id" id="message_id">
                        <div class="form-group">
                            <select class="form-control" name="message_type_code" id="message_type_code">
                                <option value="" disabled selected>Choose message type</option>
                                @foreach ($message_types as $message_type)
                                    <option value="{{ $message_type->message_type_code }}">{{ $message_type->message_type_description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="shipment_id" id="shipment_id">
                                <option value="" disabled selected>Choose shipment ID</option>
                                @foreach ($shipments as $shipment)
                                    <option value="{{ $shipment->shipment_id }}">{{ $shipment->shipment_id }}</option>
                                @endforeach
                            </select>
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
    <script src="{{ asset('js/message.js') }}"></script>
@endsection