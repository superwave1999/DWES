<?php

require './classes/autoload.php';

use izv\data\Usuario;
use izv\data\Photo;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\managedata\ManagePhoto;
use izv\tools\Reader;
use izv\tools\Alert;
use izv\tools\Util;
use izv\tools\Session;
use izv\app\App;
use izv\tools\Permissions;

$sesion = new Session(App::SESSION_NAME);



if (!Permissions::loggedIn($sesion)) {
    header('Location: login.php');
    exit();
}


$db = new Database();
$photomanager = new ManagePhoto($db);
$user = $sesion->getLogin();
$userid = $user->getId();
$useradmin = $user->getAdministrador();

$photos = $photomanager->getAll($userid);
$db->close();

$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Welcome to Instafan!</title>
  </head>
  <body>
        <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Instasnap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Dashboard
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./newpost/">New post</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./user/">User profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./dologout.php">Logout</a>
            </li>
            
            <?php
              if ($useradmin == 1) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="./admin_users/">All users (admin)</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin_photos/">All photos (admin)</a>
            </li>
            
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    
    
    <div class="jumbotron text-center">
      <h2>Ayy</h2>
      <?php
                            foreach($photos as $photo) {
                                ?>
                                <?php
                                  if ($photo->getMime_Type() == "video/mp4") {
                                ?>    
                                    
                                    
                                    <video width="320" height="240" controls>
                                      <source src="<?php  echo './uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" type="video/mp4">
                                      Your browser doesnt support embedded videos.
                                    </video> 
                                <?php
                                  } else {
                                ?>  
                                    
                                    <img src="<?php  echo './uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" />
                                    
                                    
                                <?php    
                                  } 
                                ?>
                                
                                
                                <h4><?php  echo $photo->getDescription(); ?></h4><br>
                                <a href="./user?uid=<?php  echo $photo->getUserId(); ?>"><?php  echo $photo->getUserId(); ?></a><br>
                                <p><?php  echo $photo->getOr_Filename(); ?></p>
                                
                                

                                <?php
                                
                                if ($userid == $photo->getUserId()) {
                                ?>
                                  <a href="./editpost?pid=<?php  echo $photo->getId(); ?>" class="btn btn-success">Edit</a>
                                  
                                
                                
  
<?php
                            }
                        ?>


                                <?php
                            }
                        ?>
      
      
      
      
      
      
    </div>
    
    
    <footer class="container">
        <p>&copy; IR 2018</p>
    </footer>
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>