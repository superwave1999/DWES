<?php
require_once("classes/vendor/autoload.php");
require_once("templates/Navlinks.php");

$loader = new \Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new \Twig_Environment($loader);


$pagename = array('caption' => 'Welcome to Instasnap!');
echo $twig -> render('head.html', ['ptitle' => $pagename]);
//echo $twig -> render('navbar.html', ['lista' => $lista, 'home' => $home]);
echo $twig -> render('login_page.html');
echo $twig -> render('footer.html');