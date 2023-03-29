<?php

namespace App\Controller\Admin;

use App\Entity\Blogs;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, DateField, IdField, TextField,TextareaField};
class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Blogs::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('description')->setLabel('Description'),
            TextareaField::new('content')
            ->setLabel('Contenu')
            ->setFormTypeOption('attr', array('maxlength' => -1)),
            DateField::new('date')->hideOnForm(),
            AssociationField::new('creator')->setLabel('Créateur du blog'),
        ];
    }

}
