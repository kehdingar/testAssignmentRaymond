$(document).ready(function() {

    $("#productType").change(function() {

        let selectedType = $(this).val();

        $.ajax({
            type: 'GET',
            url: `process-add-product.php?selectedType=${selectedType}`,
            dataType: 'json',
            success: function(response) {
                if (!response.empty) {

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
                        });
                }
            },
            error: function(response) {
            }


        });

    });

    $(".mass-delete").click(function(e) {
        
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: `process-delete.php`,
            dataType: 'json',
            data: $('#productListForm').serialize(),
            success: function(response) {
                if (response != "empty") {
                    window.location.href = "list-products.php"    
                }
            },
            error: function(response) {
            }
        });
    });

});