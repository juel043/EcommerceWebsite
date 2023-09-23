
<?php 
include('includes/config.php');
session_start();
if(strlen($_SESSION['alogin']) == 0){

    header('location:index.php');
}
else
{
 if(isset($_POST['submit'])){

  $catname = $_POST['catname'];
  $producttitle = $_POST['producttitle'];
  $productcode = $_POST['productcode'];
  $productprice = $_POST['productprice'];
  $productdetails = $_POST['productdetails'];
  $pimage1=$_FILES["img1"]["name"];
  $pimage2=$_FILES["img2"]["name"];

move_uploaded_file($_FILES["img1"]["tmp_name"],"img/productimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/productimages/".$_FILES["img2"]["name"]);

$sql = "INSERT INTO tblproducts (catname,producttitle,productcode,productdetails,productprice,pimage1,pimage2) VALUES (:catname,:producttitle,:productcode,:productdetails,:productprice,:pimage1,:pimage2)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':catname',$catname,PDO::PARAM_STR);
    $query->bindParam(':producttitle',$producttitle,PDO::PARAM_STR);
    $query->bindParam(':productcode',$productcode,PDO::PARAM_STR);
    $query->bindParam(':productdetails',$productdetails,PDO::PARAM_STR);
    $query->bindParam(':productprice',$productprice,PDO::PARAM_STR);
    $query->bindParam(':pimage1',$pimage1,PDO::PARAM_STR);
    $query->bindParam(':pimage2',$pimage2,PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    echo "<script>alert('Post Successfully')</script>";

    }
    else 
    {
      echo "<script>alert('Something went wrong')</script>";
    }

 }

?>

<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Product Add</h1>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-header">Basic Info</div>

                                        <div class="card-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label">Product Title<span style="color:red">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="producttitle" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 form-group"> 
                                                        <label class="control-label">Product Code<span style="color:red">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="productcode" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6 form-group">
                                                    <label class="control-label">Product Price In(BDT)<span style="color:red">*</span></label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="productprice" class="form-control" required>
                                                    </div>

                                                </div>
                                                 <div class="col-sm-6 form-group">
                                                    <label class="control-label">Catagory<span style="color:red">*</span></label>
                                                    <div class="col-sm-12">
                                                      <select class="selectpicker" name="catname" required>
                                                        <option value=""> Select </option>
                                                        <?php 
                                                        $ret="select id,productcat from tblcatagory";
                                                        $query= $dbh -> prepare($ret);
                                                        $query-> execute();
                                                        $results = $query -> fetchAll(PDO::FETCH_OBJ);
                                                        if($query -> rowCount() > 0)
                                                        {
                                                            foreach($results as $result)
                                                            {
                                                                ?>
                                                                <option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->productcat);?></option>
                                                            <?php }} ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Details<span style="color:red">*</span></label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="productdetails" rows="3" required></textarea>
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <h4><b>Upload Images</b></h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-4">
                                                    Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
                                                </div>
                                                <div class="col-sm-4">
                                                    Image 2<span style="color:red">*</span><input type="file" name="img2" required>
                                                </div>

                                            </div>

                                            <div align="center" class="form-group mt-2 ">
                                                <div class="col-sm-8 col-sm-offset-3  ">
                                                    <button class="btn btn-dark" type="reset">Cancel</button>
                                                    <button class="btn btn-primary" name="submit" type="submit">Save changes</button>
                                                </div>
                                            </div>

                                        </form>                                   
                                    </div>
                                </div>
                            </div>
                
                     
                    </div>
                </main>
            <?php include('includes/footer.php');}?>   



                    

