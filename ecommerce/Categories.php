<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
 include "DB_Connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link rel="stylesheet" href="Login.css"> -->
    <title>Categories</title>
</head>
<body>

<h1><marquee direction="right">Categories Page</marquee></h1>

    <form action="" method="post">
            <table border="1px">
                <th>ID</th>
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Actions</th>

            <?php
            $stmnt_categ = $conn->prepare("SELECT * FROM categories order by id ASC");
            $stmnt_categ->execute();

            while($rows=$stmnt_categ->fetch(PDO::FETCH_ASSOC)){
                echo "<tr></tr>".
                     "<td>".$rows['id']."</td>".
                     "<td>".$rows['categName']."</td>".
                     "<td>".$rows['categDesc']."</td>".
                     "<td>"."<a class=add href=categAdd.php?id=$rows[id] style=background-color:green>Add |</a> <br>".
                     "<a class=add href=categEdit.php?id=$rows[id] style=background-color:cyan>Edit</a> <br>".
                     "<a class=add href=categDelete.php?id=$rows[id] style=background-color:red>Delete |</a> <br>"."</td>";
            }
            ?>
            </table>
    </form>
</body>
</html>