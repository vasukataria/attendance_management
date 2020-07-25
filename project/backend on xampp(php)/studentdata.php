<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header ("Content-type: image/jpg");


include_once("userAttend.php");

$name="";                                 
$rollno = "";
$gender = "";
$age = "";
$email = "";
$img   ="";
$policies = [];

//echo json_encode($_POST);
$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
  $crud = $_GET['crud'];
}
//$postdata = file_get_contents("php://input");



  if($crud == 'read'){
  $sql = "SELECT * FROM `addstudent`";
  $query = $conn->query($sql);
  //print_r($query);
  $addstudent = array();

  if($result = mysqli_query($conn,$sql))
  {
    $i = 0;
  while($row = mysqli_fetch_array($result))
  {
    $policies[$i]['id']           = $row['id'];
    $policies[$i]['img']          =  base64_encode($row['img']);
    $policies[$i]['name']        = $row['name'];
    $policies[$i]['rollno']         = $row['rollno'];
    $policies[$i]['gender']         = $row['gender'];
    $policies[$i]['age']         = $row['age'];
    $policies[$i]['email']         = $row['email'];
    
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
$name = mysqli_real_escape_string($conn, trim($request->name));
$rollno = mysqli_real_escape_string($conn, trim($request->rollno));
$gender = mysqli_real_escape_string($conn, trim($request->gender));
$age = mysqli_real_escape_string($conn, trim($request->age));
$email = mysqli_real_escape_string($conn, trim($request->email));

  

    $sql_u = "SELECT * FROM `addstudent` WHERE `rollno`='{$rollno}'";
    $sql_e = "SELECT * FROM `addstudent` WHERE `email`='{$email}'";
    $res_u = mysqli_query($conn, $sql_u);
    $res_e = mysqli_query($conn, $sql_e);
    //$result =[];
    //$api = $this->api;
    if (mysqli_num_rows($res_u) > 0) {
      $name_error = "Sorry... roll no. already taken";
       //var_dump(http_response_code(400));
       http_response_code(400); 
       echo $name_error;
      //$result=["status"=>'alreadyusername',"message"=>$name_error];
      //echo json_encode($result);

    }else if(mysqli_num_rows($res_e) > 0){
      $email_error = "Sorry... email already taken"; 
      http_response_code(400);
      echo $email_error;
     // $result=["status"=>'alreadyusername',"message"=>$email_error];
      //echo json_encode($result);
      //die();
    }
  else{
$query = "
  INSERT INTO `addstudent`(`name`, `rollno`, `gender`, `age`, `email`) 
  VALUES('{$name}','{$rollno}','{$gender}','{$age}', '{$email}')";

  if(mysqli_query($conn , $query)){
    echo "Records added successfully.";
  } else{
 echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
}
}

if($crud == 'update'){
$id = mysqli_real_escape_string($conn, $_POST['id']);
$img  = mysqli_real_escape_string($conn, $_POST['img']) ;
$name  = mysqli_real_escape_string($conn, $_POST['name']);
$rollno  = mysqli_real_escape_string($conn, $_POST['rollno']);
$gender  = mysqli_real_escape_string($conn, $_POST['gender']);
$age  = mysqli_real_escape_string($conn, $_POST['age']);
$email  = mysqli_real_escape_string($conn, $_POST['email']);


$query = "UPDATE `addstudent` SET `img`='$img',`name`='$name',`rollno`='$rollno',`gender`='$gender',`age`='$age',`email`='$email'  WHERE `id` = '$id' ";

if(mysqli_query($conn , $query)){
    echo "Records edited successfully.";
 }else{
         echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
      }
  
}

if($crud == 'delete'){

  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $sql = $conn->prepare("DELETE FROM `addstudent` WHERE id=?");
  $sql->bind_param("s", $id);
  $sql->execute();

  

  if(mysqli_query($conn , $sql)){
    $out['message'] = "Member Deleted Successfully";
  }
  else{
    $out['error'] = true;
    $out['message'] = "Could not delete Member";
  }
  
}
 mysqli_close($conn);
 ?>
