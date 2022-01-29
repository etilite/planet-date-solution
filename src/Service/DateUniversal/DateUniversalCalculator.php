<?php


namespace App\Service\DateUniversal;


class DateUniversalCalculator
{
    public function __construct(private DateUniversalInterface $date)
    {
    }

    public function addDate(DateUniversalInterface $date): void
    {
        $this->addDays($date->getDateInDays());
    }

    public function addMonths(int $months): void
    {
        $this->date->addMonths($months);
    }

    public function addDays(int $days): void
    {
        $this->date->setDateInDays($this->date->getDateInDays() + $days);
    }
}