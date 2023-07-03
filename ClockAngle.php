<?php
class ClockAngle {
    public function getClockAngle($hours, $minutes) {
        if ($hours < 0 || $hours > 12 || $minutes < 0 || $minutes > 59) {
            return "Enter hours from 0 to 11, minutes from 0 to 59";
        }

        $hourAngle = 0.5 * (60 * $hours + $minutes);  // Angle covered by the hour hand from 12:00
        $minuteAngle = 6 * $minutes;  // Angle covered by the minute hand from 12:00
        $angleDiff = abs($hourAngle - $minuteAngle); // Absolute difference between the angles

        return min(360 - $angleDiff, $angleDiff); // Choose the smaller angle (angle less than or equal to 180 degrees)
    }
}

$clockAngle = new ClockAngle();
$result = $clockAngle->getClockAngle(11, 59);
echo "Angle between clock hands: $result degrees.";
