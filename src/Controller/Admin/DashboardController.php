<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Conference;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\CommentCrudController;
use App\Entity\Admin;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CommentCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony 2024 05');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToCrud('Conferences', 'fas fa-map-marker-alt', Conference::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-comments', Comment::class);
        yield MenuItem::linkToCrud('Product', 'fas fa-list', Product::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Admin', 'fas fa-list', Admin::class);
}
}
