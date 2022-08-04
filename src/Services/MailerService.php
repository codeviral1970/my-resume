<?php

namespace App\Services;

use App\Entity\Contact;
use Symfony\Component\Mime\Email;
use App\Services\GetContactService;
use App\Repository\ContactRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class MailerService
{
   
    public function __construct(
        private MailerInterface $mailer, 
        private ContactRepository $contactRepo)
    {}

    public function sendEmail(): void
    {
        $contact = new Contact();

        $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('manbanhduc@gmail.com')
            ->subject($contact->getSubject())
            ->htmlTemplate('email/welcome.html.twig')
            ->context([
                'user' => $contact->getName()
            ]);

            $this->mailer->send($email);
    }
}