<?php

namespace App\Controller;

use App\Entity\AliasDirectory;
use App\Entity\Person;
use App\Entity\User;
use App\Form\RegistrationForm;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AuthorizationController extends AbstractController
{
    public EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/registration', name: 'registration')]
    public function registrationAction(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $person = new Person();
        $user = new User();
        //$district = new DistrictDirectory();

        $registrationForm = $this->createForm(RegistrationForm::class);

        $registrationForm->handleRequest($request);

        if($registrationForm->isSubmitted() && $registrationForm->isValid())
        {
            $registrationData = $registrationForm->getData();

            $name = $registrationData['name'];
            $surname = $registrationData['surname'];
            $patronymic = $registrationData['patronymic'];
            $biography = $registrationData['biography'];
            $dateOfBirth = $registrationData['dateOfBirth'];

            $town = $registrationData['townName'];
            //$district = $registrationData['districtName']; //!!убрать из бд
            $dateReg = date('dd-mm-YY h:i:s'); //generate current date
            $isDelete = false;
            $address = '#'.uniqid(); //randomGenerator
            $aliasDirectory = $this->entityManager->getRepository(AliasDirectory::class)->findOneBy(['minimalRaiting' => 0])/*->getId()*//*->getAliasName()*/;
            $mainRaiting = 0;
            $login = $registrationData['login'];
            $password = $registrationData['password'];

            $person->setName($name);
            $person->setSurname($surname);
            $person->setPatronymic($patronymic);
            $person->setBiography($biography);
            $person->setDateOfBirth($dateOfBirth);
            $person->setTownDirectory($town);

            $this->entityManager->persist($person);
            $this->entityManager->flush();

            $personId = $this->entityManager->getRepository(Person::class)->findOneBy(
                ['name' => $name, 'surname' => $surname, 'patronymic' => $patronymic, 'dateOfBirth' => $dateOfBirth]
            );

            $user->setLogin($login);
            $user->setPassword($passwordHasher->hashPassword(new User(), $password));
            $user->setAliasDirectory($aliasDirectory);
            $user->setMainRaiting($mainRaiting);
            $user->setMainRaiting($mainRaiting);
            $user->setDateRegistration(date_create_from_format('dd-mm-YY h:i:s', $dateReg));
            $user->setPerson($personId);
            $user->setUrlAddress($address);
            $user->setRejected(false);
            //$user->setIsDelete($isDelete);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            /*$this->entityManager->persist($person);
            $user = $registrationData->getUser();
            $this->entityManager->persist($user);
            $this->entityManager->flush();*/
        }

        return $this->render('registration/registration.html.twig',
            [
                'registrationForm' => $registrationForm
            ]);
    }
}