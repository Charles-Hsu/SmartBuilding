<?php
$date1=date_create("2013-03-15");
$date2=date_create("2013-12-12");
echo gettype($date1);
$diff=date_diff($date1,$date2);
echo $diff->format("%R%a days");
echo $diff->days;



$start_day = strtotime("2018-01-01");
$end_day = strtotime("2018-01-02");
echo gettype($start_day);
echo gettype($end_day);
$diff = $end_day - $start_day;

echo "<br>";

echo $diff;



?>