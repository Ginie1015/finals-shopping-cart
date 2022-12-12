<?php require_once('header.php') ?>
<?php
    $_SESSION['CURR_PAGE'] = 'products';
    require_once("function.php");
?>
<?php
  if(isset($_REQUEST['btnAdd'])) {
    $con = openConnection();

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
                  INSERT INTO tbl_products (name, description, price, photo1, photo2) 
                  VALUES ('$name', '$description', '$price', '$photo1', '$photo2')
                ";  
        
        if(mysqli_query($con, $strSql)){
          echo '
                    <div class="alert alert-success alert-dismissible fade show col-4 offset-4 mt-5" role="alert">
                        <strong>Successfully Added a Product!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                ';
        }
        else
          echo 'ERROR: Failed to insert Record!';
    }
    closeConnection($con);
  }

?>
<div class="container-fluid">
  <div class="row">
     <?php require_once('nav.php') ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Products</h1>
      </div>
      <form method="post">
        <div class="form-group row">
          <label for="txtProdName" class="col-sm-2 col-form-label text-right">Product Name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="txtProdName" id="txtProdName" required autofocus>
          </div>
        </div>
        <div class="form-group row">
          <label for="txtDescription" class="col-sm-2 col-form-label text-right">Description</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="txtDescription" id="txtDescription" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="txtPrice" class="col-sm-2 col-form-label text-right">Price</label>
          <div class="col-sm-2">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text">₱</span>
              </div>
              <input type="number" class="form-control" name="txtPrice" id="txtPrice" aria-label="Amount (to the nearest dollar)">
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="photo1" class="col-sm-2 col-form-label text-right">Photo1</label>
          <div class="col-sm-2">
            <input type="file" name="photo1" id="photo1" required>
          </div>
        </div>
        <div class="form-group row">
          <label for="photo2" class="col-sm-2 col-form-label text-right">Photo2</label>
          <div class="col-sm-9">
            <input type="file" name="photo2" id="photo2" required>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" name="btnAdd" id="btnAdd" class="btn btn-primary">Add Product</button>
          </div>
        </div>
      </form>
      <hr><br>
      <h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-striped table-dark">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
              <th>Photo1</th>
              <th>Photo2</th>
              <th>Option</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $con = openConnection();
              $strSql = "SELECT * FROM tbl_products";
              $rec = getRecord($con, $strSql);
              
              if (!empty($rec)) {
                foreach($rec as $key => $value){
                  echo '<tr>';
                          echo '<td>'. $value['name'] .'</td>';
                          echo '<td>'. $value['description'] .'</td>';
                          echo '<td>'. $value['price'] .'</td>';
                          echo '<td>'. $value['photo1'] .'</td>';
                          echo '<td>'. $value['photo2'] .'</td>';
                          echo '<td>';
                              echo '<a href="edit-product.php?k=' . $value['id'] . '" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</a>';
                              echo '<a href="remove-product.php?k=' . $value['id'] . '" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Edit</a>';
                          echo '</td>';
                  echo '</tr>';
                }
              }
            ?>
            
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php require_once('footer.php') ?>