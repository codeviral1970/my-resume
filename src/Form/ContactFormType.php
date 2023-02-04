<?php

namespace App\Form;

use App\ValueObject\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr' => [
                    'class' => 'text-white block mb-2 mt-5 text-xl font-bold',
                ],
                'label' => 'Nom',
                'attr' => [
                    'class' => 'w-full border border-input-border bg-input px-4 py-4 my-5',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', EmailType::class, [
                'label_attr' => [
                    'class' => 'text-white block mb-2 mt-5 text-xl font-bold',
                ],
                'label' => 'Email',
                 'attr' => [
                    'class' => 'w-full border border-input-border bg-input px-4 py-4',
                 ],
                   'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('subject', TextType::class, [
                'label_attr' => [
                    'class' => 'text-white block mb-2 mt-5 text-xl font-bold',
                ],
                'label' => 'Sujet',
                'attr' => [
                    'class' => 'w-full border border-input-border bg-input px-4 py-4',
                ],
                  'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label_attr' => [
                    'class' => 'text-white block mb-2 mt-5 text-xl font-bold',
                ],
                'label' => 'Message',
                'attr' => [
                    'class' => 'w-full border border-input-border bg-input px-4 py-4',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
               'attr' => [
                'class' => 'mt-5 px-6 py-2 bg-theme text-white font-bold rounded-md',
               ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
