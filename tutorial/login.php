<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: welcome.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM user WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location:index.php");
                            
                        }
                    }

                }

    }
}    


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Shopee</title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Owl-carousel CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!-- font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />

    <!-- Custom CSS file -->
    <link rel="stylesheet" href="style.css">

    <?php
    // require functions.php file
    require ('functions.php');
    ?>

    <style>
#form{
  background-image: url("copy.png");
  background-color: #cccccc;
  height: 350px;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
      </style>

</head>
<body>

<!-- start #header -->
<header id="header">
    <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
        <p class="font-rale font-size-12 text-black-50 m-0">WELCOME TO EXPRESS BAZAR</p>
        <div class="font-rale font-size-14">
       

           
            
        </div>
    </div>

    <!-- Primary Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
        <a class="navbar-brand" href="#">EXP₹ESS BAZAR</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav m-auto font-rubik">
                <li class="nav-item active">
                    <a class="nav-link" href="#">On Sale</a>
                </li>
                

                
        <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Products
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">shoes</a></li>
                    <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">Mens & Women Wear</a></li>
                    <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">Beauty Products</a></li>
                  </ul>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="#">Blog</a>
                </li>
                <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">Action</a></li>
            <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">Another action</a></li>
            <li><a class="dropdown-item" href="#" onclick="return confirm('Please Login First .!')">Something else here</a></li>
          </ul>
        </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Coming Soon</a>
                </li>
            </ul>
            <form action="#" class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                   
                </a>
            </form>
        </div>
    </nav>
    <!-- !Primary Navigation -->

</header>



<div class="container mt-10">
<h3>LOGIN PAGE</h3>
<hr>
<form class="row g-3" id="form"action="" method="post">
  
  <div class="col-md-10">
    <label for="inputPassword4" class="form-label">User Name</label>
    <input type="text" name="username"class="form-control" id="inputlname">
  </div>
  <div class="col-10">
    <label for="inputAddress" class="form-label">Email</label>
    <input type="text" name="email"class="form-control" id="inputemail" placeholder="Example@gmail.com">
  </div>
  <div class="col-md-10">
    <label for="inputEmail4" class="form-label">Password</label><br>
    <input type="password" name="password"class="form-control" id="inputFname">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Login</button>
  </div>
  </div>
</form>
</main>
<!-- !start #main-site -->

<!-- start #footer -->
<footer id="footer" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12">
                <h4 class="font-rubik font-size-20">EXP₹ESS BAZAR</h4>
                <p class="font-size-14 font-rale text-white-50">If your business is still local then host with us at world level. To grow your business then Enter your mail and subscribe.</p>
            </div>
            <div class="col-lg-4 col-12">
                <h4 class="font-rubik font-size-20">Subscribe Here</h4>
                <form class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Email *">
                    </div>
                    <div class="col">
                        <button onclick="return confirm('Please Login First .!')" class="btn btn-primary mb-2">Subscribe</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-2 col-12 row-5">
                <h4 class="font-rubik font-size-20">Information</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Delivery Information</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Terms & Conditions</a>
                </div>
            </div>
            <div class="col-lg-2 col-20">
                <h4 class="font-rubik font-size-20">Account</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Order History</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Wish List</a>
                    <a href="#" class="font-rale font-size-14 text-white-50 pb-1">Newslatters</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright text-center bg-dark text-white py-2">
    <p class="font-rale font-size-14">&copy; Copyrights 2022. Desing By <a href="#" class="color-second">SVS</a></p>
</div>
<!-- !start #footer -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<!-- Owl Carousel Js file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

<!--  isotope plugin cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js" integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

<!-- Custom Javascript -->
<script src="index.js"></script>
</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">

var el_up = document.getElementById("GFG_UP");
              
              el_up.innerHTML = 
                  "Click on the LINK for further confirmation."; 
function myFunction() {
  alert("I am an alert box!");
}
    </script>
  </body>
</html>

