<?php

namespace App\Controller\Recruiter;

use App\Entity\CompanyContact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class CompanyContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CompanyContact::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
