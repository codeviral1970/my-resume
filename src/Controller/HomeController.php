<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AboutRepository;
use App\Repository\EducationRepository;
use App\Repository\ExperienceItemRepository;
use App\Repository\ExperienceRepository;
use App\Repository\HobbiesRepository;
use App\Repository\InfoRepository;
use App\Repository\MyWorkRepository;
use App\Repository\ServicesRepository;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Twig\TwigFunction;

class HomeController extends AbstractController
{
    private $about;

    public function __construct(
    AboutRepository $about,
    private SkillRepository $skill,
    private HobbiesRepository $hobbie,
    private InfoRepository $info,
    private ExperienceRepository $experience,
    private ExperienceItemRepository $experienceItem,
    private EducationRepository $education,
    private ServicesRepository $services,
    private MyWorkRepository $work,
    private ChartBuilderInterface $chartBuilder)
    {
        $this->about = $about;
    }

    /**
     * index route.
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $services = $this->services->findAll();
        $works = $this->work->findAll();

        return $this->render('home/index.html.twig', [
          'services' => $services,
          'works' => $works,
          'chart' => $this->createChart(),
        ]);
    }

    /**
     * about route.
     *
     * @return void
     */
    #[Route('/a-propos', name: 'app_about')]
    public function about()
    {
        $abouts = $this->about->findAll();
        $skills = $this->skill->findAll();
        $hobbies = $this->hobbie->findAll();
        $infos = $this->info->findAll();
        $experiences = $this->experience->findAll();
        $educations = $this->education->findAll();

        return $this->render('home/about.html.twig', [
          'abouts' => $abouts,
          'skills' => $skills,
          'hobbies' => $hobbies,
          'infos' => $infos,
          'experiences' => $experiences,
          'educations' => $educations,
        ]);
    }

    #[Route('/blog', name: ('app_blog'))]
    /**
     * blog route.
     *
     * @return void
     */
    public function blog()
    {
        return $this->render('myBlog/blog.html.twig');
    }

    /**
     * contact route.
     *
     * @return void
     */
    #[Route('/contact', name: 'app_contact')]
    public function contact(
    Request $request,
    MailerInterface $mailer,
    LoggerInterface $logger,
    EntityManagerInterface $manager
    ): Response {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        $message = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            // dd($contact->getEmail());
            $manager->persist($contact);
            $manager->flush();

            // $name = $contact->getName();
            // $message = $contact->getMessage();
            // $contactEmail = $contact->getEmail();
            // $contactSubject = $contact->getSubject();

            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('manbanhduc@gmail.com')
            ->subject($contact->getSubject())
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
              'name' => $contact->getName(),
              'message' => $contact->getEmail(),
            ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/contact.html.twig', [
                 'form' => $form->createView(),
          'message' => $message,
        ]);
    }

      /**
       * getFunctions.
       */
      public function getFunctions(): array
      {
          return [
            new TwigFunction('actual_route', [$this, 'getActualRoute']),
          ];
      }

      /**
       * getActualRoute.
       *
       * @param mixed $value
       * @param mixed $route
       */
      public function getActualRoute(string $value, string $route): string
      {
          return $value === $route ? 'active' : '';
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
