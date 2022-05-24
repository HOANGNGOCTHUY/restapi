<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPLOAD FILES</title>
</head>
<style>
    #preview{
        padding: 10px;
        border: 1px  solid darkslateblue;
        display: none;
    }
    #preview img{
        width: 200px;
        height: 200px;
    }
</style>
<body>
    <div id="main">
        <form action="" id="submit-form">
            <label for="">SELECT FILES</label><br><br><br>
            <input type="file" name="file" id="upload_file"><br><br><br>
            <span class="help-block">Type: JPG, PNG, GIF</span><br><br><br>
            <input type="submit" value="upload_button" id="upload-btn" value="Upload Files"><br><br><br><br>
        </form>

        <div id="preview">
            <h3>PREVIEW IMAGE</h3>
            <div id="image_preview"></div>
        </div>
    </div>
    
</body>
<script src="../js/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $("#submit-form").on("submit",function(e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url:"../uploadFile/upload.php",
                type:"POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    $("#preview").show();
                    $("#image_preview").html(data);
                    $("#upload_file").val('');

                }

            });
        });

        $(document).on("click","#delete-btn",function(){
            if(confirm("Are you sure you want to remove this Image?")){
                var path = $("#delete-btn").data("path");
                // console.log(path);
                $.ajax({
                    url:"../uploadFile/delete.php",
                    type:"POST",
                    data:{
                        path: path,
                    },
                    success:function(data){
                        if(data != ""){
                            $("#preview").hide();
                            $("#image_preview").html('');
                        }
                        // console.log(data);
                    }
                })
            }
        })

    })
</script>
</html>