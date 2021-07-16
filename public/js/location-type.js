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

    $('#tableLocationType').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/location-type-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1, className: 'hover' }
        ],
        columns : [
            {"data" : "location_type_code"},
            {"data" : "location_type_description"},
            {"data" : "location_type_code",
                render: function(data, type, row) {
                    return `<a id="editLocationType" class=" btn btn-md btn-success" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteLocationType" class=" btn btn-md btn-danger" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addLocationType').click(function(){
        $('#modalLocationType').modal('show');
    });


    $(document).on('click', '#editLocationType', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-location-type-data/'+id, function(data){
            $('#modalLocationType').modal('show');
            $('#location_type_code').val(data.location_type_code);
            $('#location_type_description').val(data.location_type_description);
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddLocationType').trigger("reset");
        $('#modalLocationType').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();

        var formData = {
            location_type_code: $('#location_type_code').val(),
            location_type_description: $('#location_type_description').val()
        }

        if(formData.location_type_code){
            $.ajax({
                data: formData,
                url: "update-location-type-data/"+formData.location_type_code,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddLocationType').trigger("reset");
                    $('#modalLocationType').trigger("reset");
                    $('#modalLocationType').modal('hide');
                    $('#tableLocationType').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddLocationType').trigger("reset");
                    $('#modalLocationType').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                data: formData,
                url: "/add-location-type-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddLocationType').trigger("reset");
                    $('#modalLocationType').trigger("reset");
                    $('#modalLocationType').modal('hide');
                    $('#tableLocationType').DataTable().ajax.reload();
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

    $(document).on('click', '#deleteLocationType', function(e){
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
                    url: 'delete-location-type-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableLocationType').DataTable().ajax.reload();
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