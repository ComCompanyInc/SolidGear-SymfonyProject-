<?php

namespace App\Form\admin;

use App\Entity\AliasDirectory;
use App\Entity\CountryDirectory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminAliasForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('aliasName', TextType::class, [
                'label' => 'Alias name: ',
            ])
            ->add('minimalRaiting', IntegerType::class, [
                'label' => 'Minimal raiting: ',
            ])
            ->add('button', SubmitType::class, [
                'label' => 'Save',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AliasDirectory::class,
        ]);
    }
}