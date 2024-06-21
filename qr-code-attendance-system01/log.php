<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $conn = new mysqli("localhost", "root", "", "qr_attendance_db");
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT id, name, email, password FROM registerr WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
    
        $user = $result->fetch_assoc();
        if ($password == $user['password']) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php");
            exit();
        } else {
            
            echo "Incorrect password!";
        }
    } else {
        
        echo "Email not registered!";
    }

    $stmt->close();
    $conn->close();
}
?>
