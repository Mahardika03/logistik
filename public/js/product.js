/*************************************************************************************/
// -->Template Name: Bootstrap Press Admin
// -->Author: Themedesigner
// -->Email: niravjoshi87@gmail.com
// -->File: datatable_advanced_init
/*************************************************************************************/

//=============================================//
//    File export                              //
//=============================================//

$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#tableProduct').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/product-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        columns : [
            {"data" : "product_id"},
            {"data" : "product_name"},
            {"data" : "product_detail"},
            {"data" : "product_photo",
                render: function(data) {
                    return `<img src='storage/`+data+`' style="width: 150px; height: 150px;">`;
                }
            },
            {"data" : "product_id",
                render: function(data, type, row) {
                    return `<a id="editProduct" class=" btn btn-md btn-success my-1" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteProduct" class=" btn btn-md btn-danger my-1" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addProduct').click(function(){
        $('#modalProduct').modal('show');
    });


    $(document).on('click', '#editProduct', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-product-data/'+id, function(data){
            $('#modalProduct').modal('show');
            $('#product_id').val(data.product_id);
            $('#product_name').val(data.product_name);
            $('#product_detail').val(data.product_detail);
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formUpProduct').trigger("reset");
        $('#modalProduct').trigger("reset");
        $('#product_id').val(null);
        $('#product_photo').val(null);
    });

    $('#formUpProduct').submit(function(e){
        e.preventDefault();

        var formData = {
            product_id: $('#product_id').val()
        }

        if(formData.product_id){
            $('#method').val('PUT')

            $.ajax({
                data: new FormData(this),
                url: "update-product-data/"+formData.product_id,
                type: "POST",
                contentType: false,
                processData: false,
                dataType: "json",
                success : function(data){
                    $('#formUpProduct').trigger("reset");
                    $('#product_id').val(null);
                    $('#modalProduct').trigger("reset");
                    $('#modalProduct').modal('hide');
                    $('#product_photo_label').text('Choose file');
                    $('#tableProduct').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                    $('#method').val('POST')
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formUpProduct').trigger("reset");
                    $('#modalProduct').trigger("reset");
                    $('#product_photo_label').text('Choose file');
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                data: new FormData(this),
                url: "/add-product-data",
                type: "POST",
                contentType: false,
                processData: false,
                dataType: 'json',
                success : function(data){
                    $('#formUpProduct').trigger("reset");
                    $('#modalProduct').trigger("reset");
                    $('#modalProduct').modal('hide');
                    $('#product_photo_label').text('Choose file');
                    $('#tableProduct').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formUpProduct').trigger("reset");
                    $('#modalProduct').trigger("reset");
                    $('#product_photo_label').text('Choose file');
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteProduct', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "You want to delete this data?",
            type: "warning",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes!",
            showCancelButton: true,
            cancelButtonText: "No"
        }).then((result)=> {
            if(result.value){
                $.ajax({
                    url: 'delete-product-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableProduct').DataTable().ajax.reload();
                            Swal.fire("Successfull", data.message, "success");
                        } else {
                            Swal.fire("Wrong request", data.message, "error");
                        }
                    },
                    error : function(data){
                        console.log(data);
                        Swal.fire("Wrong Request", data.message, "error");
                    }
                });
            } else if(result.dismiss){
                Swal.fire("Canceled", "Your data is safe", "error");
            }
        });
    });
});