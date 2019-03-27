<?php

namespace App\Repository;

use App\Entity\HopTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HopType|null find($id, $lockMode = null, $lockVersion = null)
 * @method HopType|null findOneBy(array $criteria, array $orderBy = null)
 * @method HopType[]    findAll()
 * @method HopType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HopTypesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HopTypes::class);
    }

    // /**
    //  * @return HopTypes[] Returns an array of HopTypes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HopTypes
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
