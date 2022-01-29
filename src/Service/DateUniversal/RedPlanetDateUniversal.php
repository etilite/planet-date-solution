<?php


namespace App\Service\DateUniversal;


class RedPlanetDateUniversal extends AbstractPlanetDateUniversal
{
    public const MONTHS_IN_YEAR = 10;
    public const DAYS_IN_MONTH = 42;

    protected function getMonthsInYear(): int
    {
        return self::MONTHS_IN_YEAR;
    }

    protected function getDaysInMonth(): int
    {
        return self::DAYS_IN_MONTH;
    }
}