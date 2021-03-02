<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System - Create Ticket</title>
</head>
<body>
    <form action="#" method="post">
    <h1 style="text-align:center;">Ticketing System</h1>
    <h2>Create a Ticket</h2>
    <input type="text" name="fName" placeholder = "Enter your First Name" id="fName"> <br> <br>
    <input type="text" name="lName" placeholder = "Enter your Last Name" id="lName"> <br> <br>
    <textarea name="msg" id="msg" cols="30" rows="5" placeholder = "Enter your message here"></textarea> <br> <br>
    <input type="text" name="email" placeholder = "Enter your Email here" id="fName"> <br>
    <input type="submit" value="Submit" name = "submit" style="background-color:rgb(59, 216, 59)"> 
    </form>
    <form action="homepage.php">
        <input type="submit" value="Click here go to home page" style="background-color:rgb(105, 28, 168)">
    </form>

    <?php
    include 'db_connect.php';

    try{
    $conn = new PDO("mysql:host=$db_host; dbname=ticketingsystem", $db_user, $db_password); 
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if(empty($_POST['fName']) || empty($_POST['lName'] || empty($_POST['msg'])) || empty($_POST['email']))
    {  echo "<style>alert('Fields cannot be empty')</style>";  }
    else{
      $firstName = $_POST['fName'];
      $lastName = $_POST['lName'];
      $email = $_POST['email'];
      $message = $_POST['msg'];
      $status = "Active";
      $created = date('Y-m-d H:i:s');

      $stmnt = $conn->prepare("INSERT INTO tickets (`First Name`, `Last Name`, `email`, `message`, `created`, `status`) 
      VALUES(:fName, :lName, :email, :message, :created, :status)");
      $stmnt->bindParam(':fName', $firstName);
      $stmnt->bindParam(':lName', $lastName);
      $stmnt->bindParam(':email', $email);
      $stmnt->bindParam(':message', $message);
      $stmnt->bindParam(':created', $created);
      $stmnt->bindParam(':status', $status);

      $stmnt->execute();

      echo "<script>alert('New Record successfully Inserted into table!!!')</script>";
    }
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>
    
</body>
</html>