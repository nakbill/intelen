<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( EntityManagerInterface $entityManager): Response
    {
        // Get list of
        $books = $entityManager->getRepository(Book::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }




}
