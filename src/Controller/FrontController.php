<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Recipes;
use App\Repository\RecipesRepository;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('front/home.html.twig', [
            'title' => 'Bienvenue les cocos'
        ]);
    }

    /**
     * @Route("/recettes", name="recipes")
     */
    public function recipes(RecipesRepository $repo)
    {
        $recipes = $repo->findAll();
        return $this->render('front/recipes.html.twig', [
            'recipes' => $recipes
        ]);
    }

    /**
     * @Route("/recette/{id}", name="recipe")
     */
    public function recipe(Recipes $recipe)
    {
        return $this->render('front/recipe.html.twig', [
            'recipe' => $recipe
        ]);
    }
}
