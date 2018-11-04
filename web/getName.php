<?php
require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;
use DiDom\Document;

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

echo $html->find("h5.\"col-lg-12 col-md-12 col-sm-12 col-xs-12 b-user-block\"")[0]->text();