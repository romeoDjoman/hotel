<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackOfficeController extends AbstractController
{
    #[Route('/membres', name: 'membres')]
    public function listeMembres(Request $request, EntityManagerInterface $entityManager): Response
    {   
        $membres = $entityManager->getRepository(Membre::class)->findAll();
        // Récupérez le formulaire pour l'action "ajouterMembre"
        $form = $this->createForm(RegistrationFormType::class);
        
        return $this->render('backoffice/show_membre.html.twig', [
            'membres' => $membres, // Transmettre la variable "membres" au modèle
            'registrationForm' => $form->createView(), // Créez la vue du formulaire et transmettez-la
        ]);
    }

    #[Route('/membre/ajouter', name: 'ajouter_membre')]
    public function ajouterMembre(Request $request, EntityManagerInterface $entityManager): Response
    {
        $membre = new Membre();
        $form = $this->createForm(RegistrationFormType::class, $membre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($membre);
            $entityManager->flush();

            return $this->redirectToRoute('membres');
        }

        return $this->render('backoffice/ajout_membre.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/membre/modifier/{id}', name: 'modifier_membre')]
    public function modifierMembre(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RegistrationFormType::class, $membre);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('membres');
        }

        return $this->render('backoffice/modif_membre.html.twig', [
            'membre' => $membre, // Pass the "membre" variable to the template
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/membre/supprimer/{id}', name: 'supprimer_membre')]
    public function supprimerMembre(Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($membre);
        $entityManager->flush();

        return $this->redirectToRoute('membres');
    }
}
