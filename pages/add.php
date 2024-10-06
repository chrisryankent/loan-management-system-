<?php
include 'db_con.php';

$name = $_POST['name'];
$email = $_POST['email'];
$city=$_POST['City'];
$phone=$_POST['phone'];
$nin=$_POST['NINnumber'];
$guarantor=$_POST['Gname'];
$gphone=$_POST['Gphone'];
$date=$_POST['date'];
$amount=$_POST['Amount'];
$datem = date_create($date);
date_add($datem, date_interval_create_from_date_string('35 days'));
$amount_to_be_paid = ($amount*0.25)+$amount;
$date_end = date_format($datem, 'Y-m-d'); 
$balance = $amount_to_be_paid;
$profit = $amount_to_be_paid-$amount;
$paid=0;


$sql = "INSERT INTO members (name, email, City, phone, guaranter, NIN_NO, guaranterphone, date_collected, Amount_taken,Balance,date_end, Amount_to_be_paid,profits,Paid_amount,date_paid) VALUES ('$name','$email','$city','$phone','$guarantor','$nin','$gphone','$date','$amount','$balance','$date_end','$amount_to_be_paid', '$profit' ,'$paid','$date')";

if ($conn->query($sql)) {
    header("Location: virtual-reality.php");
    exit; // Important: Stop execution after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

