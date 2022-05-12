<?php
/*
 * Program : CPNVShop - Demo Program
 * Author : Thomas Grossmann
 * Date : 08.05.2022
 */

const OPENINGHOURS = [
    0 => [
        "Mon", "08:00", "16:00"
    ],
    1 => [
        "Tue", "08:00", "12:00", "14:00", "18:00"
    ],
    2 => [
        "Wed", "08:00", "16:00"
    ],
    3 => [
        "Thu", "08:00", "12:00", "14:00", "18:00"
    ],
    4 => [
        "Fri", "08:00", "16:00"
    ],
    5 => [
        "Sat", "08:00", "12:00"
    ],
    6 => [
        "Sun", "Closed"
    ]
];

//Array of all the different opening hours

//$date = date('D H:i');
$date = 'Tue 07:34';    //Testing purpose for "If shop is closed"

function IsOpenOn($date)
{
    $dateStr = substr($date, 0, 3);
    $timeStr = substr($date, 4, 5);
    foreach (OPENINGHOURS as $openingHour) {
        if (($dateStr == $openingHour[0]) && ((($timeStr >= $openingHour[1]) && ($timeStr <= $openingHour[2])) || (($timeStr >= $openingHour[3]) && ($timeStr <= $openingHour[4])))) {
            return true;
        }
    }
    return false;
}

function NextOpeningDate($date)
{
    $dateStr = substr($date, 0, 3);
    $timeStr = substr($date, 4, 5);
    foreach (OPENINGHOURS as $openingHour) {
        switch ($dateStr) {
            case "Mon":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[1];
                } else {
                    $nextOpening = "Tue at " . $openingHour[1];
                }
                return $nextOpening;
            case "Tue":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[3];
                } elseif (($dateStr == $openingHour[0]) && (($timeStr > $openingHour[2]) && ($timeStr < $openingHour[3]))) {
                    $nextOpening = " at " . $openingHour[1];
                } else {
                    $nextOpening = "Wed at " . $openingHour[1];
                }
                return $nextOpening;
            case "Wed":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[1];
                } else {
                    $nextOpening = "Thu at " . $openingHour[1];
                }
                return $nextOpening;
            case "Thu":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[3];
                } elseif (($dateStr == $openingHour[0]) && (($timeStr > $openingHour[2]) && ($timeStr < $openingHour[3]))) {
                    $nextOpening = " at " . $openingHour[1];
                } else {
                    $nextOpening = "Fri at " . $openingHour[1];
                }
                return $nextOpening;
            case "Fri":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[1];
                } else {
                    $nextOpening = "Sat at " . $openingHour[1];
                }
                return $nextOpening;
            case "Sat":
                if (($dateStr == $openingHour[0]) && ($timeStr < $openingHour[1])) {
                    $nextOpening = $openingHour[0] . " at " . $openingHour[1];
                } else {
                    $nextOpening = "Mon at " . $openingHour[1];
                }
                return $nextOpening;
            case "Sun":
                $nextOpening = "Mon at 08:00";
                return $nextOpening;
        }
    }
}

?>
<style>
    table, th, td {
        border: 1px solid black;
        text-align: center;
    }

    th {
        background-color: cadetblue;
    }
</style>
<div>
    <h1>Opening Hours - CPNVShop</h1><br><br>
    <h2>The shop is currently <?php if (IsOpenOn($date)) {
            echo "open !";
        } else {
            echo "closed.";
        } ?></h2><br><br>
    <h2>Next opening : <?= NextOpeningDate($date) ?></h2><br><br>
    <h3>Schedule : </h3>
    <table>
        <thead>
        <tr>
            <th>Days</th>
            <th>Hours</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (OPENINGHOURS as $openingHour) { ?>
            <tr>
                <td>
                    <?= $openingHour[0] ?>
                </td>
                <td>
                    <?= $openingHour[1];
                    if (isset($openingHour[2])) {
                        echo " - " . $openingHour[2];
                        if (isset($openingHour[3])) {
                            echo " and " . $openingHour[3] . " - " . $openingHour[4];
                        }
                    } ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>