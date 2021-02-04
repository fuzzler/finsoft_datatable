<?php

//fetch.php

include('connector.php');

$column = ["id", "first_name", "last_name", "gender"];

$query = "SELECT * FROM tbl_sample ";

if(isset($_POST["search"]["value"])){
    $query .= '
        WHERE first_name LIKE "%'.$_POST["search"]["value"].'%" 
        OR last_name LIKE "%'.$_POST["search"]["value"].'%" 
        OR gender LIKE "%'.$_POST["search"]["value"].'%" 
        ';
}

if(isset($_POST["order"])){
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else {
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$stmt = $pdo->prepare($query);
$stmt->execute();
$number_filter_row = $stmt->rowCount();
$stmt = $pdo->prepare($query . $query1);

$stmt->execute();
$result = $stmt->fetchAll();

// var_dump($result); die;
$data = [];

foreach($result as $row){
    $sub_array = [];
    $sub_array[] = $row['id'];
    $sub_array[] = $row['first_name'];
    $sub_array[] = $row['last_name'];
    $sub_array[] = $row['gender'];
    $data[] = $sub_array;
}

function count_all_data(PDO $pdo):int {
    $query = "SELECT * FROM tbl_sample";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->rowCount();
}

$output = [
    'draw'   => intval($_POST['draw']),
    'recordsTotal' => count_all_data($pdo),
    'recordsFiltered' => $number_filter_row,
    'data'   => $data
];

echo json_encode($output);