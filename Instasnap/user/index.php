<?php

//user profile page

require '../classes/autoload.php';
require '../classes/vendor/autoload.php';
require_once '../templates/Navlinks.php';
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

//See if logged user

$sesion = new Session(App::SESSION_NAME);
$db = new Database();
$photomanager = new ManagePhoto($db);
$usermanager = new ManageUsuario($db);

$loggedUser = Permissions::loggedIn($sesion);

if (Reader::get('uid') == null || Reader::get('uid') <= 0 || Reader::get('uid') == '' ) {
  $linkUid = null;
} else {
  $linkUid = Reader::get('uid');
}




//No id and no login - index
if ($linkUid==null && !$loggedUser) {
  header('Location: ..');
  exit();
}

$user = $sesion->getLogin();
$isadmin = null;
if (isset($user)) {
  $isadmin = $user -> getAdministrador();
}
//No uid but logged in - display self
$curruser=null;
if ($loggedUser && $linkUid==null) {
    
    $userid = $user->getId();
    
    $curruser = $user -> getId();
}


//Theres an UID - display uid
if ($linkUid!=null) {
    $userid = Reader::get('uid');
}






//User details and photos
$useraccount = $usermanager->get($userid);
$photos = $photomanager->getAllSingleUser($userid);


$enablebutton = null;




$pageuser = $useraccount -> getId();


if ($loggedUser && ($curruser==$pageuser || $isadmin)) {
  $enablebutton = true;
}

$db->close();

$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));

$loader = new \Twig_Loader_Filesystem('../templates');
$twig = new \Twig_Environment($loader);
$pagename = array('caption' => 'User profile - Instasnap');
echo $twig -> render('head.html', ['ptitle' => $pagename]);

if ($isadmin == 1) {
  echo $twig -> render('navbar.html', ['lista' => Navlinks::getLinksSub(),
                                    'listaadm' => Navlinks::getAdminLinksSub(),
                                    'home' => Navlinks::getTitleSub()]);
} else {
    echo $twig -> render('navbar.html', ['lista' => Navlinks::getLinksSub(),
                                    'home' => Navlinks::getTitleSub()]);
}


?>
    
    
    <div class="jumbotron text-center">
        
        <div class="row">
            <div class="col-sm-4">
                <h2>
                    <?php echo $useraccount->getNombre(); ?>
                </h2>
                <p>
                    <?php echo 'Also known as '.$useraccount->getAlias(); ?>
                </p>
                <p>
                    <?php echo 'Mail: '.$useraccount->getCorreo(); ?>
                </p>
                <p>
                    <?php echo 'Member since: '.$useraccount->getFechaalta(); ?>
                </p>
            </div>
            
            <div class="col-sm-4">
                <?php
                            foreach($photos as $photo) {
                                //$nombre = urlencode($usuario->getNombre());
                                ?>
                                <?php
                                  if ($photo->getMime_Type() == "video/mp4") {
                                ?>    
                                    
                                    
                                    <video width="320" height="240" controls>
                                      <source src="<?php  echo '../uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" type="video/mp4">
                                      Your browser doesnt support embedded videos.
                                    </video> 
                                <?php
                                  } else {
                                ?>  
                                    
                                    <img src="<?php  echo '../uploads/'.$photo->getUserId().'/' .$photo->getSto_Filename(); ?>" />
                                    
                                    
                                <?php    
                                  } 
                                ?>
                                <p><?php  echo $photo->getDescription(); ?></p>
                                
                                <p><?php  echo $photo->getOr_Filename(); ?></p>
                                
                                <?php
                            }
                        ?>
            </div>
            <div class="col-sm-4">
              
              <?php    
                if (isset($enablebutton)) {
              ?>
               <a href="edit.php" class="btn btn-info">Edit profile</a>
               <?php    
                }
              ?>
               
            </div>
        </div>
        
      
      
      
      
      
      
      
    </div>
    
    
    <footer class="container">
        <p>&copy; IR 2018</p>
    </footer>
    
    
    
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
