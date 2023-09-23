
<?php 
include('includes/config.php');

if(isset($_POST['registration']))
{

  $firstname = $_POST['inputFirstName'];
  $lastname = $_POST['inputLastName'];
  $email = $_POST['inputEmail'];
  $password =md5($_POST['inputPassword']);

  $sql = "INSERT INTO admin(firstname,lastname,email,password) VALUES (:firstname,:lastname,:email,:password)";
  $query = $dbh->prepare($sql);

  $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
  $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':password',$password,PDO::PARAM_STR);

  $query->execute();
  $lastInsertId = $dbh->lastInsertId();
  if($lastInsertId)
  {
    echo "<script>alert('Registration successfull. Now you can login');</script>";
  }
else 
{
    echo "<script>alert('Something went wrong. Please try again');</script>";
}


}

?>

<script>
    
    
</script>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MinMax</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Signup</h3></div>
                                    <div class="card-body">
                                        <form method="POST" name="registration">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" name=" inputFirstName" type="text" placeholder="Enter your first name" required />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" required  />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">

                                                <input class="form-control" id="inputEmail" name="inputEmail" type="email" placeholder="name@example.com" required  />
                                                <label for="inputEmail">Email address</label>
                                               
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" name="inputPassword" type="password" placeholder="Create a password" required />
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="inputPasswordConfirm" placeholder="Confirm password" required  />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                           

                                                    <div class="form-group">
                                                        <input type="submit" value="Create Acount" name="registration" id="registration" class="btn btn-primary">
                                                  </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="index.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
