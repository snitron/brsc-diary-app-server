<?php

require __DIR__ . "/../vendor/autoload.php";

use Snoopy\Snoopy;
use DiDom\Document;

class DaySheldule
{
    public $count = 0;
    public $lessons = array();
    public $homeworks = array();
    public $marks = array();
    public $isWeekend = false;
    public $dayName = "";
    public $teacherComment = array();
    public $hrefHw = array(
        array()
    );
    public $hrefHwNames = array(
        array()
    );
}

$headers = getallheaders();
if ($headers['User-Agent'] == 'Nitron Apps BRSC Diary Http Connector') {
    $action = filter_input(INPUT_GET, "action", FILTER_SANITIZE_STRING);

    $login = filter_input(INPUT_GET, 'login', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);

    $snoopy = new Snoopy();

    $post_array = array();
    $post_array['Login'] = $login;
    $post_array['Password'] = $password;

    $snoopy->maxredirs = 2;
    $snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
    $snoopy->results;

    $userID = filter_input(INPUT_GET, "userID", FILTER_SANITIZE_STRING);
    $week = filter_input(INPUT_GET, "week", FILTER_SANITIZE_STRING);
    $snoopy->submit("https://edu.brsc.ru/User/Diary?UserId=" . $userID . "&Week=" . $week . "&dep=0");

    $html = new Document($snoopy->results);

    $elements = $html->find("table");
    $days = array();

    $daysNames = $html->find("h3");

    for ($i = 0; $i < count($elements); $i++) {
        $day = new DaySheldule();

        $trS = $elements[$i]->find("tr.tableborder");
        $day->isWeekend = false;
        $day->count = count($trS);

        for ($j = 0; $j < count($trS); $j++) {
            $wasEmpty = false;

            $day->lessons[$j] = count($trS[$j]->find("div[title]")) != 0 ? strip_tags($trS[$j]->find("div[title]")[0]->text()) : $wasEmpty = true;

            if ($wasEmpty) {
                $day->isWeekend = true;
                $day->count = 1;
                break;
            }

            $marks = $trS[$j]->find("td")[4]->text();

            if (strlen($marks) != 0)
                $day->marks[$j] = strip_tags($marks);
            else
                $day->marks[$j] = "";

            $tmp_hw = $trS[$j]->find('td[data-lessonid]')[0]->text();

            if (strlen($tmp_hw) != 0)
                $day->homeworks[$j] = strip_tags($tmp_hw);
            else
                $day->homeworks[$j] = "";

            $a = $trS[$j]->find('td[data-lessonid]')[0]->find('a');

            if (count($a) != 0) {
                for ($k = 1; $k < count($a); $k++)
                    if ($a[$k] != null && $a[$k]->attr('href') != "#" && $a[$k]->attr('href') != "") {
                        $day->hrefHw[$j][$k - 1] = $a[$k]->attr("href");
                        $day->hrefHwNames[$j][$k - 1] = trim(strip_tags($a[$k]->text()));
                    } else {
                        $day->hrefHw[$j][$k - 1] = null;
                        $days->hrefHwNames[$j][$k - 1] = null;
                    }
            } else {
                $day->hrefHw[$j] = null;
                $day->hrefHwNames[$j] = null;
            }

            $day->teacherComment[$j] = trim($trS[$j]->find("td")[5]->text()) != "" ? trim($trS[$j]->find("td")[5]->text()) : null;

            array_filter($day->hrefHw[$j], function ($value) {
                return $value !== '' && $value !== null;
            });
        }


        $day->dayName = $daysNames[$i] != null ? strip_tags($daysNames[$i]->text()) : "ERR";
        $days[$i] = $day;
    }

    echo json_encode($days);
}

