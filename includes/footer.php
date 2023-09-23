
<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT SubscriberEmail FROM tblsubscribers WHERE SubscriberEmail=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('Already Subscribed.');</script>";
}
else{
$sql="INSERT INTO  tblsubscribers(SubscriberEmail) VALUES(:subscriberemail)";
$query = $dbh->prepare($sql);
$query->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Subscribed successfully.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
?>
<footer>
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-md-6">
          <h6>About Us</h6>
          <ul>

            <li> <a href="https://www.facebook.com/Industrialraks/"><i class="fa fa-facebook"></i> Facebook</a></li> 
            <li> <a href="#"><i class="fa fa-twitter"></i> Twitter </a></li>
            <li> <a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
            <li> <a href="https://www.linkedin.com/in/
minmax-rack"><i class="fa fa-linkedin"></i>Linkedin</a></li>

          </ul>
        </div>
        <div class="col-md-3 col-sm-6">
          <h6>Subscribe Mail</h6>
          <div class="newsletter-form">
            <form method="post">
              <div class="form-group">
                <input type="email" name="subscriberemail" class="form-control newsletter-input" required placeholder="Enter Email Address" />
              </div>
              <button type="submit" name="emailsubscibe" class="btn btn-block">Subscribe <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
            <p class="subscribed-text">*We send great deals and latest our subscribed users very week.</p>
          </div>
        </div>
  
     
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
          <p class="copy-right " style="text-align: center;">Copyright &copy; 2023 MinMax Furniture </p>
          <p class="copy-right " style="text-align: center;"> Develop By Juel Hossain </p>
      
     

      </div>

    </div>
  </div>
</footer>