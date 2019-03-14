<?php

namespace App\Controller;

use App\Entity\Malt;
use App\Form\MaltType;
use App\Repository\MaltRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackOfficeController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'BackOfficeController',
        ]);
    }

    /**
     * @Route("admin/malts", name="malts")
     */
    public function malts(MaltRepository $repo)
    {
        $malts = $repo->findAll();
        return $this->render('admin/malts.html.twig', [
            'malts' => $malts
        ]);
    }

    /**
     * @Route("/admin/malt/ajouter", name="add_malt")
     * @Route("/admin/malt/{id}/modifier", name="edit_malt")
     */
    public function formMalt(Malt $malt = null, Request $request, ObjectManager $manager) {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if(!$malt){
            $malt = new Malt();
        }

        $form = $this->createForm(MaltType::class, $malt); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($malt);
            $manager->flush();

           return $this->redirectToRoute('malts');
        }

        return $this->render('admin/form-malt.html.twig', [
            'formMalt' => $form->createView(),
            'edit' => $malt->getId() !== null
        ]);
    }
}