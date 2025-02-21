<?php

namespace App\Controller\Recruiter;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use Symfony\Component\String\Slugger\SluggerInterface;

class OfferCrudController extends AbstractCrudController
{
    public function __construct(private EntityRepository $entityRepository, private SluggerInterface $slugger) {}

    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    // Job créé lié au recruteur qui créera l'offre
    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        /** @var User */
        $user = $this->getUser();
        $recruiter = $user->getRecruiter();

        $response = $this->entityRepository->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->andWhere('entity.recruiter = :recruiter')->setParameter('recruiter', $recruiter);

        return $response;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            BooleanField::new('isActivated'),
            TextField::new('location'),
            TextEditorField::new('content'),
            DateTimeField::new('closingAt'),
            IntegerField::new('salary'),
            AssociationField::new('contractType')->autocomplete(),
            AssociationField::new('sectorJob')->autocomplete(),
            TextField::new('reference')->hideOnForm(),
            TextField::new('slug')->hideOnForm(),
            DateTimeField::new('createdAt')->hideOnForm(),

        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Offer) {
            return;
        }

        /** @var User */
        $user = $this->getUser();
        $entityInstance->setRecruiter($user->getRecruiter());

        // Générer une référence unique
        $reference = $this->generateUniqueReference($entityManager);
        $entityInstance->setReference($reference);

        // Générer le slug si le titre est renseigné
        if ($jobTitle = $entityInstance->getName()) {
            $slug = $this->generateUniqueSlug($entityManager, $jobTitle);
            $entityInstance->setSlug($slug);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Offer) {
            return;
        }

        // Générer le slug si le titre est renseigné
        if ($jobTitle = $entityInstance->getName()) {
            $slug = $this->generateUniqueSlug($entityManager, $jobTitle);
            $entityInstance->setSlug($slug);
        }

        parent::updateEntity($entityManager, $entityInstance);
    }

    /**
     * Génère une référence unique pour une offre d'emploi
     * Format: JOB-YYYYMMDD-XXXX où XXXX est un nombre aléatoire
     */
    private function generateUniqueReference(EntityManagerInterface $entityManager): string
    {
        do {
            // Générer une référence au format JOB-YYYYMMDD-XXXX
            $reference = sprintf(
                'JOB-%s-%04d',
                (new \DateTimeImmutable())->format('Ymd'),
                random_int(0, 9999)
            );

            // Vérifier si la référence existe déjà
            $exists = $entityManager->getRepository(Offer::class)
                ->findOneBy(['reference' => $reference]);
        } while ($exists);

        return $reference;
    }

    private function generateUniqueSlug(EntityManagerInterface $entityManager, string $title): string
    {
        $baseSlug = $this->slugger->slug(strtolower($title));
        $slug = $baseSlug;

        // Vérifier si le slug existe déjà
        while ($entityManager->getRepository(Offer::class)->findOneBy(['slug' => $slug->toString()])) {
            // Ajouter un suffixe unique basé sur timestamp court
            $uniqueSuffix = substr(uniqid(), -4);
            $slug = $this->slugger->slug($baseSlug . '-' . $uniqueSuffix);
        }
        return $slug->toString();
    }
}
