<?php

require '../classes/autoload.php';

use izv\app\App;
use izv\tools\Session;
use izv\data\Usuario;
use izv\data\Photo;
use izv\managedata\ManagePhoto;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Util;
use izv\database\Database;


//Must be logged in
$sesion = new Session(App::SESSION_NAME);
if(!$sesion->isLogged()) {
    header('Location: ..');
    exit();
}

//Wrong link go back
$pid = Reader::read('pid');
if($pid === null || !is_numeric($pid) ||  $pid <= 0) {
    header('Location: javascript://history.go(-1)');
    exit();
}

$thisuser = $sesion->getLogin();
$isUploader = $thisuser->getId();
$isAdmin = $thisuser->getAdministrador();


//If not admin and isnt uploader FUCK GO BACK
if (!$isAdmin && $photo->getUserId() != $isUploader) {
    header('Location: javascript://history.go(-1)');
    exit();
}

//If is admin or is same user (or both) continue;
$db = new Database();
$manager = new ManagePhoto($db);
$photo = $manager->get($pid);
$db->close();

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>dwes</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css" >
    </head>
    <body>

        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">Photo</h4>
                </div>
            </div>
            <div class="container">
                <div>
                    <form action="doedit.php" method="post" enctype="multipart/form-data">
                        
                        
                        <input type="hidden" name="id" value="<?php echo $photo->getId(); ?>">
                        <input type="hidden" name="userid" value="<?php echo $photo->getUserId(); ?>">
                        <input type="hidden" name="or_filename" value="<?php echo $photo->getOr_Filename(); ?>">
                        <input type="hidden" name="sto_filename" value="<?php echo $photo->getSto_Filename(); ?>">
                        
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input required type="text" class="form-control" id="description" name="description" placeholder="Describe la foto"
                            value="<?php echo $photo->getDescription(); ?>">
                        </div>
                        
                        <input type="hidden" name="mime_type" value="<?php echo $photo->getMime_Type(); ?>">
                        
                        <div class="form-group">
                            <label for="visible">Visible on dashboard</label>
                            <input type="checkbox" name="visible" id="visible" <?php echo Util::mySQLToCheckbox($photo->getVisible()); ?> value="1">
                        </div>
                        
                        <div class="form-group">
                            <label for="pinned">Pin to top</label>
                            <input type="checkbox" name="pinned" id="pinned" <?php echo Util::mySQLToCheckbox($photo->getPinned()); ?> value="1">
                        </div>
                        
                        <input type="hidden" name="uploadtime" value="<?php echo $photo->getUploadtime(); ?>">

                        <button type="submit" class="btn btn-primary">Alta</button>
                    </form>
                </div>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IZV 2018</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>
            /*global tinymce*/
            tinymce.init({
                selector:'textarea.editor',
                menubar: false,
                toolbar: 'undo redo | bold italic underline'
            });
        </script>-->
        <script src="../js/script.js"></script>
    </body>
</html>