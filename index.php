<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>MyShop</title>
    
</head>
<body>
     <div class="container my-5">
        <h2>List of clients</h2>
        <a class="btn btn-primary" href="/create.php" role="button">New Person</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "myshop";

                //create a connection
                 $connection = new mysqli( $servername, $username, $password, $database);

                 //check connection
                 if($connection->connect_error){
                    die("connection failed: ". $connection->connect_error);
                 }
                 $sql = "SELECT * FROM clients";
                 $result = $connection->query($sql);

                 if(!$result){
                    die("invalid query: ". $connection->error);
                 }
                 //read data of the database
                 while($row = $result->fetch_assoc()){
                    echo"
                    <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>$row[created_at]</td>
                    <td>
                        <a href='/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                    </td> 
                </tr>
                    ";
                 }

                ?>
                
            </tbody>
        </table>
     </div>
    
</body>
</html>