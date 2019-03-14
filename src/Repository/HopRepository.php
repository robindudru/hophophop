<?php

namespace App\Repository;

use App\Entity\Hop;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Hop|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hop|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hop[]    findAll()
 * @method Hop[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HopRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Hop::class);
    }

    // /**
    //  * @return Hop[] Returns an array of Hop objects
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
    public function findOneBySomeField($value): ?Hop
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
