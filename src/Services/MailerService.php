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

  public function sendEmail(string $email, string $subject, string $userName, string $message)
  {
      
    $email = (new TemplatedEmail())
      ->from($email)
      ->to('manbanhduc@gmail.com')
      ->subject($subject)
      ->htmlTemplate('email/welcome.html.twig')
      ->context([
        'user' => $userName,
        'message' => $message
      ]);

      $this->mailer->send($email);
  }
}