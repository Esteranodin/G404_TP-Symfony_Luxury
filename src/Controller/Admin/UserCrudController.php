<?php

namespace App\Controller\Admin;

use App\Entity\Recruiter;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository as OrmEntityRepository;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $passwordhasher) {}


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Recruiter')
            ->setEntityLabelInPlural('Recruiters')
            ->setPageTitle(CRUD::PAGE_INDEX, 'Recruiters')
            ->setPageTitle(CRUD::PAGE_NEW, 'Add a new recruiter')
            ->setPageTitle(CRUD::PAGE_EDIT, 'Edit a recruiter')
            ->setPageTitle(CRUD::PAGE_DETAIL, 'Recruiter details');
    }

    // override pour altérer Bundle et faire une requête perso pour récup seulement les recruteurs 
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $queryBuilder = $this->container->get(OrmEntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $queryBuilder->andWhere('entity.roles Like :role')
            ->setParameter('role', '%ROLE_RECRUITER%');

        return $queryBuilder;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('password', 'Password')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Repeat Password']])
                    ->setRequired($pageName === Crud::PAGE_NEW)
                    ->onlyOnForms()
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User) {
            $entityInstance->setEmail($entityInstance->getEmail());
            $this->hashPassword($entityInstance);
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();

    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof User) { {
                $entityInstance->setRoles(['ROLE_RECRUITER']);
                $entityInstance->setIsVerified(true);
                $this->hashPassword($entityInstance);

                $recruiter = new Recruiter();
                $recruiter->setUser($entityInstance);
            }
 
            parent::persistEntity($entityManager, $recruiter);
        }
    }

    private function hashPassword(User $user): void
    {
        if ($user->getPassword()) {
            $user->setPassword($this->passwordhasher->hashPassword($user, $user->getPassword()));
        }
    }
}
