<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use DiDom;
$login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
$version = filter_input(INPUT_GET, "version", FILTER_SANITIZE_STRING);


$driver = new \Behat\Mink\Driver\GoutteDriver();

$session = new \Behat\Mink\Session($driver);

$session->start();
$session->visit("https://edu.brsc.ru/Logon/Index");
$btn = $session->getPage()->findButton("Войти");
$loginEdit = $session->getPage()->findField("Login");
$loginEdit->setValue($login);

$passwordEdit = $session->getPage()->findField("Password");
$passwordEdit->setValue($password);

$btn->click();
echo $session->getCurrentUrl();

for($i = 0; $i < count($session->getResponseHeaders()); $i++){
    echo $session->getResponseHeaders()[$i];
}

echo $session->getCookie("JWToken");
$session->setCookie("Token","0");
$session->visit("https://edu.brsc.ru/privateoffice");
$parser = new DiDom\Document($session->getPage()->getHtml());

echo $parser->find("col-lg-7.col-md-8.col-sm-8.col-6")[0];

/*
$snoopy = new Snoopy();
$post_array = array();
$post_array['Login'] = $login;
$post_array['Password'] = $password;
$snoopy->maxredirs = 2;
$snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
$snoopy->passcookies = true;
//$snoopy->submit("https://edu.brsc.ru/User/Diary");
for($i = 0; $i < count($snoopy->headers); $i++){
    echo $snoopy->headers[$i];
}
for($i = 0; $i < count($snoopy->cookies); $i++){
    echo $snoopy->cookies[$i];
}
for($i = 0; $i < count($snoopy->rawheaders); $i++){
    echo $snoopy->rawheaders[$i];
}
curl

echo $snoopy->results;
*/


