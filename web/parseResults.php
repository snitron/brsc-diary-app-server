<?php
require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use Sunra\PhpSimple\HtmlDomParser;

class Result
{
    public $lesson = "";
    public $m1 = "";
    public $m2 = "";
    public $m3 = "";
    public $m4 = "";
    public $y = "";
    public $res = "";
    public $isHalfYear = false;
}

$login = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$userID = filter_input(INPUT_POST, "userID", FILTER_SANITIZE_STRING);

$snoopy = new Snoopy();

$post_array = array();
$post_array['Login'] = $login;
$post_array['Password'] = $password;

$snoopy->maxredirs = 2;
$snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
$snoopy->results;

$snoopy->submit("https://edu.brsc.ru/user/diary/diaryresult?UserId=" . $userID);
$html = HtmlDomParser::str_get_html($snoopy->results);

$trS = $html->find("tr");
$wasSep = false;
$results = array();
for ($i = 2; $i < count($trS); $i++) {
    $tdS = HtmlDomParser::str_get_html($trS[$i])->find("td");
    $result = new Result();

    if($wasSep){
        for($j = 0; $j < count($tdS); $j++) {
            switch ($j) {
                case 1:
                    $result->lesson = strip_tags($tdS[$j]);
                    break;
                case 2:
                    $result->m1 = strip_tags($tdS[$j]);
                    break;
                case 3:
                    $result->m2 = strip_tags($tdS[$j]);
                    break;
                case 4:
                    $result->y = strip_tags($tdS[$j]);
                    break;
                case 5:
                    $result->res = strip_tags($tdS[$j]);
                    break;
                default:
                    break;
            }
        echo strip_tags($tdS[$j]) . " ";
        }
        $results[$i - 1] = $result;
        break;
    }


    if (strip_tags($tdS[0]) != "НАИМЕНОВАНИЕ ПРЕДМЕТА" && !$wasSep) {
        for ($j = 0; $j < count($tdS); $j++)
            switch ($j) {
                case 1:
                    $result->lesson = strip_tags($tdS[$j]);
                    break;
                case 2:
                    $result->m1 = strip_tags($tdS[$j]);
                    break;
                case 3:
                    $result->m2 = strip_tags($tdS[$j]);
                    break;
                case 4:
                    $result->m3 = strip_tags($tdS[$j]);
                    break;
                case 5:
                    $result->m4 = strip_tags($tdS[$j]);
                    break;
                case 6:
                    $result->y = strip_tags($tdS[$j]);
                    break;
                case 7:
                    $result->res = strip_tags($tdS[$j]);
                    break;
                default:
                    break;

        }
    }else
        $wasSep = true;



    $results[$i] = $result;
}
/*
for ($i = 0; $i < count($tables); $i++) {
    $trS = HtmlDomParser::str_get_html($tables[$i]->last_child())->find("tr");
    for ($j = 0; $j < count($trS); $i++) {
        $result = new Result();
        $tdS = HtmlDomParser::str_get_html($trS[$j])->find("td");

        for ($k = 1; $k < count($tdS) + 1; $k++) {
            if (count($tdS) == 5)
                $result->isHalfYear = true;
            switch ($k) {
                case 1:
                    $result->lesson = strip_tags($tdS[$k]);
                    break;
                case 2:
                    $result->m1 = strip_tags($tdS[$k]);
                    break;
                case 3:
                    $result->m2 = strip_tags($tdS[$k]);
                    break;
                case 4:
                    if ($result->isHalfYear)
                        $result->y = strip_tags($tdS[$k]);
                    else
                        $result->m3 = strip_tags($tdS[$k]);
                    break;
                case 5:
                    if ($result->isHalfYear)
                        $result->res = strip_tags($tdS[$k]);
                    else
                        $result->m4 = strip_tags($tdS[$k]);
                    break;
                case 6:
                    if (!$result->isHalfYear)
                        $result->y = strip_tags($tdS[$k]);
                    break;
                case 7:
                    if (!$result->isHalfYear)
                        $result->res = strip_tags($tdS[$k]);
                    break;
                default:
                    break;
            }
        }
        $results[$j] = $result;
    }
}
*/
echo json_encode($results);

