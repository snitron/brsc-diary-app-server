<?php
require __DIR__ . "/../vendor/autoload.php";
use Snoopy\Snoopy;
/*
$snoopy = new Snoopy();
$snoopy->maxredirs = 2;
$snoopy->rawheaders['Authorization'] = "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6IjQ5NDEyOSIsInJvbGUiOiI4LERlcGFydG1lbnQsLDUyLDQ3OSw2MjI4NywiLCJuYmYiOjE1NTI2NzY0MDAsImV4cCI6MTU1MzI4MTIwMCwiaWF0IjoxNTUyNzM1MTYyLCJpc3MiOiIxMC4zLjIuMzAiLCJhdWQiOiJpdC5icnNjLnJ1In0.42ovgYR9hVKhNqvTFk9oNSwwhStbXvi3dWEElMZtJSI";
$snoopy->cookies['JWToken'] = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6IjQ5NDEyOSIsInJvbGUiOiI4LERlcGFydG1lbnQsLDUyLDQ3OSw2MjI4NywiLCJuYmYiOjE1NTI2NzY0MDAsImV4cCI6MTU1MzI4MTIwMCwiaWF0IjoxNTUyNzM1MTYyLCJpc3MiOiIxMC4zLjIuMzAiLCJhdWQiOiJpdC5icnNjLnJ1In0.42ovgYR9hVKhNqvTFk9oNSwwhStbXvi3dWEElMZtJSI";
$snoopy->submit("https://edu.brsc.ru/User/Diary");
*/


$driver = new \Behat\Mink\Driver\GoutteDriver();

$session = new \Behat\Mink\Session($driver);

$session->start();
$session->visit("https://edu.brsc.ru/Logon/Index");
$session->setCookie("JWToken", "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6IjQ5NDEyOSIsInJvbGUiOiI4LERlcGFydG1lbnQsLDUyLDQ3OSw2MjI4NywiLCJuYmYiOjE1NTI2NzY0MDAsImV4cCI6MTU1MzI4MTIwMCwiaWF0IjoxNTUyNzM1MTYyLCJpc3MiOiIxMC4zLjIuMzAiLCJhdWQiOiJpdC5icnNjLnJ1In0.42ovgYR9hVKhNqvTFk9oNSwwhStbXvi3dWEElMZtJSI");
$session->setRequestHeader("Authorization", "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6IjQ5NDEyOSIsInJvbGUiOiI4LERlcGFydG1lbnQsLDUyLDQ3OSw2MjI4NywiLCJuYmYiOjE1NTI2NzY0MDAsImV4cCI6MTU1MzI4MTIwMCwiaWF0IjoxNTUyNzM1MTYyLCJpc3MiOiIxMC4zLjIuMzAiLCJhdWQiOiJpdC5icnNjLnJ1In0.42ovgYR9hVKhNqvTFk9oNSwwhStbXvi3dWEElMZtJSI");
$session->visit("https://edu.brsc.ru/User/Diary");

echo $session->getPage()->getHtml();
       
