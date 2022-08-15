<?php

namespace App\Controller\Admin;

use App\Entity\Info;
use App\Entity\User;
use App\Entity\About;
use App\Entity\Skill;
use App\Entity\MyWork;
use App\Entity\Hobbies;
use App\Entity\Services;
use App\Entity\Education;
use App\Entity\Experience;
use App\Entity\ExperienceItem;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
      //return $this->render('bundles/easyAdminBundle/admin.html.twig');
      
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        //return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Code viral');
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
      //dd($user);
        return parent::configureUserMenu($user)
            ->setAvatarUrl($user->getUserIdentifier());
    }

    public function configureMenuItems(): iterable
    {
        
      return [
        MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard'),
          
        MenuItem::linkToCrud('User', 'fas fa-user', User::class),
          
        MenuItem::linkToCrud('MyWork', 'fa fa-building-o', MyWork::class),
        
        MenuItem::subMenu('Resume', 'fas fa-article')->setSubItems([
          
          MenuItem::linkToCrud('About', 'fa fa-tags', About::class),
        
          MenuItem::linkToCrud('Info', 'fa fa-address-book-o', Info::class),

          MenuItem::linkToCrud('Skill', 'fa fa-comment', Skill::class),

          MenuItem::linkToCrud('Hobies', 'fa fa-gamepad', Hobbies::class),
          
          MenuItem::linkToCrud('Experience', 'fa fa-comment',  Experience::class),
          
          MenuItem::linkToCrud('Experience item', 'fa fa-comment', ExperienceItem::class),
          
          MenuItem::linkToCrud('Education', 'fa fa-graduation-cap', Education::class),
          
          MenuItem::linkToCrud('Services', 'fa fa-shopping-cart', Services::class),
                
        ]),
        MenuItem::linkToUrl('Homepage', 'fas fa-home', $this->generateUrl('app_home')),

        ];
    }

    public function configureAssets(): Assets
    {
        return parent::configureAssets()
            ->addWebpackEncoreEntry('admin');
    }
}
