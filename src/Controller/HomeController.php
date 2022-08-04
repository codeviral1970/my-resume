<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
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

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/a-propos', name: 'app_about')]
    public function about()
    {
      return $this->render('home/about.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(
        Request $request, 
        MailerInterface $mailer,
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
           
            // Email
            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('manbanh@free.fr')
            ->subject($contact->getSubject())
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'user' => $name,
                'message' => $message
            ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_home');

        }
    
        return $this->render('home/contact.html.twig', [
             'form' => $form->createView(),
            'message' =>$message
        ]);
    }

}
