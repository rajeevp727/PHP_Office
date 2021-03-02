<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ticketing System - Home</title>    
</head>
<body>  
    <?php 
    session_start();
    include "db_connect.php"; 
    $name = $_SESSION['sess_username'];
    ?>

<h1 style="text-align:center;">Ticketing System - Welcome - <?php echo $name ?> </h1>
<h2>Tickets</h2>
<form action="#" method="post">
<input type="submit" value="Create Ticket" style="background-color:rgb(59, 216, 59)" formaction="createTickets.php">
<!-- </form>
<form action="Login.php" method="post"> -->
<input type="submit" value="Logout" style="background-color:rgb(59, 216, 59); float:right;" formaction = "Login.php">
</form>
<p>List of tickets - </p>

<?php
    echo "<table id= 'myTable' style='border: solid 1px black; border-collapse: collapse' position = 'absolute';>";
    echo "<tr> <th>Id</th> <th>First name</th> <th>Last name</th> <th>Email</th> <th>Message</th> <th>Date</th> <th>Status</th> </tr>";
 class TableRows extends RecursiveIteratorIterator {
    function __construct($it) { parent::__construct($it, self::LEAVES_ONLY); }  
    function current() { return "<td style='width:200px;border:1px solid black;'>" . parent::current(). "</td>"; }  
    function beginChildren() { echo "<tr>"; }  
    function endChildren() { echo "</tr>"; }
  }  
 try{
     $sqlSelect = 'SELECT * FROM TICKETS ORDER BY created DESC';
     if($conn == TRUE){
         $stmnt = $conn->prepare($sqlSelect);
         $stmnt->execute();
         $result = $stmnt->setFetchMode(PDO::FETCH_ASSOC);
           foreach(new TableRows(new RecursiveArrayIterator($stmnt->fetchAll())) as $k =>$v){
                echo $v; 
            }
        }echo "</table>";
    }
 catch(PDOException $e){ echo "Error".$e->getMessage(); }
//  session_destroy();
 
?>
</body>
</html>