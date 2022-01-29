<?php


namespace App\Service\DateUniversal;


class EarthDateUniversal extends AbstractDateUniversal
{
    public const START_OF_THE_TIME = '0001-01-01';

    public function setDateInDays(int $days): void
    {
        $interval = 'P' . $days . 'D';
        $this->addIntervalToDate(self::START_OF_THE_TIME, $interval);
    }

    public function getDateInDays(): int
    {
        $startingDate = new \DateTime(self::START_OF_THE_TIME);
        $interval = $startingDate->diff(new \DateTime($this->date));

        return $interval->days;
    }

    public function addMonths(int $months): void
    {
        $interval = 'P' . $months . 'M';
        $this->addIntervalToDate($this->date, $interval);
    }

    private function addIntervalToDate(string $date, string $interval): void
    {
        $startingDate = new \DateTime($date);
        $startingDate->add(new \DateInterval($interval));

        $this->date = $startingDate->format('Y-m-d');
    }
}