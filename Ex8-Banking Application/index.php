<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
 include 'db.php'
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>User Account</h2>
    <form method="GET" action="account_info.php">
        <label for="cid">Customer ID:</label>
        <input type="text" id="cid" name="cid" required>
        <br>
       
        <input type="submit" value="submit">
    </form>
    <p><a href="create_accno.php">create new Account</a></p>
</body>
</html>