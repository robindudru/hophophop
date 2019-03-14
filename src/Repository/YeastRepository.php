<?php

namespace App\Repository;

use App\Entity\Yeast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Yeast|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yeast|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yeast[]    findAll()
 * @method Yeast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YeastRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Yeast::class);
    }

    // /**
    //  * @return Yeast[] Returns an array of Yeast objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('y.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Yeast
    {
        return $this->createQueryBuilder('y')
            ->andWhere('y.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
