<?php

namespace App\Service;

use App\Entity\Car;
use Doctrine\ORM\EntityManager;

/**
 * Class DataChecker
 * @package App\Service
 */
class DataChecker
{
    /** var bool */
    private $requireImagesToPromoteCar;

    /** @var EntityManager */
    private $entityManager;

    /**
     * DataChecker constructor.
     *
     * @param EntityManager $entityManager
     * @param boolean $requireImagesToPromoteCar
     */
    public function __construct(
        EntityManager $entityManager,
        $requireImagesToPromoteCar
    ) {
        $this->entityManager = $entityManager;
        $this->requireImagesToPromoteCar = $requireImagesToPromoteCar;
    }

    /**
     * @param Car $car
     *
     * @return string
     */
    public function checkCar(Car $car)
    {
        $promote = true;
        if ($this->requireImagesToPromoteCar && !$car->getImage()) {
            $promote = false;
        }
        $car->setPromote($promote);
        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return $promote;
    }
}