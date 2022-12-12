<?php 
    require_once('header.php');
    require_once("function.php");
    if(isset($_GET['k'])){
        $_SESSION['k'] = $_GET['k'];
    }
?>
<?php
    $con = openConnection(); 
    $strSql = "SELECT * FROM tbl_products WHERE id = " . $_SESSION['k'];
    $recProduct = getRecord($con, $strSql);

    if($rs = mysqli_query($con, $strSql)) {
        if(mysqli_num_rows($rs) > 0 ){
            $rec = mysqli_fetch_array($rs);    
            mysqli_free_result($rs);
        }
            
         else{
                echo '<tr>';
                    echo '<td colspan="4" align="center">No Record Found!</td>';
                echo '</tr>';
        }
    }

    if(isset($_REQUEST['btnRemove'])) {
            $strSql = "DELETE FROM tbl_products WHERE id = " . $_SESSION['k'];
            if(mysqli_query($con, $strSql))
                header("location: products.php");
            else
                echo 'Error: Failed to Delete Record!';          
        closeConnection($con);         
    }
?>
<div class="container-fluid">
  <div class="row">
     <?php require_once('nav.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Remove Product</h1>
      </div>
        <form method="POST">
            <h3>Are you Sure you want to Remove this Product?</h3>
            <br><br>
            <ul>
                <?php
                    if(isset($rec)){
                        echo '<h4><li>Product: ' . $rec['name'] . '</h4></li>';
                        echo '<h4><li>Description: ' . $rec['description'] . '</h4></li>';
                        echo '<h4><li>Price: ' . $rec['price'] . '</h4></li>';
                        echo '<h4><li>Photo1: ' . $rec['photo1'] . '</h4></li>';
                        echo '<h4><li>Photo2: ' . $rec['photo2'] . '</h4></li>';
                    }
                ?>
            </ul>
            <div class="form-group row">
                <div class=" col-sm-10">
                    <a href="products.php" class="btn btn-primary"> Cancel </a>
                    <button type="submit" name="btnRemove" class="btn btn-danger">Remove</button>
                </div>
            </div>
        </form>           
    </main>
  </div>
</div>

<?php require_once('footer.php') ?>