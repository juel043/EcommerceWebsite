
<?php 
session_start();
include('includes/config.php');




$error = '';
$name = '';
$email = '';
$subject = '';
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
    if(!preg_match("/^[a-zA-Z ]*$/",$name))
    {
      $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
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
  if(empty($_POST["subject"]))
  {
    $error .= '<p><label class="text-danger">Subject is required</label></p>';
  }
  else
  {
    $subject = clean_text($_POST["subject"]);
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
    $mail->Subject = $_POST["subject"];       //Sets the Subject of the message
    $mail->Body = $_POST["message"]; 
     $mail->AddAddress('it@minmaxbd.net'); 
      
    if($mail->Send())              
    {
      $error = '<label class="text-success">Thank you for contacting us</label>';
    }
    else
    {
      $error = '<label class="text-danger">There is an Error</label>';
     
    }
    $mail->smtpClose();
    $name = '';
    $email = '';
    $subject = '';
    $message = '';
  }
}

if(isset($_POST['add_to_cart'])){



  if((strlen($_SESSION['login']))==0)
  { 
   echo "<script>alert('Please Login Your Account')</script>";
   
 }
 else
 {


   $uid = $_POST['uid'];
   $pid = $_POST['pid'];
   $pname= $_POST['pname'];
   $pprice = $_POST['pprice'];
   $pqty = 1;
   $currentpage=$_SERVER['REQUEST_URI'];


   $select_cart = "SELECT *FROM cart WHERE uid =:uid && pid =:pid";
   $query=$dbh->prepare($select_cart);
   $query->bindParam(':uid',$uid,PDO::PARAM_STR);
   $query->bindParam(':pid',$pid,PDO::PARAM_STR);
   $query->execute();

   if($query->rowCount() > 0)
   {
      echo "<script>alert('Product Already Add Successfully')</script>";
      echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";

   }
   else
   {

   $insert_cart = "INSERT INTO cart (uid,pid,pname,pprice,pqty) VALUES(:uid,:pid,:pname,:pprice,:pqty)";
    $query=$dbh->prepare($insert_cart);
    $query->bindParam(':uid',$uid,PDO::PARAM_STR);
    $query->bindParam(':pid',$pid,PDO::PARAM_STR);
    $query->bindParam(':pname',$pname,PDO::PARAM_STR);
    $query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
    $query->bindParam(':pqty',$pqty,PDO::PARAM_STR);

    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      echo "<script>alert('Product Add Successfully')</script>";
      echo "<script type='text/javascript'> document.location = '$currentpage'; </script>";

    } 

   }
 
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
         <section class="slider_section">
                <div class="banner_main">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mapimg">
                                <div class="text-bg">
                                    <h1>The latest <br> <strong class="black_bold">furniture Design</strong><br></h1>
                                
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                
                                <div class="text-img">
                                    <figure><img src="assets/images/DIning_Table.png"/></figure>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </section>
       <!-- Catagories -->

        <div class="trending">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 offset-md-2">
                            <div class="title">
                                <h2>Special<strong class="black"> Categories</strong></h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margitop">
                            <div class="trending-box">
                                <a href="products.php"><figure><img style="height:300px;width:400px;" src="assets/images/Dinig.jpg"/></figure></a>
                                <h3>Dining</h3>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="trending-box">
                              <a href="products.php"><figure><img style="height:300px;width:400px;" src="assets/images/sofaset.jpg" /></figure></a>
                                <h3>Living Room</h3>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 margitop">
                            <div class="trending-box">
                                <a href="products.php"><figure><img style="height:300px;width:400px;" src="assets/images/Cabinet2.jpg" /></figure></a>
                                <h3>Office Furniture</h3>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

   
            <section class="section-padding gray-bg">
              <div class="section-header text-center">

                <p>Best Price With Quality Product</p>
              </div>
              <div class="container-fluid">
                <div class="row">
                 <div class="recent-tab">
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#resentnewproduct" role="tab" data-toggle="tab">New Product</a></li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="resentnewproduct">

                    <?php 
                    $sql = "SELECT *FROM tblproducts limit 12";

                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      { 
                        ?>  

                        <div class="col-list-3 col-md-3">
                          <div class="recent-car-list">
                            <div class="car-info-box"> <a href="productdetails.php?id=<?php echo htmlentities($result->id);?>"><img src="admin/img/productimages/<?php echo htmlentities($result->pimage1);?>" class="img-responsive" alt="image"></a>
                            </div>
                            <div class="car-title-m">
                              <h6><a href="productdetails.php?id=<?php echo htmlentities($result->id);?>"> <?php echo htmlentities($result->producttitle);?></a></h6>
                              <span class="price">&#x09F3; <?php echo htmlentities($result->productprice);?></span> 
                            </div>
                            <div class="inventory_info_m">
                              <p><?php echo substr($result->productdetails,0,78);?></p>

                            </div>
                              <div  align="center"> <a style="color:white" class="btn " href="productdetails.php?id=<?php echo htmlentities($result->id);?>">See More</a> </div>

                          
                               
                          </div>
                        </div>
                      <?php }}?>

                    </div>
                  </div>


                </div>
              </div>
            </section> 

           <!--  Contact -->
            
                   <div class="contact" id="contact">
                <div class="container padddd">
                    <div class="row">
                        <div class="col-md-12 offset-md-2">
                            <div class="title">
                                <h2>Contact <strong class="black">Us</strong></h2>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 padddd">
                             <div class="map_section">
                     <div id="map">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3641.210327142249!2d90.35524277493586!3d24.12925067841384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755df1019aaf29f%3A0xffad5c4cb361a66e!2sMinMax%20Furniture!5e0!3m2!1sen!2sbd!4v1684835409530!5m2!1sen!2sbd" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                     </div>
                   </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 ">
                          <div class="contact_form gray-bg">
                            <span> <?php echo $error;?></span>
                            <form  method="POST">
                              <div class="form-group">
                                <label class="control-label">Full Name <span>*</span></label>
                                 <input class="form-control white_bg " placeholder="Name" type="text" name="name" value="<?php echo $name;  ?>"required >
                              </div>
                              <div class="form-group">
                                <label class="control-label">Email Address <span>*</span></label>
                                <input class="form-control white_bg" placeholder="Email" type="text" name="email" value=" "required >
                              </div>
                              <div class="form-group">
                                <label class="control-label">Subject <span>*</span></label>
                                <input class="form-control white_bg" placeholder="subject" type="text" name="subject" value="<?php echo $subject; ?>" required>
                              </div>
                              <div class="form-group">
                                <label class="control-label">Message <span>*</span></label>
                                <textarea class="form-control white_bg" type="text" name="message"rows="4" required></textarea>
                              </div>


                              <div class="form-group">
                                <input type="submit" class="btn btn-dark" style="border-radius: 20px;" name="submit" value="Send Message ">
                              </div>


                            </form>
                          </div>
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