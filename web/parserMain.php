<?php

require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;

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

        $html = phpQuery::newDocument($snoopy->results);

        $elements = $html->find("table");
        $days = array();

        $daysNames = $html->find("div > h3")->elements;


        for ($i = 0; $i < $elements->length; $i++) {
            $day = new DaySheldule();

            $trS = pq($elements->elements[$i])->find("tr.tableborder");

            $day->isWeekend = false;
            $day->count = $trS->length;

            for ($j = 0; $j < $trS->length; $j++) {
                $wasEmpty = false;

                $day->lessons[$j] = count(pq($trS->elements[$j])->find("div[title]")) != 0 ? strip_tags(pq($trS->elements[$j])->find("div[title]")[0]) : $wasEmpty = true;

                if ($wasEmpty) {
                    $day->isWeekend = true;
                    $day->count = 1;
                    break;
                }

                $marks = pq($trS->elements[$j])->find("td[data-mark-ids]");

                if ($marks->elements != 0)
                    $day->marks[$j] = strip_tags($marks->elements[0]);
                else
                    $day->marks[$j] = "";

                $tmp_hw = pq($trS->elements[$j])->find('td[data-lessonid]')->elements[0];

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


