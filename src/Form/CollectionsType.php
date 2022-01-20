<?php

namespace App\Form;

use App\Entity\Collections;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\UX\Dropzone\Form\DropzoneType;

class CollectionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('topic', ChoiceType::class, array(
                'choices' => array(
                    'Book' => 'Book',
                    'Film' => 'Film',
                    'Music' => 'Music',
                ),
                'expanded' => true))
            ->add('img', DropzoneType::class, [
                'required' => false,
                'label'    => 'Add picter',
                'attr' =>[
                    'class' => 'form-control']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collections::class,
        ]);
    }
}
