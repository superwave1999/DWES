<?php

require '../classes/autoload.php';

use izv\app\App;
use izv\tools\Session;
use izv\data\Usuario;

//Protection
$sesion = new Session(App::SESSION_NAME);

$userLogin = null;
$loggedUser = $sesion -> isLogged();
$adminUser = $sesion -> isAdmin();
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}

//No login -> gtfo
if (!$loggedUser) {
  header('Location: ..');
  exit();
}

$user = $userLogin;
$userid = $user->getId();
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>New upload - Instasnap</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css" >
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="..">Return to dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                </ul>
            </div>
        </nav>

        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">New post</h4>
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
            <p>&copy; IR 2018</p>
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