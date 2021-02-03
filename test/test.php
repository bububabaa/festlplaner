<?php
$timestamp=time();
$dtNow = new DateTime();
// Set a non-default timezone if needed
$dtNow->setTimezone(new DateTimeZone('Europe/Berlin'));
$dtNow->setTimestamp($timestamp);

$beginOfDay = clone $dtNow;
$beginOfDay->modify('today');

$endOfDay = clone $beginOfDay;
$endOfDay->modify('tomorrow');
// adjust from the start of next day to the end of the day,
// per original question
// Decremented the second as a long timestamp rather than the
// DateTime object, due to oddities around modifying
// into skipped hours of day-lights-saving.
$endOfDateTimestamp = $endOfDay->getTimestamp();
$endOfDay->setTimestamp($endOfDateTimestamp - 1);

/*var_dump(
    array(
        'time ' => $dtNow->format('Y-m-d H:i:s e'),
        'start' => $beginOfDay->format('Y-m-d H:i:s e'),
        'end  ' => $endOfDay->format('Y-m-d H:i:s e'),
    )
);*/


$heute = $beginOfDay->format('Y-m-d H:i:s');
echo $heute;
?>
