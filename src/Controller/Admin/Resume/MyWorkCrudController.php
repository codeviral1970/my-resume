<?php

namespace App\Controller\Admin\Resume;

use App\Entity\MyWork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MyWorkCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return MyWork::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('name'),
      ImageField::new('illustration', 'Image')
        ->setBasePath('images/')
        ->setUploadDir('public/images')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false),
    ];
  }
}
