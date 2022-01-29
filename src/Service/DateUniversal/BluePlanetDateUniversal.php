<?php


namespace App\Service\DateUniversal;


class BluePlanetDateUniversal extends AbstractPlanetDateUniversal
{
    public const MONTHS_IN_YEAR = 18;
    public const DAYS_IN_MONTH = 18;

    protected function getMonthsInYear(): int
    {
        return self::MONTHS_IN_YEAR;
    }

    protected function getDaysInMonth(): int
    {
        return self::DAYS_IN_MONTH;
    }
}