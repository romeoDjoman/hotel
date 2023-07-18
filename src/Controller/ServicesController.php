<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Spa;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/chambre', name: 'app_chambre')]
    public function chambre(): Response
    {
        $chambres = $this->entityManager->getRepository(Chambre::class)->findAll();

        return $this->render('services/chambre.html.twig', [
            'chambres' => $chambres,
        ]);
    }

    #[Route('/spa', name: 'app_spa')]
    public function spa(): Response
    {
        $spas = $this->entityManager->getRepository(Spa::class)->findAll();

        return $this->render('services/spa.html.twig', [
            'spas' => $spas,
        ]);
    }

    #[Route('/restaurant', name: 'app_restaurant')]
    public function restaurant(): Response
    {
        $restaurants = $this->entityManager->getRepository(Restaurant::class)->findAll();

        return $this->render('services/restaurant.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }
}
