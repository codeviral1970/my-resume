<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Mdp')->hideOnIndex(),
            ArrayField::new('roles', 'Rôles'),
            ImageField::new('avatar', 'Avatar')
                ->setBasePath('images/')
                ->setUploadDir('public/images')
                ->setUploadedFileNamePattern(('[randomhash].[extension]'))
                ->setRequired(false),
            DateTimeField::new('createdAt', 'Date de création')->hideOnForm(),
            DateTimeField::new('updatedAt', 'Date de modification')->hideOnForm(),
        ];
    }
    
   public function configureActions(Actions $actions): Actions
  {
    return $actions
        // ...
        // this will forbid to create or delete entities in the backend
        ->disable(Action::NEW, Action::DELETE)
    ;
  }
}
      