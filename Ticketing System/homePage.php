<!DOCTYPE html>
<html lang="en">
<head>  <title>Ticketing System - Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('td:last-child:contains(Active)').css('background-color', 'orange');
            $('td:last-child:contains(Pending)').css('background-color', 'grey');
            $('td:last-child:contains(Closed)').css('background-color', 'green');
        });
        </script>
</head>
<body>

    <?php session_start(); include "db_connect.php"; ?>
<h1 style="text-align:center;">Ticketing System - Welcome - <?php echo $_SESSION['sess_username']; ?> </h1>
<h2>Tickets</h2>
<form action="#" method="post">
<input type="submit" value="Create Ticket" style="background-color:rgb(59, 216, 59)" formaction="createTickets.php">
<input type="submit" value="Logout" style="background-color:rgb(59, 216, 59); float:right;" formaction = "Login.php">
</form>
<p>List of tickets - </p>
<?php
    $sessUser = $_SESSION['username'];    
    $result = $conn->prepare("SELECT * FROM tickets ORDER BY id ASC");
    $result->execute();
?>

    <table border = "1px"  width = "100%' id = 'myTable' style=style="border: solid 1px black;' position = 'absolute';>
        <tr><th>id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Date</th>
        <th>Status</th>
        </tr>

        <?php
        while($row=$result->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['firstName']."</td>";
            echo "<td>".$row['lastName']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['message']."</td>";
            echo "<td>".$row['created'];
            echo "<td>".$row['status']."<a id='btnDelete' href = 'delete.php?id=$row[id]' style='float:right; background-color:white;' onClick = '<script>alert(Are you sure you want to delete?')</script>  Delete </a>  <a id='btnEdit' href ='Update.php?id=$row[id]' style='float:right;background-color:white;'>Edit |&nbsp;</a> </td>";
            echo "</tr>";   }
        ?>        
    </table>
</body>
</html>