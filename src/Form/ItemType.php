<?php

namespace App\Form;

use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\TagsToCollectionTransformer;

class ItemType extends AbstractType
{
    private $manager;
 
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameItem');
        $builder
            ->add('tags', CollectionType::class, array(
                'label' => false,
                'entry_type' => TagType::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'attr'=>['autocomplete' => 'on'],
            ));
        $builder
            ->get('tags')
            ->addModelTransformer(new TagsToCollectionTransformer($this->manager));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
