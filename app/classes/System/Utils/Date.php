<?php namespace System\Utils;

use \DateTime;

class Date
{

    public function getCurrentDate()
    {
        $currentDate = new DateTime();
        $timezone = new \DateTimeZone('Europe/Amsterdam');
        $currentDate->setTimezone($timezone);
        return $currentDate;
    }

}