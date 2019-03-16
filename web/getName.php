<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use DiDom\Document;

class PersonOld {
    public $name = "";
    public $img = "";
}

class Person {
    public $child_ids = array();
    public $name = "";
}

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


if ($version != null) {
        $option = filter_input(INPUT_GET, "option", FILTER_SANITIZE_STRING);
        $person = new Person();

        if ($option == "one") {
            $person->child_ids = null;
            $userID = filter_input(INPUT_GET, "child_ids", FILTER_SANITIZE_STRING);

            $person->name = trim(parseName($html->find("h1.text-center")[0]->text()));

           echo json_encode($person);
        } else {
            $child_ids = json_decode(filter_input(INPUT_GET, "child_ids", FILTER_SANITIZE_STRING));
            $child_names = $html->find('div.col-lg-6.col-md-12.col-sm-6.col-12')[0]->find("p.col-lg-7.col-md-8.col-sm-8.col-6");

            for($i = 0; $i < count($child_names); $i++){
                $person->child_ids[$i] = $child_names[$i]->find("a")[0]->text();
            }

            $person->name = trim(parseName($html->find("h1.text-center")[0]->text()));
            /*
            for ($i = 0; $i < count($child_ids); $i++) {
                $snoopy->submit("https://edu.brsc.ru/user/diary/diaryresult?UserId=" . $child_ids[$i]);
                $html = new Document($snoopy->results);

                $person->child_ids[$i] = trim(parseName($html->find("tr")[0]->find("th")[0]->text()));

                if($i == count($child_ids) - 1)
                    $person->name = trim($html->find('a[id="UserFIO"]')[0]->text());
            }
*/
            echo json_encode($person);
        }
    } else {
        $userID = filter_input(INPUT_GET, "userID", FILTER_SANITIZE_STRING);
        $result = new PersonOld();
        $result->name =  trim(parseName($html->find("h1.text-center")[0]->text()));
        $result->img = $html->find('img.media-object.rounded-circle')[0]->getAttribute("src");
        echo json_encode($result);
    }
//}

function parseName($string)
{
    return prepareName(substr($string, 0, strpos($string, ',')));
}

function prepareName($string){
    if($string{0} == '"')
        $string = substr($string, 1);

    if($string{strlen($string) - 1} == '"')
        $string = substr($string, 0, strlen($string) - 1);

    return $string;
}
