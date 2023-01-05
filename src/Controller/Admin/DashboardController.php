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
use App\Repository\UserRepository;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;



class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;
    private $userRepository;
    private $chartBuilder;

    public function __construct(
      UserRepository $userRepository,
      ChartBuilderInterface $chartBuilder)
    {
        $this->userRepository = $userRepository;
        $this->chartBuilder = $chartBuilder;
    }

    #[IsGranted("ROLE_ADMIN")]
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $users = $this->userRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'users' => $users,
            'chart' => $this->createChart(),
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Code viral')
            ->renderContentMaximized();
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
      //dd($user);

      $user->getRoles();
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

    private function createChart(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                   'suggestedMin' => 0,
                   'suggestedMax' => 100,
                ],
            ],
        ]);
        return $chart;
    }
}
