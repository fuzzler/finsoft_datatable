<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Datatable specs -->
    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
    <script type="text/javascript" src="DataTables/datatables.min.js"></script>

    <title>Data Table</title>
</head>
<body>
    <div class="table-responsive">
        <table id="data_table" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <!-- <th scope="col">Azione</th> -->
                </tr>
            </thead>
        </table>
    </div>
</body>
</html>

<script type="text/javascript" language="javascript" >

$(document).ready( function(){
    $('#data_table').DataTable({
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            url:"fetch.php", // script che espone le API
            type:"POST"
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 }
        ]
    });
}); 
</script>
