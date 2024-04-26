<?php

namespace App\Tests\Integration\DAL\Reader;

use App\DAL\Reader\Doctrine\ToyCarReader;
use App\DAL\Writer\Doctrine\ToyCarWriter;
use App\Model\CarManufacturer;
use App\Model\ToyCar;
use App\Model\ToyColor;

class ToyCarReaderTest extends DataReaderTestBase
{
    public function setUp(): void
    {
        $this->createToyCar();;
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testCanReadToyCars()
    {
        $reader = $this->getServiceContainer()->get(ToyCarReader::class);
        $toyCarsFromDb = $reader->getAll();

        /** @var \App\Model\ToyCar $toyCar */
        foreach ($toyCarsFromDb as $toyCar) {
            $this->assertIsInt($toyCar->getId());
            $this->assertNotNull($toyCar->getName());
            $this->assertNotNull($toyCar->getYear());
            $this->assertInstanceOf(ToyColor::class, $toyCar->getColour());
            $this->assertInstanceOf(CarManufacturer::class, $toyCar->getManufacturer());
        }
    }

    public function createToyCar(): void
    {
        $toyCar1 = new ToyCar();
        $toyCar1->setName("ABC123");

        $m1 = new CarManufacturer();
        $m1->setId(1);
        $c1 = new ToyColor();
        $c1->setId(1);

        $toyCar1->setManufacturer($m1);
        $toyCar1->setColour($c1);
        $toyCar1->setYear(1998);

        $container  = self::getContainer();
        $writer     = $container->get(ToyCarWriter::class);
        $writer->write($toyCar1);
    }
}