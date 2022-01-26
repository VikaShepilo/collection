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
                'label' => false,
                'required' => false,
                ])
            ->add('country', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('genre', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('fees', IntegerType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('placeInTheTop', IntegerType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('numberOfAwards', IntegerType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('commentTop', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('review', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('criticism', TextType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('publicationDate', DateType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('authorIsDateOfBirth', DateType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('developmentDate', DateType::class, [
                'label' => false,
                'required' => false,
                ])
            ->add('integrityOfHistory', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    '+' => true,
                    '-' => false
                ),
                'required' => false,
                ))
            ->add('oneAuthor', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    '+' => true,
                    '-' => false
                ),
                'required' => false,
                ))
            ->add('abultContent', ChoiceType::class, array(
                'label' => false,
                'choices' => array(
                    '+' => true,
                    '-' => false
                ),
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
