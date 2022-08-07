<?php

namespace App\Controller\Admin;

use App\Entity\Info;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Info::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
