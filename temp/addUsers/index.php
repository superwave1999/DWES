<?php


require '../../classes/Autoload.php';

$mainDir = '/home/ubuntu/private';
$mainDir = '/home/ubuntu/workspace/Ejercicios3/USERADDUSER/uploads';
$userDirs = glob ($mainDir. '/*', GLOB_ONLYDIR);



?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Fotos de usuarios</h1>
<?php
echo "<ul>";

foreach ($userDirs as $fileInfo) {
    
    $pathParts = explode('/', $fileInfo);
    $userName = $pathParts[count($pathParts) - 1];
    
    $folder = scandir($fileInfo, 1);
    
    echo '<li>' .$userName;
    echo buildLinks($folder,$userName);
    echo '</li>';
    
 
}

function buildLinks ($folder, $userName) {
    echo "<ul>";

    foreach ($folder as $index => $file) {
        
        if (strtolower(substr($file, strrpos($file, '.') + 1)) == 'gif' ||
        strtolower(substr($file, strrpos($file, '.') + 1)) == 'png' ||
        strtolower(substr($file, strrpos($file, '.') + 1)) == 'jpg') {
            

            echo '<p>'.$file.'</p>';
            echo '<img src="/home/ubuntu/workspace/Ejercicios3/USERADDUSER/uploads/' . $userName . '/' . $file . '" />';
        }

    }

    echo "</ul>";
}

echo "</ul>";
?>
<a href="register.html"><input type="button" value="New user"/></a>
<input type="button" value="Refresh Page" onClick="window.location.href=window.location.href">
</body>
</html>
