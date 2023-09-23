
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
  $producttitle = $_POST['producttitle'];
  $productcode = $_POST['productcode'];
  $productprice = $_POST['productprice'];
  $productdetails = $_POST['productdetails'];
  $pimage1=$_FILES["img1"]["name"];
  $pimage2=$_FILES["img2"]["name"];
  $id  = intval($_GET['id']);

move_uploaded_file($_FILES["img1"]["tmp_name"],"img/productimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/productimages/".$_FILES["img2"]["name"]);

$sql= "update tblproducts set catname=:catname, producttitle =:producttitle,productcode =:productcode,productprice =:productprice,productdetails =:productdetails,pimage1=:pimage1,pimage2=:pimage2 where id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':catname',$catname,PDO::PARAM_STR);
    $query->bindParam(':producttitle',$producttitle,PDO::PARAM_STR);
    $query->bindParam(':productcode',$productcode,PDO::PARAM_STR);
    $query->bindParam(':productdetails',$productdetails,PDO::PARAM_STR);
    $query->bindParam(':productprice',$productprice,PDO::PARAM_STR);
    $query->bindParam(':pimage1',$pimage1,PDO::PARAM_STR);
    $query->bindParam(':pimage2',$pimage2,PDO::PARAM_STR);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();

    echo "<script>alert('Product Update Successfully')</script>";

 
  

 }

?>

<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Product Update</h1>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-header">Basic Info</div>

                                        <div class="card-body">

                                        <?php
                                        $id = intval($_GET['id']);

                                         $sql = "SELECT tblproducts.*,tblcatagory.productcat,tblcatagory.id as cid FROM tblproducts  JOIN tblcatagory on tblcatagory.id = tblproducts.catname WHERE tblproducts.id = :id ";
                                         $query = $dbh->prepare($sql);
                                         $query->bindParam(':id',$id,PDO::PARAM_STR);
                                         $query->execute();
                                         $results = $query->fetchAll(PDO::FETCH_OBJ);
                                         if($query->rowCount() > 0){
                                            foreach($results as $result)
                                            {
                                            
                                         ?>

                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label">Product Title<span style="color:red">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="producttitle" class="form-control" value="<?php echo htmlentities($result->producttitle);?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 form-group"> 
                                                        <label class="control-label">Product Code<span style="color:red">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="productcode" class="form-control" value="<?php echo htmlentities($result->productcode);?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                   <div class="col-sm-6 form-group">
                                                    <label class="control-label">Product Price In(BDT)<span style="color:red">*</span></label>
                                                    <div class="col-sm-12">
                                                        <input type="text" name="productprice" class="form-control" value="<?php echo htmlentities($result->productprice);?>" required>
                                                    </div>

                                                </div>

                                                 <div class="col-sm-6 form-group">
                                                    <label class="control-label">Catagory<span style="color:red">*</span></label>
                                                    <div class="col-sm-12">
                                                      <select class="selectpicker" name="catname" required>
                                                        <option value="<?php echo htmlentities($result->cid);?>"><?php echo htmlentities($catname=$result->productcat);?> </option>
                                                        <?php 
                                                        $ret="select id,productcat from tblcatagory";
                                                        $query= $dbh -> prepare($ret);
                                                        $query-> execute();
                                                        $res = $query -> fetchAll(PDO::FETCH_OBJ);
                                                        if($query -> rowCount() > 0)
                                                        {
                                                            foreach($res as $re)
                                                            {
                                                                if($re->productcat == $catname){
                                                                 continue;
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <option value="<?php echo htmlentities($re->id);?>"><?php echo htmlentities($re->productcat);?></option>
                                                            <?php }}} ?>

                                                        </select>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Product Details<span style="color:red">*</span></label>
                                                <div class="col-sm-6">
                                                    <textarea class="form-control" name="productdetails" rows="3" required><?php echo htmlentities($result->productdetails);?></textarea>
                                                </div>
                                            </div>

                                            <div class="hr-dashed"></div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <h4><b>Update Images</b></h4>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <img src="img/productimages/<?php echo htmlentities($result->pimage1) ?>" width="150" height="100" style="border:solid 1px #000"/>
                                                    Image 1 <span style="color:red">*</span><input type="file" name="img1"required>

                                                     <img src="img/productimages/<?php echo htmlentities($result->pimage2) ?>" width="150" height="100" style="border:solid 1px #000"/>
                                                    Image 2<span style="color:red">*</span><input type="file" name="img2" required>
                                                </div>
                                              

                                            </div>
                                              <?php  }} ?> 

                                            <div align="center" class="form-group mt-2 ">
                                                <div class="col-sm-8 col-sm-offset-3  ">
                                                  
                                                    <button class="btn btn-primary" name="submit" type="submit">Update</button>
                                                </div>
                                            </div>

                                        </form>      

                                                                  
                                    </div>
                                </div>
                            </div>
                
                     
                    </div>
                </main>
            <?php include('includes/footer.php');}?>   



                    

