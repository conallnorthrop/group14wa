<?php
include('db_conn.php');
$email = 'abc@xyz.com';
$phone = '09234578686';
$stmt = $pdo->prepare("SELECT * FROM customers Where `email` = ? AND `telephone` = ?");
$stmt->execute([$email,$phone]); 
while ($row = $stmt->fetch()) {
    echo $row['name']."<br />\n";
}