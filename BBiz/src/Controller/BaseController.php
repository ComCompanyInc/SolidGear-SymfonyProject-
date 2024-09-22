<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BaseController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/home/{id}', name: 'home')]
    public function homeAction(string $id): Response
    {
        $profileData = $this->entityManager->getRepository(User::class)->findOneBy(["id" => $id]);
        $personData = $profileData->getPerson();//$this->entityManagergetRepository(Person::class)->findOneBy(["idUser" => $profileData->getUser()]);
        $countryData = $personData->getTownDirectory();
        $raitingName = $profileData->getAliasDirectory()->getAliasName();

        return $this->render('home/home.html.twig', [
            'name' => $personData->getName(),
            'surname' => $personData->getSurname(),
            'patronymic' => $personData->getPatronymic(),
            'dateOfBirth' => $personData->getDateOfBirth(),
            'registrationDate' => $profileData->getDateRegistration(),
            'country' => $countryData,//$profileData->getCountry(),
            'raiting' => $profileData->getMainRaiting(),//$profileData->getRaiting(),
            'about' => $personData->getBiography(),
            'raitingName' => $raitingName,
        ]);
    }

    #[Route('/home', name: 'homeId')]
    public function homeActionId()
    {
        return $this->redirectToRoute('home', ['id' => $this->entityManager->getRepository(User::class)->
        findOneBy(["login" => $this->getUser()->getLogin()])->getId()]);
    }
}