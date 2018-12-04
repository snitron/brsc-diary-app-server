<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use \DiDom\Document;

ini_set('max_input_time', 120);
$headers = getallheaders();
//if ($headers['User-Agent'] == 'Nitron Apps BRSC Diary Http Connector') {
    set_time_limit(120);
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
    $html = new Document($snoopy->results);

    echo parseId($html->find("a.h5")[0]->getAttribute("href"));

//}
function parseId($string)
{
    echo $string;
    $b = stristr($string, "?");
    echo "\n" . $b;
    $c = substr($b, 1);
        echo "\n" . $c;

    $output = array();
    parse_str($c, $output);

        echo "\n" . $output['UserId'];
    return $output['UserId'];
}
