<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LienDiversController extends AbstractController
{
    #[Route('/lien/divers', name: 'app_lien_divers')]
    public function index(): Response
    {
        return $this->render('lien_divers/index.html.twig', [
            'controller_name' => 'LienDiversController',
        ]);
    }
}
