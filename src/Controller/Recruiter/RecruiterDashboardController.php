<?php

namespace App\Controller\Recruiter;

use App\Entity\Candidate;
use App\Entity\Offer;
use App\Entity\Recruiter;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[AdminDashboard(routePath: '/recruiter', routeName: 'recruiter')]
class RecruiterDashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/recruiter', name: 'recruiter')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('recruiter/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Recruiter interface | Luxury Services')
            ->setFaviconPath('img/logo.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-desktop');

        yield MenuItem::section('Fill your profile', 'fa fa-user-tie');

        /** @var User */
        $user = $this->getUser();
        $company = $user->getRecruiter();


        // Générer l'URL de la page d'édition du profil Client
        $url = $this->adminUrlGenerator
            ->setController(RecruiterCrudController::class)
            ->setAction('edit')
            ->setEntityId($company->getId())
            ->generateUrl();

        yield MenuItem::linkToUrl('Here', 'fa fa-arrow-right', $url);

        // <===================== CANDIDATES =====================>
        yield MenuItem::section('Candidates');
        yield MenuItem::linkToCrud('Who', 'fa fa-user-o', Candidate::class);
        // TODO
        // yield MenuItem::linkToCrud('Applications', 'fa fa-user-check', Application::class);

        // <===================== OFFER =====================>

        yield MenuItem::section('My job\'s offers', 'fa fa-briefcase');
        yield MenuItem::linkToCrud('Manage your jobs', 'fa fa-tasks', Offer::class);
    

    }
}
