<?php
session_start();

// initializing variables
$name = "";
$price    = "";
$id    = "";
$errors = array(); 
$barcode="";
// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'test');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
     $id = mysqli_real_escape_string($db, $_POST['id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $barcode = mysqli_real_escape_string($db, $_POST['barcode']);
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
   if (empty($id)) { array_push($errors, "Item ID is required"); }
  if (empty($price)) { array_push($errors, "Price is required"); }
  if (empty($barcode)) { array_push($errors, "Barcode is required"); }
 
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM tbl_product WHERE id='$id' ";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['id'] === $id) {
      array_push($errors, "The item already exists");
    }

   
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$barcode = md5($barcode);//encrypt the password before saving in the database

  	$query = "INSERT INTO tbl_product (id,name, barcode, price) 
  			  VALUES('$id','$name', '$barcode', '$price')";
  	mysqli_query($db, $query);
  	$_SESSION['id'] = $id;
  	$_SESSION['success'] = "Item Updated";
  	header('location:index.php');
  }
}



?>

