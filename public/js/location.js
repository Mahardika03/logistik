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

    $('#tableLocation').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/location-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1, }
        ],
        columns : [
            {"data" : "location_id"},
            {"data" : "address.address_detail"},
            {"data" : "location_type.location_type_description"},
            {"data" : "location_detail"},
            {"data" : "location_id",
                render: function(data, type, row) {
                    return `<a id="editLocation" class=" btn btn-md btn-success my-1" data-id='`+data +`' style="color: white;"> Edit</a>
                            <a id="deleteLocation" class=" btn btn-md btn-danger my-1" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addLocation').click(function(){
        $('#modalLocation').modal('show');
    });


    $(document).on('click', '#editLocation', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.get('get-location-data/'+id, function(data){
            $('#modalLocation').modal('show');
            $('#location_id').val(data.location_id);
            $('#address_id').val(data.address_id);
            $('#location_type_code').val(data.location_type_code);
            $('#location_detail').val(data.location_detail);
        });
    });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddLocation').trigger("reset");
        $('#modalLocation').trigger("reset");
    });

    $('#submitButton').click(function(e){
        e.preventDefault();

        var formData = {
            location_id: $('#location_id').val(),
            address_id: $('#address_id').val(),
            location_type_code: $('#location_type_code').val(),
            location_detail: $('#location_detail').val()
        }

        if(formData.location_id){
            $.ajax({
                data: formData,
                url: "update-location-data/"+formData.location_id,
                type: "PUT",
                dataType: "json",
                success : function(data){
                    $('#formAddLocation').trigger("reset");
                    $('#modalLocation').trigger("reset");
                    $('#modalLocation').modal('hide');
                    $('#tableLocation').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddLocation').trigger("reset");
                    $('#modalLocation').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                data: formData,
                url: "/add-location-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddLocation').trigger("reset");
                    $('#modalLocation').trigger("reset");
                    $('#modalLocation').modal('hide');
                    $('#tableLocation').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddLocation').trigger("reset");
                    $('#modalLocation').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteLocation', function(e){
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
                    url: 'delete-location-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableLocation').DataTable().ajax.reload();
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