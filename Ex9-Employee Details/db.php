<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

 $db_server="localhost";
    $db_user="root";
    $db_pass="Arthey@1274";
    $db_name="employeedb";
    $db_port = "3308";
    $conn="";
    
    $conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name,$db_port);
               