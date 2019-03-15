<?php
require __DIR__ . "/../vendor/autoload.php";
require "User.php";
use Snoopy\Snoopy;
use \DiDom\Document;
$headers = getallheaders();
    $login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
    $version = filter_input(INPUT_GET, "version", FILTER_SANITIZE_STRING);
   
        $snoopy = new Snoopy();
        $post_array = array();
        $post_array['Login'] = $login;
        $post_array['Password'] = $password;
        $snoopy->maxredirs = 2;
        $snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
        $snoopy->submit("https://edu.brsc.ru/User/Diary");
       
     
