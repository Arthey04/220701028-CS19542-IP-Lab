<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'db.php';
$sql="Select empid,ename,desig,dept,doj,salary from empdetails";
$result=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
           <title>Retrieve Employee Details</title>
           <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h2>Employee Details</h2>
        
         <?php if($result->num_rows>0){?>
        <table border="1">
            <tr>
                <th>Empid</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Department</th>
                <th>date of Joining</th>
                <th>Salary</th>
                <th>Update</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['empid']; ?></td>
                    <td><?php echo $row['ename']; ?></td>
                    <td><?php echo $row['desig']; ?></td>
                    <td><?php echo $row['dept']; ?></td>
                    <td><?php echo $row['doj']; ?></td>
                    <td><?php echo $row['salary']; ?></td>
                    <td><a href="update.php?empid=<?php echo $row['empid']; ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
        <p>No employee details found.</p>
    <?php } ?> 
    </body>
</html>