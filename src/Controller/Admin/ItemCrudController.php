<?php

namespace App\Controller\Admin;

use App\Entity\Item;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ItemCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Item::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $horas_libres = $this->getDoctrine()->getRepository(Tag::class)->findAll();
        return [

            TextField::new('nameItem'),
            AssociationField::new('collections'),
        ];
    }
}
