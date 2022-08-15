<?php

namespace App\Controller\Admin;

use App\Entity\Skill;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Skill::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
      return [
        IdField::new('id')->hideOnForm(),
        TextField::new('name', 'Nom'),
        DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
        DateTimeField::new('updatedAt', 'Date de MAJ')->hideOnForm()
      ];
    }
    
}
