<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


include_once("userAttend.php");

$name="";                                 
$rollno = "";
$date_created = "";
$attendance_status ="";
$policies = [];

//echo json_encode($_POST);
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT `name` , `rollno` FROM `addstudent`";
  $query = $conn->query($sql);
  //print_r($query);
  $addstudent = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_array($result))
  {
   
    $policies[$i]['name']        = $row['name'];
    $policies[$i]['rollno']         = $row['rollno'];
    $i++;
  }
  
  echo json_encode($policies);
  
}

  $out['addstudent'] = $addstudent;

}






$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{

$request = json_decode($postdata);


//$img = mysqli_real_escape_string($conn, trim($request->img));

$attendance_status = mysqli_real_escape_string($conn, trim($request->attendance_status));
$date_created = mysqli_real_escape_string($conn, trim($request->date_created));
$date_created = date('Y-m-d H:i:s');

  
$query = "
  INSERT INTO `addstudent`(`name`, `rollno`, `attendance_status`) 
  VALUES('{$name}','{$rollno}','{$attendance_status}')
  WHERE 'id' = '$id'";

  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
}

 mysqli_close($conn);
 ?>