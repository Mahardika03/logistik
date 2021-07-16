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

    $('#tableMessageCode').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/message-type-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1 }
        ],
        columns : [
            {"data" : "message_type_code"},
            {"data" : "message_type_description"},
            {"data" : "message_type_code",
                render: function(data, type, row) {
                    return `<a id="editMessageType" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteMessageType" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addMessageType').click(function(){
        $('#modalMessageType').modal('show');
    });


    $(document).on('click', '#editMessageType', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-message-type-data/'+id, function(data){
            $('#modalMessageType').modal('show');
            $('#message_type_code').val(data.message_type_code);
            $('#message_type_description').val(data.message_type_description);
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
            message_type_code: $('#message_type_code').val(),
            message_type_description: $('#message_type_description').val()
        }

        if(formData.message_type_code){
            $.ajax({
                data: formData,
                url: "update-message-type-data/"+formData.message_type_code,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddMessageType').trigger("reset");
                    $('#modalMessageType').trigger("reset");
                    $('#modalMessageType').modal('hide');
                    $('#tableMessageCode').DataTable().ajax.reload();
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
                url: "/add-message-type-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddMessageType').trigger("reset");
                    $('#modalMessageType').trigger("reset");
                    $('#modalMessageType').modal('hide');
                    $('#tableMessageCode').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddMessageType').trigger("reset");
                    $('#modalMessageType').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteMessageType', function(e){
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
                    url: 'delete-message-type-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableMessageCode').DataTable().ajax.reload();
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