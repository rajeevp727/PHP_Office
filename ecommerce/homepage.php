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
      cursor: pointer;
      bottom: 10px;
      width:100%;
    }
    body {
	background: #63738a;
	font-family: 'Roboto', sans-serif;
}
    </style>
</head>
<body>
<form action="" method="post">
<input type="submit" value="Logout" name="btnLogout" id="fixedButton" style="background-color:#66ff99; height: 5%; font-size:25px">
<?php
if(isset($_POST['btnLogout'])){
  session_unset();
  session_destroy();
  header("location: Logout.php");
}
?>
<h1> Welcome User- "<?php
if(isset($_SESSION['user'])){ echo $_SESSION['user'];}
else { echo "<i>Invalid session</i>, try <a href= Login.php>logging in</a> again";  }
?>" to your Homepage</h1>
  <div class="container">
    <div class="row">
      <div name="categories" style="float:left; width:50%;">
        <h1>Categories</h1>
        <pre>* Only Admin can Add new Categories</pre>
        <?php   if($_SESSION['user'] == "admin"){   echo "<a class=add href=prodAdd.php style=background-color:green>Add</a>";  }
                else{ echo "<script>alert('Please reqeust your ADMIN to create a new Category');</script>"; }
        ?>
          <table border=1px style="border-collapsed:collapsed; width:99%">
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
                     "<a href=categEdit.php?id=$rows[id] style=background-color:cyan>Edit</a>".
                     "<a href=categDelete.php?id=$rows[id] style=background-color:red>Delete |</a>"."</td>";
            }
          }
            ?>
          </table>  
      </div>
      <div name="products" style="float:right; width:50%">
          <h1 >Products</h1>
        <pre>* Only Admin can Add new Products</pre>
        <?php  if($_SESSION['user'] == "admin"){      echo "<a class=add href=prodAdd.php style=background-color:green>Add</a>";     }
              else{ echo "<script>alert('Please reqeust your ADMIN to create a new Product');</script>"; }
        ?>
            <table border=1px style="border-collapsed:collapsed; width:99%">
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
                     "<a class=add href=prodEdit.php?id=$rows[id] style=background-color:cyan>Edit</a>".
                     "<a class=add href=prodDelete.php?id=$rows[id] style=background-color:red>Delete |</a>"."</td>";
              }
            }
              ?>
            </table>
            </div>       
    </div>       
            </div>       
    </div>       
  </div>  
  </form>
</body>
</html>