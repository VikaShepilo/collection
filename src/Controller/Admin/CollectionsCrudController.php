<?php

namespace App\Controller\Admin;

use App\Entity\Collections;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class CollectionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Collections::class;
    }


    public function configureFields(string $pageName): iterable
    {   
        return [
            TextField::new('name'),
            TextField::new('topic'),
            TextField::new('description'),
        ];
    }

}
