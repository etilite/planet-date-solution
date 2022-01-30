<?php

namespace App\Tests\Service\DateUniversal;

use App\Service\DateUniversal\BluePlanetDateUniversal;
use App\Service\DateUniversal\DateUniversalConverter;
use App\Service\DateUniversal\EarthDateUniversal;
use App\Service\DateUniversal\RedPlanetDateUniversal;
use Generator;
use PHPUnit\Framework\TestCase;

class DateUniversalConverterTest extends TestCase
{
    /**
     * @dataProvider provideDateEarthRed
     * @param $date
     * @param $resultDate
     */
    public function testConvertDateEarthRed($date, $resultDate)
    {
        $from = new EarthDateUniversal($date);
        $to = new RedPlanetDateUniversal('0000-00-00');
        $convertedDate = DateUniversalConverter::convertDate($from, $to);

        $this->assertInstanceOf(RedPlanetDateUniversal::class, $convertedDate);
        $this->assertEquals($resultDate, $convertedDate->getDate());
    }

    /**
     * @dataProvider provideDateRedBlue
     * @param $date
     * @param $resultDate
     */
    public function testConvertDateRedBlue($date, $resultDate)
    {
        $from = new RedPlanetDateUniversal($date);
        $to = new BluePlanetDateUniversal('0000-00-00');
        $convertedDate = DateUniversalConverter::convertDate($from, $to);

        $this->assertInstanceOf(BluePlanetDateUniversal::class, $convertedDate);
        $this->assertEquals($resultDate, $convertedDate->getDate());
    }

    /**
     * @dataProvider provideDateBlueEarth
     * @param $date
     * @param $resultDate
     */
    public function testConvertDateBlueEarth($date, $resultDate)
    {
        $from = new BluePlanetDateUniversal($date);
        $to = new EarthDateUniversal('0000-00-00');
        $convertedDate = DateUniversalConverter::convertDate($from, $to);

        $this->assertInstanceOf(EarthDateUniversal::class, $convertedDate);
        $this->assertEquals($resultDate, $convertedDate->getDate());
    }

    /**
     * @dataProvider provideDateUniversal
     * @param $date
     * @param $from
     * @param $to
     */
    public function testConvertDateToSameFormat($date, $from, $to)
    {
        $convertedDate = DateUniversalConverter::convertDate($from, $to);

        $this->assertInstanceOf($to::class, $convertedDate);
        $this->assertEquals($date, $convertedDate->getDate());
    }

    /**
     * @return Generator
     */
    public function provideDateEarthRed(): iterable
    {
        yield ['date' => '0001-01-01', 'resultDate' => '0001-01-01'];
        yield ['date' => '0001-02-01', 'resultDate' => '0001-01-32'];
        yield ['date' => '0002-02-15', 'resultDate' => '0001-10-33'];
    }

    /**
     * @return Generator
     */
    public function provideDateRedBlue(): iterable
    {
        yield ['date' => '0001-01-01', 'resultDate' => '0001-01-01'];
        yield ['date' => '0001-02-01', 'resultDate' => '0001-03-07'];
        yield ['date' => '0002-02-15', 'resultDate' => '0002-09-09'];
    }


    /**
     * @return Generator
     */
    public function provideDateBlueEarth(): iterable
    {
        yield ['date' => '0001-01-01', 'resultDate' => '0001-01-01'];
        yield ['date' => '0001-02-01', 'resultDate' => '0001-01-19'];
        yield ['date' => '0002-02-15', 'resultDate' => '0001-12-23'];
    }

    /**
     * @return Generator
     */
    public function provideDateUniversal(): iterable
    {
        foreach (['0001-01-01', '2001-01-01', '0001-02-01'] as $date) {
            yield [
                'date' => $date,
                'from' => new EarthDateUniversal($date),
                'to' => new EarthDateUniversal('0000-00-00')
            ];
            yield [
                'date' => $date,
                'from' => new RedPlanetDateUniversal($date),
                'to' => new RedPlanetDateUniversal('0000-00-00')
            ];
            yield [
                'date' => $date,
                'from' => new BluePlanetDateUniversal($date),
                'to' => new BluePlanetDateUniversal('0000-00-00')
            ];
        }
    }
}
