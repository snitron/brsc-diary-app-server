eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJJZCI6IjQ5NDEyOSIsInJvbGUiOiI4LERlcGFydG1lbnQsLDUyLDQ3OSw2MjI4NywiLCJuYmYiOjE1NTI2NzY0MDAsImV4cCI6MTU1MzI4MTIwMCwiaWF0IjoxNTUyNzM1MTYyLCJpc3MiOiIxMC4zLjIuMzAiLCJhdWQiOiJpdC5icnNjLnJ1In0.42ovgYR9hVKhNqvTFk9oNSwwhStbXvi3dWEElMZtJSI

<?php
require __DIR__ . "/../vendor/autoload.php";


use Snoopy\Snoopy;


$headers = getallheaders();

        $snoopy = new Snoopy();
       
        $snoopy->maxredirs = 2;
        $snoopy->submit("https://edu.brsc.ru/Logon/Index", $post_array);
        $snoopy->submit("https://edu.brsc.ru/User/Diary");
       
