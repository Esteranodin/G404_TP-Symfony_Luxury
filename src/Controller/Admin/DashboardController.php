<?php

namespace App\Controller\Admin;

use App\Entity\ContractType;
use App\Entity\Gender;
use App\Entity\Sector;
use App\Entity\User;
use App\Entity\Xperience;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
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
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services')
            ->setFaviconPath('img/logo.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-desktop');

        // <===================== JOBS =====================>
        yield MenuItem::section('Parameters');

        yield MenuItem::linkToCrud('Genders', 'fa fa-bath', Gender::class);
        yield MenuItem::linkToCrud('Experiences', 'fas fa-chart-line', Xperience::class);
        yield MenuItem::linkToCrud('Sectors', 'fas fa-tags', Sector::class);
        yield MenuItem::linkToCrud('Job Offer Types', 'fas fa-briefcase', ContractType::class);

        // <===================== RECRUITERS =====================>
        yield MenuItem::section('Recruiters');

        yield MenuItem::linkToCrud('Recruiters', 'fa fa-user-tie', User::class);
    }
}
