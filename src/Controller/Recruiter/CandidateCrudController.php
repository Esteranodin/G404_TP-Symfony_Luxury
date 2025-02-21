<?php

namespace App\Controller\Recruiter;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            TextField::new('firstName', 'First Name'),
            TextField::new('lastName', 'Last Name'),
            TextField::new('user.email', 'Email'),
            TextField::new('currentLocation', 'City'),
            AssociationField::new('sectorJob', 'Job Category')->autocomplete(),
            DateTimeField::new('createdAt', 'Registration Date')->setFormTypeOption('disabled', true),
            DateTimeField::new('updatedAt', 'Last Modification')->setFormTypeOption('disabled', true),
            DateTimeField::new('deletedAt', 'Deletion Date')->setFormTypeOption('disabled', true),
            TextEditorField::new('description', 'Description'),
            // TextEditorField::new('notes', 'Notes'),
        ];

        if ($pageName === 'index' || $pageName === 'detail') {
            $fields[] = UrlField::new('profilePicPath', 'Profile Picture')->setTemplatePath('admin/fields/profilPic_link.html.twig');
            $fields[] = UrlField::new('passportPath', 'Passport')->setTemplatePath('admin/fields/cv_link.html.twig');
            $fields[] = UrlField::new('cvPath', 'CV')->setTemplatePath('admin/fields/passport_link.html.twig');
        } else {
            $fields[] = ImageField::new('profilePicPath', 'Profile Picture')
            ->setUploadDir('assets/uploads/profile_pictures')
            ->setBasePath('uploads/profile_pictures');
            $fields[] = ImageField::new('passportPath', 'Passport')
            ->setUploadDir('assets/uploads/passport_files')
            ->setBasePath('uploads/passport_files');
            $fields[] = ImageField::new('cvPath', 'CV')
            ->setUploadDir('assets/uploads/cv_files')
            ->setBasePath('uploads/cv_files');
        }
        
        return $fields;
    }

}
