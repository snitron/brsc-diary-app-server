<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use \DiDom\Document;

    $login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);

    $snoopy = new Snoopy();

    $post_array = array();
    $post_array['Login'] = $login;
    $post_array['Password'] = $password;

    $snoopy->maxredirs = 4;
    $snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
    $snoopy->results;

    $snoopy->maxredirs = 4;
    $snoopy->submit("https://edu.brsc.ru/home/esiapromotion");
    $snoopy->maxredirs = 4;
// $snoopy->submit("https://edu.brsc.ru/User/Diary");
    $snoopy->submit("https://edu.brsc.ru/privateoffice");
    $html = new Document($snoopy->results);

    //echo parseId($html->find("a.h5")[0]->getAttribute("href"));
    echo $html->html();

function parseId($string)
{
    $b = stristr($string, "?");
    $c = substr($b, 1);

    $output = array();
    parse_str($c, $output);

    return $output['UserId'];
}