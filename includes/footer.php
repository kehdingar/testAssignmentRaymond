
<footer>
    <p>Scandiweb Test assignment</p>

</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $("#productType").change(function (){
            console.log(($(this).val()));
            let selectedType = $(this).val();

            $.ajax({
                type:'GET',
                url:`process-add-product.php?selectedType=${selectedType}`,
                dataType:'json',
                success:function(response){
                    if(!response.empty){

                        console.log("Success");
                        console.log(response.html);
                        console.log(response.info);
                        $("#productHTML").html(response.html);
    
                        let infoHTML = "";
                        response.info.forEach(info => {
                            
                            infoHTML +="<b>"+ info +"</b>";
                        });
                        
                        $("#productInfo").html(infoHTML);
                    }else{
                        console.log("No Value Selected");
                        $("#productHTML").empty();
                        $("#productInfo").empty();

                    }


                },

                error:function (response){
                    console.log("Error");
                    console.log(response);
                }
           

            });

        });

        $(".save").click(function (e){
            console.log("We are about to submit")
            e.preventDefault();
            $('p.error').html("");

            $.ajax({
                type:'POST',
                url:`process-add-product.php`,
                dataType: 'json',
                data: $('form').serialize(),
                success:function(response){
                    // console.log(Object.entries(response));
                    if(response['errors'] != undefined || response['errors'] != null )
                    Object.entries(response['errors']).forEach(([key, value]) => {
                            $(`#${key}Error`).html(value);
                            console.log(key);
                            console.log(value);
                    });
                    // array.forEach(element => {
                        
                    // });
                    // if(!response.empty){

                    //     console.log("Success");
                    //     console.log(response.html);
                    //     console.log(response.info);
                    //     $("#productHTML").html(response.html);
    
                    //     let infoHTML = "";
                    //     response.info.forEach(info => {
                            
                    //         infoHTML +="<b>"+ info +"</b>";
                    //     });
                        
                    //     $("#productInfo").html(infoHTML);
                    // }else{
                    //     console.log("No Value Selected");
                    //     $("#productHTML").empty();
                    //     $("#productInfo").empty();

                    // }


                },

                error:function (response){
                    console.log("Error");
                    console.log(response);
                }
           

            });

        });


    });

</script>
</body>

</html>