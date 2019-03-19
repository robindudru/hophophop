<?php

namespace App\Repository;

use App\Entity\OtherIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method OtherIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtherIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtherIngredient[]    findAll()
 * @method OtherIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtherIngredientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OtherIngredient::class);
    }

    // /**
    //  * @return OtherIngredient[] Returns an array of OtherIngredient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OtherIngredient
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
