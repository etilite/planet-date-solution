<?php

namespace App\Tests\Service\DateUniversal;

use App\Service\DateUniversal\BluePlanetDateUniversal;
use App\Service\DateUniversal\DateUniversalCalculator;
use App\Service\DateUniversal\EarthDateUniversal;
use App\Service\DateUniversal\RedPlanetDateUniversal;
use Generator;
use PHPUnit\Framework\TestCase;

class DateUniversalCalculatorTest extends TestCase
{

    /**
     * @dataProvider provideDateForAddMonths
     * @param $date
     * @param $months
     * @param $resultDate
     */
    public function testAddMonths($date, $months, $resultDate)
    {
        $calculator = new DateUniversalCalculator($date);
        $calculator->addMonths($months);

        $this->assertEquals($resultDate, $date->getDate());
    }

    /**
     * @dataProvider provideDateForAddDate
     * @param $date
     * @param $resultDate
     */
    public function testAddDate($date, $resultDate)
    {
        $calculator = new DateUniversalCalculator($date);
        $calculator->addDate($date);

        $this->assertEquals($resultDate, $date->getDate());
    }

    /**
     * @dataProvider provideDateForAddDays
     * @param $date
     * @param $days
     * @param $resultDate
     */
    public function testAddDays($date, $days, $resultDate)
    {
        $calculator = new DateUniversalCalculator($date);
        $calculator->addDays($days);

        $this->assertEquals($resultDate, $date->getDate());
    }

    /**
     * @return Generator
     */
    public function provideDateForAddMonths(): iterable
    {
        yield ['date' => new EarthDateUniversal('0001-01-01'), 'months' => 12, 'resultDate' => '0002-01-01'];
        yield ['date' => new RedPlanetDateUniversal('0001-01-01'), 'months' => 10, 'resultDate' => '0002-01-01'];
        yield ['date' => new BluePlanetDateUniversal('0001-01-01'), 'months' => 18, 'resultDate' => '0002-01-01'];

    }

    /**
     * @return Generator
     */
    public function provideDateForAddDate(): iterable
    {
        yield ['date' => new EarthDateUniversal('0001-01-02'), 'resultDate' => '0001-01-03'];
        yield ['date' => new RedPlanetDateUniversal('0001-01-42'), 'resultDate' => '0001-02-41'];
        yield ['date' => new BluePlanetDateUniversal('0004-10-01'), 'resultDate' => '0008-01-01'];

    }

    /**
     * @return Generator
     */
    public function provideDateForAddDays(): iterable
    {
        yield ['date' => new EarthDateUniversal('0001-01-01'), 'days' => 366, 'resultDate' => '0002-01-02'];
        yield ['date' => new RedPlanetDateUniversal('0001-01-01'), 'days' => 421, 'resultDate' => '0002-01-02'];
        yield ['date' => new BluePlanetDateUniversal('0001-01-01'), 'days' => 325, 'resultDate' => '0002-01-02'];

    }
}
