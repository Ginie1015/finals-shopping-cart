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
    if(isset($_REQUEST['btnEdit'])){
        $name = CleanInput($con, $_REQUEST['txtProdName']);
        $description = CleanInput($con, $_REQUEST['txtDescription']);
        $price = CleanInput($con, $_REQUEST['txtPrice']);
        $photo1 = CleanInput($con, $_REQUEST['photo1']);
        $photo2 = CleanInput($con, $_REQUEST['photo2']);
        $err = [];
        if(empty($name))
            $err[] = "Product Name is required!";
        if(empty($description))
            $err[] = "Product Description is required!";
        if(empty($price))
            $err[] = "Product Price is required!";

        if(empty($err)){
            $strSql = "
                    UPDATE tbl_products SET
                    name = '$name',
                    description = '$description',
                    price = '$price',
                    photo1 = '$photo1',
                    photo2 = '$photo2'
                    WHERE id = " . $_SESSION['k'];
            
            if(mysqli_query($con, $strSql)){
                header("location: products.php");
            }
            else
                echo 'ERROR: Failed to Update Record!';
        }
    }
    closeConnection($con);
?>
<div class="container-fluid">
  <div class="row">
     <?php require_once('nav.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Product</h1>
      </div>
      <form medthod="post">
      <div class="form-group row">
        <label for="txtProdName" class="col-sm-2 col-form-label text-right"><b>Product Name<span class="text-danger">*</span></b></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txtProdName" id="txtProdName" value="<?php echo $rec['name']; ?>" required autofocus>
        </div>
      </div>
      <div class="form-group row">
        <label for="txtDescription" class="col-sm-2 col-form-label text-right"><b>Description<span class="text-danger">*</span></b></label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="txtDescription" value="<?php echo $rec['description']; ?>" id="txtDescription" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="txtPrice" class="col-sm-2 col-form-label text-right"><b>Price<span class="text-danger">*</span></b></label>
        <div class="col-sm-2">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text">₱</span>
            </div>
            <input type="number" class="form-control" name="txtPrice" id="txtPrice" value="<?php echo $rec['price']; ?>" aria-label="Amount (to the nearest dollar)" required>
          </div>
        </div>
      </div>
      <div class="form-group row">
        <label for="photo1" class="col-sm-2 col-form-label text-right"><b>Photo 1<span class="text-danger">*</span></b></label>
        <div class="custom-file col-sm-9">
          <input type="file" id="photo1" name="photo1" accept="image/*" required>
        </div>
      </div>
      <div class="form-group row">
        <label for="photo2" class="col-sm-2 col-form-label text-right"><b>Photo 2<span class="text-danger">*</span></b></label>
        <div class="custom-file col-sm-9">
          <input type="file" id="photo2" name="photo2" accept="image/*" required>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-10">
          <button type="submit" name="btnEdit" id="btnEdit" class="btn btn-primary">Edit Product</button>
        </div>
      </div>
    </form><hr><br><br>
    
    </main>
  </div>
</div>

<?php require_once('footer.php') ?>