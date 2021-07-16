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

    $('#tableMessage').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/message-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        columns : [
            {"data" : "message_id"},
            {"data" : "message_type.message_type_description"},
            {"data" : "shipment_id"},
            {"data" : "message_id",
                render: function(data, type, row) {
                    return `<a id="editMessage" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteMessage" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addMessage').click(function(){
        $('#modalMessage').modal('show');
    });


    $(document).on('click', '#editMessage', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-message-data/'+id, function(data){
            $('#modalMessage').modal('show');
            $('#message_id').val(data.message_id)
            $('#message_type_code').val(data.message_type_code);
            $('#shipment_id').val(data.shipment_id);
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddMessage').trigger("reset");
        $('#modalMessage').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();

        var formData = {
            message_id: $('#message_id').val(),
            message_type_code: $('#message_type_code').val(),
            shipment_id: $('#shipment_id').val()
        }

        if(formData.message_id){
            $.ajax({
                data: formData,
                url: "update-message-data/"+formData.message_id,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddMessage').trigger("reset");
                    $('#modalMessage').trigger("reset");
                    $('#modalMessage').modal('hide');
                    $('#tableMessage').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddMessage').trigger("reset");
                    $('#modalMessage').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                data: formData,
                url: "/add-message-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddMessage').trigger("reset");
                    $('#modalMessage').trigger("reset");
                    $('#modalMessage').modal('hide');
                    $('#tableMessage').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddMessage').trigger("reset");
                    $('#modalMessage').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteMessage', function(e){
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
                    url: 'delete-message-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        $('#tableMessage').DataTable().ajax.reload();
                        Swal.fire("Successfull", data.message, "success")
                    }
                });
            } else if(result.dismiss){
                Swal.fire("Canceled", "Your data is safe", "error");
            }
        });
    });
});