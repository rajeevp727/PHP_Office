<?php
if (session_status() !== PHP_SESSION_ACTIVE) {  session_start();   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Ticket System - Home page</title>
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
    <?php
    // print_r($_SESSION);
    include "db_connect.php";
    if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
        if(isset($_POST['btnLogout'])){
            session_destroy();
            header("location: Login.php");
        }
                
    ?>
    <?php
    if(!($_SESSION['userType'] == "Tester" || $_SESSION['userType'] == "Manager")){    ?>
        <script>
        $(document).ready(function(){
            $('#btnCreate').prop('disabled', true);
        });
        </script>
<?php  }  ?>
    <h1 style="text-align: center">Welcome - 
    <?php
    if(!empty($_SESSION['userType'])){ 
        echo $_SESSION['fName']."(Role: ".$_SESSION['userType'].")";
    ?>
    </h1>
    <?php } else{  print_r($_SESSION); echo "<script>alert('Invalid Session. Try logging in again')</script>"; } ?>
    <h3>Tickets</h3>
    <form method="post">
    <table border=1 width=100%>
        <tr>
            <th>Id</th>
            <th>created By</th>
            <th>Comments</th>
            <th>Created</th>
            <th>Status</th>
        </tr>
        <?php
        $stmnt = $conn->prepare("select * from tickets order by id ASC");
        $stmnt->execute();

        while($rows= $stmnt->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$rows['id']."</td>";
            echo "<td>".$rows['createdBy']."</td>";
            echo "<td>".$rows['comments']."</td>";
            echo "<td>".$rows['created']."</td>";
            echo "<td>".$rows['status'].
                "<a class='delete' href='delete.php?id=$rows[id]' style='float:right; background-color:red;'> Delete </a> 
                <a id='btnEdit' href ='Update.php?id=$rows[id]' style='float:right;background-color:cyan;'>Edit |&nbsp;</a></td>";
            echo "</tr>";
            $_SESSION['createdBy'] = $rows['createdBy'];
        }
        ?>
    </table><br>
    <?php
    if(isset($_POST['createTickets'])){  header("location: createTickets.php");   }
    ?>
    <input type="submit" name= "manager" id="btnCreate" value="Create Tickets" formaction= "createTickets.php">
    <input type="submit" name="btnLogout" value="Logout" style="float:right;">
    </form>
</body>
</html>