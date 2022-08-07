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
use App\Repository\ServicesRepository;
use App\Repository\SkillRepository;
use App\Services\GetContactService;
use Psr\Log\LoggerInterface;
use App\Services\MailerService;
use Symfony\Component\Mime\Email;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

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
   private ServicesRepository $services)
  {
    $this->about = $about;
  }

  #[Route('/', name: 'app_home')]
  public function index(): Response
  {
    $services = $this->services->findAll();

    return $this->render('home/index.html.twig', [
      'services' => $services
    ]);
  }

  #[Route('/a-propos', name: 'app_about')]
  public function about()
  { 
    $abouts = $this->about->findAll();
    $skills = $this->skill->findAll(); 
    $hobbies = $this->hobbie->findAll(); 
    $infos = $this->info->findAll();
    $experiences = $this->experience->findAll();
    $educations = $this->education->findAll();
  
    // dd($experiences);

    return $this->render('home/about.html.twig', [
      'abouts' => $abouts,
      'skills' => $skills,
      'hobbies' => $hobbies,
      'infos' => $infos,
      'experiences' => $experiences,
      'educations' => $educations
      
    ]);
  }

  #[Route('/contact', name: 'app_contact')]
  public function contact(
    Request $request, 
    MailerService $mailer,
    LoggerInterface $logger,
    EntityManagerInterface $manager
    ): Response
  {

    $contact = new Contact();

    $form = $this->createForm(ContactType::class, $contact);

    $form->handleRequest($request);

    $message = null;
    
    if($form->isSubmitted() && $form->isValid() ) {
      $contact = ($form->getData());
      //dd($contact->getEmail());
      $manager->persist($contact);
      $manager->flush();
      
      $name = $contact->getName();
      $message = $contact->getMessage();
      $contactemail = $contact->getEmail();
      $contactSubject = $contact->getSubject();

      $mailer->sendEmail($contactemail, $contactSubject, $name, $message );

      return $this->redirectToRoute('app_home');

    }
  
    return $this->render('home/contact.html.twig', [
             'form' => $form->createView(),
      'message' =>$message
    ]);
  }

}
