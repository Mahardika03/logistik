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

    $('#tableAddress').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/addresses-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        columns : [
            {"data" : "address_id"},
            {"data" : "address_detail"},
            {"data" : "address_id",
                render: function(data, type, row) {
                    return `<a id="editAddress" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteAddress" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addAddress').click(function(){
        $('#modalAddress').modal('show');
    });


    $(document).on('click', '#editAddress', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-address-data/'+id, function(data){
            $('#modalAddress').modal('show');
            $('#address_id').val(data.address_id);
            $('#address_detail').val(data.address_detail);
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddMessageType').trigger("reset");
        $('#modalMessageType').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();

        var formData = {
            address_id: $('#address_id').val(),
            address_detail: $('#address_detail').val()
        }

        if(formData.address_id){
            $.ajax({
                data: formData,
                url: "update-address-data/"+formData.address_id,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddress').trigger("reset");
                    $('#modalAddress').trigger("reset");
                    $('#modalAddress').modal('hide');
                    $('#tableAddress').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddMessageType').trigger("reset");
                    $('#modalMessageType').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                data: formData,
                url: "/add-address-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddress').trigger("reset");
                    $('#modalAddress').trigger("reset");
                    $('#modalAddress').modal('hide');
                    $('#tableAddress').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddress').trigger("reset");
                    $('#modalAddress').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteAddress', function(e){
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
                    url: 'delete-address-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableAddress').DataTable().ajax.reload();
                            Swal.fire("Successfull", data.message, "success");
                        } else {
                            Swal.fire("Wrong request", data.message, "error");
                        }
                    }
                    
                });
            } else if(result.dismiss){
                Swal.fire("Canceled", "Your data is safe", "error");
            }
        });
    });
});