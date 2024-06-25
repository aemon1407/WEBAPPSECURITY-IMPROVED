<?php

$servername = "localhost";
$username = "root";
$password = "de462f49531c57e381374b88a91942f7789a7a65f9f156b4";
$dbname = "pembina";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
    $conn->query($sql);

    echo "Admin added";
}

?>

<form method="POST">
    <input type="text" name="username">
    <input type="password" name="password">
    <button type="submit">
Add    
</button>
</form>