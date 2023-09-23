
<?php 
include('includes/config.php');
session_start();
if(strlen($_SESSION['alogin']) == 0){

    header('location:index.php');
}
else
{
 
 if(isset($_GET['del'])){
  $id= $_GET['del'];

  $sql = "delete from tblproducts WHERE id = :id ";
  $query = $dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();

  echo "<script>alert('Delete Data Successfully')</script>";

 }



?>

<?php include('includes/header.php');?>
<?php include('includes/sidenav.php');?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                         <h1 class="mt-4">Manage Products</h1>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="card ">
                                        <div class="card-header">Basic Info</div>

                                        <div class="card-body">
                                            <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Product Name</th>
                                            <th>Product Code</th>
                                            <th>Product Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php

                                           $sql = "SELECT *FROM tblproducts";
                                           $query = $dbh->prepare($sql);
                                           $query->execute();
                                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                                           $cnt = 1;
                                           if($query->rowCount() > 0){
                                            foreach($results as $result){
                                         ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($result->producttitle); ?></td>
                                            <td><?php echo htmlentities($result->productcode); ?></td>
                                            <td><?php echo htmlentities($result->productprice); ?></td>
                                            <td><a href="edit-products.php?id=<?php echo $result->id;?>"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                <a href="manageproducts.php?del=<?php echo $result->id; ?>" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>         
                                        </tr>
                                        <?php $cnt =$cnt+1; }} ?>
                                    </tbody>
                                </table>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                
                     
                    </div>
                </main>
    <?php include('includes/footer.php');}?>  

 <script src="js/datatables-simple-demo.js"></script>



                    

