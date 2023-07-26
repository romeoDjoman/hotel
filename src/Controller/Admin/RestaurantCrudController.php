<?php

namespace App\Controller\Admin;

use App\Entity\Restaurant;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RestaurantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Restaurant::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            
            IntegerField::new('id')->hideOnForm(),
            TextField::new('titre'),
            //* pour l'update de l'image du produit
            ImageField::new('photo')->setUploadDir('public/uploads/images/')->setUploadedFileNamePattern('[timestamp]-[slug]-[contenthash].[extension]')->onlyWhenUpdating()->setFormTypeOptions([
                'required' => false, // Rendre le champ non requis lors de la mise à jour
            ]),
            //* pour la création du produit
            ImageField::new('photo')->setUploadDir('public/uploads/images/')->setUploadedFileNamePattern('[timestamp]-[slug]-[contenthash].[extension]')->onlyWhenCreating(),
            //* affichage des images dans le tableau
            ImageField::new('photo')->setBasePath('uploads/images/')->hideOnForm(),

            MoneyField::new('prix')->setCurrency('EUR'),
           
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        $restaurant = new $entityFqcn();
        $restaurant->setDateEnregistrement(new \DateTime());

        return $restaurant;
    }
}
