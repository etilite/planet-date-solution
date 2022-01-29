<?php


namespace App\Service\DateUniversal;


class DateUniversalConverter
{
    public static function convertDate(DateUniversalInterface $from, DateUniversalInterface $to): DateUniversalInterface
    {
        $to->setDateInDays($from->getDateInDays());

        return $to;
    }
}