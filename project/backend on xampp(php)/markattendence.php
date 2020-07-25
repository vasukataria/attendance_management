<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once("userAttend.php");

if(isset($_POST['submit']))
{
    foreach ($_POST['attendance_status'] as $id => $attendance_status)
    {
        $roll_no = $_POST['roll_no'][$id];
        $student_name = $_POST['student_name'][$id];
           $date_created = date('Y-m-d H:i:s');
        $date_modified = date('Y-m-d H:i:s');
         
        $attendance = $conn->prepare("INSERT INTO attendance (roll_no, student_name, date_created, date_modified, attendance_status) VALUES (?, ?, ?, ?, ?)");
        $attendance->bind_param("issss", $roll_no, $student_name, $date_created, $date_modified, $attendance_status);
        $attendance->execute();
    }
     
    if ($conn->affected_rows==1) {
        $msg = "Attendance has been added successfully";
    }
}

?>


<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
//header('Content-Type: application/json');


include_once("mydb.php");

$name="";
$rollno ="";
$attendance_status ="";    
$date_created ="";



 
 //echo 'Connected successfully' ;
//echo json_encode($_POST);
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
$request = json_decode($postdata);


$name = mysqli_real_escape_string($conn, trim($request->name));
$rollno = mysqli_real_escape_string($conn, trim($request->rollno));
$attendance_status = mysqli_real_escape_string($conn, trim($request->attendance_status));
$date_created = mysqli_real_escape_string($conn, trim($request->date_created);
$date_created = date('Y-m-d H:i:s');

$query = "
  INSERT INTO `markAttendence`(`name`, `rollno`, `date_created`, `attendance_status`) 
  VALUES('{$img}','{$name}','{$rollno}','{$gender}','{$age}', '{$email}')";

  if(mysqli_query($conn , $query)===1){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}

}

 mysqli_close($conn);
 ?>