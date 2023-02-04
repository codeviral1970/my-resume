<?php

namespace App\Controller\Admin\Resume;

use App\Entity\ExperienceItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExperienceItem::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            AssociationField::new('experience'),
        ];
    }
}
