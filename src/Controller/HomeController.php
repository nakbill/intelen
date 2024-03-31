<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Country;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index( EntityManagerInterface $entityManager): Response
    {
        // Render the list of books, author, countries
        return $this->render('home/index.html.twig', [
            'books' => $entityManager->getRepository(Book::class)->findAll(),
            'authors' => $entityManager->getRepository(Author::class)->findAll(),
            'countries' => $entityManager->getRepository(Country::class)->findAll()
        ]);
    }
}
