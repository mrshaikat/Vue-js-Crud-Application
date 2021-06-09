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

    // $name = $data->name;
    // $email = $data->email;
    // $cell = $data->cell;

    $photo_name = $_FILES['photo']['name'];
    $photo_tmpname = $_FILES['photo']['tmp_name'];

    //Profile Upload 
    move_uploaded_file($photo_tmpname, '../photo/users/' . $photo_name);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];


    $conn->query("INSERT INTO users_info(name, email, cell, photo) VALUES('$name', '$email', '$cell', '$photo_name')");
}





/**
 * Delete user data
 */
if ($action == 'delete') {
    //get user id
    $id = $_GET['id'];


    $conn->query("DELETE FROM users_info WHERE id = '$id' ");
}



/**
 * View Single user data
 */
if ($action == 'single') {
    //get user id
    $id = $_GET['id'];


    $data = $conn->query("SELECT * FROM users_info WHERE id = '$id' ");

    $single_user_data = $data->fetch_assoc();

    echo json_encode($single_user_data);
}