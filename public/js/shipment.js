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

    $('#start_date_expected').pickadate();
    $('#end_date_expected').pickadate();

    $('#tableShipment').DataTable({
        processing: true,
        lengthMenu : [10,50,100],
        ajax : "/shipments-data",
        columnDefs : [
            { responsivePriority: 1, targets: -1, }
        ],
        columns : [
            {"data" : "shipment_id"},
            {"data" : "location_one.location_detail"},
            {"data" : "location_two.location_detail"},
            {"data" : "start_date_expected"},
            {"data" : "end_date_expected"},
            {"data" : "start_date_actual", 
                render: function(data){
                    if(data === null){
                        return '-';
                    } else {
                        return data;
                    }
                }
            },
            {"data" : "end_date_actual",
                render: function(data){
                    if(data === null){
                        return '-';
                    } else {
                        return data;
                    }
                }
            },
            {"data" : "other_details"},
            {"data" : "shipment_id",
                render: function(data, type, row) {
                    return `
                            <a id="deleteShipment" class=" btn btn-md btn-danger my-1" data-id='`+data +`' style="color: white;"> Delete</a>`;
                }
            }
        ]
    });
    //$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('btn btn-info mr-1');
    

    $('#addShipment').click(function(){
        $('#modalShipment').modal('show');
    });


    // $(document).on('click', '#editLocation', function(e){
    //     e.preventDefault();
    //     var id = $(this).attr("data-id");
    //     $.get('get-location-data/'+id, function(data){
    //         $('#modalLocation').modal('show');
    //         $('#location_id').val(data.location_id);
    //         $('#address_id').val(data.address_id);
    //         $('#location_type_code').val(data.location_type_code);
    //         $('#location_detail').val(data.location_detail);
    //     });
    // });

    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddShipment').trigger("reset");
        $('#modalShipment').trigger("reset");
    });

    $('#formAddShipment').submit(function(e){
        e.preventDefault();

        var product_id = document.querySelectorAll("#product_id");
        var quantity = document.querySelectorAll("#quantity");

        var arrayDataProductId = [];
        var arrayDataQuantity = [];
        for(let i = 0; i < product_id.length; i++){
            console.log(product_id[i].value);
            arrayDataProductId.push(parseInt(product_id[i].value));
            arrayDataQuantity.push(parseInt(quantity[i].value));
        }
        console.log(arrayDataProductId);
        console.log(arrayDataQuantity);

        var formData = {
            shipment_id: $('#shipment_id').val(),
            start_location_id: $('#start_location_id').val(),
            end_location_id: $('#end_location_id').val(),
            start_date_expected: $('#start_date_expected').val(),
            end_date_expected: $('#end_date_expected').val(),
            product_id: arrayDataProductId,
            quantity: arrayDataQuantity,
            other_details: $('#other_details').val()
        }

        //alert(formData.product_id);

        

        if(formData.shipment_id){
    //         $.ajax({
    //             data: formData,
    //             url: "update-location-data/"+formData.location_id,
    //             type: "PUT",
    //             dataType: "json",
    //             success : function(data){
    //                 $('#formAddLocation').trigger("reset");
    //                 $('#modalLocation').trigger("reset");
    //                 $('#modalLocation').modal('hide');
    //                 $('#tableLocation').DataTable().ajax.reload();
    //                 Swal.fire("Successfull", data.message, "success");
    //             },
    //             error : function(data){
    //                 console.log('Error : ', data);
    //                 $('#formAddLocation').trigger("reset");
    //                 $('#modalLocation').trigger("reset");
    //                 Swal.fire("Wrong request", data.responseJSON.message, "error");
    //             }
    //         });
        } else {
            $.ajax({
                data: formData,
                url: "/add-shipments-data",
                type: "POST",
                dataType: 'json',
                success : function(data){
                    $('#formAddShipment').trigger("reset");
                    $('#modalShipment').trigger("reset");
                    $('#modalShipment').modal('hide');
                    $('#tableShipment').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddShipment').trigger("reset");
                    $('#modalShipment').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteShipment', function(e){
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
                    url: 'delete-shipments-data/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#tableShipment').DataTable().ajax.reload();
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

