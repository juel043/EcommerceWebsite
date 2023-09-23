
<?php 
session_start();
include('includes/config.php');
error_reporting(0);



if(isset($_POST['order_btn']))
{
  $user_id = $_POST['user_id'];
  $address = $_POST['address'];
  $number = $_POST['number'];
  $mobnumber = $_POST['mobnumber'];
  $txid = $_POST['txid'];

  $sql = "SELECT * FROM cart where uid=:user_id";
  $query=$dbh->prepare($sql);
  $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
  $query->execute();
  $orders = $query->fetchAll(PDO::FETCH_OBJ);
  $totalprice = 0;
  $status = 'pending';
  if($query->rowCount()>0){
    foreach($orders as $order){
      $productitem[] =  'pid-'.$order->pid.'(q-'.$order->pqty .')'; 
      $productprice = $order->pprice * $order->pqty;
      $totalprice += $productprice;

       }} 

      $productall = implode(",",$productitem);
      $orderconfirm = "INSERT INTO orders (userid,address,phone,mobnumber,totalproduct,totalprice,txid,status) VALUES (:user_id,:address,:number,:mobnumber,:productall,:totalprice,:txid,:status)";
      $query = $dbh->prepare($orderconfirm);
      $query->bindParam(':user_id',$user_id,PDO::PARAM_STR);
      $query->bindParam(':address',$address,PDO::PARAM_STR);
      $query->bindParam(':number',$number,PDO::PARAM_STR);
      $query->bindParam(':mobnumber',$mobnumber,PDO::PARAM_STR);
      $query->bindParam(':productall',$productall,PDO::PARAM_STR);
      $query->bindParam(':totalprice',$totalprice,PDO::PARAM_STR);
      $query->bindParam(':txid',$txid,PDO::PARAM_STR);
      $query->bindParam(':status',$status,PDO::PARAM_STR);
      $query->execute();
      $lastInsertId = $dbh->lastInsertId();

      if($lastInsertId){
        echo "<script>alert('Order Successfull')</script>";
      }
      else
      {
        echo "<script>alert('Dont Successfull')</script>";
      }

   
  }




  $id=$_SESSION['uid'];
  $sql = "SELECT * FROM cart where uid=:id ";
  $query=$dbh->prepare($sql);
  $query->bindParam(':id',$id,PDO::PARAM_STR);
  $query->execute();
  $rows = $query->fetchAll(PDO::FETCH_OBJ);

  if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_qty = "UPDATE cart SET pqty =:update_value WHERE  id=:update_id";
    $query = $dbh->prepare($update_qty);

    $query->bindParam(':update_value',$update_value,PDO::PARAM_STR);
    $query->bindParam(':update_id',$update_id,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId=$dbh->lastInsertId();

    header('location:cart.php');

  };

  if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    $cart_del ="DELETE FROM cart WHERE id=:remove_id";
    $query = $dbh->prepare($cart_del);
    $query->bindParam(':remove_id',$remove_id,PDO::PARAM_STR);
    $query->execute();
    header('location:cart.php'); 
  }

  ?>
  <!DOCTYPE HTML>
  <html lang="en">
  <head>

    <title>MinMax Furniture</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
  </head>
  <body>


    <?php include('includes/header.php');?>


    <!-- -------- -->
    <div class="contactus">
     <div class="container-fluid">
      <div class="row">
       <div class="col-md-12 offset-md-2">
        <div class="title">
         <h2>CART</h2>

       </div>
     </div>
   </div>
 </div>
</div>

<div class="ourproduct" style="margin-top: 10px;">
 <div class="container ">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $total=0;
          $qty=0;
          $cnt=1;
          if ($query->rowCount() > 0) {
            // output data of each row
           foreach($rows as $row) {
            ?>
            <tr>
              <th scope="row"><?php echo htmlentities($cnt); ?></th>
              <td><?php echo $row->pname; ?></td>

              <td><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="update_quantity_id"  value="<?php echo  $row->id ?>" >
                <input type="number" name="update_quantity" min="1" max="10"  value="<?php echo $row->pqty; ?>" >
                <input type="submit" value="update" name="update_update_btn">
              </form></td> 
              <td><?php echo $row->pprice*$row->pqty  ;?></td>
              <?php $total=$total+$row->pprice*$row->pqty ;?>
              <?php $qty=$qty+$row->pqty ;?>


              <input type="hidden" name="status" value="pending">   
              <td><a href="cart.php?remove=<?php echo  $row->id; ?>">Delete</a></td>
            </tr>
            <?php 
            $cnt++;
          }?>
          <tr>
            <td colspan="2"> </td>
            <td ><?php   echo " Total Qty =" . $qty; ?> </td>
            <td ><?php  echo "Total Price =" . $total; ?> </td>
            <td colspan="2"> </td>
          </tr>

          <?php  

        } 
        else 
          echo "Cart 0 Product";
        ?>
        

      </tbody>
    </table>
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <h5>if Cash On delivary Then Put 0 in bkash & Txid Field</h5>
      <div class=" form-group">
        <input type="hidden" name="total" value="<?php echo $total ?>">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['uid']; ?>">
        <input type="text" class="form-control" placeholder="Address" name="address" required>
      </div>
      <div class=" form-group">
        <input type="number" class="form-control" placeholder="Phone Number" name="number" required>
      </div>
      <div class=" form-group">
        <input type="number" class="form-control" placeholder="Bkash/Nogod Number" name="mobnumber">
      </div>
      <div class=" form-group">
        <input type="text" class="form-control" placeholder="Txid" name="txid">
      </div>

      <div class="form-group">
        <input type="submit" value="Order Now" name="order_btn">
      </div>

    </form>

  </div>

</div>
</div>

</div>








<?php include('includes/footer.php');?>

<?php include('includes/login.php');?>

<?php include('includes/registration.php');?>

<?php include('includes/forgotpassword.php');?>



<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 

<script src="assets/js/bootstrap-slider.min.js"></script> 

<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>

</html>