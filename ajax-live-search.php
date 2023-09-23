
<?php 

include('includes/config.php');

if(isset($_POST['query'])){
 $o =$_POST['query'];
 
 $prefix ="%$o%";
 
  $sql = "SELECT * FROM tblproducts WHERE producttitle LIKE :prefix OR productprice LIKE :prefix OR productcode LIKE :prefix LIMIT 5";

  $query = $dbh->prepare($sql);
  $query->bindParam(':prefix',$prefix,PDO::PARAM_STR);
  $query->execute();
  $res = $query->fetchAll(PDO::FETCH_OBJ);
  $fil=$query->rowCount();
	

  if ($query->rowCount() > 0) {
    ?>
<div style="width:228px;" class='alert alert-info  text-left' role='alert' >
    <?php
     foreach($res as $result) {
              
            //  echo "<img src='admin/img/productimages/$result->pimage1' height=30px; width=50px;>";
          echo "<a style='color:black;' href='live_search.php?search=$result->producttitle'>$result->producttitle <br/></a>";
       
      }
      ?>
</div>   
      <?php
    } else {
      echo "
      <div class='alert alert-danger mt-5 text-center' role='alert'>
          Product not found
      </div>
      ";
    }
}


?>