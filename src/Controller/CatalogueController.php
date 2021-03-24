<?php

namespace App\Controller;

use App\Entity\Reparation;
use App\Form\ReparationType;
use App\Repository\ReparationRepository;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CatalogueController extends AbstractController
{
    /**
     * @Route("/catalogue", name="catalogue")
     */
    public function index(ReparationRepository $repository): Response
    {
        $reparations = $repository->findAll();

        return $this->render('catalogue/catalogue.html.twig', [
            'reparations' => $reparations,
        ]);
    }

    /**
     * @Route("/catalogue/creation", name="catalogue_creation")
     * @Route("/catalogue/{id<\d+>}", name="catalogue_modification", methods="GET|POST")
     */
    public function ajoutEtModif(Reparation $reparation = null, Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        if (!$reparation) {
            $reparation = new Reparation();
        }
        $form = $this->createForm(
            ReparationType::class,
            $reparation
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $modif = null !== $reparation->getId();
            $user = $security->getUser();
            $reparation->setAuthor($user);    //Verifier si ID existe
            // dd($reparation);
            $entityManager->persist($reparation);
            $entityManager->flush();
            $this->addFlash('success', 'La modification a été effectuée');

            return $this->redirectToRoute('catalogue');
        }

        return $this->render('/catalogue/modificationReparation.html.twig', [
            'reparation' => $reparation,
            'form' => $form->createView(),
            'isModification' => null !== $reparation->getId(),
        ]);
    }

    /**
     * @Route("/catalogue/{id<\d+>}", name="catalogue_suppression", methods="delete")
     */
    public function suppression(Reparation $reparation, Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('SUP'.$reparation->getId(), $request->get('_token'))) {
            $entityManager->remove($reparation);
            $entityManager->flush();
            $this->addFlash('success', 'La suppression a été effectuée');

            return $this->redirectToRoute('catalogue');
        }
    }

    /**
     * @Route("/catalogue/search", name="filtreVille")
     *
     * @param mixed $ville
     */
    public function reparationParVille(ReparationRepository $repository, VilleRepository $repositoryV, $ville = null, Request $request): Response
    {
        $ville = $request->query->get('ville');
        $reparations = $repository->findByVille($ville);
        $villes = $repositoryV->findAll();
        // dd($reparations);

        return $this->render('catalogue/catalogue.html.twig', [
            'reparations' => $reparations,
            'villes' => $villes,
            'isVille' => true,
        ]);
    }
}
