<?php

namespace App\Controller;

use App\Repository\ReparationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte", name="compte")
     */
    public function index(ReparationRepository $repository): Response
    {
        $reparations = $repository->findAll();

        return $this->render('compte/compte.html.twig', [
            'reparations' => $reparations,
        ]);
    }
}
