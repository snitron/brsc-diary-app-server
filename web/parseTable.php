<?php
require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;
use Sunra\PhpSimple\HtmlDomParser;

class Table{
    public $lesson = "";
    public $average_mark1 = "";
    public $average_mark2 = "";
    public $average_mark3 = "";
    public $average_mark4 = "";
    public $m1 = "";
    public $m2 = "";
    public $m3 = "";
    public $m4 = "";

}

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

$snoopy->submit("https://edu.brsc.ru/user/diary/diarygradeslist?UserId=" . $userID);
$html = HtmlDomParser::str_get_html($snoopy->results);

$trS = HtmlDomParser::str_get_html($html->find("tbody"))->find("tr");
$tables = array();
for($i = 0; $i < count($trS); $i++){
    $table = new Table();
    $tdS = HtmlDomParser::str_get_html($trS[$i])->find("td");
    for($j = 1; $j < 10; $j++){
        switch ($j){
            case 1:
                $table->lesson = strip_tags($tdS[$j]);
                break;
            case 2:
                $table->average_mark1 = strip_tags($tdS[$j]);
                break;
            case 3:
                $table->m1 = strip_tags($tdS[$j]);
                break;
            case 4:
                $table->average_mark2 = strip_tags($tdS[$j]);
                break;
            case 5:
                $table->m2 = strip_tags($tdS[$j]);
                break;
            case 6:
                $table->average_mark3 = strip_tags($tdS[$j]);
                break;
            case 7:
                $table->m3 = strip_tags($tdS[$j]);
                break;
            case 8:
                $table->average_mark4 = strip_tags($tdS[$j]);
                break;
            case 9:
                $table->m4 =strip_tags($tdS[$j]);
                break;
            default:
                break;
        }
    }
    $tables[$i] = $table;
}

echo json_encode($tables);


