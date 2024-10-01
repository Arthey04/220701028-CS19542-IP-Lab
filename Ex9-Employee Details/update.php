<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

include 'db.php';

if(isset($_GET['empid']))
{
    $empid=$_GET['empid'];
    $sql="Select * from  empdetails where empid=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$empid);
    $stmt->execute();
    $result=$stmt->get_result();
    
    if($result->num_rows>0)
    {
        $row=$result->fetch_assoc();
    }
      else {
        echo "Employee not found.";
        exit;
    }
}
 else {
    echo "No employee ID provided.";
    exit;
 }
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $ename = $_POST['ename'];
    $desig = $_POST['desig'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $salary = $_POST['salary'];
    
    $sql_update="UPDATE empdetails SET ename = ?, desig = ?, dept = ?, doj = ?, salary = ? WHERE empid = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ssssdi", $ename, $desig, $dept, $doj, $salary, $empid);
     if ($stmt_update->execute()) {
        echo "Employee details updated successfully!";
    } else {
        echo "Error updating employee: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Details</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<h2>Update Employee Details</h2>

<form method="POST" action="">
    <input type="hidden" name="empid" value="<?php echo $empid; ?>">
    
    
    <label for="ename">Employee Name:</label><br>
    <input type="text" id="ename" name="ename" value="<?php echo $row['ENAME']; ?>" required><br><br>

    <label for="desig">Designation:</label><br>
    <input type="text" id="desig" name="desig" value="<?php echo $row['DESIG']; ?>" required><br><br>

    <label for="dept">Department:</label><br>
    <input type="text" id="dept" name="dept" value="<?php echo $row['DEPT']; ?>" required><br><br>

    <label for="doj">Date of Joining:</label><br>
    <input type="date" id="doj" name="doj" value="<?php echo $row['DOJ']; ?>" required><br><br>

    <label for="salary">Salary:</label><br>
    <input type="number" id="salary" name="salary" value="<?php echo $row['SALARY']; ?>" required><br><br>

    <input type="submit" value="Update">
</form>

</body>
</html>