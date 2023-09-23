
<?php 
session_start();
include('includes/config.php');


$error = '';
$name = '';
$email = '';
$phone = '';
$message = '';

function clean_text($string)
{
  $string = trim($string);
  $string = stripslashes($string);
  $string = htmlspecialchars($string);
  return $string;
}

if(isset($_POST["submit"]))
{
  if(empty($_POST["name"]))
  {
    $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
  }
  else
  {
    $name = clean_text($_POST["name"]);
    if(!preg_match("/^[a-zA-Z0-9]*$/",$name))
    {
      // $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
      $error.=' <script> alert("Only letters and white space allowed")</script>';
    }
  }
  if(empty($_POST["email"]))
  {
    $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
  }
  else
  {
    $email = clean_text($_POST["email"]);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
      $error .= '<p><label class="text-danger">Invalid email format</label></p>';
    }
  }
  if(empty($_POST["phone"]))
  {
    $error .= '<p><label class="text-danger">Subject is required</label></p>';
  }
  else
  {
    $subject = clean_text($_POST["phone"]);
  }
  if(empty($_POST["message"]))
  {
    $error .= '<p><label class="text-danger">Message is required</label></p>';
  }
  else
  {
    $message = clean_text($_POST["message"]);
  }
  if($error == '')
  {
        require "PHPMailer/PHPMailerAutoload.php";

        $mail = new PHPMailer();
    $mail->IsSMTP(); 
    $mail->SMTPDebug  = 0;                     
    $mail->SMTPAuth   = true;                  
    $mail->SMTPSecure = "ssl";                 
    $mail->Host       = "mail.minmaxbd.net";      
    $mail->Username='it@minmaxbd.net';  
    $mail->Password='mission@it#@#';     
      $mail->Port       = 465;  
      
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->From=$_POST["email"];
    $mail->setFrom($_POST["email"],$_POST["name"]);
    $mail->Sender=$_POST["email"];
    $mail->AddReplyTo($_POST["email"],$_POST["name"]);
    $mail->Subject = $_POST["phone"];       //Sets the Subject of the message
    $mail->Body = $_POST["message"]; 
     $mail->AddAddress('it@minmaxbd.net'); 
      
    if($mail->Send())              
    {
      $error=' <script> alert("You Successfully Placed an Order")</script>';
    }
    else
    {
      $error = '<script> alert("There is an error")</script>';
     
    }
    $mail->smtpClose();
    $name = '';
    $email = '';
    $phone = '';
    $message = '';
  }
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
                       <h2>Our Products</h2>

                   </div>
               </div>
        </div>
    </div>
 </div>

 <?php
    $id = intval($_GET['id']);
    $sql = "SELECT *FROM tblproducts WHERE id=:id";
    $query = $dbh->prepare($sql);

    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->execute();
    $results= $query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
      foreach($results as $result)
      {


    

  ?>

 <section class="listing-detail">
  <div class="container">  
    <div class="listing_detail_head row">
      <div class="col-md-9 ">
        <h2><?php echo htmlentities($result->producttitle); ?></h2>
        <p>Price : &#x09F3; <?php echo htmlentities($result->productprice); ?></p>
           <div style="width: 50px;" data-toggle="modal" data-target="#exampleModal">
            <a class="btn btn-primary" style="color: white;" class="add-bt" href="#">+ Want To buy</a> 
          </div>

      </div>

    </div>
    <div class="row">

      <div class="col-md-7">
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#productdetails " aria-controls="productdetails" role="tab" data-toggle="tab">Description </a></li>

              <li role="presentation"><a href="#item" aria-controls="item" role="tab" data-toggle="tab">Item</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 
              <!-- overview -->
              <div role="tabpanel" class="tab-pane active" id="productdetails">

                <p><?php echo htmlentities($result->productdetails); ?></p>
              </div>
              
              
              <!-- Item-->
              <div role="tabpanel" class="tab-pane" id="item"> 

                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Item</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Color</td>
                      <td>Brown</td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
          </div>

          
        </div>
      </div>

      <div class="col-md-5">
       <img src="admin/img/productimages/<?php echo htmlentities($result->pimage1); ?>"class="img-responsive" alt="image">
        
      </div>

    </div>



</section>
<?php   }} ?>


   



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request a Quote</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST">
        <span> <?php echo $error;?></span>
          <div class="form-group">
            <label for="name" class="col-form-label">Product Name:</label>
             <input class="form-control"  type="text" name="name" required>
               
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
               <input class="form-control" placeholder="Your email" type="text" name="email" required>

          </div>
              <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
               <input class="form-control"  type="text" name="phone" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Details</label>
            <textarea class="form-control" id="message-text" name="message"></textarea>
          </div>
          <div align="center" class="form-group">
       
          <input type="submit" class="btn btn-dark" style="border-radius: 20px;" name="submit" value="Order Confirm ">
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