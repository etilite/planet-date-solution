<?php


namespace App\Service\DateUniversal;


abstract class AbstractDateUniversal implements DateUniversalInterface
{
    protected string $date;

    public function __construct(string $date)
    {
        $this->setDate($date);
    }

    public function setDate(string $date): void
    {
        if(!preg_match("/\d{4}-\d{2}-\d{2}/", $date)) {
            throw new \InvalidArgumentException(sprintf('Invalid date format "%s"', $date));
        }

        $this->date = $date;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    abstract public function setDateInDays(int $days): void;

    abstract public function getDateInDays(): int;

    abstract public function addMonths(int $months): void;
}