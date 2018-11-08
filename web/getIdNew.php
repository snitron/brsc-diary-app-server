<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use \DiDom\Document;

    $login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);

    $c = curl_init();

    $post = array();
    $post['Login'] = $login;
    $post['Password'] = $password;

    curl_setopt($c,CURLOPT_URL, "https://edu.brsc.ru/Logon/Index");
    curl_setopt($c, CURLOPT_MAXREDIRS, 5);
    curl_setopt($c, CURLOPT_POST, true);
    curl_setopt($c, CURLOPT_POSTFIELDS, $post);

    curl_exec($c);

    curl_setopt($c,CURLOPT_URL, "https://edu.brsc.ru/privateoffice");
    curl_setopt($c, CURLOPT_MAXREDIRS, 5);

    $wp = curl_exec($c);

    echo curl_getinfo($c, CURLINFO_HTTP_CODE);

    echo $wp;

    curl_close($c);



function parseId($string)
{
    $b = stristr($string, "?");
    $c = substr($b, 1);

    $output = array();
    parse_str($c, $output);

    return $output['UserId'];
}