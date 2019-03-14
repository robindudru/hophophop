<?php

namespace App\Repository;

use App\Entity\Malt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Malt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Malt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Malt[]    findAll()
 * @method Malt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaltRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Malt::class);
    }

    // /**
    //  * @return Malt[] Returns an array of Malt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Malt
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
