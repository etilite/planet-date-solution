<?php


namespace App\Service\DateUniversal;


interface DateUniversalInterface
{
    public function setDate(string $date): void;

    public function getDate(): string;

    public function setDateInDays(int $days): void;

    public function getDateInDays(): int;

    public function addMonths(int $months): void;
}