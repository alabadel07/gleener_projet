<?php

namespace App\Controller\Admin;

use App\Entity\Reports;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ AssociationField, IdField, TextField };

class ReportsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reports::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('user')->setLabel('Créateur du signalement'),
            AssociationField::new('comment')->setLabel('Commentaire ciblé'),
            TextField::new('reason')->setLabel('Raison')
        ];
    }
}
