<?php

namespace App\Controller;

use Exception;
use App\Entity\Hop;
use App\Entity\Malt;
use App\Entity\Yeast;
use App\Form\HopType;
use App\Form\MaltType;
use App\Entity\Comment;
use App\Entity\Recipes;
use App\Form\YeastType;
use App\Form\DeleteType;
use App\Form\RecipeType;
use App\Form\CommentType;
use App\Entity\RecipeHops;
use App\Entity\RecipeMalts;
use App\Entity\RecipeOthers;
use App\Entity\RecipesFilter;
use App\Form\EditProfileType;
use App\Entity\OtherIngredient;
use App\Form\RecipesFilterType;
use App\Form\OtherIngredientType;
use App\Repository\RecipesRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function home(RecipesRepository $repo, Request $request)
    {
        $user = $this->getUser();
        $lastRecipes = $repo->findLastThree();
        $userRecipes = $repo->findUserOnes($user);
        return $this->render('front/home.html.twig', [
            'headerText' => 'BrewMate: Recettes de biere participatives',
            'user' => $user,
            'lastRecipes' => $lastRecipes,
            'userRecipes' => $userRecipes,
            'referer' => $request->headers->get('referer')
        ]);
    }

    /**
     * @Route("/recettes", name="recipes")
     */
    public function recipes(RecipesRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $user = $this->getUser();

        $filter = new RecipesFilter();
        $form = $this->createForm(RecipesFilterType::class, $filter);
        $form->handleRequest($request);

        $recipes = $paginator->paginate(
            $repo->findAllRecipesQuery($filter),
            $request->query->getInt('page', 1),
            18
        );

        return $this->render('front/recipes.html.twig', [
            'recipes' => $recipes,
            'user' => $user,
            'recipesFilter' => $form->createView(),
            'referer' => $request->headers->get('referer') 
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

                if (count($recipe->getRecipeHops()) > 1) {
                    $difficulty = 'expert';
                }
                else if (count($recipe->getRecipeHops() === 1)) {
                    $difficulty = 'confirmed';
                }
                else {
                    $difficulty = 'beginner';
                }
                $recipe->setCreatedAt(new \DateTime())
                       ->setAuthor($user)
                       ->setAlcohol($alcohol)
                       ->setColor($ebc)
                       ->setThumbsUp(0)
                       ->setDifficulty($difficulty)
            ;}
            if ($recipe->getAuthor() === $user || in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->persist($recipe);
                $manager->flush();
            }
           return $this->redirectToRoute('recipe', ['id' => $recipe->getId()]);
        }

        return $this->render('front/forms/form-recipe.html.twig', [
            'formRecipe' => $form->createView(),
            'edit' => $recipe->getId() !== null,
            'user' => $user,
        ]);
    }

    /**
     * @Route("recette/{id}/supprimer", name="delete_recipe")
     */
    public function deleteRecipe(Recipes $recipe, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($recipe->getAuthor() === $user || in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($recipe);
                $manager->flush();
            }
            else {
                throw new Exception('Tututut, c\'est pas ta recette !');
            }
           return $this->redirectToRoute('recipes');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'recipe' => $recipe
            ]);
        }
    }

    /**
     * @Route("commentaire/{id}/supprimer", name="delete_comment")
     */
    public function deleteComment(Comment $comment, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $id = $comment->getArticle()->getId();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($comment);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('recipe', ['id' => $id]);
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'comment' => $comment
            ]);
        }
    }

    /**
     * @Route("/recette/{id}", name="recipe")
     */
    public function recipe(Recipes $recipe, Comment $comment = null, Request $request, ObjectManager $manager)
    {
        if(!$comment){
            $comment = new Comment();
        }
        $user = $this->getUser();

        $form = $this->createForm(CommentType::class, $comment); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $comment->setCreatedAt(new \DateTime())
                       ->setAuthor($user)
                       ->setThumbsUp(0)
                       ->setArticle($recipe);
            
                $manager->persist($comment);
                $manager->flush();
        }

        return $this->render('front/recipe.html.twig', [
            'recipe' => $recipe,
            'user' => $user,
            'comment' => $comment,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/malt/ajouter", name="add_malt")
     * @Route("admin/malt/{id}/modifier", name="edit_malt")
     */
    public function formMalt(Malt $malt = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if(!$malt){
            $malt = new Malt();
        }

        $form = $this->createForm(MaltType::class, $malt); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $malt->setApproved(true);
            }
            else{
                $malt->setApproved(false);
            }
            $manager->persist($malt);
            $manager->flush();

           return $this->redirectToRoute('home', [
            'referer' => $request->headers->get('referer'),
           ]);
        }

        return $this->render('front/forms/form-malt.html.twig', [
            'formMalt' => $form->createView(),
            'edit' => $malt->getId() !== null,
            'user' => $this->getUser(),
            'headerText' => 'Ajouter un malt'
        ]);
    }

    /**
     * @Route("/houblon/ajouter", name="add_hop")
     * @Route("admin/houblon/{id}/modifier", name="edit_hop")
     */
    public function formHop(Hop $hop = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if(!$hop){
            $hop = new Hop();
        }

        $form = $this->createForm(HopType::class, $hop); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $hop->setApproved(true);
            }
            else{
                $hop->setApproved(false);
            }
            $manager->persist($hop);
            $manager->flush();

           return $this->redirectToRoute('home', [
            'referer' => $request->headers->get('referer'),
           ]);
        }

        return $this->render('front/forms/form-hop.html.twig', [
            'formHop' => $form->createView(),
            'edit' => $hop->getId() !== null,
            'user' => $this->getUser(),
            'headerText' => 'Ajouter un houblon'
        ]);
    }

    /**
     * @Route("/autre/ajouter", name="add_other")
     * @Route("admin/autre/{id}/modifier", name="edit_other")
     */
    public function formOther(OtherIngredient $other = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if(!$other){
            $other = new OtherIngredient();
        }

        $form = $this->createForm(OtherIngredientType::class, $other); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $other->setApproved(true);
            }
            else{
                $other->setApproved(false);
            }
            $manager->persist($other);
            $manager->flush();

           return $this->redirectToRoute('home', [
            'referer' => $request->headers->get('referer'),
           ]);
        }

        return $this->render('front/forms/form-other.html.twig', [
            'formOther' => $form->createView(),
            'edit' => $other->getId() !== null,
            'user' => $this->getUser(),
            'headerText' => 'Ajouter un autre ingredient'
        ]);
    }

    /**
     * @Route("/levure/ajouter", name="add_yeast")
     * @Route("admin/levure/{id}/modifier", name="edit_yeast")
     */
    public function formYeast(Yeast $yeast = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if(!$yeast){
            $yeast = new Yeast();
        }

        $form = $this->createForm(YeastType::class, $yeast); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $yeast->setApproved(true);
            }
            else{
                $yeast->setApproved(false);
            }
            $manager->persist($yeast);
            $manager->flush();

           return $this->redirectToRoute('home', [
            'referer' => $request->headers->get('referer'),
           ]);
        }

        return $this->render('front/forms/form-yeast.html.twig', [
            'formYeast' => $form->createView(),
            'edit' => $yeast->getId() !== null,
            'user' => $this->getUser(),
            'headerText' => 'Ajouter une levure'
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
            }

            else {
                $user->setAvatar($avatar);
            }

            $manager->persist($user);
            $manager->flush();

        }

        return $this->render('front/forms/form-editProfile.html.twig', [
            'formEditProfile' => $form->createView(),
            'edit' => $user->getId() !== null,
            'user' => $user,
            'headerText' => 'Editer mon profil'
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
