<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API CRUD</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        #app{
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }
        h2{
            background: blue;
            color: white;
            padding: 9px;
            text-align: center;
            margin: 20px 0;
        }
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }
        #search-bar{
            width: 500px;
            margin: 20px auto;
        }
        
        #search-bar input{
            width: 100%;
            padding: 9px 15px;
            border: 1px solid #c4c4c4;
            outline: none;
            border-radius: 30px;
        }
        input[type="submit"]{
            padding: 9px 15px;
            border: none;
            border-radius: 30px;
            color: white;
            background: red;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            opacity: 0.7;
        }
        button{
            padding: 9px 15px ;
            border: none;
            outline: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-btn{
            background: green;
        }
        .delete-btn{
            background: red;
        }
        .edit-btn:hover, .delete-btn:hover{
            opacity: 0.4;
        }   
        #modal{
            position: absolute;
            display: none;
            top: 20%;
            left: 50%;
            transform: translate(-50%,-50%) ;
            background: #fff;
            border-radius: 4px;
            padding: 20px;
            box-shadow: 0 0 5px 5px rgba(255, 0, 0, 0.3);
        }
        .close{
            position: absolute;
            right: -10px;
            top: -15px;
            border-radius: 50%;
            background: red;
            color: #fff;
            padding: 5px 7px;
            cursor: pointer;
        }
        #success-msg{
            background: greenyellow;
            padding: 9px;
            display: none;
        }
        #error-msg{
            background: red;
            padding: 9px;
            display: none;
        }


</style>
</head>
<body>
    <div id="app">
        <h2>REST API CRUD</h2>

        <div id="search-bar">
            <input type="text" name="search" id="search" placeholder="Nhập tìm kiếm...." autocomplete="off">
        </div>

        <table id="table-data">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>City</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </table>


        <!-- ADD -->
        <h2>ADD</h2>
        <form id="addForm">
            Name: <input type="text" name="sname" id="sname">
            Age: <input type="text" name="sage" id="sage">
            City: <input type="text" name="scity" id="scity">
            <input type="submit" name="save-button" id="save-button" value="Save">
        </form>
        <!-- ADD -->
        <div id="modal">
        <h2>EDIT</h2>
        <form action="" id="editForm">
            Id: <input type="text" name="sid" id="eid" value="" hidden="">
            Name: <input type="text" name="sname" id="ename" value="">
            Age: <input type="text" name="sage" id="eage"  value="">
            City: <input type="text" name="scity" id="ecity"  value="">
            <input type="submit" name="edit-button" id="edit-button" value="Update">
        </form>
        <div class="close">X</div>
        </div>

    </div>

    <div id="success-msg"></div>
    <div id="error-msg"></div>


    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script>
        $(document).ready(function(){
            // Load table
            function loadTable(){
                $.ajax({
                url:"http://localhost/restapi/api-fecth-all.php",
                type:"GET",
                // dataType: "JSON",
                success: function(data){
                    if(data.status == false){
                        $("#table-data").append(
                            "<tr><td><h2>"+data.message+"</h2></td></tr>"
                        );
                    }else{
                        $.each(data,function(key,value){
                            $("#table-data").append("<tr>"
                                                    +"<td>"+ value.id + "</td>" +
                                                    "<td>"+ value.name + "</td>" +
                                                    "<td>"+ value.age + "</td>" +
                                                    "<td>"+ value.city + "</td>" +
                                                    "<td><button class='edit-btn' data-eid='"+value.id+"'>Edit</button></td>" +
                                                    "<td><button class='delete-btn' data-did='"+value.id+"'>Delete</button></td>"+
                                                    "</tr>");
                        })
                    
                    }
                    }
            });
            }
            loadTable();
            // Show Success or error Messages
            function message(message, status){
                if(status == true){
                    $("#success-msg").html(message).slideDown();
                    $("#error-msg").slideUp();
                    setTimeout(function(){
                        $("#success-msg").slideUp();
                    },4000);
                }else if(status == false){
                    $("#error-msg").html(message).slideDown();
                    $("#success-msg").slideUp();
                    setTimeout(function(){
                        $("#error-msg").slideUp();
                    },4000);
                }
            }

            // function for form data to json object
            function jsonData(targetForm){

                var arr = $("#addForm").serializeArray();
                // console.log(arr);
                var obj = {};
                for(var a= 0; a < arr.length; a++){
                    if(arr[a].value == ""){
                        return false;
                    }
                    obj[arr[a].name] = arr[a].value;
                }
                // console.log(obj);
                var json_string = JSON.stringify(obj);
                // console.log(json_string);
                return json_string;
            }
            
            // Fetch single record: show modal //dùng id lấy tất cả thông tin của id đó => name, age, city...
            $(document).on("click",".edit-btn",function(){
                $("#modal").show();
                var studentId = $(this).data("eid");
                var obj = { 
                    sid: studentId
                };
                var myJSON = JSON.stringify(obj);

                $.ajax({
                    url:"http://localhost/restapi/api-fecth-single.php",
                    type:"POST",
                    // dataType: "JSON",
                    data: myJSON,
                    success: function(data){
                        $("#eid").val(data[0].id);
                        $("#ename").val(data[0].name);
                        $("#eage").val(data[0].age);
                        $("#ecity").val(data[0].city);
                    }
                })
                
            });
            $(".close").on("click",function(){
                $("#modal").hide();
            });

            // INSERT INTO
            $("#save-button").on("click",function(e){
                e.preventDefault();

                var jsonObj = jsonData("#addForm");
                // console.log(jsonObj);
                if(jsonObj == false){
                    message("ALL fields are required.", false);
                }else{
                    $.ajax({
                        url:"http://localhost/restapi/api-insert.php",
                        type: "POST",
                        data: jsonObj,
                        success: function(data){
                            message(data.message,data.status);
                            if(status == true){
                                loadTable();
                                $("#addForm").trigger("reset");
                            }
                        }
                    })
                    
                }
            })

            // Update
            $("#edit-button").on("click",function(e){
                e.preventDefault();

                var jsonObj = jsonData("#editForm");
                // console.log(jsonObj);
                if(jsonObj == false){
                    message("ALL fields are required.", false);
                }else{
                    $.ajax({
                        url:"http://localhost/restapi/api-update.php",
                        type: "POST",
                        data: jsonObj,
                        success: function(data){
                            message(data.message,data.status);
                            if(status == true){
                                $("#modal").hide();
                                loadTable();
                                $("#addForm").trigger("reset");
                            }
                        }
                    })
                    
                }
            })

        })
    </script> -->

    <script>
        $(document).ready(function(){
            // Load table
            function loadTable(){
                $("#table-data").html();
                $.ajax({
                url:"http://localhost/restapi/api-fecth-all.php",
                type:"GET",
                // dataType: "JSON",
                success: function(data){
                    if(data.status == false){
                        $("#table-data").append(
                            "<tr><td><h2>"+data.message+"</h2></td></tr>"
                        );
                    }else{
                        $.each(data,function(key,value){
                            $("#table-data").append("<tr>"
                                                    +"<td>"+ value.id + "</td>" +
                                                    "<td>"+ value.name + "</td>" +
                                                    "<td>"+ value.age + "</td>" +
                                                    "<td>"+ value.city + "</td>" +
                                                    "<td><button class='edit-btn' data-eid='"+value.id+"'>Edit</button></td>" +
                                                    "<td><button class='delete-btn' data-did='"+value.id+"'>Delete</button></td>"+
                                                    "</tr>");
                        })
                    
                    }
                    }
            });
            }
            loadTable();
            // Fetch single record: show modal //dùng id lấy tất cả thông tin của id đó => name, age, city...
            $(document).on("click",".edit-btn",function(){
                $("#modal").show();
                var studentId = $(this).data("eid");
                var obj = { 
                    sid: studentId
                };
                var myJSON = JSON.stringify(obj);

                $.ajax({
                    url:"http://localhost/restapi/api-fecth-single.php",
                    type:"POST",
                    // dataType: "JSON",
                    data: myJSON,
                    success: function(data){
                        $("#eid").val(data[0].id);
                        $("#ename").val(data[0].name);
                        $("#eage").val(data[0].age);
                        $("#ecity").val(data[0].city);
                    }
                })
                
            });
            $(".close").on("click",function(){
                $("#modal").hide();
            });

            // MESSAGE
            function message(message,status){
                if(status == true){
                    $("#success-msg").html(message).slideDown();
                    $("#error-msg").slideUp();
                    setTimeout(function(){
                        $("#success-msg").slideUp();
                    },4000);
                }else if(status == false){
                    $("#error-msg").html(message).slideDown();
                    $("#success-msg").slideUp();
                    setTimeout(function(){
                        $("#error-msg").slideUp();
                    },4000);
                }
            }
            // FUNCTION FOR FORM DATA TO JSON OBJECT
            function jsonData(targetForm){
                var arr = $("#addForm").serializeArray(); // Mã hóa một tập hợp các phần tử biểu mẫu dưới dạng một mảng tên và giá trị.
                // console.log(arr);
                var obj = {}; // Tạo object để lưu vào 
                for(var a = 0; a < arr.length; a++){

                    if(arr[a].value == ""){
                        return false;
                    }
                    obj[arr[a].name] = arr[a].value;
                }
                // console.log(obj);
                var json_string = JSON.stringify(obj); // chuyển thành một chuỗi
                // console.log(json_string);
                return json_string;
            }
            // THÊM
            $("#save-button").on("click",function(e){
                e.preventDefault();

                var jsonObj = jsonData("#addForm");
                console.log(jsonObj);
                if(jsonObj == false){
                    message("ALL fields are required.", false);
                }else{
                    $.ajax({
                        url:"http://localhost/restapi/api-insert.php",
                        type:"POST",
                        data: jsonObj,
                        success: function(data){
                            message(data.message, data.status);

                            if(data.status == true){
                                loadTable();
                                $("#addForm").trigger("reset");

                            }
                            
                            
                        }
                    });
                }
            });
            // Update
            $("#edit-button").on("click",function(e){
                e.preventDefault();

                var jsonObj = jsonData("#editForm");
                console.log(jsonObj);
                if(jsonObj == false){
                    message("ALL fields are required.", false);
                }else{
                    $.ajax({
                        url:"http://localhost/restapi/api-update.php",
                        type:"POST",
                        data: jsonObj,
                        success: function(data){
                            message(data.message, data.status);

                            if(data.status == true){
                                loadTable();
                                $("#editForm").trigger("reset");

                            }
                            
                            
                        }
                    });
                }
            });



        })
    </script>
</body>
</html>