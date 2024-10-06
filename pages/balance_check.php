<?php
include 'db_con.php';
$error="";
$money = $_POST['money'];
$date =$_POST['dates'];
$action=$_GET['action'];
$id=$_GET['id'];
$datem = date_create($date);
date_add($datem, date_interval_create_from_date_string('35 days'));
$date_end = date_format($datem, 'Y-m-d');
$query ="SELECT * FROM members WHERE id=$id";
$results=$conn->query($query);
$raw=$results->fetch_assoc();
$old_amount = $raw['Paid_amount'];
$old_date =$raw['date_paid'];

if($action =='pay_loan'){
if($money<$raw['Balance'] || $money==$raw['Balance']){
$sql = "UPDATE members  SET paid_amount = paid_amount+$money, Balance = Amount_to_be_paid-paid_amount, date_paid= '$date' WHERE id = '$id'";
$result = $conn->query($sql);
if($result){
    $query = "INSERT INTO payment_history (memberid,Amount_paid,paymentdate) VALUES('$id','$money','$old_date')";
    $conn->query($query);
    header("Location:profile.php?id=$id");
}
else{
    echo "invalid syntax";
}
}
    else{
       
         $error="oops something went wrong. payment cant be larger than Balance";
         header("Location:profile.php?id=$id&error=$error");
    }

}
if($action =='take_loan'){
$balance = ($money*0.25)+$money;
$sql = "UPDATE members  SET Amount_taken = '$money' , Amount_to_be_paid='$balance', Balance = '$balance', Paid_amount=0, profits= profits+($balance-$money) , date_collected='$date',date_end='$date_end',date_paid='$date' WHERE id = '$id'";
$result = $conn->query($sql);
if($result){
    header("Location:profile.php?id=$id");
}
else{
    echo "invalid syntax";
}

}


?>