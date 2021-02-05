<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Sample specs -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>


    <title>Sample Table</title>
</head>
<body>
    <div class="table-responsive mx" >
        <table id="sample_data" class="table table-striped table-bordered" style="width:90%;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>

<script type="text/javascript" language="javascript" >

$(document).ready( function(){

    let dataTable = $('#sample_data').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url:"fetch.php",
            type:"POST"
        }
        ,"columns": [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 }
        ]
    });

    $('#sample_data').on('draw.dt', function(){
        $('#sample_data').Tabledit({
            url:'action.php',
            dataType:'json',
            columns:{
                identifier : [0, 'id'],
                editable:[[1, 'first_name'], [2, 'last_name'], [3, 'gender', '{"1":"Male","2":"Female"}']]
            },
            restoreButton:false,
            onSuccess: function(data, textStatus, jqXHR) {
                if(data.action == 'delete') {
                    $('#' + data.id).remove();
                    $('#sample_data').DataTable().ajax.reload();
                }
            }
        });
    });  
}); 
</script>
