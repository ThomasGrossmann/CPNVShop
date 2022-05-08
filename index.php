<?php
/*
 * Program : CPNVShop - Demo Program
 * Author : Thomas Grossmann
 * Date : 08.05.2022
 */

/*$dWednesday = '2016-05-11T12:22:11.824';
$dThursday = '2016-05-12T12:22:11.824';
$dSaturday = '2016-05-14T09:15:00.000';
$dSunday = '2016-05-15T09:15:00.000';
$dFriday_morning = '2016-05-13T08:00:00.000';
$dMonday_morning = '2016-05-16T08:00:00.000';
$dThursday_afternoon = '2016-05-12T14:00:00.000';*/

$openingHours = [
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

//$date = date('D H:i');
$date = 'Tue 18:34';

function IsOpenOn($date, $openingHours)
{
    $dateStr = substr($date, 0, 3);
    $timeStr = substr($date, 4, 5);
    foreach ($openingHours as $openingHour) {
        if (($dateStr == $openingHour[0]) && ((($timeStr >= $openingHour[1]) && ($timeStr <= $openingHour[2])) || (($timeStr >= $openingHour[3]) && ($timeStr <= $openingHour[4])))) {
            return true;
        }
    }
    return false;
}

function NextOpeningDate($date, $openingHours)
{
    $dateStr = substr($date, 0, 3);
    $timeStr = substr($date, 4, 5);
    if (!IsOpenOn($date, $openingHours)) {
        echo "<h2>Next opening : </h2><br><br>";
    }
}

?>
<style>
    table, th, td {
        border: 1px solid black;
    }
</style>
<div>
    <h1>Opening Hours - CPNVShop</h1><br><br>
    <h2>The shop is currently <?php if (IsOpenOn($date, $openingHours)) {
            echo "open !";
        } else {
            echo "closed.";
        } ?></h2><br><br>
    <?= NextOpeningDate($date, $openingHours) ?>
    <h3>Schedule : </h3>
    <table>
        <thead>
        <tr>
            <th>Days</th>
            <th>Hours</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($openingHours as $openingHour) { ?>
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