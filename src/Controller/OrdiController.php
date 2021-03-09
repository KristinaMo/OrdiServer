<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrdiController extends AbstractController
{
    /**
     * @Route("/", name="ordi")
     */
    public function index(): Response
    {
        return $this->render('ordi/index.html.twig', [
            'controller_name' => 'OrdiController',
        ]);
    }
}
