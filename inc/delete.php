<?php

$id = $_GET['id'];

$conn = new mysqli('localhost', 'root', '', 'crud_v');
$conn->query("DELETE FROM users_info WHERE id = '$id' ");