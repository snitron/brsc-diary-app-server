<?php
require __DIR__ . "/../vendor/autoload.php";
require "User.php";

use \DiDom\Document;


$headers = getallheaders();
//if ($headers['User-Agent'] == 'Nitron Apps BRSC Diary Http Connector') {
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
    $session->visit("https://edu.brsc.ru/privateoffice");
    $html = new Document($session->getPage()->getHtml());
    
    if ($version != null) { //for eldery version support. delete in the future
        //  session_start();

        $user = new User();
        $check_login = $html->find('a.btn.btn-sm.btn-primary[role="button"][href!="/user/diary"]');
        if (count($check_login) != 0) {

            for ($i = 0; $i < count($check_login); $i++)
                $user->child_ids[$i] = parseId($check_login[$i]->getAttribute("href"));

            $user->id = null;
            $user->sess_index = "user_index" . $user->id;
            $user->parent_id = $html->find("p.col-lg-7.col-md-8.col-sm-8.col-6")[0]->text();
        } else {
            $user->child_ids = null;
            $user->id = $html->find("p.col-lg-7.col-md-8.col-sm-8.col-6")[0]->text();
            $user->sess_index = "user_index" . $user->id;
            $user->parent_id = null;
        }


        echo json_encode($user);
    } else {
        echo  $html->find("p.col-lg-7.col-md-8.col-sm-8.col-6")[0]->text();
    }
//}

function parseId($string)
{
    $b = stristr($string, "?");
    $c = substr($b, 1);

    $output = array();
    parse_str($c, $output);

    return $output['UserId'];
}
