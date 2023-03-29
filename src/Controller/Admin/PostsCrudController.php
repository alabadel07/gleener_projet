<?php

namespace App\Controller\Admin;

use App\Entity\Posts;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, DateField, IdField, TextField,ChoiceField};

class PostsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Posts::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('description')->setLabel('Description'),
            TextField::new('content')->setLabel('Contenu'),
            DateField::new('date')->setLabel('Date'),
            TextField::new('other')->setLabel('Information supplémentaire'),
            TextField::new('localisation')->setLabel('adresse'),
            TextField::new('ville')->setLabel('Ville'),
            ChoiceField::new('annonce')->setLabel('Type d\'Annonce')
            ->autocomplete()
            ->allowMultipleChoices()
            ->setChoices([
            'Logements' => 'Post_logement',
            'Activités' => 'Post_Activités',
            'Bons Plans' => 'Post_Bonsplans'
        ]), 
            AssociationField::new('creator')->setLabel('Créateur du post')
        ];
    }

}
