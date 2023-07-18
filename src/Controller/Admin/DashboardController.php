<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Entity\Slider;
use App\Entity\Chambre;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\ChambreCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{


    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

         // return parent::index();
         $url = $this->adminUrlGenerator->setController(ChambreCrudController::class)->generateUrl();
         return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Hotel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Compte');

        yield MenuItem::subMenu('Profil', 'fa-solid fa-user')->setSubItems([
              MenuItem::linkToCrud('S\'inscrire', 'fas fa-plus', Membre::class)->setAction(Crud::PAGE_NEW),
              MenuItem::linkToCrud('Voir un membre', 'fas fa-eye', Membre::class)
        ]);

        yield MenuItem::section('Services');

        yield MenuItem::subMenu('Chambre', 'fa-solid fa-bed-front')->setSubItems([
            MenuItem::linkToCrud('Ajouter une chambre', 'fas fa-plus', Chambre::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir une chambre', 'fas fa-eye', Chambre::class)
        ]);

        yield MenuItem::section('Admin');
        yield MenuItem::subMenu('Slider', 'fa-solid fa-image')->setSubItems([
            MenuItem::linkToCrud('Ajouter une slider', 'fas fa-plus', Slider::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir une slider', 'fas fa-eye', Slider::class)
        ]);

        // yield MenuItem::subMenu('Restaurant', 'fas fa-truck-fast')->setSubItems([
        //     MenuItem::linkToCrud('Ajouter un menu', 'fas fa-plus', Restaurant::class)->setAction(Crud::PAGE_NEW),
        //     MenuItem::linkToCrud('Voir les menus', 'fas fa-eye', Restaurant::class)
        // ]);

        // yield MenuItem::subMenu('Spa', 'fas fa-truck-fast')->setSubItems([
        //     MenuItem::linkToCrud('Ajouter un spa', 'fas fa-plus', Spa::class)->setAction(Crud::PAGE_NEW),
        //     MenuItem::linkToCrud('Voir les spa', 'fas fa-eye', Spa::class)
        // ]);
    }
}
