<?php

namespace App\Repository;

use App\Entity\Recipes;
use App\Entity\RecipesFilter;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Recipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipes[]    findAll()
 * @method Recipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipes::class);
    }
    
    public function findAllRecipesQuery(RecipesFilter $filter)
    {
        $query=  $this->findRecipesQuery();
        
        if($filter->getStyle()) {
            $query = $query
                ->where('p.style = :style')
                ->setParameter('style', $filter->getStyle());
        }

        if($filter->getMethod()) {
            $query = $query
                ->where('p.method = :method')
                ->setParameter('method', $filter->getMethod());
        }

        if($filter->getDifficulty()) {
            if ($filter->getDifficulty() == 'beginner') {
                $query = $query
                    ->where('p.method = :method')
                    ->setParameter('method', 'kit');
            }
            else if ($filter->getDifficulty() == 'confirmed') {
                $query = $query->where('ARRAY_LENGTH(p.recipeHops) = 1');
            }
            else if($filter->getDifficulty() == 'expert') {
                $query = $query->where('ARRAY_LENGTH(p.recipeHops) > 1');
            }
        }
        
        return $query->getQuery();
    }

    private function findRecipesQuery()
    {
        return $this->createQueryBuilder('p');
    }
    // /**
    //  * @return Recipes[] Returns an array of Recipes objects
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
    public function findOneBySomeField($value): ?Recipes
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
