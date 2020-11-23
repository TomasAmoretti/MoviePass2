<?php include_once('header.php'); 
include_once('nav-bar-guest.php');


if(!empty($message)){
  echo "<script> if(confirm('".$message."'));";
  echo"</script>";
}

?>


<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 rounded-0">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6 movie-black">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-movie-red mb-4">Welcome Back!</h1>
                  </div>

                  <form class="user"  action="<?php echo FRONT_ROOT."User/Login"?>" method="POST">

                    <div class="form-group">
                      <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <!--<div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>-->
                    </div>

                    <button class="btn btn-user btn-block btn-movie-static" type="submit" name="btn-login">
                      Login
                    </button>

                  </form>
                  <hr>
                  
                  <?php
                    require_once "FacebookConfig.php";
                    $url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
                    echo "<br><a class="."loginfb btn btn-primary "." href=" . htmlspecialchars($loginUrl) . "> <i class='fab fa-facebook-f fa-fw'></i>  LOGIN FACEBOOOK  </a>";
                  ?>
   
                  <hr>
                  <!--
                  <div class="text-center">
                    <a class="small" href="<?php //echo FRONT_ROOT."Home/ForgotPassword"?>">Forgot Password?</a>
                  </div>-->
                  <div class="text-center">
                    <a class="small" href="<?php echo FRONT_ROOT."Home/Register"?>">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>