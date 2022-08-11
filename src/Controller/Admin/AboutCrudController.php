<?php

namespace App\Controller\Admin;

use App\Entity\About;
use DateTimeInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AboutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return About::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
      
      yield IdField::new('id')->hideOnForm();
      yield TextEditorField::new('description');
      yield DateTimeField::new('createdAt')->hideOnForm();
      yield DateTimeField::new('updatedAt')->hideOnForm();

    }
    
}
