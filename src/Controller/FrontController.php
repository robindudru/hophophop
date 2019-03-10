<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Recipes;
use App\Form\RecipeType;
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
     * @Route("recette/ajouter", name="add_recipe")
     * @Route("recette/{id}/modifier", name="edit_recipe")
     */
    public function formRecipe(Recipes $recipe = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$recipe){
            $recipe = new Recipes();
        }
        $user = $this->getUser();

        $form = $this->createForm(RecipeType::class, $recipe); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$recipe->getId()){ 
                $og = $recipe->getOriginalGravity();
                $fg = $recipe->getFinalGravity(); 
                $alcohol = (76.08 * ($og - $fg) / (1.775 - $og)) * ($fg / 0.794);
                $recipe->setCreatedAt(new \DateTime())
                       ->setAuthor($user->getUsername())
                       ->setAlcohol($alcohol)
                       ->setColor(25)
                       ->setThumbsUp(0)
                       ->setMalts([1])
                       ->setHops([1])
                       ->setYeast([1])
                       ->setOtherIngredients([1]);
            }
            $manager->persist($recipe);
            $manager->flush();

           // return $this->redirectToRoute('recipe', ['id' => $recipe->getId()]);
        }

        return $this->render('front/form-recipe.html.twig', [
            'formRecipe' => $form->createView(),
            'edit' => $recipe->getId() !== null
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
