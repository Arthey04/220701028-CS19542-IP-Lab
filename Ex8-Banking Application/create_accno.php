<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */




include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cname = $_POST['cname'];
    $atype = $_POST['atype'];
    $balance = $_POST['balance'];

    $maxRetries = 10;
    $retryCount = 0;
    $accountExists = false;

 
    do {
        $ano = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);

        
        $checkAccountSql = "SELECT * FROM account WHERE ano = ?";
        if ($stmt = $conn->prepare($checkAccountSql)) {
            $stmt->bind_param("s", $ano);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 0) {
                $accountExists = true; 
            } else {
                $retryCount++;
            }
        }

        if ($retryCount >= $maxRetries) {
            echo "<script>alert('Error: Unable to generate a unique account number. Please try again later.');</script>";
            exit;
        }
    } while (!$accountExists);

    $sql = "INSERT INTO customer (cname) VALUES (?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $cname);
        if ($stmt->execute()) {
            $cid = $stmt->insert_id; 

            
            $insertAccountSql = "INSERT INTO account (cid, ano, atype, balance) VALUES (?, ?, ?, ?)";
            if ($stmt = $conn->prepare($insertAccountSql)) {
                $stmt->bind_param("issd", $cid, $ano, $atype, $balance);
                if ($stmt->execute()) {
                    echo "<script>alert('Customer and account information inserted successfully! Customer ID: " . htmlspecialchars($cid) . ", Account Number: " . htmlspecialchars($ano) . "');</script>";
                } else {
                    echo "<script>alert('Error inserting account information: " . $stmt->error . "');</script>";
                }
            }
        } else {
            echo "<script>alert('Error inserting customer information: " . $stmt->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Customer and Account Info</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Insert Customer and Account Information</h1>
    <form method="POST" action="">
        <label for="cname">Customer Name:</label>
        <input type="text" id="cname" name="cname" required><br>

        <label for="atype">Account Type:</label>
        <select id="atype" name="atype" required>
            <option value="S">Savings</option>
            <option value="C">Current</option>
        </select><br>

        <label for="balance">Balance:</label>
        <input type="number" id="balance" name="balance" step="0.01" required><br>

        <button type="submit">Insert</button>
    </form>
</body>
</html>
