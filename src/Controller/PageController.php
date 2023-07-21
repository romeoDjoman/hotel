<?php

namespace App\Controller;

use App\Entity\Slider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_pages_accueil')]
    public function accueil(EntityManagerInterface $entityManager): Response
    {
        $sliders = $entityManager->getRepository(Slider::class)->findAll();
        return $this->render('pages/accueil.html.twig', [
            'sliders' => $sliders,
        ]);
    }

    #[Route('/slider', name: 'app_slider')]
    public function slider(EntityManagerInterface $entityManager): Response
    {
        $sliders = $entityManager->getRepository(Slider::class)->findAll();
        
        return $this->render('pages/slider.html.twig', [
            'sliders' => $sliders,
        ]);
    }
}
