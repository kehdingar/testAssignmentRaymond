$(document).ready(function() {

    // if($('.products.prodcut-area').children().length == 0){
    //     $('.delete-checkbox').css("visibility","hidden");

    // }else{
    //     $('span.btn-two').append('<a href="#" class="mass-delete button-two delete-checkbox">MASS DELETE</a>');
    // }

    $("#productType").change(function() {
        console.log(($(this).val()));
        let selectedType = $(this).val();

        $.ajax({
            type: 'GET',
            url: `process-add-product.php?selectedType=${selectedType}`,
            dataType: 'json',
            success: function(response) {
                if (!response.empty) {

                    console.log("Success");
                    console.log(response.html);
                    console.log(response.info);
                    $("#productHTML").html(response.html);

                    let infoHTML = "";

                    infoHTML = response.info;

                    $("#productInfo").html(infoHTML);
                } else {
                    $("#productHTML").empty();
                    $("#productInfo").empty();

                }

            },

            error: function(response) {
            }

        });

    });


    $(".save").click(function(e) {
        console.log("We are about to submit")
        e.preventDefault();
        $('p.error').html("");

        $.ajax({
            type: 'POST',
            url: `process-add-product.php`,
            dataType: 'json',
            data: $('form').serialize(),
            success: function(response) {
                if (response == "redirect") {
                    window.location = "list-products.php";
                } else {
                    if (response['errors'] != undefined || response['errors'] != null)
                        Object.entries(response['errors']).forEach(([key, value]) => {
                            $(`#${key}Error`).html(value);
                            console.log(key);
                            console.log(value);
                        });
                }

            },

            error: function(response) {
            }


        });

    });

    $(".mass-delete").click(function(e) {
        console.log("We are about to submit")
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: `process-delete.php`,
            dataType: 'json',
            data: $('#productListForm').serialize(),
            success: function(response) {
                if (response != "empty") {
                    if(response == "data"){

                        $('.products.prodcut-area').load('list-products.php .products.prodcut-area', function() {
    
                        });
                    }else{
                        $('.delete-checkbox').remove();
                        $('.products.prodcut-area').load('list-products.php .products.prodcut-area', function() {
    
                        });

                    }
                    
                    // window.location.href = "list-products.php"
                }

            },

            error: function(response) {
            }


        });

    });


});