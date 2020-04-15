<?php

namespace Tests\Unit\App\Service;

use App\Entity\Car;
use App\Service\DataChecker;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class DataCheckerTest
 * @package App\Tests\Unit\Service
 */
class DataCheckerTest extends TestCase
{
    /* @var EntityManager | MockObject */
    protected $entityManager;

    /* @var Car | MockObject */
    protected $car;

    public function setUp()
    {
        $this->entityManager = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()->getMock();
        $this->car = $this->getMockBuilder(Car::class)
            ->disableOriginalConstructor()
            ->getMock();

    }

    public function testCheckCarWithRequiredPhotosWillReturnFalse()
    {
        $subject = new DataChecker($this->entityManager, true);
        $expectedResult = false;

        $subject->checkCar($this->car);

        $this->car->expects($this->once())->method('setPromote')
            ->with($expectedResult)->willReturnSelf();
        $this->entityManager->expects($this->once())->method('persist')
            ->with($this->car);
        $this->entityManager->expects($this->once())->method('flush');

        $result = $subject->checkCar($this->car);

        $this->assertEquals($expectedResult, $result);

    }
}
