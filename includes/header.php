<?php
error_reporting(0);

 ?>
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
       <div class="col-sm-3 col-md-2 " style="margin-top:0px;">
          <div class="logo"> <a href="index.php"><img style="height:70px; width: 150px;" src="assets/images/logo.png" alt="image"/></a> </div>
        </div>
        <div class="col-sm-9 col-md-10">
          <div class="header_info">  

   <?php if(strlen($_SESSION['login'])==0)
  { 
?>

 <div class="login_btn" style="margin-top:25px"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login / Sign Up</a> </div>
  <?php }
else{ 

echo "Welcome To Users";
 } ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <nav id="navigation_bar" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
  {

   echo htmlentities($result->FullName); }}?>
   <i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="#">My Order</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <?php } ?>
          </ul>
            </li>
          </ul>


        </div>
        
        

        <div class="user_login">

       
          <ul>
            <li > <a href="cart.php" >Cart<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> </a>

                 <?php 
          $id =$_SESSION['uid'];
          $total =0;
          $cart = "SELECT *FROM cart WHERE uid=:id";
          $que=$dbh->prepare($cart);
          $que->bindParam(':id',$id,PDO::PARAM_STR);
          $que->execute();
          $rescart = $que->fetchAll(PDO::FETCH_OBJ);
          if($que->rowCount() > 0 ){
                      
          foreach ($rescart as $res) {
                    
                           $total++;

               }} ?>
        
            <span style="color:white"> <?php echo $total; ?> </span>
              
            </li>
          </ul>

        </div>


          <div class="header_search">
          <div id="search_toggle"><i class="fa fa-search" aria-hidden="true"></i></div>
          <form action="search.php" method="POST" id="header-search-form">
            <input type="text" placeholder="Product/Price/Code..." name="searchdata"  id="searchdata"  class="form-control" autocomplete="off" required="true">
            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
          </form>
        </div>
         <div class="liv_search"  id="search_result"></div>
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          	 
          <li><a href="#">About Us</a></li>

          <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products
          </a>
           <ul class="dropdown-menu">
             <li><a href="products.php">Our Products</a></li>
          </ul>
        </li>
          <li><a href="./#contact">Contact Us</a></li>
          
        </ul>
      </div>
    </div>
  </nav>
 
  
</header>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script type="text/javascript">
        $(document).ready(function () {
            $("#searchdata").keyup(function () {
                var query = $(this).val();
                console.log(query);
                if (query != "") {
                    $.ajax({
                        url: 'ajax-live-search.php',
                        method: 'POST',
                        data: {
                            query: query
                        },
                        success: function (data) {
                            
                            $('#search_result').html(data);
                            $('#search_result').css('display', 'block');
                         
                            $("#searchdata").focusin(function () {
                                $('#search_result').css('display', 'block');
                            });
                        }
                    });
                } else {
                    $('#search_result').css('display', 'none');
                }
            });
        });
    </script>