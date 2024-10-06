<?php
ob_start();
require_once('C:\xampp\phpMyAdmin\vendor\tecnickcom\tcpdf\tcpdf.php');
require 'db_con.php'; // Include TCPDF library
$member_id = $_GET['id'];

// Retrieve payment history records from the database
$sql ="SELECT * FROM members WHERE id = '$member_id'";
$results = $conn->query($sql);
$name=$results->fetch_assoc();
$date_collected=$name['date_collected'];
$date_paid = $name['date_paid'];

$query = "SELECT * FROM payment_history WHERE memberid = '$member_id' AND paymentdate BETWEEN '$date_collected' AND '$date_paid' ORDER BY paymentdate DESC ";
$result = $conn->query($query);


// Create a new TCPDF object
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Your Name');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Payment History for Member ' . $name['name']);
$pdf->SetSubject('Payment History');
$pdf->SetKeywords('payment, history');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 12);

// Add content
$pdf->Cell(0, 10, 'Payment History for Member ' . $name['name'], 0, 1, 'C');
$pdf->Ln(10);

// Create a table
$pdf->Cell(30, 10, 'Payment Date', 1, 0, 'C');
$pdf->Cell(50, 10, 'Amount Paid', 1, 1, 'C');

while ($row = $result->fetch_assoc()) {
	$pdf->Cell(30, 10, $row['paymentdate'], 1, 0, 'C');
	$pdf->Cell(50, 10, $row['Amount_paid'], 1, 1, 'C');
}

// Output the PDF
ob_end_clean();
$pdf->Output('payment_history.pdf', 'D'); // 'D' for download
?>

