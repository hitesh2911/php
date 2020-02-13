<?php

try {
    $year = $_REQUEST['year'];
    $month = $_REQUEST['month'];
    $partition_name = $_REQUEST['partitionName'];
    $engineName = $_REQUEST['engineName'];


    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            $dateLimit = 31;
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            $dateLimit = 30;
            break;
        case 2:
            if ((0 == $year % 4) and (0 != $year % 100) or (0 == $year % 400))
                $dateLimit = 29;
            else
                $dateLimit = 28;
            break;
    }


    for ($i = 01; $i <= $dateLimit; $i++) {
        $j = $i + 1;
        $date = "$j-$month-$year";

        if ($i == $dateLimit) {
            
            if ($month == 12) {
                $year = $year + 1;
                $month = 1;
            } else
                $month = $month + 1;


            $date = "01-$month-$year";
        }


        $time = strtotime($date) * 1000;

        echo "<br>PARTITION $partition_name" . $year . "$month$i VALUES LESS THAN ($time) ENGINE = $engineName,";
    }
} catch (Exception $e) {
    echo "Something went wrong, exception => " . $e->getTraceAsString();
}
?>
