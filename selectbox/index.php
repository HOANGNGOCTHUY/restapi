<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Box</title>
</head>
<body>
        <form action="">
            <label for="country">Country:</label>
            <select name="country" id="country">
                <option value="">Select Country</option>
            </select>
            <label for="state">State:</label>
            <select name="state" id="state">
                <option value="">Select State</option>
            </select>
        </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        function loadData(type , category_id){
            $.ajax({
                url:"../selectbox/loadselectbox.php",
                type:"POST",
                data: {
                    type: type,
                    id: category_id
                },
                success: function(data){
                    if(type == "stateData"){
                        $("#state").html(data);
                    }else{
                        $("#country").append(data);
                    }
                    
                }
            });
        }
        loadData();

        $("#country").on("change", function(){
            var country = $("#country").val();
            if(country != ""){
                loadData("stateData", country);
            }else{
                $("#state").html("hihi");
            }
        });
    });
</script>
</html>