<?php

//Server Connection
$conn = new mysqli('localhost', 'root', '', 'crud_v');

//Get all fetch data
$data = json_decode(file_get_contents('php://input'));

//Get Action
$action = 'read';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}



/**
 * read all user data
 */
if ($action == 'read') {
    $data = $conn->query("SELECT * FROM users_info ORDER BY id DESC");

    $all_users = [];

    while ($user = $data->fetch_assoc()) {
        array_push($all_users, $user);
    }

    echo json_encode($all_users);
}


/**
 * Create all user data
 */
if ($action == 'create') {
    $name = $data->name;
    $email = $data->email;
    $cell = $data->cell;


    $conn->query("INSERT INTO users_info(name, email, cell) VALUES('$name', '$email', '$cell')");
}





/**
 * Delete user data
 */
if ($action == 'delete') {

    $id = $_GET['id'];


    $conn->query("DELETE FROM users_info WHERE id = '$id' ");
}