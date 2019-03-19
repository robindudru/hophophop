<?php

namespace App\Controller;

use App\Entity\Recipes;
use App\Form\RecipeType;
use App\Entity\RecipeHops;
use App\Entity\RecipeMalts;
use App\Entity\RecipeOthers;
use App\Form\EditProfileType;
use App\Repository\RecipesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        $user = $this->getUser();

        return $this->render('front/home.html.twig', [
            'title' => 'Bienvenue les cocos',
            'user' => $user,
            'headerText' => 'Blah blah blah'
        ]);
    }

    /**
     * @Route("/recettes", name="recipes")
     */
    public function recipes(RecipesRepository $repo)
    {
        $user = $this->getUser();
        $recipes = $repo->findAll();
        return $this->render('front/recipes.html.twig', [
            'recipes' => $recipes,
            'user' => $user,
            'headerText' => 'Blah blah blah'
        ]);
    }

     /**
     * @Route("recette/ajouter", name="add_recipe")
     * @Route("recette/{id}/modifier", name="edit_recipe")
     */
    public function formRecipe(Recipes $recipe = null, RecipeMalts $recipeMalts = null, RecipeHops $recipeHops = null, RecipeOthers $recipeOthers = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$recipe){
            $recipe = new Recipes();
            $recipeMalts = new RecipeMalts();
            $recipeHops = new RecipeHops();
            $recipeOthers = new RecipeOthers();
        }
        $user = $this->getUser();

        $form = $this->createForm(RecipeType::class, $recipe); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$recipe->getId()){
                $og = $recipe->getOriginalGravity();
                $fg = $recipe->getFinalGravity(); 
                $alcohol = (76.08 * ($og - $fg) / (1.775 - $og)) * ($fg / 0.794);
                
                $mcus = [];
                $malts = $recipe->getRecipeMalts();
                foreach($malts as $malt) {
                   $mcu = (4.23 * $malt->getWeight() * $malt->getMalt()->getEbc()) / $recipe->getBatchSize();
                   var_dump($mcu);
                    array_push($mcus, $mcu);
                }
                $mcu = array_sum($mcus);
                $ebc = 2.939 * ($mcu ** 0.6859);

                $recipe->setCreatedAt(new \DateTime())
                       ->setAuthor($user)
                       ->setAlcohol($alcohol)
                       ->setColor($ebc)
                       ->setThumbsUp(0)
            ;}
            $manager->persist($recipe);
            $manager->flush();

           return $this->redirectToRoute('recipe', ['id' => $recipe->getId()]);
        }

        return $this->render('front/form-recipe.html.twig', [
            'formRecipe' => $form->createView(),
            'edit' => $recipe->getId() !== null,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/recette/{id}", name="recipe")
     */
    public function recipe(Recipes $recipe)
    {
        $user = $this->getUser();
        return $this->render('front/recipe.html.twig', [
            'recipe' => $recipe,
            'user' => $user,
            'headerText' => 'Blah blah blah'
        ]);
    }

    /**
     * @Route("/editer-profil", name="edit_profile")
     */
    public function formEditProfile(Request $request, ObjectManager $manager)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user); 
        $avatar = $user->getAvatar();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $form->get('avatar')->getData();

            if($file != null) {
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('avatars_folder'),
                        $fileName
                    );
                } catch (FileException $e) {
                   
                }

                $user->setAvatar($fileName);
                unlink('../assets/images/avatars/'.$avatar);
                unlink('../public/build/avatars/'.$avatar);

            }

            else {
                $user->setAvatar($avatar);
            }

            // ... persist the $product variable or any other work


            $manager->persist($user);
            $manager->flush();

        }

        return $this->render('front/form-editProfile.html.twig', [
            'formEditProfile' => $form->createView(),
            'edit' => $user->getId() !== null,
            'user' => $user,
            'headerText' => 'Blah blah blah'
        ]);
    }

     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}
