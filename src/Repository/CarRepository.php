<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }


    public function findCarsWithDetails()
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, vendor, model');
        $qb->join('c.vendor', 'vendor');
        $qb->join('c.model', 'model');

        return $qb->getQuery()->getResult();
    }

    public function findCarsWithDetailsById($id)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->select('c, vendor, model');
        $qb->join('c.vendor', 'vendor');
        $qb->join('c.model', 'model');
        $qb->where('c.id = :id');
        $qb->setParameter('id', $id);

        return $qb->getQuery()->getSingleResult();
    }
}
