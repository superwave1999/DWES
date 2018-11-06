<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Admin Panel - Add New</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css" >
    </head>
    <body>
        <main role="main">
            <div class="jumbotron">
                <div class="container">
                    <h4 class="display-4">USERS TO SPY ON</h4>
                </div>
            </div>
            <div class="container">
                <div>
                    <form action="doinsert.php" method="post">
                        <div class="form-group">
                            <label for="correo">EMAIL (for adverts)</label>
                            <input required type="text" class="form-control" id="form_correo" name="correo" placeholder="pleb@shithole.fuk">
                        </div>
                        
                        <div class="form-group">
                            <label for="alias">Nickname</label>
                            <input type="text" class="form-control" id="form_alias" name="alias" placeholder="xXx_PUSSYSL4YER69_xXx">
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre">Full name to stalk</label>
                            <input required type="text" class="form-control" id="form_nombre" name="nombre" placeholder="Chad Diamond">
                        </div>
                        
                        <div class="form-group">
                            <label for="clave">Password</label>
                            <input required type="text" class="form-control" id="form_password" name="clave" placeholder="123456789">
                        </div>
                        
                        <div class="form-group">
                            <label for="activo">Activate</label>
                            <input type="checkbox" class="" id="form_active" name="activo">
                        </div>
                        
                        <!--<div class="form-group">
                            <label for="nombre">Register date</label>
                            <input type="datetime-local" class="form-control" id="form_date" name="fechaalta">
                        </div>-->
                        
                        <button type="submit" class="btn btn-primary">:D</button>
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

        <script src="./js/script.js"></script>
    </body>
</html>