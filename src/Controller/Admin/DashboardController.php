<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Auteur; 
use App\Entity\Livre; 
use App\Entity\Genre; 
use App\Entity\User;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/adminbookstore", name="admin")
     */
    
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Bookstore');
    }
  
    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Auteurs', 'fas fa-list', Auteur::class);
        yield MenuItem::linkToCrud('Livres', 'fas fa-newspaper', Livre::class);
        yield MenuItem::linkToCrud('Genres', 'fas fa-list', Genre::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }
}
