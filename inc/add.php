<?php

$data = json_decode(file_get_contents('php://input'));

$name = $data->name;
$email = $data->email;
$cell = $data->cell;

$conn = new mysqli('localhost', 'root', '', 'crud_v');
$conn->query("INSERT INTO users_info(name, email, cell) VALUES('$name', '$email', '$cell')");