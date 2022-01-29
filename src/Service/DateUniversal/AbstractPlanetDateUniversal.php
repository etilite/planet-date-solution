<?php


namespace App\Service\DateUniversal;


abstract class AbstractPlanetDateUniversal extends AbstractDateUniversal
{

    public function getDateInDays(): int
    {
        $periods = $this->splitDateString($this->date);
        return $periods['days'] + $periods['months'] * $this->getDaysInMonth() + $periods['years'] * $this->getDaysInYear();
    }

    public function setDateInDays(int $days): void
    {
        $year = $this->addLeadingZeroesToLength($this->countYear($days), 4);
        $month = $this->addLeadingZeroesToLength($this->countMonth($days), 2);
        $day = $this->addLeadingZeroesToLength($this->countDay($days), 2);

        $this->date = $year . '-' . $month . '-' . $day;
    }

    public function addMonths(int $months): void
    {
        $daysToAdd = $months * $this->getDaysInMonth();
        $this->setDateInDays($this->getDateInDays() + $daysToAdd);
    }

    protected function getDaysInYear(): int
    {
        return $this->getMonthsInYear() * $this->getDaysInMonth();
    }

    protected function splitDateString(string $date): array
    {
        $dateArr = explode('-', $date);
        return [
            'years' => $this->convertPeriod($dateArr[0]),
            'months' => $this->convertPeriod($dateArr[1]),
            'days' => $this->convertPeriod($dateArr[2])
        ];
    }

    protected function convertPeriod(string $period): int
    {
        return (int) $period - 1;
    }

    protected function countYear(int $days): int
    {
        return intdiv($days, $this->getDaysInYear()) + 1;
    }

    protected function countMonth(int $days): int
    {
        return intdiv($days % $this->getDaysInYear(), $this->getDaysInMonth()) + 1;
    }

    protected function countDay(int $days): int
    {
        return ($days % $this->getDaysInYear()) % $this->getDaysInMonth() + 1;
    }

    protected function addLeadingZeroesToLength(int $period, int $length): string
    {
        return str_pad($period, $length, "0", STR_PAD_LEFT);
    }

    abstract protected function getMonthsInYear(): int;

    abstract protected function getDaysInMonth(): int;
}