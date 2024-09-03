<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

//create a connection
$connection = new mysqli( $servername, $username, $password, $database);

$name= "";
$email= "";
$phone = "";
$address = "";
  
$errorMessage= "";
$successMessage= "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){

    //GET meth: Show the data of the client
    if( !isset($_GET["id"])){
        header("location: /index.php");
        exit;
    }

    $id = $_GET["id"];
    //read the row of the selected client from the database
    $sql = "SELECT * FROM clients WHERE id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){
        header("location: /index.php");
        exit;
    }
    
    $name= $row["name"];
    $email= $row["email"];
    $phone= $row["phone"];
    $address= $row["address"];

}
else{
    //POST method: Update the data of the client
    $id =$_POST["id"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone = $_POST["phone"];
    $address =$_POST["address"];

    do{
        if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = "All the field are required";
            break;
        }
       $sql = "UPDATE clients". 
       "SET name = '$name', email = '$email', phone = '$phone', address = '$address' ". 
       "WHERE id =$id"; 

       $result = $connection->query($sql);

       if(!$result){
        $errorMessage = "Invalid query: " . $connection->error;
        break;
       }
       $successMessage = "Client updated correctly";

       header("location: /index.php");
       exit;

    }while(false);


}
   


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>My Shop</title>
</head>
<body>
    <div class="container my-5">
    <H2>New Client</H2>
    <?php
    if(!empty($errorMessage)){
        echo"
        <div class='alert alert-warning alert-dismissible fade show'>
        <button type='button'class='btn-close data-bs-dismiss='alert'></button>
        <strong>$errorMessage</strong>
        </div>
        ";
    }
    ?>
<form method="post">
    <input type="hidden" name="id" value="<?php $id;?>">
 <div class="row mb-3">
      <label  class="col-sm-3 col-form-label">Name</label>
     <div class="col-sm-6">
        <input type="text" name="name" class="form-contol" value="<?php $name;?>">
     </div>
  </div>
  <div class="row mb-3">
      <label  class="col-sm-3 col-form-label">Email</label>
     <div class="col-sm-6">
        <input type="text" name="email" class="form-contol" value="<?php $email;?>">
     </div>
  </div>
  <div class="row mb-3">
      <label class="col-sm-3 col-form-label">phone</label>
     <div class="col-sm-6">
        <input type="text" name="phone" class="form-contol" value="<?php $phone;?>">
     </div>
  </div>
  <div class="row mb-3">
      <label class="col-sm-3 col-form-label">Address</label>
     <div class="col-sm-6">
        <input type="text" name="address" class="form-contol" value="<?php $address;?>">
     </div>
  </div>
  <?php
  if(!empty($successMessage)){
      echo"
        <div class='alert alert-warning alert-dismissible fade show'>
        <button type='button'class='btn-close data-bs-dismiss='alert'></button>
        <strong>$successMessage</strong>
        </div>
        ";

  }
  
  ?>
  <div class="row mb-3">
      <div class="offset-sm-3 col-sm-3 d-grid">
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      <div class="col-sm-3 d-grid">
      <a href="/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
      </div>
    
  </div>
  
</form>

    </div>

</body>
</html>