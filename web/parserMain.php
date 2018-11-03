<?php

require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;
use Sunra\PhpSimple\HtmlDomParser;

    class DaySheldule{
        public $count = 0;
        public $lessons = array();
        public $homeworks = array();
        public $marks = array();
        public $isWeekend = false;
        public $dayName = "";
    }

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
        $snoopy->submit("https://edu.brsc.ru/User/Diary?UserId=". $userID. "&Week=". $week . "&dep=0");

        $html = HtmlDomParser::str_get_html($snoopy->results);

        $elements = $html->find("table[class=\"table table-border\"]");
        $days = array();

        $daysNames = $html->find("div h3");

        for ($i = 0; $i < count($elements); $i++) {
            $day = new DaySheldule();

            $trS = HtmlDomParser::str_get_html($elements[$i])->find("tr[class=tableborder]");

            $day->isWeekend = false;
            $day->count = count($trS);

            for ($j = 0; $j < count($trS); $j++) {
                $wasEmpty = false;

                $day->lessons[$j] = count(HtmlDomParser::str_get_html($trS[$j])->find("div[title]")) != 0 ? strip_tags(HtmlDomParser::str_get_html($trS[$j])->find("div[title]")[0]) : $wasEmpty = true;

                if ($wasEmpty) {
                    $day->isWeekend = true;
                    $day->count = 1;
                    break;
                }

                $marks = HtmlDomParser::str_get_html($trS[$j])->find("td[data-mark-ids]");

                if (count($marks) != 0)
                    $day->marks[$j] = strip_tags($marks[0]);
                else
                    $day->marks[$j] = "";

                $tmp_hw = HtmlDomParser::str_get_html($trS[$j])->find('td[data-lessonid]')[0];

                if (strlen($tmp_hw) != 0)
                    $day->homeworks[$j] = strip_tags($tmp_hw);
                else
                    $day->homeworks[$j] = "NO_HW";

            }

            $day->dayName= strip_tags($daysNames[$i + 1]);
            $days[$i] = $day;
        }

        $json = json_encode($days);

        echo $json;


