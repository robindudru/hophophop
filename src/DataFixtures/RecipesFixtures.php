<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Recipes;
use Faker;

class RecipesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for($i=1; $i <= 30; $i++){
            $recipe = new Recipes();
            $recipe->setTitle($faker->sentence(4, false))
                   ->setStyle($faker->numberBetween(1,50))
                   ->setCreatedAt($faker->dateTimeThisDecade('now'))
                   ->setAuthor($faker->firstName().$faker->lastName())
                   ->setMethod("allgrain")
                   ->setBoilTime($faker->numberBetween(60, 120))
                   ->setBatchSize($faker->numberBetween(15, 50))
                   ->setOriginalGravity($faker->numberBetween(1.030, 1.090))
                   ->setFinalGravity($faker->numberBetween(1.008, 1.020))
                   ->setThumbsUp($faker->numberBetween(0, 150))
                   ->setMashGuide($faker->sentence(50, false));
            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
