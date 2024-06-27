<?php

use Carbon\Carbon;

/* 
 * 
 * formatted_date makes it easier read the dates from the database.
 * 
*/
if (! function_exists('formatted_date')) {
    function formatted_date($date) {
        if ($date->isToday()) {
            return 'Today';
        } elseif ($date->isYesterday()) {
            return 'Yesterday';
        } elseif ($date->diffInDays() < 7) {
            return $date->diffForHumans();
        } else {
            return $date->format('F j, Y');
        }
    }
}