<?php

//Fix types
require '../MultipleUpload.php';
require '../Reader.php';

$username=Reader::post('username');
$dirRoot = '/home/ubuntu/workspace/Ejercicios3/USERADDUSER/uploads/';


if (isset($username)) {
    
    $dirname = $dirRoot . $username;
    
    $upload = new MultipleUpload('profile');
    $upload->setTarget($dirname.'/');
    $upload->addFileType('image/jpeg');
    $upload->addFileType('image/gif');
    $upload->addFileType('image/png');
    $upload->setPolicy(2);
    
    $responseValue='shit';
    if (createUserFile($dirname)) {
        
        $test = $upload->upload();
        if ($test == true) { 
            var_dump($test);
            $responseValue = 'success';
        } else {
            shell_exec('rm -r ' . $dirRoot . $username);
        }
    }
    
    echo $responseValue;
}

function createUserFile($dirname){
    $result = false;
    if (!file_exists($dirname . '/')) {
        shell_exec('mkdir ' . $dirname .'/', 0777, true);
        if (file_exists($dirname .'/')) {
            $result = true;
        }
    }
    return $result;
}
