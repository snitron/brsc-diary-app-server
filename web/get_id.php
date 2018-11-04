<?php
require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;

    $login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);

    $snoopy = new Snoopy();

    $post_array = array();
    $post_array['Login'] = $login;
    $post_array['Password'] = $password;

    $snoopy->maxredirs = 2;
    $snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
    $snoopy->results;

    $snoopy->submit("https://edu.brsc.ru/User/Diary");
    $html = phpQuery::newDocument($snoopy->results);

    $array = parseId($html->find("a.h5")->getStrings(0));

    echo $array['UserId'];


function parseId($string){
    $string = strtr($string, "class=\"h5\"", "");
    $b = stristr($string, "?");
    $c = substr($b, 1, stripos($b, "\"") - 1);

    $output = array();
    parse_str($c, $output);


    return $output;
}