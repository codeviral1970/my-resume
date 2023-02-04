<?php

namespace App\Controller\Admin\Resume;

use App\Entity\Skill;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
      DateTimeField::new('updatedAt', 'Date de MAJ')->hideOnForm(),
    ];
  }
}
