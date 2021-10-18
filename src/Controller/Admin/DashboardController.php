<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

;
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     * 
     */
    public function index(): Response
    {
       return $this->render('bundles/EasyAdminBundle/dashboard.html.twig');
       // return parent::index();
    }
    
    /**
     * configureDashboard
     *
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration d\'OBlog');
    }
    
    /**
     * configureMenuItems
     *
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud('Articles', 'fa fa-newspaper', Post::class);
       // yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
    }
}
