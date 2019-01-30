<?php

require '../classes/autoload.php';
require '../classes/vendor/autoload.php';
require_once '../templates/Navlinks.php';

use izv\app\App;
use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Alert;
use izv\tools\Reader;
use izv\tools\Session;
use izv\tools\Util;

//User permissions
$sesion = new Session(App::SESSION_NAME);

$userLogin = null;
$loggedUser = $sesion -> isLogged();
$adminUser = $sesion -> isAdmin();
if($loggedUser) {
    $userLogin = $sesion->getLogin();
}

//Not logged
if (!$loggedUser) {
  header('Location: ..');
  exit();
}





$usuario = $userLogin;
$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));

$loader = new \Twig_Loader_Filesystem('../templates');
$twig = new \Twig_Environment($loader);

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User edit - Instasnap</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css" >
    </head>
    <body>

        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="..">Return to dathboard</a>
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
                    <h4 class="display-4">Edición de usuario</h4>
                </div>
            </div>
            <div class="container">
                <form action="doedit.php" method="post">
                    <div class="form-group">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $usuario->getId() ?>">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre del usuario</label>
                            <input required type="text" class="form-control" id="nombre" name="nombre" placeholder="Introduce el nombre del usuario" value="<?= $usuario->getNombre() ?>">
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo electrónico (login)</label>
                            <input required type="email" class="form-control" id="correo" name="correo" placeholder="Introduce el correo del usuario" value="<?= $usuario->getCorreo() ?>">
                        </div>
                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" class="form-control" id="alias" name="alias" placeholder="Introduce el alias del usuario" value="<?= $usuario->getAlias() ?>">
                        </div>
                    <hr>
                    <div class="form-group">
                        <label for="clave">Clave anterior</label>
                        <input type="password" class="form-control" id="claveAnterior" name="claveAnterior" placeholder="Introduce la clave anterior del usuario">
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Introduce la clave nueva del usuario">
                    </div>
                    <div class="form-group">
                        <label for="clave2">Repite clave</label>
                        <input type="password" class="form-control" id="clave2" name="clave2" placeholder="Repite la clave nueva del usuario">
                    </div>
                    <div class="form-group">
                            <label for="clave">Usuario activo (desactivará tu cuenta):</label>
                            <input type="checkbox" class="form-control" id="activo" name="activo" <?= Util::mySQLToCheckbox($usuario->getActivo()) ?>>
                        </div>
                        <div class="form-group"> Admin check to add.
                            <input type="hidden" class="form-control" id="administrador" name="administrador" <?= Util::mySQLToCheckbox($usuario->getAdministrador()) ?>>
                        </div>
                        <input type="hidden" id="fechaalta" name="fechaalta" value="<?= $usuario->getFechaalta() ?>">
                        
                        <button type="submit" class="btn btn-primary">Editar</button>
                </form>
            </div>
        </main>
<?php
echo $twig -> render('footer.html');