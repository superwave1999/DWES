<?php

require './classes/autoload.php';
require './classes/vendor/autoload.php';
require_once './templates/Navlinks.php';
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


$sesion = new Session(App::SESSION_NAME);

$userLogin = null;
$loggedUser = $sesion -> isLogged();
$adminUser = $sesion -> isAdmin();
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}



if (!$loggedUser) {
  header('Location: login.php');
  exit();
}

//Display content on page
$db = new Database();
$photomanager = new ManagePhoto($db);
//$user = $sesion->getLogin();
$userid = $userLogin->getId();
$useradmin = $adminUser;

$photos = $photomanager->getAll($userid);
$db->close();


//$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));



// All ok, render page
$loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new \Twig_Environment($loader);
$pagename = array('caption' => 'Dashboard - Instasnap');
echo $twig -> render('head.html', ['ptitle' => $pagename]);

if ($useradmin) {
  echo $twig -> render('navbar.html', ['lista' => Navlinks::getLinksRoot(),
                                    'listaadm' => Navlinks::getAdminLinksRoot(),
                                    'home' => Navlinks::getTitleRoot()]);
} else {
    echo $twig -> render('navbar.html', ['lista' => Navlinks::getLinksRoot(),
                                    'home' => Navlinks::getTitleRoot()]);
}
    
    ?>
    <div class="jumbotron text-center">
      <h2>Welcome back!</h2>
      <?php
                            foreach($photos as $photo) {
                                  if ($photo->getMime_Type() == "video/mp4") {
                                ?>    
                                    <video width="680" height="480" controls>
                                      <source src="<?php  echo './uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" type="video/mp4">
                                      Your browser doesnt support embedded videos.
                                    </video> <br>
                                <?php
                                  } else {
                                ?>  

                                    <img src="<?php  echo './uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" /><br>

                                <?php    
                                  } 
                                ?>

                                <h4><?php  echo $photo->getDescription(); ?></h4><br>
                                <a href="./user?uid=<?php  echo $photo->getUserId(); ?>"><?php  echo $photo->getUserId(); ?></a><br>
                                <p><?php  echo $photo->getOr_Filename(); ?></p><br>

                                <?php
                                
                                if ($userid == $photo->getUserId()) {
                                ?>
                                  <a href="./editpost?pid=<?php  echo $photo->getId(); ?>" class="btn btn-success">Edit</a><br>

  
<?php
                            }

                            }
                        ?>

    </div>
<?php
echo $twig -> render('footer.html');