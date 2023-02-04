<?php

namespace App\Controller\Admin\Resume;

use App\Entity\Experience;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Experience::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('enterpriseName'),
      TextField::new('jobName'),
      TextField::new('jobTime'),
    ];
  }
}
