<footer>
    <p>Scandiweb Test assignment</p>

</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function() {

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
                        window.location.href = "list-products.php"
                    }

                },

                error: function(response) {
                }


            });

        });


    });
</script>
</body>

</html>