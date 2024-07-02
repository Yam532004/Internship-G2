<?php
require '../config/dbconnect.php';
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

$query = $conn->prepare("SELECT * FROM `users` WHERE email = :email");
$query->bindParam(':email', $_POST['email']);
$query->execute();

if ($query->rowCount() > 0) {
    echo 'true'; // Email đã tồn tại trong CSDL
} else {
    echo 'false'; // Email không tồn tại trong CSDL
}
