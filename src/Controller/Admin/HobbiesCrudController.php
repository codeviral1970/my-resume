<?php

namespace App\Controller\Admin;

use App\Entity\Hobbies;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HobbiesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hobbies::class;
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
