<?php

require './classes/autoload.php';

use izv\data\Usuario;
use izv\database\Database;
use izv\managedata\ManageUsuario;
use izv\tools\Reader;
use izv\tools\Alert;
use izv\tools\Util;

$db = new Database();
$manager = new ManageUsuario($db);
$usuarios = $manager->getAll();
$db->close();

$alert = Alert::getMessage(Reader::get('op'), Reader::get('resultado'));

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User admin panel</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css" >
    </head>
    <body>
        <!-- modal -->
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmación de borrado de usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quiere borrar el usuario?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btConfirmDeleteAll">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal -->
        <!-- modal -->
        <div class="modal fade" id="deleteAll-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmación de borrado de varios usuarios</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quiere borrar estos usuarios?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" id="btConfirmDelete">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin modal -->
        
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">USUARIOS</h4>
                    <?= $alert ?>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <h3>GODLIKE ADMIN PANEL</h3>
                </div>
                <table class="table table-striped table-hover" id="tablaProducto">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" /></th>
                            <th>Id</th>
                            <th>Correo</th>
                            <th>Alias</th>
                            <th>Nombre</th>
                            <th>Clave</th>
                            <th>Activado</th>
                            <th>Fecha Alta</th>
                            <th>Editar</th>
                            <th>Baneaso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($usuarios as $usuario) {
                                ?>
                                <tr >
                                    <td><input type="checkbox" name="ids[]"  value="<?= $usuario->getId() ?>" form="fBorrar" /></td>
                                    <td><?php echo $usuario->getId(); ?></td>
                                    <td><?php echo $usuario->getCorreo(); ?></td>
                                    <td><?php echo $usuario->getAlias(); ?></td>
                                    <td><?php echo $usuario->getNombre(); ?></td>
                                    <td><?php echo $usuario->getClave(); ?></td>
                                    
                                    <?php
                                    
                                    $toCheck = $usuario->getActivo();
                                    
                                    if ($toCheck == 1) { ?>
                                        <td><input type="checkbox" readonly disabled checked="checked" /></td>
                                    <?php
                                    } else if ($toCheck == 0) { ?>
                                        <td><input type="checkbox" readonly disabled/></td>
                                    <?php
                                    } else { ?>
                                        <td></td>
                                    <?php    
                                    }
                                    ?>
                                    <td><?php echo $usuario->getFechaalta(); ?></td>

                                    <td><a href="edit.php?id=<?= $usuario->getId() ?>" >Editar</a></td>
                                    <td><a href="dodelete.php?id=<?= $usuario->getId() ?>" data-toggle="modal" data-target="#delete-modal">Borrar</a></td>
                                    
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
                <div class="row">
                    <input class="btn btn-danger" type="button" value="Borrar múltiple" form="fBorrar" data-toggle="modal" data-target="#deleteAll-modal"/>
                    &nbsp;
                    <a href="insert.php" class="btn btn-success">Añadir usuario</a>
                </div>
                
                <form action="dodelete.php" method="post" name="fBorrar" id="fBorrar"></form>
                
                <form action="edit.php" method="post" name="fEditar" id="fEditar">
                    <input type="hidden" name="id" id="id" value="" />
                </form>
                <hr>
            </div>
        </main>
        <footer class="container">
            <p>&copy; IR 2018</p>
        </footer>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>