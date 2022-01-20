<?php

namespace App\Form;

use App\Entity\Information;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('author', TextType::class, [
                'required' => false,
                ])
            ->add('country', TextType::class, [
                'required' => false,
                ])
            ->add('genre', TextType::class, [
                'required' => false,
                ])
            ->add('fees', IntegerType::class, [
                'required' => false,
                ])
            ->add('placeInTheTop', IntegerType::class, [
                'required' => false,
                ])
            ->add('numberOfAwards', IntegerType::class, [
                'required' => false,
                ])
            ->add('commentTop', TextType::class, [
                'required' => false,
                ])
            ->add('review', TextType::class, [
                'required' => false,
                ])
            ->add('criticism', TextType::class, [
                'required' => false,
                ])
            ->add('publicationDate', DateType::class, [
                'required' => false,
                ])
            ->add('authorIsDateOfBirth', DateType::class, [
                'required' => false,
                ])
            ->add('developmentDate', DateType::class, [
                'required' => false,
                ])
            ->add('integrityOfHistory', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'label' => 'Integrity of history',
                'required' => false,
                ))
            ->add('oneAuthor', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'label' => 'One author',
                'required' => false,
                ))
            ->add('abultContent', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => true,
                    'No' => false
                ),
                'label' => 'Abult content',
                'required' => false,
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Information::class,
        ]);
    }
}
