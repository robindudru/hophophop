<?php

namespace App\Repository;

use App\Entity\MaltTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MaltTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method MaltTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method MaltTypes[]    findAll()
 * @method MaltTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaltTypesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MaltTypes::class);
    }

    // /**
    //  * @return MaltTypes[] Returns an array of MaltTypes objects
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
    public function findOneBySomeField($value): ?MaltTypes
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
