
<?php 
include('includes/config.php');
session_start();
if(strlen($_SESSION['alogin']) == 0){

    header('location:index.php');
}
else
{
 if(isset($_POST['submit'])){

  $productcat = $_POST['productcat'];


$sql = "INSERT INTO tblcatagory (productcat) VALUES (:productcat)";

    $query = $dbh->prepare($sql);
    $query->bindParam(':productcat',$productcat,PDO::PARAM_STR);
    $query->execute();

    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
    echo "<script>alert('Catagory Add Successfully')</script>";

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
                        <h1 class="mt-4">Catagory add</h1>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-header">Basic Info</div>

                                        <div class="card-body">
                                            <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-6 form-group">
                                                        <label class="control-label">Product Catagory<span style="color:red">*</span></label>
                                                        <div class="col-sm-12">
                                                            <input type="text" name="productcat" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    

                                            <div  class="form-group mt-2 ">
                                                <div class="col-sm-8 col-sm-offset-3  ">
                                                    
                                                    <button class="btn btn-primary" name="submit" type="submit">Add</button>
                                                </div>
                                            </div>

                                        </form>                                   
                                    </div>
                                </div>
                            </div>
                
                     
                    </div>
                </main>
            <?php include('includes/footer.php');}?>   



                    

