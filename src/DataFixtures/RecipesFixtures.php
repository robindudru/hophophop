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
                   ->setMethod("Tout Grain")
                   ->setBoilTime(90)
                   ->setBatchSize(20)
                   ->setOriginalGravity(1050)
                   ->setFinalGravity(1012)
                   ->setAlcohol(5.5)
                   ->setColor($faker->numberBetween(1,60))
                   ->setThumbsUp(32)
                   ->setMalts([42,2])
                   ->setHops([32, 56, 32])
                   ->setYeast([43])
                   ->setOtherIngredients([3])
                   ->setMashGuide('');

            $manager->persist($recipe);
        }

        $manager->flush();
    }
}
