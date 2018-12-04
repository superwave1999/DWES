<?php
require_once("classes/vendor/autoload.php");
require_once("templates/Navlinks.php");

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new \Twig_Environment($loader);


$pagename = array('caption' => 'Welcome to Instasnap!');
echo $twig -> render('head.html', ['ptitle' => $pagename]);
//echo $twig -> render('navbar.html', ['lista' => $lista, 'home' => $home]);
?>


    <div class="jumbotron text-center">
      <h1>Welcome to Instafan!</h1>
      <p>The new DANK social network for memes. Credit card not included.</p> 
    </div>


    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <h3>Returning user</h3>
          <p>Enter your login and password.</p>
          <form class="form-signin" action="./dologin.php" method="post" enctype="multipart/form-data">
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="correo">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="clave">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

        </div>
        <div class="col-sm-4">
          <h3>Create accunt</h3>        
          <p>¿No account? ¿Alzheimer's being tough on you? Fill in this form below to enter my realm. Dont forget the kidney.</p>
              <a class="btn btn-lg btn-primary btn-block" href="./user/register.php">Sign up</a>
        </div>
      </div>
    </div>



<?php
echo $twig -> render('footer.html');