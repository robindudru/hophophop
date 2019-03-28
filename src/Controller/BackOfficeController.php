<?php

namespace App\Controller;

use App\Entity\Hop;
use App\Entity\Malt;
use App\Entity\Yeast;
use App\Form\MaltType;
use App\Entity\Tutorial;
use App\Form\DeleteType;
use App\Form\ApproveType;
use App\Form\TutorialType;
use App\Entity\OtherIngredient;
use App\Repository\HopRepository;
use App\Repository\MaltRepository;
use App\Repository\YeastRepository;
use App\Repository\OtherIngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackOfficeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(MaltRepository $maltRepo, HopRepository $hopRepo, OtherIngredientRepository $otherRepo, YeastRepository $yeastRepo, Request $request)
    {
        $maltsToValidate = $maltRepo->findBy(['approved' => false]);
        $hopsToValidate = $hopRepo->findBy(['approved' => false]);
        $othersToValidate = $otherRepo->findBy(['approved' => false]);
        $yeastsToValidate = $yeastRepo->findBy(['approved' => false]);

        return $this->render('admin/index.html.twig', [
            'user' => $this->getUser(),
            'headerText' => 'BrewMate: Administration',
            'malts' => $maltsToValidate,
            'hops' => $hopsToValidate,
            'others' => $othersToValidate,
            'yeasts' => $yeastsToValidate,
            'referer' => $request->headers->get('referer')
        ]);
    }

    

    /**
     * @Route("admin/tutoriel/ajouter", name="add_tutorial")
     * @Route("admin/tutoriel/{id}/modifier", name="edit_tutorial")
     */

     public function formTutorial(Tutorial $tutorial = null, Request $request, ObjectManager $manager)
     {
        if(!$tutorial){
            $tutorial = new Tutorial();
        }

        $user = $this->getUser();

        $form = $this->createForm(TutorialType::class, $tutorial); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(!$tutorial->getId()){
                $tutorial->setAuthor($user)
            ;}
            if ($tutorial->getAuthor() === $user || in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->persist($tutorial);
                $manager->flush();
            }
           return $this->redirectToRoute('tutorial', ['id' => $tutorial->getId()]);
        }

        return $this->render('admin/forms/form-tutorial.html.twig', [
            'formTutorial' => $form->createView(),
            'edit' => $tutorial->getId() !== null,
            'user' => $user,
            'headerText' => 'Ecrire un tutoriel'
        ]);
     }

     /**
     * @Route("admin/tutoriel/{id}/supprimer", name="delete_tutorial")
     */
    public function deleteTutorial(Tutorial $tutorial, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($tutorial);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('tutorials');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'tutorial' => $tutorial,
                'headerText' => 'Supprimer un tutoriel'
            ]);
        }
    }

    /**
     * @Route("admin/malts", name="malts")
     */
    public function malts(MaltRepository $repo)
    {
        $malts = $repo->findBy(['approved' => true], ['name' => 'ASC']);
        return $this->render('admin/malts.html.twig', [
            'malts' => $malts,
            'user' => $this->getUser(),
            'headerText' => 'Gerer les malts'
        ]);
    }

    /**
     * @Route("admin/malt/{id}/approuver", name="approve_malt")
     */
    public function approveMalt(Malt $malt, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(ApproveType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $malt->setApproved(true);
                $manager->persist($malt);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('admin/approve.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'malt' => $malt,
                'headerText' => 'Valider un malt'
            ]);
        }
    }

    /**
     * @Route("admin/malt/{id}/supprimer", name="delete_malt")
     */
    public function deleteMalt(Malt $malt, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($malt);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'malt' => $malt,
                'headerText' => 'Supprimer un malt'
            ]);
        }
    }

    /**
     * @Route("admin/houblons", name="hops")
     */
    public function hops(HopRepository $repo)
    {
        $hops = $repo->findBy(['approved' => true], ['name' => 'ASC']);
        return $this->render('admin/hops.html.twig', [
            'hops' => $hops,
            'user' => $this->getUser(),
            'headerText' => 'Gerer les houblons'
        ]);
    }

    /**
     * @Route("admin/houblon/{id}/approuver", name="approve_hop")
     */
    public function approveHop(Hop $hop, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(ApproveType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $hop->setApproved(true);
                $manager->persist($hop);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('admin/approve.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'hop' => $hop,
                'headerText' => 'Valider un houblon'
            ]);
        }
    }

    /**
     * @Route("admin/houblon/{id}/supprimer", name="delete_hop")
     */
    public function deleteHop(Hop $hop, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($hop);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'hop' => $hop,
                'headerText' => 'Supprimer un houblon'
            ]);
        }
    }

    /**
     * @Route("admin/autres-ingredients", name="others")
     */
    public function others(OtherIngredientRepository $repo)
    {
        $others = $repo->findBy(['approved' => true], ['name' => 'ASC']);
        return $this->render('admin/others.html.twig', [
            'others' => $others,
            'user' => $this->getUser(),
            'headerText' => 'Gerer les autres ingredients'
        ]);
    }

    /**
     * @Route("admin/autre-ingredient/{id}/approuver", name="approve_other")
     */
    public function approveOther(OtherIngredient $other, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(ApproveType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $other->setApproved(true);
                $manager->persist($other);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('admin/approve.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'other' => $other,
                'headerText' => 'Valider un ingredient'
            ]);
        }
    }

    /**
     * @Route("admin/autre-ingredient/{id}/supprimer", name="delete_other")
     */
    public function deleteOther(OtherIngredient $other, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($other);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'other' => $other,
                'headerText' => 'Supprimer un ingrédient'
            ]);
        }
    }

    /**
     * @Route("admin/levures", name="yeasts")
     */
    public function yeasts(YeastRepository $repo)
    {
        $yeasts = $repo->findBy(['approved' => true], ['name' => 'ASC']);
        return $this->render('admin/yeasts.html.twig', [
            'yeasts' => $yeasts,
            'user' => $this->getUser(),
            'headerText' => 'Gerer les levures'
        ]);
    }

    /**
     * @Route("admin/levure/{id}/approuver", name="approve_yeast")
     */
    public function approveYeast(Yeast $yeast, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(ApproveType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $yeast->setApproved(true);
                $manager->persist($yeast);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('admin/approve.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'yeast' => $yeast,
                'headerText' => 'Valider une levure'
            ]);
        }
    }

    /**
     * @Route("admin/levure/{id}/supprimer", name="delete_yeast")
     */
    public function deleteYeast(Yeast $yeast, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(DeleteType::class); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (in_array('ROLE_BIERROT_GOURMAND', $user->getRoles())) {
                $manager->remove($yeast);
                $manager->flush();
            }
            else {
                throw new Exception('Hmmm, t\'as pas le droit de faire ça.');
            }
            return $this->redirectToRoute('admin_home');
        }
        else {
            return $this->render('front/delete.html.twig', [
                'formDelete' => $form->createView(),
                'user' => $user,
                'yeast' => $yeast,
                'headerText' => 'Supprimer une levure'
            ]);
        }
    }
}