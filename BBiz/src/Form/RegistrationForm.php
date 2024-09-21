<?php

namespace App\Form;

use App\Entity\CountryDirectory;
use App\Entity\DistrictDirectory;
use App\Entity\Person;
use App\Entity\TownDirectory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

    $builder
        ->add('name', TextType::class, [
            'label' => 'Name: ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('surname', TextType::class, [
            'label' => 'Surname: ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('patronymic', TextType::class, [
            'label' => 'Patronymic: ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('biography', TextareaType::class, [
            'label' => 'Biography: ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('dateOfBirth', DateType::class, [
            'label' => 'Date of Birth: ',
            'years' => range(date(1950), date(2099)),
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('townName', EntityType::class, [
            'label' => 'Region: ',
            'class' => TownDirectory::class,
            'constraints' => [
                new Assert\NotBlank(),
            ]
            //'choice_label' => 'countryName',
        ])
        ->add('login', EmailType::class, [
            'label' => 'Login (Email): ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('password', PasswordType::class, [
            'label' => 'Password: ',
            'constraints' => [
                new Assert\NotBlank(),
            ]
        ])
        ->add('button', SubmitType::class, [
            'label' => 'Save',
        ]);
    }

    /*public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }*/
}