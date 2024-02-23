<?php

namespace App\Helpers;

/**
 * -----------------------------------------------------------------------
 *  timeSpan ()
 * -----------------------------------------------------------------------
 */
if ( ! function_exists('timeSpan'))
{
    function timeSpan($seconds = 1, $time = '', $units = 7)
    {
        is_numeric($seconds) or $seconds = 1;
        is_numeric($time)    or $time    = time();
        is_numeric($units)   or $units   = 7;

        $seconds = ($time <= $seconds) ? 1 : $time - $seconds;

        $str   = [];

        $years = floor($seconds / 31557600);

        if ($years > 0)
        {
            $str[] = $years . ' ' . lang($years > 1 ? 'Date.dateYears' : 'Date.dateYear');
        }

        $seconds -= $years * 31557600;

        $months = floor($seconds / 2629743);

        if (count($str) < $units && ($years > 0 or $months > 0))
        {
            if ($months > 0)
            {
                $str[] = $months . ' ' . lang($months > 1 ? 'Date.dateMonths' : 'Date.dateMonth');
            }

            $seconds -= $months * 2629743;
        }

        $weeks = floor($seconds / 604800);

        if (count($str) < $units && ($years > 0 or $months > 0 or $weeks > 0))
        {
            if ($weeks > 0)
            {
                $str[] = $weeks . ' ' . lang($weeks > 1 ? 'Date.dateWeeks' : 'Date.dateWeek');
            }

            $seconds -= $weeks * 604800;
        }

        $days = floor($seconds / 86400);

        if (count($str) < $units && ($months > 0 or $weeks > 0 or $days > 0))
        {
            if ($days > 0)
            {
                $str[] = $days . ' ' . lang($days > 1 ? 'Date.dateDays' : 'Date.dateDay');
            }

            $seconds -= $days * 86400;
        }

        $hours = floor($seconds / 3600);

        if (count($str) < $units && ($days > 0 or $hours > 0))
        {
            if ($hours > 0)
            {
                $str[] = $hours . ' ' . lang($hours > 1 ? 'Date.dateHours' : 'Date.dateHour');
            }

            $seconds -= $hours * 3600;
        }

        $minutes = floor($seconds / 60);

        if (count($str) < $units && ($days > 0 or $hours > 0 or $minutes > 0))
        {
            if ($minutes > 0)
            {
                $str[] = $minutes . ' ' . lang($minutes > 1 ? 'Date.dateMinutes' : 'Date.dateMinute');
            }
            $seconds -= $minutes * 60;
        }

        if (count($str) === 0)
        {
            $str[] = $seconds . ' ' . lang($seconds > 1 ? 'Date.dateSeconds' : 'Date.dateSecond');
        }

        return implode(', ', $str);
    }
}

/**
 * -----------------------------------------------------------------------
 * Filename: time_helper.php
 * Location: ./app/Helpers/time_helper.php
 * -----------------------------------------------------------------------
 */ 