<?php

use App\Projects\DgmeStudents\Helpers\Date;

/**
 * Show date
 *
 * @param \Carbon\Carbon|string $date
 * @return mixed
 */
function formatDate($date)
{
    return Date::formatted($date);
}

/**
 * Show time
 *
 * @param \Carbon\Carbon|string $date
 * @return mixed
 */
function formatDateTime($date)
{
    return Date::formattedDateTime($date);
}

function transformBooleans($value){
    if ($value == 1) {
        return 'Yes';
    }
    if ($value == 0) {
        return 'No';
    }
}