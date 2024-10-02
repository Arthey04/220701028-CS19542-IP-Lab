<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'db.php'; 


$accountInfo = ""; 
$customerDetails = "";

if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];

    
    $sql = "SELECT cid, ano, atype, balance FROM account WHERE cid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $cid); 
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $accountInfo .= "Account Number: " . htmlspecialchars($row['ano']) . "<br>";
                $accountInfo .= "Account Type: " . ($row['atype'] == 'S' ? 'Savings' : 'Current') . "<br>";
                $accountInfo .= "Balance: $" . htmlspecialchars($row['balance']) . "<br><br>";
            }
        } else {
            $accountInfo .= "No account found for customer ID: " . htmlspecialchars($cid);
        }
    }

    
     
    $sql = "SELECT cid, cname FROM customer WHERE cid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        $result = $stmt->get_result();

       
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $customerDetails .= "CID: " . htmlspecialchars($row['cid']) . "<br>";
                $customerDetails .= "Cname: " . htmlspecialchars($row['cname']) . "<br>";
            }
        } else {
            $customerDetails .= "No customer found for customer ID: " . htmlspecialchars($cid);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Info</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
   
        
        <button onClick="toggleCustomerInfo()">
            <i class="fa-solid fa-user"></i> Show Customer Info
        </button>
     
   
    
    <div id="customerInfo" style="margin-top: 20px;">
        <h2>Customer Details</h2>
       <?php
      echo $customerDetails;
        ?>
    </div>
      <div id="accountInfo" style="margin-top: 20px;">
          <h2>Account Details</h2>
        <?php
       
        echo $accountInfo;
        ?>
    </div>
    <script>
        function toggleCustomerInfo()
        {
        customerInfoDiv=document.getElementById('customerInfo');
        if (customerInfoDiv.style.display === 'none' || customerInfoDiv.style.display === '') {
                customerInfoDiv.style.display = 'block'; 
        } else {
                customerInfoDiv.style.display = 'none'; 
        }
    }
    </script>
</body>
</html>
 
