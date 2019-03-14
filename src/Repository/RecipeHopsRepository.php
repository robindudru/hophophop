<?php

namespace App\Repository;

use App\Entity\RecipeHops;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RecipeHops|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipeHops|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipeHops[]    findAll()
 * @method RecipeHops[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipeHopsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RecipeHops::class);
    }

    // /**
    //  * @return RecipeHops[] Returns an array of RecipeHops objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RecipeHops
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
