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
                    <h4 class="card-title">Product</h4>
                    <h6 class="card-subtitle">product, is important data that is used to determine the delivery status that occurs at the time of delivery</h6>
                    <div class="text-right">
                        <a href="javascript:void(0)" class="btn btn-info my-2" id="addProduct">Add Product</a>
                    </div>
                    <div class="table-responsive">
                        <table id="tableProduct" class="table table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Detail</th>
                                    <th>Product Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Product Detail</th>
                                    <th>Product Photo</th>
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
    <div class="modal fade" id="modalProduct" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Input</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton"
                        aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formUpProduct" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="POST" id="method">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="product_name">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="product_detail" id="product_detail" cols="30" rows="10" placeholder="input detail product here"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-form-label">Select File</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="product_photo" id="product_photo" multiple>
                                    <label class="custom-file-label" id="product_photo_label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
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
    <script src="{{ asset('js/product.js') }}"></script>
@endsection