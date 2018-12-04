<?php

require '../classes/autoload.php';

use izv\app\App;
use izv\tools\Session;
use izv\data\Usuario;
use izv\tools\Permissions;

$sesion = new Session(App::SESSION_NAME);

if(!Permissions::loggedIn($sesion)) {
    header('Location: ..');
    exit();
}

$user = $sesion->getLogin();
$userid = $user->getId();

var_export($userid);

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
                    <h4 class="display-4">Productos</h4>
                </div>
            </div>
            <div class="container">
                <div>
                    <form action="doupload.php" method="post" enctype="multipart/form-data">
                        
                        <!--ID is autoassigned -->
                        <!--userid later -->
                        <!--ofn and sfn assigned later -->
                        <input type="file" id="uploadedphoto" name="uploadedphoto"/>
                        <div class="form-group">
                            <label for="nombre">Description</label>
                            <input required type="text" class="form-control" id="description" name="description" placeholder="Describe la foto">
                        </div>
                        
                        <!--mime is assigned later -->
                        
                        <div class="form-group">
                            <label for="visible">Visible on dashboard</label>
                            <input type="checkbox" name="visible" id="visible" checked value="1">
                        </div>
                        
                        <div class="form-group">
                            <label for="pinned">Pin to top</label>
                            <input type="checkbox" name="pinned" id="pinned" value="1">
                        </div>
                        
                        <!--uploadtime is autoassigned -->

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