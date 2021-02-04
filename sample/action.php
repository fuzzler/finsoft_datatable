<?php

//action.php

require('connector.php');

if($_POST['action'] == 'edit') {
    $data = [
        ':first_name'  => $_POST['first_name'],
        ':last_name'  => $_POST['last_name'],
        ':gender'   => $_POST['gender'],
        ':id'    => $_POST['id']
    ];

    $query = "UPDATE tbl_sample SET first_name = :first_name,last_name = :last_name,gender = :gender WHERE id = :id"; 
    // $query .= "WHERE id = :id";
    $stmt = $dbo->prepare($query);
    if(!($stmt->execute($data))) die("fail");
    echo json_encode($_POST);
}

if($_POST['action'] == 'delete') {
    $query = "
    DELETE FROM tbl_sample 
    WHERE id = '".$_POST["id"]."'
    ";
    $stmt = $dbo->prepare($query);
    $stmt->execute();
    echo json_encode($_POST);
}