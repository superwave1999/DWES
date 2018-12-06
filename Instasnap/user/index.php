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


//User permissions
$sesion = new Session(App::SESSION_NAME);

$userLogin = null;
$loggedUser = $sesion -> isLogged();
$adminUser = $sesion -> isAdmin();
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}


//Who is viewing
$curruser = null;
if (isset($userLogin)) {
    $curruser = $userLogin -> getId();
}

//If link has GET -read token
if (Reader::get('uid') == null || Reader::get('uid') <= 0 || Reader::get('uid') == '' ) {
  $linkToken = null;
} else {
  $linkToken = Reader::get('uid');
}




//No id and no login - index
if ($linkToken==null && !$loggedUser) {
  header('Location: ..');
  exit();
}




//No uid but logged in - read loggeduser id
if ($loggedUser && $linkToken==null) {
    $linkToken = $userLogin-> getId();
}


//Theres an UID - display uid REDUNDANT
/*if ($linkToken!=null) {
    $userid = Reader::get('uid');
}
*/







//Get photos and user account
$db = new Database();
$photomanager = new ManagePhoto($db);
$usermanager = new ManageUsuario($db);


//Linktoken SHOULDNT be null by here
if(!isset($linkToken)) {
    header('Location: ..');
    exit();
}

//User details and photos
$useraccount = $usermanager->get($linkToken);
$photos = $photomanager->getAllSingleUser($linkToken);


$enablebutton = null;
$pageuser = $useraccount -> getId();
if ($loggedUser && ($curruser==$pageuser || $adminUser)) {
  $enablebutton = true;
}

$db->close();



//$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));





//All done, render page
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
