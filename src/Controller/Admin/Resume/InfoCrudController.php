<?php

namespace App\Controller\Admin\Resume;

use App\Entity\Info;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InfoCrudController extends AbstractCrudController
{
  public static function getEntityFqcn(): string
  {
    return Info::class;
  }

  public function configureFields(string $pageName): iterable
  {
    return [
      IdField::new('id')->hideOnForm(),
      TextField::new('firstName'),
      TextField::new('lastName'),
      TextField::new('email'),
      TextField::new('phone'),
      TextField::new('address'),
      TextField::new('firstName'),
      TextField::new('imageField'),
      ImageField::new('illustration', 'Image')
        ->setBasePath('images/')
        ->setUploadDir('public/images')
        ->setUploadedFileNamePattern('[randomhash].[extension]')
        ->setRequired(false),
    ];
  }
}
