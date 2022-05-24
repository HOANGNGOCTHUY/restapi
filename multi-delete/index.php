<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MULTI DELETE DATA</title>
</head>
<style>
    button{
        background: red;
        color:white;
        padding: 9px 15px;
        border: none;
        outline: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover{
        opacity: 0.4;
    }
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
</style>
<body>
        <div id="main">
            <button id="delete-btn">Delete</button>
            <div id="table-data"></div>
        </div>
        <div id="error-msg"></div>
        <div id="success-msg"></div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        function loadData(){
            $.ajax({
                url:"../multi-delete/load-data.php",
                type:"POST",
                success: function(data){
                    $("#table-data").html(data);
                }
            })
        }
        loadData();

        $("#delete-btn").on("click",function(){
            var id = [];
            $(":checkbox:checked").each(function(key){
                id[key] = $(this).val();
            });
            
            if(id.length === 0){
                alert("VUI LÒNG CHỌN ÍT NHẤT MỘT HỘP KIỂM");
            }else{
                if(confirm("ĐỌC CHO KỸ RỒI BẤM OK, KHÔNG LẠI HỐI HẬN!!^^")){
                    $.ajax({
                    url:"../multi-delete/delete-data.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data){
                        if(data == 1){
                            $("#success-msg").html("xóa thành công!!").slideDown();
                            $("error-msg").slideUp();
                            loadData();
                        }else{
                            $("#error-msg").html("xóa Thất Bại!! Hãy thử lại..^^").slideDown();
                            $("success-msg").slideUp();
                        }
                    }
                })
                }
                
            }
        });
    })
</script>
</html>