<?php

use App\Models\Participant;

function isActive($path, $active = 'active menu-open')
{
    return call_user_func_array('Request::is', (array)$path) ? $active : '';
}
function isPublished($event_id)
{
    $participant_scores = Participant::where('event_id',$event_id)
    ->where('rank','>','0')
    ->orWhere('rank','!=',null)
    ->orWhere('avg_score' ,'!=',null)
    ->orWhere('avg_score' ,'>','0')
    ->get();
   return count($participant_scores) > 0? true : false;
}
function removeTrailingZeros($number)
{
    if ($number == null || $number == '')
        return null;
    // Remove trailing zeros after the decimal point
    $number = rtrim($number, '0');
     // If the last character is a decimal point, remove it
    if (substr($number, -1) === '.') {
        $number = substr($number, 0, -1);
    }

    return $number;
}
function numberToOrdinal($number)
{
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        return $number . 'th';
    } else {
        switch ($number % 10) {
            case 1:
                return $number . 'st';
            case 2:
                return $number . 'nd';
            case 3:
                return $number . 'rd';
            default:
                return $number . 'th';
        }
    }
}
