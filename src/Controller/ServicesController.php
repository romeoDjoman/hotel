<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Entity\Spa;
use App\Entity\Restaurant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Commande;
use App\Form\ReservationClientType;
use Symfony\Component\HttpFoundation\Request;

class ServicesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // GESTION ADMINISTRATEUR
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

    // FORMULAIRE CLIENT
    #[Route('/reservation', name: 'app_reservation')]
    public function reservation(Request $request): Response
    {
        $commande = new Commande();

        $form = $this->createForm(ReservationClientType::class, $commande);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarder la réservation en base de données :
            $this->entityManager->persist($commande);
            $this->entityManager->flush();

            // Rediriger vers la page d'accueil après la soumission réussie du formulaire
            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('services/reservationClient.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/reservation/success', name: 'app_reservation_success')]
    public function reservationSuccess(): Response
    {
        return $this->render('services/reservationSuccess.html.twig');
    }
}
