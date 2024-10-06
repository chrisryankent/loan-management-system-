<?php
include 'db_con.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST ['phone'];

// Sanitize input (use prepared statements in production)
$name = mysqli_real_escape_string($conn, $name);
$email = mysqli_real_escape_string($conn, $email);
 // Use bcrypt or Argon2 if possible

$sql = "INSERT INTO admin (username, email, password,phone) VALUES ('$name', '$email', '$password', '$phone')";

if ($conn->query($sql)) {
    header("Location: index.php");
    exit; // Important: Stop execution after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

