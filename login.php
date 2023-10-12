<!DOCTYPE html>
<html lang="en">
  <head>
   
   


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <title>PG Management </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">

  </head>

  <style type="text/css">
    


  </style>

  <body class="login" style="overflow: hidden;">

    <div style="background-image: url(https://res.cloudinary.com/ddcszcshl/image/upload/v1668237534/Pizarrones%20Guadalajara/background/back2_njtgjs.jpg); background-size: cover; height: 100vh;">
      <div style="box-sizing: content-box; background-color: rgba(0, 0, 0, 0.7); height: 100%; width: 100%; position: absolute;"></div>

      <div>
    </div>

      
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper" style="margin-top: 0 !important;">
        <div class="animate form login_form">
          <section class="login_content" style="background-color: rgba(3, 20, 68, 0); padding: 30px; ">
            <form  id="frmAcceso">
              <img src="images/logo_letras_b.png" width="40%;">
              <div style="width: 100%; text-align: center; color: white; font-size: 20px; font-weight: 200 !important;">
                <label>Iniciar Sesión</label>
              </div>


              <div style="margin-top: 40px;">
                <input type="text" class="form-control" placeholder="Username" required="" name="logina" id="logina" style=" background-color: transparent; border-style: none; color: white;" />
              </div>
              <div style="margin-bottom: 70px;">
                <input type="password" class="form-control" placeholder="Password" required="" name="clavea" id="clavea" style=" background-color: transparent; border-style: none; color: white;"/>
              </div>
             
              
              <div>
                <button type="button" class="btn btn btn-round btn-info" onclick="login();" style="background-color: transparent; color: white;">Ingresar</button>
              </div>
              <!--<div>
                <a class="btn btn-default submit" href="index.html">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>-->

              <div class="clearfix"></div>

              
                <!--<p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>-->

                <div class="clearfix"></div>
                <br />

                <div>
                  <div style="margin-bottom: 50px;">
                    <a class="logo" href="index.php">
                      <img src="images/marca/LOGO_COMPLETO_sinR.png" alt="" width="250px" height="42px">
                    </a>
                  </div>
                    
                  

                  <p style="color: white;">©2020 All Rights Reserved <br> Pizarrones Guadalajara S.A de C.V.</p>
                  
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <!--<div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>-->
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>

    
    <script src="public/js/jquery-3.1.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="public/js/bootstrap.min.js"></script>
     <!-- Bootbox -->
    <script src="public/js/bootbox.min.js"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

    <!--<script type="text/javascript" src="scripts/login.js"></script>-->
    <script type="text/javascript" src="scripts/login.js?v=<?php echo(rand()); ?>"></script>

  </body>
</html>
