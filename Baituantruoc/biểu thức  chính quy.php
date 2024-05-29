<?php

$str = "Visit Hanoi city";

$pattern = "/Hanoi/i";

echo preg_match($pattern, $str);

$str = "The rain in SPAIN falls mainly on the plains.";

$pattern="/ain/i";

echo preg_match_all($pattern, $str);

?>
