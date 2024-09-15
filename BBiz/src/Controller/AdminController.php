<?php

namespace App\Controller;

use App\Entity\AliasDirectory;
use App\Entity\CountryDirectory;
use App\Entity\TownDirectory;
use App\Form\admin\AdminAliasForm;
use App\Form\admin\AdminCountryForm;
use App\Form\admin\AdminTownForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public EntityManagerInterface $entityManager;

    function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/dir', name: 'adminDir')]
    public function adminDirAction(Request $request): Response
    {
        $countryDirectory = new CountryDirectory();
        $townDirectory = new TownDirectory();
        $aliasDirectory = new AliasDirectory();

        $adminCountryForm = $this->createForm(AdminCountryForm::class, $countryDirectory);
        $adminTownForm = $this->createForm(AdminTownForm::class, $townDirectory);
        $adminAliasForm = $this->createForm(AdminAliasForm::class, $aliasDirectory);

        $adminCountryForm->handleRequest($request);
        $adminTownForm->handleRequest($request);
        $adminAliasForm->handleRequest($request);

        if($adminCountryForm->isSubmitted() && $adminCountryForm->isValid())
        {
            $adminCountryData = $adminCountryForm->getData();

            //$countryDirectory = new CountryDirectory();
            $countryDirectory = $adminCountryData;
            $this->entityManager->persist($countryDirectory);
            $this->entityManager->flush();
        }

        if($adminTownForm->isSubmitted() && $adminTownForm->isValid())
        {
            $adminTownData = $adminTownForm->getData();

            //$townDirectory = new TownDirectory();
            $townDirectory = $adminTownData;
            $this->entityManager->persist($townDirectory);
            $this->entityManager->flush();
        }

        if($adminAliasForm->isSubmitted() && $adminAliasForm->isValid())
        {
            $adminAliasData = $adminAliasForm->getData();

            //$aliasDirectory = new AliasDirectory();
            $aliasDirectory = $adminAliasData;
            $this->entityManager->persist($aliasDirectory);
            $this->entityManager->flush();
        }

        return $this->render('admin/dir/adminDir.html.twig',[
            'adminCountryForm' => $adminCountryForm,
            'adminTownForm' => $adminTownForm,
            'adminAliasForm' => $adminAliasForm,
        ]);
    }
}