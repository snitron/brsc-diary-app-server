<?php
require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;
use DiDom\Document;

$login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
$userID = filter_input(INPUT_GET, "userID", FILTER_SANITIZE_STRING);

$snoopy = new Snoopy();

$post_array = array();
$post_array['Login'] = $login;
$post_array['Password'] = $password;

$snoopy->maxredirs = 2;
$snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
$snoopy->results;

$snoopy->submit("https://edu.brsc.ru/user/diary/diaryresult?UserId=" . $userID);
$html = new Document($snoopy->results);

echo parseName($html->find("tr")[0]->find("th")[0]->text());

function parseName($string){
    return substr($string, 0, strpos($string, ','));
}