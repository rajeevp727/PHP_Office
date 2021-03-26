<?php
 if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
 include "DB_Connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User HomePage</title>
    <style>
    body {
    background: #f8f9fa; 
    }
    #fixedButton{
      position: fixed;
      bottom: 10px;
      width:100%;
    }
    </style>
</head>
<body>
<input type="submit" value="Logout" name="btnLogout" id="fixedButton">
<?php
if(isset($_POST['btnLogout'])){
  session_unset();
  session_destroy();
  header("location: Login.php");
}
?>
<h1><marquee direction="left">User <?php echo $_SESSION['user']; ?> Homepage</marquee></h1>
  <div class="container">
    <div class="row">
      <div name="categories" style="float:left; width:50%;">
        <h1>Categories</h1>
          <table border=1px style="border-collapsed:collapsed;">
            <tr>
              <th>ID</th>
              <th>Category Name</th>
              <th>Category Description</th>
              <th>Actions</th>
            </tr>

            <?php
            $countCategRows=0;
            $stmnt_categ = $conn->prepare("SELECT * FROM categories order by id ASC");
            $stmnt_categ->execute();

            while($rows=$stmnt_categ->fetch(PDO::FETCH_ASSOC)){
              $countCategRows = count($rows);
              if($countCategRows>=1){
                echo "<tr></tr>".
                     "<td>".$rows['id']."</td>".
                     "<td>".$rows['categName']."</td>".
                     "<td>".$rows['categDesc']."</td>".
                     "<td>".
                     "<a href=categAdd.php?id=$rows[id] style=background-color:green>Add |</a>".
                     "<a href=categEdit.php?id=$rows[id] style=background-color:cyan>Edit</a>".
                     "<a href=categDelete.php?id=$rows[id] style=background-color:red>Delete |</a>"."</td>";
            }
          }if($countCategRows==0){
              echo "<tr>"."<td></td>"."<td></td>"."<td></td>".
                    "<td>".
                    "<a href=categAdd.php style=background-color:green>Add |</a>".
                    "<a href=categEdit.php style=background-color:cyan>Edit |</a>".
                    "<a href=categDelete.php style=background-color:red>Delete</a>".
                    "</td>";
          }
            ?>
          </table>  
      </div>
      <div name="products" style="float:right; width:50%">
          <h1 >Products</h1>
            <table border=1px style="border-collapsed:collapsed;">
              <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Price</th>
                <th>Actions</th>
              </tr>
              <?php
              $countProdRows = 0;
              $stmnt_prod = $conn->prepare("SELECT * FROM products order by id ASC");
              $stmnt_prod->execute();
              while($rows=$stmnt_prod->fetch(PDO::FETCH_ASSOC)){
                $countProdRows = count($rows);
                if($countProdRows >= 1){
                echo "<tr></tr>".
                     "<td>".$rows['id']."</td>".
                     "<td>".$rows['prodName']."</td>".
                     "<td>".$rows['prodDesc']."</td>".
                     "<td>".$rows['prodPrice']."</td>".
                     "<td>".
                     "<a class=add href=prodAdd.php?id=$rows[id] style=background-color:green>Add |</a>".
                     "<a class=add href=prodEdit.php?id=$rows[id] style=background-color:cyan>Edit</a>".
                     "<a class=add href=prodDelete.php?id=$rows[id] style=background-color:red>Delete |</a>"."</td>";
              }
            }if($countProdRows == 0){
              echo "<tr>"."<td></td>"."<td></td>"."<td></td>"."<td></td>".
              "<td>".
              "<a href=prodAdd.php style=background-color:green>Add |</a>".
              "<a href=prodEdit.php style=background-color:cyan>Edit |</a>".
              "<a href=prodDelete.php style=background-color:red>Delete</a>".
              "</td>";
            }
              ?>
            </table>
            </div>       
    </div>       
            </div>       
    </div>       
  </div>  
</body>
</html>