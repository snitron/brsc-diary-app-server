<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use \DiDom\Document;
use Behat\Mink\Session;
use Behat\Mink\Driver\GoutteDriver;

    $login = filter_input(INPUT_GET, "login", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);

    $driver = new GoutteDriver();
    $session = new Session($driver);

    $session->start();

    $session->visit("https://edu.brsc.ru/Logon/Index");
    $btn = $session->getPage()->findButton("Войти");

    $login_et = $session->getPage()->findField("Login");
    $password_et = $session->getPage()->findField("Password");

    $login_et->setValue($login);
    $password_et->setValue($password);

    $btn->press();


    echo $session->getStatusCode();

function parseId($string)
{
    $b = stristr($string, "?");
    $c = substr($b, 1);

    $output = array();
    parse_str($c, $output);

    return $output['UserId'];
}