<?php
$Name = $_POST['name'];
$email = $_POST['email'];
$Password = md5($_POST['password']);
$Phone = $_POST['phone'];
$Address = $_POST['address'];

$conn = new mysqli("localhost", "root", "", "qr_attendance_db");
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registerr (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $Name, $email, $Password, $Phone, $Address);
    $stmt->execute();
    echo "Registration successful...<br>";
    echo "You will be redirected to the login page in 3 seconds...";
    header('Refresh: 3; URL=login.html');
    $stmt->close();
    $conn->close();
}



?>